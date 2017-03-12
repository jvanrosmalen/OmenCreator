var AjaxInterface = new function(){
	var self = this;
	
	self.getSkillLevelsClasses = function(levels, classes, selected, callback){
		$.ajax({
			url: "/get_skill_levels_classes",
			type: "GET",
			data: {"levels":levels, "classes":classes, "selected":selected},
			success: function(data){
				callback(data);
			},
			error: function(data){
				console.log("###########################");
				console.log("JSON error");
				console.log(data.responseText);
				console.log("###########################");
			}
		});
	};
	
	self.getFullSkillDetails = function(id, callback){
		$.ajax({
			url: "/get_skill_details",
			type: "GET",
			data: {"id":id},
			success: function(data){
				
				var retData = JSON.parse(data);
				var retSkill = AjaxInterface.createSkillFromJson(retData["skill"]);
				
				for(var index in retData["skill"]["skill_prereqs"]){
					var prereq = retData["skill"]["skill_prereqs"][index];
					if(prereq["pivot"]["prereq_set"]===1){
						retSkill.skillPrereqs["set1"].push(AjaxInterface.createSkillFromJson(prereq));
					} else {
						retSkill.skillPrereqs["set2"].push(AjaxInterface.createSkillFromJson(prereq));
					}
				}
				
				callback(retSkill);
			},
			error: function(data){
				console.log("###########################");
				console.log("JSON error");
				console.log(data.responseText);
				console.log("###########################");
			}
		});
	}
	
	self.createSkillFromJson = function(skill){
		var requiresMentor =
			(skill["mentor_required"]==0?false:true);
		
		var retSkill = new Skill(
				skill["id"],
				skill["name"],
				skill["ep_cost"],
				skill["level"],
				skill["levelName"],
				skill["description_small"],
				skill["description_long"],
				requiresMentor,
				skill["income_amount"],
				skill["income_coin"],
				skill["statistic_prereq_amount"],
				skill["statistic_prereq"]
			);
		
		retSkill.classes = skill["player_classes"];
		retSkill.races = skill["races"];
		retSkill.craftEquipments = skill["craft_equipments"];
		
		return retSkill;
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
			error: function(data){
				console.log("###########################");
				console.log("JSON error");
				console.log(data.responseText);
				console.log("###########################");
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
			error: function(data){
				console.log("###########################");
				console.log("JSON error");
				console.log(data.responseText);
				console.log("###########################");
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
			error: function(data){
				console.log("###########################");
				console.log("JSON error");
				console.log(data.responseText);
				console.log("###########################");
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
			error: function(data){
				console.log("###########################");
				console.log("JSON error");
				console.log(data.responseText);
				console.log("###########################");
			}
		});
	}
	
	self.checkGenericEquipmentName = function(name, generic_equipment_id, callback){
		$.ajax({
			url: "/check_generic_equipment_name",
			type: "GET",
			data: {	"name":name,
					"generic_equipment_id": generic_equipment_id},
			success: function(jsondata){
				var retData = JSON.parse(jsondata);
				
				callback(retData);
			},
			error: function(data){
				console.log("###########################");
				console.log("JSON error");
				console.log(data.responseText);
				console.log("###########################");
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
			error: function(data){
				console.log("###########################");
				console.log("JSON error");
				console.log(data.responseText);
				console.log("###########################");
			}
		});
	}
}