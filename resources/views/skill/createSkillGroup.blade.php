<!DOCTYPE html>
<html>
@extends('layouts.app')

@section('content')
	

		<div class='container'>
			<div class='row'>
				<div class='col-xs-12'>
					@if ($skillgroup == null)
						<h3>Cre&euml;er Nieuwe Vaardigheidgroep</h3>
					@else
						<h3>Aanpassen Vaardigheidgroep</h3>
					@endif
				</div>
			</div>
			
			@if ($skillgroup == null)
 				<form id="createSkillGroupForm" action="create_skillgroup_submit" method="POST">
 			@else
 				<form id="createSkillGroupForm" action="create_skillgroup_update/{{$skillgroup->id}}" method="POST">
 			@endif

			<!-- ******************* -->
			<!-- For Laravel CSRF administration -->
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<!-- ******************* -->

 			<ul class="nav nav-tabs">
			  <li class="active"><a id="tab1" data-toggle="tab" href="#base_info">Basis Info</a></li>
			</ul>

			<div class="tab-content">
			  <div id="base_info" class="tab-pane fade in active">
			    <h3>Basis Informatie</h3>
				<div class='row well'>
					<div class='col-xs-2'>
						Naam:
					</div>
					<div class='col-xs-3'>
						@if( $skillgroup == null )
							<input type="text" name="skillgroup_name" style="width: 100%;">
						@else
							<input type="text" name="skillgroup_name" value="{{$skillgroup->name}}" style="width: 100%;">
						@endif
					</div>
				</div>
				
				<div class="row well">
					<div class="row">
						<div class="col-xs-2">Korte beschrijving:</div>
						<div class="col-xs-10">
							@if ($skillgroup == null)
								<input type="text" name="desc_short" maxlength="255" style="width: 100%;">
							@else
								<input type="text" name="desc_short" maxlength="255" style="width: 100%;" value="{{$skillgroup->desc_short}}">
							@endif
						</div>
					</div>
					
					<br>

					<div class="row">
						<div class="col-xs-2">Groepsvaardigheden:</div>
						<div class="col-xs-3">
							<div id="skillgroup_skills">
								@if ( $skillgroup != null )
									<?php
										foreach($skillgroup->group_skills as $groupskill){
											echo '<div class="row" id="entryRow_'.$groupskill->id.'" style="padding-top: 3px;padding-left: 3px">';
											echo '<div class="col-xs-8">'.$groupskill->name."</div>";
											echo '<div class="col-xs-3">';
											echo '<button class="btn btn-xs pull-right">';
											echo '<span class="glyphicon glyphicon-minus" id="'.$groupskill->id.'" onclick="createSkillGroup.removeSkillGroupSkill(event);">';
											echo '</span>';
											echo '</button>';
											echo '</div>';
											echo '</div>';
										}
									?>
								@endif
							</div>
						</div>
						<div class="col-xs-1">
							<button type="button" class="btn button_groupskills btn-default" aria-label="Left Align" onclick = "createSkillGroup.addSkillGroupSkill();">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							</button>
						</div>
					</div>					
				</div>
				
				<input id="skillgroup_skills_list_hidden" name="skillgroup_skills_list_hidden" type="hidden">
				
				@include('layouts.tab_buttons', array('tab'=>'tab1', 'previous'=>null, 'save'=>true, 'next'=>null))
			  </div>
			</div>

<!-- ******************* -->


			</form>
		</div>
		
		@include('popups.createSkillSelector', array('submitMethod'=>'createSkillGroup.submitSkillGroupSkills(event)'))

		<script>
			window.onLoad = createSkillGroupControl.addCreateSkillGroupListeners();
		</script>
		
		
		@endsection

</html>