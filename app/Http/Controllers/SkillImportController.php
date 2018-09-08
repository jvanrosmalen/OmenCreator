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

class SkillImportController extends Controller
{
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
        $errorArray = array();

        $objPHPExcel = PHPExcel_IOFactory::load($path);
        $objWorksheet = $objPHPExcel->getActiveSheet();
        $highestRow = $objWorksheet->getHighestRow();
        for ($row = 2; $row <= $highestRow; ++$row) {
            $skillName = trim($objWorksheet->getCellByColumnAndRow(2, $row)->getValue());
            // The error entry is used to log anything the import can't handle
            $errorEntry = [$skillName => array()];

            $skill = Skill::where('name', $skillName)->first();
            // Check if skill is already in the DB
            if($skill == null){
                // the skill is not yet present in the DB
                $skill = new Skill();
                
                $skill->name = $skillName;
                $skill->ep_cost = intval(trim($objWorksheet->getCellByColumnAndRow(4, $row)->getValue()));
                $skill->skill_level_id = 1;
                $skill->description_small = trim($objWorksheet->getCellByColumnAndRow(5, $row)->getValue());
                $skill->description_long = trim($objWorksheet->getCellByColumnAndRow(25, $row)->getValue());
                // Check mentor
                $skill->mentor_required = $this->checkForYesOrNo(trim($objWorksheet->getCellByColumnAndRow(26, $row)->getValue()));
                $skill->income_coin_id = 1;
                $skill->income_amount = 10;
                $skill->statistic_prereq_id = 1;
                $skill->statistic_prereq_amount = 0;
                $skill->secret_skill = false;
                $skill->craft_skill = false;
                $skill->wealth_prereq_id = 2;

                // save if for the rest
                $skill->save();

                $skillId = $skill->id;

                // ***********************
                // Player classes
                // ***********************
                // link the classes: get the values, split on -, translate to ids, and get ids to link
                $classNameArray = array_map('trim', explode("-", $objWorksheet->getCellByColumnAndRow(3, $row)->getValue()));
                $classIdArray = array();
                for($index = 0; $index < sizeof($classNameArray); $index++){
                    $className = $classNameArray[$index];
                    $playerClass = PlayerClass::where('class_name', $className)->first();

                    if($playerClass != null){
                        $classIdArray[] = $playerClass->id;
                    } else {
                        echo $skillName.": Could not find playerclass ".$className;
                    }
                }

                // sync playerclasses
                $skill->playerClasses()->sync($classIdArray,false);

                // ***********************
                // Skill race prereqs
                // ***********************
                // link the races: get the values, split on -, translate to ids, and get ids to link
                if(strcmp( trim($objWorksheet->getCellByColumnAndRow(7, $row)->getValue()), "/") !== 0){
                    $raceNameArray = array_map('trim', explode("-", $objWorksheet->getCellByColumnAndRow(7, $row)->getValue()));
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
                            echo $skillName.": Could not find race ".$raceName;
                        }
                    }                    

                    // sync races
                    $skill->racePrereqs()->sync($raceIdArray,false);
                }

                // ***********************
                // All resistance shizzle
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
                            echo "Fear Resistance rule ".$operator.$amount." does not exist.";
                        }
                    } else {
                        echo "Fear Resistance: could not find id";
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
                            echo "Theft Resistance rule ".$operator.$amount." does not exist.";
                        }
                    } else {
                        echo "Theft Resistance: could not find id";
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
                            echo "Poison Resistance rule ".$operator.$amount." does not exist.";
                        }
                    } else {
                        echo "Poison Resistance: could not find id";
                    }
                }

                // Handled all resistance rules, now sync the array
                if(sizeof($res_rules_sync) > 0)
                {
                    $skill->resistanceRules()->sync($res_rules_sync);
                }
            } else {
                // a skill with the same name is present in de DB
                echo "Found the skill ".$skill->name." <br>";
            }
        }
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
}
