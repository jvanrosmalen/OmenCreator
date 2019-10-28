var CreatePlayerCharBasicInfo = new function(){
	var self = this;
	
	self.submitBasicInfo = function(event){
		// check if info is correctly submitted.
		// if not, stop event
		if($('#basic_info_player_id').val() < 1){
			// No player selected for this player char
			ErrorMessage.showErrorMessage("Selecteer een speler om verder te kunnen gaan.");
			event.preventDefault();
			return;
		}
		
		if($('#basic_info_char_name').val()===""
			|| $('#basic_info_char_name').val()=== undefined
			|| $('#basic_info_char_name').val()=== null){
			// No player name selected for this player char
			ErrorMessage.showErrorMessage("Geef dit karakter een naam om verder te kunnen gaan.");
			event.preventDefault();
			return;
		}
		
		if($('#race_selection').val() < 1){
			// No player selected for this player char
			ErrorMessage.showErrorMessage("Selecteer een spelerras om verder te kunnen gaan.");
			event.preventDefault();
			return;
		}
		
		if($('#playerclass_select').val() < 1){
			// No player class for this player char
			ErrorMessage.showErrorMessage("Selecteer een spelerklasse om verder te kunnen gaan.");
			event.preventDefault();
			return;
		}
		
		LoaderMessage.showLoaderMessage("het smeden van de lijsten met vaardigheden duurt een aantal seconden.");
	}
	
	self.submitPlayerSelection = function(event){
		event.stopPropagation();
		var selectedPlayerId = $('#users .selected').attr('id');
		var selectedPlayerName = $('#users .selected .username').attr('id');
		
		$('#basic_info_player_id').val( selectedPlayerId );
		$('#basic_info_player_name').val( selectedPlayerName );
		
		PlayerSelector.closePlayerSelector(event);
	}

	// 	**** No longer used ****
	//  self.survivedToLevel = function(nrSurvived){
	// 	var retVal = 1;
	// 	if(nrSurvived >= 3){
	// 		if(nrSurvived < 8){
	// 			retVal = 2;
	// 		}else if(nrSurvived < 15){
	// 			retVal = 3;
	// 		}else {
	// 			retVal = 4;
	// 		}
	// 	}
		
	// 	return retVal;
	// }

	self.EpToLevel = function(ep_amount){
		var charLevel = 1; // default: Debutant

    	if(ep_amount >= 24){
    		if(ep_amount < 39 ){
    			charLevel = 2; // Avonturier
    		}else if(ep_amount < 60){
    			charLevel = 3; // Veteraan
    		}else {
    			charLevel = 4; // Held
    		}
		}
		
		return charLevel;
	}
	
	self.handleSurvivedChange = function(event){
		event.preventDefault();
		var nrSurvived = $(event.target).val();
			
		$("#overview_survived").html(nrSurvived);
	}

	self.handleEpAmountChange = function(event){
		event.preventDefault();
		var ep_amount = $(event.target).val();
		var char_level = self.EpToLevel(parseInt(ep_amount));
		var old_char_level = $('#char_level').val();
		
		if(char_level != old_char_level){
			$("#char_level_name_"+old_char_level).addClass('hidden');
			$("#char_level_name_"+char_level).removeClass('hidden');
			$("#char_level").val(char_level);
		}
	}
	
	self.handleRaceSelection = function(event){
		event.preventDefault();
		var selectedRaceId = $(event.target).val();
		if(selectedRaceId != -1){
			// Tab 'Basis Info' 
			$('#playerclass_select').addClass('hidden');
			AjaxInterface.getProhibitedClasses(selectedRaceId, self.handleProhibitedClasses);
			
			$('.race_skills span').addClass('hidden');
			$('#race_skills_'+selectedRaceId).removeClass('hidden');
			
		}else{
			// Tab 'Basis Info'
			$('#playerclass_race_first_warning').removeClass('hidden');
			$('#playerclass_select').addClass('hidden');
			
			$('.race_skills span').addClass('hidden');
			$('#race_skills_no_race').removeClass('hidden');
			
			// Reset wealth value
			self.setBaseWealth(1);
		}
		
		self.handleRaceStats(selectedRaceId);
	}
	
	self.handleProhibitedClasses = function(data){
		$('#playerclass_select option').removeClass('hidden');
		$('#playerclass_select option').removeAttr('selected');
		data.forEach(function(prohibitedName){
			$('option#'+prohibitedName).addClass('hidden');
		});
		var optionArray = $('#playerclass_select option');
		for (var i = 0, len = optionArray.length; i < len; i++) {
			if(!$(optionArray[i]).hasClass('hidden')){
				$('#playerclass_select').val($(optionArray[i]).val());
				break;
			}
		}
		
		$('#playerclass_select').removeClass('hidden');
		$('#playerclass_race_first_warning').addClass('hidden');
	}
	
	self.handleRaceStats = function(raceId){
		var raceOption = $("#race_selection option[value="+raceId+"]");

		self.updateRaceStat(1, raceOption.data("lp_torso"));
		self.updateRaceStat(11, raceOption.data("lp_limbs"));
		self.updateRaceStat(2, raceOption.data("willpower"));
		self.updateRaceStat(3, raceOption.data("status"));
		self.updateRaceStat(4, raceOption.data("focus"));
		self.updateRaceStat(5, raceOption.data("trauma"));
	}
	
	self.updateRaceStat = function(statId, value){
		$("#base_stat_"+statId).html(value);
	}
	
	self.handleClassSelection = function(event){
		event.preventDefault();
		var selectedClassId = $('#playerclass_select').val();
		
		if(selectedClassId != -1){
			// Get class and non-class skills
			AjaxInterface.getClassWealth(selectedClassId, self.handleWealth);
		}else{			
			// Reset wealth value
			self.setBaseWealth(1);
		}		
	}
	
	self.handleWealth = function(data){
		var wealthId = data['wealthId'];
		
		// Update wealth value
		self.setBaseWealth(wealthId);
	}
	
	self.setBaseWealth = function(wealthId){
		var wealthString = self.getWealthType(wealthId);
		
		$("#base_wealth").html(wealthString);
	}
	
	self.getWealthType = function(wealthId){
		var wealth_type = 'Arm';

		// Get wealth string from hidden info
		if(wealthId != -1){
			$(".wealth_type").each(function(){
				if($(this).data('id')== wealthId){
					wealth_type = $(this).data('wealth_type');
					
					return false;
				}
			});
		}
		
		return wealth_type;
	}
}