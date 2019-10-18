@extends('layouts.app') @section('content')
<div class='container'>
	<div class="row">
		<div class="col-xs-12">
			<span class="overview_header">Genees Trauma {{ $character->name }} (Speler: {{$character->char_user->name}})</span>
		</div>
	</div>

	<br>

	<div class="row well">
		<div class='row'>
			<div class="col-xs-10 col-xs-offset-1"><h4>Trauma Genezen</h4></div>
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
			<div class="col-xs-10 col-xs-offset-1">Geef hieronder aan hoe het trauma van <label>{{ $character->name }}</label> genezen is en door wie.</div>
		</div>
        <br>
 
		<form action='do_character_heal_trauma' method='POST'>
			<!-- ******************* -->
			<!-- For Laravel CSRF administration -->
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<!-- ******************* -->
		
			<input name='traumaId' type='hidden' value='{{$trauma->id}}'>
		
			<div class='row'>
				<div class='col-xs-2 col-xs-offset-2'>
					Genezen op Omen <input class='input_number_field' name='healed_on_omen' type='number' min="{{$trauma->gotten_on_omen}}>
				</div>
				<div class='col-xs-6'>
					<input name="healed_by" style="width: 100%;" placeholder="Genezen door" value="">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="row button-row">
					<div class="col-xs-4 col-xs-offset-4">
						<button type='submit' class="btn btn-default">Trauma Genezen</button>
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
