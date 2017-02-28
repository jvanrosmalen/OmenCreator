<!DOCTYPE html>
<html>
	@extends('layouts.app')
	
<head>
	<script type="text/javascript" src="js/skill/showall.js"></script>
</head>

<body>
	@section('content')
	
	<div class='container'>
		<div class="row">
			<div class="col-xs-7">
				<h1>Overzicht Vaardigheden</h1>
			</div>
					
			<div class="col-xs-5">
<!--    				<div id="skillSelectorSearch"> -->
   				<div>
   					<div class="input-group col-md-12">
                    	<input id="skillSearchInput"  type="text" class="search-query form-control" placeholder="Zoeken (Geselecteerde items blijven getoond)" onchange="Create.skillSearch();"/>
                        <span class="input-group-btn">
                           	<button class="btn btn-danger" type="button">
                               	<span class=" glyphicon glyphicon-search"></span>
                            </button>
                        </span>
            	    </div>
                </div>					
			</div>
		</div>

		<div class="row">
			<div class="col-xs-10">
			    <table id="skill_table" class="table table-condensed table-hover sortable">
			        <thead>
			            <tr>
			                <th>
			                    Naam
			                </th>
			                <th>
			                	Korte Beschrijving
			                </th>
			                <th>
			                	Klasse
			                </th>
			                <th>
			                	Niveau
			                </th>
			                <th class="skill_ep_cost">
			                	EP
			                </th>
			                <th>
			                </th>
			            </tr>
			        </thead>
			 
			        <tbody id="skills">
				            @foreach ($skills as $skill)
				                <tr id="{{ $skill->id }}" onclick="ShowAll.showSkillDetails(event);">
				                    <td id="{{$skill->name}}" class="skillname col-xs-3">{{ $skill->name }}</td>
				                    <td class="col-xs-5">{{ $skill->description_small }}</td>
				               		<td class="col-xs-2">
				               		@foreach ($skill->player_classes as $player_class)
				               			{{ $player_class }}
				               		@endforeach
				               		</td>
				               		<td class="col-xs-1">{{ $skill->skill_level }}</td>
				                    <td class="col-xs-1 skill_ep_cost">{{ $skill->ep_cost }}</td>
				                    <td>
				                    	<a href="/create_skill/{{$skill->id}}" class="btn btn-info btn-sm edit-skill-btn">
          									<span class="glyphicon glyphicon-pencil"></span> 
        								</a>
        							</td>
				                </tr>
				            @endforeach
			        </tbody>
			    </table>
		    </div>
		    
			<div class="col-xs-2 well">
		    	<form id="filterSkillsForm" content="{{ csrf_token() }}">
		    		@foreach($skilllevels as $skilllevel)
						<input type="checkbox" class="level_filter" value={{$skilllevel->id}} checked> {{$skilllevel->skill_level}}<br>
  					@endforeach
  					<br>
		    		@foreach($playerclasses as $playerclass)
						<input type="checkbox" class="class_filter" value={{$playerclass->id}} checked> {{$playerclass->class_name}}<br>
  					@endforeach
				</form>
				<br>
				<button id="filterSkillsBtn" type="button" class="btn btn-success btn-large btn-block" onclick="Create.filterSkills(event);">Filter</button>
				
	    	</div>
	    </div>
	</div>
	
	@include('popups.showSkillDetails');

	@endsection
</body>

</html>
