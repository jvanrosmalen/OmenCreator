var createCharacterControl = new function(){
	var self = this;
	
	self.checkDescentEp = function(ep_cost){
		return ($("#spent_descent_ep").data('ep_amount') + ep_cost) <=
									$("#total_descent_ep").data('ep_amount');
	}
	
	self.updateDescentEP = function(value){
		$("#spent_descent_ep").data('ep_amount', value );
		$("#spent_descent_ep").html(value);
	}
	
	self.removeDescentEp = function(ep_cost){
		var newValue = $("#spent_descent_ep").data('ep_amount') - ep_cost;
		createCharacterControl.updateDescentEP(newValue);
	}

	self.addDescentEp = function(ep_cost){
		var newValue = $("#spent_descent_ep").data('ep_amount') + ep_cost;
		createCharacterControl.updateDescentEP(newValue);
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
		createCharacterControl.updateSkillEP(newValue);
	}

	self.addSkillEp = function(ep_cost){
		var newValue = $(".spent_character_ep").data('ep_amount') + ep_cost;
		createCharacterControl.updateSkillEP(newValue);
	}
	
	self.getNameOfSkill = function(skill_id){
		if($('.character_non_class_skill_option_'+skill_id).length){
			return $('.character_non_class_skill_option_'+skill_id+' td.skillname').html();
		}else if($('.character_class_skill_option_'+skill_id).length){
			return $('.character_class_skill_option_'+skill_id+' td.skillname').html();
		}
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
	
	self.getSkillNameArrayFromTab = function(hidden_list){
		var retStringArray = [];
		
		if($("#"+hidden_list).length > 0){
			var skillArray = JSON.parse($("#"+hidden_list).val());
		
			if(skillArray.length != 0){
				for(var i=0; i < skillArray.length; i++){
					retStringArray.push(createCharacterControl.getNameOfSkill(skillArray[i]));
				}
			}
		}
		
		return retStringArray.sort();
	}
	
	self.getSkillNameArrayFromTabs = function(hidden_list1, hidden_list2){
		var returnString = 'Geen';
		var skillStringArray1 = createCharacterControl.getSkillNameArrayFromTab(hidden_list1);
		var skillStringArray2 = createCharacterControl.getSkillNameArrayFromTab(hidden_list2);

		if( skillStringArray1.length > 0 || skillStringArray2.length > 0){
			returnString = skillStringArray1.concat(skillStringArray2).sort().join(', ');
		}
		
		return returnString;
	}
	
	self.updateAlreadySelectedClassTab = function(){
		var skillString = 
			createCharacterControl.getSkillNameArrayFromTabs(
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
	
	self.checkStatPrereqs = function(skillData){
		// check all stat prereqs
		if($("#overview_stat_"+skillData['statistic_prereq_id']).data('value')
				>= skillData['statistic_prereq_amount']){
			return true;
		}else{
			alert("Je moet minimaal "+ skillData['statistic_prereq_amount'] +
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
					alert("Het nemen van deze vaardigheid heeft geen zin." +
							" Je bent al minimaal "
							+ CreateCharacter.getWealthType(skillData['wealth_rules'][0]['value_type_id'])
							+ ".")
							
					return false;
				}
			}
			
			// It's useful to take this skill.
			return true;
		} else {
			alert("Je moet minimaal "
					+ CreateCharacter.getWealthType(wealth_prereq_id)
					+ " zijn om deze vaardigheid te kunnen selecteren.");
			
			return false;
		}
	}
	
	self.hasSkill = function(skillId){
		return (JSON.parse($("#descent_skill_list_hidden").val()).indexOf(skillId) >= 0
				||	JSON.parse($("#character_class_skill_list_hidden").val()).indexOf(skillId) >= 0
				||  JSON.parse($("#character_non_class_skill_list_hidden").val()).indexOf(skillId) >= 0);
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
			if(!createCharacterControl.hasSkill(prereq_skill['id'])){
				problem = true;
				
				problemArray.push(prereq_skill['name']);
			}
		}
		
		if(problem && skillSet2Array.length > 0){
			// There is a second skill set for prereqs. Check if 
			// those prereqs are met.
			for(var i=0; i < skillSet2Array.length; i++){
				var prereq_skill = skillSet2Array[i];
				
				if(!createCharacterControl.hasSkill(prereq_skill['id'])){
					problem2  = true;
					
					problem2Array.push(prereq_skill['name']);
				}
			}
		}
		
		for(var i=0; i < skillData['skill_group_prereqs'].length; i++){
			var prereq_skillgroup = skillData['skill_group_prereqs'][i];
			
			if(prereq_skillgroup['pivot']['prereq_set'] == 2){
				skillGroupSet2Array.push(prereq_skill);
				continue;				
			}
			
			var groupProblem = true;
			
			for(var j=0; j < prereq_skillgroup['group_skills'].length; j++){
				var prereq_skill = prereq_skillgroup['group_skills'][j];
				// check if skill is in all hidden lists with skills
				if(createCharacterControl.hasSkill(prereq_skill['id'])){
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
				
				for(var j=0; j < skillGroupSet2Array.length; j++){
					var prereq_skill = skillGroupSet2Array[j];
					// check if skill is in all hidden lists with skills
					if(createCharacterControl.hasSkill(prereq_skill['id'])){
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
			if(!problem2 && skillSet2Array.length > 0){
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
				
				alert(warningStr);
				return false;
			}
		}
	}
	
	self.checkAllPrereqs = function(skillData){
		// check stat prereqs
		if(!createCharacterControl.checkStatPrereqs(skillData)){
			return false;
		}
		// check skill prereqs
		if(!createCharacterControl.checkSkillPrereqs(skillData)){
			return false;
		}
		// check wealth prereqs
		if(!createCharacterControl.checkWealthPrereqs(skillData)){
			return false;
		}
		
		return true;
	}
	
	self.updateAlreadySelectedNonClassTab = function(){
		var skillString = 
			createCharacterControl.getSkillNameArrayFromTabs(
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
			createCharacterControl.getSkillNameArrayFromTabs(
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
					var rules = createCharacterControl.getRulesForOverview(skillIdArray[i]);
					
					retSkillArray["class_rules"] = retSkillArray["class_rules"].concat(rules["class_rules"]);
					retSkillArray["res_rules"] = retSkillArray["res_rules"].concat(rules["res_rules"]);
					retSkillArray["stat_rules"] = retSkillArray["stat_rules"].concat(rules["stat_rules"]);
					retSkillArray["wealth_rules"] = retSkillArray["wealth_rules"].concat(rules["wealth_rules"]);
				}
			}
		}
		
		return retSkillArray;
	}
	
	self.updateResistanceRules = function(rules, sourceTab){
		var resIdUpdateArray = new Array();
		
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
		$("#overview_wealth").html(CreateCharacter.getWealthType(newWealthValue));
	}
	
	self.updateOverviewDescentSkills = function(){
		var overviewSkillArray = createCharacterControl.getSkillNameArrayFromTab("descent_skill_list_hidden");
		
		if(overviewSkillArray.length > 0){
			$("#overview_descent_skills").html(overviewSkillArray.join(', '));
			$("#overview_descent_skills").removeClass("warning_not_entered");
		}else{
			$("#overview_descent_skills").html("Niet geselecteerd");
			$("#overview_descent_skills").addClass("warning_not_entered");
		}
		
		// Now update the overview for any special rules from the skills
		var rules = createCharacterControl.getOverviewRulesFromTab("descent_skill_list_hidden");
		createCharacterControl.updateResistanceRules(rules['res_rules'], 'descent');
		createCharacterControl.updateStatisticRules(rules['stat_rules'], 'descent');
		createCharacterControl.updateWealthRules(rules['wealth_rules'], 'descent');
	}
	
	self.updateOverviewClassSkills = function(){
		var overviewSkillArray = createCharacterControl.getSkillNameArrayFromTab("character_class_skill_list_hidden");
		
		if(overviewSkillArray.length > 0){
			$("#overview_class_skills").html(overviewSkillArray.join(', '));
			$("#overview_class_skills").removeClass("warning_not_entered");
		}else{
			$("#overview_class_skills").html("Niet geselecteerd");
			$("#overview_class_skills").addClass("warning_not_entered");
		}

		// Now update the overview for any special rules from the skills
		var rules = createCharacterControl.getOverviewRulesFromTab("character_class_skill_list_hidden");
		createCharacterControl.updateResistanceRules(rules['res_rules'], 'class');
		createCharacterControl.updateStatisticRules(rules['stat_rules'], 'class');
		createCharacterControl.updateWealthRules(rules['wealth_rules'], 'class');
	}
	
	self.updateOverviewNonClassSkills = function(){
		var overviewSkillArray = createCharacterControl.getSkillNameArrayFromTab("character_non_class_skill_list_hidden");
		
		if(overviewSkillArray.length > 0){
			$("#overview_non_class_skills").html(overviewSkillArray.join(', '));
			$("#overview_non_class_skills").removeClass("warning_not_entered");
		}else{
			$("#overview_non_class_skills").html("Niet geselecteerd");
			$("#overview_non_class_skills").addClass("warning_not_entered");
		}

		// Now update the overview for any special rules from the skills
		var rules = createCharacterControl.getOverviewRulesFromTab("character_non_class_skill_list_hidden");
		createCharacterControl.updateResistanceRules(rules['res_rules'], 'nonclass');
		createCharacterControl.updateStatisticRules(rules['stat_rules'], 'nonclass');
		createCharacterControl.updateWealthRules(rules['wealth_rules'], 'nonclass');
	}
	
	self.addDescentSkillListeners = function(){
		// Descent race skill selection listener
		$(".descent_skill_selection").on("click", function(){
			$(".descent_skill_option.selected").each(function(){
				$(this).removeClass("selected");
			});
			$(".descent_race_skill_select_btn").addClass('disabled');

			if($(this).hasClass("selected")){
				$(this).removeClass("selected");
			}else{
				$(this).addClass("selected");
			}
			
			if($(".descent_skill_selection.selected").length > 0){
				// there are selections
				$(".descent_race_skill_remove_btn").removeClass('disabled');
			} else {
				// no selections found
				$(".descent_race_skill_remove_btn").addClass('disabled');
			}
			
		});
		
		// Descent race skill button listeners
		$(".descent_race_skill_select_btn").on("click", function(){
			if($(this).hasClass("disabled")){
				return;
			}

			var descentSkillArray = new Array();

			if($("#descent_skill_list_hidden").val()){
				descentSkillArray = JSON.parse($("#descent_skill_list_hidden").val());
			}
			
			$(".descent_skill_option.selected").each(function(){
				var descent_skill_id = $(this).data("id");
				
				createCharacterControl.addDescentEp($(this).data('ep_cost'));
				
				$(".descent_skill_option_"+descent_skill_id).removeClass("selected");
				$(".descent_skill_option_"+descent_skill_id).addClass("hidden");
				$(".descent_skill_selection_"+descent_skill_id).removeClass("hidden");
				$(".descent_skill_selection_"+descent_skill_id).addClass("descentSkillSelected");
				
				descentSkillArray.push(descent_skill_id);
			});

			$("#descent_skill_list_hidden").val(JSON.stringify(descentSkillArray));

			$(".descent_race_skill_select_btn").addClass('disabled');
			
			// Update overviews in other tabs
			createCharacterControl.updateAlreadySelectedClassTab();
			createCharacterControl.updateAlreadySelectedNonClassTab();
			createCharacterControl.updateOverviewDescentSkills();
		});

		$(".descent_race_skill_remove_btn").on("click", function(){
			if($(this).hasClass("disabled")){
				return;
			}
			
			var descentSkillArray = JSON.parse($("#descent_skill_list_hidden").val());
			
			$(".descent_skill_selection.selected").each(function(){
				var descent_skill_id = $(this).data("id");
				createCharacterControl.removeDescentEp($(this).data('ep_cost'));
				$(".descent_skill_selection_"+descent_skill_id).removeClass("selected");
				$(".descent_skill_selection_"+descent_skill_id).removeClass("descentSkillSelected");
				$(".descent_skill_selection_"+descent_skill_id).addClass("hidden");
				$(".descent_skill_option_"+descent_skill_id).removeClass("hidden");

				for(var index=0; index < descentSkillArray.length; index++){
					if(descentSkillArray[index]==descent_skill_id){
						descentSkillArray.splice(index, 1);
						$("#descent_skill_list_hidden").val(JSON.stringify(descentSkillArray));
					}
				}
			});
			
			$(".descent_race_skill_remove_btn").addClass('disabled');

			// Update overviews in other tabs
			createCharacterControl.updateAlreadySelectedClassTab();
			createCharacterControl.updateAlreadySelectedNonClassTab();
			createCharacterControl.updateOverviewDescentSkills();
		});

		// Descent race skill option listener
		$(".descent_skill_option").on("click", function(){
			$(".descent_skill_selection.selected").each(function(){
				$(this).removeClass("selected");
			});
			$(".descent_race_skill_remove_btn").addClass('disabled');

			var skill_ep_cost = 0
			
			// First add all the ep from the skills already selected
			$(".descent_skill_option.selected").each(function(){
				skill_ep_cost = skill_ep_cost + $(this).data('ep_cost');
			});
			// Add the ep from the skill that the user tries to select.
			skill_ep_cost = skill_ep_cost + $(this).data('ep_cost');
			
			if(!createCharacterControl.checkDescentEp(skill_ep_cost)){
				alert("Je hebt niet genoeg afkomstpunten voor deze vaardigheid.");
				return;
			}
			if(!createCharacterControl.checkAllPrereqs($(this).data())){
				return;
			}
			
			if($(this).hasClass("selected")){
				$(this).removeClass("selected");
			}else{
				$(this).addClass("selected");
			}
			
			if($(".descent_skill_option.selected").length > 0){
				// there are selections
				$(".descent_race_skill_select_btn").removeClass('disabled');
			} else {
				// no selections found
				$(".descent_race_skill_select_btn").addClass('disabled');
			}
		});
		
		// In case of descent race skills already selected, e.g. with an edit action
		var descentSkillArray = new Array();

		$(".descent_skill_selection.descentSkillselected").each(function(){
			var descent_skill_id = $(this).data("id");
			
			descentSkillArray.push(descent_skill_id);
		});

		$("#descent_skill_list_hidden").val(JSON.stringify(descentSkillArray));
	}
	
	self.addClassSkillListeners = function(){
		createCharacterControl.doAddClassSkillListeners();
		createCharacterControl.doAddNonClassSkillListeners();
	}
	
	self.doAddClassSkillListeners = function(){
		// Class skill selection listener
		$(".character_class_skill_selection").on("click", function(){
			$(".character_class_skill_option.selected").each(function(){
				$(this).removeClass("selected");
			});
			$(".character_class_skill_select_btn").addClass('disabled');

			if($(this).hasClass("selected")){
				$(this).removeClass("selected");
			}else{
				$(this).addClass("selected");
			}
			
			if($(".character_class_skill_selection.selected").length > 0){
				// there are selections
				$(".character_class_skill_remove_btn").removeClass('disabled');
			} else {
				// no selections found
				$(".character_class_skill_remove_btn").addClass('disabled');
			}
			
		});
		
		// Class skill button listeners
		$(".character_class_skill_select_btn").on("click", function(){
			if($(this).hasClass("disabled")){
				return;
			}

			var classSkillArray = new Array();

			if($("#character_class_skill_list_hidden").val()){
				classSkillArray = JSON.parse($("#character_class_skill_list_hidden").val());
			}
			
			$(".character_class_skill_option.selected").each(function(){
				var character_class_skill_id = $(this).data("id");
				
				createCharacterControl.addSkillEp($(this).data('ep_cost'));
				
				$(".character_class_skill_option_"+character_class_skill_id).removeClass("selected");
				$(".character_class_skill_option_"+character_class_skill_id).addClass("hidden");
				$(".character_class_skill_selection_"+character_class_skill_id).removeClass("hidden");
				$(".character_class_skill_selection_"+character_class_skill_id).addClass("classSkillSelected");
				
				classSkillArray.push(character_class_skill_id);
			});

			$("#character_class_skill_list_hidden").val(JSON.stringify(classSkillArray));

			$(".character_class_skill_select_btn").addClass('disabled');

			// Update overviews in other tabs
			createCharacterControl.updateAlreadySelectedDescentTab();
			createCharacterControl.updateAlreadySelectedNonClassTab();
			createCharacterControl.updateOverviewClassSkills();
		});

		$(".character_class_skill_remove_btn").on("click", function(){
			if($(this).hasClass("disabled")){
				return;
			}
			
			var classSkillArray = JSON.parse($("#character_class_skill_list_hidden").val());
			
			$(".character_class_skill_selection.selected").each(function(){
				var character_class_skill_id = $(this).data("id");
				createCharacterControl.removeSkillEp($(this).data('ep_cost'));
				$(".character_class_skill_selection_"+character_class_skill_id).removeClass("selected");
				$(".character_class_skill_selection_"+character_class_skill_id).removeClass("classSkillSelected");
				$(".character_class_skill_selection_"+character_class_skill_id).addClass("hidden");
				$(".character_class_skill_option_"+character_class_skill_id).removeClass("hidden");

				for(var index=0; index < classSkillArray.length; index++){
					if(classSkillArray[index]==character_class_skill_id){
						classSkillArray.splice(index, 1);
						$("#character_class_skill_list_hidden").val(JSON.stringify(classSkillArray));
					}
				}
			});
			
			$(".character_class_race_skill_remove_btn").addClass('disabled');

			// Update overviews in other tabs
			createCharacterControl.updateAlreadySelectedDescentTab();
			createCharacterControl.updateAlreadySelectedNonClassTab();
			createCharacterControl.updateOverviewClassSkills();
		});

		// Class skill option listener
		$(".character_class_skill_option").on("click", function(){
			$(".character_class_skill_selection.selected").each(function(){
				$(this).removeClass("selected");
			});
			$(".character_class_skill_remove_btn").addClass('disabled');

			if($(this).hasClass("selected")){
				$(this).removeClass("selected");
			}else{
				var skill_ep_cost = 0
				
				// First add all the ep from the skills already selected
				$(".character_class_skill_option.selected").each(function(){
					skill_ep_cost = skill_ep_cost + $(this).data('ep_cost');
				});
				// Add the ep from the skill that the user tries to select.
				skill_ep_cost = skill_ep_cost + $(this).data('ep_cost');
				
				if(!createCharacterControl.checkSkillEp(skill_ep_cost)){
					alert("Je hebt niet genoeg EP voor deze vaardigheid.");
					return;
				}
				if(!createCharacterControl.checkAllPrereqs($(this).data())){
					return;
				}
			
				$(this).addClass("selected");
			}
			
			if($(".character_class_skill_option.selected").length > 0){
				// there are selections
				$(".character_class_skill_select_btn").removeClass('disabled');
			} else {
				// no selections found
				$(".character_class_skill_select_btn").addClass('disabled');
			}
		});
		
		// In case of class skills already selected, e.g. with an edit action
		var classSkillArray = new Array();

		$(".character_class_skill_selection.classSkillselected").each(function(){
			var character_class_skill_id = $(this).data("id");
			
			classSkillArray.push(character_class_skill_id);
		});

		$("#character_class_skill_list_hidden").val(JSON.stringify(classSkillArray));
	}
	
	self.doAddNonClassSkillListeners = function(){
		// Class skill selection listener
		$(".character_non_class_skill_selection").on("click", function(){
			$(".character_non_class_skill_option.selected").each(function(){
				$(this).removeClass("selected");
			});
			$(".character_non_class_skill_select_btn").addClass('disabled');

			if($(this).hasClass("selected")){
				$(this).removeClass("selected");
			}else{
				$(this).addClass("selected");
			}
			
			if($(".character_non_class_skill_selection.selected").length > 0){
				// there are selections
				$(".character_non_class_skill_remove_btn").removeClass('disabled');
			} else {
				// no selections found
				$(".character_non_class_skill_remove_btn").addClass('disabled');
			}
			
		});
		
		// Class skill button listeners
		$(".character_non_class_skill_select_btn").on("click", function(){
			if($(this).hasClass("disabled")){
				return;
			}

			var nonClassSkillArray = new Array();

			if($("#character_non_class_skill_list_hidden").val()){
				nonClassSkillArray = JSON.parse($("#character_non_class_skill_list_hidden").val());
			}
			
			$(".character_non_class_skill_option.selected").each(function(){
				var character_non_class_skill_id = $(this).data("id");
				
				createCharacterControl.addSkillEp($(this).data('ep_cost'));
				
				$(".character_non_class_skill_option_"+character_non_class_skill_id).removeClass("selected");
				$(".character_non_class_skill_option_"+character_non_class_skill_id).addClass("hidden");
				$(".character_non_class_skill_selection_"+character_non_class_skill_id).removeClass("hidden");
				$(".character_non_class_skill_selection_"+character_non_class_skill_id).addClass("nonClassSkillSelected");
				
				nonClassSkillArray.push(character_non_class_skill_id);
			});

			$("#character_non_class_skill_list_hidden").val(JSON.stringify(nonClassSkillArray));

			$(".character_non_class_skill_select_btn").addClass('disabled');

			// Update overviews in other tabs
			createCharacterControl.updateAlreadySelectedClassTab();
			createCharacterControl.updateAlreadySelectedDescentTab();
			createCharacterControl.updateOverviewNonClassSkills();
		});

		$(".character_non_class_skill_remove_btn").on("click", function(){
			if($(this).hasClass("disabled")){
				return;
			}
			
			var nonClassSkillArray = JSON.parse($("#character_non_class_skill_list_hidden").val());
			
			$(".character_non_class_skill_selection.selected").each(function(){
				var character_non_class_skill_id = $(this).data("id");
				createCharacterControl.removeSkillEp($(this).data('ep_cost'));
				$(".character_non_class_skill_selection_"+character_non_class_skill_id).removeClass("selected");
				$(".character_non_class_skill_selection_"+character_non_class_skill_id).removeClass("nonClassSkillSelected");
				$(".character_non_class_skill_selection_"+character_non_class_skill_id).addClass("hidden");
				$(".character_non_class_skill_option_"+character_non_class_skill_id).removeClass("hidden");

				for(var index=0; index < nonClassSkillArray.length; index++){
					if(nonClassSkillArray[index]==character_non_class_skill_id){
						nonClassSkillArray.splice(index, 1);
						$("#character_non_class_skill_list_hidden").val(JSON.stringify(nonClassSkillArray));
					}
				}
			});
			
			$(".character_non_class_race_skill_remove_btn").addClass('disabled');

			// Update overviews in other tabs
			createCharacterControl.updateAlreadySelectedClassTab();
			createCharacterControl.updateAlreadySelectedDescentTab();
			createCharacterControl.updateOverviewNonClassSkills();
		});

		// Class skill option listener
		$(".character_non_class_skill_option").on("click", function(){
			$(".character_non_class_skill_selection.selected").each(function(){
				$(this).removeClass("selected");
			});
			$(".character_non_class_skill_remove_btn").addClass('disabled');

			if($(this).hasClass("selected")){
				$(this).removeClass("selected");
			}else{
				var skill_ep_cost = 0
			
				// First add all the ep from the skills already selected
				$(".character_non_class_skill_option.selected").each(function(){
					skill_ep_cost = skill_ep_cost + $(this).data('ep_cost');
				});
				// Add the ep from the skill that the user tries to select.
				skill_ep_cost = skill_ep_cost + $(this).data('ep_cost');
				
				if(!createCharacterControl.checkSkillEp(skill_ep_cost)){
					alert("Je hebt niet genoeg EP voor deze vaardigheid.");
					return;
				}
				if(!createCharacterControl.checkAllPrereqs($(this).data())){
					return;
				}

				$(this).addClass("selected");
			}
			
			if($(".character_non_class_skill_option.selected").length > 0){
				// there are selections
				$(".character_non_class_skill_select_btn").removeClass('disabled');
			} else {
				// no selections found
				$(".character_non_class_skill_select_btn").addClass('disabled');
			}
		});
		
		// In case of class skills already selected, e.g. with an edit action
		var nonClassSkillArray = new Array();

		$(".character_non_class_skill_selection.nonClassSkillselected").each(function(){
			var character_non_class_skill_id = $(this).data("id");
			
			nonClassSkillArray.push(character_non_class_skill_id);
		});

		$("#character_non_class_skill_list_hidden").val(JSON.stringify(nonClassSkillArray));		
	}
}