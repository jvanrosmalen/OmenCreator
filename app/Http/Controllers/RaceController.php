<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

//use App\Http\Requests;
use App\Race;
use App\SkillLevel;
use App\PlayerClass;
use App\Skill;
use Request;
use Illuminate\Support\Facades\Input;

class RaceController extends Controller
{
	public function showCreateRace($id = -1){
		$rules = RulesController::getAllRules();
		$race_rules = null;
		
		if($id < 0){
			return view('race/createRace', ['race'=>null,
					'skilllevels' => SkillLevel::all(),
					'playerclasses' => PlayerClass::all(),
					'rules' => $rules,
					'race_rules' => $race_rules
			]);
		}
		else {
			$race = Race::find($id);
			$race_dam_rules = $race->dam_rules;
			$race_call_rules = $race->call_rules;
			$race_res_rules = $race->res_rules;
			$race_stat_rules = $race->stat_rules;
			$race_wealth_rules = $race->wealth_rules;
				
			$race_rules = [	"dam_rules"=>$race_dam_rules,
					"call_rules"=>$race_call_rules,
					"res_rules"=>$race_res_rules,
					"stat_rules"=>$race_stat_rules,
					"wealth_rules"=>$race_wealth_rules
			];
				
			return view('race/createRace', ['race'=>$race,
					'skilllevels' => SkillLevel::all(),
					'playerclasses' => PlayerClass::all(),
					'rules' => $rules,
					'race_rules'=> json_encode($race_rules)
					
			]);
		}
	}
	
	public function showDeleteRace($id = -1){
		$race = Race::find($id);
		return view('race/showDeleteRace', ['race'=>$race]);
	}
	
	public function deleteRace($id = -1){
		$race = Race::find($id);
	
		// delete the relationships with various rules first.
		if(!$race->call_rules->isEmpty()){
			$race->callRules()->detach();
		}
		if(!$race->dam_rules->isEmpty()){
			$race->damageRules()->detach();
		}
		if(!$race->res_rules->isEmpty()){
			$race->resistanceRules()->detach();
		}
		if(!$race->stat_rules->isEmpty()){
			$race->statisticRules()->detach();
		}
		if(!$race->wealth_rules->isEmpty()){
			$race->wealthRules()->detach();
		}
		if(!$race->race_skills->isEmpty()){
			$race->raceSkills()->detach();
		}
		if(sizeof($race->prohibited_classes) != 0){
				$race->prohibitedClasses()->detach();
		}
		if(sizeof($race->descent_classes) != 0){
			$race->descentClasses()->detach();
		}
		
		// Delete generic race from DB table
		$race->delete();
		return $this->gotoShowAllRace();
	}
	
	public function updateRace($id){
		$race = Race::find($id);
		if($race->id == null){
			return "echo 'ID is NULL' ";
		}
	
		$race->race_name = $_POST["race_name"];
		$race->description = $_POST["race_desc"];
		$race->is_player_race = isset($_POST['isPlayerRace']);
		
		// Now sync the pivot table.
		$ruleArray = json_decode($_POST["rules_list"]);
	
		// Remove all old rules
		if($race->callRules() != null){
			$race->callRules()->detach();
		}
		if($race->damageRules() != null){
			$race->damageRules()->detach();
		}
		if($race->resistanceRules() != null){
			$race->resistanceRules()->detach();
		}
		if($race->statisticRules() != null){
			$race->statisticRules()->detach();
		}
		if($race->wealthRules() != null){
			$race->wealthRules()->detach();
		}
	
		// Update with new rules
		if($ruleArray!=null && $ruleArray!=''){
			foreach($ruleArray as $rule){
				if(strcasecmp( $rule->type, "call")==0){
					$race->callRules()->sync([intval($rule->ruleId)], false);
				} elseif (strcasecmp( $rule->type, "dam")==0){
					$race->damageRules()->sync([intval($rule->ruleId)], false);
				} elseif (strcasecmp( $rule->type, "res")==0){
					$race->resistanceRules()->sync([intval($rule->ruleId)], false);
				} elseif (strcasecmp( $rule->type, "stat")==0){
					$race->statisticRules()->sync([intval($rule->ruleId)], false);
				} elseif (strcasecmp( $rule->type, "wealth")==0){
					$race->wealthRules()->sync([intval($rule->ruleId)], false);
				}
			}
		}
	
		$race->save();

		// Sync race skills
		$skills_list = json_decode($_POST['race_skills_list']);
		if(is_array($skills_list)){
			$race->raceSkills()->sync($skills_list);
		}
		
		// Sync prohibited classes
		$prohibited_classes_list = Input::get('prohibited_classes');
		if(is_array($prohibited_classes_list)){
			$race->prohibitedClasses()->sync($prohibited_classes_list);
		}

		// Sync prohibited classes
		$descent_classes_list = Input::get('descent_classes');
		if(is_array($descent_classes_list)){
			$race->descentClasses()->sync($descent_classes_list);
		}
		
		return $this->gotoShowAllRace();
	}
	
	public function submitRaceCreate(){
		$newRace = new Race();
	
		$newRace->race_name = $_POST["race_name"];
		$newRace->description = $_POST["race_desc"];
		$newRace->is_player_race = isset($_POST['isPlayerRace']);
		
		// First save the new race so it has an DB id.
		$newRace->save();
	
		// Now sync the pivot table.
		$ruleArray = json_decode($_POST["rules_list"]);
	
		if($ruleArray!=null && $ruleArray!=''){
			foreach($ruleArray as $rule){
				if(strcasecmp( $rule->type, "call")==0){
					$newRace->callRules()->sync([intval($rule->ruleId)], false);
				} elseif (strcasecmp( $rule->type, "dam")==0){
					$newRace->damageRules()->sync([intval($rule->ruleId)], false);
				} elseif (strcasecmp( $rule->type, "res")==0){
					$newRace->resistanceRules()->sync([intval($rule->ruleId)], false);
				} elseif (strcasecmp( $rule->type, "stat")==0){
					$newRace->statisticRules()->sync([intval($rule->ruleId)], false);
				} elseif (strcasecmp( $rule->type, "wealth")==0){
					$newRace->wealthRules()->sync([intval($rule->ruleId)], false);
				}
			}
		}
		
		// Sync race skills
		$skills_list = json_decode($_POST['race_skills_list']);
		if(is_array($skills_list)){
			$newRace->raceSkills()->sync($skills_list);
		}
		
		// Sync prohibited classes
	 	$prohibited_classes_list = Input::get('prohibited_classes');
 		if(is_array($prohibited_classes_list)){
 			$newRace->prohibitedClasses()->sync($prohibited_classes_list);
 		}
 		
 		// Sync descent classes
 		$descent_classes_list = Input::get('descent_classes');
 		if(is_array($descent_classes_list)){
 			$newRace->descentClasses()->sync($descent_classes_list);
 		}
		
		return $this->gotoShowAllRace();
	}
	
	public function showAllRace(){
		$races = Race::all()->sortBy(function($race)
		{
			return $race->race_name;
		});
		$race_ids = Race::all()->get(['id']);
		return view('race/showAllRaces', [ "races"=>$races, "race_ids"=>$race_ids]);
	}
	
	public function gotoShowAllRace(){
		$url = route('showall_race');
		header("Location:".$url);
		die();
	}
	
	public static function getDescentSkills($raceId){
		$descendSkillsArray = ["default"];

		if($raceId != null){
			$descentClassIds = Race::find($raceId)->descent_class_ids;
			$charRace = array();
			$charRace[] = $raceId;
			$descendSkillsArray =
			Skill::whereHas('playerClasses',function($query) use( $descentClassIds){
				$query->whereIn('id', $descentClassIds);
			})
			->where(function($query) use ($charRace){
				$query->whereHas('racePrereqs', function($q)use($charRace)
				{$q->whereIn( 'id', $charRace );})
				->orWhereHas('racePrereqs', function($q){$q;}, '<', 1);
			}
			)->where('skill_level_id','=',1)
			->orderBy('name', 'asc')
			->get();
		}
	
		return $descendSkillsArray;
	}
}
