<?php

namespace App\Http\Controllers;

use App\Coin;
use App\PlayerClass;
use App\Statistic;
use App\SkillLevel;
use App\Skill;
use App\Race;
use App\Income;
use App\CraftEquipment;
use Illuminate\Support\Facades\Input;
use Request;
use Session;
use App\SkillGroup;
use App\WealthType;
use Storage;
use App\Character;

class SkillController extends Controller
{
	public function showAll(){
		$session_array["levels_filter"] = Session::get("levels_filter");
		$session_array["class_filter"] = Session::get("class_filter");
		$skills = Skill::all()->sortBy(function($skill)
		{
			return sprintf('%-30s', $skill->name );
		});

		return view('/skill/showall', [ 	"skills"=>$skills,
										"skilllevels" => SkillLevel::all(),
										"playerclasses" => PlayerClass::all(),
										"session_array" => $session_array,
										'wealth_types' => WealthType::all()
				
		]);		
	}
	
	public function showCreateSkill($id = -1){
		$session_array["levels_filter"] = session("levels_filter");
		$session_array["class_filter"] = session("class_filter");
		
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
											"races"=>Race::all(),
											"craftequipments"=>$craftequipments,
											"rules" => $rules,
											"skill_rules" => $skill_rules,
											"skill_groups" => SkillGroup::all(),
											"session_array" => $session_array,
											"wealth_types" => WealthType::all()
			]);
		} else {
			// This is an update
			$skill = Skill::find($id);
			$skill_dam_rules = array();
			$skill_call_rules = array();
			$skill_res_rules = array();
			$skill_stat_rules = array();
			$skill_wealth_rules = array();
			$skill_class_rules = array();
			
			if(isset($skill->dam_rules)){
				$skill_dam_rules = $skill->dam_rules;
			}			
			if(isset($skill->call_rules)){
			$skill_call_rules = $skill->call_rules;
			}
			if(isset($skill->res_rules)){
				$skill_res_rules = $skill->res_rules;
			}
			if(isset($skill->stat_rules)){
				$skill_stat_rules = $skill->stat_rules;
			}
			if(isset($skill->wealth_rules)){
				$skill_wealth_rules = $skill->wealth_rules;
			}
			if(isset($skill->class_rules)){
				$skill_class_rules = $skill->class_rules;
			}
				
			$skill_rules = [	"dam_rules"=>$skill_dam_rules,
					"call_rules"=>$skill_call_rules,
					"res_rules"=>$skill_res_rules,
					"stat_rules"=>$skill_stat_rules,
					"wealth_rules"=>$skill_wealth_rules,
					"class_rules"=>$skill_class_rules
			];
			
			return view('skill/create', [	"skill"=>$skill,
											"coins"=>Coin::all(),
											"playerclasses"=>PlayerClass::all(),
											"stats"=>Statistic::all(),
											"levels"=>SkillLevel::all(),
											"races"=>Race::all(),
											"craftequipments"=>$craftequipments,
											"rules" => $rules,
											"skill_rules" => json_encode($skill_rules),
											"skill_groups" => SkillGroup::all(),
											"session_array" => $session_array,
											"wealth_types" => WealthType::all()
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
		$secret_skill = false;
		$craft_skill = false;
		$mentor_check = Request::input('mentor');
		$secret_check = Request::input('secret_skill');
		$craft_check = Request::input('craft_skill');
		$wealth_prereq = $_POST["wealth_prereq"];
		
		if($mentor_check != null && $mentor_check==="on")
		{
			$mentor_required = true;
		}
		if($secret_check != null && $secret_check==="on")
		{
			$secret_skill = true;
		}
		if($craft_check != null && $craft_check==="on")
		{
			$craft_skill = true;
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
		$newSkill->secret_skill = $secret_skill;
		$newSkill->craft_skill = $craft_skill;
		$newSkill->wealth_prereq_id = $wealth_prereq;

		$newSkill->save();
		
		$skill_id = $newSkill->id;
		
		// Sync prereqs
		$prereqs_set1 = json_decode($_POST['skill_prereqs_set1_list']);
		$prereqs_set2 = json_decode($_POST['skill_prereqs_set2_list']);
		
		$prereqs_sync_array = array();
		
		if(is_array($prereqs_set1)){
			foreach($prereqs_set1 as $prereqId){
				$prereqs_sync_array[intval($prereqId)] = ['prereq_set'=>'1'];;
			}
		}

		if(is_array($prereqs_set2)){
			foreach($prereqs_set2 as $prereqId){
				$prereqs_sync_array[intval($prereqId)] = ['prereq_set'=>'2'];
			}
		}
		
		$newSkill->skillPrereqs()->sync($prereqs_sync_array);
		
		// Sync skillgroup prereqs
		$group_prereqs_set1 = json_decode($_POST['skillgroup_prereqs_set1_list']);
		$group_prereqs_set2 = json_decode($_POST['skillgroup_prereqs_set2_list']);
		
		$group_prereqs_sync_array = array();
		
		if(is_array($group_prereqs_set1)){
			foreach($group_prereqs_set1 as $group_prereqId){
				$group_prereqs_sync_array[intval($group_prereqId)] = ['prereq_set'=>'1'];;
			}
		}

		if(is_array($group_prereqs_set2)){
			foreach($group_prereqs_set2 as $group_prereqId){
				$group_prereqs_sync_array[intval($group_prereqId)] = ['prereq_set'=>'2'];
			}
		}
		
		$newSkill->skillGroupPrereqs()->sync($group_prereqs_sync_array);
		
		// Sync craft equipment pivot table
		$craftEquipmentArray = json_decode($_POST["craft_equipment_list"]);
		
		if($craftEquipmentArray!=null && $craftEquipmentArray!=''){
			foreach($craftEquipmentArray as $craftEquipmentId){
				$newSkill->craftEquipments()->sync([intval($craftEquipmentId)], false);
			}
		}
	
		// Now sync the rules table.
		$ruleArray = json_decode($_POST["rules_list"]);

		$call_rules_sync = array();
		$dam_rules_sync = array();
		$res_rules_sync = array();
		$stat_rules_sync = array();
		$wealth_rules_sync = array();
		$class_rules_sync = array();
		
		if($ruleArray!=null && $ruleArray!=''){
			foreach($ruleArray as $rule){
				if(strcasecmp( $rule->type, "call")==0){
					$call_rules_sync[] = $rule->ruleId;
				} elseif (strcasecmp( $rule->type, "dam")==0){
					$dam_rules_sync[] = $rule->ruleId;
				} elseif (strcasecmp( $rule->type, "res")==0){
					$res_rules_sync[] = $rule->ruleId;
				} elseif (strcasecmp( $rule->type, "stat")==0){
					$stat_rules_sync[] = $rule->ruleId;
				} elseif (strcasecmp( $rule->type, "wealth")==0){
					$wealth_rules_sync[] = $rule->ruleId;
				} elseif (strcasecmp( $rule->type, "class") == 0){
					$class_rules_sync[] = $rule->ruleId;
				}
			}
		}

		$newSkill->callRules()->sync($call_rules_sync);
		$newSkill->damageRules()->sync($dam_rules_sync);
		$newSkill->resistanceRules()->sync($res_rules_sync);
		$newSkill->statisticRules()->sync($stat_rules_sync);
		$newSkill->wealthRules()->sync($wealth_rules_sync);
		$newSkill->classRules()->sync($class_rules_sync);
		
		// Save class prereqs
 		$player_classes = Input::get('playerclass');
 		if(is_array($player_classes)){
 			$newSkill->playerClasses()->sync($player_classes,false);
 		}
		
		// Save race prereqs
		$races = Input::get('race');
		if(is_array($races)){
 			$newSkill->racePrereqs()->sync($races,false);
		}
		
		return $this->showCreateSkill();
	}
	
	public function updateSkill($id){
		$skill = Skill::find($id);
		
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
		$secret_skill = false;
		$secret_check = Request::input('secret_skill');
		$craft_skill = false;
		$craft_check = Request::input('craft_skill');
		$wealth_prereq = $_POST["wealth_prereq"];
		
		if($mentor_check != null && $mentor_check==="on")
		{
			$mentor_required = true;
		}
			if($secret_check != null && $secret_check==="on")
		{
			$secret_skill = true;
		}
		if($craft_check != null && $craft_check==="on")
		{
			$craft_skill = true;
		}
		
		// Save everything to skill table
		$skill->name = $skill_name;

		if($skill->ep_cost != $ep_cost){
			// save new ep_cost
			$skill->ep_cost = $ep_cost;

			// update all players that already have this skill
			$players = $skill->ownedByPlayers();

			foreach($players as $player){
				$character = Character::find($player->id);
				$ep_cost_pivot = $ep_cost;

				if((boolean) $character->skills()->withPivot('is_out_of_class_skill')){
					$ep_cost_pivot = 2 * $ep_cost;
				}

				$character->skills()->updateExistingPivot($skill->id, ['purchase_ep_cost' => $ep_cost_pivot]);
			}
		}

		$skill->skill_level_id = $skill_level;
		$skill->description_small = $desc_short;
		$skill->description_long = $desc_long;
		$skill->mentor_required = $mentor_required;
		$skill->income_coin_id = $income_type;
		$skill->income_amount = $income_amount;
		$skill->statistic_prereq_id = $profile_prereq;
		$skill->statistic_prereq_amount = $profile_prereq_amount;
		$skill->secret_skill = $secret_skill;
		$skill->craft_skill = $craft_skill;
		$skill->wealth_prereq_id = $wealth_prereq;

		// handle possible handout
		// $request = request();
		if(Input::hasFile('handoutSelection')) {
			$handout = Input::file('handoutSelection');
			$skill->skill_handout = $handout->getClientOriginalName();

			Storage::disk('handouts')->deleteDirectory('/'.$id);

			Storage::put(
				'handouts/'.$id.'/'.$skill->skill_handout,
				file_get_contents($handout->getRealPath())
			);
		} else {
			if(Storage::disk('handouts')->exists('/'.$id) && strcmp($_POST["skill_handout_name"],"") === 0){
				Storage::disk('handouts')->deleteDirectory('/'.$id);
				$skill->skill_handout = "";
			}
		}

		$skill->save();
	
		// Sync prereqs
		$prereqs_set1 = json_decode($_POST['skill_prereqs_set1_list']);
		$prereqs_set2 = json_decode($_POST['skill_prereqs_set2_list']);
		
		$prereqs_sync_array = array();
		
		if(is_array($prereqs_set1)){
			foreach($prereqs_set1 as $prereqId){
				$prereqs_sync_array[intval($prereqId)] = ['prereq_set'=>'1'];
			}
		}
		
		if(is_array($prereqs_set2)){
			foreach($prereqs_set2 as $prereqId){
				$prereqs_sync_array[intval($prereqId)] = ['prereq_set'=>'2'];
			}
		}
		
		$skill->skillPrereqs()->sync($prereqs_sync_array);
	
		// Sync skillgroup prereqs
		$group_prereqs_set1 = json_decode($_POST['skillgroup_prereqs_set1_list']);
		$group_prereqs_set2 = json_decode($_POST['skillgroup_prereqs_set2_list']);
		
		$group_prereqs_sync_array = array();
		
		if(is_array($group_prereqs_set1)){
			foreach($group_prereqs_set1 as $group_prereqId){
				$group_prereqs_sync_array[intval($group_prereqId)] = ['prereq_set'=>'1'];;
			}
		}

		if(is_array($group_prereqs_set2)){
			foreach($group_prereqs_set2 as $group_prereqId){
				$group_prereqs_sync_array[intval($group_prereqId)] = ['prereq_set'=>'2'];
			}
		}
		
		$skill->skillGroupPrereqs()->sync($group_prereqs_sync_array);
		
		// Sync craft equipment pivot table
		$craftEquipmentArray = json_decode($_POST["craft_equipment_list"]);
	
		if($craftEquipmentArray!=null && $craftEquipmentArray!=''){
			foreach($craftEquipmentArray as $craftEquipmentId){
				$skill->craftEquipments()->sync([intval($craftEquipmentId)], false);
			}
		}
	
		// Now sync the rules table.
		$ruleArray = json_decode($_POST["rules_list"]);

		$call_rules_sync = array();
		$dam_rules_sync = array();
		$res_rules_sync = array();
		$stat_rules_sync = array();
		$wealth_rules_sync = array();
		$class_rules_sync = array();
		
		if($ruleArray!=null && $ruleArray!=''){
			foreach($ruleArray as $rule){
				if(strcasecmp( $rule->type, "call")==0){
					$call_rules_sync[] = $rule->ruleId;
				} elseif (strcasecmp( $rule->type, "dam")==0){
					$dam_rules_sync[] = $rule->ruleId;
				} elseif (strcasecmp( $rule->type, "res")==0){
					$res_rules_sync[] = $rule->ruleId;
				} elseif (strcasecmp( $rule->type, "stat")==0){
					$stat_rules_sync[] = $rule->ruleId;
				} elseif (strcasecmp( $rule->type, "wealth")==0){
					$wealth_rules_sync[] = $rule->ruleId;
				} elseif (strcasecmp( $rule->type, "class")==0){
					$class_rules_sync[] = $rule->ruleId;
				}
			}
		}

		$skill->callRules()->sync($call_rules_sync);
		$skill->damageRules()->sync($dam_rules_sync);
		$skill->resistanceRules()->sync($res_rules_sync);
		$skill->statisticRules()->sync($stat_rules_sync);
		$skill->wealthRules()->sync($wealth_rules_sync);
		$skill->classRules()->sync($class_rules_sync);
		
		// Save class prereqs
		$player_classes = Input::get('playerclass');
		if(is_array($player_classes)){
			$skill->playerClasses()->sync($player_classes);
		}
	
		// Save race prereqs
		$races = Input::get('race');
		if(is_array($races)){
			$skill->racePrereqs()->sync($races);
		}
	
		$url = route('skill_showall');
		header("Location:".$url);
		die();
	}
	
	public function showDeleteSkill($id){
		$skill = Skill::find($id);
		$prereqOf = $skill->isPrereqOf();
		$ownedBy = $skill->ownedByPlayers();
		return view('/skill/showdeleteskill', ['skill'=>$skill,
				'prereqOf' =>$prereqOf,
				'ownedBy' => $ownedBy
		]);
	}
	
	public function deleteSkill($id){
		$skill = Skill::find($id);
		$skill->delete();
		
		$url = route('skill_showall');
		header("Location:".$url);
		die();		
	}
}
?>
