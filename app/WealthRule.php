<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WealthRule extends Model
{
	public $timestamps = false;

	public function rulesOperator()
	{
		return $this->belongsTo('App\RulesOperator', 'rules_operator', 'operator');
	}
	
	public function wealth()
	{
		return $this->belongsTo('App\Wealth', 'wealth_id', 'id');
	}
	
	public function wealthType()
	{
		return $this->belongsTo('App\WealthType', 'value_type_id', 'id');
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
	
	public function toString(){
		return Wealth::find($this->wealth_id)->wealth_name." ".$this->rules_operator." ".WealthType::find($this->value_type_id)->wealth_type;
	}
}
