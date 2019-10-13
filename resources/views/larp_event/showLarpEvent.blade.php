<!DOCTYPE html>
<html>
@extends('layouts.app')

@section('content')

<div class='container'>
	<div class='row'>
		<div class='col-xs-12'>
			<h3>Overzicht Event: {{ $event->name }}</h3>
		</div>
	</div>

    <ul class="nav nav-tabs">
		<li class="active"><a id="tab1" data-toggle="tab" href="#event_info">Event Info</a></li>
		<li><a id="tab2" data-toggle="tab" href="#event_actions">Event Acties</a></li>
	</ul>

	<div class="tab-content">
		<div id="event_info" class="tab-pane fade in active">
            <div class='row well'>
                <div class='row'>
                    <div class='col-xs-1'></div>
                    <div class='col-xs-1'>Begindatum:</div>
                    <div class='col-xs-2'>
                        {{\Carbon\Carbon::parse($event->begin_date)->format('d-m-Y')}}
                    </div>
                    <div class='col-xs-1'></div>
                    <div class='col-xs-1'>Einddatum:</div>
                    <div class='col-xs-2'>
                        {{\Carbon\Carbon::parse($event->end_date)->format('d-m-Y')}}
                    </div>
                    </div>
                    <div class='col-xs-1'></div>
                </div>

                <div class='row'>
                <div class='col-xs-1'></div>
                <div class='col-xs-1'>Beschrijving:</div>
                <div class='col-xs-9'>
                    {{ $event->description }}
                </div>
                </div>
            </div>
        </div>

        <div id="event_actions" class="tab-pane fade">
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
@stop
</html>