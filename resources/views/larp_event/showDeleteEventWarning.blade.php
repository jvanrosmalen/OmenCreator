@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<span class="overview_header">Verwijder Evenement</span>
			</div>
		</div>

		<br>
		<div class="row">
		</div>
		
		<div class="row well warning-text">
			<div class="col-xs-12">
				Ben je er zeker van dat je het event <b><em>{{$eventName}}</em></b> wilt verwijderen
				uit de database?<br>
                Dit valt niet terug te draaien. Alle informatie over het event wordt verwijderd!
                (Eventuele EP toewijzingen aan spelers voor dit event blijven behouden.)
			</div>		
		</div>
			
		<div class="row button-row">
			<div class="col-xs-3"></div>
			<div class="col-xs-2">
				<a href="larpeventdelete/{{ $eventId }}" class="btn btn-default" id="cancel_button" type="button"	style="width: 120px; font-size: 18px;">
				Verwijderen
				</a>
			</div>
			<div class="col-xs-2"></div>
			<div class="col-xs-2">
				<a href="larpeventsshowall" class="btn btn-default" id="cancel_button" type="button"	style="width: 120px; font-size: 18px;">
				Cancel
				</a>
			</div>
		</div>
 	</div>
@endsection