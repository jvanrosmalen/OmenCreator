@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-6">
				<span class="overview_header">Mijn Spelerkarakters</span>
			</div>
		
			<div class="col-xs-3">
			</div>
		</div>
		@foreach ($charNameIds as $charNameId)
			<div class="row well">
				<div class="col-xs-1">
				</div>
				<div class="col-xs-8">
					<h4>{{ $charNameId->name }}</h4>
				</div>
				<div class="col-xs-2">
					<a href="/show_user_character/{{$userId}}/{{$charNameId->id}}." class="btn btn-default">Toon Karakter</a>
				</div>
			</div>
		@endforeach
 	</div>
@endsection