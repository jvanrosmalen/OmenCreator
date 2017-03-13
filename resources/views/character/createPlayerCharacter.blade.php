<!DOCTYPE html>
<html>
@extends('layouts.app') @section('content')
<div class='container'>
	<div class='row'>
		<div class='col-xs-12'>
			@if($character == null)
			<h3>Cre&euml;er Nieuw Spelerkarakter</h3>
			@else
			<h3>Aanpassen Spelerkarakter</h3>
			@endif
		</div>
	</div>

	@if ($character == null)
	<form id="{{ ($character!=null?$character->id:-1) }}"
		action="/create_character_submit" method="POST">
		@else
		<form id="{{ ($character!=null?$character->id:-1) }}"
			action="/create_character_update/{{ $character->id }}" method="POST">
			@endif

			<!-- ******************* -->
			<!-- For Laravel CSRF administration -->
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<!-- ******************* -->

			<ul class="nav nav-tabs">
				<li class="active"><a id="tab1" data-toggle="tab" href="#base_info">Basis
						Info</a></li>
				<li><a id="tab2" data-toggle="tab" href="#skills">Vaardigheden</a></li>
			</ul>

			<div class="tab-content">
				<div id="base_info" class="tab-pane fade in active">
					<h3>Basis Informatie</h3>
					<div class='row well'>
						<div class='col-xs-2'>Naam:</div>
						<div class='col-xs-3'>
							<input name="character_name" style="width: 100%;"
								value="{{ ($character!=null?$character->character_name:'') }}">
						</div>
<!-- 						Hidden fields for isPlayerCharacter and isAlive setting. -->
						<input class='hidden' type='checkbox' name='isPlayerCharacter' value='isPlayerChar' checked="checked">
						<input class='hidden' type='checkbox' name='isAlive' value='isAlive' checked="checked">
					</div>

					<div class="row well">
						<div class="col-xs-2">Kies Ras:</div>
						<div class="col-xs-2">
							<select name='character_race' onChange="CreateCharacter.handleRaceSelection(event)">
								<option value="-1">Geen keuze</option>
								@foreach($races as $race)
									<option value="{{$race->id}}">{{$race->race_name}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-xs-1">
						</div>
						<div class="col-xs-2">Kies Klasse:</div>
						<div class="col-xs-2">
							<span id='playerclass_race_first_warning'><em>Kies eerst het ras</em></span>
							<select id='playerclass_select' class='hidden' name='character_race'>
								@foreach($playerclasses as $playerclass)
									@if($playerclass->class_name != "Algemeen")
										<option id="{{$playerclass->class_name}}" value="{{$playerclass->id}}">{{$playerclass->class_name}}</option>
									@endif
								@endforeach
							</select>
						</div>
						<div id='playerclass_prohibited_remark' class="col-xs-2">
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
										<td class="col-xs-2">{{ ($character!=null?$character->lp_torso:'3') }}</td>
										<td class="col-xs-2">{{ ($character!=null?$character->lp_limbs:'2') }}</td>
										<td class="col-xs-2">{{ ($character!=null?$character->willpower:'2') }}
										</td>
										<td class="col-xs-2">{{ ($character!=null?$character->status:'0') }}</td>
										<td class="col-xs-2">{{ ($character!=null?$character->focus:'0') }}</td>
										<td class="col-xs-2">{{ ($character!=null?$character->trauma:'0') }}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					@include('layouts.tab_buttons', array('tab'=>'tab1',
					'previous'=>null, 'save'=>false, 'next'=>'tab2'))
				</div>

				<div id="skills" class="tab-pane fade">
				    <h3>Rasvaardigheden</h3>
					
					<div class="row well">
						<div class="col-xs-2">Selecteer vaardigheden:</div>
						<div class="col-xs-3">
							<div id="character_skills" class="skill_prereqs">
								@if ( $character != null )
									<?php
										foreach($character->character_skills as $character_skill){
											echo '<div class="row" id="'.$character_skill->id.'" style="padding-top: 3px;padding-left: 3px">';
											echo '<div class="col-xs-8">'.$character_skill->name."</div>";
											echo '<div class="col-xs-3">';
											echo '<button class="btn btn-xs pull-right">';
											echo '<span class="glyphicon glyphicon-minus" id="'.$character_skill->id.'" onclick="CreateCharacterControl.removeCharacterSkill(event);">';
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
							<button type="button" class="btn btn-default" aria-label="Left Align" onclick = "CreateCharacterControl.addCharacterSkill();">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							</button>
						</div>
					</div>
					
					<input id="character_skills_list_hidden" name="character_skills_list" class="hidden">
					
					@include('layouts.tab_buttons',	array('tab'=>'tab2', 'previous'=>'tab1', 'save'=>true,
					'next'=>null))
				</div>
		</form>
	</div>

	@include('popups.createSkillSelector', array('submitMethod'=>'CreateCharacterControl.submitCharacterSkills(event)'))

	<script>
		CreateCharacterTabControl.addTabButtonListeners();
	</script>
@stop
</html>