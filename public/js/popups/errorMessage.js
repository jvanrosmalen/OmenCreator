var ErrorMessage = new function(){
	var self = this;
	
	self.closeErrorMessage = function(){
		$("#showErrorMessage").fadeOut();
	}
	
	self.showErrorMessage = function(message){
		$("#error_message").html(message);
		$("#showErrorMessage").fadeIn();
	}
}