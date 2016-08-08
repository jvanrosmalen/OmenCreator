var TabController = new function(){
	var self = this;

	self.addButtonListener = function (targetButton, nextTab){
		$('#'+targetButton).on('click', function(e){
			e.preventDefault();
			$('#'+nextTab).trigger('click');
		})
	}

	self.addNextButtonListener = function(targetTab, nextTab){
		self.addButtonListener(targetTab+"_next", nextTab);
	}
	
	self.addPreviousButtonListener = function(targetTab, previousTab){
		self.addButtonListener(targetTab+"_previous", previousTab);
	}
	
	self.addSaveListener = function(saveFunction){
		$('#save').on('click', saveFunction);
	}
}