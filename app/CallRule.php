<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallRule extends Model
{
    public $timestamps = false;
    
    public function rulesOperator()
    {
    	return $this->belongsTo('App\ImmuneDoesOperator', 'rules_operator', 'operator_name');
    }
    
    public function callType()
    {
    	return $this->belongsTo('App\CallType', 'call_type_id', 'id');
    }
	
    public function craftEquipments(){
    	return $this->belongsToMany('App\CraftEquipment');
    }
    
    public function skills(){
    	return $this->belongsToMany('App\Skill');
    }
    
    public function toString(){
    	return "".$this->rules_operator." ".CallType::find($this->call_type_id)->call_name;
    }
}
