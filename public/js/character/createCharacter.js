var CreateCharacter = new function(){
	var self = this;

	self.handleProhibitedClasses = function(data){
		$('#playerclass_select option').removeClass('hidden');
		$('#playerclass_select option').removeAttr('selected');
		data.forEach(function(prohibitedName){
			$('option#'+prohibitedName).addClass('hidden');
		});
		var optionArray = $('#playerclass_select option');
		for (var i = 0, len = optionArray.length; i < len; i++) {
			if(!$(optionArray[i]).hasClass('hidden')){
				$('#playerclass_select').val($(optionArray[i]).val());
				break;
			}
		}
		
		$('#playerclass_select').removeClass('hidden');
		$('#playerclass_race_first_warning').addClass('hidden');
	}
	
	self.createTableRow = function(skill){
		var tr = document.createElement("TR");

		$(tr).data("id", skill.id);
		$(tr).data("ep_cost", skill.ep_cost);
		tr.setAttribute("oncontextmenu", "ShowAll.showSkillDetails(event);");
		
		var skillname = document.createElement("TD");
		skillname.setAttribute("id", skill.name);
		skillname.setAttribute("class", "skillname col-xs-7");
		skillname.appendChild(document.createTextNode(skill.name));
		tr.appendChild(skillname);
		
		var classes = document.createElement("TD");
		classes.setAttribute("class", "col-xs-3");

		var classStr = "";
		var index = 0;
		for(index = 0; index < (skill.player_classes.length - 1); index++){
			classStr = classStr + skill.player_classes[index] + ", ";
		}
		classStr = classStr + skill.player_classes[index];
		classes.appendChild(document.createTextNode(classStr));
		tr.appendChild(classes);
		
		var epcost = document.createElement("TD");
		epcost.setAttribute("class", "col-xs-1 skill_ep_cost");
		epcost.appendChild(document.createTextNode(skill.ep_cost));
		tr.appendChild(epcost);
		
		return tr;
	}
	
	self.addSkillToOptionsTable = function(skill){
		var tableBody = $('#descent_race_skill_options tbody')[0];
		
		var tr = CreateCharacter.createTableRow(skill);
		tr.setAttribute("class", "descent_skill_option descent_skill_option_"+ skill.id);
				
		tableBody.appendChild(tr);
	}
	
	self.addSkillToSelectedTable = function(skill){
		var tableBody = $('#descent_race_skill_selected tbody')[0];
		
		var tr = CreateCharacter.createTableRow(skill);
		tr.setAttribute("class", "descent_skill_selection descent_skill_selection_"+ skill.id +" hidden");
				
		tableBody.appendChild(tr);
	}
	
	self.addSkillToClassOptionsTable = function(skill){
		var tableBody = $('#character_class_skill_options tbody')[0];
		
		var tr = CreateCharacter.createTableRow(skill);
		tr.setAttribute("class", "character_class_skill_option character_class_skill_option_"+ skill.id);
				
		tableBody.appendChild(tr);
	}
	
	self.addSkillToClassSelectedTable = function(skill){
		var tableBody = $('#character_class_skill_selected tbody')[0];
		
		var tr = CreateCharacter.createTableRow(skill);
		tr.setAttribute("class", "character_class_skill_selection character_class_skill_selection_"+ skill.id +" hidden");
				
		tableBody.appendChild(tr);
	}
	
	self.clearTable = function(table){
		$('#'+table+' tbody tr').remove();
	}
	
	self.survivedToLevel = function(nrSurvived){
		var retVal = 1;
		if(nrSurvived >= 3){
			if(nrSurvived < 8){
				retVal = 2;
			}else if(nrSurvived < 15){
				retVal = 3;
			}else {
				retVal = 4;
			}
		}
		
		return retVal;
	}
	
	self.handleSurvivedChange = function(event){
		event.preventDefault();
		var nrSurvived = $(event.target).val();
		var char_level = CreateCharacter.survivedToLevel(parseInt(nrSurvived));
		var old_char_level = $('#char_level').val();
		
		if(char_level != old_char_level){
			$("#char_level_name_"+old_char_level).addClass('hidden');
			$("#char_level_name_"+char_level).removeClass('hidden');
			$("#char_level").val(char_level);
		}
	}
	
	self.handleDescentSkills = function(data){
		CreateCharacter.clearTable('descent_race_skill_options');
		CreateCharacter.clearTable('descent_race_skill_selected');
		
		// Clear the decent skills array just to be certain
		$("#descent_skill_list_hidden").val(JSON.stringify(new Array()));
		
		for(var index in data){
			CreateCharacter.addSkillToOptionsTable(data[index]);
			CreateCharacter.addSkillToSelectedTable(data[index]);
		}
		
		createCharacterControl.addDescentSkillListeners();
	}
	
	self.handleRaceSelection = function(event){
		event.preventDefault();
		var selectedRaceId = $(event.target).val();
		if(selectedRaceId != -1){
			// Tab 'Basis Info' 
			$('#playerclass_select').addClass('hidden');
			AjaxInterface.getProhibitedClasses(selectedRaceId, CreateCharacter.handleProhibitedClasses);
			
			// Tab 'Afkomst'
			$('#descent_race_first_warning').addClass('hidden');
			$('#descent_race_selected').removeClass('hidden');
			$('#descent_race_skills_to_select').removeClass('hidden');
			AjaxInterface.getDescentSkills(selectedRaceId, CreateCharacter.handleDescentSkills);
		}else{
			// Tab 'Basis Info'
			$('#playerclass_race_first_warning').removeClass('hidden');
			$('#playerclass_select').addClass('hidden');
			
			// Tab 'Afkomst'
			$('#descent_race_first_warning').removeClass('hidden');
			$('#descent_race_selected').addClass('hidden');
			$('#descent_race_skills_to_select').addClass('hidden');
		}
	}

	self.handleClassSkills = function(data){
		CreateCharacter.clearTable('character_class_skill_options');
		CreateCharacter.clearTable('character_class_skill_selected');
		
		// Clear the skills array just to be certain
		$("#character_class_skill_list_hidden").val(JSON.stringify(new Array()));
		
		for(var index in data){
			CreateCharacter.addSkillToClassOptionsTable(data[index]);
			CreateCharacter.addSkillToClassSelectedTable(data[index]);
		}
		
		createCharacterControl.addClassSkillListeners();
	}
	
	self.handleClassSelection = function(event){
		event.preventDefault();
		var selectedClassId = $(event.target).val();
		var charLevel = $('#char_level').val();
		
		if(selectedClassId != -1){
			// Tab 'Vaardigheden'
			$('#class_first_warning').addClass('hidden');
			$('#class_selected').removeClass('hidden');
			$('#class_skills_to_select').removeClass('hidden');
			AjaxInterface.getClassSkills(selectedClassId, charLevel, CreateCharacter.handleClassSkills);
		}else{
			// Tab 'Vaardigheden'
			$('#class_first_warning').removeClass('hidden');
			$('#class_selected').addClass('hidden');
			$('#class_skills_to_select').addClass('hidden');
		}		
	}
	
	self.handleEpInput = function(event){
		event.preventDefault();
		var epAmount = $(event.target).val();
		
		$(".total_character_ep").data("ep_amount", epAmount);
		$(".total_character_ep").html(epAmount);
	}
	
//	self.addRaceSkill = function(){
//		$("#createSkillSelector").fadeIn();
//		event.preventDefault();
//	};
//	
//	self.submitRaceSkills = function(e){
//		var raceSkillsArray = new Array();
//
//		if($("#race_skills_list_hidden").val()){
//			raceSkillsArray = JSON.parse($("#race_skills_list_hidden").val());
//		}
//		
//		$(".selected").each(function(id, value){
//			// Add entry in the correct prereq set.
//			var entryRow = document.createElement("div");
//			entryRow.setAttribute("class", "row");
//			entryRow.setAttribute("id", "entryRow_"+value.id);
//			entryRow.setAttribute("style", "padding-top: 3px;padding-left: 3px");
//			var entryTdName = document.createElement("div");
//			entryTdName.appendChild(document.createTextNode($("tr#"+value.id+ " .skillname").attr('id')));
//			entryTdName.setAttribute("class", "col-xs-8");
//			
//			entryRow.appendChild(entryTdName);
//			
//			var entryTdRemoveButton = document.createElement("div");
//			entryTdRemoveButton.setAttribute("class", "col-xs-3");
//			var removeBtn = document.createElement("button");
//			removeBtn.setAttribute("class", "btn btn-xs pull-right");
//			var removeMinus = document.createElement("span");
//			removeMinus.setAttribute("class", "glyphicon glyphicon-minus");
//			removeMinus.setAttribute("id", "entryRow_"+value.id);
//			removeMinus.setAttribute("onclick", "CreateRaceControl.removeRaceSkill(event);");
//			
//			removeBtn.appendChild(removeMinus);
//			
//			entryTdRemoveButton.appendChild(removeBtn);
//			entryRow.appendChild(entryTdRemoveButton);
//			
//			$("tr#"+value.id).removeClass("selected");
//			$("tr#"+value.id).addClass("submitted");
//			$("tr#"+value.id).removeAttr('onclick');
//			raceSkillsArray.push(value.id);
//			$("#race_skills").append(entryRow);
//		});
//		
//		$("#race_skills_list_hidden").val(JSON.stringify(raceSkillsArray));
//		
//		$("#skill_select_table .selected").removeClass("selected");
//		
//		Create.closeSkillSelector();	
//	}
//	
//	self.removeRaceSkill = function(e){
//		event.preventDefault();
//		var compound_id = $(event.target).attr('id');
//		var id = compound_id.split('_')[1];
//		var raceSkillsArray = new Array();
//
//		// First clear the id out of the relevant selected prereqs list.
//		if($("#race_skills_list_hidden").val()){
//			raceSkillsArray = JSON.parse($("#race_skills_list_hidden").val());
//		}
//		
//		for(var index in raceSkillsArray){
//			if(raceSkillsArray[index] == id ){
//				raceSkillsArray.splice(index,1);
//				break;
//			}
//		}
//
//		$("#race_skills_list_hidden").val(JSON.stringify(raceSkillsArray));
//		
//		// Now remove from view
//		var test = ".skillSelector tr#"+id;
//		var selectorSkill = $(".skillSelector tr#"+id);
//		if(selectorSkill.hasClass("submitted")){
//			selectorSkill.removeClass("submitted");
//			selectorSkill.attr('onclick', 'Create.selectSkill(event)');
//		}
//		
//		$("#entryRow_"+id).remove();
//	}
}