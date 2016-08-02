<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResistanceRule extends Model
{
	public $timestamps = false;
	protected $table = 'ResistanceRules';
	
	public function rulesOperator()
	{
		return $this->belongsTo('App\RulesOperator', 'RulesOperator', 'operator');
	}
	
	public function resistance()
	{
		return $this->belongsTo('App\Resistance', 'Resistances_id', 'id');
	}
	
}
