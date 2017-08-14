@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<span class="overview_header">Verwijder Vaardigheid</span>
			</div>
		</div>

		<br>
		<div class="row">
		</div>
		
		@if(count($prereqOf) > 0)
		<div class="row">
			<div class='col-xs-10 col-xs-offset-1'>
				Deze vaardigheid is een prereq voor de volgende vaardigheden:<br>
				<ul>
				@foreach($prereqOf as $prereq)
					<li>{{$prereq->name}}</li>
				@endforeach
				</ul>
			</div>
		</div>
		@endif
		
		@if(count($ownedBy) > 0)
		<div class="row">
			<div class='col-xs-10 col-xs-offset-1'>
				De volgende spelers hebben deze vaardigheid geleerd:<br>
				<ul>
				@foreach($ownedBy as $character)
					<li>{{$character->name}} (Speler: {{$character->char_user->name}})</li>
				@endforeach
				</ul>
			</div>
		</div>
		@endif

		<div class="row well warning-text">
			<div class="col-xs-12">
				Ben je er zeker van dat je de vaardigheid <b><em>{{$skill->name}}</em></b> wilt verwijderen
				uit de database?
			</div>		
		</div>
			
		<div class="row button-row">
			<div class="col-xs-3"></div>
			<div class="col-xs-2">
				<a href="/delete_skill/{{ $skill->id }}" class="btn btn-default" id="cancel_button" type="button"	style="width: 120px; font-size: 18px;">
				Verwijderen
				</a>
			</div>
			<div class="col-xs-2"></div>
			<div class="col-xs-2">
				<a href="/skillshowall" class="btn btn-default" id="cancel_button" type="button"	style="width: 120px; font-size: 18px;">
				Cancel
				</a>
			</div>
		</div>
 	</div>
@endsection