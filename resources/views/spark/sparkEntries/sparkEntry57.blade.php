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
					Je mag je Afkomstklasse vrij kiezen of &eacute;&eacute;n ervan vervangen door een ander als je meerdere Afkomstklasses hebt.<br>
					Je Afkomstpunten mag je vervolgens in deze nieuwgekozen Afkomstklasse spenderen.
				</div>
				<div class="col-xs-1">
				</div>
			</div>
			<div class="row well">
				@if(sizeof($char_descent_classes) > 1)
					<div class="row">
						<div class="col-xs-1">
						</div>
						<div class="col-xs-10">
							Je hebt meerdere afkomstklasses. Kies hieronder de klasse die je <em><b>inwisselt</b></em> voor een andere.<br>
							(Je verliest deze afkomstklasse dus.)
						</div>
						<div class="col-xs-1">
						</div>
					</div>
					<div class="row">
						<div class="col-xs-2">
						</div>
						<div class="col-xs-10">
							@foreach($char_descent_classes as $char_descent_class)
								<input type="radio" name="excludeDescentClassId" value="{{$char_descent_class->id}}" checked="checked"> {{$char_descent_class->class_name}}<br>
							@endforeach
						</div>
					</div>
				@else
					<div class="row">
						<div class="col-xs-1">
						</div>
						<div class="col-xs-10">
							Je hebt maar &eacute;&eacute;n afkomstklasse. Onderstaande afkomstklasse zal vervangen worden als je een andere kiest.
						</div>
						<div class="col-xs-1">
						</div>
					</div>
					<div class="row">
						<div class="col-xs-2">
						</div>
						<div class="col-xs-10">
							<input type="radio" name="excludeDescentClassId" value="{{$char_descent_classes[0]->id}}" checked="checked"> {{$char_descent_classes[0]->class_name}}<br>
						</div>
					</div>
				@endif
				<br>
				<div class="row">
					<div class="col-xs-1">
					</div>
					<div class="col-xs-10">
						Kies hieronder je <em><b>nieuwe</b></em> afkomstklasse.
					</div>
					<div class="col-xs-1">
					</div>
				</div>
				<div class="row">
					<div class="col-xs-2">
					</div>
					<div class="col-xs-10">
						@foreach($char_descent_options as $char_descent_class)
							<input type="radio" name="includeDescentClassId" value="{{$char_descent_class->id}}" checked="checked"> {{$char_descent_class->class_name}}<br>
						@endforeach
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