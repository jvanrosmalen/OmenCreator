@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<span class="overview_header">Verwijder Ambachtsuitrusting</span>
			</div>
		</div>

		<br>
		<div class="row">
		</div>

		@if(count($craft_equipment->skills) > 0)
		<div class="row">
			<div class='col-xs-10 col-xs-offset-1'>
				Deze ambachtsuitrusting wordt gebruikt voor de volgende vaardigheden:<br>
				<ul>
				@foreach($craft_equipment->skills as $skill)
					<li>{{$skill->name}}</li>
				@endforeach
				</ul>
			</div>
		</div>
		@endif
				
		<div class="row well warning-text">
			<div class="col-xs-12">
				Ben je er zeker van dat de ambachtsuitrusting <em>{{ $craft_equipment->name }}</em> wilt verwijderen
				uit de database?
			</div>		
		</div>

		<div class="row">
		</div>
		
			<div class="row button-row">
				<div class="col-xs-3"></div>
				<div class="col-xs-2">
					<a href="delete_craft_equipment/{{ $craft_equipment->id }}" class="btn btn-default" id="cancel_button" type="button"	style="width: 120px; font-size: 18px;">
					Verwijderen
					</a>
				</div>
				<div class="col-xs-2"></div>
				<div class="col-xs-2">
					<a href="showall_craft_equipment" class="btn btn-default" id="cancel_button" type="button"	style="width: 120px; font-size: 18px;">
					Cancel
					</a>
				</div>
			</div>
			
		</div>
 	</div>
@endsection