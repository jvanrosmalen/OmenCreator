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
	}
}