<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Request;
use Session;
use PHPExcel; 
use PHPExcel_IOFactory;

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
            $importFilePath = 
            $this->handleImportFile($importFile);
		} else {
			return view('/skill/shownoimportfilewarning');
		}		
    }
    
    private function moveFileToServer($file){
        // Moves file to storage and returns path.
        Storage::put(
            'skillimports/'.$file->getClientOriginalName(),
            file_get_contents($file->getRealPath())
        );

        return Storage::url('skillimports/'.$file->getClientOriginalName());
    }

    private function handleImportFile($importFile){
        $objPHPExcel = PHPExcel_IOFactory::load($path);
        $objWorksheet = $objPHPExcel->getActiveSheet();
        $highestRow = $objWorksheet->getHighestRow();
        for ($row = 1; $row <= $highestRow; ++$row) {
             var_dump($objWorksheet->getCellByColumnAndRow(1, $row));
        }
    }
}
