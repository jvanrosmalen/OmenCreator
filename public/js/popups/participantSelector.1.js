var ParticipantSelector = new function(){
	var self = this;
	
	self.openParticipantSelector = function(event){
		event.preventDefault();
		event.stopPropagation();
		$('#selectParticipant').fadeIn();
	}
	
	self.closeParticipantSelector = function(event){
		event.preventDefault();
		$('#selectParticipant').fadeOut();
	}
	
	self.selectParticipant = function(event){
		event.preventDefault();

		var source = $(event.target).parents("tr");
		
		if(source.length == 0 && $(event.target).has('tr')){
			// the click was on the tr itself
			source = $(event.target);
		}
		
		$('#users .selected').removeClass('selected');
		
		if(source.hasClass("selected")){
			source.removeClass("selected");
		} else {
			source.addClass("selected");
		}		
	}
	
	self.searchParticipant = function(event){
		var value = $("#playerSelectorSearchInput").val().toLowerCase();
		
		if(value == 'undefined' || value == ""){
			$("#users > hidden").each(function(){
				$(this).removeClass("hidden");
			});
		}
		
		$("#users > tr").each(function(){
			var username = $(this).find(".username").attr('id').toLowerCase();
			var email = $(this).find(".user_email").attr('id').toLowerCase();
			
			if(username.indexOf(value) > -1 || email.indexOf(value) > -1 ){
				if($(this).hasClass("hidden")){
					$(this).removeClass("hidden");
				}
			} else {
				if(!$(this).hasClass("selected") && !$(this).hasClass("submitted")){
					$(this).addClass("hidden");
				}
			}
		});		
	}
}