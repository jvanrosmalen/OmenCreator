<!DOCTYPE html>
<html>
	@extends('layouts.app')
	
<body>
	@section('content')

	<!-- 	Hidden information fields -->
	@foreach($wealth_types as $wealth_type)
		<div class="wealth_type hidden" data-id="{{$wealth_type->id}}" data-wealth_type="{{$wealth_type->wealth_type}}"></div>
	@endforeach
	@foreach($skilllevels as $skilllevel)
		<div class="skill_level hidden" id="skill_level_{{$skilllevel->id}}" data-skill_level="{{$skilllevel->skill_level}}"></div>
	@endforeach

	
	<div class='container'>
		<div class="row">
			<div class="col-xs-7">
				<h1>Overzicht Vaardigheden</h1>
			</div>
					
			<div class="col-xs-5">
<!--    				<div id="skillSelectorSearch"> -->
   				<div>
   					<div class="input-group col-md-12">
                    	<input id="skillSearchInput"  type="text" class="search-query form-control" placeholder="Zoek op naam of onderdeel van naam" onchange="Create.skillSearch();"/>
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
			    <table id="skill_table" class="table table-fixedheader table-responsive table-condensed table-hover sortable">
			        <thead>
			            <tr>
			                <th class="col-xs-3">
			                    Naam
			                </th>
			                <th class="col-xs-4">
			                	Korte Beschrijving
			                </th>
			                <th class="col-xs-2">
			                	Klasse
			                </th>
			                <th class="col-xs-1">
			                	Niveau
			                </th>
			                <th class="col-xs-1">
			                	EP
			                </th>
			                <th class="col-xs-1">
			                	Actie
			                </th>
			            </tr>
			        </thead>
			 
			        <tbody id="skills">
				            @foreach ($skills as $skill)
				                <tr id="{{ $skill->id }}" onclick="ShowAll.showSkillDetails(event);">
				                    <td id="{{$skill->name}}" class="skillname col-xs-3">{{ $skill->name }}</td>
				                    <td class="col-xs-4">{{ $skill->description_small }}</td>
				               		<td class="col-xs-2">
				               		@foreach ($skill->player_classes as $player_class)
				               			{{ $player_class }}
				               		@endforeach
				               		</td>
				               		<td class="col-xs-1">{{ $skill->skill_level }}</td>
				                    <td class="col-xs-1 skill_ep_cost">{{ $skill->ep_cost }}</td>
				                    <td class="col-xs-1">
				                    	<a href="/create_skill/{{$skill->id}}" class="btn btn-info btn-xs edit-skill-btn">
          									<span class="glyphicon glyphicon-pencil"></span> 
        								</a>
				                    	<a href="/show_delete_skill/{{$skill->id}}" class="btn btn-danger btn-xs remove-skill-btn">
          									<span class="glyphicon glyphicon-minus"></span> 
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
