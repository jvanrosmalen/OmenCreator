<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use Request;
use App\Skill;
use App\Race;
use App\PlayerClass;
use Response;

class JsonClassController extends Controller
{
	public function checkClassName(){
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
		
		if(Request::has('class_id')){
			$id = Request::input('class_id');
		}

		$classs = PlayerClass::where('name', '=', $class_name)->get();

		if(sizeof($classs)>0 && $classs[0]->id != $id){
			$retBool = true;
		}
		
		return Response::json(json_encode($retBool));
	}
	
	public function getClassSkills(){
		$charLevel = 1;
		$classSkills = [];
		$nonClassSkills = [];
		$charRace = [];
		$allSkills = ['classSkills'=>[],'nonClassSkills'=>[]];
		
		if(Request::has('char_level')){
			$charLevel = Request::input('char_level');
		}
		if(Request::has('char_race')){
			$charRace[] = Request::input('char_race');
		}
	
		if(Request::has('class_id')){
			$classIdArray[] = Request::input('class_id');
			
			$classSkills = Skill::whereHas('playerClasses',function($query) use( $classIdArray){
						$query->whereIn('id', $classIdArray)
						->orWhere('id','=', 1);
					})
					->where(function($query) use ($charRace){
						$query->whereHas('racePrereqs', function($q)use($charRace)
							{$q->whereIn( 'id', $charRace );})
						->orWhereHas('racePrereqs', function($q){$q;}, '<', 1);
						}
					)
					->where('skill_level_id','<=',$charLevel)
					->orderBy('name', 'asc')
					->get()
					;
			$nonClassSkills = Skill::whereDoesntHave('playerClasses',function($query) use( $classIdArray){
					$query->whereIn('id', $classIdArray)
						->orWhere('id','=',1);
					})
				->where(function($query) use ($charRace){
						$query->whereHas('racePrereqs', function($q)use($charRace)
						{$q->whereIn( 'id', $charRace );})
						->orWhereHas('racePrereqs', function($q){$q;}, '<', 1);
							}
						)
				->where('skill_level_id','<=',$charLevel)
				->orderBy('name', 'asc')
				->get();
			
			foreach ($nonClassSkills as $nonClassSkill	){
				$nonClassSkill->ep_cost = $nonClassSkill->ep_cost*2; 				
			}
		}
	
		$allSkills['classSkills'] = $classSkills;
		$allSkills['nonClassSkills'] = $nonClassSkills;
		
		return Response::json(json_encode($allSkills));
	}
}
