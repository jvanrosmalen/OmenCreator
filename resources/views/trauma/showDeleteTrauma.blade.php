@extends('layouts.app') @section('content')
<div class='container'>
	<div class="row">
		<div class="col-xs-12">
			<span class="overview_header">Verwijder Trauma {{ $character->name }} (Speler: {{$character->char_user->name}})</span>
		</div>
	</div>

	<br>

	<div class="row well warning-text">
		<div class='row'>
			<div class="col-xs-10 col-xs-offset-1"><h4>Trauma Verwijderen</h4></div>
        </div>
        <div class='row'>
            <div class='col-xs-8 col-xs-offset-2'>
                Met betrekking tot onderstaande trauma:
            </div>
        </div>
        <div class='row'>
            <em>
                <div class='col-xs-2 col-xs-offset-2'>
                    Gekregen op Omen {{$trauma->gotten_on_omen}}
                </div>
                <div class='col-xs-6'>
                    Met als reden: {{$trauma->description}}
                </div>
            </em>
        </div>
		<br>

        <div class='row'>
			<div class="col-xs-10 col-xs-offset-1 text-center">Weet je zeker dat je dit trauma wil verwijderen uit de database?
                <br>(Deze actie kan niet ongedaan gemaakt worden.)
            </div>
		</div>
        <br>
 
		<form action='do_character_delete_trauma' method='POST'>
			<!-- ******************* -->
			<!-- For Laravel CSRF administration -->
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<!-- ******************* -->
		
			<input name='traumaId' type='hidden' value='{{$trauma->id}}'>
			<div class="row">
				<div class="row button-row">
					<div class="col-xs-4 col-xs-offset-4">
						<button type='submit' class="btn btn-default">Trauma Verwijderen</button>
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="row">
		<div class="col-xs-4 col-xs-offset-4 text-center">
			<a href="{{ url('manage_trauma/'.$character->id.'/') }}" class="btn btn-default"
				id="cancel_button" type="button"
				style="width: 120px; font-size: 18px;"> Terug </a>
		</div>
    </div>
</div>
@endsection
