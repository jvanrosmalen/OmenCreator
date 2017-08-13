@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<span class="overview_header">Profiel Aanpassen Geslaagd</span>
			</div>
		</div>

		<div class="row">
		</div>
		
		<div class="row well">
			<div class="col-xs-12">
				Je aanpassingen zijn succesvol doorgevoerd.
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
