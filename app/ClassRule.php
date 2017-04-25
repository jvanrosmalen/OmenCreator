<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PlayerClass;

class ClassRule extends Model
{
	protected $appends = [
			'player_class'
	];
	
    public function playerClass(){
    	return $this->belongsTo('App\PlayerClass');
	}
	
	public function getPlayerClassAttribute(){
		return ClassRule::find($this->id)->playerClass()->get()[0];
	}
	
	public function getPlayerClassById(){
		return ClassRule::find($this->id)->playerClass();
	}
	
	public function skills(){
		return $this->belongsToMany('App\Skill');
	}
	
	public function toString(){
		return "Heeft klasse ".$this->player_class->class_name;
	}
}
