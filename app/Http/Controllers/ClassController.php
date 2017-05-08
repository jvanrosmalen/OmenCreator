<?php

namespace App\Http\Controllers;


use App\SkillLevel;
use App\PlayerClass;
use App\WealthType;
use App\Skill;

use Illuminate\Support\Facades\Input;

class ClassController extends Controller
{
	public function showCreateClass($id = -1){
		if($id < 0){
			return view('class/createClass', ['class'=>null,
					'wealth_types' => WealthType::all(),
			]);
		}
		else {
			$class = PlayerClass::find($id);
				
			return view('class/createClass', ['class'=>$class,
					'wealth_types' => WealthType::all(),
			]);
		}
	}
	
	public function showDeleteClass($id = -1){
		$class = PlayerClass::find($id);
		return view('class/showDeleteClass', ['class'=>$class]);
	}
	
	public function deleteClass($id = -1){
		$class = PlayerClass::find($id);
		
		// Delete generic class from DB table
		$class->delete();
		return $this->gotoShowAllClass();
	}
	
	public function updateClass($id){
		$class = PlayerClass::find($id);
		if($class->id == null){
			return "echo 'ID is NULL' ";
		}
	
		$class->class_name = $_POST["class_name"];
		$class->description = $_POST["class_desc"];
		$class->is_player_class = isset($_POST['isPlayerClass']);
		$class->wealth_type_id = isset($_POST["class_wealth"])?$_POST["class_wealth"]:1;
		
		$class->save();
		
		return $this->gotoShowAllClass();
	}
	
	public function submitClassCreate(){
		$newClass = new PlayerClass();
	
		$newClass->class_name = $_POST["class_name"];
		$newClass->description = $_POST["class_desc"];
		$newClass->is_player_class = isset($_POST['isPlayerClass']);
		$newClass->wealth_type_id = isset($_POST["class_wealth"])?$_POST["class_wealth"]:1;
		
		// First save the new class so it has an DB id.
		$newClass->save();
		
		return $this->gotoShowAllClass();
	}
	
	public function showAllClass(){
		$classes = PlayerClass::all()->sortBy(function($class)
		{
			return $class->class_name;
		});
		return view('class/showAllClasses', [ "classes"=>$classes]);
	}
	
	public function gotoShowAllClass(){
		$url = route('showall_class');
		header("Location:".$url);
		die();
	}    //
	
	public static function getClassSkills($charLevel, $char_race, $classIdArray){
		$classSkills = [];
		$nonClassSkills = [];
		$charRace = array();
		$charRace[] = $char_race;
		$retData = ['classSkills'=>[],'nonClassSkills'=>[]];
	
		if(sizeof($classIdArray) > 0){
			$classSkills = Skill::whereHas('playerClasses',function($query) use( $classIdArray){
				$query->whereIn('id', $classIdArray)
				->orWhere('id','=', 1);
			})
			->where(function($query) use ($charRace){
				$query->whereHas('racePrereqs', function($q)use($charRace)
				{$q->whereIn( 'id', $charRace );})
				->orWhereHas('racePrereqs', function($q){$q;}, '<', 1);
			}
			)
			->where('skill_level_id','<=',$charLevel)
			->orderBy('name', 'asc')
			->get()
			;
			$nonClassSkills = Skill::whereDoesntHave('playerClasses',function($query) use( $classIdArray){
				$query->whereIn('id', $classIdArray)
				->orWhere('id','=',1);
			})
			->where(function($query) use ($charRace){
				$query->whereHas('racePrereqs', function($q)use($charRace)
				{$q->whereIn( 'id', $charRace );})
				->orWhereHas('racePrereqs', function($q){$q;}, '<', 1);
			}
			)
			->where('skill_level_id','<=',$charLevel)
			->orderBy('name', 'asc')
			->get();
	
			foreach ($nonClassSkills as $nonClassSkill	){
				$nonClassSkill->ep_cost = $nonClassSkill->ep_cost*2;
			}
		}
	
		$retData['classSkills'] = $classSkills;
		$retData['nonClassSkills'] = $nonClassSkills;
	
		return $retData;
	}
	
	public static function getWealthTypeFromClassArray($classIdArray){
		$wealth_level = 1;

		foreach($classIdArray as $classId){
			if(PlayerClass::find($classId)->wealth_type_id > $wealth_level){
				$wealth_level = PlayerClass::find($classId)->wealth_type_id;
			}
		}
		
		return WealthType::find($wealth_level);
	}
}
