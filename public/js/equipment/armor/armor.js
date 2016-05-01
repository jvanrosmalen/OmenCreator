var Armors = new function(){
	var self = this;

	self.addListeners = function(numberOfArmors){
		for(var index = 1; index <= numberOfArmors; index++){
			var test = $("#"+index );
			$( "#"+index ).click(function(event) {
				var id = $(event.target).attr("id");
				$( "#armor_detail_"+id ).slideToggle( "fast", function() {
					// Animation complete.
				});
			});
		}
	}
}

var count = $("#armor_size").data("armor_size");
Armors.addListeners( count );
