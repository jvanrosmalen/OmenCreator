<!DOCTYPE html>
<html>
@extends('layouts.app')

@section('content')

<!-- 	Hidden information fields -->
@foreach($wealth_types as $wealth_type)
	<div class="wealth_type hidden" data-id="{{$wealth_type->id}}" data-wealth_type="{{$wealth_type->wealth_type}}"></div>
@endforeach

<div class='container'>
	<div class='row'>
		<div class='col-xs-12'>
			<h3>Cre&euml;er Nieuw Spelerkarakter</h3>
		</div>
	</div>

	<form action="/create_character_submit_basic_info" method="POST">
		<!-- ******************* -->
		<!-- For Laravel CSRF administration -->
		<input type="hidden" name="_token" value="{!! csrf_token() !!}">
		<!-- ******************* -->

		<h3>Basis Informatie</h3>
		<div class='row well'>
			<div class='col-xs-1'>Spelernaam:</div>
			<div class='col-xs-3'>
				<input id='basic_info_player_name' name='player_name' type='text' style='width:100%' readonly placeholder='Selecteer speler met knop hiernaast'>
				<input id='basic_info_player_id' name='player_id' type='hidden' value='-1'>
			</div>
			<div class='col-xs-2'>
				<button id="basic_info_select_player" class="btn btn-default float-right" onClick='PlayerSelector.openPlayerSelector(event)'>Selecteer Speler</button> 
			</div>
			
		</div>
		
		<div class='row well'>
			<div class='col-xs-1'>Naam:</div>
			<div class='col-xs-3'>
				<input id='basic_info_char_name' name="character_name" style="width: 100%;">
			</div>
			<div class='col-xs-3'>
				# Omens Overleefd: <input class='number_input' type="number" name="nr_events_survived" min="0" value="0" onChange="CreatePlayerCharBasicInfo.handleSurvivedChange(event)"> 
			</div>
			<div class='col-xs-4'>
				Karakter-niveau : 
				@foreach($skilllevels as $skilllevel)
					@if ($skilllevel->id == 1)
						<input id="char_level" type="hidden" name="char_level" value="{{$skilllevel->id}}">
						<span id="char_level_name_{{$skilllevel->id}}">{{$skilllevel->skill_level}}</span>
   					@else
						<span id="char_level_name_{{$skilllevel->id}}" class="hidden">{{$skilllevel->skill_level}}</span>
					@endif
				@endforeach
			</div>
		</div>

		<div class="row well">
			<div class='row'>
				<div class="col-xs-1"></div>
				<div class="col-xs-1">Ras:</div>
				<div class="col-xs-2">
					<select id="race_selection" name='character_race' onChange="CreatePlayerCharBasicInfo.handleRaceSelection(event)">
						<option value="-1"
						data-lp_torso = "3"
						data-lp_limbs = "2"
						data-willpower = "2"
						data-status = "0"
						data-focus = "0"
						data-trauma = "0"
						>Geen keuze</option>
						@foreach($races as $race)
							<option value="{{$race->id}}"
							 data-lp_torso = "{{$race->lp_torso}}"
							 data-lp_limbs = "{{$race->lp_limbs}}"
							 data-willpower = "{{$race->willpower}}"
							 data-status = "{{$race->status}}"
							 data-focus = "{{$race->focus}}"
							 data-trauma = "{{$race->trauma}}"
							 >{{$race->race_name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-xs-1">Klasse:</div>
				<div class="col-xs-2">
					<span id='playerclass_race_first_warning'><em>Kies eerst het ras</em></span>
					<select id='playerclass_select' class='hidden' name='character_class' onChange="CreatePlayerCharBasicInfo.handleClassSelection(event)">
						<option value="-1">Geen keuze</option>
						@foreach($playerclasses as $playerclass)
							@if($playerclass->class_name != "Algemeen")
								<option id="{{$playerclass->class_name}}" value="{{$playerclass->id}}">{{$playerclass->class_name}}</option>
							@endif
						@endforeach
					</select>
				</div>
				<div class="col-xs-1">Welvaart:</div>
				<div id="base_wealth" class="col-xs-2">Arm</div>
				<div id='playerclass_prohibited_remark' class="col-xs-2">
				</div>
			</div>

			<div class="row">
				<div class="col-xs-1">
				</div>
				<div class="col-xs-8">
					<table class="table borderless detail_table">
						<thead>
					            <tr>
					                <th id='stat_1_name'>
					                    LP Torso
					                </th>
					                <th>
					                	LP Ledematen
					                </th>
					                <th id='stat_2_name'>
					                	Wilskracht
					                </th>
					                <th id='stat_3_name'>
					                	Status
					                </th>
					                <th id='stat_4_name'>
					                	Focus
					                </th>
					                <th>
					                	Trauma
					                </th>
					            </tr>
						</thead>
						<tbody>
							<tr>
							<!-- Dirty, dirty, I know.... using magic numbers for stats -->
								<td id='base_stat_1'>3</td>
								<td id='base_stat_11'>2</td>
								<td id='base_stat_2'>2</td>
								<td id='base_stat_3'>0</td>
								<td id='base_stat_4'>0</td>
								<td id='base_stat_5'>0</td>
							</tr>
						</tbody>		
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-1">
				</div>
				<div class="col-xs-2">
					Rasvaardigheden:
				</div>
				<div class="col-xs-6 race_skills">
					<span id="race_skills_no_race"><em>Kies eerst het ras</em></span>
					@foreach($races as $race)
						<span id="race_skills_{{$race->id}}" class="hidden">
							@php
								$skills_array = array();
								
								foreach($race->race_skills as $race_skill){
									$skills_array[] = $race_skill->name; 
								}
								
								echo join(", ", $skills_array);
							@endphp
						</span>
					@endforeach
				</div>
			</div>
		</div>

		<div class="row well">
				<div class="col-xs-1"></div>
				<div class="col-xs-1">Start EP:</div>
				<div class="col-xs-1">
					<input id='input_start_ep' class='number_input' type="number" name="start_ep" min="0" value='15' onChange="CreateCharacter.handleEpInput(event)">
				</div>
				<div class='col-xs-1'></div>
				<div class='col-xs-1'>Reden:</div> 
				<div class='col-xs-4'>
					<input name="ep_reason" style="width: 100%;" placeholder="bv Karaktercreatie plus background" value="">
				</div>
		</div>

		<div class="row">
			<div class="col-xs-9">
			</div>
			<div class="col-xs-2">
				<button id="basic_info_next" type='submit' class="btn btn-default" style="width:100%" onClick='CreatePlayerCharBasicInfo.submitBasicInfo(event)'>Volgende</button>
			</div>
			<div class="col-xs-1">
			</div>	
		</div>

	</form>

	@include('popups.showErrorMessage')
	@include('popups.showLoaderMessage')
	@include('popups.selectPlayer', array('submitMethod'=>'CreatePlayerCharBasicInfo.submitPlayerSelection(event)', 'users'=>$users))
@stop
</html>