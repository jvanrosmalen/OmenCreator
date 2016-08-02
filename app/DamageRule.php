<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DamageRule extends Model
{
    protected $table = 'DamageRules';
    public $timestamps = false;
    
    public function rulesOperator()
    {
    	return $this->belongsTo('App\ImmuneDoesOperator', 'RulesOperator', 'operator_name');
    }
    
    public function damageType()
    {
    	return $this->belongsTo('App\DamageType', 'DamageTypes_id', 'id');
    }
    
}
