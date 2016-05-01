<!DOCTYPE html>
<html>
	@extends('layouts.app')
	
<head>
	<script type="text/javascript" src="js/skill/showall.js"></script>
</head>

<body>
	@section('content')
	
	<div class='container'>
		<h1>Overzicht Vaardigheden</h1>

		<div class="row">
			<div class="col-xs-10">
			    <table class="table table-condensed table-hover">
			        <thead>
			            <tr>
			                <th>
			                    Naam
			                </th>
			                <th>
			                	Korte Beschrijving
			                </th>
			                <th>
			                	EP Kosten
			                </th>
			                <th>
			                	Niveau
			                </th>
			            </tr>
			        </thead>
			 
			        <tbody id="skills">
				            @foreach ($skills as $skill)
				                <tr id="{{ $skill->id }}" onclick="ShowAll.showSkillDetails(event);">
				                    <td id="{{$skill->name}}" class="skillname col-xs-3">{{ $skill->name }}</td>
				                    <td class="col-xs-4">{{ $skill->descriptionSmall }}</td>
				                    <td class="col-xs-2">{{ $skill->ep_cost }}</td>
				           			@foreach ( $skilllevels as $skilllevel)
				           				@if($skilllevel->id == $skill->level)
				                    		<td class="col-xs-3">{{ $skilllevel->skill_level }}</td>
				                    	@endif
				                    @endforeach
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

<!-- 	<body>
	@section('content')
		<div class='container'>
			<div class='row'>
				<div class='col-xs-12'>
					<h1>Alle Vaardigheden</h1>
				</div>
			</div>
			
		</div>
	@endsection
	</body>  -->
</html>