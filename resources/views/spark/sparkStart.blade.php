@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<h3>Levensvonk</h3>
			</div>
		</div>
		
		<div class="row well">
			<div class="col-xs-1">
			</div>
			<div class="col-xs-10">
			Kies hieronder of je de Levensvonk wil selecteren uit alle beschikbare opties,
			of dat je voor de Levensvonk wil gooien.<br>(De laatste optie geeft een willekeurig uitkomst die
			later niet meer te veranderen is.)
			</div>
			<div class="col-xs-1">
			</div>
		</div>
		<div class="row">
			<div class="col-xs-3">
			</div>
			<div class="col-xs-2">
				<a href="/show_spark_choice/{{$charId}}" class="btn btn-default" type="button" style="width: 120px; font-size: 18px;">
					Ik wil kiezen
				</a>
			</div>
			<div class="col-xs-2">
			</div>
			<div class="col-xs-2">
				<a href="/show_spark_random/{{$charId}}" class="btn btn-default" type="button" style="width: 120px; font-size: 18px;">
					Verras me
				</a>
			</div>
			<div class="col-xs-3">
			</div>
		</div>
 	</div>
@endsection