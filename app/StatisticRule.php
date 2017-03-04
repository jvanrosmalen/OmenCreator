<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatisticRule extends Model
{
	public $timestamps = false;

	public function rulesOperator()
	{
		return $this->belongsTo('App\RulesOperator', 'rules_operator', 'operator');
	}
	
	public function statistic()
	{
		return $this->belongsTo('App\Statistic', 'statistic_id', 'id');
	}
	
	public function craftEquipments(){
		return $this->belongsToMany('App\CraftEquipment');
	}
	
	public function skills(){
		return $this->belongsToMany('App\Skill');
	}
	
	public function races(){
		return $this->belongsToMany('App\Race');
	}

	public function statisticName(){
		return Statistic::find($this->statistic_id)->statistic_name;
	}
	
	public function toString(){
		return Statistic::find($this->statistic_id)->statistic_name." ".$this->rules_operator." ".$this->value;
	}
}
?>
