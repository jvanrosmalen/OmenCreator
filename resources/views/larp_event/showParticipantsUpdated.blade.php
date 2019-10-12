@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<span class="overview_header">Deelnemers Aangepast</span>
			</div>
		</div>

		<br>
		<div class="row">
		</div>
		
		<div class="row well">
			<div class="col-xs-12">
				De deelnemerslijst voor <b><em>{{$eventName}}</em></b> is succesvol aangepast.<br>
			</div>		
		</div>
			
        <div class="row">
		<div class="row button-row">
			<div class="col-xs-2 col-xs-offset-5">
				<a href="{{ url('/larpeventsshowall') }}" class="btn btn-success"
					type="button"
					style="width: 100%; font-size: 18px;">Event Overzicht</a>
			</div>
		</div>
	</div>
 	</div>
@endsection