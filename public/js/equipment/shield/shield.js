var Shield = new function(){
	var self = this;

	self.addListeners = function(){
		var shields = $("#shield_size").data("shields");
		
		for(var index in shields){
			var id = shields[index].id;
			
			// Add listeners and functions for slide
			$("#"+id ).click(function(event) {
				var targetId = $(event.target).attr("id");
				$( "#shield_detail_"+targetId ).slideToggle( "fast", function() {
					// Animation complete.
				});
			});
			
			// Add actions for update buttons
			$(".btn-shield-"+id+".btn-update").attr("href", "/create_shield/"+id);
			$(".btn-shield-"+id+".btn-delete").attr("href", "/show_delete_shield/"+id);
		}
	}
	
	self.checkName = function(){
		AjaxInterface.checkShieldName($('#shield_name').val(),$('form').attr('id'), Shield.checkNameResponse);
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

	self.searchShields = function() {
		var value = $("#shieldSearchInput").val().toLowerCase();
		
		if(value == 'undefined' || value == ""){
			$(".equipment_name_row > hidden").each(function(){
				$(this).removeClass("hidden");
			});
		}
		
		$(".equipment_name_row").each(function(){
			var shieldname = $(this).find(".detail_name").text().toLowerCase();
			
			if(shieldname.indexOf(value) > -1){
				if($(this).hasClass("hidden")){
					$(this).removeClass("hidden");
				}
			} else {
				$(this).addClass("hidden");
			}
		});
		
	}
}