var ErrorMessage = new function(){
	var self = this;
	
	self.closeErrorMessage = function(){
		$("#showErrorMessage").fadeOut();
		$("#error_message_button_row").addClass("hidden");
	}
	
	self.showErrorMessage = function(message){
		$("#error_message").html(message);
		$("#showErrorMessage").fadeIn();
	}
}