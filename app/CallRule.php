<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallRule extends Model
{
    protected $table = 'CallRules';
    public $timestamps = false;
    
    public function rulesOperator()
    {
    	return $this->belongsTo('App\ImmuneDoesOperator', 'RulesOperator', 'operator_name');
    }
    
    public function callType()
    {
    	return $this->belongsTo('App\CallType', 'CallTypes_id', 'id');
    }
	//
}
