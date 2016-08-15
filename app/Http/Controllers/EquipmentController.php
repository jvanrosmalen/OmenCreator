<?php

namespace App\Http\Controllers;

use App\Armor;
use App\Shield;
use App\Weapon;
use App\CraftEquipment;
use App\DamageRule;

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
	
	//*** CRAFT EQUIPMENT FUNCTIONS
	public function showCreateCraftEquipment($id = -1){
		$rules = RulesController::getAllRules();
		$item_rules = null;
		
		if($id < 0){
			return view('equipment/craft_equipment/createCraftEquipment', ['craft_equipment'=>null, 'rules' => $rules, 'item_rules' => $item_rules]);
		}
		else {
			$craft_equipment = CraftEquipment::find($id);
			$item_dam_rules = $craft_equipment->dam_rules;
			$item_call_rules = $craft_equipment->call_rules;
			$item_res_rules = $craft_equipment->res_rules;
			$item_stat_rules = $craft_equipment->stat_rules;
			$item_wealth_rules = $craft_equipment->wealth_rules;
			
			$item_rules = [	"dam_rules"=>$item_dam_rules,
							"call_rules"=>$item_call_rules,
							"res_rules"=>$item_res_rules,
							"stat_rules"=>$item_stat_rules,
							"wealth_rules"=>$item_wealth_rules
							];
			
			return view('equipment/craft_equipment/createCraftEquipment', ['craft_equipment'=>$craft_equipment, 'rules' => $rules, 'item_rules'=> json_encode($item_rules)]);
		}
	}
	
	public function showDeleteCraftEquipment($id = -1){
		$craft_equipment = CraftEquipment::find($id);
		return view('equipment/craft_equipment/showDeleteCraftEquipment', ['craft_equipment'=>$craft_equipment]);
	}
	
	public function deleteCraftEquipment($id = -1){
		$craft_equipment = CraftEquipment::find($id);
		
		// delete the relationships with various rules first.
		if(!$craft_equipment->call_rules->isEmpty()){
			$craft_equipment->callRules()->detach();
		}
		if(!$craft_equipment->dam_rules->isEmpty()){
			$craft_equipment->damageRules()->detach();
		}
		if(!$craft_equipment->res_rules->isEmpty()){
			$craft_equipment->resistanceRules()->detach();
		}
		if(!$craft_equipment->stat_rules->isEmpty()){
			$craft_equipment->statisticRules()->detach();
		}
		if(!$craft_equipment->wealth_rules->isEmpty()){
			$craft_equipment->wealthRules()->detach();
		}
	
		// Delete craft equipment from DB table
		$craft_equipment->delete();
		return $this->gotoShowAllCraftEquipment();
	}
	
	public function updateCraftEquipment($id){
		$craft_equipment = CraftEquipment::find($id);
		if($craft_equipment->id == null){
			return "echo 'ID is NULL' ";
		}
	
		$craft_equipment->name = $_POST["craft_equipment_name"];
		$craft_equipment->description = $_POST["craft_equipment_desc"];
		$craft_equipment->price = $_POST["price"];
		
		// Now sync the pivot table.
		$ruleArray = json_decode($_POST["rules_list"]);

		// Remove all old rules
		if($craft_equipment->callRules() != null){
			$craft_equipment->callRules()->detach();
		}
		if($craft_equipment->damageRules() != null){
			$craft_equipment->damageRules()->detach();
		}
		if($craft_equipment->resistanceRules() != null){
			$craft_equipment->resistanceRules()->detach();
		}
		if($craft_equipment->statisticRules() != null){
			$craft_equipment->statisticRules()->detach();
		}
		if($craft_equipment->wealthRules() != null){
			$craft_equipment->wealthRules()->detach();
		}
		
		// Update with new rules
		if($ruleArray!=null && $ruleArray!=''){
			foreach($ruleArray as $rule){
				if(strcasecmp( $rule->type, "call")==0){
					$craft_equipment->callRules()->sync([intval($rule->ruleId)], false);
				} elseif (strcasecmp( $rule->type, "dam")==0){
					$craft_equipment->damageRules()->sync([intval($rule->ruleId)], false);
				} elseif (strcasecmp( $rule->type, "res")==0){
					$craft_equipment->resistanceRules()->sync([intval($rule->ruleId)], false);
				} elseif (strcasecmp( $rule->type, "stat")==0){
					$craft_equipment->statisticRules()->sync([intval($rule->ruleId)], false);
				} elseif (strcasecmp( $rule->type, "wealth")==0){
					$craft_equipment->wealthRules()->sync([intval($rule->ruleId)], false);
				}
			}
		}

		$craft_equipment->save();
		
		return $this->gotoShowAllCraftEquipment();
	}
	
	public function submitCraftEquipmentCreate(){
		$newCraftEquipment = new CraftEquipment();
	
		$newCraftEquipment->name = $_POST["craft_equipment_name"];
		$newCraftEquipment->description = $_POST["craft_equipment_desc"];
		$newCraftEquipment->price = $_POST["price"];

		// First save the new equipment so it has an DB id.
		$newCraftEquipment->save();
		
		// Now sync the pivot table.
		$ruleArray = json_decode($_POST["rules_list"]);
		
		if($ruleArray!=null && $ruleArray!=''){
			foreach($ruleArray as $rule){
				if(strcasecmp( $rule->type, "call")==0){
					$newCraftEquipment->callRules()->sync([intval($rule->ruleId)], false);
				} elseif (strcasecmp( $rule->type, "dam")==0){
					$newCraftEquipment->damageRules()->sync([intval($rule->ruleId)], false);
				} elseif (strcasecmp( $rule->type, "res")==0){
					$newCraftEquipment->resistanceRules()->sync([intval($rule->ruleId)], false);
				} elseif (strcasecmp( $rule->type, "stat")==0){
					$newCraftEquipment->statisticRules()->sync([intval($rule->ruleId)], false);
				} elseif (strcasecmp( $rule->type, "wealth")==0){
					$newCraftEquipment->wealthRules()->sync([intval($rule->ruleId)], false);
				}
			}
		}
	
		return $this->gotoShowAllCraftEquipment();
	}
	
	public function showAllCraftEquipment(){
		$craft_equipments = CraftEquipment::all()->sortBy(function($craft_equipment)
		{
			return $craft_equipment->name;
		});
		return view('equipment/craft_equipment/showAllCraftEquipment', [ "craft_equipments"=>$craft_equipments]);
	}
	
	public function gotoShowAllCraftEquipment(){
		$url = route('showall_craft_equipment');
		header("Location:".$url);
		die();
	}
	//*** END CRAFT EQUIPMENT FUNCTIONS	
}
