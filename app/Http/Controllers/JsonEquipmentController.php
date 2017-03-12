<?php

namespace App\Http\Controllers;

use Request;
use Response;
use App\Armor;
use App\Shield;
use App\Weapon;
use App\CraftEquipment;
use App\GenericEquipment;

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

	public function checkWeaponName(){
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
	
		if(Request::has('weapon_id')){
			$id = Request::input('weapon_id');
		}
	
		$weapons = Weapon::where('name', '=', $name)->get();
	
		if(sizeof($weapons)>0 && $weapons[0]->id != $id){
			$retBool = true;
		}
	
		return Response::json(json_encode($retBool));
	}
	
	public function checkCraftEquipmentName(){
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
	
		if(Request::has('craft_equipment_id')){
			$id = Request::input('craft_equipment_id');
		}
	
		$craftEquipments = CraftEquipment::where('name', '=', $name)->get();
	
		if(sizeof($craftEquipments)>0 && $craftEquipments[0]->id != $id){
			$retBool = true;
		}
	
		return Response::json(json_encode($retBool));
	}
	
	public function checkGenericEquipmentName(){
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
	
		if(Request::has('generic_equipment_id')){
			$id = Request::input('generic_equipment_id');
		}
	
		$genericEquipments = GenericEquipment::where('name', '=', $name)->get();
	
		if(sizeof($genericEquipments)>0 && $genericEquipments[0]->id != $id){
			$retBool = true;
		}
	
		return Response::json(json_encode($retBool));
	}
}
