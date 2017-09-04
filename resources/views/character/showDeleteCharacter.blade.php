@extends('layouts.app') @section('content')
<div class='container'>
	<div class="row">
		<div class="col-xs-5">
			<span class="overview_header">Verwijder Karakter</span>
		</div>
	</div>

	<div class="row"></div>

	<div class="row well warning-text">
		<div class="col-xs-12">Ben je er zeker van dat je onderstaand karakter wilt
			verwijderen uit de database?<br>
			Het karakter wordt volledig verwijderd. Deze actie kan nooit meer teruggedraaid worden!<br>
			<br>
			Bij twijfel: maak het karakter dood, dan is het ook niet meer bruikbaar maar nog wel opgeslagen
			in de database</div>
	</div>

	<div class="row"></div>

	<div class="row well class_name_row">
		<div class="row">
			<div class="col-xs-1"></div>
			<div id="{{$character->id}}" class="col-xs-8 detail_name">Karakter: {{ $character->name }}</div>
		</div>
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-8 detail_name">Speler: {{$character->char_user->name}}</div>
		</div>
	</div>

	<div class="row">
		<div class="row button-row">
			<div class="col-xs-2"></div>
			<div class="col-xs-3">
				<a href="delete_character/{{ $character->id }}"
					class="btn btn-default" type="button"
					style="width: 180px; font-size: 18px;"> Verwijder Karakter </a>
			</div>
			<div class="col-xs-1"></div>
			<div class="col-xs-3">
				<a href="showall_character/" class="btn btn-default"
					id="cancel_button" type="button"
					style="width: 120px; font-size: 18px;"> Cancel </a>
			</div>
		</div>

	</div>
</div>
@endsection
