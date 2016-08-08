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
					(retData["skill"]["mentorRequired"]==0?false:true);
				
				var retSkill = new Skill(
						retData["skill"]["id"],
						retData["skill"]["name"],
						retData["skill"]["ep_cost"],
						retData["skill"]["level"],
						retData["levelName"][0],
						retData["skill"]["descriptionSmall"],
						retData["skill"]["descriptionLong"],
						requiresMentor
					);
				
				retSkill.classes = retData["skillClasses"];
				retSkill.races = retData["skillRaces"];
				
				if(retData["skillIncome"].length > 0){
					retSkill.incomeAmount = retData["skillIncome"][0]["incomeAmount"];
					retSkill.incomeLevel = retData["skillIncome"][0]["incomeLevel"];
				} else {
					retSkill.incomeAmount = 0;
					retSkill.incomeLevel = "";
				}
				
				callback(retSkill);
			},
			error: function(){
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