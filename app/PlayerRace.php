<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerRace extends Model
{
    public $timestamps = false;

    public function skills(){
    	return $this->belongsToMany('App\Skill');
    }
}
