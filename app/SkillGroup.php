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
    
    public function getAttributeGroupSkills(){
    	return $this->skill();
    }
}
