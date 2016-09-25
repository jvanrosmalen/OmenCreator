var AjaxInterface = new function(){
	var self = this;
	
	self.getSkillLevelsClasses = function(levels, classes, selected, callback){
		$.ajax({
			url: "jsonskill",
			type: "GET",
			data: {"levels":levels, "classes":classes, "selected":selected},
			success: function(data){
				callback(data);
			},
			error: function(){
				console.log("JSON error");
			}
		});
	};
	
	self.getFullSkillDetails = function(id, callback){
		$.ajax({
			url: "get_skill_details",
			type: "GET",
			data: {"id":id},
			success: function(data){
				
				var retData = JSON.parse(data);
				var requiresMentor =
					(retData["skill"]["mentor_required"]==0?false:true);
				
				var retSkill = new Skill(
						retData["skill"]["id"],
						retData["skill"]["name"],
						retData["skill"]["ep_cost"],
						retData["skill"]["level"],
						retData["skill"]["skill_level"],
						retData["skill"]["description_small"],
						retData["skill"]["description_long"],
						requiresMentor,
						retData["skill"]["income_amount"],
						retData["skill"]["income_coin"]
					);
				
				retSkill.classes = retData["skill"]["player_classes"];
				retSkill.races = retData["skill"]["player_races"];
				retSkill.craftEquipments = retData["skill"]["craft_equipments"];
				
				
				callback(retSkill);
			},
			error: function(data){
				console.log("JSON error");
			}
		});
	}
	
	self.checkArmorName = function(name, armor_id, callback){
		$.ajax({
			url: "/check_armor_name",
			type: "GET",
			data: {	"name":name,
					"armor_id": armor_id},
			success: function(jsondata){
				var retData = JSON.parse(jsondata);
				
				callback(retData);
			},
			error: function(){
				console.log("JSON error");
			}
		});
	}
	
	self.checkShieldName = function(name, shield_id, callback){
		$.ajax({
			url: "/check_shield_name",
			type: "GET",
			data: {	"name":name,
					"shield_id": shield_id},
			success: function(jsondata){
				var retData = JSON.parse(jsondata);
				
				callback(retData);
			},
			error: function(){
				console.log("JSON error");
			}
		});
	}
	
	self.checkWeaponName = function(name, weapon_id, callback){
		$.ajax({
			url: "/check_weapon_name",
			type: "GET",
			data: {	"name":name,
					"weapon_id": weapon_id},
			success: function(jsondata){
				var retData = JSON.parse(jsondata);
				
				callback(retData);
			},
			error: function(){
				console.log("JSON error");
			}
		});
	}

	self.checkCraftEquipmentName = function(name, craft_equipment_id, callback){
		$.ajax({
			url: "/check_craft_equipment_name",
			type: "GET",
			data: {	"name":name,
					"craft_equipment_id": craft_equipment_id},
			success: function(jsondata){
				var retData = JSON.parse(jsondata);
				
				callback(retData);
			},
			error: function(){
				console.log("JSON error");
			}
		});
	}
	
	self.checkRule = function(ruleStat, ruleOperatorId, ruleValue, callback){
		var type = ruleStat.split("_")[0];
		var id = ruleStat.split("_")[1];
		var myUrl = "/check_rule_submit_"+type;
		
		$.ajax({
			url: myUrl,
			type: "GET",
			data: {	"rule_statistic":id,
					"rule_operator": ruleOperatorId,
					"rule_value": ruleValue},
			success: function(jsondata){
				var retData = JSON.parse(jsondata);
				
				callback(retData);
			},
			error: function(){
				console.log("JSON error");
			}
		});
	}
}