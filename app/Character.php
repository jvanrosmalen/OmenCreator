<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Skill;
use App\EpAssignment;
use App\User;
use App\PlayerClass;

class Character extends Model
{
	public $timestamps = false;
    protected $appends = [	'skills',	
    						'ep_assignments',
    						'char_user',
    						'char_race',
    						'char_level'
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
}
