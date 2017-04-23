<!DOCTYPE html>
<!-- Partial view. No HTML tags -->
	<div id="showSkillGroupDetails" class="popup">
		<div class="wrapper">
			<div class="container skillGroupDetails well">
				<div class="row">
					<button type="button" class="btn btn-border btn-danger close-button" name="close" onclick = "ShowAllSkillGroups.closeSkillGroupDetails();">x</button>
				</div>

				<!-- Skill name -->
				<div class="row">
<!-- 					<div class="col-xs-1"></div> -->
					<div id="skillgroup_name" class="col-xs-6">Default name</div>
				</div>
				
				<hr>
				
				<!-- Skill description -->
				<div class="row">
					<div class="col-xs-2 skillgroup_detail">Beschrijving:</div>
					<div class="col-xs-9" ><div id="skillgroup_desc_short" contenteditable="true"></div></div>
				</div>			
			</div>
		</div>
	</div>
	

