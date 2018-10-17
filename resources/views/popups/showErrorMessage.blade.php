<!DOCTYPE html>
<!-- Partial view. No HTML tags -->
	<div id="showErrorMessage" class="popup">
		<div class="wrapper">
			<div class="container errorMessage well">
				<div class="row">
					<div class='col-xs-1'>
					</div>
					<div class='col-xs-9'>
						<h3 id='errorHeader'>Tallathan zegt:</h3>
					</div>
					<button type="button" class="btn btn-border btn-danger close-button" name="close" onclick = "ErrorMessage.closeErrorMessage();">x</button>
				</div>
				
				<div class="row">
					<div class="col-xs-2">
					</div>
					<div id="error_message" class="col-xs-8">
					</div>
					<div class="col-xs-2">
					</div>
				</div>

				<div id="error_message_button_row" class="row hidden">
					<div class="col-xs-3">
					</div>
					<div id="error_message_button" class="btn btn-info col-xs-6">
					</div>
					<div class="col-xs-3">
					</div>
				</div>
			</div>
		</div>
	</div>
	

