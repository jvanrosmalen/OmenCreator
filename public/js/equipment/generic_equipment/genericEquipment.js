var GenericEquipment = new function(){
	var self = this;

	self.addListeners = function(){
		var genericEquipments = $("#generic_equipment_size").data('generic-equipments');
		
		for(var index in genericEquipments){
			var id = genericEquipments[index].id;
			
			// Add listeners and functions for slide
			$("#"+id ).click(function(event) {
				var targetId = $(event.target).attr("id");
				$( "#generic_equipment_detail_"+targetId ).slideToggle( "fast", function() {
					// Animation complete.
				});
			});
			
			// Add actions for update and delete buttons
			$(".btn-generic-equipment-"+id+".btn-update").attr("href", "/create_generic_equipment/"+id);
			$(".btn-generic-equipment-"+id+".btn-delete").attr("href", "/show_delete_generic_equipment/"+id);
		}
	}
	
	self.checkName = function(){
		AjaxInterface.checkGenericEquipmentName($('#generic_equipment_name').val(),$('form').attr('id'), GenericEquipment.checkNameResponse);
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
	
	self.searchGenericEquipments = function() {
		var value = $("#genericEquipmentSearchInput").val().toLowerCase();
		
		if(value == 'undefined' || value == ""){
			$(".generic_equipment_name_row > hidden").each(function(){
				$(this).removeClass("hidden");
			});
		}
		
		$(".equipment_name_row").each(function(){
			var genericEquipmentName = $(this).find(".detail_name").text().toLowerCase();
			
			if(genericEquipmentName.indexOf(value) > -1){
				if($(this).hasClass("hidden")){
					$(this).removeClass("hidden");
				}
			} else {
				$(this).addClass("hidden");
			}
		});
	}
}