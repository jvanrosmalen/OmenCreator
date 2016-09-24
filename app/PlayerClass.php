<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerClass extends Model
{
    public $timestamps = false;

    public function skills(){
    	return $this->belongsToMany('App\Skill');
    }
}
