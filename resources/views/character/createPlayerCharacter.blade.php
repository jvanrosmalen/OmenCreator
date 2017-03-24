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
				<li class="active"><a id="tab1" data-toggle="tab" href="#base_info">Basis Info</a></li>
				<li><a id="tab2" data-toggle="tab" href="#descent_skills">Afkomst</a></li>
				<li><a id="tab3" data-toggle="tab" href="#skills">Vaardigheden</a></li>
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
						<div class='col-xs-3'>
							# Omens Overleefd: <input class='number_input' type="number" name="nr_events_survived" min="1" value="1"> 
						</div>
<!-- 						Hidden fields for isPlayerCharacter and isAlive setting. -->
						<input class='hidden' type='checkbox' name='isPlayerCharacter' value='isPlayerChar' checked="checked">
						<input class='hidden' type='checkbox' name='isAlive' value='isAlive' checked="checked">
					</div>

					<div class="row well">
						<div class="col-xs-2"></div>
						<div class="col-xs-1">Kies Ras:</div>
						<div class="col-xs-2">
							<select name='character_race' onChange="CreateCharacter.handleRaceSelection(event)">
								<option value="-1">Geen keuze</option>
								@foreach($races as $race)
									<option value="{{$race->id}}">{{$race->race_name}}</option>
								@endforeach
							</select>
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
							<div class="col-xs-2"></div>
							<div class="col-xs-1">Start EP:</div>
							<div class="col-xs-1">
								<input class='number_input' type="number" name="start_ep" min="1" value='1'>
							</div>
							<div class='col-xs-1'></div>
							<div class='col-xs-1'>Reden:</div> 
							<div class='col-xs-4'>
								<input name="ep_reason" style="width: 100%;" placeholder="bv Karaktercreatie plus background" value="">
							</div>
					</div>

					@include('layouts.tab_buttons', array('tab'=>'tab1',
					'previous'=>null, 'save'=>false, 'next'=>'tab2'))
				</div>

				<div id="descent_skills" class="tab-pane fade">
				    <h3>Afkomstvaardigheden</h3>
				    
				    <div id='descent_race_first_warning' class='row well'>
						<div class='row'>
							<div class='col-xs-1'>
							</div>
							<div class='col-xs-10'>
								Selecteer eerst een spelerras in de tab 'Basis Info'.
							</div>
						</div>				    	
				    </div>
				    <div id='descent_race_selected' class='row well hidden'>
						<div class='row'>
							<div class='col-xs-1'>
							</div>
							<div class='col-xs-10'>
								Selecteer uit onderstaande lijst een aantal vaardigheden met een
				    			gezamelijke EP-waarde van 3 EP.
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-1'>
							</div>
							<div class='col-xs-10'>
								<h4>Aantal te besteden EP: <span id='spent_descent_ep' data-descent_ep_amount='3'>3</span></h4>
							</div>
						</div>
				    </div>
					<div id='descent_race_skills_to_select' class='row well hidden'>

						<div class='row'>
							<div class='col-xs-1'>
							</div>
							<div class='col-xs-4'>
								<h4>Geselecteerd:</h4>
							</div>
							<div class='col-xs-2'>
							</div>
							<div class='col-xs-4'>
								<h4>Opties:</h4>
							</div>
						</div>
						
						<div class="row">
							<div class="col-xs-1"></div>
							
							<div class="col-xs-4">
								<table id="descent_race_skill_selected" class="table table-fixedheader table-responsive table-condensed table-hover sortable">
			        				<thead>
			            				<tr>
							                <th class="col-xs-7">
							                    Naam
							                </th>
							                <th class="col-xs-3">
							                	Klasse
							                </th>
							                <th class="col-xs-2">
							                	EP
							                </th>
							            </tr>
							        </thead>
			 
							        <tbody>
									</tbody>
							    </table>
							</div>
							
							<div class="col-xs-2 text-center">
								<button type="button" class="btn btn-default descent_race_skill_select_btn disabled" aria-label="Select Vaardigheid">
									<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
								</button>
								<br>
								<button type="button" class="btn btn-default descent_race_skill_remove_btn disabled" aria-label="Verwijder Vaardigheid">
									<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
								</button>
							</div>
							
							<div class="col-xs-4">
								<table id="descent_race_skill_options" class="table table-fixedheader table-responsive table-condensed table-hover sortable">
			        				<thead>
			            				<tr>
							                <th class="col-xs-7">
							                    Naam
							                </th>
							                <th class="col-xs-3">
							                	Klasse
							                </th>
							                <th class="col-xs-2">
							                	EP
							                </th>
							            </tr>
							        </thead>
			 
							        <tbody>
									</tbody>
							    </table>
							</div>
							
							<input type='hidden' id="descent_skill_list_hidden" name="descent_skill_list">
						</div>
					</div>									    
				    @include('layouts.tab_buttons',	array('tab'=>'tab2', 'previous'=>'tab1', 'save'=>false,
					'next'=>'tab3'))
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
											echo '<span class="glyphicon glyphicon-minus" id="'.$character_skill->id.'" onclick="createCharacterControl.removeCharacterSkill(event);">';
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
							<button type="button" class="btn btn-default" aria-label="Left Align" onclick = "createCharacterControl.addCharacterSkill();">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							</button>
						</div>
					</div>
					
					<input id="character_skills_list_hidden" name="character_skills_list" class="hidden">
					
					@include('layouts.tab_buttons',	array('tab'=>'tab3', 'previous'=>'tab2', 'save'=>true,
					'next'=>null))
				</div>
		</form>
	</div>

	@include('popups.createSkillSelector', array('submitMethod'=>'createCharacterControl.submitCharacterSkills(event)'))

	<script>
		CreateCharacterTabControl.addTabButtonListeners();
	</script>
@stop
</html>