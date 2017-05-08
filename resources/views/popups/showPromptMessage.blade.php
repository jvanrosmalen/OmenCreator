<!DOCTYPE html>
<!-- Partial view. No HTML tags -->
	<div id="showPromptMessage" class="popup">
		<div class="wrapper">
			<div class="container promptMessage well">
				<div class="row">
					<div class='col-xs-1'>
					</div>
					<div class='col-xs-9'>
						<h3 id='promptHeader'>Tallathan vraagt:</h3>
					</div>
				</div>
				
				<div class="row">
					<div class="col-xs-2">
					</div>
					<div id="prompt_message" class="col-xs-8">
					</div>
					<div class="col-xs-2">
					</div>
				</div>
				
				<div class="row">
					<div class="col-xs-3">
					</div>
					<div class="col-xs-2">
						<button id="prompt_succes" type="button" class="btn btn-border" onclick="PromptMessage.promptSuccess();">Ja</button>
					</div>
					<div class="col-xs-2">
					</div>
					<div class="col-xs-2">
						<button id="prompt_failure" type="button" class="btn btn-border" onclick="PromptMessage.promptFailure();">Nee</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	

