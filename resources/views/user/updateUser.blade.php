@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<span class="overview_header">Gebruikersrechten Aanpassen</span>
			</div>
		</div>

		<div class="row">
		</div>
		
		<div class="row well success-text">
			<div class="col-xs-12">
				De rechten van gebruiker {{$user->name}} zijn succesvol aangepast.
			</div>		
		</div>
			
		<div class="row button-row">
			<div class="col-xs-2"></div>
			<div class="col-xs-8">
				<a href="showall_user" class="btn btn-default" id="cancel_button" type="button" font-size: 18px;">
				naar Gebruikers Overzicht
				</a>
			</div>
			<div class="col-xs-2"></div>
		</div>
 	</div>
@endsection
