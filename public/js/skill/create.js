var Create = new function(){
	var self = this;
	
	self.addSkillPrereq = function(set){
		$(".submitSkillSelected").attr("id", set);
		$("#createSkillSelector").fadeIn();
		event.preventDefault();
	};
	
	self.closeSkillSelector = function(){
		$("#createSkillSelector").fadeOut();
		$(".submitSkillSelected").attr("id", "");
		$(".selected").removeClass("selected");
	};
	
	self.skillSearch = function(){
		var value = $("#skillSearchInput").val().toLowerCase();
		
		if(value == 'undefined' || value == ""){
			$("#skills > hidden").each(function(){
				$(this).removeClass("hidden");
			});
		}
		
		$("#skills > tr").each(function(){
			var skillname = $(this).find(".skillname").attr('id').toLowerCase();
			
			if(skillname.indexOf(value) > -1){
				if($(this).hasClass("hidden")){
					$(this).removeClass("hidden");
				}
			} else {
				if(!$(this).hasClass("selected") && !$(this).hasClass("submitted")){
					$(this).addClass("hidden");
				}
			}
		});
	};
	
	self.selectSkill = function(e){
		var source = $(event.target).parents("tr");
		
		if(source.length == 0 && $(event.target).has('tr')){
			// the click was on the tr itself
			source = $(event.target);
		}
		
		if(source.hasClass("selected")){
			source.removeClass("selected");
		} else {
			source.addClass("selected");
		}
		event.preventDefault();
	};
	
	self.filterSkills = function(e){
		var skill_levels = new Array();
		var class_levels = new Array();
		var selected_skills = new Array();
		var csrf_token = $(e.target).val(); 
		
		$(".level_filter:checked").each(function(){
			skill_levels.push($(this).val());
		});
		
		$(".class_filter:checked").each(function(){
			class_levels.push($(this).val());
		});
		
		$(".skill_prereqs div.row").each(function(){
			selected_skills.push($(this).attr("id"));
		});
		
		AjaxInterface.getSkillLevelsClasses(skill_levels, class_levels, selected_skills, self.displayJsonSkills);
		
	}
	
	self.displayJsonSkills = function(jsonSkills){
		var skills = self.jsonToSkills(JSON.parse(jsonSkills));
		self.removeSkillsFromTable();
		
		for(var index in skills){
			self.addSkillToTable(skills[index]);
		}
	}
	
	self.jsonToSkills = function(jsonSkills){
		var skills = [];
		
		for(var index in jsonSkills){
			var jsonSkill = jsonSkills[index];
			skills.push(self.jsonToSkill(jsonSkills[index]));
		}
		
		return skills;
	}
	
	self.jsonToSkill = function(jsonData){
		return new Skill(
				jsonData["id"],
				jsonData["name"],
				jsonData["ep_cost"],
				jsonData["level"],
				jsonData["levelName"],
				jsonData["descriptionSmall"],
				jsonData["descriptionLong"]); 
	}
	
	self.removeSkillsFromTable = function(){
		$("#skills tr").remove();
	}
	
	self.addSkillToTable = function(skill){
		var tableBody = $("#skills")[0];
		var tr = document.createElement("TR");

		tr.setAttribute("id", skill.id);
		tr.setAttribute("onclick", "Create.selectSkill(event);");
		
		var skillname = document.createElement("TD");
		skillname.setAttribute("id", skill.name);
		skillname.setAttribute("class", "skillname col-xs-3");
		skillname.appendChild(document.createTextNode(skill.name));
		tr.appendChild(skillname);

		var descSmall = document.createElement("TD");
		descSmall.setAttribute("class", "col-xs-4");
		descSmall.appendChild(document.createTextNode(skill.descriptionSmall));
		tr.appendChild(descSmall);
		
		var epcost = document.createElement("TD");
		epcost.setAttribute("class", "col-xs-2");
		epcost.appendChild(document.createTextNode(skill.ep_cost));
		tr.appendChild(epcost);

		var skilllevel = document.createElement("TD");
		skilllevel.setAttribute("class", "col-xs-3");
		skilllevel.appendChild(document.createTextNode(skill.levelName));
		tr.appendChild(skilllevel);
		
		tableBody.appendChild(tr);
	}
	
	self.submitPrereqSkills = function(e){
		var set = $(event.target).attr('id');

		var skillPrereqsArray = new Array();

		if($("#skill_prereqs_"+set+"_list_hidden").val()){
			skillPrereqsArray = JSON.parse($("#skill_prereqs_"+set+"_list_hidden").val());
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
			removeBtn.setAttribute("class", "btn btn-xs pull_right");
			var removeMinus = document.createElement("span");
			removeMinus.setAttribute("class", "glyphicon glyphicon-minus");
			removeMinus.setAttribute("id", set+"_"+value.id);
			removeMinus.setAttribute("onclick", "Create.removePrereqSkill(event);");
			
			removeBtn.appendChild(removeMinus);
			
			entryTdRemoveButton.appendChild(removeBtn);
			entryRow.appendChild(entryTdRemoveButton);
			
			$("tr#"+value.id).removeClass("selected");
			$("tr#"+value.id).addClass("submitted");
			$("tr#"+value.id).removeAttr('onclick');
			skillPrereqsArray.push(value.id);
			$("#prereqs_"+set).append(entryRow);
		});
		
		// If set is set1, enable set2 button
		if(set == "set1"){
			$(".button_set2").removeClass('disabled');
		}
		
		$("#skill_prereqs_"+set+"_list_hidden").val(JSON.stringify(skillPrereqsArray));
		
		$(".selected").each(function(id, value){
			removeClass("selected");
		});
		
		self.closeSkillSelector();	
	}
	
	self.removePrereqSkill = function(e){
		var compound_id = $(event.target).attr('id');
		var set = compound_id.split("_")[0];
		var id = compound_id.split("_")[1];
		var skillPrereqsArray = new Array();

		// First clear the id out of the relevant selected prereqs list.
		if($("#skill_prereqs_"+set+"_list_hidden").val()){
			skillPrereqsArray = JSON.parse($("#skill_prereqs_"+set+"_list_hidden").val());
		}
		
		for(var index in skillPrereqsArray){
			if(skillPrereqsArray[index] == id ){
				skillPrereqsArray.splice(index,1);
				break;
			}
		}

		$("#skill_prereqs_"+set+"_list_hidden").val(JSON.stringify(skillPrereqsArray));
		
		// Now remove from view
		var selectorSkill = $(".skillSelector tr#"+id);
		if(selectorSkill.hasClass("submitted")){
			selectorSkill.removeClass("submitted");
			selectorSkill.attr('onclick', 'Create.selectSkill(event)');
		}
		
		
		$("#entryRow_"+id).remove();
		
		// Check if set1 and if set1 is empty, check if set2 still contains
		// skills. If so, move to set1.
		// Always disable set2 button is set1 is empty
		if(set.valueOf() === "set1" && skillPrereqsArray.length === 0){
			$(".button_set2").addClass('disabled');
			
			$("#prereqs_set2 .row").each(function(id, value){
				$("#prereqs_set1").append(value);
			});
			
			$("#skill_prereqs_set1_list_hidden").val($("#skill_prereqs_set2_list_hidden").val());
			$("#skill_prereqs_set2_list_hidden").val("[]");
		}
		
		event.preventDefault();
	}
}
