<!DOCTYPE html>
<html>
@extends('layouts.app')

@section('content')

<div class='container'>
	<div class='row'>
		<div class='col-xs-12'>
			<h3>{{$character->name}} (Speler: {{$character->char_user->name}})</h3>
		</div>
	</div>

	<div class='row well'>
		<div class='row'>
		</div>

		<div class='row'>
			<div class="col-xs-1">
			</div>
			<div class="col-xs-1">
				EP: 
			</div>
			<div class="col-xs-2">
				<span>{{$character->getSpentEpAmount()}}/{{$character->ep_amount}}</span>
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
				Welvaart:
			</div>
			<div class="col-xs-2">
				<span>{{$character->wealth_string}}</span>
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
	</div>

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
	
	<div class='row'>
		<div class="col-xs-5">
		</div>
		<div class="col-xs-2">
			<a href="{{ url('/showall_character') }}" class="btn btn-default" style="width:100%">Terug naar Overzicht</a>
		</div>
		<div class="col-xs-5">
		</div>		
	</div>
</div>

@stop
</html>