var ShowAllPlayerChar = new function(){
	var self = this;
	
	self.playerSearch = function(){
		// TODO
		var value = $("#playerSearchInput").val().toLowerCase();
		
		if(value == 'undefined' || value == ""){
			$("#all_characters .hidden").each(function(){
				$(this).removeClass("hidden");
			});
			return;
		}
		
		$("#all_characters .charname").each(function(){
			var charname = $(this).attr('id').toLowerCase();
			var tableRow = $(this).closest('tr');
			var playername = $(this).closest('tr').find('.playername').attr('id').toLowerCase();
			
			if(charname.indexOf(value) > -1 || playername.indexOf(value) > -1){
				if(tableRow.hasClass("hidden")){
					tableRow.removeClass("hidden");
				}
			} else {
				tableRow.addClass("hidden");
			}
		});
	};
	
	self.doUpdateCharacter = function(){
		LoaderMessage.showLoaderMessage("het smeden van de lijsten met vaardigheden duurt een aantal seconden.");
	}
}