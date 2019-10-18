@extends('layouts.app') @section('content')
<div class='container'>
	<div class="row">
		<div class="col-xs-5">
			<span class="overview_header">Trauma Verwijderd</span>
		</div>
	</div>

	<div class="row"></div>

	<div class="row well">
		<div class='row'>
			<div class="col-xs-10 col-xs-offset-1 text-center">
                Het trauma <label>{{$traumaDescription}}</label> van <label>{{ $character->name }}</label>
                <br>is succesvol verwijderd.
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="row button-row">
			<div class="col-xs-2 col-xs-offset-5">
                <a href="{{ url('manage_trauma/'.$character->id.'/') }}" class="btn btn-default"
                    id="cancel_button" type="button"
                    style="width: 120px; font-size: 18px;"> Terug </a>
			</div>
		</div>

	</div>
</div>
@endsection
