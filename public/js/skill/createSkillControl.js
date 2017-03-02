var createSkillControl = new function(){
	var self = this;
	
	self.addCreateSkillListeners = function(){
		// Craft equipment selection listener
		$(".craft_equipment_selection").on("click", function(){
			$(".craft_equipment_option.selected").each(function(){
				$(this).removeClass("selected");
			});
			$(".craft_equip_select_btn").addClass('disabled');

			if($(this).hasClass("selected")){
				$(this).removeClass("selected");
			}else{
				$(this).addClass("selected");
			}
			
			if($(".craft_equipment_selection.selected").length > 0){
				// there are selections
				$(".craft_equip_remove_btn").removeClass('disabled');
			} else {
				// no selections found
				$(".craft_equip_remove_btn").addClass('disabled');
			}
			
		});
		
		// Craft equipment button listeners
		$(".craft_equip_select_btn").on("click", function(){
			if($(this).hasClass("disabled")){
				return;
			}

			var craftEquipArray = new Array();

			if($("#craft_equipment_list_hidden").val()){
				craftEquipArray = JSON.parse($("#craft_equipment_list_hidden").val());
			}
			
			$(".craft_equipment_option.selected").each(function(){
				var equip_id = $(this).data("id");
				var craftEquipObj = {craftEquipId:equip_id};
				
				$(".craft_equipment_option_"+equip_id).removeClass("selected");
				$(".craft_equipment_option_"+equip_id).addClass("hidden");
				$(".craft_equipment_selection_"+equip_id).removeClass("hidden");
				$(".craft_equipment_selection_"+equip_id).addClass("craftEquipSelected");
				
				craftEquipArray.push(equip_id);
			});

			$("#craft_equipment_list_hidden").val(JSON.stringify(craftEquipArray));

			$(".craft_equip_select_btn").addClass('disabled');
		});

		$(".craft_equip_remove_btn").on("click", function(){
			if($(this).hasClass("disabled")){
				return;
			}
			
			var craftEquipArray = JSON.parse($("#craft_equipment_list_hidden").val());
			
			$(".craft_equipment_selection.selected").each(function(){
				var equip_id = $(this).data("id");
				$(".craft_equipment_selection_"+equip_id).removeClass("selected");
				$(".craft_equipment_selection_"+equip_id).removeClass("craftEquipSelected");
				$(".craft_equipment_selection_"+equip_id).addClass("hidden");
				$(".craft_equipment_option_"+equip_id).removeClass("hidden");

				for(var index=0; index < craftEquipArray.length; index++){
					if(craftEquipArray[index]==equip_id){
						craftEquipArray.splice(index, 1);
						$("#craft_equipment_list_hidden").val(JSON.stringify(craftEquipArray));
					}
				}
			});
			
			$(".craft_equip_remove_btn").addClass('disabled');
		});

		// Craft equipment option listener
		$(".craft_equipment_option").on("click", function(){
			$(".craft_equipment_selection.selected").each(function(){
				$(this).removeClass("selected");
			});
			$(".craft_equip_remove_btn").addClass('disabled');

			if($(this).hasClass("selected")){
				$(this).removeClass("selected");
			}else{
				$(this).addClass("selected");
			}
			
			if($(".craft_equipment_option.selected").length > 0){
				// there are selections
				$(".craft_equip_select_btn").removeClass('disabled');
			} else {
				// no selections found
				$(".craft_equip_select_btn").addClass('disabled');
			}
		});
		
		// In case of craft equipment already selected, e.g. with an edit action
		var craftEquipArray = new Array();

		$(".craft_equipment_selection.craftEquipselected").each(function(){
			var equip_id = $(this).data("id");
			var craftEquipObj = {craftEquipId:equip_id};
			
			craftEquipArray.push(equip_id);
		});

		$("#craft_equipment_list_hidden").val(JSON.stringify(craftEquipArray));
		
		// In case of prereq skills already selected, e.g. with an edit action
		var skillPrereqs1Array = new Array();
		$("#prereqs_set1 .row").each(function(id, value){
			var split_id = value.id.split("_")[1];
			skillPrereqs1Array.push(split_id);
			// And disable the skill in the skillSelector
			$(".skillSelector tr#"+split_id).addClass("submitted");
			$(".skillSelector tr#"+split_id).removeAttr('onclick');
			
			// Skills in set1 have been found. Enable button set2
			$(".button_set2").removeClass('disabled');
		});
		$("#skill_prereqs_set1_list_hidden").val(JSON.stringify(skillPrereqs1Array));
		
		var skillPrereqs2Array = new Array();
		$("#prereqs_set2 .row").each(function(id, value){
			var split_id = value.id.split("_")[1];
			skillPrereqs2Array.push(split_id);
		});
		$("#skill_prereqs_set2_list_hidden").val(JSON.stringify(skillPrereqs2Array));
	}
}