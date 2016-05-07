<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatisticRule extends Model
{
	public $timestamps = false;
	protected $table = 'statisticrules';

	public function rulesOperator()
	{
		return $this->belongsTo('App\RulesOperator', 'RulesOperator', 'operator');
	}
	
	public function statistic()
	{
		return $this->belongsTo('App\Statistic', 'Statistics_id', 'id');
	}
}
