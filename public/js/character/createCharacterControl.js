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
		});

		// Class skill option listener
		$(".character_class_skill_option").on("click", function(){
			$(".character_class_skill_selection.selected").each(function(){
				$(this).removeClass("selected");
			});
			$(".character_class_skill_remove_btn").addClass('disabled');

			var skill_ep_cost = 0
			
			// First add all the ep from the skills already selected
			$(".character_class_skill_option.selected").each(function(){
				skill_ep_cost = skill_ep_cost + $(this).data('ep_cost');
			});
			// Add the ep from the skill that the user tries to select.
			skill_ep_cost = skill_ep_cost + $(this).data('ep_cost');
			
			if(!createCharacterControl.checkSkillEp(skill_ep_cost)){
				alert("Je hebt niet genoeg afkomstpunten voor deze vaardigheid.");
				return;
			}
			
			if($(this).hasClass("selected")){
				$(this).removeClass("selected");
			}else{
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
}