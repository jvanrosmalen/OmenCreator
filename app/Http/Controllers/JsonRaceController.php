<?php

namespace App\Http\Controllers;

use Request;
use Response;
use App\Race;
use App\Skill;

class JsonRaceController extends Controller
{
	public function checkRaceName(){
		// True means the name already exists.
		// False will be returned when:
		// - the name does not exist
		// - the name is the same as the id of the armor that is checked.
		$name = "";
		$id = 0;
		$retBool = false;
		
		if(Request::has('name')){
			$name = Request::input('name');
		}
		
		if(Request::has('race_id')){
			$id = Request::input('race_id');
		}

		$races = Race::where('name', '=', $race_name)->get();

		if(sizeof($races)>0 && $races[0]->id != $id){
			$retBool = true;
		}
		
		return Response::json(json_encode($retBool));
	}
	
	public function getProhibitedClasses(){
		$prohibitedClassesArray = ["default"];
	
		if(Request::has('race_id')){
			$raceId = Request::input('race_id');
				
			$prohibitedClassesArray = Race::find($raceId)->prohibited_classes;
		}
	
		return Response::json(json_encode($prohibitedClassesArray));
	}
	
	public function getDescentSkills(){
		$descendSkillsArray = ["default"];
	
		if(Request::has('race_id')){
			$raceId = Request::input('race_id');
			$descentClassIds = Race::find($raceId)->descent_class_ids;
			$descendSkillsArray =
				Skill::whereHas('playerClasses',function($query) use( $descentClassIds){
					$query->whereIn('id', $descentClassIds);
				})->where('skill_level_id','=',1)
				->get();
		}
	
		return Response::json(json_encode($descendSkillsArray));
	}
}
