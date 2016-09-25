var ShowAll = new function(){
	var self = this;
	
	self.showSkillDetails = function(event){
		var skillId = $(event.target).parents("tr").attr("id");
		self.clearSkillDetails();
		event.preventDefault();
		AjaxInterface.getFullSkillDetails(skillId, self.fillSkillDetails);
	};
	
	self.closeSkillDetails = function(){
		$("#showSkillDetails").fadeOut();
	};
	
	self.clearSkillDetails = function(){
		$("#skill_name").html("");
		$("#skill_ep_cost").html("");
		$("#skill_desc_long").html("");
		$("#skill_prereqs").html("");
		$("#skill_income").html("");
		$("#skill_classes").html("");
		$("#skill_races").html("");
		$("#skill_mentor").addClass("hidden");
		$("#skill_races_row").addClass("hidden");
		$("#skill_craft_equipments").html("");
		$("#skill_craft_equipments_row").addClass("hidden");
	};
	
	self.fillSkillDetails = function(skill){
		$("#skill_name").text(skill.name);
		$("#skill_ep_cost").text(skill.ep_cost);
		var descLongHtml = $.parseHTML(skill.descriptionLong)
		$("#skill_desc_long").append(descLongHtml);
		$("#skill_level").text(skill.levelName);
		
		// Classes entry
		var classText = "";
		for(var index = 0; index < (skill.classes.length-1); index++){
			classText = classText + skill.classes[index] + ", ";
		}
		classText = classText + skill.classes[skill.classes.length-1];
		$("#skill_classes").html(classText);
		
		// Income entry
		var incomeText = "geen";
		if(skill.incomeAmount>0){
			incomeText = skill.incomeAmount + " " + skill.incomeCoin; 
		}
		$("#skill_income").html(incomeText);
		
		// Races indication
		if(skill.races.length > 0){
			var raceText = "";
			for(var index = 0; index < (skill.races.length-1); index++){
				raceText = raceText + skill.races[index] + ", ";
			}
			raceText = raceText + skill.races[skill.races.length-1];
			$("#skill_races").html(raceText);
			$("#skill_races_row").removeClass("hidden");
		}
		
		// Craft equipments indication
		if(skill.craftEquipments.length > 0){
			var craftEquipText = "";
			for (var index = 0; index < (skill.craftEquipments.length - 1); index++){
				craftEquipText = craftEquipText + skill.craftEquipments[index] + ", ";
			}
			craftEquipText = craftEquipText + skill.craftEquipments[skill.craftEquipments.length - 1];
			$("#skill_craft_equipments").html(craftEquipText);
			$("#skill_craft_equipments_row").removeClass("hidden");
		}
		
		// Mentor indication
		if(skill.mentorRequired){
			$("#skill_mentor").removeClass("hidden");
		}
		
		$("#showSkillDetails").fadeIn();
	}
}