<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerClass extends Model
{
    public $timestamps = false;

    public function skills(){
    	return $this->belongsToMany('App\Skill');
    }
    
    public function prohibitedRaces(){
    	return $this->belongsToMany('App\Race');
    }
    
    public function descentRaces(){
    	return $this->hasMany('App\Race', 'id', 'descent_class');
    }
}
