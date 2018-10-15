@extends('layouts.app')

@section('content')
    <div class='container'>
        <div class='row'>
            <div class='col-xs-12'>
                <h3>Koppel Karakter Document</h3>
            </div>
        </div>

        <div class="row">
            <form action="/do_upload_chardoc" method="post" enctype="multipart/form-data">

                <!-- ******************* -->
                <!-- For Laravel CSRF administration -->
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <!-- ******************* -->

                <input type="hidden" name="charId" value="{{ $character->id }}">

                <div class="row">
                    <div class='col-xs-2'>
                    </div>
                    <div class='col-xs-8'>
                        <div class='row text-center'>
                            Selecteer hieronder het .pdf bestand dat je wenst te koppelen aan het karakter {{$character->name}} 
                             (Speler: {{$character->char_user->name}}).
                        </div>
                        <br>
                        <div class='row'>
                            <div class="col-xs-4">
                            </div>
                            <div class="col-xs-3">
                                {!! Form::file('char_doc') !!}
                            </div>
                            <div class="col-xs-5">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <br>
                    <div class="col-xs-5">
                    </div>
                    <div class="col-xs-2">
                            <input id="import" class="btn btn-default" style="width:100%" type="submit" value="Importeer">
                    </div>
                    <div class="col-xs-5">
                    </div>
                </div>
            </form>
        <div>
    </div>
@endsection