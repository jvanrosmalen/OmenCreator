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
			<h3>Cre&euml;er Nieuw Spelerkarakter (Speler: {{$basic_info['player_name']}})</h3>
		</div>
	</div>
	
	<form action="create_character_submit_skills" method="POST">
		<!-- ******************* -->
		<!-- For Laravel CSRF administration -->
		<input type="hidden" name="_token" value="{!! csrf_token() !!}">
		<!-- ******************* -->
		
		<!-- Hidden stuff for data transfer -->
		<input type='hidden' name='player_id' value="{{$basic_info['player_id']}}">
		<input type='hidden' name='start_ep' value="{{$basic_info['start_ep']}}">
		
		<ul class="nav nav-tabs">
			<li class="active"><a id="tab1" data-toggle="tab" href="#base_info">Basis Info</a></li>
			<li><a id="tab2" data-toggle="tab" href="#descent_skills">Afkomst</a></li>
			<li><a id="tab3" data-toggle="tab" href="#class_skills">Klasse Vaardigheden</a></li>
			<li><a id="tab4" data-toggle="tab" href="#non_class_skills">Niet-Klasse Vaardigheden</a></li>
			<li><a id="tab5" data-toggle="tab" href="#title_faith">Titel en Geloof</a></li>
			<li><a id="tab6" data-toggle="tab" href="#overview">Overzicht</a></li>
		</ul>
		
		<div class="tab-content">
			<div id="base_info" class="tab-pane fade in active">
				<h3>Basis Informatie</h3>
				<div class='row well'>
					<div class='col-xs-1'>Naam:</div>
					<div class='col-xs-3'>
						<input type="hidden" name="character_name" readonly style="width: 100%;" value="{{$basic_info['char_name']}}">
						<span>{{$basic_info['char_name']}}</span>
					</div>
					<div class='col-xs-3'>
						# Omens Overleefd: 
						<input class='number_input' type="hidden" name="nr_events_survived" readonly value="{{$basic_info['nr_events']}}">
						<span>{{$basic_info['nr_events']}}</span> 
					</div>
					<div class='col-xs-4'>
						Karakter-niveau :
   						<input id="char_level" type="hidden" name="char_level" value="{{$char_level->id}}">
   						<span>{{$char_level->skill_level}}</span>
					</div>
				</div>

				<div class="row well">
					<div class='row'>
						<div class="col-xs-1"></div>
						<div class="col-xs-1">Ras:</div>
						<div class="col-xs-2">
							<input type='hidden' name='character_race' value='{{$char_race->id}}'>
							<span>{{$char_race->race_name}}</span>
						</div>
						<div class="col-xs-1">Klasse:</div>
						<div class="col-xs-2">
							<input id="input_character_class" type='hidden' name='character_class' value='{{$char_class->id}}'>
							<div id="char_class_ids" class="hidden"
								 data-value='@php echo json_encode($char_class_id_array);@endphp'></div>
							<span>{{$char_class->class_name}}</span>
						</div>
						<div class="col-xs-1">Welvaart:</div>
						<div id="base_wealth" class="col-xs-2">{{$char_wealth['wealth_type']}}</div>
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
										<td>{{$char_race->lp_torso}}</td>
										<td>{{$char_race->lp_limbs}}</td>
										<td>{{$char_race->willpower}}</td>
										<td>{{$char_race->status}}</td>
										<td>{{$char_race->focus}}</td>
										<td>{{$char_race->trauma}}</td>
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
							<span>
								@php
									$race_skills_array = array();
									
									foreach($char_race->race_skills as $race_skill){
										$race_skills_array[] = $race_skill->name; 
									}
									
									$race_skills_string = join(", ", $race_skills_array);
									
									echo $race_skills_string;
									
									// This is to be used for the hidden input field right below.
									$race_skill_ids_array = json_encode($char_race->race_skill_ids);
								@endphp
								<input
									type='hidden'
									id="race_skill_list_hidden"
									name="race_skill_list" value="{{$race_skill_ids_array}}">
							</span>
						</div>
					</div>
				</div>

				<div class="row well">
					<div class="col-xs-1"></div>
					<div class="col-xs-1">Start EP:</div>
					<div class="col-xs-1">
						<input type='hidden' name="start_ep" value="{{$basic_info['start_ep']}}">
						<span>{{$basic_info['start_ep']}}</span>
					</div>
					<div class='col-xs-1'></div>
					<div class='col-xs-1'>Reden:</div> 
					<div class='col-xs-4'>
						<input type='hidden' name="ep_reason" value="{{$basic_info['ep_reason']}}">
						<span>{{$basic_info['ep_reason']}}</span>
					</div>
				</div>

				@include('layouts.tab_buttons', array('tab'=>'tab1',
				'previous'=>null, 'save'=>false, 'next'=>'tab2'))
			</div>
			
			<div id="descent_skills" class="tab-pane fade">
				<h3>Afkomstvaardigheden</h3>
				    
			    <div id='descent_race_selected' class='row well'>
					<div class='row'>
						<div class='col-xs-1'>
						</div>
						<div class='col-xs-5'>
							Selecteer uit onderstaande lijst een aantal vaardigheden met een
			    			gezamelijke EP-waarde van 3 EP.
						</div>
						<div class='col-xs-1'>
						</div>
						<div class='col-xs-4'>
							<div>
								<div class="input-group col-md-12">
									<input id="descentSkillSearch" type="text" class="search-query form-control" placeholder="Werkt nog niet" onchange="CreatePlayerCharSkills.descentSkillSearch();"/>
									<span class="input-group-btn">
										<button class="btn btn-danger" type="button">
											<span class=" glyphicon glyphicon-search"></span>
										</button>
									</span>
								</div>
							</div>					
						</div>
					</div>
					<div class='row'>
						<div class='col-xs-1'>
						</div>
						<div class='col-xs-5'>
							<h4>Aantal bestede EP: <span id='spent_descent_ep' data-ep_amount='0'>0</span> van <span id='total_descent_ep' data-ep_amount='3'>3</span></h4>
						</div>
						<div class='col-xs-1'>
						</div>
						<div class='col-xs-4'>
							<div class='col-md-12 descentSkillSearchRespons align-top'>
									Deze vaardigheid is geen Afkomstvaardigheid.
							</div>
						</div>
					</div>
			    </div>
				<div id='descent_race_skills_to_select' class='row well'>

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
						        	@foreach($descent_skills as $skill)
						        		<tr class="descent_skill_selection descent_skill_selection_{{$skill->id}} hidden"
						        			data-id="{{$skill->id}}"
						        			data-ep_cost = "{{$skill->ep_cost}}"
						        			data-mentor_required = "{{$skill->mentor_required}}"
						        			data-skill_prereqs = "{{ $skill->skill_prereqs}}"
						        			data-skill_group_prereqs = "{{$skill->skill_group_prereqs}}"
						        			data-res_rules = "{{$skill->res_rules}}"
						        			data-call_rules = "{{$skill->call_rules}}"
						        			data-stat_rules = "{{$skill->stat_rules}}"
						        			data-class_rules = "{{$skill->class_rules}}"
						        			data-statistic_prereq_id = "{{$skill->statistic_prereq_id}}"
						        			data-statistic_prereq_amount = "{{$skill->statistic_prereq_amount}}"
						        			data-wealth_rules = "{{$skill->wealth_rules}}"
						        			data-wealth_prereq_id = "{{$skill->wealth_prereq_id}}"
						        			oncontextmenu = "ShowAll->showSkillDetails(event);"
						        			onclick="CreatePlayerCharSkills.descentSkillSelectionListener(event);">
						        			
						        			<td id="{{$skill->name}}" class="skillname col-xs-7">
						        				{{$skill->name}}
						        			</td>
						        			<td class="player_classes col-xs-3" data-value="
						        				@php echo json_encode($skill->player_class_ids);@endphp">
						        				@php
						        					echo join(", ", $skill->player_classes);
						        				@endphp
						        			</td>
						        			<td class="col-xs-1 skill_ep_cost">
						        				{{$skill->ep_cost}}
						        			</td>
						        		</tr>
						        	@endforeach
								</tbody>
						    </table>
						</div>
						
						<div class="col-xs-2 text-center">
							<button
								type="button"
								class="btn btn-default descent_skill_select_btn disabled"
								aria-label="Select Vaardigheid"
								onclick="CreatePlayerCharSkills.descentSkillSelectButtonListener(event);">
								<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
							</button>
							<br>
							<button
								type="button"
								class="btn btn-default descent_skill_remove_btn disabled"
								aria-label="Verwijder Vaardigheid"
								onclick="CreatePlayerCharSkills.descentSkillRemoveButtonListener(event);">
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
						        	@foreach($descent_skills as $skill)
						        		<tr class="descent_skill_option descent_skill_option_{{$skill->id}}"
						        			data-id="{{$skill->id}}"
						        			data-ep_cost = "{{$skill->ep_cost}}"
						        			data-mentor_required = "{{$skill->mentor_required}}"
						        			data-skill_prereqs = "{{ $skill->skill_prereqs}}"
						        			data-skill_group_prereqs = "{{$skill->skill_group_prereqs}}"
						        			data-res_rules = "{{$skill->res_rules}}"
						        			data-call_rules = "{{$skill->call_rules}}"
						        			data-stat_rules = "{{$skill->stat_rules}}"
						        			data-class_rules = "{{$skill->class_rules}}"
						        			data-statistic_prereq_id = "{{$skill->statistic_prereq_id}}"
						        			data-statistic_prereq_amount = "{{$skill->statistic_prereq_amount}}"
						        			data-wealth_rules = "{{$skill->wealth_rules}}"
						        			data-wealth_prereq_id = "{{$skill->wealth_prereq_id}}"
						        			oncontextmenu = "ShowAll->showSkillDetails(event);"
						        			onclick="CreatePlayerCharSkills.descentSkillOptionListener(event);">
						        			<td id="{{$skill->name}}" class="skillname col-xs-7">
						        				{{$skill->name}}
						        			</td>
						        			<td class="player_classes col-xs-3" data-value="
						        				@php echo json_encode($skill->player_class_ids);@endphp">
						        				@php
						        					echo join(", ", $skill->player_classes);
						        				@endphp
						        			</td>
						        			<td class="col-xs-1 skill_ep_cost">
						        				{{$skill->ep_cost}}
						        			</td>
						        		</tr>
						        	@endforeach
								</tbody>
						    </table>
						</div>
						
						<input type='hidden' id="descent_skill_list_hidden" name="descent_skill_list" value="[]">
					</div>
					<div class='row'>
						<div class="col-xs-2"></div>
						<div class="col-xs-10">
							<div class='row'>
								Rasvaardigheden:
							</div>
							<div class='row italic_text'>
								{{$race_skills_string}}
							</div>
						</div>
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
				
			    <div id='class_selected' class='row well'>
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
							<h4>Aantal bestede EP: <span class='spent_character_ep' data-ep_amount='0'>0</span> van <span class='total_character_ep' data-ep_amount="{{$basic_info['start_ep']}}">{{$basic_info['start_ep']}}</span></h4>
						</div>
					</div>
			    </div>
			    
			    <div id='class_skills_to_select' class='row well'>
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
						                <th data-field="name" class="col-xs-7">
						                    Naam
						                </th>
						                <th data-field="player_class" class="col-xs-3">
						                	Klasse
						                </th>
						                <th data-field="ep" class="col-xs-2">
						                	EP
						                </th>
						            </tr>
						        </thead>
		 
						        <tbody>
						        	@foreach($skills['classSkills'] as $skill)
						        		<tr class="character_class_skill_selection character_class_skill_selection_{{$skill->id}} hidden"
						        			data-id="{{$skill->id}}"
						        			data-ep_cost = "{{$skill->ep_cost}}"
						        			data-mentor_required = "{{$skill->mentor_required}}"
						        			data-skill_prereqs = "{{ $skill->skill_prereqs}}"
						        			data-skill_group_prereqs = "{{$skill->skill_group_prereqs}}"
						        			data-res_rules = "{{$skill->res_rules}}"
						        			data-call_rules = "{{$skill->call_rules}}"
						        			data-stat_rules = "{{$skill->stat_rules}}"
						        			data-class_rules = "{{$skill->class_rules}}"
						        			data-statistic_prereq_id = "{{$skill->statistic_prereq_id}}"
						        			data-statistic_prereq_amount = "{{$skill->statistic_prereq_amount}}"
						        			data-wealth_rules = "{{$skill->wealth_rules}}"
						        			data-wealth_prereq_id = "{{$skill->wealth_prereq_id}}"
						        			oncontextmenu = "ShowAll->showSkillDetails(event);"
						        			onclick="CreatePlayerCharSkills.classSkillSelectionListener(event);">
						        			
						        			<td id="{{$skill->name}}" class="skillname col-xs-7">
						        				{{$skill->name}}
						        			</td>
						        			<td class="player_classes col-xs-3" data-value="
						        				@php echo json_encode($skill->player_class_ids);@endphp">
						        				@php
						        					echo join(", ", $skill->player_classes);
						        				@endphp
						        			</td>
						        			<td class="col-xs-1 skill_ep_cost">
						        				{{$skill->ep_cost}}
						        			</td>
						        		</tr>
						        	@endforeach
								</tbody>
						    </table>
						</div>
						
						<div class="col-xs-2 text-center">
							<button
								type="button"
								class="btn btn-default character_class_skill_select_btn disabled"
								aria-label="Select Vaardigheid"
								onclick="CreatePlayerCharSkills.classSkillSelectButtonListener(event);">
								<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
							</button>
							<br>
							<button
								type="button"
								class="btn btn-default character_class_skill_remove_btn disabled"
								aria-label="Verwijder Vaardigheid"
								onclick="CreatePlayerCharSkills.classSkillRemoveButtonListener(event);">
								<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
							</button>
						</div>
						
						<div class="col-xs-4">
							<table id="character_class_skill_options" class="table table-fixedheader table-responsive table-condensed table-hover sortable">
		        				<thead>
		            				<tr>
						                <th data-field="name" class="col-xs-7">
						                    Naam
						                </th>
						                <th data-field="player_class" class="col-xs-3">
						                	Klasse
						                </th>
						                <th data-field="ep" class="col-xs-2">
						                	EP
						                </th>
						            </tr>
						        </thead>
		 
						        <tbody>
						        	@foreach($skills['classSkills'] as $skill)
						        		<tr class="character_class_skill_option character_class_skill_option_{{$skill->id}}"
						        			data-id="{{$skill->id}}"
						        			data-ep_cost = "{{$skill->ep_cost}}"
						        			data-mentor_required = "{{$skill->mentor_required}}"
						        			data-skill_prereqs = "{{ $skill->skill_prereqs}}"
						        			data-skill_group_prereqs = "{{$skill->skill_group_prereqs}}"
						        			data-res_rules = "{{$skill->res_rules}}"
						        			data-call_rules = "{{$skill->call_rules}}"
						        			data-stat_rules = "{{$skill->stat_rules}}"
						        			data-class_rules = "{{$skill->class_rules}}"
						        			data-statistic_prereq_id = "{{$skill->statistic_prereq_id}}"
						        			data-statistic_prereq_amount = "{{$skill->statistic_prereq_amount}}"
						        			data-wealth_rules = "{{$skill->wealth_rules}}"
						        			data-wealth_prereq_id = "{{$skill->wealth_prereq_id}}"
						        			oncontextmenu = "ShowAll->showSkillDetails(event);"
						        			onclick="CreatePlayerCharSkills.classSkillOptionListener(event);">
						        			
						        			<td id="{{$skill->name}}" class="skillname col-xs-7">
						        				{{$skill->name}}
						        			</td>
						        			<td class="player_classes col-xs-3" data-value="
						        				@php echo json_encode($skill->player_class_ids);@endphp">
						        				@php
						        					echo join(", ", $skill->player_classes);
						        				@endphp
						        			</td>
						        			<td class="col-xs-1 skill_ep_cost">
						        				{{$skill->ep_cost}}
						        			</td>
						        		</tr>
						        	@endforeach
								</tbody>
						    </table>
						</div>
						
						<input type='hidden' id="character_class_skill_list_hidden" name="character_class_skill_list" value="[]">
					</div>
					<div class='row'>
						<div class="col-xs-2"></div>
						<div class="col-xs-10">
							<div class='row'>
								Rasvaardigheden:
							</div>
							<div class='row italic_text'>
								{{$race_skills_string}}
							</div>
						</div>
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
				
			    <div id='non_class_selected' class='row well'>
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
							<h4>Aantal bestede EP: <span class='spent_character_ep' data-ep_amount='0'>0</span> van <span class='total_character_ep' data-ep_amount="{{$basic_info['start_ep']}}">{{$basic_info['start_ep']}}</span></h4>
						</div>
					</div>
			    </div>
			    
			    <div id='non_class_skills_to_select' class='row well'>
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
						                <th data-field="name" class="col-xs-7">
						                    Naam
						                </th>
						                <th data-field="player_class" class="col-xs-3">
						                	Klasse
						                </th>
						                <th data-field="ep" class="col-xs-2">
						                	EP
						                </th>
						            </tr>
						        </thead>
		 
						        <tbody>
						        	@foreach($skills['nonClassSkills'] as $skill)
						        		<tr class="character_non_class_skill_selection character_non_class_skill_selection_{{$skill->id}} hidden"
						        			data-id="{{$skill->id}}"
						        			data-ep_cost = "{{$skill->ep_cost}}"
						        			data-mentor_required = "{{$skill->mentor_required}}"
						        			data-skill_prereqs = "{{ $skill->skill_prereqs}}"
						        			data-skill_group_prereqs = "{{$skill->skill_group_prereqs}}"
						        			data-res_rules = "{{$skill->res_rules}}"
						        			data-call_rules = "{{$skill->call_rules}}"
						        			data-stat_rules = "{{$skill->stat_rules}}"
						        			data-class_rules = "{{$skill->class_rules}}"
						        			data-statistic_prereq_id = "{{$skill->statistic_prereq_id}}"
						        			data-statistic_prereq_amount = "{{$skill->statistic_prereq_amount}}"
						        			data-wealth_rules = "{{$skill->wealth_rules}}"
						        			data-wealth_prereq_id = "{{$skill->wealth_prereq_id}}"
						        			oncontextmenu = "ShowAll->showSkillDetails(event);"
						        			onclick="CreatePlayerCharSkills.nonClassSkillSelectionListener(event);">
						        			
						        			<td id="{{$skill->name}}" class="skillname col-xs-7">
						        				{{$skill->name}}
						        			</td>
						        			<td class="player_classes col-xs-3" data-value="
						        				@php echo json_encode($skill->player_class_ids);@endphp">
						        				@php
						        					echo join(", ", $skill->player_classes);
						        				@endphp
						        			</td>
						        			<td class="col-xs-1 skill_ep_cost">
						        				{{$skill->ep_cost}}
						        			</td>
						        		</tr>
						        	@endforeach
								</tbody>
						    </table>
						</div>
						
						<div class="col-xs-2 text-center">
							<button
								type="button"
								class="btn btn-default character_non_class_skill_select_btn disabled"
								aria-label="Select Vaardigheid"
								onclick="CreatePlayerCharSkills.nonClassSkillSelectButtonListener(event);">
								<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
							</button>
							<br>
							<button
								type="button"
								class="btn btn-default character_non_class_skill_remove_btn disabled"
								aria-label="Verwijder Vaardigheid"
								onclick="CreatePlayerCharSkills.nonClassSkillRemoveButtonListener(event);">
								<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
							</button>
						</div>
						
						<div class="col-xs-4">
							<table id="character_non_class_skill_options" class="table table-fixedheader table-responsive table-condensed table-hover sortable">
		        				<thead>
		            				<tr>
						                <th data-field="name" class="col-xs-7">
						                    Naam
						                </th>
						                <th data-field="player_class" class="col-xs-3">
						                	Klasse
						                </th>
						                <th data-field="ep" class="col-xs-2">
						                	EP
						                </th>
						            </tr>
						        </thead>
		 
						        <tbody>
						        	@foreach($skills['nonClassSkills'] as $skill)
						        		<tr class="character_non_class_skill_option character_non_class_skill_option_{{$skill->id}}"
						        			data-id="{{$skill->id}}"
						        			data-mentor_required = "{{$skill->mentor_required}}"
						        			data-ep_cost = "{{$skill->ep_cost}}"
						        			data-skill_prereqs = "{{ $skill->skill_prereqs}}"
						        			data-skill_group_prereqs = "{{$skill->skill_group_prereqs}}"
						        			data-res_rules = "{{$skill->res_rules}}"
						        			data-call_rules = "{{$skill->call_rules}}"
						        			data-stat_rules = "{{$skill->stat_rules}}"
						        			data-class_rules = "{{$skill->class_rules}}"
						        			data-statistic_prereq_id = "{{$skill->statistic_prereq_id}}"
						        			data-statistic_prereq_amount = "{{$skill->statistic_prereq_amount}}"
						        			data-wealth_rules = "{{$skill->wealth_rules}}"
						        			data-wealth_prereq_id = "{{$skill->wealth_prereq_id}}"
						        			oncontextmenu = "ShowAll->showSkillDetails(event);"
						        			onclick="CreatePlayerCharSkills.nonClassSkillOptionListener(event);">

						        			<td id="{{$skill->name}}" class="skillname col-xs-7">
						        				{{$skill->name}}
						        			</td>
						        			<td class="player_classes col-xs-3" data-value="
						        				@php echo json_encode($skill->player_class_ids);@endphp">
						        				@php
						        					echo join(", ", $skill->player_classes);
						        				@endphp
						        			</td>
						        			<td class="col-xs-1 skill_ep_cost">
						        				{{$skill->ep_cost}}
						        			</td>
						        		</tr>
						        	@endforeach
								</tbody>
						    </table>
						</div>
						
						<input type='hidden' id="character_non_class_skill_list_hidden" name="character_non_class_skill_list" value="[]">
					</div>
					<div class='row'>
						<div class="col-xs-2"></div>
						<div class="col-xs-10">
							<div class='row'>
								Rasvaardigheden:
							</div>
							<div class='row italic_text'>
								{{$race_skills_string}}
							</div>
						</div>
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

			<div id="title_faith" class="tab-pane fade in">
				<div class='row well'>
					<div class='col-xs-1'></div>
					<div class='col-xs-1'>Geloof:</div>
					<div class='col-xs-3'>
						<select id="faith_selection" name='character_faith'>
							@foreach($faiths as $faith)
								<option value="{{$faith->id}}">{{$faith->faith_name}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="row well">
					<div class='col-xs-1'></div>
					<div class='col-xs-1'>Titel:</div>
					<div class='col-xs-7'>
						<input id='character_title' name="character_title" style="width: 100%;">
					</div>
				</div>
					
				@include('layouts.tab_buttons',	array('tab'=>'tab5', 'previous'=>'tab4', 'save'=>false,
				'next'=>'tab6'))
			</div>

			<div id="overview" class="tab-pane fade in">
				<div class='row well'>
					<div class='row'>
						<div class='col-xs-1'></div>
						<div class='col-xs-1'>Naam:</div>
						<div class='col-xs-5'>
							<span>{{$basic_info['char_name']}}</span>
							<span id="overview_title"></span>
						</div>
						<div class='col-xs-1'>
							Geloof:
						</div>
						<div class='col-xs-1'>
							<span id="overview_faith">Geen</span>
						</div>
					</div>
					<div class='row'>
						<div class="col-xs-1"></div>
						<div class="col-xs-1">
							Start EP: 
						</div>
						<div class="col-xs-2">
							<span id="overview_start_ep">{{$basic_info['start_ep']}}</span>
						</div>
						<div class='col-xs-1'>
							#Omens: 
						</div>
						<div class='col-xs-2'>
							<span id="overview_survived">{{$basic_info['nr_events']}}</span>
						</div> 
						<div class='col-xs-1'>
							Niveau : 
						</div>
						<div class='col-xs-1'>	
							<span id="overview_char_level">{{$char_level->skill_level}}</span>
						</div>
					</div>
					<div class='row'>
						<div class="col-xs-1">
						</div>
						<div class="col-xs-1">
							Spelerras: 
						</div>
						<div class="col-xs-2">
							<span id="overview_race">{{$char_race->race_name}}</span>
						</div>
						<div class="col-xs-1">
							Klasse: 
						</div>
						<div class="col-xs-2">
							<span id="overview_class">{{$char_class->class_name}}</span>
						</div>
						<div class="col-xs-1">
							Welvaart:
						</div>
						<div class="col-xs-2">
							<span id="overview_wealth" data-base="{{$char_wealth['id']}}" data-descent='1' data-class='1' data-nonclass='1' data-value="{{$char_wealth['id']}}">{{$char_wealth['wealth_type']}}</span>
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
										<td id="overview_stat_1" class="overview_stat" data-base='{{$char_race->lp_torso}}' data-descent='0' data-class='0' data-nonclass='0' data-value='{{$char_race->lp_torso}}'>{{$char_race->lp_torso}}</td>
										<td id="overview_stat_11" class="overview_stat" data-value='{{$char_race->lp_limbs}}'>{{$char_race->lp_limbs}}</td>
										<td id="overview_stat_2" class="overview_stat" data-base='{{$char_race->willpower}}' data-descent='0' data-class='0' data-nonclass='0' data-value='{{$char_race->willpower}}'>{{$char_race->willpower}}</td>
										<td id="overview_stat_3" class="overview_stat" data-base='{{$char_race->status}}' data-descent='0' data-class='0' data-nonclass='0' data-value='{{$char_race->status}}'>{{$char_race->status}}</td>
										<td id="overview_stat_4" class="overview_stat" data-base='{{$char_race->focus}}' data-descent='0' data-class='0' data-nonclass='0' data-value='{{$char_race->focus}}'>{{$char_race->focus}}</td>
										<td id="overview_stat_5" class="overview_stat" data-base='{{$char_race->trauma}}' data-descent='0' data-class='0' data-nonclass='0' data-value='{{$char_race->trauma}}'>{{$char_race->trauma}}</td>
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
							Rasvaardigheden:
						</div>
					</div>
					<div class='row'>
						<div class="col-xs-2"></div>
						<div class="col-xs-10">
							{{$race_skills_string}}
						</div>
					</div>
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
					
				@include('layouts.tab_buttons',	array('tab'=>'tab6', 'previous'=>'tab5', 'save'=>true,
				'next'=>null))
			</div>
	
		</div>
	</form>
</div>	
@include('popups.showErrorMessage')
@include('popups.showPromptMessage')

	<script>
		CreatePlayerCharTabControl.addTabButtonListeners();
		CreatePlayerCharSkills.initialize();
	</script>

@stop
</html>