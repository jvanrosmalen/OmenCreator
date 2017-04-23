var createSkillGroupControl = new function(){
	var self = this;
	
	self.addCreateSkillGroupListeners  = function(){
		// In case of prereq skills already selected, e.g. with an edit action
		var skillGroupSkills = new Array();
		$("#skillgroup_skills_list_hidden .row").each(function(id, value){
			var split_id = value.id.split("_")[1];
			skillGroupSkills.push(split_id);
			// And disable the skill in the skillSelector
			$(".skillSelector tr#"+split_id).addClass("submitted");
			$(".skillSelector tr#"+split_id).removeAttr('onclick');
		});
		$("#skillGroupSkills").val(JSON.stringify(skillGroupSkills));
	}
}