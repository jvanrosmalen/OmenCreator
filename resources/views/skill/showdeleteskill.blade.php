@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<span class="overview_header">Verwijder Vaardigheid</span>
			</div>
		</div>

		<div class="row">
		</div>
		
		<div class="row well warning-text">
			<div class="col-xs-12">
				Ben je er zeker van dat je de vaardigheid <b><em>{{$skill->name}}</em></b> wilt verwijderen
				uit de database?
			</div>		
		</div>
			
		<div class="row button-row">
			<div class="col-xs-3"></div>
			<div class="col-xs-2">
				<a href="/delete_skill/{{ $skill->id }}" class="btn btn-default" id="cancel_button" type="button"	style="width: 120px; font-size: 18px;">
				Verwijderen
				</a>
			</div>
			<div class="col-xs-2"></div>
			<div class="col-xs-2">
				<a href="/skillshowall" class="btn btn-default" id="cancel_button" type="button"	style="width: 120px; font-size: 18px;">
				Cancel
				</a>
			</div>
		</div>
 	</div>
@endsection