<!DOCTYPE html>
<html>
@extends('layouts.app') @section('content')
<div class='container'>
	<div class='row'>
		<div class='col-xs-12'>
			@if($race == null)
			<h3>Cre&euml;er Nieuw Ras</h3>
			@else
			<h3>Aanpassen Ras</h3>
			@endif
		</div>
	</div>

	@if ($race == null)
	<form id="{{ ($race!=null?$race->id:-1) }}"
		action="/create_race_submit" method="POST">
		@else
		<form id="{{ ($race!=null?$race->id:-1) }}"
			action="/create_race_update/{{ $race->id }}" method="POST">
			@endif

			<!-- ******************* -->
			<!-- For Laravel CSRF administration -->
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<!-- ******************* -->

			<ul class="nav nav-tabs">
				<li class="active"><a id="tab1" data-toggle="tab" href="#base_info">Basis
						Info</a></li>
				<li><a id="tab2" data-toggle="tab" href="#rules">Regels</a></li>
				<li><a id="tab3" data-toggle="tab" href="#skills">Vaardigheden</a></li>
			</ul>

			<div class="tab-content">
				<div id="base_info" class="tab-pane fade in active">
					<h3>Basis Informatie</h3>
					<div class='row well'>
						<div class='col-xs-2'>Naam:</div>
						<div class='col-xs-3'>
							<input onfocus="Race.hideNameWarning()"
								onfocusout="Race.checkName()" id="race_name" type="text"
								name="race_name" style="width: 100%;"
								value="{{ ($race!=null?$race->race_name:'') }}">
						</div>
						<div class='col-xs-2'>
							@if( $race!=null && $race->is_player_race)
								<input type='checkbox' name='isPlayerRace' value='isPlayerClass' checked="checked"><span class="checkbox_text">Spelerras</span>
							@else
								<input type='checkbox' name='isPlayerRace' value='isPlayerClass'><span class="checkbox_text">Spelerras</span>
							@endif
						</div>
						<div class='col-xs-4 name_warning hidden'>Deze naam bestaat al.
							Kies een andere.</div>
					</div>

					<div class="row well">
						<div class="row">
							<div class='col-xs-2'>
								<b><em>Verboden</em></b> klasse:
							</div>	
							<div class='col-xs-10'>
								@if ( $race == null )
									@foreach($playerclasses as $playerclass)
										@if($playerclass->class_name != "Algemeen")
											<input tabindex="1" type="checkbox" name="prohibited_classes[]" value="{{$playerclass->id}}"><span class="checkbox_text">{{$playerclass->class_name}}</span>
										@endif
									@endforeach
								@else
									<?php 
									foreach($playerclasses as $playerclass){
										if($playerclass->class_name != "Algemeen"){
											if( in_array($playerclass->class_name, $race->prohibited_classes )){
												echo '<input tabindex="1" type="checkbox" name="prohibited_classes[]" value="'.$playerclass->id.'" checked="checked"><span class="checkbox_text">'.$playerclass->class_name.'</span>';
											}
											else{
												echo '<input tabindex="1" type="checkbox" name="prohibited_classes[]" value="'.$playerclass->id.'"><span class="checkbox_text">'.$playerclass->class_name.'</span>';
											}
										}
									}
									?>
								@endif
							</div>
						</div>
						<div class="row">
							<div class='col-xs-2'>
								Afkomst klasse:
							</div>	
							<div class='col-xs-10'>
								@if ( $race == null )
									@foreach($playerclasses as $playerclass)
										@if($playerclass->class_name != "Algemeen")
											<input class="descent_class_choice" tabindex="1" type="checkbox" name="descent_classes[]" value="{{$playerclass->id}}"><span class="checkbox_text">{{$playerclass->class_name}}</span>
										@endif
									@endforeach
								@else
									<?php 
									foreach($playerclasses as $playerclass){
										if($playerclass->class_name != "Algemeen"){
											if( in_array($playerclass->class_name, $race->descent_classes )){
												echo '<input tabindex="1" type="checkbox" name="descent_classes[]" value="'.$playerclass->id.'" checked="checked"><span class="checkbox_text">'.$playerclass->class_name.'</span>';
											}
											else{
												echo '<input tabindex="1" type="checkbox" name="descent_classes[]" value="'.$playerclass->id.'"><span class="checkbox_text">'.$playerclass->class_name.'</span>';
											}
										}
									}
									?>

								@endif
							</div>
						</div>
					</div>	
					
					<div class="row well">
						<div class="col-xs-2">Beschrijving:</div>
						<div class="col-xs-7">
							<script type="text/javascript"
								src="{{ URL::asset('js/nicedit/nicEdit.js') }}"></script>
							<script type="text/javascript">
								bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
							</script>

							<textarea name="race_desc" class="race_desc">{{ ($race!=null?$race->description:'') }}</textarea>
						</div>
					</div>

					<div class="row well">
						<div class="col-xs-2">Basis Statistieken</div>
						<div class="col-xs-4">
							<table class="table borderless">
								<thead>
									<tr>
										<th>LP Torso</th>
										<th>LP Ledematen</th>
										<th>Wilskracht</th>
										<th>Status</th>
										<th>Focus</th>
										<th>Trauma</th>
									</tr>
								</thead>

								<tbody>
									<tr>
										<td class="col-xs-2">{{ ($race!=null?$race->lp_torso:'3') }}</td>
										<td class="col-xs-2">{{ ($race!=null?$race->lp_limbs:'2') }}</td>
										<td class="col-xs-2">{{ ($race!=null?$race->willpower:'2') }}
										</td>
										<td class="col-xs-2">{{ ($race!=null?$race->status:'0') }}</td>
										<td class="col-xs-2">{{ ($race!=null?$race->focus:'0') }}</td>
										<td class="col-xs-2">{{ ($race!=null?$race->trauma:'0') }}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					@include('layouts.tab_buttons', array('tab'=>'tab1',
					'previous'=>null, 'save'=>false, 'next'=>'tab2'))
				</div>

				<div id="rules" class="tab-pane fade">
					@include('rules.addRulesInclude', array('rules'=>$rules,
					'item_rules'=>$race_rules))
					
					@include('layouts.tab_buttons',
					array('tab'=>'tab2', 'previous'=>'tab1', 'save'=>false,
					'next'=>'tab3'))
				</div>
				
				<div id="skills" class="tab-pane fade">
				    <h3>Rasvaardigheden</h3>
					
					<div class="row well">
						<div class="col-xs-2">Selecteer vaardigheden:</div>
						<div class="col-xs-3">
							<div id="race_skills" class="skill_prereqs">
								@if ( $race != null )
									<?php
										foreach($race->race_skills as $race_skill){
											echo '<div class="row" id="'.$race_skill->id.'" style="padding-top: 3px;padding-left: 3px">';
											echo '<div class="col-xs-8">'.$race_skill->name."</div>";
											echo '<div class="col-xs-3">';
											echo '<button class="btn btn-xs pull-right">';
											echo '<span class="glyphicon glyphicon-minus" id="'.$race_skill->id.'" onclick="CreateRaceControl.removeRaceSkill(event);">';
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
							<button type="button" class="btn btn-default" aria-label="Left Align" onclick = "CreateRaceControl.addRaceSkill();">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							</button>
						</div>
					</div>
					
					@if ( $race == null )
						<input id="race_skills_list_hidden" name="race_skills_list" class="hidden">
					@else
						<?php
							$skills_array = [];
							foreach($race->race_skills as $race_skill){
								$skills_array[] = $race_skill->id;
							}
							$json_skills_array = json_encode($skills_array);
						?>

						<input id="race_skills_list_hidden" name="race_skills_list" class="hidden" value="{{$json_skills_array}}">
					@endif
					
					@include('layouts.tab_buttons',	array('tab'=>'tab3', 'previous'=>'tab2', 'save'=>true,
					'next'=>null))
				</div>
		</form>
	</div>

	@include('popups.createSkillSelector', array('submitMethod'=>'CreateRaceControl.submitRaceSkills(event)'))

	<script>
		createRaceTabControl.addTabButtonListeners();
	</script>
@stop
</html>