var AjaxInterface = new function(){
	var self = this;
	
	self.getSkillLevelsClasses = function(levels, classes, selected, callback){
		$.ajax({
			url: GLOBAL_BASE+"/get_skill_levels_classes",
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
			url: GLOBAL_BASE+"/get_skill_details",
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
				for(var index in retData["skill"]["skill_group_prereqs"]){
					var prereq = retData["skill"]["skill_group_prereqs"][index];
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
	
	self.getPlayersWithSkill = function(skillId, callback){
		$.ajax({
			url: GLOBAL_BASE+"/get_players_with_skill",
			type: "GET",
			data: {"skillid":skillId},
			success: function(data){
				
				var retData = JSON.parse(data);
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

	self.createSkillFromJson = function(skill){
		var requiresMentor =
			(skill["mentor_required"]==0?false:true);
		
		var retSkill = new Skill(
				skill["id"],
				skill["name"],
				skill["ep_cost"],
				skill["skill_level_id"],
				skill["skill_level"],
				skill["description_small"],
				skill["description_long"],
				requiresMentor,
				skill["income_amount"],
				skill["income_coin"],
				skill["statistic_prereq_amount"],
				skill["statistic_prereq"],
				skill["wealth_prereq_id"]
			);
		
		retSkill.classes = skill["player_classes"];
		retSkill.race_prereqs = skill["race_prereqs"];
		retSkill.craftEquipments = skill["craft_equipments"];
		retSkill.craft_skill = skill["craft_skill"];
		
		return retSkill;
	}
	
	self.checkArmorName = function(name, armor_id, callback){
		$.ajax({
			url: GLOBAL_BASE+"/check_armor_name",
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
			url: GLOBAL_BASE+"/check_shield_name",
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
			url: GLOBAL_BASE+"/check_weapon_name",
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
			url: GLOBAL_BASE+"/check_craft_equipment_name",
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
			url: GLOBAL_BASE+"/check_generic_equipment_name",
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
			url: GLOBAL_BASE+myUrl,
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
	
	self.getProhibitedClasses = function(race_id, callback){
		$.ajax({
			url: GLOBAL_BASE+"/get_prohibited_classes",
			type: "GET",
			data: {	"race_id":race_id},
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
	
	self.getDescentSkills = function(race_id, callback){
		$.ajax({
			url: GLOBAL_BASE+"/get_descent_skills",
			type: "GET",
			data: {	"race_id":race_id},
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
	
	self.getClassSkillsAndWealth = function(class_id, charLevel, charRace, callback){
		$.ajax({
			url: GLOBAL_BASE+"/get_class_skills_and_wealth",
			type: "GET",
			data: {	"class_id":class_id,
					"char_level": charLevel,
					"char_race": charRace},
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
	
	self.getClassWealth = function(class_id, callback){
		$.ajax({
			url: GLOBAL_BASE+"/get_class_wealth",
			type: "GET",
			data: {	"class_id":class_id,},
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
	
	self.getCombatSheet = function(char_id){
		$.ajax({
			url: GLOBAL_BASE+"/get_combat_sheet",
			type: "GET",
			data: {	"char_id":char_id},
			success: function(jsondata){
				var blob=new Blob([jsondata], {type: 'application/pdf'});
				var url = URL.createObjectURL(blob);
				window.open(url);
			},
			error: function(data){
				console.log("###########################");
				console.log("JSON error: get combat sheet");
				console.log(data.responseText);
				console.log("###########################");
			}
		});		
	}
}