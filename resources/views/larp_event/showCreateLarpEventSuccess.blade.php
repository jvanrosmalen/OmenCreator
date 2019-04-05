@extends('layouts.app')

@section('content')
<div class='container'>
	<div class="row">
		<div class="col-xs-5">
			<span class="overview_header">Event Succesvol Gecre&euml;erd</span>
		</div>
	</div>

	<div class="row"></div>

	<div class="row well">
		<div class='row'>
			<div class="col-xs-10 col-xs-offset-1">
				Het event met de naam:<br>
			</div>
			<div class="col-xs-10 col-xs-offset-2">
				<div class='row'>
                    {{ $eventName }}
				</div>
			</div>
			<div class="col-xs-10 col-xs-offset-1">
				is succesvol gecre&euml;erd.
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="row button-row">
			<div class="col-xs-2 col-xs-offset-5">
				<a href="{{ url('/larpeventsshowall') }}" class="btn btn-default"
					type="button"
					style="width: 100%; font-size: 18px;">Naar Event Overzicht</a>
			</div>
		</div>

	</div>
</div>
@endsection
