var Armor = new function(){
	var self = this;

	self.addListeners = function(){
		var armors = $("#armor_size").data("armors");
		
		for(var index in armors){
			var id = armors[index].id;
			
			// Add listeners and functions for slide
			$("#"+id ).click(function(event) {
				var targetId = $(event.target).attr("id");
				$( "#armor_detail_"+targetId ).slideToggle( "fast", function() {
					// Animation complete.
				});
			});
			
			// Add actions for update and delete buttons
			$(".btn-armor-"+id+".btn-update").attr("href", "/create_armor/"+id);
			$(".btn-armor-"+id+".btn-delete").attr("href", "/show_delete_armor/"+id);
		}
	}
	
	self.checkName = function(){
		AjaxInterface.checkArmorName($('#armor_name').val(),$('form').attr('id'), Armor.checkNameResponse);
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
	
	self.searchArmors = function() {
		var value = $("#armorSearchInput").val().toLowerCase();
		
		if(value == 'undefined' || value == ""){
			$(".armor_name_row > hidden").each(function(){
				$(this).removeClass("hidden");
			});
		}
		
		$(".equipment_name_row").each(function(){
			var armorname = $(this).find(".detail_name").text().toLowerCase();
			
			if(armorname.indexOf(value) > -1){
				if($(this).hasClass("hidden")){
					$(this).removeClass("hidden");
				}
			} else {
				$(this).addClass("hidden");
			}
		});
		
	}
}