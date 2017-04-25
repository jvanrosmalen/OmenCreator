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
		if($("#stat_"+skillData['statistic_prereq_id']).data('value')
				>= skillData['statistic_prereq_amount']){
			return true;
		}else{
			alert("Je moet minimaal "+ skillData['statistic_prereq_amount'] +
					" " + $("#stat_"+skillData['statistic_prereq_id']+"_name").html().trim()+
					" hebben om deze vaardigheid te kunnen selecteren");
			
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
		var problemArray = [];
		
		for(var i=0; i < skillData['skill_prereqs'].length; i++){
			var prereq_skill = skillData['skill_prereqs'][i];
			
			// check if skill is in all hidden lists with skills
			if(!createCharacterControl.hasSkill(prereq_skill['id'])){
				problem = true;
				
				problemArray.push(prereq_skill['name']);
			}
		}
		
		for(var i=0; i < skillData['skill_group_prereqs'].length; i++){
			var prereq_skillgroup = skillData['skill_group_prereqs'][i];
			
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
		
		if(problem){
			// skill is not found
			var warningStr = "Je hebt de volgende vaardigheden nog nodig voor deze skill: ";
			
			warningStr += problemArray.join('<br>');
			
			alert(warningStr);
			return false;
		}
		
		return true;
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

	self.updateOverviewDescentSkills = function(){
		var overviewSkillArray = createCharacterControl.getSkillNameArrayFromTab("descent_skill_list_hidden");
		
		if(overviewSkillArray.length > 0){
			$("#overview_descent_skills").html(overviewSkillArray.join(', '));
			$("#overview_descent_skills").removeClass("warning_not_entered");
		}else{
			$("#overview_descent_skills").html("Niet geselecteerd");
			$("#overview_descent_skills").addClass("warning_not_entered");
		}
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