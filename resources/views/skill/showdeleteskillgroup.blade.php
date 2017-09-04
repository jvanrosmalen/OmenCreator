@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<span class="overview_header">Verwijder Vaardigheidgroep</span>
			</div>
		</div>
		<br>
		<div class="row">
			@if(count($prereqForSkills) > 0)
				<div class='col-xs-10 col-xs-offset-1'>
					Deze vaardigheidgroep is een prereq voor de volgende vaardigheden:
					<ul>
					@foreach($prereqForSkills as $skill)
						<li>{{$skill->name}}</li>
					@endforeach
					</ul>
				</div>
			@endif
		</div>
		
		<div class="row well warning-text">
			<div class="col-xs-12">
				Ben je er zeker van dat je de vaardigheidgroep <b><em>{{$skillgroup->name}}</em></b> wilt verwijderen
				uit de database?
			</div>		
		</div>
			
		<div class="row button-row">
			<div class="col-xs-3"></div>
			<div class="col-xs-2">
				<a href="delete_skillgroup/{{ $skillgroup->id }}" class="btn btn-default" id="cancel_button" type="button"	style="width: 120px; font-size: 18px;">
				Verwijderen
				</a>
			</div>
			<div class="col-xs-2"></div>
			<div class="col-xs-2">
				<a href="skillgroupshowall" class="btn btn-default" id="cancel_button" type="button"	style="width: 120px; font-size: 18px;">
				Cancel
				</a>
			</div>
		</div>
 	</div>
@endsection