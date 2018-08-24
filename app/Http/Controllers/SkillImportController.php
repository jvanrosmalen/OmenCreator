<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SkillImportController extends Controller
{
	public function importSkills(){
		return view('/skill/showimportskills');
	}

	public function doImportSkills(){
		if(Input::hasFile('skill_imports')) {
			$handout = Input::file('skill_imports');
			$skill->skill_handout = $handout->getClientOriginalName();
		} else {
			return view('/skill/shownoimportfilewarning');
		}		
	}
}
