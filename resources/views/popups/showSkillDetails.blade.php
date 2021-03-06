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
					<div id="skill_name" class="col-xs-6">Default name</div>
					<div class="col-xs-6">
						<div class="row">
							<div class="col-xs-2 skill_detail">Niveau:</div>
							<div class="col-xs-3" id="skill_level"></div>
							<div class="col-xs-2 skill_detail">EP Cost:</div>
							<div class="col-xs-3" id="skill_ep_cost"></div>
						</div>
					</div>
				</div>
				
				<hr>
				
				<!-- Skill description -->
				<div class="row">
					<div class="col-xs-2 skill_detail">Beschrijving:</div>
					<div class="col-xs-9" ><div id="skill_desc_long" contenteditable="true"></div></div>
				</div>			
				
				<!-- Skill prereqs -->
				<div class="row">
					<div class="col-xs-2 skill_detail">Voorvereiste:</div>
					<div id="skill_prereqs" class="col-xs-9">Geen</div>
				</div>
				
				<!-- Skill income -->
				<div class="row">
					<div class="col-xs-2 skill_detail">Inkomsten:</div>
					<div id="skill_income" class="col-xs-9">Geen</div>
				</div>

				<!-- Skill classes -->
				<div class="row">
					<div class="col-xs-2 skill_detail">Klassen:</div>
					<div id="skill_classes" class="col-xs-9">-</div>
				</div>
				
				<!-- Skill races -->
				<div id="skill_races_row" class="row hidden">
					<div class="col-xs-2 skill_detail">Afkomst:</div>
					<div id="skill_races" class="col-xs-9">-</div>
				</div>
				
				<!-- Mentor indication -->
				<div class="row">
					<div class="col-xs-2"></div>
				</div>
				<div id="skill_mentor" class="row hidden">
					<div class="col-xs-2"></div>
					<div class="col-xs-9 skill_detail">MENTOR VEREIST</div>
				</div>
			</div>
		</div>
	</div>
	

