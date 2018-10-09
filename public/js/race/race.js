var Race = new function(){
	var self = this;
	
	self.addListeners = function(){
		var race_ids = $("#race_ids").data('raceids');
		
		for(var index in race_ids){
			var id = race_ids[index];
			
			// Add listeners and functions for slide
			$("#"+id ).click(function(event) {
				var targetId = $(event.target).attr("id");
				$( "#race_detail_"+targetId ).slideToggle( "fast", function() {
					// Animation complete.
				});
			});
			
			// Add actions for update and delete buttons
			$(".btn-race-"+id+".btn-update").attr("href", "create_race/"+id);
			$(".btn-race-"+id+".btn-delete").attr("href", "show_delete_race/"+id);
		}
	}
	
	self.checkName = function(){
		AjaxInterface.checkRaceName($('#race_name').val(),$('form').attr('id'), Race.checkNameResponse);
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
	
	self.searchRaces = function() {
		var value = $("#raceSearchInput").val().toLowerCase();
		
		if(value == 'undefined' || value == ""){
			$(".race_name_row > hidden").each(function(){
				$(this).removeClass("hidden");
			});
		}
		
		$(".race_name_row").each(function(){
			var raceName = $(this).find(".detail_name").text().toLowerCase();
			
			if(raceName.indexOf(value) > -1){
				if($(this).hasClass("hidden")){
					$(this).removeClass("hidden");
				}
			} else {
				$(this).addClass("hidden");
			}
		});
	}
}