@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<h3>Levensvonk: Allergische Reactie</h3>
			</div>
		</div>

		<form action="/spark_submit/1" method="POST">

			<!-- ******************* -->
			<!-- For Laravel CSRF administration -->
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<!-- ******************* -->
			
			<div class="row well">
				<div class="col-xs-1">
				</div>
				<div class="col-xs-10">
					Het personage is allergisch voor bepaalde wezens. Indien
					 het schade ontvangt van zijn gekozen Allergie ontvangt 
					 het automatisch de ziekte 'Allergische Reactie'.
					 Deze zorgt ervoor dat het personage niet geheeld kan worden
					  met Chirurgie tot de Allergie met de vaardigheid Menden 
					  is weggewerkt.			
				</div>
				<div class="col-xs-1">
				</div>
			</div>
			<div class="row well">
				<div class="row">
					<div class="col-xs-1">
					</div>
					<div class="col-xs-10">
						Kies een wezens uit onderstaande opties:			
					</div>
					<div class="col-xs-1">
					</div>
				</div>
				<div class="row">
					<div class="col-xs-2">
					</div>
					<div class="col-xs-8"> 
						<input type="radio" name="race" value="0" checked="checked"> Trollen<br>
  						<input type="radio" name="race" value="1"> Lijken<br>
  						<input type="radio" name="race" value="2"> Glashtynn<br>			
  						<input type="radio" name="race" value="3"> Spinnen<br>			
  						<input type="radio" name="race" value="4"> Paddestoelen<br>			
					</div>
					<div class="col-xs-2">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-7">
				</div>
				<div class="col-xs-2">
					<button type='submit' class="btn btn-default" style="width: 120px; font-size: 18px;">
						Ga door
					</button>
				</div>
				<div class="col-xs-3">
				</div>
			</div>
			
		</form>
 	</div>
@endsection