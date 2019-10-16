@extends('layouts.app') @section('content')
<div class='container'>
	<div class="row">
		<div class="col-xs-5">
			<span class="overview_header">Trauma Succesvol toegekend</span>
		</div>
	</div>

	<div class="row"></div>

	<div class="row well">
		<div class='row'>
			<div class="col-xs-10 col-xs-offset-1">
				Er is 1 trauma toegekend aan <label>{{ $character->name }} (Speler: {{$character->char_user->name}})</label>.
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="row button-row">
			<div class="col-xs-2 col-xs-offset-5">
				<a href="{{ url('/showall_character') }}" class="btn btn-default"
					id="cancel_button" type="button"
					style="width: 100%; font-size: 18px;">Naar Overzicht</a>
			</div>
		</div>

	</div>
</div>
@endsection
