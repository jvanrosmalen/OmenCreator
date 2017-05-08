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
    			]
		);
    }
    
    public function showAllCharacter(){
    	return view('/');
    }
}
