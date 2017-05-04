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
				<li><a id="tab3" data-toggle="tab" href="#class_skills">Klasse Vaardigheden</a></li>
				<li><a id="tab4" data-toggle="tab" href="#non_class_skills">Niet-Klasse Vaardigheden</a></li>
				<li><a id="tab5" data-toggle="tab" href="#overview">Overzicht</a></li>
			</ul>

			<div class="tab-content">
				<div id="base_info" class="tab-pane fade in active">
					<h3>Basis Informatie</h3>
					<div class='row well'>
						<div class='col-xs-1'>Naam:</div>
						<div class='col-xs-3'>
							<input name="character_name" style="width: 100%;"
								value="{{ ($character!=null?$character->character_name:'') }}" onChange="CreateCharacter.handleNameChange(event)">
						</div>
						<div class='col-xs-3'>
							# Omens Overleefd: <input class='number_input' type="number" name="nr_events_survived" min="0" value="0" onChange="CreateCharacter.handleSurvivedChange(event)"> 
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
<!-- 						Hidden fields for isPlayerCharacter and isAlive setting. -->
						<input class='hidden' type='checkbox' name='isPlayerCharacter' value='isPlayerChar' checked="checked">
						<input class='hidden' type='checkbox' name='isAlive' value='isAlive' checked="checked">
					</div>

					<div class="row well">
						<div class='row'>
							<div class="col-xs-1"></div>
							<div class="col-xs-1">Ras:</div>
							<div class="col-xs-2">
								<select id="race_selection" name='character_race' onChange="CreateCharacter.handleRaceSelection(event)">
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
								<select id='playerclass_select' class='hidden' name='character_class' onChange="CreateCharacter.handleClassSelection(event)">
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
								<h4>Aantal bestede EP: <span id='spent_descent_ep' data-ep_amount='0'>0</span> van <span id='total_descent_ep' data-ep_amount='3'>3</span></h4>
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
							<div class="col-xs-1">
							</div>
							
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
							
							<input type='hidden' id="descent_skill_list_hidden" name="descent_skill_list" value="[]">
						</div>
						<div class='row'>
							<div class='col-xs-2'>
							</div>
							<div class='col-xs-10'>
								<div class='row'>
									Reeds geselecteerd in andere tabbladen:
								</div>
								<div class='row'>
									<span id='already_selected_descent_skills' class='warning_not_entered italic_text'>Geen</span>
								</div>
							</div>
						</div>
					</div>									    
				    @include('layouts.tab_buttons',	array('tab'=>'tab2', 'previous'=>'tab1', 'save'=>false,
					'next'=>'tab3'))
				</div>

				<div id="class_skills" class="tab-pane fade">
				    <h3>Karaktervaardigheden (Klasse)</h3>
					
				    <div id='class_first_warning' class='row well'>
						<div class='row'>
							<div class='col-xs-1'>
							</div>
							<div class='col-xs-10'>
								Selecteer eerst een spelerklasse in de tab 'Basis Info'.
							</div>
						</div>				    	
				    </div>
				    
				    <div id='class_selected' class='row well hidden'>
						<div class='row'>
							<div class='col-xs-1'>
							</div>
							<div class='col-xs-10'>
								Selecteer uit onderstaande lijst de vaardigheden van jouw karakter.
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-1'>
							</div>
							<div class='col-xs-10'>
								<h4>Aantal bestede EP: <span class='spent_character_ep' data-ep_amount='0'>0</span> van <span class='total_character_ep' data-ep_amount='15'>15</span></h4>
							</div>
						</div>
				    </div>
				    
				    <div id='class_skills_to_select' class='row well hidden'>
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
								<table id="character_class_skill_selected" class="table table-fixedheader table-responsive table-condensed table-hover sortable">
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
								<button type="button" class="btn btn-default character_class_skill_select_btn disabled" aria-label="Select Vaardigheid">
									<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
								</button>
								<br>
								<button type="button" class="btn btn-default character_class_skill_remove_btn disabled" aria-label="Verwijder Vaardigheid">
									<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
								</button>
							</div>
							
							<div class="col-xs-4">
								<table id="character_class_skill_options" class="table table-fixedheader table-responsive table-condensed table-hover sortable">
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
							
							<input type='hidden' id="character_class_skill_list_hidden" name="character_class_skill_list" value="[]">
						</div>
						<div class='row'>
							<div class='col-xs-2'>
							</div>
							<div class='col-xs-10'>
								<div class='row'>
									Reeds geselecteerd in andere tabbladen:
								</div>
								<div class='row'>
									<span id='already_selected_class_skills' class='warning_not_entered italic_text'>Geen</span>
								</div>
							</div>
						</div>
					</div>
					@include('layouts.tab_buttons',	array('tab'=>'tab3', 'previous'=>'tab2', 'save'=>false,
					'next'=>'tab4'))
				</div>
				<div id="non_class_skills" class="tab-pane fade">
				    <h3>Karaktervaardigheden (Niet-Klasse)</h3>
					
				    <div id='non_class_first_warning' class='row well'>
						<div class='row'>
							<div class='col-xs-1'>
							</div>
							<div class='col-xs-10'>
								Selecteer eerst een spelerklasse in de tab 'Basis Info'.
							</div>
						</div>				    	
				    </div>
				    
				    <div id='non_class_selected' class='row well hidden'>
						<div class='row'>
							<div class='col-xs-1'>
							</div>
							<div class='col-xs-10'>
								Selecteer uit onderstaande lijst de vaardigheden van jouw karakter.<br>
								<em>Opgepast: hieronder staan vaardigheden die buiten je klasse vallen. Deze kosten dubbel EP!</em>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-1'>
							</div>
							<div class='col-xs-10'>
								<h4>Aantal bestede EP: <span class='spent_character_ep' data-ep_amount='0'>0</span> van <span class='total_character_ep' data-ep_amount='15'>15</span></h4>
							</div>
						</div>
				    </div>
				    
				    <div id='non_class_skills_to_select' class='row well hidden'>
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
								<table id="character_non_class_skill_selected" class="table table-fixedheader table-responsive table-condensed table-hover sortable">
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
								<button type="button" class="btn btn-default character_non_class_skill_select_btn disabled" aria-label="Select Vaardigheid">
									<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
								</button>
								<br>
								<button type="button" class="btn btn-default character_non_class_skill_remove_btn disabled" aria-label="Verwijder Vaardigheid">
									<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
								</button>
							</div>
							
							<div class="col-xs-4">
								<table id="character_non_class_skill_options" class="table table-fixedheader table-responsive table-condensed table-hover sortable">
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
							
							<input type='hidden' id="character_non_class_skill_list_hidden" name="character_non_class_skill_list" value="[]">
						</div>
						<div class='row'>
							<div class='col-xs-2'>
							</div>
							<div class='col-xs-10'>
								<div class='row'>
									Reeds geselecteerd in andere tabbladen:
								</div>
								<div class='row'>
									<span id='already_selected_non_class_skills' class='warning_not_entered italic_text'>Geen</span>
								</div>
							</div>
						</div>
					</div>
					@include('layouts.tab_buttons',	array('tab'=>'tab4', 'previous'=>'tab3', 'save'=>false,
					'next'=>'tab5'))
				</div>
				<div id="overview" class="tab-pane fade in">
					<div class='row well'>
						<div class='row'>
							<div class='col-xs-1'></div>
							<div class='col-xs-1'>Naam:</div>
							<div class='col-xs-9'>
								<span id="overview_name" class="warning_not_entered">Niet ingevuld</span>
							</div>
						</div>
						<div class='row'>
							<div class="col-xs-1"></div>
							<div class="col-xs-1">
								Start EP: 
							</div>
							<div class="col-xs-2">
								<span id="overview_start_ep">15</span>
							</div>
							<div class='col-xs-1'>
								#Omens: 
							</div>
							<div class='col-xs-2'>
								<span id="overview_survived">0</span>
							</div> 
							<div class='col-xs-1'>
								Niveau : 
							</div>
							<div class='col-xs-1'>	
								<span id="overview_char_level">Debutant</span>
							</div>
						</div>
						<div class='row'>
							<div class="col-xs-1">
							</div>
							<div class="col-xs-1">
								Spelerras: 
							</div>
							<div class="col-xs-2">
								<span id="overview_race" class="warning_not_entered">Niet geselecteerd</span>
							</div>
							<div class="col-xs-1">
								Klasse: 
							</div>
							<div class="col-xs-2">
								<span id="overview_class" class="warning_not_entered">Niet geselecteerd</span>
							</div>
							<div class="col-xs-1">
								Welvaart:
							</div>
							<div class="col-xs-2">
								<span id="overview_wealth" data-base='1' data-descent='1' data-class='1' data-nonclass='1' data-value='1'>Arm</span>
							</div>
						</div>
						
						<div class="row">
							<div class="col-xs-1">
							</div>
							<div class="col-xs-8">
								<table class="table borderless detail_table">
									<thead>
								            <tr>
								                <th>
								                    LP Torso
								                </th>
								                <th>
								                	LP Ledematen
								                </th>
								                <th>
								                	Wilskracht
								                </th>
								                <th>
								                	Status
								                </th>
								                <th>
								                	Focus
								                </th>
								                <th>
								                	Trauma
								                </th>
								            </tr>
									</thead>
									<tbody>
										<tr>
											<td id="overview_stat_1" class="overview_stat" data-base='3' data-descent='0' data-class='0' data-nonclass='0' data-value='3'>3</td>
											<td id="overview_stat_11" class="overview_stat" data-value='2'>2</td>
											<td id="overview_stat_2" class="overview_stat" data-base='2' data-descent='0' data-class='0' data-nonclass='0' data-value='2'>2</td>
											<td id="overview_stat_3" class="overview_stat" data-base='0' data-descent='0' data-class='0' data-nonclass='0' data-value='0'>0</td>
											<td id="overview_stat_4" class="overview_stat" data-base='0' data-descent='0' data-class='0' data-nonclass='0' data-value='0'>0</td>
											<td id="overview_stat_5" class="overview_stat" data-base='0' data-descent='0' data-class='0' data-nonclass='0' data-value='0'>0</td>
										</tr>
									</tbody>		
								</table>
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-1'>
							</div>
							<div class='col-xs-2'>
								Resistenties
							</div>
							<div class="col-xs-3">
								<table class="table borderless detail_table">
									<thead>
								            <tr>
								                <th>
								                    Angst
								                </th>
								                <th>
								                	Diefstal
								                </th>
								                <th>
								                	Trauma
								                </th>
								            </tr>
									</thead>
									<tbody>
										<tr>
											<td id="overview_res_1" class="overview_fear_res overview_res" data-value='0' data-descent='0' data-class='0' data-nonclass='0'>0</td>
											<td id="overview_res_2" class="overview_theft_res overview_res" data-value='0' data-descent='0' data-class='0' data-nonclass='0'>0</td>
											<td id="overview_res_3" class="overview_trauma_res overview_res" data-value='0' data-descent='0' data-class='0' data-nonclass='0'>0</td>
										</tr>
									</tbody>		
								</table>
							</div>							
							<div class="col-xs-3">
								<table class="table borderless detail_table">
									<thead>
								            <tr>
								                <th>
								                    Gif
								                </th>
								                <th>
								                	Magie
								                </th>
								                <th>
								                	Ziekte
								                </th>
								            </tr>
									</thead>
									<tbody>
										<tr>
											<td id="overview_res_4" class="overview_poison_res overview_res" data-value='0' data-descent='0' data-class='0' data-nonclass='0'>0</td>
											<td id="overview_res_5" class="overview_magic_res overview_res" data-value='0' data-descent='0' data-class='0' data-nonclass='0'>0</td>
											<td id="overview_res_6" class="overview_disease_res overview_res" data-value='0' data-descent='0' data-class='0' data-nonclass='0'>0</td>
										</tr>
									</tbody>		
								</table>
							</div>							
						</div>
					</div>

					<div class="row well">
						<div class='row'>
							<div class="col-xs-1"></div>
							<div class="col-xs-2">
								Afkomstvaardigheden:
							</div>
						</div>
						<div class='row'>
							<div class="col-xs-2"></div>
							<div class="col-xs-10">
								<span id="overview_descent_skills" class="warning_not_entered">Niet geselecteerd</span>
							</div>
						</div>
						<div class='row'>
							<div class="col-xs-1"></div>
							<div class="col-xs-2">
								Klasse Vaardigheden:
							</div>
						</div>
						<div class='row'>
							<div class="col-xs-2"></div>
							<div class="col-xs-10">
								<span id="overview_class_skills" class="warning_not_entered">Niet geselecteerd</span>
							</div>
						</div>
						<div class='row'>
							<div class="col-xs-1"></div>
							<div class="col-xs-2">
								Niet-klasse Vaardigheden:
							</div>
						</div>
						<div class='row'>
							<div class="col-xs-2"></div>
							<div class="col-xs-10">
								<span id="overview_non_class_skills" class="warning_not_entered">Niet geselecteerd</span>
							</div>
						</div>
					</div>
						
					@include('layouts.tab_buttons',	array('tab'=>'tab5', 'previous'=>'tab4', 'save'=>true,
					'next'=>null))
				</div>
			</div>
		</form>
	</div>

	@include('popups.createSkillSelector', array('submitMethod'=>'createCharacterControl.submitCharacterSkills(event)'))
	@include('popups.showErrorMessage')

	<script>
		CreateCharacterTabControl.addTabButtonListeners();
	</script>
	
@stop
</html>