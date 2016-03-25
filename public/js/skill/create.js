var Create = new function(){
	var self = this;
	
	self.addSkillPrereq = function(set){
		$("#createSkillSelector").fadeIn();
		event.preventDefault();
		console.log("addSkillPrereg " + set );
	};
}
