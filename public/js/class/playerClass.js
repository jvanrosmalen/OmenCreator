var PlayerClass = new function(){
	var self = this;
	
	self.addListeners = function(){
		var classes = $("#class_size").data('classes');
		
		for(var index in classes){
			var id = classes[index].id;
			
			// Add listeners and functions for slide
			$("#"+id ).click(function(event) {
				var targetId = $(event.target).attr("id");
				$( "#class_detail_"+targetId ).slideToggle( "fast", function() {
					// Animation complete.
				});
			});
			
			// Add actions for update and delete buttons
			$(".btn-class-"+id+".btn-update").attr("href", "create_class/"+id);
			$(".btn-class-"+id+".btn-delete").attr("href", "show_delete_class/"+id);
		}
	}
	
	self.checkName = function(){
		AjaxInterface.checkClassName($('#class_name').val(),$('form').attr('id'), PlayerClass.checkNameResponse);
	}
	
	self.checkNameResponse = function(response){
		if(response){
			$('.name_warning').removeClass('hidden');
			$('#submit_button').prop('disabled', true);
		} else {
			$('#submit_button').prop('disabled', false);
		}
	}
	
	self.hideNameWarning = function(){
		$('.name_warning').addClass('hidden');
	}
	
	self.searchClasses = function() {
		var value = $("#classSearchInput").val().toLowerCase();
		
		if(value == 'undefined' || value == ""){
			$(".class_name_row > hidden").each(function(){
				$(this).removeClass("hidden");
			});
		}
		
		$(".class_name_row").each(function(){
			var className = $(this).find(".detail_name").text().toLowerCase();
			
			if(className.indexOf(value) > -1){
				if($(this).hasClass("hidden")){
					$(this).removeClass("hidden");
				}
			} else {
				$(this).addClass("hidden");
			}
		});
	}
}