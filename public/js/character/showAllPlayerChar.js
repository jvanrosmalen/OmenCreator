var ShowAllPlayerChar = new function(){
	var self = this;
	
	self.playerSearch = function(){
		// TODO
		var value = $("#playerSearchInput").val().toLowerCase();
		
		if(value == 'undefined' || value == ""){
			$("#all_chars .hidden").each(function(){
				$(this).removeClass("hidden");
			});
			return;
		}
		
		$("#all_chars .charname").each(function(){
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
}