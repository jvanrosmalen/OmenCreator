@extends('layouts.app')

@section('content')
    <div class='container'>
        <div class='row'>
            <div class='col-xs-12'>
                <h3>Koppel Karakter Document</h3>
            </div>
        </div>

        <div class="row">
            <div class="row">
                <div class='col-xs-2'>
                </div>
                <div class='col-xs-8'>
                    <div class='row text-center well warning-text'>
                        Het document dat hebt geselecteerd lijkt geen PDF document te zijn.<br>
                        (Het document heeft niet de extensie .pdf)
                    </div>
                    <br>
                </div>
            </div>

            <div class="row">
                <br>
                <div class="col-xs-5">
                </div>
                <div class="col-xs-2">
                    <a href='upload_chardoc/{{$charId}}/' class='btn btn-default' style='width:100%'>Terug</a>
                </div>
                <div class="col-xs-5">
                </div>
            </div>
        <div>
    </div>
@endsection