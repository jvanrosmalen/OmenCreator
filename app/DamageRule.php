<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DamageRule extends Model
{
    public $timestamps = false;
    
    public function rulesOperator()
    {
    	return $this->belongsTo('App\ImmuneDoesOperator', 'rules_operator', 'operator_name');
    }
    
    public function damageType()
    {
    	return $this->belongsTo('App\DamageType', 'damage_type_id', 'id');
    }
    
    public function craftEquipments(){
    	return $this->belongsToMany('App\CraftEquipment');
    }
    
    public function skills(){
    	return $this->belongsToMany('App\Skill');
    }

    public function toString(){
    	return "".$this->rules_operator." ".DamageType::find($this->damage_type_id)->damage_name." schade";
    }
}
