@extends('layouts.app')

@section('content')
    <div class='container'>
        <div class='row'>
            <div class='col-xs-12'>
                <h3>Verwijder Karakter Document</h3>
            </div>
        </div>

        <div class="row">
            <div class="row">
                <div class='col-xs-2'>
                </div>
                <div class='col-xs-8'>
                    <div class='row text-center well warning-text'>
                        Je staat op het punt om het document {{$chardocName}} te verwijderen voor {{$character->name}}.<br>
                        Deze actie kan niet teruggedraaid worden. Als je hier niet zeker van bent, download dan eerst het document
                         voordat je het verwijdert.
                    </div>
                    <br>
                </div>
            </div>

            <div class="row">
                <br>
                <div class="col-xs-3">
                </div>
                <div class="col-xs-2">
                    <a href="/show_character/{{$character->id}}" class='btn btn-default' style='width:100%'>Cancel</a>
                </div>
                <div class="col-xs-2">
                </div>
                <div class="col-xs-2">
                    <a href="do_remove_chardoc/{{$character->id}}/{{$chardocName}}" class='btn btn-default' style='width:100%'>Verwijder</a>
                </div>
                <div class="col-xs-3">
                </div>
            </div>
        </div>
    </div>
@endsection