var CreateSkillTabControl = new function(){
	var self = this;
	
	self.addTabButtonListeners = function(){
		TabController.addNextButtonListener("tab1", "tab2");
		
		TabController.addNextButtonListener("tab2", "tab3");
		TabController.addPreviousButtonListener("tab2", "tab1");
		
		TabController.addNextButtonListener("tab3", "tab4");
		TabController.addPreviousButtonListener("tab3", "tab2");

		TabController.addNextButtonListener("tab4", "tab5");
		TabController.addPreviousButtonListener("tab4", "tab3");
		
		TabController.addPreviousButtonListener("tab5", "tab4");
	}
	
	self.addSaveListener = function(){
		var saveFunc = new function(){
			
		}
	}
}