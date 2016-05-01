<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Armor;

class EquipmentController extends Controller
{
    public function showCreateArmor(){
    	return view('equipment/armor/createArmor');
	}
	
	public function submitArmorCreate(){
		$newArmor = new Armor();
		
		$newArmor->name = $_POST["armor_name"];
		$newArmor->description = $_POST["armor_desc"];
		$newArmor->price_normal = $_POST["price_normal"];
		$newArmor->price_good = $_POST["price_good"];
		$newArmor->price_master = $_POST["price_master"];
		$newArmor->armor_normal = $_POST["armor_normal"];
		$newArmor->armor_good = $_POST["armor_good"];
		$newArmor->armor_master = $_POST["armor_master"];
		$newArmor->structure_normal = $_POST["structure_normal"];
		$newArmor->structure_good = $_POST["structure_good"];
		$newArmor->structure_master = $_POST["structure_master"];
		
		$newArmor->save();
		
		return view('equipment/armor/createArmor');
	}
	
	public function showAllArmor(){
		return view('equipment/armor/showAllArmor', [ "armors"=>Armor::all()]);
	}
}
