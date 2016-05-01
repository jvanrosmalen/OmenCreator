<?php

namespace App\Http\Controllers;

use Request;
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
		
 		echo json_encode($skills);
	}
	
	public function getSkillDetailsJson(){
		$skill = null;
		$levelName = "";
		$skillClasses = [];
		$skillIncome = array(
			"incomeLevel" => 0,
			"incomeType" => ""	
		);
		
		if(Request::has('id')){
			$skill_id = Request::input("id");
			$skill = Skill::find($skill_id);
			
			$levelName = DB::table('skills')
				->join('skilllevels', 'skills.level', '=', 'skilllevels.id')
				->where('skills.id', "=", $skill_id)
				->pluck('skilllevels.skill_level');
			
			$skillClasses = DB::table('playerclasses')
				->join('skillclassprereqs', 'playerclasses.id', '=', 'skillclassprereqs.PlayerClasses_id')
				->join('skills', 'skillclassprereqs.skills_id', '=', 'skills.id')
				->where('skills.id', "=", $skill_id)
				->pluck('playerclasses.class_name');

			$skillRaces = DB::table('playerraces')
				->join('skillraceprereqs', 'playerraces.id', '=', 'skillraceprereqs.PlayerRaces_id')
				->join('skills', 'skillraceprereqs.skills_id', '=', 'skills.id')
				->where('skills.id', "=", $skill_id)
				->pluck('playerraces.race_name');
				
			$skillIncome = DB::table('incomes')
				->join('coins', 'incomes.coins_id', '=', 'coins.id')
				->join('skills', 'skills.id', '=', 'incomes.Skills_id')
				->where('skills.id', $skill_id)
				->select('coins.coin_name as incomeLevel', 'incomes.amount as incomeAmount')
				->get(); 
		}
		
		$retArray = array(
			"skill" => $skill,
			"levelName" => $levelName,
			"skillClasses" => $skillClasses,
			"skillRaces" => $skillRaces,
			"skillIncome" => $skillIncome
			);
		
		echo json_encode($retArray);
	}
}
?>