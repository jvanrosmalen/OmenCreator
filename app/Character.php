<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Skill;
use App\EpAssignment;
use App\User;
use App\PlayerClass;
use App\Resistance;
use App\Statistic;

class Character extends Model
{
	const STAT_LP_TORSO 	= 1;
	const STAT_LP_LIMBS 	= 2;
	const STAT_WILLPOWER	= 3;
	const STAT_STATUS		= 4;
	const STAT_FOCUS		= 5;
	const STAT_TRAUMA		= 6;
	
	const RES_FEAR	 		= 1;
	const RES_THEFT 		= 2;
	const RES_TRAUMA		= 3;
	const RES_POISON		= 4;
	const RES_MAGIC			= 5;
	const RES_DISEASE		= 6;
	
	public $timestamps = false;
    protected $appends = [	'skills',	
    						'ep_assignments',
    						'char_user',
    						'char_race',
    						'char_level',
    						'lp_torso',
    						'lp_limbs',
    						'willpower',
    						'status',
    						'focus',
    						'trauma',
    						'res_fear',
    						'res_theft',
    						'res_trauma',
    						'res_poison',
				    		'res_magic',
    						'res_disease',
    						'wealth_string'
    						];
    
    public function skills(){
    	return $this->belongsToMany('App\Skill')
    		->withTimeStamps()
    		->withPivot('purchase_ep_cost','is_descent_skill','is_out_of_class_skill');
    }
    
    public function descentClasses(){
    	return $this->belongsToMany('App\PlayerClass', 'character_descent_class');
    }
    
    public function myEpAssigments(){
    	return $this->hasMany('App\EpAssignment');
    }
    
    public function charUser(){
    	return $this->belongsTo('App\User','user_id','id');
    }
    
    public function charRace(){
    	return $this->belongsTo('App\Race','race_id','id');
    }
    
    public function playerClass(){
    	return $this->belongsTo('App\PlayerClass', 'player_class_id', 'id');
    }
    
    public function getDescentClasses(){
    	return Character::find($this->id)->descentClasses()->get();
    }
    
    public function getSkillsAttribute(){
	{
		// To save loading time, only send id, name and pivot value
		// for each prereq entry
		return Character::find($this->id)
								->skills()
								->select(['id','name'])
								->get()
								->each(function($row){
									$row->setHidden(
											['craft_equipments',
											'call_rules',
											'dam_rules',
											'stat_rules',
											'wealth_rules',
											'class_rules',
											'res_rules',
											'skill_level',
											'income_coin',
											'player_classes',
											'player_class_ids',
											'race_prereqs',
											'statistic_prereq',
											'skill_prereqs',
											'skill_group_prereqs',
											'wealth_prereq']);
									});
		}
    }
    
    
    
   	public function getCharDescentSkills(){
   		return Character::find($this->id)->skills()
   					->wherePivot('purchase_ep_cost', '!=', '0')
   					->wherePivot('is_descent_skill', true)
   					->wherePivot('is_out_of_class_skill', false)
   					->get();
   	}
    
   	public function getCharNonClassSkills(){
   		return Character::find($this->id)->skills()
   					->wherePivot('purchase_ep_cost', '!=', '0')
   					->wherePivot('is_descent_skill', false)
   					->wherePivot('is_out_of_class_skill', true)
   					->get();
   	}
   	
   	public function getCharClassSkills(){
   		return Character::find($this->id)->skills()
   					->wherePivot('purchase_ep_cost', '!=', '0')
   					->wherePivot('is_descent_skill', false)
   					->wherePivot('is_out_of_class_skill', false)
   					->get();
   	}
   	
   	public function getCharFreeSkills(){
   		return Character::find($this->id)->skills()
   		->wherePivot('purchase_ep_cost', 0)->get();
   	}
   	
   	public function getEpAssignmentsAttribute(){
//     	return Character::find($this->id)->myEpAssigments()->get();
    	return null;
    }
    
    public function getCharRaceAttribute(){
    	return Character::find($this->id)->charRace()
    						->select(['id','race_name'])
    						->get()
    						->each(function($row){
									$row->setHidden(
											['description',
											'is_player_class',
											'descent_class',
											'call_rules',
								    		'dam_rules',
    							    		'res_rules',
    							    		'stat_rules',
    							    		'wealth_rules',
    							    		'race_skills',
    							    		'race_skill_ids',
    							    		'lp_torso',
    							    		'lp_limbs',
    							    		'willpower',
    							    		'status',
    							    		'focus',
    							    		'trauma',
    							    		'prohibited_classes',
    							    		'descent_classes',
    							    		'descent_class_ids'
    					    				]);
									})[0];
    }
    
    public function getCharUserAttribute(){
    	return Character::find($this->id)->charUser()->get()[0];
    }
    
    public function getCharLevelAttribute(){
    	$nrSurvived = Character::find($this->id)->nr_events_survived;
    	$charLevel = 1;

    	if($nrSurvived >= 3){
    		if($nrSurvived < 8){
    			$charLevel = 2;
    		}else if($nrSurvived < 15){
    			$charLevel = 3;
    		}else {
    			$charLevel = 4;
    		}
    	}
    	
    	return SkillLevel::find($charLevel)->skill_level;
    }
    
    public function getCharLevelId(){
    	$nrSurvived = Character::find($this->id)->nr_events_survived;
    	$charLevel = 1;
    	
    	if($nrSurvived >= 3){
    		if($nrSurvived < 8){
    			$charLevel = 2;
    		}else if($nrSurvived < 15){
    			$charLevel = 3;
    		}else {
    			$charLevel = 4;
    		}
    	}
    	 
    	return $charLevel;
    }
    
    public function getPlayerClassesListString(){
    	$classNameList = Array();
    	$myChar = Character::find($this->id);
    	
    	$classNameList[] = $myChar->playerClass()->get()[0]->class_name;
    	$skillsWithClass = Character::find($this->id)->skills()
    							->has('ClassRules')->get();
    	
    	foreach($skillsWithClass as $skill){
    		foreach($skill->class_rules as $classRule){
    			$classNameList[] = $classRule->player_class->class_name;
    		}
    	}
    	
    	return join(', ', $classNameList);
    }
    
    public function getPlayerClassesIdArray(){
    	$classIdList = Array();
    	$myChar = Character::find($this->id);
    	 
    	$classIdList[] = $myChar->playerClass()->get()[0]->id;
    	$skillsWithClass = Character::find($this->id)->skills()
    	->has('ClassRules')->get();
    	 
    	foreach($skillsWithClass as $skill){
    		foreach($skill->class_rules as $classRule){
    			$classIdList[] = $classRule->player_class->id;
    		}
    	}
    	 
    	return $classIdList;
    }
    
    public function getSpentEpAmount(){
    	$epAmount = 0;
    	
    	foreach(Character::find($this->id)->skills as $skill){
    		$epAmount += $skill->pivot->purchase_ep_cost;
    	}
    	
    	return $epAmount;
    }
    
    public function getSpentDescentEpAmount(){
    	$epAmount = 0;
    	 
    	foreach(Character::find($this->id)->skills()
    			->wherePivot('is_descent_skill', true)->get() as $skill){
    		$epAmount += $skill->pivot->purchase_ep_cost;
    	}
    	 
    	return $epAmount;
    }
    
    public function getLpTorsoAttribute(){
    	$retVal = 0;
    	
    	// Get base from character race
    	$retVal += $this->getRaceStat(self::STAT_LP_TORSO);
    	
    	// Add any modifiers from the spark roll
    	$retVal += $this->getSparkStatBonus(self::STAT_LP_TORSO);
    	
    	// Add any modifiers from skills
		$retVal += $this->getSkillStatBonus(self::STAT_LP_TORSO);
    	
    	return $retVal;
    }
    
    public function getLpLimbsAttribute(){
    	return ($this->getLpTorsoAttribute() - 1);
    }
    
    public function getWillpowerAttribute(){
    	$retVal = 0;
    	 
    	// Get base from character race
    	$retVal += $this->getRaceStat(self::STAT_WILLPOWER);
    	 
    	// Add any modifiers from the spark roll
    	$retVal += $this->getSparkStatBonus(self::STAT_WILLPOWER);
    	 
    	// Add any modifiers from skills
    	$retVal += $this->getSkillStatBonus(self::STAT_WILLPOWER);
    	 
    	return $retVal;
    }
    
    public function getStatusAttribute(){
    	$retVal = 0;
    
    	// Get base from character race
    	$retVal += $this->getRaceStat(self::STAT_STATUS);
    
    	// Add any modifiers from the spark roll
    	$retVal += $this->getSparkStatBonus(self::STAT_STATUS);
    
    	// Add any modifiers from skills
    	$retVal += $this->getSkillStatBonus(self::STAT_STATUS);
    
    	return $retVal;
    }
    
    public function getFocusAttribute(){
    	$retVal = 0;
    
    	// Get base from character race
    	$retVal += $this->getRaceStat(self::STAT_FOCUS);
    
    	// Add any modifiers from the spark roll
    	$retVal += $this->getSparkStatBonus(self::STAT_FOCUS);
    
    	// Add any modifiers from skills
    	$retVal += $this->getSkillStatBonus(self::STAT_FOCUS);
    
    	return $retVal;
    }
    
    public function getTraumaAttribute(){
    	$retVal = 0;
    
    	// Get base from character race
    	$retVal += $this->getRaceStat(self::STAT_TRAUMA);
    
    	// Add any modifiers from the spark roll
    	$retVal += $this->getSparkStatBonus(self::STAT_TRAUMA);
    
    	// Add any modifiers from skills
    	$retVal += $this->getSkillStatBonus(self::STAT_TRAUMA);
    
    	return $retVal;
    }
    
    public function getResFearAttribute(){
    	$retVal = 0;
    
    	// Get base from character race
    	$retVal += $this->getRaceRes(self::RES_FEAR);
    
    	// Add any modifiers from the spark roll
    	$retVal += $this->getSparkResBonus(self::RES_FEAR);
    
    	// Add any modifiers from skills
    	$retVal += $this->getSkillResBonus(self::RES_FEAR);
    
    	return $retVal;
    }

    public function getResTheftAttribute(){
    	$retVal = 0;
    
    	// Get base from character race
    	$retVal += $this->getRaceRes(self::RES_THEFT);
    
    	// Add any modifiers from the spark roll
    	$retVal += $this->getSparkResBonus(self::RES_THEFT);
    
    	// Add any modifiers from skills
    	$retVal += $this->getSkillResBonus(self::RES_THEFT);
    
    	return $retVal;
    }
    
    public function getResTraumaAttribute(){
    	$retVal = 0;
    
    	// Get base from character race
    	$retVal += $this->getRaceRes(self::RES_TRAUMA);
    
    	// Add any modifiers from the spark roll
    	$retVal += $this->getSparkResBonus(self::RES_TRAUMA);
    
    	// Add any modifiers from skills
    	$retVal += $this->getSkillResBonus(self::RES_TRAUMA);
    
    	return $retVal;
    }
    
    public function getResPoisonAttribute(){
    	$retVal = 0;
    
    	// Get base from character race
    	$retVal += $this->getRaceRes(self::RES_POISON);
    
    	// Add any modifiers from the spark roll
    	$retVal += $this->getSparkResBonus(self::RES_POISON);
    
    	// Add any modifiers from skills
    	$retVal += $this->getSkillResBonus(self::RES_POISON);
    
    	return $retVal;
    }
    
    public function getResMagicAttribute(){
    	$retVal = 0;
    
    	// Get base from character race
    	$retVal += $this->getRaceRes(self::RES_MAGIC);
    
    	// Add any modifiers from the spark roll
    	$retVal += $this->getSparkResBonus(self::RES_MAGIC);
    
    	// Add any modifiers from skills
    	$retVal += $this->getSkillResBonus(self::RES_MAGIC);
    
    	return $retVal;
    }
    
    public function getResDiseaseAttribute(){
    	$retVal = 0;
    
    	// Get base from character race
    	$retVal += $this->getRaceRes(self::RES_DISEASE);
    
    	// Add any modifiers from the spark roll
    	$retVal += $this->getSparkResBonus(self::RES_DISEASE);
    
    	// Add any modifiers from skills
    	$retVal += $this->getSkillResBonus(self::RES_DISEASE);
    
    	return $retVal;
    }
    
    public function getWealthTypeId(){
    	$wealthId =
    	PlayerClass::find(Character::find($this->id)->player_class_id)->wealth_type_id;
    	$skillsWithWealth = Character::find($this->id)->skills()->has('WealthRules')->get();
    	 
    	foreach($skillsWithWealth as $skill){
    		if($wealthId < $skill->wealth_rules[0]->value_type_id){
    			$wealthId = $skill->wealth_rules[0]->value_type_id;
    		}
    	}
    	
    	return $wealthId;
    }
    
    public function getWealthStringAttribute(){
    	$wealthId = $this->getWealthTypeId();
//     		PlayerClass::find(Character::find($this->id)->player_class_id)->wealth_type_id;
//     	$skillsWithWealth = Character::find($this->id)->skills()->has('WealthRules')->get();
    	
//     	foreach($skillsWithWealth as $skill){
//     		if($wealthId < $skill->wealth_rules[0]->value_type_id){
//     			$wealthId = $skill->wealth_rules[0]->value_type_id;
//     		}
//     	}
    	
    	return WealthType::find($wealthId)->wealth_type;
    }

    public function getOverviewSkillsStringArray(){
    	$retArray = array();
    	$idArray = array();
    	
    	$raceSkills = Character::find($this->id)->charRace()->get()[0]->race_skills;
    	
    	foreach($raceSkills as $raceSkill){
    		$retArray[] = [ 'id'=>$raceSkill->id,
    						'name' => $raceSkill->name,
    						'ep_cost' => "Ras",
    						'description_small' => $raceSkill->description_small,
    						'skill_level' => $raceSkill->skill_level
    		];
    		
    		$idArray[] = $raceSkill->id;
    	}
    	
    	$skills = Character::find($this->id)
								->skills()
								->get();
    	
		foreach($skills as $skill){
			if(in_array($skill->id, $idArray)){
				continue;
			}
			
			$epcost = $skill->pivot->purchase_ep_cost;
			
			if($skill->pivot->is_descent_skill && $epcost > 0){
				$epcost = $epcost." (Afkomst)";
			}
			
			if($epcost <= 0){
				$epcost = "Gratis";
			}
			
			$retArray[] = ['id' => $skill->id,
					'name' => $skill->name,
					'ep_cost' => $epcost,
					'description_small' => $skill->description_small,
					'skill_level' => $skill->skill_level
			];
		}
		
		// sort that stuff on skill name
		$nameArray = array();
		foreach ($retArray as $key => $row) {
			$nameArray[$key] = $row['name'];
		}
		
		array_multisort($nameArray, SORT_ASC, $retArray);
		
		return $retArray;
    }
    
    public function hasAllPrereqs($skill){
    	// Get all character skills
    	$skillSet = Character::find($this->id)->skills;
    	// For easy handling, make an array with just the ids.
    	$skillSetIds = array();
     	foreach($skillSet as $skillSetSkill){
    		$skillSetIds[] = $skillSetSkill->id;
    	}
    	
    	// Now add the race skills
    	$raceSkills = Character::find($this->id)->char_race->race_skills;
    	foreach($raceSkills as $raceSkill){
    		$skillSetIds[] = $raceSkill->id;
    	}
    	
    	// Get all skill prereqs and make set arrays.
    	$skillPrereqs = $skill->skill_prereqs;
    	$skillPrereqsIdsSet1 = array();
    	$skillPrereqsIdsSet2 = array();
    	 
    	foreach($skillPrereqs as $skillPrereq){
    		if($skillPrereq->pivot->prereq_set == 1){
    			$skillPrereqsIdsSet1[] = $skillPrereq->id; 
    		}
    		if($skillPrereq->pivot->prereq_set == 2){
    			$skillPrereqsIdsSet2[] = $skillPrereq->id; 
    		}
    	}
    	
    	// Check set1.
    	$validSet1 = true;
    	foreach($skillPrereqsIdsSet1 as $skillPrereqIdSet1){
    		if(!in_array($skillPrereqIdSet1, $skillSetIds)){
    			// The prereq is not in the character skill set.
    			$validSet1 = false;
    			break;
    		}
    	}
    	
    	$validSet2 = true;
    	// Check set 2 only if 1 has failed.
    	if(!$validSet1){
    		foreach($skillPrereqsIdsSet2 as $skillPrereqIdSet2){
    			if(!in_array($skillPrereqIdSet2, $skillSetIds)){
    				// The prereq is not in the character skill set.
    				$validSet2 = false;
    				break;
    			}
    		}
    	}
    	
    	// TODO Also check prereq sets
    	
    	if($validSet1 || $validSet2){
    		return true;
    	}else{
    		return false;
    	}
    }
    
    public static function getSparkArray(){
    	$retSparkArray = ['title'=>"",
    			'text'=>array(),
    			'money'=>0,
    			'trauma'=>0,
    			'income_bonus'=>0,
    			'descent_ep'=>0,
    			'wealth_bonus' => 0,
    			'statistics'=> array(),
    			'resistances'=> array()
    	]; 
    	
    	foreach(Statistic::all() as $statistic){
    		$retSparkArray['statistics'][$statistic->id] = 0;
    	}
    	
    	foreach(Resistance::all() as $resistance){
    		$retSparkArray['resistances'][$resistance->id] = 0;
    	}
    	
    	return $retSparkArray;
    }
    
    public function getDescentSkills(){
    	$charRace = array();
    	$descentClassIds = array();
    	$descendSkillsArray = ["default"];
    
    	$character = Character::find($this->id);
    	$descentClasses = $character->getDescentClasses();
    	foreach($descentClasses as $descentClass){
    		$descentClassIds[] = $descentClass->id;
    	}
    	$charRace[] = $character->race_id;
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
    
    	return $descendSkillsArray;
    }
    
    public function changeDescentClassFromTo($excludeClassId, $includeClassId){
    	$descentClassIds = array($includeClassId);
    	
    	$character = Character::find($this->id);
    	$descentClasses = $character->getDescentClasses();
    	foreach($descentClasses as $descentClass){
    		if($descentClass->id != $excludeClassId){
    			$descentClassIds[] = $descentClass->id;
    		}
    	}
    	$character->descentClasses()->sync($descentClassIds);
    	$this->handleDescentChange($descentClassIds);
    }
    
    //*****************************************************
    // Private functions
    //*****************************************************
    private function handleDescentChange($newDescentClassIds){
    	$character = Character::find($this->id);
    	// Keep track of changes in a string array
    	$changes = array();
    	
    	// Get all descent skills and check if they still are.
		$descentSkills = $character->skills()->wherePivot('is_descent_skill',true)->get();
		// Keep track of new amount of descentEp
		$descentEp = 0;
		foreach($descentSkills as $descentSkill){
			$isDescentSkill = false;
			
			foreach($descentSkill->player_class_ids as $classId){
				if(in_array($classId, $newDescentClassIds)){
					// This remains a descentSkill
					$isDescentSkill = true;
					$descentEp += $descentSkill->ep_cost;
					break;
				}
			}
			
			if($isDescentSkill){
				// continue to next skill
				continue;
			}
			
			// This skill is no longer a descentSkill. Check if it's a class skill,
			// if not, make it a non-class skill.
			if(in_array($character->player_class_id, $descentSkill->player_class_ids)){
				// It's a player class skill
				$character->skills()->updateExistingPivot($descentSkill->id,
						['is_descent_skill'=>false], true);
				$changes[] = "De vaardigheid ".$descentSkill->name." is voortaan een klasse vaardigheid.";
			}else{
				// It's a non player class skill
				$newEpValue = $descentSkill->ep_cost * 2;
				$character->skills()->updateExistingPivot($descentSkill->id,
						['is_descent_skill'=>false, 
						 'is_out_of_class_skill'=>true,
						 'purchase_ep_cost'=>$newEpValue
						], true);
				$changes[] = "De vaardigheid ".$descentSkill->name." is voortaan een niet-klasse vaardigheid".
					" en kost dus dubbel EP om te behouden.";
			}
		}
		
		// If there is still descent EP to be spent, check all other skills if one
		// might become a descent skill
		if($descentEp < $character->descent_ep_amount){
			// First check all non-class skills. They get you the most profit.
			$nonClassOptions = $character->skills()->
				wherePivot('is_descent_skill', false)->
				wherePivot('is_out_of_class_skill', true)->
				wherePivot('purchase_ep_cost', '>', '0')->get();
			
			$responseStrings = $this->checkForDescentSkills($nonClassOptions, $newDescentClassIds);
			array_merge($changes, $responseStrings);
			
			// Check if there still is a surplus. If so, check the class skills
			if(($character->descent_ep_amount -
					$character->getSpentDescentEpAmount()) > 0){
				$classOptions = $character->skills()->
				wherePivot('is_descent_skill', false)->
				wherePivot('is_out_of_class_skill', false)->
				wherePivot('purchase_ep_cost', '>', '0')->get();
					
				$responseStrings = $this->checkForDescentSkills($classOptions, $newDescentClassIds);
				array_merge($changes, $responseStrings);
			}
			
			return $changes;
		}
    }
    
    private function checkForDescentSkills($skillOptionArray, $newDescentClassIds){
    	$descentOptions = array();
    	$changes = array();
    	$character = Character::find($this->id);
		
    	foreach($skillOptionArray as $skill){
    		foreach($skill->player_class_ids as $classId){
    			if(in_array($classId, $newDescentClassIds)){
    				// This could be a descentSkill. Add to option array.
    				$descentOptions[] = $skill;
    				break;
    			}
    		}
    	}
    		
    	if(sizeof($descentOptions) > 0){
    		// A number of skills could be made descent skill
    		$descentEpSurplus = $character->descent_ep_amount - 
    							$character->getSpentDescentEpAmount();
    		// Counter to avoid deadlock in case of no further options
    		$breakoutCounter = 2*$character->descent_ep_amount;
    		// Change counter to search of the next skill with highest ep cost
    		$epChangeCounter = 0;
    	
    		while($descentEpSurplus > 0 && $breakoutCounter > 0){
    			$optionFound = false;
    				
    			foreach($descentOptions as $index=>$skillOption){
    				if($skillOption->ep_cost == ($descentEpSurplus - $epChangeCounter)){
    					// This one is going to be the one. It eats up the entire
    					// surplus in one go.
    					$character->skills()->updateExistingPivot($skillOption->id,
    							['is_descent_skill'=>true,
    							'is_out_of_class_skill'=>false,
    							'purchase_ep_cost'=>$skillOption->ep_cost
    							], true);
    					$changes[] = "De vaardigheid ".$skillOption->name.
    					" is voortaan een afkomstvaardigheid";
    						
    					$optionFound = true;
    					unset($descentOptions[$index]);
    					break;
    				}
    			}
    				
    			if(!$optionFound){
    				$epChangeCounter++;
    			}
    				
    			$descentEpSurplus = $character->descent_ep_amount -
    								$character->getSpentDescentEpAmount();
    			$breakoutCounter--;
    		}
    	}
    		
    	return $changes;    	
    }
    
    private function getRaceStat($statConstant){
    	$retVal = -10;
    	
    	// Get base from character race
    	$race = Character::find($this->id)->charRace()->get()[0];
    	
    	switch($statConstant){
    		case self::STAT_LP_TORSO:
    			$retVal = $race->lp_torso;
    			break;
    		case self::STAT_LP_LIMBS:
    			$retVal = $race->lp_limbs;
    			break;
    		case self::STAT_WILLPOWER:
    			$retVal = $race->willpower;
    			break;
    		case self::STAT_STATUS:
    			$retVal = $race->status;
    			break;
    		case self::STAT_FOCUS:
    			$retVal = $race->focus;
    			break;
    		case self::STAT_TRAUMA:
    			$retVal = $race->trauma;
    			break;
    		default:
    			$retVal = -10;
    			break;
    	}
    	
    	return $retVal;
    }
    
    private function getRaceRes($resConstant){
    	$retVal = 0;
    	 
    	// Get base from character race
    	$race = Character::find($this->id)->charRace()->get()[0];
    	$resString = "dummy";
    	
    	switch($resConstant){
    		case self::RES_FEAR:
    			$resString = "Angst";
    			break;
    		case self::RES_THEFT:
    			$resString = "Diefstal";
    			break;
    		case self::RES_TRAUMA:
    			$resString = "Trauma";
    			break;
    		case self::RES_POISON:
    			$resString = "Gif";
    			break;
    		case self::RES_MAGIC:
    			$resString = "Magie";
    			break;
    		case self::RES_DISEASE:
    			$resString = "Ziekte";
    			break;
    		default:
    			break;
    	}
    	
    	foreach($race->res_rules as $resRule){
    		if(strcasecmp(
    				Resistance::find($resRule->resistance_id)->resistance_name,
    				$resString) == 0){
    					$retVal += $resRule->value;
    		}    		
    	}
    	
    	return $retVal;
    }
    
    private function getSkillStatBonus($statConstant){
    	$retVal = 0;
    	$statString = "";
    	
    	switch($statConstant){
    		case self::STAT_LP_TORSO:
    			$statString = "Levenspunten";
    			break;
    		case self::STAT_LP_LIMBS:
    			$statString = "Levenspunten";
    			break;
    		case self::STAT_WILLPOWER:
    			$statString = "Wilskracht";
    			break;
    		case self::STAT_STATUS:
    			$statString = "Status";
    			break;
    		case self::STAT_FOCUS:
    			$statString = "Focus";
    			break;
    		case self::STAT_TRAUMA:
    			$statString = "Trauma";
    			break;
    		default:
    			break;
    	}
    	
    	$skillsWithStat = Character::find($this->id)->skills()->has('StatisticRules')->get();
    	
    	foreach($skillsWithStat as $skill){
    	
    		foreach($skill->stat_rules as $statRule){
    			if(strcasecmp(
    					Statistic::find($statRule->statistic_id)->statistic_name,
    					$statString) == 0){
    					$retVal += $statRule->value;
    			}
    		}
    	}
    	
    	return $retVal;
    }
    
    private function getSkillResBonus($resConstant){
    	$retVal = 0;
        $resString = "dummy";
    	
    	switch($resConstant){
    		case self::RES_FEAR:
    			$resString = "Angst";
    			break;
    		case self::RES_THEFT:
    			$resString = "Diefstal";
    			break;
    		case self::RES_TRAUMA:
    			$resString = "Trauma";
    			break;
    		case self::RES_POISON:
    			$resString = "Gif";
    			break;
    		case self::RES_MAGIC:
    			$resString = "Magie";
    			break;
    		case self::RES_DISEASE:
    			$resString = "Ziekte";
    			break;
    		default:
    			break;
    	}
    	 
    	$skillsWithRes = Character::find($this->id)->skills()->has('ResistanceRules')->get();
    	 
    	foreach($skillsWithRes as $skill){
    		 
    		foreach($skill->res_rules as $resRule){
    			if(strcasecmp(
    					Resistance::find($resRule->resistance_id)->resistance_name,
    					$resString) == 0){
    						$retVal += $resRule->value;
    			}
    		}
    	}
    	 
    	return $retVal;
    }
    
    private function getSparkStatBonus($statConstant){
    	$retVal = 0;
    	 
    	$spark_data = json_decode(Character::find($this->id)->spark_data);
    	if(isset($spark_data->statistics->$statConstant)){
    		$retVal += $spark_data->statistics->$statConstant;
    	}
    	
    	if($statConstant == self::STAT_TRAUMA){
    		$retVal += $spark_data->trauma;
    	}
    	
    	return $retVal;
    }
    
    private function getSparkResBonus($resConstant){
    	$retVal = 0;

    	$spark_data = json_decode(Character::find($this->id)->spark_data);
    	if(isset($spark_data->resistances->$resConstant)){
    		$retVal += $spark_data->resistances->$resConstant;
    	}
    	 
    	return $retVal;
    }
}
