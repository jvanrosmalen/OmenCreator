<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use PhpParser\Node\Expr\Array_;

class Skill extends Model {
	
	public $timestamps = false;
	
	private $saved = false;
	protected $appends = [	'craft_equipments',
							'call_rules',
							'dam_rules',
							'stat_rules',
							'wealth_rules',
							'class_rules',
							'res_rules',
							'skill_level',
							'income_coin',
							'player_classes',
							'player_class_ids',
							'race_prereqs',
							'statistic_prereq',
							'skill_prereqs',
							'skill_group_prereqs',
							'wealth_prereq'
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
	
	public function classRules(){
		return $this->belongsToMany('App\ClassRule');
	}
	
	public function incomeCoin(){
		return $this->belongsTo('App\Coin');
	}
	
	public function statisticPrereq(){
		return $this->belongsTo('App\Statistic');
	}
	
	public function wealthPrereq(){
		return $this->belongsTo('App\WealthType', 'wealth_prereq_id');
	}
	
	public function playerClasses(){
		return $this->belongsToMany('App\PlayerClass');
	}

	public function racePrereqs(){
		return $this->belongsToMany('App\Race', 'race_prereq_skill', 'skill_id', 'race_id');
	}
	
	public function raceSkillForRaces(){
		return $this->belongsToMany('App\Race', 'race_race_skill', 'skill_id', 'race_id');
	}
	
	public function profilePrereqs(){
		return $this->belongsToMany('App\Statistic', 'skill_statistic_prereqs', 'skill_id', 'statistic_id');
	}
	
	public function skillLevel()
	{
		return $this->belongsTo('App\SkillLevel');
	}
	
	public function skillPrereqs()
	{
		return $this->belongsToMany('App\Skill', 'skill_skill_prereqs', 'skill_id', 'skills_prereq_id')->withPivot('prereq_set');
	}
	
	public function skillGroupPrereqs()
	{
		return $this->belongsToMany('App\SkillGroup', 'skill_skill_group_prereqs')->withPivot('prereq_set');
	}
	
	public function belongsToSkillGroups(){
		return $this->belongsToMany('App\SkillGroup');
	}
	
	public function  prereqOfSkills(){
		return $this->belongsToMany('App\Skill', 'skill_skill_prereqs', 'skills_prereq_id', 'skill_id')->withPivot('prereq_set');
	}
	
	public function belongsToCharacters(){
		return $this->belongsToMany('App\Character')
		->withTimeStamps()
		->withPivot('purchase_ep_cost','is_descent_skill','is_out_of_class_skill');
	}
	
	/**
	 * Functions to return various rules through the model
	 * without them being saved in the DB
	 */
	public function getFullSkillPrereqs()
	{
		return Skill::find($this->id)->skillPrereqs()->get();
	}

	public function getSkillPrereqsAttribute()
	{
		// To save loading time, only send id, name and pivot value
		// for each prereq entry
		return Skill::find($this->id)
								->skillPrereqs()
								->select(['id','name'])
								->get()
								->each(function($row){
									$row->setHidden(
											['craft_equipments',
											'call_rules',
											'dam_rules',
											'stat_rules',
											'wealth_rules',
											'class_rules',
											'res_rules',
											'skill_level',
											'income_coin',
											'player_classes',
											'player_class_ids',
											'race_prereqs',
											'statistic_prereq',
											'skill_prereqs',
											'skill_group_prereqs',
											'wealth_prereq']);
									});
	}
	
	public function getSkillGroupPrereqsAttribute()
	{
		return Skill::find($this->id)->skillGroupPrereqs()->get();
	}
	
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
	
	public function getClassRulesAttribute()
	{
		return Skill::find($this->id)->classRules()->get();
	}
	
	public function getIncomeCoinAttribute()
	{
		$result = Skill::find($this->id)->incomeCoin()->get();
		
		if(sizeof($result)> 0){
			return $result[0]->coin;
		} else {
			return "onbekende munt";
		}
	}
	
	public function getStatisticPrereqAttribute()
	{
		$result = Skill::find($this->id)->statisticPrereq()->get();
		
		if(sizeof($result)> 0){
			return $result[0]->statistic_name;
		} else {
			return "onbekende statistiek";
		}
	}
	
	public function getWealthPrereqAttribute()
	{
		return Skill::find($this->id)->wealthPrereq()->get();
	}
	
	public function getPlayerClassesAttribute()
	{
		$retArray = array();
		$resultArray = Skill::find($this->id)->playerClasses()->get(); 
		
		foreach($resultArray as $i=>$result){
			array_push($retArray, $result->class_name);
		}
		
		return $retArray;
	}
	
	public function getPlayerClassIdsAttribute()
	{
		$retArray = array();
		$resultArray = Skill::find($this->id)->playerClasses()->get();
	
		foreach($resultArray as $i=>$result){
			array_push($retArray, $result->id);
		}
	
		return $retArray;
	}
	
	public function getRacePrereqsAttribute()
	{
		return Skill::find($this->id)->racePrereqs()->get();
	}
	
	public function getProfilePrereqsAttribute()
	{
		return Skill::find($this->id)->profilePrereqs()->get();
	}
	
	public function getSkillLevelAttribute()
	{
		$skill_level_result = Skill::find($this->id)->skillLevel()->get();
		
		if( sizeof($skill_level_result)> 0){
			return $skill_level_result[0]->skill_level;
		} else {
			return "onbekend skill niveau";
		}
	}
	
	public function getCraftEquipmentsAttribute()
	{
		$retArray = array();
		$resultArray = Skill::find($this->id)->craftEquipments()->get();
	
		foreach($resultArray as $i=>$result){
			array_push($retArray, $result->name);
		}
	
		return $retArray;
	}
	
	public function isPrereqOf(){
		return Skill::find($this->id)->prereqOfSkills()->get();
	}
	
	public function ownedByActiveCharacters(){
		return Skill::find($this->id)->belongsToCharacters()->where('is_active', true)
		->where('is_alive', true)->orderBy('name')->get()->each(function($row){
			$row->setHidden(
					['skills',	
					'ep_assignments',
					'char_faith',
					'char_level',
					'lp_torso',
					'lp_limbs',
					'willpower',
					'status',
					'focus',
					'trauma',
					'res_fear',
					'res_theft',
					'res_trauma',
					'res_poison',
					'res_magic',
					'res_disease',
					'wealth_string',
					'spark_data',
					'link_to_background']);
			});;
	}

	public function ownedByPlayers(){
		return Skill::find($this->id)->belongsToCharacters()->get();
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
