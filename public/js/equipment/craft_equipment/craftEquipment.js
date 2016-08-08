var CraftEquipment = new function(){
	var self = this;

	self.addListeners = function(){
		var craftEquipments = $("#craft_equipment_size").data("craft-equipments");
		
		for(var index in craftEquipments){
			var id = craftEquipments[index].id;
			
			// Add listeners and functions for slide
			$("#"+id ).click(function(event) {
				var targetId = $(event.target).attr("id");
				$( "#craft_equipment_detail_"+targetId ).slideToggle( "fast", function() {
					// Animation complete.
				});
			});
			
			// Add actions for update and delete buttons
			$(".btn-craft-equipment-"+id+".btn-update").attr("href", "/create_craft_equipment/"+id);
			$(".btn-craft-equipment-"+id+".btn-delete").attr("href", "/show_delete_craft_equipment/"+id);
		}
	}
	
	self.checkName = function(){
		AjaxInterface.checkCraftEquipmentName($('#craft_equipment_name').val(),$('form').attr('id'), CraftEquipment.checkNameResponse);
	}
	
	self.checkNameResponse = function(response){
		if(response){
			$('.name_warning').removeClass('hidden');
			$('#submit_button').prop('disabled', true);
		} else {
			$('#submit_button').prop('disabled', false);
		}
	}
	
	self.hideNameWarning = function(){
		$('.name_warning').addClass('hidden');
	}
	
	self.searchCraftEquipments = function() {
		var value = $("#craftEquipmentSearchInput").val().toLowerCase();
		
		if(value == 'undefined' || value == ""){
			$(".craft_equipment_name_row > hidden").each(function(){
				$(this).removeClass("hidden");
			});
		}
		
		$(".craft_equipment_name_row").each(function(){
			var craftEquipmentName = $(this).find(".detail_name").text().toLowerCase();
			
			if(craftEquipmentName.indexOf(value) > -1){
				if($(this).hasClass("hidden")){
					$(this).removeClass("hidden");
				}
			} else {
				$(this).addClass("hidden");
			}
		});
	}
}