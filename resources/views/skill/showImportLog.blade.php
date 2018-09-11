<!DOCTYPE html>
<html>
@extends('layouts.app')

@section('content')
    <div class='container'>
        <div class='row'>
            <div class='col-xs-12'>
                <h3>Import Resultaten</h3>
            </div>
        </div>

        <div class="errorLogOverview">
            @foreach($errorLogArray as $skillName => $errors)
                <div class="row">
                    <div class="col-xs-1">
                    </div>
                    <div class='col-xs-10'>
                        <h5>{{$skillName}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                    </div>
                    <div class='col-xs-10'>
                        <ul class="errorLog">
                        @foreach($errors as $error)
                            <li>{{$error}}</li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

</html>