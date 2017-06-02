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
	
	const RES_FEAR	 		= 7;
	const RES_THEFT 		= 8;
	const RES_TRAUMA		= 9;
	const RES_POISON		= 10;
	const RES_MAGIC			= 11;
	const RES_DISEASE		= 12;
	
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
    		->withPivot('purchase_ep_cost','is_descent_skill');
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
    
    public function getSpentEpAmount(){
    	$epAmount = 0;
    	
    	foreach(Character::find($this->id)->skills as $skill){
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
    
    public function getWealthStringAttribute(){
    	$wealthId =
    		PlayerClass::find(Character::find($this->id)->player_class_id)->wealth_type_id;
    	$skillsWithWealth = Character::find($this->id)->skills()->has('WealthRules')->get();
    	
    	foreach($skillsWithWealth as $skill){
    		if($wealthId < $skill->wealth_rules[0]->value_type_id){
    			$wealthId = $skill->wealth_rules[0]->value_type_id;
    		}
    	}
    	
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
			
			if($skill->pivot->is_descent_skill){
				$epcost = $epcost." (Afkomst)";
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
    
    public static function getSparkArray(){
    	$retSparkArray = ['roll'=>0,
    			'text'=>"",
    			'money'=>0,
    			'trauma'=>0,
    			'income_bonus'=>0,
    			'wealth_bonus' => 0,
    			'statistics'=> array(),
    			'resistances'=> array()
    	]; 
    	
    	foreach(Statistic::all() as $statistic){
    		$retSparkArray['statistics'][$statistic->id] =
    			$statistic->statistic_name;
    	}
    	
    	foreach(Resistance::all() as $resistance){
    		$retSparkArray['resistances'][$resistance->id] =
    			$resistance->resistance_name;
    	}
    	
    	return $retSparkArray;
    }
    
    //*****************************************************
    // Private functions
    //*****************************************************
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
    	$statString = "";
    	$retVal = 0;
    	 
    	switch($statConstant){
    		case self::STAT_LP_TORSO:
    			$statString = "lp_torso";
    			break;
    		case self::STAT_LP_LIMBS:
    			$statString = "lp_limbs";
    			break;
    		case self::STAT_WILLPOWER:
    			$statString = "willpower";
    			break;
    		case self::STAT_STATUS:
    			$statString = "status";
    			break;
    		case self::STAT_FOCUS:
    			$statString = "focus";
    			break;
    		case self::STAT_TRAUMA:
    			$statString = "trauma";
    			break;
    		default:
    			break;
    	}
    	
    	$spark_data = json_decode(Character::find($this->id)->spark_data);
    	if(is_array($spark_data) && isset($spark_data['statistics'][$statString])){
    		$retVal += $spark_data['statistics'][$statString];
    	}
    	
    	return $retVal;
    }
    
    private function getSparkResBonus($resConstant){
    	$retVal = 0;
    	$resString = "dummy";
    	 
    	switch($resConstant){
    		case self::RES_FEAR:
    			$resString = "fear";
    			break;
    		case self::RES_THEFT:
    			$resString = "theft";
    			break;
    		case self::RES_TRAUMA:
    			$resString = "trauma";
    			break;
    		case self::RES_POISON:
    			$resString = "poison";
    			break;
    		case self::RES_MAGIC:
    			$resString = "magic";
    			break;
    		case self::RES_DISEASE:
    			$resString = "disease";
    			break;
    		default:
    			break;
    	}
    	 
    	$spark_data = json_decode(Character::find($this->id)->spark_data);
    	if(is_array($spark_data) && isset($spark_data['resistances'][$resString])){
    		$retVal += $spark_data['resistances'][$resString];
    	}
    	 
    	return $retVal;
    }
}
