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
    
    public function getGroupSkillsAttribute(){
    	return SkillGroup::find($this->id)->skills()->get();
    }
}
