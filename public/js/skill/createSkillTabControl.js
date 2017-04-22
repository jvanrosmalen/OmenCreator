var CreateSkillTabControl = new function(){
	var self = this;
	
	self.addTabButtonListeners = function(){
		TabController.addNextButtonListener("tab1", "tab2");
		
		TabController.addNextButtonListener("tab2", "tab3");
		TabController.addPreviousButtonListener("tab2", "tab1");
		
		TabController.addNextButtonListener("tab3", "tab4");
		TabController.addPreviousButtonListener("tab3", "tab2");
		
		TabController.addPreviousButtonListener("tab4", "tab3");
	}
	
	self.addSaveListener = function(){
		var saveFunc = new function(){
			
		}
	}
}