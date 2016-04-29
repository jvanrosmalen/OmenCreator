<!DOCTYPE html>
<!-- Partial view. No HTML tags -->
	<div id="showSkillDetails" class="popup">
		<div class="wrapper">
			<div class="container skillDetails well">
				<div class="row">
					<button type="button" class="btn btn-border btn-danger close-button" name="close" onclick = "ShowAll.closeSkillDetails();">x</button>
				</div>

				<!-- Skill name -->
				<div class="row">
<!-- 					<div class="col-xs-1"></div> -->
					<div id="skill_name" class="col-xs-9">Default name</div>
					<div id="skill_ep_cost" class="col-xs-2">EP Cost</div>
				</div>
				
				<hr>
				
				<!-- Skill description -->
				<div class="row">
					<div class="col-xs-2">Beschrijving:</div>
					<div class="col-xs-9" ><textarea id="skill_desc_long"></textarea></div>
				</div>			
				
				<!-- Skill prereqs -->
				<div class="row">
					<div class="col-xs-2">Voorvereiste:</div>
					<div id="skill_prereqs" class="col-xs-9">Geen</div>
				</div>
				
				<!-- Skill income -->
				<div class="row">
					<div class="col-xs-2">Inkomsten:</div>
					<div id="skill_income" class="col-xs-9">Geen</div>
				</div>

				<!-- Skill classes -->
				<div class="row">
					<div class="col-xs-2">Klassen:</div>
					<div id="skill_classes" class="col-xs-9">-</div>
				</div>
				
				<!-- Skill races -->
				<div class="row hidden">
					<div class="col-xs-2">Afkomst:</div>
					<div id="skill_races" class="col-xs-9">-</div>
				</div>
				
			</div>
		</div>
	</div>
	

