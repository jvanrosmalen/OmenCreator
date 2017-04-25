var CreateCharacter = new function(){
	var self = this;

	self.handleNameChange = function(event){
		event.preventDefault();
		var newName = $(event.target).val();
		
		if(newName!=null && newName!=''){
			$("#overview_name").html(newName);
			$("#overview_name").removeClass('warning_not_entered');
		}else{
			$("#overview_name").html("Niet ingevuld");
			$("#overview_name").addClass('warning_not_entered');
		}
	}
	
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

		// Add all skill information
		$(tr).data("id", skill.id);
		$(tr).data("ep_cost", skill.ep_cost);
		$(tr).data("skill_prereqs", skill.skill_prereqs);
		$(tr).data("skill_group_prereqs", skill.skill_group_prereqs);
		$(tr).data("res_rules", skill.res_rules);
		$(tr).data("call_rules", skill.call_rules);
		$(tr).data("stat_rules", skill.stat_rules);
		$(tr).data("statistic_prereq_id", skill.statistic_prereq_id);
		$(tr).data("statistic_prereq_amount", skill.statistic_prereq_amount);
		$(tr).data("wealth_rules", skill.wealth_rules);
		
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
	
	self.addSkillToNonClassOptionsTable = function(skill){
		var tableBody = $('#character_non_class_skill_options tbody')[0];
		
		var tr = CreateCharacter.createTableRow(skill);
		tr.setAttribute("class", "character_non_class_skill_option character_non_class_skill_option_"+ skill.id);
				
		tableBody.appendChild(tr);
	}
	
	self.addSkillToNonClassSelectedTable = function(skill){
		var tableBody = $('#character_non_class_skill_selected tbody')[0];
		
		var tr = CreateCharacter.createTableRow(skill);
		tr.setAttribute("class", "character_non_class_skill_selection character_non_class_skill_selection_"+ skill.id +" hidden");
				
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
			$("#overview_char_level").html($("#char_level_name_"+char_level).html());
			// Reset spent EP, because the skill list will be reset also.
			createCharacterControl.updateSkillEP(0);
			self.doHandleClassSelection();
		}
		
		$("#overview_survived").html(nrSurvived);
	}
	
	self.handleDescentSkills = function(data){
		CreateCharacter.clearTable('descent_race_skill_options');
		CreateCharacter.clearTable('descent_race_skill_selected');
		
		// Clear the decent skills array and spent ep just to be certain
		$("#descent_skill_list_hidden").val(JSON.stringify(new Array()));
		$("#spent_descent_ep").data('ep_amount', 0);
		$("#spent_descent_ep").html('0');
		
		for(var index in data){
			CreateCharacter.addSkillToOptionsTable(data[index]);
			CreateCharacter.addSkillToSelectedTable(data[index]);
		}
		
		createCharacterControl.addDescentSkillListeners();
		
		// Update selected lists in tabs
		createCharacterControl.updateAlreadySelectedDescentTab();
		createCharacterControl.updateAlreadySelectedClassTab();
		createCharacterControl.updateAlreadySelectedNonClassTab();
	}
	
	self.hideAndClearSkillTabs = function(){
		// Handle tab 'Klasse Vaardigheden'
		$('#class_first_warning').removeClass('hidden');
		$('#class_selected').addClass('hidden');
		$('#class_skills_to_select').addClass('hidden');
		$('#class_skills_to_select tbody tr').remove();
		$('#character_class_skill_list_hidden').val("[]");
		
		// Handle tab 'Niet-Klasse Vaardigheden'
		$('#non_class_first_warning').removeClass('hidden');
		$('#non_class_selected').addClass('hidden');
		$('#non_class_skills_to_select').addClass('hidden');
		$('#non_class_skills_to_select tbody tr').remove();
		$('#character_non_class_skill_list_hidden').val("[]");
		
		// for both
		$('.spent_character_ep').data('ep_amount', 0);
		$('.spent_character_ep').html('0');
	}
	
	self.handleRaceStats = function(raceId){
		var raceOption = $("#race_selection option[value="+raceId+"]");
		
		$(".overview_lp_torso").html(raceOption.data("lp_torso"));
		$(".overview_lp_torso").data('value', raceOption.data("lp_torso"));
		$(".overview_lp_limbs").html(raceOption.data("lp_limbs"));
		$(".overview_lp_limbs").data('value', raceOption.data("lp_limbs"));
		$(".overview_willpower").html(raceOption.data("willpower"));
		$(".overview_willpower").data('value', raceOption.data("willpower"));
		$(".overview_status").html(raceOption.data("status"));
		$(".overview_status").data('value', raceOption.data("status"));
		$(".overview_focus").html(raceOption.data("focus"));
		$(".overview_focus").data('value', raceOption.data("focus"));
		$(".overview_trauma").html(raceOption.data("trauma"));
		$(".overview_trauma").data('value', raceOption.data("trauma"));
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
			
			// Tab 'Overzicht'
			$('#overview_race').html($("#race_selection option[value='"+selectedRaceId+"']").text());
			$('#overview_race').removeClass("warning_not_entered");
			
			// Handle descent skills
			AjaxInterface.getDescentSkills(selectedRaceId, CreateCharacter.handleDescentSkills);
		}else{
			// Tab 'Basis Info'
			$('#playerclass_race_first_warning').removeClass('hidden');
			$('#playerclass_select').addClass('hidden');
			
			// Tab 'Afkomst'
			$('#descent_race_first_warning').removeClass('hidden');
			$('#descent_race_selected').addClass('hidden');
			$('#descent_race_skills_to_select').addClass('hidden');

			// Tab 'Overzicht'
			$('#overview_race').html("Niet geselecteerd");
			$('#overview_race').addClass("warning_not_entered");
		}
		
		CreateCharacter.handleRaceStats(selectedRaceId);
		CreateCharacter.hideAndClearSkillTabs();
	}

	self.handleClassSkills = function(data){
		var classSkills = data['classSkills'];
		var nonClassSkills = data['nonClassSkills'];
		
		CreateCharacter.clearTable('character_class_skill_options');
		CreateCharacter.clearTable('character_class_skill_selected');
		
		// Clear the skills array just to be certain
		$("#character_class_skill_list_hidden").val(JSON.stringify(new Array()));
		
		for(var index in classSkills){
			CreateCharacter.addSkillToClassOptionsTable(classSkills[index]);
			CreateCharacter.addSkillToClassSelectedTable(classSkills[index]);
		}
		
		CreateCharacter.clearTable('character_non_class_skill_options');
		CreateCharacter.clearTable('character_non_class_skill_selected');
		
		// Clear the skills array just to be certain
		$("#character_non_class_skill_list_hidden").val(JSON.stringify(new Array()));
		
		for(var index in nonClassSkills){
			CreateCharacter.addSkillToNonClassOptionsTable(nonClassSkills[index]);
			CreateCharacter.addSkillToNonClassSelectedTable(nonClassSkills[index]);
		}

		createCharacterControl.addClassSkillListeners();
		
		// Update selected lists in tabs
		createCharacterControl.updateAlreadySelectedDescentTab();
		createCharacterControl.updateAlreadySelectedClassTab();
		createCharacterControl.updateAlreadySelectedNonClassTab();
	}
	
	self.handleClassSelection = function(event){
		event.preventDefault();
		self.doHandleClassSelection();
	}

	self.doHandleClassSelection = function(){
		var selectedClassId = $('#playerclass_select').val();
		var charLevel = $('#char_level').val();
		var selectedRace = $('#race_selection').val();
		
		if(selectedClassId != -1){
			// Tab 'Klasse Vaardigheden'
			$('#class_first_warning').addClass('hidden');
			$('#class_selected').removeClass('hidden');
			$('#class_skills_to_select').removeClass('hidden');
			
			// Tab 'Niet-Klasse Vaardigheden' 
			$('#non_class_first_warning').addClass('hidden');
			$('#non_class_selected').removeClass('hidden');
			$('#non_class_skills_to_select').removeClass('hidden');
			
			// Tab 'Overzicht'
			$('#overview_class').html($("#playerclass_select option[value='"+selectedClassId+"']").text());
			$('#overview_class').removeClass("warning_not_entered");

			// Get class and non-class skills
			AjaxInterface.getClassSkills(selectedClassId, charLevel, selectedRace, CreateCharacter.handleClassSkills);
		}else{
			// Tab 'Klasse Vaardigheden'
			$('#class_first_warning').removeClass('hidden');
			$('#class_selected').addClass('hidden');
			$('#class_skills_to_select').addClass('hidden');
			// Tab 'Niet-Klasse Vaardigheden'
			$('#non_class_first_warning').removeClass('hidden');
			$('#non_class_selected').addClass('hidden');
			$('#non_class_skills_to_select').addClass('hidden');

			// Tab 'Overzicht'
			// Tab 'Overzicht'
			$('#overview_class').html("Niet geselecteerd");
			$('#overview_class').addClass("warning_not_entered");
		}		
	}
	
	self.handleEpInput = function(event){
		event.preventDefault();
		var epAmount = $(event.target).val();
		var oldEpAmount = $('.spent_character_ep').data("ep_amount");
		
		// check if value not under spent EP
		if(epAmount < oldEpAmount){
			$('#input_start_ep').val(oldEpAmount);
			alert('De EP kan niet verder verlaagd worden omdat je al teveel vaardigheden hebt geselecteerd');
			return;
		}
		
		$(".total_character_ep").data("ep_amount", epAmount);
		$(".total_character_ep").html(epAmount);
		
		// Tab 'Overzicht'
		$("#overview_start_ep").html(epAmount);
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