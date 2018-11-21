@extends('layouts.app')

@section('content')
    <div class='container'>
        <div class='row'>
            <div class='col-xs-12'>
                <h3>Importeer Vaardigheden</h3>
            </div>
        </div>

        <div class="row well warning-text text-center">
			<div class="col-xs-12">
				Deze pagina is enkel en alleen bedoeld om fouten in de EP hoeveelheid van karakters te verhelpen!
                Gebruik onderstaande opties niet voor het regulier toewijzen van EP, want dan komt deze niet netjes in
                het EP-overzicht van het karakter te staan!<br><br>
                Als je gewoon EP wil toewijzen aan een karakters, ga dan naar:<br>
                <a class="btn btn-default" href="show_character_ep/{{$character->id}}">Update Karakter Ep</a>
			</div>		
		</div>

		<div class='row'>
			<div class="col-xs-10 col-xs-offset-1">Geef hieronder de EP/AP verandering aan voor <label>{{ $character->name }} (Speler: {{$character->char_user->name}})</label>.</div>
		</div>

        <div class="row">
            <form action="/do_change_character_ep" method="post" enctype="multipart/form-data">

                <!-- ******************* -->
                <!-- For Laravel CSRF administration -->
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <!-- ******************* -->
                <div class="row">
                    <div class='col-xs-2'>
                    </div>
                    <div class='col-xs-8'>
                        <h4>Afkomstpunten (AP)</h4>
                    </div>
                </div>
                <div class="row">
                    <div class='col-xs-2'>
                    </div>
                    <div class='col-xs-8'>
                        <br>
                        <div class='row'>
                            <div class="col-xs-4">
                                <strong>Huidig aantal: {{$character->descent_ep_amount}}</strong>
                            </div>
                            <div class="col-xs-1">
                                Gewenst: 
                            </div>
                            <div class="col-xs-1">
                                <input type="number" name="descent_ep_amount" min="3" value="{{$character->descent_ep_amount}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class='col-xs-2'>
                    </div>
                    <div class='col-xs-8'>
                        <h4>Ervaringspunten (EP)</h4>
                    </div>
                </div>
                <div class="row">
                    <div class='col-xs-2'>
                    </div>
                    <div class='col-xs-8'>
                        <br>
                        <div class='row'>
                            <div class="col-xs-4">
                                <strong>Huidig aantal: {{$character->ep_amount}}</strong>
                            </div>
                            <div class="col-xs-1">
                                Gewenst: 
                            </div>
                            <div class="col-xs-1">
                                <input type="number" name="ep_amount" min="15" value="{{$character->ep_amount}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <br>
                    <div class="col-xs-5">
                    </div>
                    <div class="col-xs-2">
                            <input class="btn btn-default" style="width:100%" type="submit" value="Aanpassen">
                    </div>
                    <div class="col-xs-5">
                    </div>
                </div>
            </form>
        <div>
    </div>
@endsection