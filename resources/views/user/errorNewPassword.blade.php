@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<span class="overview_header">Profiel Aanpassen Mislukt</span>
			</div>
		</div>

		<div class="row">
		</div>
		
		<div class="row well warning-text">
			<div class="col-xs-12">
				Je hebt geprobeerd je profiel aan te passen. Het nieuwe wachtwoord dat je hebt willen instellen voldoet echter niet aan de eisen.<br>
				Geen van je aanpassingen zijn doorgevoerd.
			</div>		
		</div>
			
		<div class="row button-row">
			<div class="col-xs-2"></div>
			<div class="col-xs-8">
				<a href="{{ url('/my_profile') }}" class="btn btn-default" id="cancel_button" type="button" font-size: 18px;">
				terug naar Mijn Profiel
				</a>
			</div>
			<div class="col-xs-2"></div>
		</div>
 	</div>
@endsection
