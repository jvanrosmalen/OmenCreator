<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkillGroup extends Model
{
	public $timestamps = false;
	
	private $saved = false;
	protected $appends = [
							'group_skills'
							];
	
    public function skills(){
    	return $this->belongsToMany('App\Skill');
    }
    
    public function prereqForSkills()
    {
    	return $this->belongsToMany('App\SkillGroup', 'skill_skill_group_prereqs')->withPivot('prereq_set');
    }
    
    public function getFullGroupSkillsDetail(){
    	return SkillGroup::find($this->id)->skills()->get();
    }
    
    public function getGroupSkillsAttribute(){
    	return SkillGroup::find($this->id)
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
