@extends('layouts.app') @section('content')
<div class='container'>
	<div class="row">
		<div class="col-xs-5">
			<span class="overview_header">Dood Karakter</span>
		</div>
	</div>

	<div class="row"></div>

	<div class="row well warning-text">
		<div class="col-xs-12">Ben je er zeker van dat je onderstaand karakter wilt
			doden? Het karakter kan niet meer aangepast worden, maar wel bekeken.<br>
			Alleen een Admin zal het karakter nog eventueel kunnen doen herrijzen.</div>
	</div>

	<div class="row"></div>

	<div class="row well class_name_row">
		<div class="row">
			<div class="col-xs-1"></div>
			<div id="{{$character->id}}" class="col-xs-8 detail_name">Karakter: {{ $character->name }}</div>
		</div>
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-8 detail_name">Speler: {{$character->char_user->name}}</div>
		</div>
	</div>

	<div class="row">
		<div class="row button-row">
			<div class="col-xs-2"></div>
			<div class="col-xs-3">
				<a href="kill_character/{{ $character->id }}"
					class="btn btn-default" type="button"
					style="width: 150px; font-size: 18px;"> Dood Karakter </a>
			</div>
			<div class="col-xs-1"></div>
			<div class="col-xs-3">
				<a href="showall_character/" class="btn btn-default"
					id="cancel_button" type="button"
					style="width: 120px; font-size: 18px;"> Cancel </a>
			</div>
		</div>

	</div>
</div>
@endsection
