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
			 
			        <tbody>
			            @foreach ($skills as $skill)
			                <tr>
			                    <td class="col-xs-2">{{ $skill->name }}</td>
			                    <td class="col-xs-3">{{ $skill->descriptionSmall }}</td>
			                    <td class="col-xs-2">{{ $skill->ep_cost }}</td>
			                    <td class="col-xs-2">{{ $skilllevels[$skill->level]->skill_level }}</td>
			                </tr>
			            @endforeach
			        </tbody>
			    </table>
		    </div>
		    
		    <div class="col-xs-2 well">
		    	<h4>Toon:</h4>
		    	<hr>
		    	<form>
		    		@foreach($skilllevels as $skilllevel)
						<input type="checkbox" class="level_filter" value={{$skilllevel->id}} checked onClick="ShowAll.getFilteredSkills()"> {{$skilllevel->skill_level}}<br>
  					@endforeach
  					<br>
		    		@foreach($playerclasses as $playerclass)
						<input type="checkbox" class="class_filter" value={{$playerclass->id}} checked  onClick="ShowAll.getFilteredSkills()"> {{$playerclass->class_name}}<br>
  					@endforeach
  					
				</form>
		    </div>
	    </div>
	</div>
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