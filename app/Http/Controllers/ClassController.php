<?php

namespace App\Http\Controllers;


use App\SkillLevel;
use App\PlayerClass;
use App\WealthType;

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
}
