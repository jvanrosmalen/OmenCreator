var EditPlayerChar = new function(){
	var self = this;
	
	self.initialize = function(){
		var descent_skill_ids_list = JSON.parse($("#descent_skill_list_hidden").val());
		var class_skill_ids_list = JSON.parse($("#character_class_skill_list_hidden").val());
		var class_non_skill_ids_list = JSON.parse($("#character_non_class_skill_list_hidden").val());
		
		// Make visible all selected descent skills
		for(var index=0; index < descent_skill_ids_list.length; index++ ){
			$("#descent_race_skill_selected .descent_skill_selection_"+descent_skill_ids_list[index]).removeClass('hidden');
			$("#descent_race_skill_selected .descent_skill_selection_"+descent_skill_ids_list[index]).addClass("skillSelected");
			var option = $("#descent_race_skill_options .descent_skill_option_"+descent_skill_ids_list[index]);
			option.addClass('hidden');
		}
		
		// Make visible all selected class skills
		for(var index=0; index < class_skill_ids_list.length; index++ ){
			$("#character_class_skill_selected .character_class_skill_selection_"+class_skill_ids_list[index]).removeClass('hidden');
			$("#character_class_skill_selected .character_class_skill_selection_"+class_skill_ids_list[index]).addClass("skillSelected");
			var option = $("#character_class_skill_options .character_class_skill_option_"+class_skill_ids_list[index]);
			option.addClass('hidden');
		}
		
		// Make visible all selected non-class skills
		for(var index=0; index < class_non_skill_ids_list.length; index++ ){
			$("#character_non_class_skill_selected .character_non_class_skill_selection_"+class_non_skill_ids_list[index]).removeClass('hidden');
			$("#character_non_class_skill_selected .character_non_class_skill_selection_"+class_non_skill_ids_list[index]).addClass("skillSelected");
			var option = $("#character_non_class_skill_options .character_non_class_skill_option_"+class_non_skill_ids_list[index]);
			option.addClass('hidden');
		}

		// adjust AP/EP values for possible AP/EP overflow
		var max_descent_ep = $("#total_descent_ep").data('ep_amount');
		var overflow = $("#spent_descent_ep").data('ep_amount') - max_descent_ep;
		if( overflow > 0){
			CreatePlayerCharSkills.updateDescentEP(max_descent_ep);
			CreatePlayerCharSkills.addSkillEp(overflow);
		}
		
		// Update for selected skills
		CreatePlayerCharSkills.updateAlreadySelectedClassTab();
		CreatePlayerCharSkills.updateAlreadySelectedNonClassTab();
		CreatePlayerCharSkills.updateAlreadySelectedDescentTab();
		CreatePlayerCharSkills.updateOverviewClassSkills();
		CreatePlayerCharSkills.updateOverviewNonClassSkills();
		CreatePlayerCharSkills.updateOverviewDescentSkills();

		self.updateAllForSpark();
	}

	self.handleSurvivedChange = function(event){
		event.preventDefault();
		var nrSurvived = $(event.target).val();
		var char_level = self.survivedToLevel(parseInt(nrSurvived));
		var old_char_level = $('#char_level').val();
		
		if(char_level != old_char_level){
			$("#char_level_name_"+old_char_level).addClass('hidden');
			$("#char_level_name_"+char_level).removeClass('hidden');
			$("#char_level").val(char_level);

			ErrorMessage.showErrorMessage("Het level van dit karakter is veranderd. Sla de wijziging op, en refresh de " +
			 "pagina om de juiste vaardigheden te laden.");
		}
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

	// ***************************
	// Handle the stuff from the spark roll
	// ***************************
	self.updateAllForSpark = function(){
		if($("#spark_data")){
			var spark_data = JSON.parse($("spark_data").data("spark_data"));
		}
	}
	
	// ***************************
	// Wrapper listeners to adjust overview EP amount
	// ****************************
	self.descentSkillSelectButtonListener = function(event){
		if($(this).hasClass("disabled")){
			return;
		}
		
		CreatePlayerCharSkills.descentSkillSelectButtonListener(event);
		self.updateOverviewEpAmount();
	}
	
	self.descentSkillRemoveButtonListener = function(event){
		if($(this).hasClass("disabled")){
			return;
		}
		
		CreatePlayerCharSkills.descentSkillRemoveButtonListener(event);
		self.updateOverviewEpAmount();
	}
	
	// Class skill listeners
	self.classSkillSelectButtonListener = function(){
		if($(this).hasClass("disabled")){
			return;
		}
		
		CreatePlayerCharSkills.classSkillSelectButtonListener(event);
		self.updateOverviewEpAmount();
	}
	
	self.classSkillRemoveButtonListener = function(event){
		if($(this).hasClass("disabled")){
			return;
		}
		
		CreatePlayerCharSkills.classSkillRemoveButtonListener(event);
		self.updateOverviewEpAmount();
	}
	
	// Non Class skill listeners
	self.nonClassSkillSelectButtonListener = function(){
		if($(this).hasClass("disabled")){
			return;
		}
		
		CreatePlayerCharSkills.nonClassSkillSelectButtonListener(event);
		self.updateOverviewEpAmount();
	}
	
	self.nonClassSkillRemoveButtonListener = function(event){
		if($(this).hasClass("disabled")){
			return;
		}
		
		CreatePlayerCharSkills.nonClassSkillRemoveButtonListener(event);
		self.updateOverviewEpAmount();
	}
	
	self.updateOverviewEpAmount = function(){
		$("#overview_ep").text(
				$("#spent_descent_ep").data("ep_amount")
				+ $(".spent_character_ep").data("ep_amount"));
	}
}