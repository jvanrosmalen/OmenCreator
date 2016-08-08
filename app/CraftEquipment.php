<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CraftEquipment extends Model
{
	public $timestamps = false;
	
	/**
	 * Appends to model definition from the DB
	 */
	protected $appends = [	'call_rules',
							'dam_rules',
							'res_rules',
							'stat_rules',
							'wealth_rules'
							];
	
	public function callRules(){
		return $this->belongsToMany('App\CallRule');
	}
	
	public function damageRules(){
		return $this->belongsToMany('App\DamageRule');
	}
	
	public function resistanceRules(){
		return $this->belongsToMany('App\ResistanceRule');
	}
	
	public function statisticRules(){
		return $this->belongsToMany('App\StatisticRule');
	}
	
	public function wealthRules(){
		return $this->belongsToMany('App\WealthRule');
	}
	
	/**
	 * Functions to return various rules through the model
	 * without them being saved in the DB
	 */
	public function getCallRulesAttribute()
	{
		return CraftEquipment::find($this->id)->callRules()->get();
	}
	
	public function getDamRulesAttribute()
	{
		return CraftEquipment::find($this->id)->damageRules()->get();
	}
	
	public function getResRulesAttribute()
	{
		return CraftEquipment::find($this->id)->resistanceRules()->get();
	}
	
	public function getStatRulesAttribute()
	{
		return CraftEquipment::find($this->id)->statisticRules()->get();
	}

	public function getWealthRulesAttribute()
	{
		return CraftEquipment::find($this->id)->wealthRules()->get();
	}
}
