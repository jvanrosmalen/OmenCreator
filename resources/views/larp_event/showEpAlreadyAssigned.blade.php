@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<span class="overview_header">EP al toegekend</span>
			</div>
		</div>

		<br>
		<div class="row">
		</div>
		
		<div class="row well">
			<div class="col-xs-12">
                De EP voor <b><em>{{$event->name}}</em></b> is al toegekend. Je kan niet nog een keer deze EP
                toekennen.<br>
            </div>	
		</div>
			
        <div class="row">
		<div class="row button-row">
			<div class="col-xs-2 col-xs-offset-5">
				<a href="{{ url('/larpeventsshow/'.$event->id) }}" class="btn btn-success"
					type="button"
					style="width: 100%; font-size: 18px;">Terug naar Event</a>
			</div>
		</div>
	</div>
 	</div>
@endsection