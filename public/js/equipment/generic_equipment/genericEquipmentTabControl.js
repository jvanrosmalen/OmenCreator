var GenericEquipmentTabControl = new function(){
	var self = this;
	
	self.addTabButtonListeners = function(){
		TabController.addNextButtonListener("tab1", "tab2");
		TabController.addPreviousButtonListener("tab2", "tab1");
	}
	
	self.addSaveListener = function(){
		var saveFunc = new function(){
			
		}
	}
}