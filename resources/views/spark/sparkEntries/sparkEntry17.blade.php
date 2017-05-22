@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<h3>Levensvonk: Po&euml;zie 1</h3>
			</div>
		</div>

		<form action="/spark_submit/17" method="POST">

			<!-- ******************* -->
			<!-- For Laravel CSRF administration -->
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<!-- ******************* -->
			
			<div class="row well">
				<div class='row'>
					<div class="col-xs-1">
					</div>
					<div class="col-xs-10">
						Je bent in het bezit gekomen van een Nv1 literair kunstwerkje van een beginnende artiest..		
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
						<input type="radio" name="art" value="0"  checked="checked"> Epos<br>
  						<input type="radio" name="art" value="1"> Ode<br>
  						<input type="radio" name="art" value="2"> Satire<br>			
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