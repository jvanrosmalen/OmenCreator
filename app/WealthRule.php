<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WealthRule extends Model
{
	public $timestamps = false;
	protected $table = 'wealthrules';

	public function rulesOperator()
	{
		return $this->belongsTo('App\RulesOperator', 'RulesOperator', 'operator');
	}
	
	public function wealth()
	{
		return $this->belongsTo('App\Wealth', 'Wealth_id', 'id');
	}
	
	public function wealthType()
	{
		return $this->belongsTo('App\WealthType', 'ValueType_id', 'id');
	}
}
