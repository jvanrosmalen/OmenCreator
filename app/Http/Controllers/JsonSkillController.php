<?php

namespace App\Http\Controllers;

use Request;
use Response;
use App\Skill;
use DB;
use View;
use Session;

class JsonSkillController extends Controller {
	public function getSkillLevelsClassesJson() {
		$skills = array();
		
		if(Request::has('levels') && Request::has('classes')){
			$levels_filter = Request::input("levels", []);
			$class_filter = Request::input("classes", []);
			
			// Store all filter info in session
			session("levels_filter",$levels_filter);
			session("class_filter",$class_filter);
			
			$skills = DB::table('skills')
				->join('skill_levels', 'skills.skill_level_id', '=', 'skill_levels.id')
				->join('player_class_skill', 'skills.id', '=', 'player_class_skill.skill_id')
				->join('player_classes', 'player_class_skill.player_class_id', '=', 'player_classes.id')
				->whereIn('skill_level_id', $levels_filter)
				->whereIn('player_class_id', $class_filter)
				->select('skills.*', 'skill_levels.skill_level as levelName', 'player_classes.class_name as player_classes')
				->groupBy('skills.id')
				->get();

			// skills can have more than one player_class
			// for each skill, get the list of player_classes
			$test = array();
			foreach ($skills as $skill){
				$player_classes = DB::table('skills')
					->join('player_class_skill', 'skills.id', '=', 'player_class_skill.skill_id')
					->join('player_classes', 'player_class_skill.player_class_id', '=', 'player_classes.id')
					->where('skills.id', '=', $skill->id)
					->select('player_classes.class_name')
					->get();
				
				$classes = array();
				foreach($player_classes as $player_class){
					$classes[] = $player_class->class_name;
				}
				
				$skill->player_classes = $classes;
			}
			
			return Response::json(json_encode($skills));
		} else {
			return json_encode("Skill filter missing either levels or classes");
		}
	}
	
	public function getSkillDetailsJson(){
		$skill = null;
		$levelName = "";
		
		if(Request::has('id')){
			$skill_id = Request::input("id");
			$skill = Skill::find($skill_id);
		}
		
		$retArray = array(
			"skill" => $skill,
			);
		
 		return Response::json(json_encode($retArray));
	}
}
?>