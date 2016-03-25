<?php

namespace App\Http\Controllers;

use App\Coin;
use App\PlayerClass;
use App\Statistic;
use App\SkillLevel;
use App\Skill;

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
		]);
	}
	
	public function submitSkillCreate(){
		
		
		$skill_name = $_POST["skill_name"];
		$ep_cost = $_POST["ep_cost"];
		$player_class = $_POST["player_class"];
		$skill_level = $_POST["skill_level"];
		$profile_amount = $_POST["profile_amount"];
		$profile_type = $_POST["profile_type"];
		$desc_short = $_POST["desc_short"];
		$desc_long = $_POST["desc_long"];
		$income_amount = $_POST["income_amount"];
		$income_type = $_POST["income_type"];
		
		return $this->showSkillCreate();
	}
}
?>
