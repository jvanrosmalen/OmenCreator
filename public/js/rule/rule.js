var Rule = new function(){
	var self = this;

	self.addListeners = function(){
		// Add listeners and functions for every categorie
		$("#statrules" ).click(function(event) {
			$( "#statistic_rule_details" ).slideToggle( "fast", function() {
				// Animation complete.
			});
		});
		
		$("#resrules" ).click(function(event) {
			$( "#resistance_rule_details" ).slideToggle( "fast", function() {
				// Animation complete.
			});
		});

		$("#damrules" ).click(function(event) {
			$( "#damage_rule_details" ).slideToggle( "fast", function() {
				// Animation complete.
			});
		});

		$("#wealthrules" ).click(function(event) {
			$( "#wealth_rule_details" ).slideToggle( "fast", function() {
				// Animation complete.
			});
		});
	}
	
	self.addCreateListeners = function(){
		$('form').on('submit', function(e){
		    Rule.checkRule();
		    e.preventDefault();
		});
	},
	
	self.checkRule = function(){
		AjaxInterface.checkRule($('#rule_statistic').find(":selected").val(),$('#rule_operator').find(":selected").val(), $('#rule_value').val(), Rule.checkRuleExistResponse);
	},
	
	self.hideNameWarning = function(){
		$('#submit_button').prop('disabled', false);
		$('.rule_warning').addClass('hidden');
	},
	
	self.checkRuleExistResponse = function(response){
		// response true means the rule already exists.
		if(response){
			$('.rule_warning').removeClass('hidden');
			$('#submit_button').prop('disabled', true);
		} else {
			$('form').submit();
		}
	}
	
	self.sortOptionsInSelect = function(selectId){
		$("#"+selectId).append($("#"+selectId+" option").remove().sort(function(a, b) {
			var at = $(a).text().toLowerCase(), bt = $(b).text().toLowerCase();
		    return (at > bt)?1:((at < bt)?-1:0);
		}));
	}
}