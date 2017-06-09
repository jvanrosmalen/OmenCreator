@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<h3>Levensvonk: {{$title}}</h3>
			</div>
		</div>

		<form action="/spark_submit/{{$sparkIndex}}" method="POST">

			<!-- ******************* -->
			<!-- For Laravel CSRF administration -->
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<!-- ******************* -->
			
			<input type="hidden" name="charId" value="{{$charId}}">
			<input type="hidden" name="sparkIndex" value="{{$sparkIndex}}">
			
			<div class="row well">
				<div class='row'>
					<div class="col-xs-1">
					</div>
					<div class="col-xs-10">
						Je bent in het bezit gekomen van een Niveau 3 literair kunstwerkje van een ervaren artiest.		
					</div>
					<div class="col-xs-1">
					</div>
				</div>
			</div>
			<div class="row well">
				<div class="row">
					<div class="col-xs-1">
					</div>
					<div class="col-xs-10">
						Kies &eacute;&eacute;n van onderstaande opties:			
					</div>
					<div class="col-xs-1">
					</div>
				</div>
				<div class="row">
					<div class="col-xs-2">
					</div>
					<div class="col-xs-8">
						<input type="radio" name="art_choice" value="Epos"  checked="checked"> Epos<br>
  						<input type="radio" name="art_choice" value="Ode"> Ode<br>
  						<input type="radio" name="art_choice" value="Satire"> Satire<br>			
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