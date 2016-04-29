var ShowAll = new function(){
	var self = this;

	self.showSkillDetails = function(set){
		$("#showSkillDetails").fadeIn();
		event.preventDefault();
	};
	
	self.closeSkillDetails = function(){
		$("#showSkillDetails").fadeOut();
	};
	
}