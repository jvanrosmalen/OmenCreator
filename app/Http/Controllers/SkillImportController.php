<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Request;
use Session;
use PHPExcel; 
use PHPExcel_IOFactory;
use Storage;
use App\Skill;
use App\PlayerClass;
use App\Race;
use App\Resistance;
use App\ResistanceRule;
use App\Statistic;
use App\StatisticRule;
use PDF;
use Response;

class SkillImportController extends Controller
{
    private $errorArray = array();
    private $currentErrorIndex = "";

	public function importSkills(){
		return view('/skill/showimportskills');
	}

	public function doImportSkills(){
		if(Input::hasFile('skill_imports')) {
            $importFile = Input::file('skill_imports');
            // Check if xlsx
            if(strcasecmp($importFile->getClientOriginalExtension(),"xlsx") != 0){
                return view('/skill/shownoimportfilewarning');    
            }
            
            // There is a file, and it is a xlsx file. Let's try and make something useful out of it.
            // Move file to known place on server
            $importFilePath = $this->moveFileToServer($importFile);
            $this->handleImportFile($importFilePath);

            $this->createAndSaveErrorLogFile();
            
            return view('/skill/showImportLog', ['errorLogArray'=>$this->errorArray]);
		} else {
			return view('/skill/shownoimportfilewarning');
		}		
    }
    
    private function moveFileToServer($file){
	$fileName = strtolower($file->getClientOriginalName());
        // First remove the skillimports directory in Storage and make a new one to clear any old files
        Storage::deleteDirectory('skillimports');
        Storage::makeDirectory('skillimports');
        // Moves file to storage and returns path.
        Storage::put(
            'skillimports/'.$fileName,
            file_get_contents($file->getRealPath())
        );

        return storage_path('app/skillimports/'.$fileName);
    }

    private function handleImportFile($path){
        // One freakishly big method to handle the excel sheet with skills to be imported.
        // Yeah, I should do this in a better way, but as this funcionality is used
        // only a few times in the existance of the site, I think I can get away with it.
        
        // To my future self: if you ran into problems and you read this, you did this to yourself
        // you numb nut. You should have listened to that little voice in the back of your head saying
        // this was a bad idea... but you didn't.
        $this->errorArray = array();

        $objPHPExcel = PHPExcel_IOFactory::load($path);
        $objWorksheet = $objPHPExcel->getActiveSheet();
        $highestRow = $objWorksheet->getHighestRow();
        // First loop to put all skills in the DB. Second loop will follow to handle all skill prereqs
        for ($row = 2; $row <= $highestRow; ++$row) {
            $skillName = trim($objWorksheet->getCellByColumnAndRow(2, $row)->getValue());
            // Create an index for possible errors
            $this->currentErrorIndex = $skillName;
            $this->errorArray[$this->currentErrorIndex] = array();

            $skill = Skill::where('name', $skillName)->first();
            // Check if skill is already in the DB
            if($skill == null){
                // the skill is not yet present in the DB
                $skill = new Skill();
            }
                
            $skill->name = $skillName;
            $skill->ep_cost = intval(trim($objWorksheet->getCellByColumnAndRow(4, $row)->getValue()));
            $skill->skill_level_id =
                $this->getSkillLevelId(trim($objWorksheet->getCellByColumnAndRow(29, $row)->getValue()));
            $skill->description_small = trim($objWorksheet->getCellByColumnAndRow(5, $row)->getValue());
            $skill->description_long = trim($objWorksheet->getCellByColumnAndRow(25, $row)->getValue());
            // Check mentor
            $skill->mentor_required =
                $this->checkForYesOrNo(trim($objWorksheet->getCellByColumnAndRow(26, $row)->getValue()));
            $skill->statistic_prereq_id = 1;
            $skill->statistic_prereq_amount = 0;
            $skill->secret_skill = false;
            $skill->wealth_prereq_id = 1;

            // Check for craft skill and income
            $skill->craft_skill =
                $this->checkForYesOrNo(trim($objWorksheet->getCellByColumnAndRow(27, $row)->getValue()));;

            $amount = intval(trim($objWorksheet->getCellByColumnAndRow(28, $row)->getValue()));
            if($amount > 0){
                if($amount < 10){
                    $skill->income_coin_id = 1;
                    $skill->income_amount = $amount;
                } else if($amount < 100){
                    $skill->income_coin_id = 2;
                    $skill->income_amount = floor($amount/10);
                } else {
                    $skill->income_coin_id = 3;
                    $skill->income_amount = floor($amount/100);
                }
            } else {
                $skill->income_coin_id = 1;
                $skill->income_amount = 0;
            }

            // save if for the rest
            $skill->save();

            // Check for handout message
            if($this->checkForYesOrNo(trim($objWorksheet->getCellByColumnAndRow(8, $row)->getValue()))){
                // Handout must be added
                $this->errorArray[$this->currentErrorIndex][] = "Handout moet toegevoegd worden.";
            }

            $skillId = $skill->id;

            // ***********************
            // Player classes
            // ***********************
            // link the classes: get the values, split on -, translate to ids, and get ids to link
            $classNameArray =
                array_map('trim', explode("-", $objWorksheet->getCellByColumnAndRow(3, $row)->getValue()));
            $classIdArray = array();
            for($index = 0; $index < sizeof($classNameArray); $index++){
                $className = $classNameArray[$index];
                $playerClass = PlayerClass::where('class_name', $className)->first();

                if($playerClass != null){
                    $classIdArray[] = $playerClass->id;
                } else {
                    $this->errorArray[$this->currentErrorIndex][] = "Onbekende klasse-naam: ".$className;
                }
            }

            // sync playerclasses
            $skill->playerClasses()->sync($classIdArray,false);

            // ***********************
            // Skill race prereqs
            // ***********************
            // link the races: get the values, split on -, translate to ids, and get ids to link
            if(strcmp( trim($objWorksheet->getCellByColumnAndRow(7, $row)->getValue()), "/") !== 0){
                $raceNameArray =
                    array_map('trim', explode("-", $objWorksheet->getCellByColumnAndRow(7, $row)->getValue()));
                $raceIdArray = array();
                for($index = 0; $index < sizeof($raceNameArray); $index++){
                    $raceName = $raceNameArray[$index];

                    // Just some service to counter common typos in the import sheet
                    if(strcmp($raceName, "Mannheim") === 0){
                        $raceName = "Mannheimer";
                    } else {
                        if(strcmp($raceName, "Khalië") === 0 || strcmp($raceName, "Khalier") === 0){
                            $raceName = "Khaliër";
                        } else {
                            if(strcmp($raceName, "BhandaKorr") === 0){
                                $raceName = "Bhanda Korr";
                            }
                        }
                    }

                    $race = Race::where('race_name', $raceName)->first();

                    if($race != null){
                        $raceIdArray[] = $race->id;
                    } else {
                        $this->errorArray[$this->currentErrorIndex][] =
                            "Onbekende ras-vereiste: ".$raceName;
                    }
                }                    

                // sync races
                $skill->racePrereqs()->sync($raceIdArray,false);
            }
            // ***********************
            // END OF: Skill race prereqs
            // ***********************

            // ***********************
            // RESISTANCE RULES
            // ***********************
            $res_rules_sync = array();

            // Fear Resistance
            $amount = intval(trim($objWorksheet->getCellByColumnAndRow(9, $row)->getValue()));
            if($amount != 0){
                // Get resistance id
                $resistance = Resistance::where('resistance_name', "Angst")->first();

                if($resistance != null){
                    $res_rule_id = $this->getResistanceRule($resistance, $amount);

                    if($res_rule_id > 0){
                        $res_rules_sync[] = $res_rule_id;
                    }
                    else {
                        $this->errorArray[$this->currentErrorIndex][] =
                            "De regel Angst Resistentie ".$amount." bestaat niet.";
                    }
                } else {
                    $this->errorArray[$this->currentErrorIndex][] =
                        "Kan ID van Angst Resistentie niet vinden.";
                }
            }

            // Theft Resistance
            $amount = intval(trim($objWorksheet->getCellByColumnAndRow(10, $row)->getValue()));
            if($amount != 0){
                // Get resistance id
                $resistance = Resistance::where('resistance_name', "Diefstal")->first();

                if($resistance != null){
                    $res_rule_id = $this->getResistanceRule($resistance, $amount);

                    if($res_rule_id > 0){
                        $res_rules_sync[] = $res_rule_id;
                    }
                    else {
                        $this->errorArray[$this->currentErrorIndex][] =
                            "De regel Diefstal Resistentie ".$amount." bestaat niet.";
                    }
                } else {
                    $this->errorArray[$this->currentErrorIndex][] =
                        "Kan ID van Diefstal Resistentie niet vinden.";
                }
            }

            // Poison Resistance
            $amount = intval(trim($objWorksheet->getCellByColumnAndRow(11, $row)->getValue()));
            if($amount != 0){
                // Get resistance id
                $resistance = Resistance::where('resistance_name', "Gif")->first();

                if($resistance != null){
                    $res_rule_id = $this->getResistanceRule($resistance, $amount);

                    if($res_rule_id > 0){
                        $res_rules_sync[] = $res_rule_id;
                    }
                    else {
                        $this->errorArray[$this->currentErrorIndex][] =
                            "De regel Gif Resistentie ".$amount." bestaat niet.";
                    }
                } else {
                    $this->errorArray[$this->currentErrorIndex][] =
                        "Kan ID van Gif Resistentie niet vinden.";
                }
            }

            // Magic Resistance
            $amount = intval(trim($objWorksheet->getCellByColumnAndRow(12, $row)->getValue()));
            if($amount != 0){
                // Get resistance id
                $resistance = Resistance::where('resistance_name', "Magie")->first();

                if($resistance != null){
                    $res_rule_id = $this->getResistanceRule($resistance, $amount);

                    if($res_rule_id > 0){
                        $res_rules_sync[] = $res_rule_id;
                    }
                    else {
                        $this->errorArray[$this->currentErrorIndex][] =
                            "De regel Magie Resistentie ".$amount." bestaat niet.";
                    }
                } else {
                    $this->errorArray[$this->currentErrorIndex][] =
                        "Kan ID van Magie Resistentie niet vinden.";
                }
            }

            // Sickness Resistance
            $amount = intval(trim($objWorksheet->getCellByColumnAndRow(13, $row)->getValue()));
            if($amount != 0){
                // Get resistance id
                $resistance = Resistance::where('resistance_name', "Ziekte")->first();

                if($resistance != null){
                    $res_rule_id = $this->getResistanceRule($resistance, $amount);

                    if($res_rule_id > 0){
                        $res_rules_sync[] = $res_rule_id;
                    }
                    else {
                        $this->errorArray[$this->currentErrorIndex][] =
                            "De regel Ziekte Resistentie ".$amount." bestaat niet.";
                    }
                } else {
                    $this->errorArray[$this->currentErrorIndex][] =
                        "Kan ID van Ziekte Resistentie niet vinden.";
                }
            }   

            // Trauma Resistance
            $amount = intval(trim($objWorksheet->getCellByColumnAndRow(17, $row)->getValue()));
            if($amount != 0){
                // Get resistance id
                $resistance = Resistance::where('resistance_name', "Trauma")->first();

                if($resistance != null){
                    $res_rule_id = $this->getResistanceRule($resistance, $amount);

                    if($res_rule_id > 0){
                        $res_rules_sync[] = $res_rule_id;
                    }
                    else {
                        $this->errorArray[$this->currentErrorIndex][] =
                            "De regel Trauma Resistentie ".$amount." bestaat niet.";
                    }
                } else {
                    $this->errorArray[$this->currentErrorIndex][] =
                        "Kan ID van Trauma Resistentie niet vinden.";
                }
            }  

            // Handled all resistance rules, now sync the array
            if(sizeof($res_rules_sync) > 0)
            {
                $skill->resistanceRules()->sync($res_rules_sync);
            }
            // ***********************
            // END OF: RESISTANCE RULES
            // ***********************

            // ***********************
            // STATISTICS RULES
            // ***********************
            $stat_rules_sync = array();

            // Willpower
            $amount = intval(trim($objWorksheet->getCellByColumnAndRow(14, $row)->getValue()));
            if($amount != 0){
                // Get stat id
                $statistic = Statistic::where('statistic_name', "Wilskracht")->first();

                if($statistic != null){
                    $stat_rule_id = $this->getStatisticRule($statistic, $amount);

                    if($stat_rule_id > 0){
                        $stat_rules_sync[] = $stat_rule_id;
                    }
                    else {
                        $this->errorArray[$this->currentErrorIndex][] =
                            "De regel Wilskracht ".$amount." bestaat niet.";
                    }
                } else {
                    $this->errorArray[$this->currentErrorIndex][] = "Kan ID van Wilskracht niet vinden.";
                }
            }
            
            // Status
            $amount = intval(trim($objWorksheet->getCellByColumnAndRow(15, $row)->getValue()));
            if($amount != 0){
                // Get stat id
                $statistic = Statistic::where('statistic_name', "Status")->first();

                if($statistic != null){
                    $stat_rule_id = $this->getStatisticRule($statistic, $amount);

                    if($stat_rule_id > 0){
                        $stat_rules_sync[] = $stat_rule_id;
                    }
                    else {
                        $this->errorArray[$this->currentErrorIndex][] =
                            "De regel Status ".$amount." bestaat niet.";
                    }
                } else {
                    $this->errorArray[$this->currentErrorIndex][] = "Kan ID van Status niet vinden.";
                }
            }

            // Focus
            $amount = intval(trim($objWorksheet->getCellByColumnAndRow(16, $row)->getValue()));
            if($amount != 0){
                // Get stat id
                $statistic = Statistic::where('statistic_name', "Focus")->first();

                if($statistic != null){
                    $stat_rule_id = $this->getStatisticRule($statistic, $amount);

                    if($stat_rule_id > 0){
                        $stat_rules_sync[] = $stat_rule_id;
                    }
                    else {
                        $this->errorArray[$this->currentErrorIndex][] =
                            "De regel Focus ".$amount." bestaat niet.";
                    }
                } else {
                    $this->errorArray[$this->currentErrorIndex][] = "Kan ID van Focus niet vinden.";
                }
            }

            // Hitpoints
            // I wonder why there are 5 lines for this. Code takes the highest of the 5 values
            $amount = 0;
            for($index = 19; $index <= 23; $index++){
                $curVal = intval(trim($objWorksheet->getCellByColumnAndRow($index, $row)->getValue()));
                if($amount < $curVal){
                    $amount = $curVal;
                }
            }
            if($amount != 0){
                // Get stat id
                $statistic = Statistic::where('statistic_name', "Levenspunten")->first();

                if($statistic != null){
                    $stat_rule_id = $this->getStatisticRule($statistic, $amount);

                    if($stat_rule_id > 0){
                        $stat_rules_sync[] = $stat_rule_id;
                    }
                    else {
                        $this->errorArray[$this->currentErrorIndex][] =
                            "De regel Levenspunten ".$amount." bestaat niet.";
                    }
                } else {
                    $this->errorArray[$this->currentErrorIndex][] = "Kan ID van Levenspunten niet vinden.";
                }
            }


            // Handled all statistic rules, now sync the array
            if(sizeof($stat_rules_sync) > 0)
            {
                $skill->statisticRules()->sync($stat_rules_sync);
            }
            // ***********************
            // END OF: STATISTIC RULES
            // ***********************
        }

        // Second for loop to handle skill prereqs
        for ($row = 2; $row <= $highestRow; ++$row) {
            $skillName = trim($objWorksheet->getCellByColumnAndRow(2, $row)->getValue());

            $this->currentErrorIndex = $skillName;
            
            $skill = Skill::where('name', $skillName)->first();
            // Check if skill is already in the DB
            if($skill != null){
                // Get all skill prereqs
                if(strcmp( trim($objWorksheet->getCellByColumnAndRow(6, $row)->getValue()), "/") !== 0 ||
                strcmp( trim($objWorksheet->getCellByColumnAndRow(6, $row)->getValue()), "") !== 0){
                    // There are prereqs here
                    $skillPrereqArray =
                        array_map('trim',
                            explode("+", $objWorksheet->getCellByColumnAndRow(6, $row)->getValue()));
                    $skillPrereqIdArray = array();
                    $prereqs_sync_array = array();

                    for($index = 0; $index < sizeof($skillPrereqArray); $index++){
                        $prereqSkillName = $skillPrereqArray[$index];

                        if(strcmp(trim($prereqSkillName),"") == 0){
                            continue;
                        }

                        $prereqSkill = Skill::where('name', $prereqSkillName)->first();
    
                        if($prereqSkill != null){
                            $skillPrereqIdArray[] = $prereqSkill->id;
                        } else {
                            $this->errorArray[$this->currentErrorIndex][] =
                                "Voorvereiste ".$prereqSkillName." staat niet in de database";
                        }
                    }
                    
                    if(sizeof($skillPrereqIdArray) > 0){
                        foreach($skillPrereqIdArray as $skillPrereqId){
                            $prereqs_sync_array[intval($skillPrereqId)] = ['prereq_set'=>'1'];
                        }

                        $skill->skillPrereqs()->sync($prereqs_sync_array);
                    }
                }
            } else {
                $this->errorArray[$this->currentErrorIndex][] =
                    "Er is iets heel raars gebeurd. Skill zou in de DB moeten staan. Bel Jasper maar.";
            }

            // Completely finished with a skill. If there are no error, remove from errorArray
            if(sizeof($this->errorArray[$this->currentErrorIndex]) === 0){
                unset($this->errorArray[$this->currentErrorIndex]);
            }
        }
    }

    public function downloadImportLog(){
        return response()->download(storage_path('app/skillimports/importlog.pdf'));
    }

    private function checkForYesOrNo($cellValue){
        if(strcasecmp($cellValue, "ja") == 0){
            return true;
        } else {
            return false;
        }
    }

    private function getResistanceRule($resistance, $amount){
        $res_rule_id = -1;
        $res_id = $resistance->id;

        $operator = "+";
        if($amount < 0){
            $amount = abs($amount);
            $operator = "-";
        }

        // find the correct resistance rule
        $res_rule = ResistanceRule::where('resistance_id', $res_id)->where('rules_operator', $operator)
            ->where('value', $amount)->first();
        if($res_rule != null){
            $res_rule_id = $res_rule->id;
        }
        
        return $res_rule_id;
    }

    private function getStatisticRule($statistic, $amount){
        $stat_rule_id = -1;
        $stat_id = $statistic->id;

        $operator = "+";
        if($amount < 0){
            $amount = abs($amount);
            $operator = "-";
        }

        // find the correct statistic rule
        $stat_rule = StatisticRule::where('statistic_id', $stat_id)->where('rules_operator', $operator)
            ->where('value', $amount)->first();
        if($stat_rule != null){
            $stat_rule_id = $stat_rule->id;
        }
        
        return $stat_rule_id;
    }

    private function getSkillLevelId($value){
        // If the string is empty, this method will return id = 1 (for Debutant) by default
        $retVal = 0;

        if(!empty($value)){
            // First character is already unique. Check on that for more robust code that allows
            // for some typos in the entries
            if(strcasecmp(substr($value, 0 , 1), "h") === 0){
                $retVal = 4;
            } else if(strcasecmp(substr($value, 0 , 1), "v") === 0){
                $retVal = 3;
            } else if(strcasecmp(substr($value, 0 , 1), "a") === 0){
                $retVal = 2;
            } else if(strcasecmp(substr($value, 0, 1), "d") === 0){
                $retVal = 1;
            } else {
                // Unknown skill level. Level set to 1 by default
                $retVal = 1;
                $this->errorArray[$this->currentErrorIndex][] =
                    "Onbekend vaardigheid niveau ".$value.". Opgeslagen als Debutant.";
            }
        }

        return $retVal;
    }

    private function createAndSaveErrorLogFile(){
        $directory = "skillimports";

        $pdf = \PDF::loadView('skill.importlog', ['errorLogArray'=>$this->errorArray]);
        Storage::deleteDirectory($directory);
        Storage::makeDirectory($directory);
        $output = $pdf->output();
        file_put_contents(storage_path('app/skillimports/importlog.pdf'), $output);
    }
}
