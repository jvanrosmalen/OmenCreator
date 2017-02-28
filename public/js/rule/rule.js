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

		$("#callrules" ).click(function(event) {
			$( "#call_rule_details" ).slideToggle( "fast", function() {
				// Animation complete.
			});
		});

		$("#wealthrules" ).click(function(event) {
			$( "#wealth_rule_details" ).slideToggle( "fast", function() {
				// Animation complete.
			});
		});
	}

	self.addRulesIncludeListeners = function(){
		$(".statRuleIncludeAdd").on("click", function(e){
			e.preventDefault();
			
			var source = e.target || e.srcElement;
			var rulesInclude = new RulesInclude();
			var sourceId = source.dataset.id;
			
			rulesInclude.addRulesIncludeListener(sourceId, "stat");
			$(source).addClass("disabled");
		});
		
		$(".resRuleIncludeAdd").on("click", function(e){
			e.preventDefault();
			
			var source = e.target || e.srcElement;
			var rulesInclude = new RulesInclude();
			var sourceId = source.dataset.id;
			
			rulesInclude.addRulesIncludeListener(sourceId, "res");
			$(source).addClass("disabled");
		});

		$(".damRuleIncludeAdd").on("click", function(e){
			e.preventDefault();
			
			var source = e.target || e.srcElement;
			var rulesInclude = new RulesInclude();
			var sourceId = source.dataset.id;
			
			rulesInclude.addRulesIncludeListener(sourceId, "dam");
			$(source).addClass("disabled");
		});

		$(".callRuleIncludeAdd").on("click", function(e){
			e.preventDefault();
			
			var source = e.target || e.srcElement;
			var rulesInclude = new RulesInclude();
			var sourceId = source.dataset.id;
			
			rulesInclude.addRulesIncludeListener(sourceId, "call");
			$(source).addClass("disabled");
		});

		$(".wealthRuleIncludeAdd").on("click", function(e){
			e.preventDefault();
			
			var source = e.target || e.srcElement;
			var rulesInclude = new RulesInclude();
			var sourceId = source.dataset.id;
			
			rulesInclude.addRulesIncludeListener(sourceId, "wealth");
			$(source).addClass("disabled");
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
	
	self.addRulesToOverview = function() {
		var itemRules = $("#item_rules").data("item-rules");
		
		for(var index = 0; index < itemRules['call_rules'].length; index++){
			var call_rule = itemRules['call_rules'][index];
			var rulesInclude = new RulesInclude();
			
			rulesInclude.addRulesIncludeListener(call_rule['id'], "call");
			$("#added_rules_list button").data('id', call_rule['id']);
			$('.btn-ruleIncludeAdd-'+call_rule['id'] + '.callRuleIncludeAdd').addClass("disabled");
		}
		
		for(var index = 0; index < itemRules['dam_rules'].length; index++){
			var dam_rule = itemRules['dam_rules'][index];
			var rulesInclude = new RulesInclude();
			
			rulesInclude.addRulesIncludeListener(dam_rule['id'], "dam");
			$("#added_rules_list button").data('id', dam_rule['id']);
			$('.btn-ruleIncludeAdd-'+dam_rule['id'] + '.damRuleIncludeAdd').addClass("disabled");
		}
		
		for(var index = 0; index < itemRules['res_rules'].length; index++){
			var res_rule = itemRules['res_rules'][index];
			var rulesInclude = new RulesInclude();
			
			rulesInclude.addRulesIncludeListener(res_rule['id'], "dam");
			$("#added_rules_list button").data('id', res_rule['id']);
			$('.btn-ruleIncludeAdd-'+res_rule['id'] + '.resRuleIncludeAdd').addClass("disabled");
		}
		
		for(var index = 0; index < itemRules['stat_rules'].length; index++){
			var stat_rule = itemRules['stat_rules'][index];
			var rulesInclude = new RulesInclude();
			
			rulesInclude.addRulesIncludeListener(stat_rule['id'], "stat");
			$("#added_rules_list button").data('id', stat_rule['id']);
			$('.btn-ruleIncludeAdd-'+stat_rule['id'] + '.statRuleIncludeAdd').addClass("disabled");
		}
		
		for(var index = 0; index < itemRules['wealth_rules'].length; index++){
			var wealth_rule = itemRules['wealth_rules'][index];
			var rulesInclude = new RulesInclude();
			
			rulesInclude.addRulesIncludeListener(wealth_rule['id'], "wealth");
			$("#added_rules_list button").data('id', wealth_rule['id']);
			$('.btn-ruleIncludeAdd-'+wealth_rule['id'] + '.wealthRuleIncludeAdd').addClass("disabled");
		}
	}
}