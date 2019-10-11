@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<span class="overview_header">Evenement Verwijderd</span>
			</div>
		</div>

		<br>
		<div class="row">
		</div>
		
		<div class="row well">
			<div class="col-xs-12">
				Het event <b><em>{{$eventName}}</em></b> is succesvol verwijderd uit de database.<br>
			</div>		
		</div>
			
		<div class="row button-row">
			<div class="col-xs-4"></div>
			<div class="col-xs-4">
				<a href="larpeventsshowall" class="btn btn-default" id="cancel_button" type="button"	style="width: 120px; font-size: 18px;">
				Event Overzicht
				</a>
			</div>
			<div class="col-xs-4"></div>
		</div>
 	</div>
@endsection