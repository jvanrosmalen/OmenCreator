<?php

namespace App\Http\Controllers;

use App\Coin;
use App\PlayerClass;
use App\Statistic;
use App\SkillLevel;
use App\Skill;
use App\PlayerRace;
use App\Income;
use App\CraftEquipment;
use Illuminate\Support\Facades\Input;
use Request;

class SkillController extends Controller
{
	public function showAll(){
		return view('skill/showall', [ "skills"=>Skill::all(), "skilllevels" => SkillLevel::all(), "playerclasses" => PlayerClass::all()]);		
	}
	
	public function showCreateSkill($id = -1){
		$rules = RulesController::getAllRules();
		$skill_rules = null;
		
		$craftequipments = CraftEquipment::all()->sortBy(function($equipment)
		{
			return sprintf('%-30s', $equipment->name );
		});
		
		if($id < 0){
			// this is a create. Not an update
			return view('skill/create', [	"skill"=>null,
											"coins"=>Coin::all(),
											"playerclasses"=>PlayerClass::all(),
											"stats"=>Statistic::all(),
											"levels"=>SkillLevel::all(),
											"playerraces"=>PlayerRace::all(),
											"craftequipments"=>$craftequipments,
											"rules" => $rules,
											"skill_rules" => $skill_rules
			]);
		} else {
			// This is an update
			$skill = Skill::find($id);
			$skill_dam_rules = $skill->dam_rules;
			$skill_call_rules = $skill->call_rules;
			$skill_res_rules = $skill->res_rules;
			$skill_stat_rules = $skill->stat_rules;
			$skill_wealth_rules = $skill->wealth_rules;
				
			$skill_rules = [	"dam_rules"=>$skill_dam_rules,
					"call_rules"=>$skill_call_rules,
					"res_rules"=>$skill_res_rules,
					"stat_rules"=>$skill_stat_rules,
					"wealth_rules"=>$skill_wealth_rules
			];
			
			return view('skill/create', [	"skill"=>$skill,
											"coins"=>Coin::all(),
											"playerclasses"=>PlayerClass::all(),
											"stats"=>Statistic::all(),
											"levels"=>SkillLevel::all(),
											"playerraces"=>PlayerRace::all(),
											"craftequipments"=>$craftequipments,
											"rules" => $rules,
											"skill_rules" => json_encode($skill_rules)
					
			]);
		}
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
		$newSkill->skill_level_id = $skill_level;
		$newSkill->description_small = $desc_short;
		$newSkill->description_long = $desc_long;
		$newSkill->mentor_required = $mentor_required;
		$newSkill->income_coin_id = $income_type;
		$newSkill->income_amount = $income_amount;
		$newSkill->statistic_prereq_id = $profile_prereq;
		$newSkill->statistic_prereq_amount = $profile_prereq_amount;
		
		$newSkill->save();
		
		$skill_id = $newSkill->id;
		
		// Sync prereqs
		$prereqs_set1 = json_decode($_POST['skill_prereqs_set1_list']);
		$prereqs_set2 = json_decode($_POST['skill_prereqs_set2_list']);
		
		if($prereqs_set1!=null && $prereqs_set1!=''){
			foreach($prereqs_set1 as $prereqId){
				$newSkill->skillPrereqs()->sync([intval($prereqId)=>['prereq_set'=>'1']], false);
			}
		}
		if($prereqs_set2!=null && $prereqs_set2!=''){
			foreach($prereqs_set2 as $prereqId){
				$newSkill->skillPrereqs()->sync([intval($prereqId)=>['prereq_set'=>'2']], false);
			}
		}
		
		// Sync craft equipment pivot table
		$craftEquipmentArray = json_decode($_POST["craft_equipment_list"]);
		
		if($craftEquipmentArray!=null && $craftEquipmentArray!=''){
			foreach($craftEquipmentArray as $craftEquipmentId){
				$newSkill->craftEquipments()->sync([intval($craftEquipmentId)], false);
			}
		}
	
		// Now sync the rules table.
		$ruleArray = json_decode($_POST["rules_list"]);
		
		if($ruleArray!=null && $ruleArray!=''){
			foreach($ruleArray as $rule){
				if(strcasecmp( $rule->type, "call")==0){
					$newSkill->callRules()->sync([intval($rule->ruleId)], false);
				} elseif (strcasecmp( $rule->type, "dam")==0){
					$newSkill->damageRules()->sync([intval($rule->ruleId)], false);
				} elseif (strcasecmp( $rule->type, "res")==0){
					$newSkill->resistanceRules()->sync([intval($rule->ruleId)], false);
				} elseif (strcasecmp( $rule->type, "stat")==0){
					$newSkill->statisticRules()->sync([intval($rule->ruleId)], false);
				} elseif (strcasecmp( $rule->type, "wealth")==0){
					$newSkill->wealthRules()->sync([intval($rule->ruleId)], false);
				}
			}
		}
		
		// Save class prereqs
 		$player_classes = Input::get('playerclass');
 		if(is_array($player_classes)){
 			$newSkill->playerClasses()->sync($player_classes,false);
 		}
		
		// Save race prereqs
		$player_races = Input::get('playerrace');
		if(is_array($player_races)){
 			$newSkill->playerRaces()->sync($player_races,false);
		}
		
		return $this->showCreateSkill();
	}
}
?>
