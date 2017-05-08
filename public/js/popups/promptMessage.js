var PromptMessage = new function(){
	var self = this;
	var successClb = null;
	
	self.closePromptMessage = function(){
		$("#showPromptMessage").fadeOut();
	}
	
	self.showPromptMessage = function(message, successCallback){
		successClb = successCallback;

		$("#prompt_message").text(message);
		$("#showPromptMessage").fadeIn();
	}
	
	self.promptSuccess = function(){
		self.closePromptMessage();
		successClb();
	}
	
	self.promptFailure = function(){
		self.closePromptMessage();
	}
}