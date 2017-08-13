var MyProfile = new function(){
	var self = this;

	self.checkUsernameSubmit = function(event){
		var name = $('#user_name_input').val();
		var pattern = new RegExp("^(?=.*[a-z])^(.*?[A-Z]){2,}.*$");
		
		// Remove focus from active element to account for enter key press
		// for submit
		document.activeElement.blur();
		
		if(name.length>=4 && pattern.test(name)){
			// Check if something is entered as password
			if($("#user_name_password_input").val().length < 6){
				event.preventDefault();
				event.stopPropagation();
				
				$("#user_name_password_input").val('');
				$("#user_name_password_error").removeClass('hidden');
				
				return false;
			}
			
			return true;
		}else{
			event.preventDefault();
			event.stopPropagation();
			
			$("#user_name_password_input").val('');
			
			$("#user_name_error").removeClass('hidden');
			return false;
		}
	}
	
	self.focusUsernameInput = function(){
		$("#user_name_error").addClass('hidden');
	}

	self.focusUsernamePasswordInput = function(){
		$("#user_name_password_error").addClass('hidden');
	}
	
	self.checkEmailSubmit = function(event){
		var email = $('#user_email_input').val();
		var pattern = new RegExp("^\\w+([\\.-]?\\w+)*@\\w+([\\.-]?\\w+)*(\\.\\w{2,3})+$");
		
		// Remove focus from active element to account for enter key press
		// for submit
		document.activeElement.blur();
		
		if(pattern.test(email)){
			// Check if something is entered as password
			if($("#user_email_password_input").val().length < 6){
				event.preventDefault();
				event.stopPropagation();
				
				$("#user_email_password_input").val('');
				$("#user_email_password_error").removeClass('hidden');
				return false;
			}
			
			return true;
		}else{
			event.preventDefault();
			event.stopPropagation();
			
			$("#user_email_password_input").val('');
			
			$("#user_email_error").removeClass('hidden');
			return false;
		}
	}
	
	self.focusEmailInput = function(){
		$("#user_email_error").addClass('hidden');
	}

	self.focusEmailPasswordInput = function(){
		$("#user_email_password_error").addClass('hidden');
	}
	
	self.checkPasswordSubmit = function(event){
		var current_password = $('#user_password_input').val();
		var new_password = $('#user_new_password_input').val();
		var new_password2 = $('#user_new_password2_input').val();
		var retVal = false;
		
		// Remove focus from active element to account for enter key press
		// for submit
		document.activeElement.blur();
		
		// Check if something is entered as password
		if(current_password.length >= 6){
			// old password is ok. Now check first new password
			if(new_password.length >= 6){
				// first new password is ok. Now check if second is the same.
				if(new_password == new_password2){
					// all is well
					retVal = true;
				}else{
					$("#user_new_password2_error").removeClass('hidden');
				}
			}else{
				$("#user_new_password_error").removeClass('hidden');
			}
		}else{
			$("#user_password_password_error").removeClass('hidden');
		}
		
		if(!retVal){
			event.preventDefault();
			event.stopPropagation();
			$("#user_password_input").val('');
			$("#user_new_password_input").val('');
			$("#user_new_password2_input").val('');
		}
		
		return retVal;
	}
	
	self.focusPasswordPasswordInput = function(){
		$("#user_password_password_error").addClass('hidden');
	}

	self.focusNewPasswordInput = function(){
		$("#user_new_password_error").addClass('hidden');
	}

	self.focusNewPassword2Input = function(){
		$("#user_new_password2_error").addClass('hidden');
	}
}