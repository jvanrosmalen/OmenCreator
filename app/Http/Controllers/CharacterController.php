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
    
    public function doCreatePlayerChar(){
    	// TODO: check on everything as save.
    	
    	$newChar = new Character();
    	
    	$newChar->name = $_POST['character_name'];
    	$newChar->player_class_id = $_POST['character_class'];
    	$newChar->race_id = $_POST['character_race'];
    	$newChar->user_id = $_POST['player_id'];
    	$newChar->ep_amount = $_POST['start_ep'];
    	$newChar->is_alive = true;
    	$newChar->is_player_char = true;
    	$newChar->nr_events_survived = $_POST['nr_events_survived'];
    	
    	$sparkArray = Character::getSparkArray();
    	$newChar->spark_data = json_encode($sparkArray);    	
    	
    	$newChar->save();
    	
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
    					'is_descent_skill'=> false
    				];
    		}
    	}
    	
    	if(is_array($descentSkillIds)){
    		foreach($descentSkillIds as $descentSkillId){
    			$allCharSkillSyncArray[intval($descentSkillId)] =
    			[	'purchase_ep_cost'=>Skill::find(intval($descentSkillId))->ep_cost,
    				'is_descent_skill'=> true
    			];
    		}
    	}
    	
    	if(is_array($classSkillIds)){
    		foreach($classSkillIds as $classSkillId){
    			$allCharSkillSyncArray[intval($classSkillId)] =
    			[	'purchase_ep_cost'=>Skill::find(intval($classSkillId))->ep_cost,
    					'is_descent_skill'=> false
    			];
    		}
    	}
    	
    	if(is_array($nonClassSkillIds)){
    		foreach($nonClassSkillIds as $nonClassSkillId){
    			$allCharSkillSyncArray[intval($nonClassSkillId)] =
    			[	'purchase_ep_cost'=>2*(Skill::find(intval($nonClassSkillId))->ep_cost),
    					'is_descent_skill'=> false
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
}
