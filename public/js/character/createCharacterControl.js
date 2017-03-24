var createCharacterControl = new function(){
	var self = this;
	
	self.checkDescentEp = function(ep_cost){
		return ($("#spent_descent_ep").data('descent_ep_amount') - ep_cost) >= 0;
	}
	
	self.updateDescentEP = function(value){
		$("#spent_descent_ep").data('descent_ep_amount', value );
		$("#spent_descent_ep").html(value);
	}
	
	self.removeDescentEp = function(ep_cost){
		var newValue = $("#spent_descent_ep").data('descent_ep_amount') - ep_cost;
		createCharacterControl.updateDescentEP(newValue);
	}

	self.addDescentEp = function(ep_cost){
		var newValue = $("#spent_descent_ep").data('descent_ep_amount') + ep_cost;
		createCharacterControl.updateDescentEP(newValue);
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
				
				createCharacterControl.removeDescentEp($(this).data('ep_cost'));
				
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
				createCharacterControl.addDescentEp($(this).data('ep_cost'));
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
}