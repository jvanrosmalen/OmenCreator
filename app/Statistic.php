<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
	public $timestamps = false;

	public function skills(){
		return $this->belongsToMany('App\Skill', 'skill_statistic_prereqs', 'statistic_id', 'skill_id');
	}
}
