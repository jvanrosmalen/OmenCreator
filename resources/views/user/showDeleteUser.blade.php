@extends('layouts.app')

@section('content')
<div class='container'>
	<div class="row">
		<div class="col-xs-5">
			<span class="overview_header">Gebruiker Verwijderen</span>
		</div>
	</div>

	<div class="row"></div>

	<div class="row well warning-text">
		<div class="col-xs-12">Ben je er zeker van dat je de gebruiker {{$user->name}} wilt
			verwijderen uit de database?</div>
	</div>

	<div class="row"></div>

	<div class="row button-row">
		<div class="col-xs-3"></div>
		<div class="col-xs-2">
			<a href="delete_user/{{ $user->id }}"
				class="btn btn-default" id="cancel_button" type="button"
				style="width: 120px; font-size: 18px;"> Verwijderen </a>
		</div>
		<div class="col-xs-2"></div>
		<div class="col-xs-2">
			<a href="showall_user" class="btn btn-default"
				id="cancel_button" type="button"
				style="width: 120px; font-size: 18px;"> Cancel </a>
		</div>
	</div>

</div>
@endsection
