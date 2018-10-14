<!DOCTYPE html>
<html>
@extends('layouts.app')

@section('content')

<div class='container'>
	<div class='row'>
		<div class='col-xs-7'>
			<h3>{{$character->name}}, {{$character->title}}<br>(Speler: {{$character->char_user->name}})</h3>
		</div>
		<div class='col-xs-5'>
			<div class='col-xs-7 pull-right'>
				<a class="btn btn-default btn-block" href="{{ url('generate_skill_overview/'.$character->id) }}">Download Vaardigheden</a>
			</div>
			<div class='col-xs-5 pull-right'>
				<a class="btn btn-default btn-block" href="{{ url('generate_combatsheet/'.$character->id) }}">Download Sheet</a>
			</div>
		</div>
	</div>

	<ul class="nav nav-tabs">
		<li class="active"><a id="tab1" data-toggle="tab" href="#base_info">Basis Info</a></li>
		<li><a id="tab2" data-toggle="tab" href="#skills">Vaardigheden</a></li>
		<li><a id="tab3" data-toggle="tab" href="#ep_overview">EP Overzicht</a></li>
		<li><a id="tab4" data-toggle="tab" href="#documents">Documenten</a></li>
		@if( Auth::user()->is_story_telling || Auth::user()->is_admin)
		<li><a id="tab5" data-toggle="tab" href="#extra_info">Extra Info</a></li>
		@endif
	</ul>

	<div class="tab-content">
		<div id="base_info" class="tab-pane fade in active">
			<br>
			<div class='row'>
				<div class='row'>
				</div>

				<div class='row'>
					<div class="col-xs-1">
					</div>
					<div class="col-xs-1">
						EP: 
					</div>
					<div class="col-xs-2">
						<span>{{$character->getSpentEpAmount()}}/{{$character->ep_amount+$character->descent_ep_amount}}</span>
					</div>
					<div class='col-xs-1'>
						#Omens: 
					</div>
					<div class='col-xs-2'>
						<span>{{$character->nr_events_survived}}</span>
					</div> 
					<div class='col-xs-1'>
						Niveau : 
					</div>
					<div class='col-xs-1'>	
						<span>{{$character->char_level}}</span>
					</div>
				</div>
				
				<div class='row'>
					<div class="col-xs-1">
					</div>
					<div class="col-xs-1">
						Spelerras: 
					</div>
					<div class="col-xs-2">
						<span>{{$character->char_race->race_name}}</span>
					</div>
					<div class="col-xs-1">
						Klasse: 
					</div>
					<div class="col-xs-2">
						<span>{{$character->getPlayerClassesListString()}}</span>
					</div>
					<div class="col-xs-1">
						Geloof:
					</div>
					<div class="col-xs-1">
						<span>{{ $character->char_faith->faith_name }}</span>
					</div>
				</div>
				<div class ='row'>
					<div class='col-xs-1'>
					</div>
					<div class="col-xs-1">
						Welvaart:
					</div>
					<div class="col-xs-2">
						<span>{{$character->wealth_string}}</span>
					</div>
					<div class='col-xs-1'>
						Inkomsten:
					</div>
					<div class='col-xs-2'>
						{{$character->moneyAmountToString($character->getIncome())}}
					</div>
					<div class='col-xs-1'>
						Startkapitaal:
					</div>
					<div class='col-xs-2'>
						{{$character->moneyAmountToString($character->getStartCapital())}}
					</div>
				</div>
								
				<div class="row overview_header_row">
					<div class="col-xs-1">
					</div>
					<div class="col-xs-5">
						Statistieken
					</div>
					<div class="col-xs-4">
						Resistenties
					</div>
				</div>			
				<div class="row">
					<div class="col-xs-1">
					</div>
					<div class="col-xs-4">
						<table class="table borderless detail_table">
							<thead>
					            <tr>
					                <th class="overview_table_header">
					                    Levenspunten
					                </th>
					                <th class="overview_table_header">
					                	Wilskracht
					                </th>
					                <th class="overview_table_header">
					                	Status
					                </th>
					                <th class="overview_table_header">
					                	Focus
					                </th>
					                <th class="overview_table_header">
					                	Trauma
					                </th>
					            </tr>
							</thead>
							<tbody>
								<tr>
									<td class="text-center">{{$character->lp_torso}}/{{$character->lp_limbs}}</td>
									<td class="text-center">{{$character->willpower}}</td>
									<td class="text-center">{{$character->status}}</td>
									<td class="text-center">{{$character->focus}}</td>
									<td class="text-center">{{$character->trauma}}<td>
								</tr>
							</tbody>		
						</table>
					</div>
					<div class='col-xs-1'>
					</div>
					<div class="col-xs-2">
						<table class="table borderless detail_table">
							<thead>
					            <tr>
					                <th class="overview_table_header">
					                    Angst
					                </th>
					                <th class="overview_table_header">
					                	Diefstal
					                </th>
					                <th class="overview_table_header">
					                	Trauma
					                </th>
					            </tr>
							</thead>
							<tbody>
								<tr>
									<td class="text-center">{{$character->res_fear}}</td>
									<td class="text-center">{{$character->res_theft}}</td>
									<td class="text-center">{{$character->res_trauma}}</td>
								</tr>
							</tbody>		
						</table>
					</div>							
					<div class="col-xs-2">
						<table class="table borderless detail_table">
							<thead>
					            <tr>
					                <th class="overview_table_header">
					                    Gif
					                </th>
									<th class="overview_table_header">
										Magie
								    </th>
					                <th class="overview_table_header">
					                	Ziekte
					                </th>
					            </tr>
							</thead>
							<tbody>
								<tr>
									<td class="text-center">{{$character->res_poison}}</td>
									<td class="text-center">{{$character->res_magic}}</td>
									<td class="text-center">{{$character->res_disease}}</td>
								</tr>
							</tbody>		
						</table>
					</div>							
				</div>
				
				<div class="row overview_header_row">
					@php
						$sparkData = json_decode($character->spark_data);
					@endphp
					<div class="col-xs-1">
					</div>
					<div class="col-xs-5">
						Levensvonk - {{$sparkData->title}}
					</div>		
				</div>
				<div class="row">
					<div class="col-xs-1">
					</div>
					<div class="col-xs-8">
						@foreach($sparkData->text as $sparkLine)
							{{$sparkLine}}<br>
						@endforeach
					</div>
				</div>
			</div>
		</div>
		
		<div id="skills" class="tab-pane fade">
			<br>
			<div class="row">
				<div class="col-xs-1">
				</div>
				<div class="col-xs-10">
					<table id="char_skill_table" class="table table-fixedheader table-responsive table-condensed table-hover sortable">
						<thead>
							<tr>
								<th class="col-xs-3">
									Naam
								</th>
								<th class="col-xs-5">
									Korte Beschrijving
								</th>
								<th class="col-xs-2">
									EP kosten
								</th>
								<th class="col-xs-2">
									Niveau
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($overview_skills_string_array as $skill)
							<tr id="{{ $skill['id'] }}" onclick="ShowAll.showSkillDetails(event);">
								<td id="{{$skill['id']}}" class="col-xs-3">
									{{$skill['name']}}
								</td>
								<td class="col-xs-5">
									{{$skill['description_small']}}
								</td>
								<td class="col-xs-2">
									{{$skill['ep_cost']}}
								</td>
								<td class="col-xs-2">
									{{$skill['skill_level']}}
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div id="ep_overview" class="tab-pane fade">
			<br>
			<div class='row'>
				<div class="col-xs-8 col-xs-offset-2"><h4>EP Overzicht - ({{$character->getSpentEpAmount()}}/{{$character->getTotalEpAmount()}})</h4></div>
			</div>
			<div class='row'>
					<div class="col-xs-6 col-xs-offset-2">
						<table id="char_ep_table" class="table table-fixedheader table-responsive table-condensed table-hover sortable">
							<thead>
								<tr>
									<th class="col-xs-3">
										Datum
									</th>
									<th class="col-xs-3">
										Aantal EP
									</th>
									<th class="col-xs-6">
										Beschrijving
									</th>
								</tr>
							</thead>
							<tbody>
								<?php $first = true;?>
								@foreach($character->ep_assignments as $assignment)
									@if($first)
										<tr id="{{ $assignment->id }}">
											<td id="{{$assignment->id}}" class="col-xs-3">
												<?php
												$first = false;
												$createDate = new DateTime($assignment->created_at);
												$stripped = $createDate->format('Y-m-d');
												?>
												{{$stripped}}
											</td>
											<td class="col-xs-3">
												{{$assignment->amount}}
											</td>
											<td class="col-xs-6">
												{{$assignment->reason}}
											</td>
										</tr>
										<tr id="{{ $assignment->id }}">
											<td id="{{$assignment->id}}" class="col-xs-3">
												{{$stripped}}
											</td>
											<td class="col-xs-3">
												{{$character->descent_ep_amount}}
											</td>
											<td class="col-xs-6">
												Afkomst EP
											</td>
										</tr>
									@else
										<tr id="{{ $assignment->id }}">
											<td id="{{$assignment->id}}" class="col-xs-3">
												<?php
												$createDate = new DateTime($assignment->created_at);
												
												$stripped = $createDate->format('Y-m-d');
												?>
												{{$stripped}}
											</td>
											<td class="col-xs-3">
												{{$assignment->amount}}
											</td>
											<td class="col-xs-6">
												{{$assignment->reason}}
											</td>
										</tr>
									@endif
								@endforeach
							</tbody>
						</table>
					</div>
			</div>
		</div>

		<div id="documents" class="tab-pane fade">
			<br>
			<div class='row'>
				<div class="col-xs-8 col-xs-offset-2"><h4>Hand Outs</h4></div>
			</div>
			<div class='row'>
					<div class="col-xs-6 col-xs-offset-2">
						<table id="handout_table" class="table table-fixedheader table-responsive table-condensed table-hover sortable">
							<thead>
								<tr>
									<th class="col-xs-9">
										Titel
									</th>
									<th class="col-xs-3">
										Actie
									</th>
								</tr>
							</thead>
							<tbody>
								@foreach($skill_handouts as $skill_handout)
								<tr>
									<td class="col-xs-9">
										{{ $skill_handout["handout_name"] }}
									</td>
									<td class="col-xs-3">
										<a class='btn btn-success btn-sm' href="download/{{$character->id}}/{{ $skill_handout['skill_id'] }}/{{ $skill_handout['handout_name'] }}">download</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
			</div>
		</div>
		
		@if( Auth::user()->is_story_telling || Auth::user()->is_admin)
		<div id="extra_info" class="tab-pane fade">
			<br>
			<div class="row">
				<div class="col-xs-1">
				</div>
				<div class="col-xs-10">
					<div class="extra_info_text">{!! Blade::compileString($character->extra_info); !!}</div>
				</div>
			</div>
		</div>
		@endif
	</div>

	<br>
	@if( Auth::user()->is_story_telling || Auth::user()->is_admin)
		<div class='row'>
			<div class="col-xs-5">
			</div>
			<div class="col-xs-2">
				<a href="{{ url('/showall_character') }}" class="btn btn-default" style="width:100%">Terug naar Overzicht</a>
			</div>
			<div class="col-xs-5">
			</div>		
		</div>
	@endif
</div>

@include('popups.showSkillDetails');

@stop
</html>
