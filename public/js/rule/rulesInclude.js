function RulesInclude(){
	var self = this;

	self.addRulesIncludeListener = function(source, ruleType){
		var sourceId = source.dataset.id;
		var text = $("#"+ruleType+"rule_"+sourceId).text();
		var target = $("#added_rules_list");

//		Add the rule to the hidden rule list for Form input
		var ruleObj = {type:ruleType, ruleId:sourceId};
		var ruleArray = new Array();
		
		if(!$("#added_rules_list").hasClass("empty")){
			ruleArray = JSON.parse($("#rules_list_hidden").val());
		}
		
		ruleArray.push(ruleObj);
		$("#rules_list_hidden").val(JSON.stringify(ruleArray));
		
		if(target.hasClass("empty")){
			$(".empty div").remove();
			target.removeClass("empty");
		}
		
		var newRow = $("<div></div>");
		newRow.addClass("row col-xs-12");
		newRow.attr('id', ruleType+"_rule_row_"+sourceId);
		
		var newTextDiv = $("<div class='col-xs-8 rule_line'>"+text+"</div>");
		newTextDiv.data({ id: sourceId, type: ruleType});
		
		var newButtonDiv = $("<div class='col-xs-3'></div>");
		var newButton = $("<button class='btn btn-default btn-add'>Verwijder</button>");
		
		newButton.data({ id: sourceId});
		
		newButton.on("click", function(e){
			e.preventDefault();
			
			var removeSource = e.target || e.srcElement;
			var removeId = $(removeSource).data('id');

			$("#"+ruleType+"_rule_row_"+removeId).remove();
			
			if($("#added_rules_list .row").length == 0){
				$("#added_rules_list").append($("<div>Geen regels geselecteerd</div>"));
				$("#added_rules_list").addClass("empty");
			}
			
//			Remove the rule from the hidden rule list for Form input
			var ruleArray = JSON.parse($("#rules_list_hidden").val());
			
			for(var index=0; index < ruleArray.length; index++){
				if(ruleArray[index]['ruleId']==removeId && ruleArray[index]['type'] == ruleType){
					ruleArray.splice(index, 1);
					$("#rules_list_hidden").val(JSON.stringify(ruleArray));
					break;
				}
			}
			
			$(".btn-ruleIncludeAdd-"+removeId).removeClass("disabled");
		});
		
		newRow.append(newTextDiv);
		newRow.append(newButton);
		target.append(newRow);
		
		$(source).addClass("disabled");
	}
}