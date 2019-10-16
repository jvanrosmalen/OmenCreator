@extends('layouts.app') @section('content')
<div class='container'>
	<div class="row">
		<div class="col-xs-5">
			<span class="overview_header">Trauma Overzicht</span>
		</div>
	</div>

	<div class="row"></div>

	<div class="row well">
		<div class='row'>
			<div class="col-xs-10 col-xs-offset-1"><h4>Trauma Toekennen</h4></div>
		</div>
		<div class='row'>
			<div class="col-xs-10 col-xs-offset-1">Geef hieronder aan welke trauma je wil toekennen aan <label>{{ $character->name }} (Speler: {{$character->char_user->name}})</label> en met welke reden.</div>
		</div>
		<br>
		<form action='do_character_add_trauma' method='POST'>
			<!-- ******************* -->
			<!-- For Laravel CSRF administration -->
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<!-- ******************* -->
		
			<input name='charId' type='hidden' value='{{$character->id}}'>
		
			<div class='row'>
				<div class='col-xs-2 col-xs-offset-2'>
					<input class='input_number_field' name='trauma_amount' type='number' value='1' min='1' max='3'>&emsp;Trauma
				</div>
				<div class='col-xs-6'>
					<input name="trauma_reason" style="width: 100%;" placeholder="Reden van EP toekenning" value="">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="row button-row">
					<div class="col-xs-3 col-xs-offset-4">
						<button type='submit' class="btn btn-default">EP Toekennen</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	
	<div class="row">
		<div class="col-xs-4 col-xs-offset-4 text-center">
			<a href="{{ url('/showall_character') }}" class="btn btn-default"
				id="cancel_button" type="button"
				style="width: 120px; font-size: 18px;"> Terug </a>
		</div>
    </div>
</div>
@endsection
