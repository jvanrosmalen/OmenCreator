var CreatePlayerCharSkills = new function(){
	var self = this;
	// currentCaller and currentListenerType are needed in case of 
	// mentorRequired skill selection in the function 'optionListener'
	var currentCaller = null;
	var currentListenerType = null;
	var low_spent_ep_ok = false;
	
	self.initialize = function(){
		// Remove all race skills from the option lists.
		var skill_array = JSON.parse($("#race_skill_list_hidden").val());
		
		for(var i=0; i < skill_array.length; i++){
			$(".decent_skill_selection_"+skill_array[i]).remove();
			$(".character_class_skill_selection_"+skill_array[i]).remove();
			$(".character_non_class_skill_selection_"+skill_array[i]).remove();
			
			$(".decent_skill_option_"+skill_array[i]).remove();
			$(".character_class_skill_option_"+skill_array[i]).remove();
			$(".character_non_class_skill_option_"+skill_array[i]).remove();
		}
		
		// add method to save button
		$("#save").attr("onclick",'CreatePlayerCharSkills.submitSkills(event)');
		$("#faith_selection").attr("onchange", 'CreatePlayerCharSkills.handleFaithSelection(event)');
		$("#character_title").attr("onchange", 'CreatePlayerCharSkills.handleTitleInput(event)');
	}

	self.handleFaithSelection = function(event){
		event.preventDefault();
		event.stopPropagation();
		$("#overview_faith").text($("#faith_selection option:selected").text());
	}

	self.handleTitleInput = function(event){
		event.preventDefault();
		event.stopPropagation();
		let textInput = $("#character_title").val();
		if(textInput === ""){
			$("#overview_title").text("");
		} else {
			$("#overview_title").text(", "+textInput);
		}
	}
	
	self.submitSkills = function(event){
		if($("#spent_descent_ep").data("ep_amount") 
				< $("#total_descent_ep").data("ep_amount")){
			// Some descent EP has not been spent
			ErrorMessage.showErrorMessage("Je hebt nog afkomstpunten niet besteed." +
					" Selecteer nog meer afkomstvaardigheden.");
			event.preventDefault();
			return;
		}
		
		if($(".spent_character_ep").data("ep_amount") 
				> $(".total_character_ep").data("ep_amount")){
			// Too much EP spent.
			ErrorMessage.showErrorMessage("Je hebt teveel EP gespendeerd. " +
					"Verwijder een aantal vaardigheden.");
			event.preventDefault();
			return;
		}
		
		// Construct below is to stop button event until user has been
		// asked if low EP amount is ok.
		
		if($(".spent_character_ep").data("ep_amount") 
				< $(".total_character_ep").data("ep_amount")
				&& !low_spent_ep_ok){
			event.preventDefault();
			
			PromptMessage.showPromptMessage("Je hebt minder EP besteed dan toegestaan. " +
					"Wil je dit karakter toch opslaan?", self.doTriggerSaveBtn);			
		}
	}
	
	self.doTriggerSaveBtn = function(){
		low_spent_ep_ok = true;
		$("#save").trigger('click');
	}
	
	self.checkDescentEp = function(ep_cost){
		return ($("#spent_descent_ep").data('ep_amount') + ep_cost) <=
									$("#total_descent_ep").data('ep_amount');
	}
	
	self.updateDescentEP = function(value){
		$("#spent_descent_ep").data('ep_amount', value );
		$("#spent_descent_ep").html(value);
	}
	
	self.addDescentEp = function(ep_cost){
		var newValue = $("#spent_descent_ep").data('ep_amount') + ep_cost;
		self.updateDescentEP(newValue);
	}
	
	self.removeDescentEp = function(ep_cost){
		var newValue = $("#spent_descent_ep").data('ep_amount') - ep_cost;
		self.updateDescentEP(newValue);
	}
	
	self.checkSkillEp = function(ep_cost){
		return ($(".spent_character_ep").data('ep_amount') + ep_cost) <=
			$(".total_character_ep").data('ep_amount');
	}
	
	self.updateSkillEP = function(value){
		$(".spent_character_ep").data('ep_amount', value );
		$(".spent_character_ep").html(value);
	}
	
	self.removeSkillEp = function(ep_cost){
		var newValue = $(".spent_character_ep").data('ep_amount') - ep_cost;
		self.updateSkillEP(newValue);
	}

	self.addSkillEp = function(ep_cost){
		var newValue = $(".spent_character_ep").data('ep_amount') + ep_cost;
		self.updateSkillEP(newValue);
	}
	
	self.getWealthType = function(wealthId){
		var wealth_type = 'Arm';

		// Get wealth string from hidden info
		if(wealthId != -1){
			$(".wealth_type").each(function(){
				if($(this).data('id')== wealthId){
					wealth_type = $(this).data('wealth_type');
					
					return false;
				}
			});
		}
		
		return wealth_type;
	}
	
	self.getNameOfSkill = function(skill_id){
		if($('.character_non_class_skill_option_'+skill_id).length){
			return $('.character_non_class_skill_option_'+skill_id+' td.skillname').html();
		}else if($('.character_class_skill_option_'+skill_id).length){
			return $('.character_class_skill_option_'+skill_id+' td.skillname').html();
		}
	}
	
	self.hasSkill = function(skillId){
		return (JSON.parse($("#descent_skill_list_hidden").val()).indexOf(skillId) >= 0
				||	JSON.parse($("#character_class_skill_list_hidden").val()).indexOf(skillId) >= 0
				||  JSON.parse($("#character_non_class_skill_list_hidden").val()).indexOf(skillId) >= 0
				||  JSON.parse($("#race_skill_list_hidden").val()).indexOf(skillId) >= 0);
	}
	
	// ****************************
	// Prereq checking functions
	// ****************************
	self.checkAllPrereqs = function(skillData){
		// check stat prereqs
		if(!self.checkStatPrereqs(skillData)){
			return false;
		}
		// check skill prereqs
		if(!self.checkSkillPrereqs(skillData)){
			return false;
		}
		// check wealth prereqs
		if(!self.checkWealthPrereqs(skillData)){
			return false;
		}
		
		return true;
	}
	
	self.checkSkillPrereqs = function(skillData){
		var problem = false;
		var problem2 = false;
		var problemArray = [];
		var problem2Array = [];
		var skillSet2Array = [];
		var skillGroupSet2Array = [];
		
		for(var i=0; i < skillData['skill_prereqs'].length; i++){
			var prereq_skill = skillData['skill_prereqs'][i];
			
			if(prereq_skill['pivot']['prereq_set'] == 2){
				skillSet2Array.push(prereq_skill);
				continue;
			}
			
			// check if skill is in all hidden lists with skills
			if(!self.hasSkill(prereq_skill['id'])){
				problem = true;
				
				problemArray.push(prereq_skill['name']);
			}
		}
		
		if(problem && skillSet2Array.length > 0){
			// There is a second skill set for prereqs. Check if 
			// those prereqs are met.
			for(var i=0; i < skillSet2Array.length; i++){
				var prereq_skill = skillSet2Array[i];
				
				if(!self.hasSkill(prereq_skill['id'])){
					problem2  = true;
					
					problem2Array.push(prereq_skill['name']);
				}
			}
		}
		
		for(var i=0; i < skillData['skill_group_prereqs'].length; i++){
			var prereq_skillgroup = skillData['skill_group_prereqs'][i];
			
			if(prereq_skillgroup['pivot']['prereq_set'] == 2){
				skillGroupSet2Array.push(prereq_skillgroup);
				continue;				
			}
			
			var groupProblem = true;
			
			for(var j=0; j < prereq_skillgroup['group_skills'].length; j++){
				var prereq_skill = prereq_skillgroup['group_skills'][j];
				// check if skill is in all hidden lists with skills
				if(self.hasSkill(prereq_skill['id'])){
					// Found one, so group is no problem.
					groupProblem = false;
					break;
				}
			}
			
			if(groupProblem){
				problem = true;
				problemArray.push(prereq_skillgroup['name']);
			}
		}
		
		if(problem && skillGroupSet2Array.length > 0){
			// There is skillgroup in the second skill set for prereqs. Check if 
			// those prereqs are met.
			for(var i=0; i < skillGroupSet2Array.length; i++){
				var prereq_skillgroup2 = skillGroupSet2Array[i];
				
				var group2Problem = true;
				
				for(var j=0; j < prereq_skillgroup2['group_skills'].length; j++){
					var prereq_skill = prereq_skillgroup2['group_skills'][j];
					// check if skill is in all hidden lists with skills
					if(self.hasSkill(prereq_skill['id'])){
						// Found one, so group is no problem.
						group2Problem = false;
						break;
					}
				}
				
				if(group2Problem){
					problem2 = true;
					problem2Array.push(prereq_skillgroup2['name']);
				}
			}
		}
		
		if(!problem){
			// no problem in first set.
			return true;
		}
		else {
			if(!problem2 && (skillSet2Array.length > 0 || skillGroupSet2Array.length > 0 )){
				// there is a set2 that has been met.
				// all is well after all.
				return true;
			} else {
				// skill is not found
				var warningStr = "Je hebt de volgende vaardigheden nog nodig voor deze skill: ";
				
				warningStr += problemArray.join(', ');
				
				if(problem2){
					warningStr += " OF " + problem2Array.join(', ');
				}
				
				ErrorMessage.showErrorMessage(warningStr);
				return false;
			}
		}
	}
	
	self.checkStatPrereqs = function(skillData){
		// check all stat prereqs
		if($("#overview_stat_"+skillData['statistic_prereq_id']).data('value')
				>= skillData['statistic_prereq_amount']){
			return true;
		}else{
			ErrorMessage.showErrorMessage(
					"Je moet minimaal "+ skillData['statistic_prereq_amount'] +
					" " + $("#stat_"+skillData['statistic_prereq_id']+"_name").html().trim()+
					" hebben om deze vaardigheid te kunnen selecteren");
			
			return false;
		}
	}
	
	self.checkWealthPrereqs = function(skillData){
		// check wealth prereq. This is always just one rule.
		var wealth_prereq_id = skillData['wealth_prereq_id'];
		var current_wealth = $("#overview_wealth").data('value');
		
		if( current_wealth >= wealth_prereq_id){
			// Prereq is ok.

			// check if it is any use taking this skill.
			// Is this char not already wealthy enough
			if(skillData['wealth_rules'].length > 0){
				if(skillData['wealth_rules'][0]['value_type_id'] <= current_wealth){
					ErrorMessage.showErrorMessage("Het nemen van deze vaardigheid heeft geen zin." +
							" Je bent al minimaal "
							+ self.getWealthType(skillData['wealth_rules'][0]['value_type_id'])
							+ ".")
							
					return false;
				}
			}
			
			// It's useful to take this skill.
			return true;
		} else {
			ErrorMessage.showErrorMessage("Je moet minimaal "
					+ self.getWealthType(wealth_prereq_id)
					+ " zijn om deze vaardigheid te kunnen selecteren.");
			
			return false;
		}
	}
	
	// ****************************
	// Listener functions
	// ****************************
	
	// Generic listener helper functions

	// listenerType - "descent", "class", "non_class"
	self.selectionListener = function(event, listenerType){
		var caller = $(event.target).closest('tr');

		$("."+listenerType+"_skill_option.selected").each(function(){
			$(caller).removeClass("selected");
		});
		$("."+listenerType+"_skill_select_btn").addClass('disabled');

		if($(caller).hasClass("selected")){
			$(caller).removeClass("selected");
		}else{
			$(caller).addClass("selected");
		}
		
		if($("."+listenerType+"_skill_selection.selected").length > 0){
			// there are selections
			$("."+listenerType+"_skill_remove_btn").removeClass('disabled');
		} else {
			// no selections found
			$("."+listenerType+"_skill_remove_btn").addClass('disabled');
		}
	}
	
	self.optionListener = function(event, listenerType){
		// get calling tr
		var caller = $(event.target).closest('tr');
		
		$("."+listenerType+"_skill_selection.selected").each(function(){
			$(caller).removeClass("selected");
		});
		$("."+listenerType+"_skill_remove_btn").addClass('disabled');
		
		if($(caller).hasClass("selected")){
			$(caller).removeClass("selected");
			
			if($("."+listenerType+"_skill_option.selected").length <= 0){
				// no selections remaining.
				$("."+listenerType+"_skill_select_btn").addClass('disabled');
			}
			return;
		}
		
		var skill_ep_cost = 0;
		
		// First add all the ep from the skills already selected
		$("."+listenerType+"_skill_option.selected").each(function(){
			skill_ep_cost = skill_ep_cost + $(caller).data('ep_cost');
		});
		// Add the ep from the skill that the user tries to select.
		skill_ep_cost = skill_ep_cost + $(caller).data('ep_cost');
		
		if(listenerType == "descent"){
			if(!self.checkDescentEp(skill_ep_cost)){
				ErrorMessage.showErrorMessage("Je hebt niet genoeg afkomstpunten voor deze vaardigheid.");
				return;
			}
		} else {
			if(!self.checkSkillEp(skill_ep_cost)){
				ErrorMessage.showErrorMessage("Je hebt niet genoeg punten voor deze vaardigheid.");
				return;
			}			
		}
		
		if(!self.checkAllPrereqs($(caller).data())){
			return;
		}
		
		if($(caller).data('mentor_required')){
			currentCaller = caller;
			currentListenerType = listenerType;
			
			PromptMessage.showPromptMessage("Deze vaardigheid vereist een mentor. " +
					"Heeft de speler toestemming deze vaardigheid aan te schaffen?", self.doSelectCallerActivateBtn);
		}else{
			$(caller).addClass("selected");
			$("."+listenerType+"_skill_select_btn").removeClass('disabled');
		}
	}
	
	self.doSelectCallerActivateBtn = function(){
		$(currentCaller).addClass("selected");
		$("."+currentListenerType+"_skill_select_btn").removeClass('disabled');
	}
	
	self.selectButtonListener = function(event, listenerType){
		if($(this).hasClass("disabled")){
			return;
		}

		var skillArray = new Array();
		var classRulePlayerClassArray = new Array();

		if($("#"+listenerType+"_skill_list_hidden").val()){
			skillArray = JSON.parse($("#"+listenerType+"_skill_list_hidden").val());
		}
		
		$("."+listenerType+"_skill_option.selected").each(function(){
			var skill_id = $(this).data("id");
			
			if(listenerType === "descent"){
				self.addDescentEp($(this).data('ep_cost'));
			} else {
				self.addSkillEp($(this).data('ep_cost'));
			}
			
			$("."+listenerType+"_skill_option_"+skill_id).removeClass("selected");
			$("."+listenerType+"_skill_option_"+skill_id).addClass("hidden");
			$("."+listenerType+"_skill_selection_"+skill_id).removeClass("hidden");
			$("."+listenerType+"_skill_selection_"+skill_id).addClass("skillSelected");
			
			skillArray.push(skill_id);
			var class_rules = $(this).data('class_rules');
			
			for(var i = 0; i < class_rules.length; i++){
				classRulePlayerClassArray.push(class_rules[i]['player_class']);
			}
		});

		$("#"+listenerType+"_skill_list_hidden").val(JSON.stringify(skillArray));

		$("."+listenerType+"_skill_select_btn").addClass('disabled');
		
		self.updateForSelectedClassRules(classRulePlayerClassArray);
	}
	
	self.removeButtonListener = function(event, listenerType){
		if($(this).hasClass("disabled")){
			return;
		}
		
		var skillArray = JSON.parse($("#"+listenerType+"_skill_list_hidden").val());
		var classRulePlayerClassArray = new Array();
		
		$("."+listenerType+"_skill_selection.selected").each(function(){
			var skill_id = $(this).data("id");
			
			if(listenerType === "descent"){
				self.removeDescentEp($(this).data('ep_cost'));
			} else {
				self.removeSkillEp($(this).data('ep_cost'));
			}
			
			$("."+listenerType+"_skill_selection_"+skill_id).removeClass("selected");
			$("."+listenerType+"_skill_selection_"+skill_id).removeClass("skillSelected");
			$("."+listenerType+"_skill_selection_"+skill_id).addClass("hidden");
			$("."+listenerType+"_skill_option_"+skill_id).removeClass("hidden");

			for(var index=0; index < skillArray.length; index++){
				if(skillArray[index]==skill_id){
					skillArray.splice(index, 1);
					$("#"+listenerType+"_skill_list_hidden").val(JSON.stringify(skillArray));
				}
			}
			
			var class_rules = $(this).data('class_rules');
			
			for(var i = 0; i < class_rules.length; i++){
				classRulePlayerClassArray.push(class_rules[i]['player_class']);
			}
		});
		
		$("."+listenerType+"_skill_remove_btn").addClass('disabled');
		
		self.updateForRemovedClassRules(classRulePlayerClassArray);
	}
	
	// Descent skill listeners
	self.descentSkillSelectionListener = function(event){
		self.selectionListener(event, "descent");
	}
	
	self.descentSkillSelectButtonListener = function(event){
		self.selectButtonListener(event, "descent");
		
		// Update overviews in other tabs
		self.updateAlreadySelectedClassTab();
		self.updateAlreadySelectedNonClassTab();
		self.updateOverviewDescentSkills();
	}
	
	self.descentSkillRemoveButtonListener = function(event){
		self.removeButtonListener(event, "descent");

		// Update overviews in other tabs
		self.updateAlreadySelectedClassTab();
		self.updateAlreadySelectedNonClassTab();
		self.updateOverviewDescentSkills();
	}
	
	self.descentSkillOptionListener = function(event){
		self.optionListener(event, "descent");
	}
	
	// Class skill listeners
	self.classSkillSelectionListener = function(){
		self.selectionListener(event, "character_class");
	}
	
	self.classSkillSelectButtonListener = function(){
		self.selectButtonListener(event, "character_class");
		
		// Update overviews in other tabs
		self.updateAlreadySelectedDescentTab();
		self.updateAlreadySelectedNonClassTab();
		self.updateOverviewClassSkills();
	}
	
	self.classSkillRemoveButtonListener = function(event){
		self.removeButtonListener(event, "character_class");

		// Update overviews in other tabs
		self.updateAlreadySelectedDescentTab();
		self.updateAlreadySelectedNonClassTab();
		self.updateOverviewClassSkills();
	}
	
	self.classSkillOptionListener = function(event){
		self.optionListener(event, "character_class");
	}
	
	// Non Class skill listeners
	self.nonClassSkillSelectionListener = function(){
		self.selectionListener(event, "character_non_class");
	}
	
	self.nonClassSkillSelectButtonListener = function(){
		self.selectButtonListener(event, "character_non_class");
		
		// Update overviews in other tabs
		self.updateAlreadySelectedClassTab();
		self.updateAlreadySelectedDescentTab();
		self.updateOverviewNonClassSkills();
	}
	
	self.nonClassSkillRemoveButtonListener = function(event){
		self.removeButtonListener(event, "character_non_class");

		// Update overviews in other tabs
		self.updateAlreadySelectedClassTab();
		self.updateAlreadySelectedDescentTab();
		self.updateOverviewNonClassSkills();
	}
	
	self.nonClassSkillOptionListener = function(event){
		self.optionListener(event, "character_non_class");
	}
	
	// ****************************
	// Functions to update information on other tabs
	// ****************************
	self.updateForSelectedClassRules = function(classRulePlayerClassArray){
		if(classRulePlayerClassArray.length <= 0){
			return;
		}
		
		var classIdArray = new Array();
		classIdArray.push(JSON.parse($("#char_class_ids").data('value')));
		
		// get all player classes
		for(var i=0; i < classRulePlayerClassArray.length; i++){
			if(classIdArray.indexOf(classRulePlayerClassArray[i]['id']) < 0){
				classIdArray.push(classRulePlayerClassArray[i]['id']);
			}
		}

		// for lazy purposes, remember the current character class ids
		$("#char_class_ids").data('value', JSON.stringify(classIdArray));
		
		// check if a skill in the non-class lists is now a class skill.
		// if so: move to class skills.
		$.each($("#character_non_class_skill_options .character_non_class_skill_option"), function(){
			if(self.isClassSkill(this, classIdArray)){
				var skill_id = $(this).data("id");
				
				// move entry from options to class skills
				var skill_tr_option = $(".character_non_class_skill_option_"+skill_id);
				$(skill_tr_option).removeClass("character_non_class_skill_option_"+skill_id);
				$(skill_tr_option).removeClass("character_non_class_skill_option");
				$(skill_tr_option).addClass("character_class_skill_option_"+skill_id);
				$(skill_tr_option).addClass("character_class_skill_option");
				$(skill_tr_option).attr("onclick",
						"CreatePlayerCharSkills.classSkillOptionListener(event)"
					);
				$("#character_class_skill_options").append(skill_tr_option);
				
				// adjust ep_cost
				var ep_value = $(skill_tr_option).data("ep_cost")/2;
				$(skill_tr_option).data("ep_cost", ep_value);
				$(skill_tr_option).find(".skill_ep_cost").html(""+ep_value);

				// move entry from selections to class skills
				var skill_tr_selection = $(".character_non_class_skill_selection_"+skill_id);
				$(skill_tr_selection).removeClass("character_non_class_skill_selection_"+skill_id);
				$(skill_tr_selection).removeClass("character_non_class_skill_selection");
				$(skill_tr_selection).addClass("character_class_skill_selection_"+skill_id);
				$(skill_tr_selection).addClass("character_class_skill_selection");
				$(skill_tr_selection).attr("onclick",
					"CreatePlayerCharSkills.classSkillSelectionListener(event)"
					);
				$("#character_class_skill_selected").append(skill_tr_selection);

				// adjust ep_cost
				var ep_value = $(skill_tr_selection).data("ep_cost")/2;
				$(skill_tr_selection).data("ep_cost", ep_value);
				$(skill_tr_selection).find(".skill_ep_cost").html(""+ep_value);
				
				// Now check if that skill might have been selected already,
				// and move the entry from one hidden list to the other.
				var class_skill_id_list = JSON.parse($("#character_class_skill_list_hidden").val());
				var non_class_skill_id_list = JSON.parse($("#character_non_class_skill_list_hidden").val());
				var indexOfSkill = non_class_skill_id_list.indexOf(skill_id);
				if(indexOfSkill >= 0){
					// skill was selected
					// remove from non_class. Add to class
					non_class_skill_id_list.splice(indexOfSkill, 1);
					class_skill_id_list.push(skill_id);
					
					$("#character_class_skill_list_hidden").val(JSON.stringify(class_skill_id_list));
					$("#character_non_class_skill_list_hidden").val(JSON.stringify(non_class_skill_id_list));
				}
			}
		} );

		// Re-sort the tables
//		$("#character_class_skill_options th[data-field='name']").click();
//		$("#character_class_skill_selected th[data-field='name']").click();
//		$("#character_non_class_skill_options th[data-field='name']").click();
//		$("#character_non_class_skill_selected th[data-field='name']").click();
		
		// re-calculate the spent EP
		var total_spent_ep = 0;
		$.each($("#character_non_class_skill_selected .skillSelected"), function(){
			total_spent_ep += $(this).data("ep_cost");
		});
		$.each($("#character_class_skill_selected .skillSelected"), function(){
			total_spent_ep += $(this).data("ep_cost");
		});
		
		self.updateSkillEP(total_spent_ep);
	}
	
	self.updateForRemovedClassRules = function(classRulePlayerClassArray){
		if(classRulePlayerClassArray.length <= 0){
			return;
		}
		
		var classIdArray = new Array();
		classIdArray.push(JSON.parse($("#input_character_class").val()));
		
		// get any additional classes from the already selected skills
		// not marked for removal
		$.each( $("#character_class_skill_selected .skillSelected").not(".selected"), function(){
			var class_rules = $(this).data("class_rules");
			for(var i=0; i < class_rules.length; i++){
				classIdArray.push(class_rules[i]['id']);				
			}
		});
		
		// for lazy purposes, remember the current character class ids
		$("#char_class_ids").data('value', JSON.stringify(classIdArray));

		// check if a skill in the class lists is no longer a class skill.
		// if so: move to non class skills.
		$.each($("#character_class_skill_selected .character_class_skill_selection"), function(){
			if(!(self.isClassSkill(this, classIdArray))){
				var skill_id = $(this).data("id");
				
				// move entry from options to class skills
				var skill_tr_option = $(".character_class_skill_option_"+skill_id);
				$(skill_tr_option).removeClass("character_class_skill_option_"+skill_id);
				$(skill_tr_option).removeClass("character_class_skill_option");
				$(skill_tr_option).addClass("character_non_class_skill_option_"+skill_id);
				$(skill_tr_option).addClass("character_non_class_skill_option");
				$(skill_tr_option).attr("onclick",
					"CreatePlayerCharSkills.nonClassSkillOptionListener(event)"
					);
				$("#character_non_class_skill_options").append(skill_tr_option);
				
				// adjust ep_cost
				var ep_value = $(skill_tr_option).data("ep_cost")*2;
				$(skill_tr_option).data("ep_cost", ep_value);
				$(skill_tr_option).find(".skill_ep_cost").html(""+ep_value);

				// move entry from selections to class skills
				var skill_tr_selection = $(".character_class_skill_selection_"+skill_id);
				$(skill_tr_selection).removeClass("character_class_skill_selection_"+skill_id);
				$(skill_tr_selection).removeClass("character_class_skill_selection");
				$(skill_tr_selection).addClass("character_non_class_skill_selection_"+skill_id);
				$(skill_tr_selection).addClass("character_non_class_skill_selection");
				$(skill_tr_selection).attr("onclick",
					"CreatePlayerCharSkills.nonClassSkillSelectionListener(event)"
					);
				$("#character_non_class_skill_selected").append(skill_tr_selection);
				
				// adjust ep_cost
				var ep_value = $(skill_tr_selection).data("ep_cost")*2;
				$(skill_tr_selection).data("ep_cost", ep_value);
				$(skill_tr_selection).find(".skill_ep_cost").html(""+ep_value);

				// Now check if that skill might have been selected already,
				// and move the entry from one hidden list to the other.
				var class_skill_id_list = JSON.parse($("#character_class_skill_list_hidden").val());
				var non_class_skill_id_list = JSON.parse($("#character_non_class_skill_list_hidden").val());
				var indexOfSkill = class_skill_id_list.indexOf(skill_id);
				if(indexOfSkill >= 0){
					// skill was selected
					// remove from non_class. Add to class
					class_skill_id_list.splice(indexOfSkill, 1);
					non_class_skill_id_list.push(skill_id);
					
					$("#character_class_skill_list_hidden").val(JSON.stringify(class_skill_id_list));
					$("#character_non_class_skill_list_hidden").val(JSON.stringify(non_class_skill_id_list));
				}				
			}
		} );

		// Re-sort the tables
//		$("#character_non_class_skill_options th[data-field='name']").click();
//		$("#character_non_class_skill_selected th[data-field='name']").click();
//		$("#character_class_skill_options th[data-field='name']").click();
//		$("#character_class_skill_selected th[data-field='name']").click();
		
		// re-calculate the spent EP
		var total_spent_ep = 0;
		$.each($("#character_non_class_skill_selected .skillSelected"), function(){
			total_spent_ep += $(this).data("ep_cost");
		});
		$.each($("#character_class_skill_selected .skillSelected"), function(){
			total_spent_ep += $(this).data("ep_cost");
		});
		
		self.updateSkillEP(total_spent_ep);
		
		if($(".spent_character_ep").data('ep_amount') >
			$(".total_character_ep").data('ep_amount')){
			// due to increase in non-class skill cost, the character
			// now has more spent EP that he actually has.
			// Fire warning and disable save button.
			ErrorMessage.showErrorMessage("Je hebt teveel EP door toegenomen kosten van Niet-klasse Vaardigheden. " +
					"Totdat je onder je toegestane EP-niveau zit, kan je dit karakter niet opslaan.");
		}
		
	}
	
	self.isClassSkill = function(skillTableRow, classIdArray){
		skillClassIdArray = JSON.parse($(skillTableRow).find(".player_classes").data('value'));
		
		for(var i=0; i < classIdArray.length; i++){
			// Check for index 1 is for General skills
			if(skillClassIdArray.indexOf(classIdArray[i]) >= 0
			  || skillClassIdArray.indexOf(1) >= 0){
				return true;
			}
		}
		
		return false;
	}
	
	self.updateAlreadySelectedClassTab = function(){
		var skillString = 
			self.getSkillNameArrayFromTabs(
					'descent_skill_list_hidden',
					'character_non_class_skill_list_hidden');
		$('#already_selected_class_skills').html(skillString);
		if(skillString != 'Geen'){
			$('#already_selected_class_skills').removeClass('warning_not_entered');
		}else{
			$('#already_selected_class_skills').addClass('warning_not_entered');
		}
		
		// now hide/show all skills selected in other tabs
		var totalSkillArray = JSON.parse($("#descent_skill_list_hidden").val()).concat(JSON.parse($("#character_non_class_skill_list_hidden").val()));
		$('.character_class_skill_option').removeClass('hidden');
		for(var i=0; i < totalSkillArray.length; i++){
			$('.character_class_skill_option_'+totalSkillArray[i]).addClass('hidden');
		}
		var classSkills = JSON.parse($("#character_class_skill_list_hidden").val());
		for(var i=0; i < classSkills.length; i++){
			$('.character_class_skill_option_'+classSkills[i]).addClass('hidden');
		}
	}
	
	self.updateAlreadySelectedNonClassTab = function(){
		var skillString = 
			self.getSkillNameArrayFromTabs(
					'descent_skill_list_hidden',
					'character_class_skill_list_hidden');
		$('#already_selected_non_class_skills').html(skillString);
		if(skillString != 'Geen'){
			$('#already_selected_non_class_skills').removeClass('warning_not_entered');
		}else{
			$('#already_selected_non_class_skills').addClass('warning_not_entered');
		}	

		// now hide/show all skills selected in other tabs
		var totalSkillArray = JSON.parse($("#descent_skill_list_hidden").val()).concat(JSON.parse($("#character_class_skill_list_hidden").val()));
		$('.character_non_class_skill_option').removeClass('hidden');
		for(var i=0; i < totalSkillArray.length; i++){
			$('.character_non_class_skill_option_'+totalSkillArray[i]).addClass('hidden');
		}
		var nonClassSkills = JSON.parse($("#character_non_class_skill_list_hidden").val());
		for(var i=0; i < nonClassSkills.length; i++){
			$('.character_non_class_skill_option_'+nonClassSkills[i]).addClass('hidden');
		}
	}

	self.updateAlreadySelectedDescentTab = function(){
		var skillString = 
			self.getSkillNameArrayFromTabs(
					'character_non_class_skill_list_hidden',
					'character_class_skill_list_hidden');
		$('#already_selected_descent_skills').html(skillString);
		if(skillString != 'Geen'){
			$('#already_selected_descent_skills').removeClass('warning_not_entered');
		}else{
			$('#already_selected_descent_skills').addClass('warning_not_entered');
		}		

		// now hide/show all skills selected in other tabs
		var totalSkillArray = JSON.parse($("#character_class_skill_list_hidden").val()).concat(JSON.parse($("#character_non_class_skill_list_hidden").val()));
		$('.descent_skill_option').removeClass('hidden');
		for(var i=0; i < totalSkillArray.length; i++){
			$('.descent_skill_option_'+totalSkillArray[i]).addClass('hidden');
		}
		var descentSkills = JSON.parse($("#descent_skill_list_hidden").val());
		for(var i=0; i < descentSkills.length; i++){
			$('.descent_skill_option_'+descentSkills[i]).addClass('hidden');
		}
	}
	
	self.getSkillNameArrayFromTab = function(hidden_list){
		var retStringArray = [];
		
		if($("#"+hidden_list).length > 0){
			var skillArray = JSON.parse($("#"+hidden_list).val());
		
			if(skillArray.length != 0){
				for(var i=0; i < skillArray.length; i++){
					retStringArray.push(self.getNameOfSkill(skillArray[i]));
				}
			}
		}
		
		return retStringArray.sort();
	}
	
	self.getSkillNameArrayFromTabs = function(hidden_list1, hidden_list2){
		var returnString = 'Geen';
		var skillStringArray1 = self.getSkillNameArrayFromTab(hidden_list1);
		var skillStringArray2 = self.getSkillNameArrayFromTab(hidden_list2);

		if( skillStringArray1.length > 0 || skillStringArray2.length > 0){
			returnString = skillStringArray1.concat(skillStringArray2).sort().join(', ');
		}
		
		return returnString;
	}
	
	self.updateOverviewDescentSkills = function(){
		var overviewSkillArray = self.getSkillNameArrayFromTab("descent_skill_list_hidden");
		
		if(overviewSkillArray.length > 0){
			$("#overview_descent_skills").html(overviewSkillArray.join(', '));
			$("#overview_descent_skills").removeClass("warning_not_entered");
		}else{
			$("#overview_descent_skills").html("Niet geselecteerd");
			$("#overview_descent_skills").addClass("warning_not_entered");
		}
		
		// Now update the overview for any special rules from the skills
		var rules = self.getOverviewRulesFromTab("descent_skill_list_hidden");
		self.updateResistanceRules(rules['res_rules'], 'descent');
		self.updateStatisticRules(rules['stat_rules'], 'descent');
		self.updateWealthRules(rules['wealth_rules'], 'descent');
	}
	
	self.updateOverviewClassSkills = function(){
		var overviewSkillArray = self.getSkillNameArrayFromTab("character_class_skill_list_hidden");
		
		if(overviewSkillArray.length > 0){
			$("#overview_class_skills").html(overviewSkillArray.join(', '));
			$("#overview_class_skills").removeClass("warning_not_entered");
		}else{
			$("#overview_class_skills").html("Niet geselecteerd");
			$("#overview_class_skills").addClass("warning_not_entered");
		}

		// Now update the overview for any special rules from the skills
		var rules = self.getOverviewRulesFromTab("character_class_skill_list_hidden");
		self.updateResistanceRules(rules['res_rules'], 'class');
		self.updateStatisticRules(rules['stat_rules'], 'class');
		self.updateWealthRules(rules['wealth_rules'], 'class');
	}
	
	self.updateOverviewNonClassSkills = function(){
		var overviewSkillArray = self.getSkillNameArrayFromTab("character_non_class_skill_list_hidden");
		
		if(overviewSkillArray.length > 0){
			$("#overview_non_class_skills").html(overviewSkillArray.join(', '));
			$("#overview_non_class_skills").removeClass("warning_not_entered");
		}else{
			$("#overview_non_class_skills").html("Niet geselecteerd");
			$("#overview_non_class_skills").addClass("warning_not_entered");
		}

		// Now update the overview for any special rules from the skills
		var rules = self.getOverviewRulesFromTab("character_non_class_skill_list_hidden");
		self.updateResistanceRules(rules['res_rules'], 'nonclass');
		self.updateStatisticRules(rules['stat_rules'], 'nonclass');
		self.updateWealthRules(rules['wealth_rules'], 'nonclass');
	}
	
	self.updateResistanceRules = function(rules, sourceTab){
		var resIdUpdateArray = new Array();
		
		if(rules.length <= 0){
			return;
		}
		
		for(var i=0;i<rules.length;i++){
			var rule = rules[i];
			var newValue = 0;
			
			if(!(rule['resistance_id'] in resIdUpdateArray)){
				resIdUpdateArray[rule['resistance_id']] = 0;
			}
			
			if(rule['rules_operator'] == '+'){
				resIdUpdateArray[rule['resistance_id']] =
					resIdUpdateArray[rule['resistance_id']] + rule['value'];
			}else if(rule['rules_operator'] == '-'){
				resIdUpdateArray[rule['resistance_id']] =
					resIdUpdateArray[rule['resistance_id']] - rule['value'];
			}
		}

		// Clear and update everything
		$.each($(".overview_res"), function(){
			var resId = $(this).attr('id').split('_')[2];
			
			if(resId in resIdUpdateArray){
				$("#overview_res_"+resId).data(sourceTab, resIdUpdateArray[resId]);
			}else{
				$("#overview_res_"+resId).data(sourceTab, 0);
			}
			
			$(this).data('value', 0);
			$(this).html(0);

			var newTotal = $("#overview_res_"+resId).data('descent')
				+ $("#overview_res_"+resId).data('class')
				+ $("#overview_res_"+resId).data('nonclass');
			
			$("#overview_res_"+resId).data('value', newTotal);
			$("#overview_res_"+resId).html(newTotal);
		});
	}
	
	self.updateStatisticRules = function(rules, sourceTab){
		var statIdUpdateArray = new Array();
		
		if(rules.length <= 0){
			return;
		}
		
		for(var i=0;i<rules.length;i++){
			var rule = rules[i];
			var newValue = 0;
			
			if(!(rule['statistic_id'] in statIdUpdateArray)){
				statIdUpdateArray[rule['statistic_id']] = 0;
			}
			
			if(rule['rules_operator'] == '+'){
				statIdUpdateArray[rule['statistic_id']] =
					statIdUpdateArray[rule['statistic_id']] + rule['value'];
			}else if(rule['rules_operator'] == '-'){
				statIdUpdateArray[rule['statistic_id']] =
					statIdUpdateArray[rule['statistic_id']] - rule['value'];
			}
		}

		// Clear and update everything
		$.each($(".overview_stat"), function(){
			var statId = $(this).attr('id').split('_')[2];
			
			if(statId != 11){
				if(statId in statIdUpdateArray){
					$("#overview_stat_"+statId).data(sourceTab, statIdUpdateArray[statId]);
				}else{
					$("#overview_stat_"+statId).data(sourceTab, 0);
				}
				
				$(this).data('value', 0);
				$(this).html(0);
	
				var newTotal = $("#overview_stat_"+statId).data('base')
					+ $("#overview_stat_"+statId).data('descent')
					+ $("#overview_stat_"+statId).data('class')
					+ $("#overview_stat_"+statId).data('nonclass');
				
				$("#overview_stat_"+statId).data('value', newTotal);
				$("#overview_stat_"+statId).html(newTotal);
				
				if(statId == 1){
					// these are the torso lps. Also update limbs.
					$("#overview_stat_11").data('value', (newTotal-1));
					$("#overview_stat_11").html(newTotal-1);
				}
			}
		});
	}
	
	self.updateWealthRules = function(rules, sourceTab){
		var statIdUpdateArray = new Array();
		var newTabWealthId = 1;
		
		if(rules.length <= 0){
			return;
		}
		
		for(var i=0;i<rules.length;i++){
			var rule = rules[i];
			
			if(rule["value_type_id"] > newTabWealthId){
				newTabWealthId = rule["value_type_id"]; 
			}
		}

		$("#overview_wealth").data(sourceTab, newTabWealthId);
		
		// Clear and update everything
		var newWealthValue = newTabWealthId;
		if($("#overview_wealth").data('base') > newWealthValue){
			newWealthValue = $("#overview_wealth").data('base');
		} 
		if($("#overview_wealth").data('descent') > newWealthValue){
			newWealthValue = $("#overview_wealth").data('descent');
		} 
		if($("#overview_wealth").data('class') > newWealthValue){
			newWealthValue = $("#overview_wealth").data('descent');
		} 
		if($("#overview_wealth").data('nonclass') > newWealthValue){
			newWealthValue = $("#overview_wealth").data('descent');
		} 
		
		$("#overview_wealth").data('value', newWealthValue);
		$("#overview_wealth").html(self.getWealthType(newWealthValue));
	}
	
	self.getOverviewRulesFromTab = function(hidden_list){
		var retSkillArray = {
				"class_rules":new Array(),
				"res_rules":new Array(),
				"stat_rules":new Array(),
				"wealth_rules":new Array(),
		};
		
		if($("#"+hidden_list).length > 0){
			var skillIdArray = JSON.parse($("#"+hidden_list).val());
		
			if(skillIdArray.length != 0){
				for(var i=0; i < skillIdArray.length; i++){
					var rules = self.getRulesForOverview(skillIdArray[i]);
					
					retSkillArray["class_rules"] = retSkillArray["class_rules"].concat(rules["class_rules"]);
					retSkillArray["res_rules"] = retSkillArray["res_rules"].concat(rules["res_rules"]);
					retSkillArray["stat_rules"] = retSkillArray["stat_rules"].concat(rules["stat_rules"]);
					retSkillArray["wealth_rules"] = retSkillArray["wealth_rules"].concat(rules["wealth_rules"]);
				}
			}
		}
		
		return retSkillArray;
	}
	
	self.getRulesForOverview = function(skill_id){
		var retSkillArray = {
				"class_rules":new Array(),
				"res_rules":new Array(),
				"stat_rules":new Array(),
				"wealth_rules":new Array(),
		};
		
		var skill = new Array();
		
		if($('.character_non_class_skill_option_'+skill_id).length){
			skill = $('.character_non_class_skill_option_'+skill_id).data();
		}else if($('.character_class_skill_option_'+skill_id).length){
			skill = $('.character_class_skill_option_'+skill_id).data();
		}
		
		if(skill != undefined && skill != null){
			if("class_rules" in skill){
				retSkillArray["class_rules"] = skill["class_rules"];
			}
			if("res_rules" in skill){
				retSkillArray["res_rules"] = skill["res_rules"];
			}
			if("stat_rules" in skill){
				retSkillArray["stat_rules"] = skill["stat_rules"];
			}
			if("wealth_rules" in skill){
				retSkillArray["wealth_rules"] = skill["wealth_rules"];
			}
		}
		
		return retSkillArray;
	}

	self.descentSkillSearch = function(){
		var value = $("#descentSkillSearch").val().toLowerCase();

		if(value == 'undefined' || value == ""){
			$("#descent_race_skill_options .deselect").each(function(){
				$(this).removeClass("deselect");
			});
			return;
		}

		var found = false;

		$("#descent_race_skill_options .descent_skill_option").each(function(){
			var skillname = $(this).find(".skillname").attr('id').toLowerCase();
			
			if(skillname.indexOf(value) > -1){
				found = true;

				if($(this).hasClass("deselect")){
					$(this).removeClass("deselect");
				}
			} else {
				$(this).addClass("deselect");
			}
		});

		// Double check if the search string is actually found
		// If not, show everything again, plus display the feedback message.
		if(!found){
			$("#descent_race_skill_options .deselect").each(function(){
				$(this).removeClass("deselect");
			});

			$("#descentSkillSearchRespons").fadeIn("fast", function(){});

			setTimeout(function(){
				$("#descentSkillSearchRespons").fadeOut("fast", function(){});
			}, 3500);
		}
	}

	self.classSkillSearch = function(){
		var value = $("#classSkillSearch").val();
		$("#nonClassSkillSearch").val(value);
		value = value.toLowerCase();

		self.handleClassNonClassSkillSearch(value, "class");
	}

	self.nonClassSkillSearch = function(){
		var value = $("#nonClassSkillSearch").val();
		$("#classSkillSearch").val(value);
		value = value.toLowerCase();

		self.handleClassNonClassSkillSearch(value, "nonClass");
	}

	self.handleClassNonClassSkillSearch = function(searchString, caller){
		if(searchString == 'undefined' || searchString == ""){
			$("#character_class_skill_options .deselect").each(function(){
				$(this).removeClass("deselect");
			});

			$("#character_non_class_skill_options .deselect").each(function(){
				$(this).removeClass("deselect");
			});

			return;
		}

		var found = false;
		var secondChanceFound = false;

		if( caller === "class"){
			$("#character_class_skill_options .character_class_skill_option").each(function(){
				var skillname = $(this).find(".skillname").attr('id').toLowerCase();
				
				if(skillname.indexOf(searchString) > -1){
					found = true;

					if($(this).hasClass("deselect")){
						$(this).removeClass("deselect");
					}
				} else {
					$(this).addClass("deselect");
				}
			});

			// Check if the search string might be in the non_class skills
			$("#character_non_class_skill_options .character_non_class_skill_option").each(function(){
				var skillname = $(this).find(".skillname").attr('id').toLowerCase();
				
				if(skillname.indexOf(searchString) > -1){
					secondChanceFound = true;

					if($(this).hasClass("deselect")){
						$(this).removeClass("deselect");
					}
				} else {
					$(this).addClass("deselect");
				}
			});

			if(secondChanceFound){
				// the search string is found in the non-class skills. Notify the user
				$("#classSkillSearchResponsNonClass").fadeIn("fast", function(){});

				setTimeout(function(){
					$("#classSkillSearchResponsNonClass").fadeOut("fast", function(){});
				}, 3500);
			}
		} else {
			$("#character_non_class_skill_options .character_non_class_skill_option").each(function(){
				var skillname = $(this).find(".skillname").attr('id').toLowerCase();
				
				if(skillname.indexOf(searchString) > -1){
					found = true;

					if($(this).hasClass("deselect")){
						$(this).removeClass("deselect");
					}
				} else {
					$(this).addClass("deselect");
				}
			});

			// Check if the search string might be in the class skills
			$("#character_class_skill_options .character_class_skill_option").each(function(){
				var skillname = $(this).find(".skillname").attr('id').toLowerCase();
				
				if(skillname.indexOf(searchString) > -1){
					secondChanceFound = true;

					if($(this).hasClass("deselect")){
						$(this).removeClass("deselect");
					}
				} else {
					$(this).addClass("deselect");
				}
			});

			if(secondChanceFound){
				// the search string is found in the class skills. Notify the user
				$("#classSkillSearchResponsClass").fadeIn("fast", function(){});

				setTimeout(function(){
					$("#classSkillSearchResponsClass").fadeOut("fast", function(){});
				}, 3500);
			}			
		}

		if(!found){
			// the search string was not found at all
			$("#character_class_skill_options .deselect").each(function(){
				$(this).removeClass("deselect");
			});
			$("#character_non_class_skill_options .deselect").each(function(){
				$(this).removeClass("deselect");
			});

			$(".classSkillSearchResponsNotFound").fadeIn("fast", function(){});

			setTimeout(function(){
				$(".classSkillSearchResponsNotFound").fadeOut("fast", function(){});
			}, 3500);
		}
	}
}