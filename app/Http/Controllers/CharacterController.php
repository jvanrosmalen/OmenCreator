<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\SkillLevel;
use App\PlayerClass;
use App\Race;
use App\Skill;
use App\Resistance;
use App\WealthType;
use App\User;
use App\Character;
use App\EpAssignment;

class CharacterController extends Controller
{
	public function showCreatePlayerCharacter($id = -1){
		if($id < 0){
			return view('character/createPlayerCharacter', ['character'=>null,
					'skilllevels' => SkillLevel::all(),
					'playerclasses' => PlayerClass::all(),
					'races' => Race::all(),
					'skills' => Skill::all(),
					'resistances' => Resistance::all(),
					'wealth_types' => WealthType::all()
			]);
		}	
    }
    
    public function showCreatePlayerCharBasicInfo($jsonInfo = null){
    	if($jsonInfo == null){
    		return view('character/createPlayerCharBasicInfo',
    				[
    					'users' => User::all(),
    					'skilllevels' => SkillLevel::all(),
    					'playerclasses' => PlayerClass::all(),
    					'races' => Race::all(),
						'wealth_types' => WealthType::all()
    				]);    		
    	}
    }
    
    public function showCreatePlayerCharSkills(){
    	$char_level = $_POST["char_level"];
    	$race_id = $_POST["character_race"];
    	$class_id = $_POST["character_class"];
    	
    	$basic_info = array(
    			'player_id' => $_POST["player_id"],
    			'player_name' => $_POST["player_name"],
    			'char_name' => $_POST["character_name"],
    			'nr_events' => $_POST["nr_events_survived"],
    			'char_level' => $char_level,
    			'race_id' => $race_id,
    			'class_id' => $class_id,
    			'start_ep' => $_POST["start_ep"],
    			'ep_reason' => $_POST["ep_reason"]
    	);
    	
    	$classIdArray = array();
    	$classIdArray[] = $class_id;
    	
    	$skills = ClassController::getClassSkills($char_level, $race_id, $classIdArray);
    	$wealthType = ClassController::getWealthTypeFromClassArray($classIdArray);
		$descentSkills = RaceController::getDescentSkills($race_id);
    	
    	return view('character/createPlayerCharSkills',
    			[
    					'basic_info' => $basic_info,
    					'skills' => $skills,
    					'descent_skills' => $descentSkills,
    					'playerclasses' => PlayerClass::all(),
    					'skilllevels' => SkillLevel::all(),
    					'races' => Race::all(),
    					'wealth_types' => WealthType::all(),
    					'char_wealth'=>$wealthType,
    					'char_level' => SkillLevel::find($char_level),
    					'char_race' => Race::find($race_id),
    					'char_class' => PlayerClass::find($class_id),
    					'char_class_id_array' => $classIdArray
    			]
		);
    }
    
    public function showAllCharacters(){
    	$url = route('showall_character');
    	header("Location:".$url);
    	die();
    }
    
    public function showKillCharacter($charId){
    	return view('character/showKillCharacter', ['character' => Character::find($charId)]);
    }
    
    public function doKillCharacter($charId){
    	$character = Character::find($charId);
		$character->is_alive = false;
    	$character->save();
    	
    	$this->showAllCharacters();
    }

    public function showDeleteCharacter($charId){
    	return view('character/showDeleteCharacter', ['character' => Character::find($charId)]);
    }
    
    public function doDeleteCharacter($charId){
    	$character = Character::find($charId);
    	$character->delete();
    	 
    	$this->showAllCharacters();
    }
    
    public function doShowAllPlayerChars(){
    	return view('character/showAllPlayerChar', ['characters'=> Character::all()]);
    }
    
    public function doShowPlayerChar($charId){
    	$character = Character::find($charId);
    	return view('character/showPlayerChar', ['character'=>$character,
    			'overview_skills_string_array' => $character->getOverviewSkillsStringArray()
    	]);
    }
    
    public function showEditPlayerChar($charId){
    	$character = Character::find($charId);
    	$char_descent_skills = $character->getCharDescentSkills();
    	$char_class_skills = $character->getCharClassSkills();
    	$char_non_class_skills = $character->getCharNonClassSkills();
    	$char_free_skills = $character->getCharFreeSkills();
    	
    	$char_descent_skills_ids = array();
    	foreach($char_descent_skills as $descent_skill){
    		$char_descent_skills_ids[] = $descent_skill->id;
    	}
    	$char_class_skills_ids = array();
    	foreach($char_class_skills as $class_skill){
    		$char_class_skills_ids[] = $class_skill->id;
    	}
    	$char_non_class_skills_ids = array();
    	foreach($char_non_class_skills as $non_class_skill){
    		$char_non_class_skills_ids[] = $non_class_skill->id;
    	}
    	$char_free_skills_ids = array();
    	foreach($char_free_skills as $free_skill){
    		$char_free_skills_ids[] = $free_skill->id;
    	}
    	 
    	

    	$classIdArray = $character->getPlayerClassesIdArray();
    	 
    	$allClassSkills = ClassController::getClassSkills($character->getCharLevelId(), $character->char_race->id, $classIdArray, $character->id);
    	$charWealthType = ClassController::getWealthTypeFromClassArray($classIdArray);
    	$allDescentSkills = $character->getDescentSkills();
    	
    	return view('character/showEditPlayerChar', ['character'=>$character,
    			'char_descent_skills_ids' => json_encode($char_descent_skills_ids),
    			'char_class_skills_ids' => json_encode($char_class_skills_ids),
    			'char_non_class_skills_ids' => json_encode($char_non_class_skills_ids),
    			'char_free_skills_ids' => json_encode($char_free_skills_ids),
    			'skills' => $allClassSkills,
    			'descent_skills' => $allDescentSkills,
    			'wealth_types'=> WealthType::all()
    	]);
    }
    
    public function doCreatePlayerChar(){
    	// TODO: check on everything as save.
    	
    	$newChar = new Character();
    	
    	$newChar->name = $_POST['character_name'];
    	$newChar->player_class_id = $_POST['character_class'];
    	$newChar->race_id = $_POST['character_race'];
    	$newChar->user_id = $_POST['player_id'];
    	$newChar->ep_amount = $_POST ['start_ep'];
    	$newChar->is_alive = true;
    	$newChar->is_player_char = true;
    	$newChar->nr_events_survived = $_POST['nr_events_survived'];
    	$newChar->descent_ep_amount = 3;
    	
    	$sparkArray = Character::getSparkArray();
    	$newChar->spark_data = json_encode($sparkArray);    	
    	
    	$newChar->save();
    	
    	// Save descent classes to allow them to be changed by that one
    	// Spark entry
    	$newChar->descentClasses()->sync(Race::find($newChar->race_id)->descent_class_ids);
    	
    	// Handle all selected skills
    	$raceSkillIds = json_decode($_POST['race_skill_list']);
    	$descentSkillIds = json_decode($_POST['descent_skill_list']);
    	$classSkillIds = json_decode($_POST['character_class_skill_list']);
    	$nonClassSkillIds = json_decode($_POST['character_non_class_skill_list']);
    	$allCharSkillIds = array_merge($raceSkillIds,
    			$descentSkillIds,
    			$classSkillIds,
    			$nonClassSkillIds);

    	$allCharSkillSyncArray = array();
    	
    	if(is_array($raceSkillIds)){
    		foreach($raceSkillIds as $raceSkillId){
    			$allCharSkillSyncArray[intval($raceSkillId)] =
    				[	'purchase_ep_cost'=>'0',
    					'is_descent_skill'=> false,
    					'is_out_of_class_skill'=> false
    				];
    		}
    	}
    	
    	if(is_array($descentSkillIds)){
    		foreach($descentSkillIds as $descentSkillId){
    			$allCharSkillSyncArray[intval($descentSkillId)] =
    			[	'purchase_ep_cost'=>Skill::find(intval($descentSkillId))->ep_cost,
    				'is_descent_skill'=> true,
    				'is_out_of_class_skill'=> false
    			];
    		}
    	}
    	
    	if(is_array($classSkillIds)){
    		foreach($classSkillIds as $classSkillId){
    			$allCharSkillSyncArray[intval($classSkillId)] =
    			[	'purchase_ep_cost'=>Skill::find(intval($classSkillId))->ep_cost,
    					'is_descent_skill'=> false,
    					'is_out_of_class_skill'=> false
    			];
    		}
    	}
    	
    	if(is_array($nonClassSkillIds)){
    		foreach($nonClassSkillIds as $nonClassSkillId){
    			$allCharSkillSyncArray[intval($nonClassSkillId)] =
    			[	'purchase_ep_cost'=>2*(Skill::find(intval($nonClassSkillId))->ep_cost),
    					'is_descent_skill'=> false,
    					'is_out_of_class_skill'=> true
    			];
    		}
    	}
    	
    	// sync character skills
    	$newChar->skills()->sync($allCharSkillSyncArray);
    	
    	// now add ep assignment
    	$epAssign = new EpAssignment();
    	$epAssign->amount = $_POST['start_ep'];
    	$epAssign->reason = $_POST['ep_reason'];
    	$epAssign->character_id = $newChar->id;
    	
    	$epAssign->save();
    	
    	$url = route('show_spark_start', ['charId' => $newChar->id]);
		header("Location:".$url);
		die();  	
    }
    
    public function editPlayerCharSubmit(){
    	$character = Character::find($_POST['char_id']);

    	$raceSkillIds = json_decode($_POST['race_skill_list']);
    	$descentSkillIds = json_decode($_POST['descent_skill_list']);
    	$classSkillIds = json_decode($_POST['character_class_skill_list']);
    	$nonClassSkillIds = json_decode($_POST['character_non_class_skill_list']);
    	$allCharSkillIds = array_merge($raceSkillIds,
    			$descentSkillIds,
    			$classSkillIds,
    			$nonClassSkillIds);
    	
    	$allCharSkillSyncArray = array();
    	 
    	if(is_array($raceSkillIds)){
    		foreach($raceSkillIds as $raceSkillId){
    			$allCharSkillSyncArray[intval($raceSkillId)] =
    			[	'purchase_ep_cost'=>'0',
    					'is_descent_skill'=> false,
    					'is_out_of_class_skill'=> false
    			];
    		}
    	}
    	 
    	if(is_array($descentSkillIds)){
    		foreach($descentSkillIds as $descentSkillId){
    			$allCharSkillSyncArray[intval($descentSkillId)] =
    			[	'purchase_ep_cost'=>Skill::find(intval($descentSkillId))->ep_cost,
    					'is_descent_skill'=> true,
    					'is_out_of_class_skill'=> false
    			];
    		}
    	}
    	 
    	if(is_array($classSkillIds)){
    		foreach($classSkillIds as $classSkillId){
    			$allCharSkillSyncArray[intval($classSkillId)] =
    			[	'purchase_ep_cost'=>Skill::find(intval($classSkillId))->ep_cost,
    					'is_descent_skill'=> false,
    					'is_out_of_class_skill'=> false
    			];
    		}
    	}
    	 
    	if(is_array($nonClassSkillIds)){
    		foreach($nonClassSkillIds as $nonClassSkillId){
    			$allCharSkillSyncArray[intval($nonClassSkillId)] =
    			[	'purchase_ep_cost'=>2*(Skill::find(intval($nonClassSkillId))->ep_cost),
    					'is_descent_skill'=> false,
    					'is_out_of_class_skill'=> true
    			];
    		}
    	}
    	 
    	// sync character skills
    	$character->skills()->sync($allCharSkillSyncArray);
    	$url = route('show_character', ['charId' => $character->id]);
    	header("Location:".$url);
    	die();;
    }
    

}
