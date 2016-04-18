var Create = new function(){
	var self = this;
	
	self.addSkillPrereq = function(set){
		$("#createSkillSelector").fadeIn();
		event.preventDefault();
	};
	
	self.closeSkillSelector = function(){
		$("#createSkillSelector").fadeOut();
	};
	
	self.skillSearch = function(){
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
				if(!$(this).hasClass("selected")){
					$(this).addClass("hidden");
				}
			}
		});
	};
	
	self.selectSkill = function(row_id){
		var search = "tr #"+row_id;
		var source = $(event.target).parents("tr");
		if(source.hasClass("selected")){
			source.removeClass("selected");
		} else {
			source.addClass("selected");
		}
	};
	
	self.filterSkills = function(e){
		var skill_levels = new Array();
		var class_levels = new Array();
		var csrf_token = $(e.target).val(); 
		
		$(".level_filter:checked").each(function(){
			skill_levels.push($(this).val());
		});
		
		$(".class_filter:checked").each(function(){
			class_levels.push($(this).val());
		});
		
		AjaxInterface.getSkillLevelsClasses(skill_levels, class_levels);
		
	}
}
