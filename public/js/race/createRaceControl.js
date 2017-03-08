var CreateRaceControl = new function(){
	var self = this;

	self.addRaceSkill = function(){
		$("#createSkillSelector").fadeIn();
		event.preventDefault();
	};
	
	self.submitRaceSkills = function(e){
		var raceSkillsArray = new Array();

		if($("#race_skills_list_hidden").val()){
			raceSkillsArray = JSON.parse($("#race_skills_list_hidden").val());
		}
		
		$(".selected").each(function(id, value){
			// Add entry in the correct prereq set.
			var entryRow = document.createElement("div");
			entryRow.setAttribute("class", "row");
			entryRow.setAttribute("id", "entryRow_"+value.id);
			entryRow.setAttribute("style", "padding-top: 3px;padding-left: 3px");
			var entryTdName = document.createElement("div");
			entryTdName.appendChild(document.createTextNode($("tr#"+value.id+ " .skillname").attr('id')));
			entryTdName.setAttribute("class", "col-xs-8");
			
			entryRow.appendChild(entryTdName);
			
			var entryTdRemoveButton = document.createElement("div");
			entryTdRemoveButton.setAttribute("class", "col-xs-3");
			var removeBtn = document.createElement("button");
			removeBtn.setAttribute("class", "btn btn-xs pull-right");
			var removeMinus = document.createElement("span");
			removeMinus.setAttribute("class", "glyphicon glyphicon-minus");
			removeMinus.setAttribute("id", "entryRow_"+value.id);
			removeMinus.setAttribute("onclick", "CreateRaceControl.removeRaceSkill(event);");
			
			removeBtn.appendChild(removeMinus);
			
			entryTdRemoveButton.appendChild(removeBtn);
			entryRow.appendChild(entryTdRemoveButton);
			
			$("tr#"+value.id).removeClass("selected");
			$("tr#"+value.id).addClass("submitted");
			$("tr#"+value.id).removeAttr('onclick');
			raceSkillsArray.push(value.id);
			$("#race_skills").append(entryRow);
		});
		
		$("#race_skills_list_hidden").val(JSON.stringify(raceSkillsArray));
		
		$("#skill_select_table .selected").removeClass("selected");
		
		Create.closeSkillSelector();	
	}
	
	self.removeRaceSkill = function(e){
		event.preventDefault();
		var compound_id = $(event.target).attr('id');
		var id = compound_id.split('_')[1];
		var raceSkillsArray = new Array();

		// First clear the id out of the relevant selected prereqs list.
		if($("#race_skills_list_hidden").val()){
			raceSkillsArray = JSON.parse($("#race_skills_list_hidden").val());
		}
		
		for(var index in raceSkillsArray){
			if(raceSkillsArray[index] == id ){
				raceSkillsArray.splice(index,1);
				break;
			}
		}

		$("#race_skills_list_hidden").val(JSON.stringify(raceSkillsArray));
		
		// Now remove from view
		var test = ".skillSelector tr#"+id;
		var selectorSkill = $(".skillSelector tr#"+id);
		if(selectorSkill.hasClass("submitted")){
			selectorSkill.removeClass("submitted");
			selectorSkill.attr('onclick', 'Create.selectSkill(event)');
		}
		
		$("#entryRow_"+id).remove();
	}
}