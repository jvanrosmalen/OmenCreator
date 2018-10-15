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
use App\Faith;
use Dompdf\Dompdf;
use Storage;
use Auth;
use Response;
use PDF;

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
						'char_class_id_array' => $classIdArray,
						'faiths' => Faith::all()
    			]
		);
    }
    
    public function showAllCharacters(){
    	$url = route('showall_character');
    	header("Location:".$url);
    	die();
    }
    
    public function showKillCharacter($charId){
    	return view('character/showKillCharacter',
    			['character' => Character::find($charId)]);
    }
    
    public function doKillCharacter($charId){
    	$character = Character::find($charId);
		$character->is_alive = false;
    	$character->save();
    	
    	$this->showAllCharacters();
    }

    public function showRaiseCharacter($charId){
    	return view('character/showRaiseCharacter',
    			['character' => Character::find($charId)]);
    }

    public function doRaiseCharacter($charId){
    	$character = Character::find($charId);
    	$character->is_alive = true;
    	$character->save();
    	 
    	$this->showAllCharacters();
    }    
    
    public function showDeleteCharacter($charId){
    	return view('character/showDeleteCharacter', ['character' => Character::find($charId)]);
    }
    
    public function doDeleteCharacter($charId){
    	$character = Character::find($charId);
		$character->delete();
		
		// Delete the entry in the storage chardocs drive
		if(Storage::disk('chardocs')->exists($charId)){
			Storage::disk('chardocs')->deleteDirectory($charId);
		}
    	 
    	$this->showAllCharacters();
    }
    
    public function doShowAllPlayerChars(){
    	$user = Auth::user();
    	$active_chars = Character::where('is_alive', true)
    						->where('is_player_char', true)
    						->where('is_active', true)
    						->get();
    	$inactive_chars = Character::where('is_alive', true)
    						->where('is_player_char', true)
    						->where('is_active', false)
    						->get();
    	$dead_chars = Character::where('is_alive', false)
    						->where('is_player_char', true)
							->get();
		$all_chars = Character::where('is_player_char', true)->get();

    	return view('character/showAllPlayerChar',
    			['active_chars'=> $active_chars,
    			'inactive_chars'=> $inactive_chars,
				'dead_chars'=>$dead_chars,
				'all_chars' =>$all_chars,
    			'user'=>$user
    			]);
    }
    
    public function doShowPlayerChar($charId){
		$character = Character::find($charId);
		$skill_handout_objects = array();
		$char_docs = array();

		$handoutSkills = $character->skills()->whereNotNull("skill_handout")->where('skill_handout', '!=', '')->get();

		foreach($handoutSkills as $handoutSkill){
			$skill_handout_objects[] = ["skill_id" => $handoutSkill->id, "handout_name" => $handoutSkill->skill_handout];
		}

    	return view('character/showPlayerChar', ['character'=>$character,
				'overview_skills_string_array' => $character->getOverviewSkillsStringArray(),
				'skill_handouts' => $skill_handout_objects,
				'char_docs' => $char_docs
    	]);
    }
    
    public function showMyCharacter(){
    	$user = Auth::user();
    	
    	if($user != null){
    		$character = Character::where('user_id', '=', $user->id )
    			->where('is_alive', true)
    			->where('is_player_char', true)
    			->first();
    		
    		if($character != null){
				$skill_handout_objects = array();
				$char_docs = array();

				$handoutSkills = $character->skills()->whereNotNull("skill_handout")->where('skill_handout', '!=', '')->get();
		
				foreach($handoutSkills as $handoutSkill){
					$skill_handout_objects[] = ["skill_id" => $handoutSkill->id, "handout_name" => $handoutSkill->skill_handout];
				}

		    	return view('character/showPlayerChar', ['character'=>$character,
		    			'overview_skills_string_array' => $character->getOverviewSkillsStringArray(),
						'skill_handouts' => $skill_handout_objects,
						'char_docs' => $char_docs
						]);
    		}else{
    			return view('character/showNoPlayerChar');
    		}
    	}else{
    		return redirect('/illegal_link');
    	}
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
				'wealth_types'=> WealthType::all(),
				'faiths' => Faith::all()
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
		$newChar->is_active = true;
		$newChar->faith_id = $_POST['character_faith'];
		$newChar->title = $_POST['character_title'];
    	
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
		
		// Create an entry in the storage chardocs drive
		Storage::makeDirectory('chardocs/'.$newChar->id.'/');
    	
    	$url = route('show_spark_start', ['charId' => $newChar->id]);
		header("Location:".$url);
		die();  	
    }
    
    public function editPlayerCharSubmit(){
		$character = Character::find($_POST['char_id']);
		
		$character->faith_id = $_POST['character_faith'];
		$character->title = $_POST['character_title'];
		$character->extra_info = $_POST['extra_info'];

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
		$character->save();
    	$url = route('show_character', ['charId' => $character->id]);
    	header("Location:".$url);
    	die();;
    }

	public function generateCombatSheet($id){
		$character = Character::find($id);
		$pdf = \PDF::loadView('character.charCombatSheet', compact('character'));
		$pdf->setPaper('A4', 'landscape');
		return $pdf->download('combatsheet_'.$character->name.'.pdf');
	}

	public function generateSkillOverview($id){
		$character = Character::find($id);
		$skills = $character->getSkillsWithLongDescription();
		$pdf = \PDF::loadview('character.charSkillOverview', compact('character', 'skills'));
		$pdf->setPaper('A4', 'portrait');
		return $pdf->download('vaardigheden_'.$character->name.'.pdf');
	}


	public function showCharEp($charId){
		return view('/character/showCharacterEp',
				['character'=>Character::find($charId)]);
	}
	
	public function removeCharEp(){
		$charId = $_POST['charId'];
		$assignId = $_POST['assignmentId'];
		
		$character = Character::find($charId);
		$ep_assignment = EpAssignment::find($assignId);
		
		if($character == null || $ep_assignment==null){
			$this->showAllCharacters();
		}
		
		$ep_assignment->delete();
		
		// Update Ep for character
		$count = 0;
		foreach($character->ep_assignments as $assignment){
			$count += $assignment->amount;
		}
		$character->ep_amount = $count;
		$character->save();
		
		return view('/character/showCharRemoveEpSuccess',
				[ 'character'=>$character,
				'ep_assignment'=>$ep_assignment
				]);
	}
	
	public function doCharAddEp(){
		$charId = $_POST['charId'];
		$ep_amount = $_POST['ep_amount'];
		if(isset($_POST['ep_reason'])){
			$ep_reason = $_POST['ep_reason'];
		}else{
			$ep_reason = "";
		}
		if(isset($_POST['event_survived'])){
			$event_survived = $_POST['event_survived'];
		} else {
			$event_survived = false;
		}
		$character = Character::find($charId);
		
		foreach($character->ep_assignments as $assignment){
			if(strcmp($assignment->reason, $ep_reason)==0
					&& $assignment->amount == $ep_amount
					&& (strtotime(date("Y-m-d")) - strtotime($assignment->created_at)) < 300
			){
				// Probably the same assignment, due to reload or something.
				// return immediately without updating character
				return view('/character/showCharacterAddEpSuccess',
						['character'=>$character,
								'ep_amount'=>$ep_amount,
								'ep_reason'=>$ep_reason,
								'ep_total'=>($character->ep_amount + $character->descent_ep_amount)
						]);
			}
		}
		
		$character->ep_amount = $character->ep_amount + $ep_amount; 
		
		if($event_survived){
			$character->nr_events_survived = $character->nr_events_survived + 1;
		}

		$character->save();
		
		$epAssign = new EpAssignment();
		$epAssign->amount = $ep_amount;
		$epAssign->reason = $ep_reason;
		$epAssign->character_id = $charId;
		 
		$epAssign->save();
		
		return view('/character/showCharacterAddEpSuccess',
				['character'=>$character,
				'ep_amount'=>$ep_amount,
				'ep_reason'=>$ep_reason,
				'ep_total'=>($character->ep_amount + $character->descent_ep_amount)
				]);
	}

	public function downloadHandout($charId, $skillId, $handoutName){
		$current_user = Auth::user();
		$char = Character::find($charId);

		if(
			($current_user->is_admin || $current_user->is_story_telling) ||
			($char->user_id === $current_user->id)
		){
			$file = Storage::disk('handouts')->getDriver()->getAdapter()->applyPathPrefix($skillId.'/'.$handoutName);

			$headers = [
				'Content-Type' => 'application/pdf',
			];

			return Response::download($file, $handoutName, $headers);
		} else {
			return redirect('/illegal_link');
		}
	}

	public function downloadCharacterDocument($charId, $docName){
		return redirect('/illegal_link');
	}
}
