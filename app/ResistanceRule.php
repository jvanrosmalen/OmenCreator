<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResistanceRule extends Model
{
	public $timestamps = false;
	
	public function rulesOperator()
	{
		return $this->belongsTo('App\RulesOperator', 'rules_operator', 'operator');
	}
	
	public function resistance()
	{
		return $this->belongsTo('App\Resistance', 'resistance_id', 'id');
	}
	
	public function craftEquipments(){
		return $this->belongsToMany('App\CraftEquipment');
	}

	public function toString(){
		return Resistance::find($this->resistance_id)->resistance_name." ".$this->rules_operator." ".$this->value;
	}
}
