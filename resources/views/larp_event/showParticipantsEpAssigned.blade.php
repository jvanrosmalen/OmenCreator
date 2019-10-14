@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<span class="overview_header">EP toegekend</span>
			</div>
		</div>

		<br>
		<div class="row">
		</div>
		
		<div class="row well">
			<div class="col-xs-12">
                De EP voor alle deelnemers aan <b><em>{{$event->name}}</em></b> is succesvol toegekend.<br>
                Alive value is: <?php echo $alive;?>
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