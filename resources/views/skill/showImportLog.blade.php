<!DOCTYPE html>
<html>
@extends('layouts.app')

@section('content')
    <div class='container'>
        <div class='row'>
            <div class='col-xs-8'>
                <h3>Import Resultaten</h3>
            </div>
            <div class='col-xs-4'>
                <div class='col-xs-6 pull-right'>
                    <a class="btn btn-default btn-block" href="{{ url('download_importlog') }}">Download Log</a>
                </div>
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
                        <ul>
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