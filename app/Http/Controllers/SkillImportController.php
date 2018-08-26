<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Request;
use Session;

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
			$skill->skill_handout = $importFile->getClientOriginalName();
		} else {
			return view('/skill/shownoimportfilewarning');
		}		
	}
}
