var ShowAll = new function(){
	var self = this;
	
	self.showSkillDetails = function(event){
		// if the event was fired by the edit button, do nothing
		if(!( $(event.target).hasClass("edit-skill-btn")
				||$(event.target).hasClass("glyphicon-pencil")
				||$(event.target).hasClass("remove-skill-btn")
				||$(event.target).hasClass("glyphicon-minus")
				)
		  ){
			var skillId = $(event.target).parents("tr").attr("id");
			self.clearSkillDetails();
			event.preventDefault();
			AjaxInterface.getFullSkillDetails(skillId, self.fillSkillDetails);
		}
	};
	
	self.showPlayersWithSkill = function(event){
		event.stopPropagation();
		event.preventDefault();
		let skillId = $(event.target).data("skillid");
		AjaxInterface.getPlayersWithSkill(skillId, self.fillPlayersWithSkill);
	};

	self.fillPlayersWithSkill = function(data){
		$(".playersWithSkill #skill_name").html(data.skill_name);

		// First make row template
		var entryRow = $(document.createElement("tr"));
		var charName = $(document.createElement("td")).addClass("col-xs-3");
		var accountName = $(document.createElement("td")).addClass("col-xs-3");
		var className = $(document.createElement("td")).addClass("col-xs-3");
		var raceName = $(document.createElement("td")).addClass("col-xs-2");
		var action = $(document.createElement("td")).addClass("col-xs-1");
		entryRow.append(charName);
		entryRow.append(accountName);
		entryRow.append(className);
		entryRow.append(raceName);
		entryRow.append(action);

		var playerCharArray = data.playerChar;

		for(var index=0; index < playerCharArray.length; index++ ){
			var newEntryRow = entryRow.clone();

			newEntryRow.find("td").eq(0).html(playerCharArray[index].char_name);
			newEntryRow.find("td").eq(1).html(playerCharArray[index].user_name);
			newEntryRow.find("td").eq(2).html(playerCharArray[index].char_class);
			newEntryRow.find("td").eq(3).html(playerCharArray[index].char_race);

			newEntryRow.find("td").eq(4).html("<a href='show_character/"+ playerCharArray[index].char_id 
				+"' class='btn btn-success btn-xs show-char-btn' data-toggle='tooltip' title='Bekijk Karakter'>"+
				"<span class='glyphicon glyphicon-eye-open'></span></a>");
			
			$("#playerWithSkill_data").append(newEntryRow);
		}

		$("#showPlayersWithSkill").fadeIn();
	}

	self.closeSkillDetails = function(){
		$("#showSkillDetails").fadeOut();
	};

	self.closePlayersWithSkill = function(){
		$("#showPlayersWithSkill").fadeOut();
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

		// Update data of showPlayersWithSkill button
		if($("#btn-showPlayersWithSkill").length > 0){
			$("#btn-showPlayersWithSkill").data("skillid", skill.id);
		}
		
		// Classes entry
		var classText = "";
		for(var index = 0; index < (skill.classes.length-1); index++){
			classText = classText + skill.classes[index] + ", ";
		}
		classText = classText + skill.classes[skill.classes.length-1];
		$("#skill_classes").html(classText);
		
		// Prereq entry
		$("#skill_prereqs").html("geen");
		var prereqText = "";
		if(skill.statPrereqAmount > 0){
			prereqText = prereqText + skill.statPrereq + ": " + skill.statPrereqAmount;
		}
		
		if(skill.statPrereqAmount > 0 && skill.skillPrereqs["set1"].length > 0){
			prereqText = prereqText + "<br>";
		}
		
		if(skill.skillPrereqs["set1"].length > 0){
			var index = 0;
			for(index = 0; index < (skill.skillPrereqs["set1"].length - 1); index++){
				prereqText = prereqText + skill.skillPrereqs["set1"][index].name + ", ";
			}
			prereqText = prereqText + skill.skillPrereqs["set1"][index].name;
			
			index = 0;
			
			if(skill.skillPrereqs["set2"].length > 0){
				prereqText = prereqText + " <b>OF</b> ";
			
				for(index = 0; index < (skill.skillPrereqs["set2"].length - 1); index++){
					prereqText = prereqText + skill.skillPrereqs["set2"][index].name + ", ";
				}
				prereqText = prereqText + skill.skillPrereqs["set2"][index].name;
			}
		}
		
		if(skill.wealthPrereqId > 1){
			prereqText = "Welvaart is " + CreateCharacter.getWealthType(skill.wealthPrereqId);
		}
		
		
		if(prereqText.length > 0){
			$("#skill_prereqs").html(prereqText);
		}
		
		// Income entry
		var incomeText = "geen";
		if(skill.incomeAmount>0){
			incomeText = skill.incomeAmount + " " + skill.incomeCoin; 
		}
		if(skill.craft_skill){
			incomeText = incomeText + " (ambachtsvaardigheid)";
		}
		$("#skill_income").html(incomeText);
		
		// Races indication
		if(skill.race_prereqs.length > 0){
			var race_prereqs_name = new Array();
			for(var index in skill.race_prereqs){
				var race = skill.race_prereqs[index];
				race_prereqs_name.push(race['race_name']);
			}
			
			$("#skill_races").html(race_prereqs_name.join());
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