@extends('layouts.app') @section('content')
<div class='container'>
	<div class="row">
		<div class="col-xs-5">
			<span class="overview_header">Verwijder Klasse</span>
		</div>
	</div>

	<div class="row"></div>

	<div class="row well warning-text">
		<div class="col-xs-12">Ben je er zeker van dat je onderstaand klasse wilt
			verwijderen uit de database?</div>
	</div>

	<div class="row"></div>

	<div class="row well class_name_row">
		<div class="col-xs-1"></div>
		<div id="{{$class->id}}" class="col-xs-8 detail_name">{{ $class->class_name }}</div>
	</div>

	<div id="class_detail_{{$class->id}}" class="row">
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-9">{!! Blade::compileString($class->description);
				!!}</div>
		</div>

		<div class="row button-row">
			<div class="col-xs-3"></div>
			<div class="col-xs-2">
				<a href="delete_class/{{ $class->id }}"
					class="btn btn-default" id="cancel_button" type="button"
					style="width: 120px; font-size: 18px;"> Verwijderen </a>
			</div>
			<div class="col-xs-2"></div>
			<div class="col-xs-2">
				<a href="showall_class" class="btn btn-default"
					id="cancel_button" type="button"
					style="width: 120px; font-size: 18px;"> Cancel </a>
			</div>
		</div>

	</div>
</div>
@endsection
