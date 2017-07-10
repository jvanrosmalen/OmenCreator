@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<h3>Levensvonk: {{$title}}</h3>
			</div>
		</div>

		<form action="/show_edit_character/{{$charId}}" method="GET">

			<!-- ******************* -->
			<!-- For Laravel CSRF administration -->
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<!-- ******************* -->
			
			<div class="row well">
				<div class="col-xs-1">
				</div>
				<div class="col-xs-10">
					@foreach($text as $line)
						{{$line}}<br>
					@endforeach			
				</div>
				<div class="col-xs-1">
				</div>
			</div>
			<div class="row well">
				<div class="col-xs-1">
				</div>
				<div class="col-xs-10">
					@if(sizeof($changes) > 0)
						Deze keuze heeft de volgende gevolgen voor de indeling van je vaardigheden:<br>
						<ul>
							@foreach($changes as $change)
								<li>{{$change}}</li>
							@endforeach
						</ul>	
					@else
						Deze verandering heeft geen gevolgen voor de indeling van je vaardigheden.
					@endif
					<br>
					Je wordt hierna doorgeleid naar een pagina waar je je karakter nog kan controleren en eventueel aanpassen.<br>
					(Ook als er nu geen automatische aanpassingen gedaan zijn.)		
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