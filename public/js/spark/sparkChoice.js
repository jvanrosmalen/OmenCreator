var SparkChoice = new function(){
	var self = this;
	
	self.selectSparkChoice = function(event, sparkChoice){
		event.preventDefault();

		var source = $(event.target).parents("tr");
		
		if(source.length == 0 && $(event.target).has('tr')){
			// the click was on the tr itself
			source = $(event.target);
		}
		
		if(source.hasClass("selected")){
			source.removeClass("selected");
			$("#selectedSpark").val(0);
		} else {
			$("#no_spark_selected_warning").addClass("hidden");
			$(".selected").removeClass("selected");
			source.addClass("selected");
			$("#selectedSpark").val(sparkChoice);
		}		
	}
	
	self.checkSparkChoice = function(event){
		if($(".selected").length == 0){
			// no spark selected. Do not continue
			event.stopPropagation();
			event.preventDefault();
			
			$("#no_spark_selected_warning").removeClass('hidden');
		}
	}

	self.setEventHandlersSelection15 = function(){
		$("#selectionDiv").addEventListener('change', function(e) {
			e.stopPropagation();
			e.preventDefault();
			var resource = $('input[name=resource]:checked').val();
			$('#resourceString').text(resource);
			$('input[name=resource_string]').val(resource);
		});
	}
}