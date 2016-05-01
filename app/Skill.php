<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Skill extends Model {
	
	public $timestamps = false;
	
	private $saved = false;
	
	public function save(array $options = []){
		$this->saved = true;
		parent::save($options);
	}
	
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
	
	public function addClassPrereq($class_id){
		if($this->saved){
			return DB::table('skillclassprereqs')->insert(
				['Skills_id' => $this->id, 'PlayerClasses_id' => $class_id]
			);
		}
		
		return false;
	}
	
	public function addRacePrereq($race_id){
		if($this->saved){
			return DB::table('skillraceprereqs')->insert(
					['Skills_id' => $this->id, 'PlayerRaces_id' => $race_id]
					);
		}
		
		return false;		
	}
	
	public function addProfilePrereq($profile_id, $amount){
		if($this->saved){
			return DB::table('skillstatisticprereqs')->insert(
					[
						'Skills_id' => $this->id,
						'Statistics_id' => $profile_id,
						'level' => $amount]
					);
		}
		
		return false;
	}
}
