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
	
	self.selectSkill = function(row_id){
		var source = $(event.target).parents("tr");
		if(source.hasClass("selected")){
			source.removeClass("selected");
		} else {
			source.addClass("selected");
		}
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
		
		$(".selected").each(function(id, value){
			// Add entry in the correct prereq set.
			var entryRow = document.createElement("div");
			entryRow.setAttribute("class", "row");
			entryRow.setAttribute("id", value.id);
			var entryTdName = document.createElement("div");
			entryTdName.appendChild(document.createTextNode($("tr#"+value.id+ " .skillname").attr('id')));
			entryTdName.setAttribute("class", "col-xs-8");
			
			entryRow.appendChild(entryTdName);
			
			$("tr#"+value.id).removeClass("selected");
			$("tr#"+value.id).addClass("submitted");
			$("tr#"+value.id).prop('onclick',null).off('click');
			
			$("#prereqs_"+set).append(entryRow); 
		});
		
		$(".selected").each(function(id, value){
			removeClass("selected");
		});
		
		self.closeSkillSelector();	
	}
}
