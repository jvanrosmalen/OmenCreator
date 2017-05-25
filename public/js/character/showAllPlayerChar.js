var ShowAllPlayerChar = new function(){
	var self = this;
	
	self.playerSearch = function(){
		// TODO
		var value = $("#skillSearchInput").val().toLowerCase();
		
		if(value == 'undefined' || value == ""){
			$("#skills > hidden").each(function(){
				$(this).removeClass("hidden");
			});
		}
		
		$("#skills > tr").each(function(){
			var skillname = $(this).find(".skillname").attr('id').toLowerCase();
			
			if(skillname.indexOf(value) > -1){
				if($(this).hasClass("hidden")){
					$(this).removeClass("hidden");
				}
			} else {
				if(!$(this).hasClass("selected") && !$(this).hasClass("submitted")){
					$(this).addClass("hidden");
				}
			}
		});
	};
}