<?php

namespace App\Http\Controllers;

use App\Armor;
use App\Shield;
use App\Weapon;

class EquipmentController extends Controller
{
	// *** ARMOR FUNCTIONS ***
    public function showCreateArmor($id = -1){
    	if($id < 0){
    		return view('equipment/armor/createArmor', ['armor'=>null]);
    	}
    	else {
    		$armor = Armor::find($id);
    		return view('equipment/armor/createArmor', ['armor'=>$armor]);
    	}
	}
	
	public function showDeleteArmor($id = -1){
		$armor = Armor::find($id);
		return view('equipment/armor/showDeleteArmor', ['armor'=>$armor]);
	}

	public function deleteArmor($id = -1){
		$armor = Armor::find($id);
		$armor->delete();
		
		$this->gotoShowAllArmor();
	}
	
	public function updateArmor($id){
		$armor = Armor::find($id);
		
		$armor->name = $_POST["armor_name"];
		$armor->description = $_POST["armor_desc"];
		$armor->price_normal = $_POST["price_normal"];
		$armor->price_good = $_POST["price_good"];
		$armor->price_master = $_POST["price_master"];
		$armor->armor_normal = $_POST["armor_normal"];
		$armor->armor_good = $_POST["armor_good"];
		$armor->armor_master = $_POST["armor_master"];
		$armor->structure_normal = $_POST["structure_normal"];
		$armor->structure_good = $_POST["structure_good"];
		$armor->structure_master = $_POST["structure_master"];
		
		$armor->save();
		
		$this->gotoShowAllArmor();
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
		
		$this->gotoShowAllArmor();
	}
	
	public function showAllArmor(){
		$armors = Armor::all()->sortBy(function($armor)
			{
			    return $armor->name;
			});
		return view('equipment/armor/showAllArmor', [ "armors"=>$armors]);
	}

	public function gotoShowAllArmor(){
		$url = route('showall_armor');
		header("Location:".$url);
		die();
	}
	
	//*** END ARMOR FUNCTIONS ***
	
	//*** SHIELD FUNCTIONS
	public function showCreateShield($id = -1){
		if($id < 0){
			return view('equipment/shield/createShield', ['shield'=>null]);
		}
		else {
			$shield = Shield::find($id);
			return view('equipment/shield/createShield', ['shield'=>$shield]);
		}
	}
	
	public function showDeleteShield($id = -1){
		$shield = Shield::find($id);
		return view('equipment/shield/showDeleteShield', ['shield'=>$shield]);
	}
	
	public function deleteShield($id = -1){
		$shield = Shield::find($id);
		$shield->delete();
		return $this->gotoShowAllShield();
	}
	
	public function updateShield($id){
		$shield = Shield::find($id);
	
		$shield->name = $_POST["shield_name"];
		$shield->description = $_POST["shield_desc"];
		$shield->price_normal = $_POST["price_normal"];
		$shield->price_good = $_POST["price_good"];
		$shield->price_master = $_POST["price_master"];
		$shield->armor_normal = $_POST["armor_normal"];
		$shield->armor_good = $_POST["armor_good"];
		$shield->armor_master = $_POST["armor_master"];
		$shield->structure_normal = $_POST["structure_normal"];
		$shield->structure_good = $_POST["structure_good"];
		$shield->structure_master = $_POST["structure_master"];
	
		$shield->save();

		return $this->gotoShowAllShield();
	}
	
	public function submitShieldCreate(){
		$newShield = new Shield();
	
		$newShield->name = $_POST["shield_name"];
		$newShield->description = $_POST["shield_desc"];
		$newShield->price_normal = $_POST["price_normal"];
		$newShield->price_good = $_POST["price_good"];
		$newShield->price_master = $_POST["price_master"];
		$newShield->armor_normal = $_POST["armor_normal"];
		$newShield->armor_good = $_POST["armor_good"];
		$newShield->armor_master = $_POST["armor_master"];
		$newShield->structure_normal = $_POST["structure_normal"];
		$newShield->structure_good = $_POST["structure_good"];
		$newShield->structure_master = $_POST["structure_master"];
	
		$newShield->save();
	
		return $this->gotoShowAllShield();
	}
	
	public function showAllShield(){
		$shields = Shield::all()->sortBy(function($shield)
			{
			    return $shield->name;
			});
		return view('equipment/shield/showAllShield', [ "shields"=>$shields]);
	}

	public function gotoShowAllShield(){
		$url = route('showall_shield');
		header("Location:".$url);
		die();
	}
	//*** END SHIELD FUNCTIONS
	
	//*** WEAPON FUNCTIONS
	public function showCreateWeapon($id = -1){
		if($id < 0){
			return view('equipment/weapon/createWeapon', ['weapon'=>null]);
		}
		else {
			$weapon = Weapon::find($id);
			return view('equipment/weapon/createWeapon', ['weapon'=>$weapon]);
		}
	}
	
	public function showDeleteWeapon($id = -1){
		$weapon = Weapon::find($id);
		return view('equipment/weapon/showDeleteWeapon', ['weapon'=>$weapon]);
	}
	
	public function deleteWeapon($id = -1){
		$weapon = Weapon::find($id);
		$weapon->delete();
		return $this->gotoShowAllWeapon();
	}
	
	public function updateWeapon($id){
		$weapon = Weapon::find($id);
	
		$weapon->name = $_POST["weapon_name"];
		$weapon->description = $_POST["weapon_desc"];
		$weapon->price_normal = $_POST["price_normal"];
		$weapon->price_good = $_POST["price_good"];
		$weapon->price_master = $_POST["price_master"];
	
		$weapon->save();

		return $this->gotoShowAllWeapon();
	}
	
	public function submitWeaponCreate(){
		$newWeapon = new Weapon();
	
		$newWeapon->name = $_POST["weapon_name"];
		$newWeapon->description = $_POST["weapon_desc"];
		$newWeapon->price_normal = $_POST["price_normal"];
		$newWeapon->price_good = $_POST["price_good"];
		$newWeapon->price_master = $_POST["price_master"];
	
		$newWeapon->save();
	
		return $this->gotoShowAllWeapon();
	}
	
	public function showAllWeapon(){
		$weapons = Weapon::all()->sortBy(function($weapon)
			{
			    return $weapon->name;
			});
		return view('equipment/weapon/showAllWeapon', [ "weapons"=>$weapons]);
	}

	public function gotoShowAllWeapon(){
		$url = route('showall_weapon');
		header("Location:".$url);
		die();
	}
	//*** END WEAPON FUNCTIONS
}
