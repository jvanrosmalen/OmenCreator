var AjaxInterface = new function(){
	var self = this;
	
	self.getSkillLevelsClasses = function(levels, classes){
		$.ajax({
			url: "jsonskill",
			type: "GET",
			data: {"levels":levels, "classes":classes},
			success: function(data){
				console.log(data);
				console.log("JSON succes!!!");
			},
			error: function(){
				console.log("JSON error");
			}
		});
	};
}