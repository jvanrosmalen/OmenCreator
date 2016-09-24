<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
	public $timestamps = false;

	public function skills()
	{
		return $this->hasMany('App\Skill');
	}	
}
