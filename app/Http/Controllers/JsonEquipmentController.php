<?php

namespace App\Http\Controllers;

use Request;
use Response;
use App\Armor;
use App\Shield;

class JsonEquipmentController extends Controller
{
	public function checkArmorName(){
		// True means the name already exists.
		// False will be returned when:
		// - the name does not exist
		// - the name is the same as the id of the armor that is checked.
		$name = "";
		$id = 0;
		$retBool = false;
		
		if(Request::has('name')){
			$name = Request::input('name');
		}
		
		if(Request::has('armor_id')){
			$id = Request::input('armor_id');
		}

		$armors = Armor::where('name', '=', $name)->get();

		if(sizeof($armors)>0 && $armors[0]->id != $id){
			$retBool = true;
		}
		
		return Response::json(json_encode($retBool));
	}
	
	public function checkShieldName(){
		// True means the name already exists.
		// False will be returned when:
		// - the name does not exist
		// - the name is the same as the id of the armor that is checked.
		$name = "";
		$id = 0;
		$retBool = false;
	
		if(Request::has('name')){
			$name = Request::input('name');
		}
	
		if(Request::has('shield_id')){
			$id = Request::input('shield_id');
		}
	
		$shields = Shield::where('name', '=', $name)->get();
	
		if(sizeof($shields)>0 && $shields[0]->id != $id){
			$retBool = true;
		}
	
		return Response::json(json_encode($retBool));
	}
}
