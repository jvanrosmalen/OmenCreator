@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<span class="overview_header">Gebruiker Verwijderen Mislukt</span>
			</div>
		</div>

		<div class="row">
		</div>
		
		<div class="row well warning-text">
			<div class="col-xs-12">
				Je hebt geprobeerd {{$user->name}} te verwijderen. Dit is je eigen account.<br>
				Om te voorkomen dat het systeem zonder admin zou kunnen komen te zitten, is het
				 niet mogelijk om jezelf te verwijderen.<br>
			</div>		
		</div>
			
		<div class="row button-row">
			<div class="col-xs-2"></div>
			<div class="col-xs-8">
				<a href="/showall_user" class="btn btn-default" id="cancel_button" type="button" font-size: 18px;">
				naar Gebruikers Overzicht
				</a>
			</div>
			<div class="col-xs-2"></div>
		</div>
 	</div>
@endsection
