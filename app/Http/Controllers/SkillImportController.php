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
                
                // ***********************
                // Class Name
                // ***********************
                $skill->name = $skillName;

                // save if for the rest
                $skill->save();

                $skillId = $skill->id;

                // ***********************
                // Player classes
                // ***********************
                // link the classes: get the values, split on -, translate to ids, and get ids to link
                $classNameArray = array_map('trim', split("-", $objWorksheet->getCellByColumnAndRow(3, $row)->getValue()));
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
            } else {
                // a skill with the same name is present in de DB
                echo "Found the skill ".$skill->name." <br>";
            }
        }
    }
}
