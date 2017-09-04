@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<h3>Levensvonk: {{$title}}</h3>
			</div>
		</div>

		<form action="spark_submit/{{$sparkIndex}}" method="POST">

			<!-- ******************* -->
			<!-- For Laravel CSRF administration -->
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<!-- ******************* -->
			
			<input type="hidden" name="charId" value="{{$charId}}">
			<input type="hidden" name="sparkIndex" value="{{$sparkIndex}}">
			
			<div class="row well">
				<div class="col-xs-1">
				</div>
				<div class="col-xs-10">
					Je koestert een hartsgrondige, diepe haat voor een bepaalde wezens of een bepaald volk.
					Je moet deze diepgewortelde haat constant uitspelen en proberen aan te vallen.
					Per dag krijg je gratis: 1x &#39;Krachtslag +1&#39; op het gekozen doel van jouw haat. 
				</div>
				<div class="col-xs-1">
				</div>
			</div>
			<div class="row">
				<div class="row">
					<div class="col-xs-2">
					</div>
					<div class="col-xs-10">
						Kies uit onderstaande opties:			
					</div>
					<div class="col-xs-1">
					</div>
				</div>
				<div class="row">
					<div class="col-xs-2">
					</div>
					<div class="col-xs-8"> 
						<input type="radio" name="hatredFor" value="Trollen" checked="checked"> Trollen<br>
  						<input type="radio" name="hatredFor" value="Glashtynn"> Glashtynn<br>			
  						<input type="radio" name="hatredFor" value="Dwergen"> Dwergen<br>			
  						<input type="radio" name="hatredFor" value="Heksen"> Heksen<br><br>			
						<input type="radio" name="hatredFor" value="Mannheimers"> Mannheimers<br>
  						<input type="radio" name="hatredFor" value="Khali&euml;rs"> Khali&euml;rs<br>			
  						<input type="radio" name="hatredFor" value="Bhanda Korr"> Bhanda Korr<br>			
  						<input type="radio" name="hatredFor" value="Ranae"> Ranae<br>			
  						<input type="radio" name="hatredFor" value="Goliad"> Goliad<br>			
					</div>
					<div class="col-xs-2">
					</div>
				</div>
			</div>
			<div class="row well warning-text">
				<div class="col-xs-1">
				</div>
				<div class="col-xs-10">
					Spelleiding keurt dit enkel goed mits passende background. Anders rol opnieuw! 
				</div>
				<div class="col-xs-1">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-3">
				</div>
				<div class="col-xs-2">
					<a href="show_spark_random/{{$charId}}" class="btn btn-default" type="button" style="width: 150px; font-size: 18px;">
						Gooi opnieuw
					</a>
				</div>
				<div class="col-xs-2">
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