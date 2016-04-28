<?php

namespace App\Http\Controllers;

use App\Coin;
use App\PlayerClass;
use App\Statistic;
use App\SkillLevel;
use App\Skill;
use App\PlayerRace;
use App\Income;
use Illuminate\Support\Facades\Input;
use Request;

class SkillController extends Controller
{
	public function showAll(){
		
//		return View::make('posts.index', compact('posts', 'sortby', 'order'));
		
		return view('skill/showall', [ "skills"=>Skill::all(), "skilllevels" => SkillLevel::all(), "playerclasses" => PlayerClass::all()]);		
	}
	
	public function showSkillCreate(){
		return view('skill/create', [	"coins"=>Coin::all(),
										"playerclasses"=>PlayerClass::all(),
										"stats"=>Statistic::all(),
										"levels"=>SkillLevel::all(),
										"playerraces"=>PlayerRace::all(),
		]);
	}
	
	public function submitSkillCreate(){
		
		
		$skill_name = $_POST["skill_name"];
		$ep_cost = $_POST["ep_cost"];
		$income_amount = $_POST["income_amount"];
		$income_type = $_POST["income_type"];
		$skill_level = $_POST["skill_level"];
		$desc_short = $_POST["desc_short"];
		$desc_long = $_POST["desc_long"];
		$profile_prereq_amount = $_POST["profile_prereq_amount"];
		$profile_prereq = $_POST["profile_prereq"];
		$profile_bonus_amount = $_POST["profile_bonus_amount"];
		$profile_bonus = $_POST["profile_bonus"];
		
		$mentor_required = false;
		$mentor_check = Request::input('mentor');
		if($mentor_check != null && $mentor_check==="on")
		{
			$mentor_required = true;
		}
		
		// Save everything to skill table
		$newSkill = new Skill();
		$newSkill->name = $skill_name;
		$newSkill->ep_cost = $ep_cost;
		$newSkill->level = $skill_level;
		$newSkill->descriptionSmall = $desc_short;
		$newSkill->descriptionLong = $desc_long;
		$newSkill->mentorRequired = $mentor_required;
		
		$newSkill->save();
		
		$skill_id = $newSkill->id;
		
		// Save to income table
		if($income_amount != 0){
			$newIncome = new Income();
			$newIncome->amount = $income_amount;
			$newIncome->Coins_id = $income_type;
			$newIncome->Skills_id = $skill_id;
			
			$newIncome->save();
		}
		
		// Save class prereqs
		$player_classes = Input::get('playerclass');
		if(is_array($player_classes))
		{
			foreach($player_classes as $class_id){
				$newSkill->addClassPrereq($class_id);
			}
		}
		
		// Save race prereqs
		$player_races = Input::get('playerrace');
		if(is_array($player_races))
		{
			foreach($player_races as $race_id){
				$newSkill->addRacePrereq($race_id);
			}
		}
		
		// Save profile prereq
		if ($profile_prereq_amount > 0){
			$newSkill->addProfilePrereq($profile_prereq, $profile_prereq_amount);
		}
		
		return $this->showSkillCreate();
	}
}
?>
