<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Skill;
use App\EpAssignment;

class Character extends Model
{
	public $timestamps = false;
    protected $appends = [	'skills',
    						'ep_assignments'
    						];
    
    public function skills(){
    	return $this->belongsToMany('App\Skill')
    		->withTimeStamps()
    		->withPivot('purchase_ep_cost','is_descent_skill');
    }
    
    public function epAssigments(){
    	return $this->hasMany('App\EpAssignment');
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
    	return Character::find($this)->epAssigments()->get();
    }
}
