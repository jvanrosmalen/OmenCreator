var AjaxInterface = new function(){
	var self = this;
	
	self.getSkillLevelsClasses = function(levels, classes, selected, callback){
		$.ajax({
			url: "jsonskill",
			type: "GET",
			data: {"levels":levels, "classes":classes, "selected":selected},
			success: function(data){
				callback(data);
			},
			error: function(){
				console.log("JSON error");
			}
		});
	};
}