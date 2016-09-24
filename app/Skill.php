<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Skill extends Model {
	
	public $timestamps = false;
	
	private $saved = false;
	protected $appends = [	'craft_equipments',
							'call_rules',
							'dam_rules',
							'stat_rules',
							'wealth_rules',
							'res_rules',
							'skill_level',
							'coin_value'
						];
	
	public function save(array $options = []){
		$this->saved = true;
		parent::save($options);
	}
	
	public function craftEquipments(){
		return $this->belongsToMany('App\CraftEquipment');
	}
	
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
	
	public function coin(){
		return $this->belongsTo('App\Coin', 'coin_id');
	}
	
	public function playerClasses(){
		return $this->belongsToMany('App\PlayerClass');
	}

	public function playerRaces(){
		return $this->belongsToMany('App\PlayerRace');
	}
	
	public function profilePrereqs(){
		return $this->belongsToMany('App\Statistic', 'skill_statistic_prereqs', 'skill_id', 'statistic_id');
	}
	
	public function skillLevel()
	{
		return $this->belongsTo('App\SkillLevel');
	}
	
	/**
	 * Functions to return various rules through the model
	 * without them being saved in the DB
	 */
	public function getCallRulesAttribute()
	{
		return Skill::find($this->id)->callRules()->get();
	}
	
	public function getDamRulesAttribute()
	{
		return Skill::find($this->id)->damageRules()->get();
	}
	
	public function getResRulesAttribute()
	{
		return Skill::find($this->id)->resistanceRules()->get();
	}
	
	public function getStatRulesAttribute()
	{
		return Skill::find($this->id)->statisticRules()->get();
	}
	
	public function getWealthRulesAttribute()
	{
		return Skill::find($this->id)->wealthRules()->get();
	}
	
	public function getCraftEquipmentsAttribute()
	{
		return Skill::find($this->id)->craftEquipments()->get();
	}
	
	public function getCoinIdAttribute()
	{
// 		$income_coin_result = Skill::find($this->id)->incomeCoin()->get(); 
// 	return $income_coin_result[0]->coin_name;
// 		return Skill::find($this->id)->coin();
		return $this->coin()->get();
	}
	
	public function getPlayerClassesAttribute()
	{
		return Skill::find($this->id)->playerClasses()->get();
	}
	
	public function getPlayerRacesAttribute()
	{
		return Skill::find($this->id)->playerRaces()->get();
	}
	
	public function getProfilePrereqsAttribute()
	{
		return Skill::find($this->id)->profilePrereqs()->get();
	}
	
	public function getSkillLevelAttribute()
	{
		$skill_level_result = Skill::find($this->id)->skillLevel()->get(); 
		return $skill_level_result[0]->skill_level;
	}
	
	// BELOW IS OLD CODE WITHOUT PROPER ORM USED
	/**
	 * 
	 * @param array[int] $levels
	 * 
	 * Returns all skills with the level-ids in the array
	 */
	public static function allLevels($levels) {
		$queryString = "Skill.id = " . $levels [0];
		
		for($index = 1; $index < sizeof ( $levels ); $index ++) {
			$queryString = $queryString . " OR Skill.id = " . $levels [$index];
		}
		
		var_dump ( $queryString );
		
		return DB::table ( 'Skills' )->whereRaw ( $queryString );
	}
}
