<?php

namespace App\Http\Controllers;

use Request;
use Response;
use App\Skill;
use DB;

class JsonSkillController extends Controller {
	public function decodeJson() {
		$skills = array();
		
		if(Request::has('levels')){
			$levels_filter = Request::input("levels", []);
			$skills = DB::table('skills')
				->join('skilllevels', 'skills.level', '=', 'skilllevels.id')
				->whereIn('level', $levels_filter)
				->select('skills.*', 'skilllevels.skill_level as levelName')
				->get();
		}
		
		if(Request::has('classes')){
			$class_filter = Request::input("classes", []);
		}
		

		return Response::json(json_encode($skills));
//  		echo json_encode($skills);
	}
	
	public function getSkillDetailsJson(){
		$skill = null;
		$levelName = "";
		$skillClasses = [];
		$skillRaces = [];
		
		if(Request::has('id')){
			$skill_id = Request::input("id");
			$skill = Skill::find($skill_id);
				
			$levelName = $skill->skill_level;
			$skillClasses = $skill->getPlayerClassesAttribute();
			$skillRaces = $skill->getPlayerRacesAttribute();
		}
		
		$retArray = array(
			"skill" => $skill,
			"levelName" => $levelName,
			"skillClasses" => $skillClasses,
			"skillRaces" => $skillRaces,
			);
		
 		return Response::json(json_encode($retArray));
	}
}
?>