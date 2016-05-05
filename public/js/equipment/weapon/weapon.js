var Weapon = new function(){
	var self = this;

	self.addListeners = function(){
		var weapons = $("#weapon_size").data("weapons");
		
		for(var index in weapons){
			var id = weapons[index].id;
			
			// Add listeners and functions for slide
			$("#"+id ).click(function(event) {
				var targetId = $(event.target).attr("id");
				$( "#weapon_detail_"+targetId ).slideToggle( "fast", function() {
					// Animation complete.
				});
			});
			
			// Add actions for update buttons
			$(".btn-weapon-"+id+".btn-update").attr("href", "/create_weapon/"+id);
			$(".btn-weapon-"+id+".btn-delete").attr("href", "/show_delete_weapon/"+id);
		}
	}
	
	self.checkName = function(){
		AjaxInterface.checkWeaponName($('#weapon_name').val(),$('form').attr('id'), Weapon.checkNameResponse);
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

	self.searchWeapons = function() {
		var value = $("#weaponSearchInput").val().toLowerCase();
		
		if(value == 'undefined' || value == ""){
			$(".equipment_name_row > hidden").each(function(){
				$(this).removeClass("hidden");
			});
		}
		
		$(".equipment_name_row").each(function(){
			var weaponname = $(this).find(".detail_name").text().toLowerCase();
			
			if(weaponname.indexOf(value) > -1){
				if($(this).hasClass("hidden")){
					$(this).removeClass("hidden");
				}
			} else {
				$(this).addClass("hidden");
			}
		});
		
	}
}