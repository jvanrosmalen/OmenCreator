<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Skill extends Model {

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
