var Create = new function(){
	var self = this;
	
	self.addSkillPrereq = function(set){
		$("#createSkillSelector").fadeIn();
		event.preventDefault();
	};
	
	self.closeSkillSelector = function(){
		$("#createSkillSelector").fadeOut();
	};
	
	self.filterSkills = function(){
		var value = $("#skillFilter").val().toLowerCase();
		
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
				$(this).addClass("hidden");
			}
		});
	};
}
