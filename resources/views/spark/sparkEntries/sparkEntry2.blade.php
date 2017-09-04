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
					Het personage heeft een uitzinnige angst voor bepaalde wezens. 
					Het personage kan nooit Angst Resistentie gebruiken tegen 
					Angstaanvallen van zijn gekozen soort.		
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
						<input type="radio" name="scaredOf" value="Trollen"  checked="checked"> Trollen<br>
  						<input type="radio" name="scaredOf" value="Glashtynn"> Glashtynn<br>
  						<input type="radio" name="scaredOf" value="Ondoden"> Ondoden<br>			
  						<input type="radio" name="scaredOf" value="Geesten"> Geesten<br>			
  						<input type="radio" name="scaredOf" value="Wolven"> Wolven<br>			
  						<input type="radio" name="scaredOf" value="Spinnen"> Spinnen<br>			
  						<input type="radio" name="scaredOf" value="Bhanda Kor"> Bhanda Korr<br>			
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