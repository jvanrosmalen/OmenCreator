var LoaderMessage = new function(){
	var self = this;
	
	self.closeLoaderMessage = function(){
		$("#showLoaderMessage").fadeOut();
	}
	
	self.showLoaderMessage = function(message){
		$("#loader_message").text(message);
		$("#loader_spinner").addClass('loader');
		$("#showLoaderMessage").fadeIn();
	}
}