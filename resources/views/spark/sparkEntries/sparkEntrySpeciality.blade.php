@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<h3>Levensvonk: {{$title}}</h3>
			</div>
		</div>

		<form action="spark_submit/23" method="POST">

			<!-- ******************* -->
			<!-- For Laravel CSRF administration -->
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<!-- ******************* -->
			
			<input type='hidden' name='speciality_string' value="{{$specialityString}}">
			<input type="hidden" name="charId" value="{{$charId}}">
			<input type="hidden" name="sparkIndex" value="{{$sparkIndex}}">
			
			<div class="row well">
				<div class="col-xs-1">
				</div>
				<div class="col-xs-10">
					Je bent in het bezit van een voorwerp dat jouw volk typeert.<br>
					Je ontvangt een {{$specialityString}}. 	 		
				</div>
				<div class="col-xs-1">
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