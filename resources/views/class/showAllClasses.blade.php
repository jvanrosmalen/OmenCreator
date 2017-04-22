@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-6">
				<span class="overview_header">Klassen</span>
				<a href="/create_class" type="button" class="btn btn-default button-add" aria-label="Left Align">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</a>
			</div>
		
			<div class="col-xs-3">
			</div>
			
			<div class="col-xs-3">
				<div class="input-group">
					<input id="classSearchInput"  type="text" class="search-query form-control" placeholder="Zoeken" onchange="PlayerClass.searchClasses();"/>
                    <span class="input-group-btn">
    	                <button class="btn searchGlyphiconButton" type="button">
    			            <span class=" glyphicon glyphicon-search"></span>
            	        </button>
                    </span>
                </div>
			</div>
		</div>
		@foreach ($classes as $class)
<!-- 			Do this for each class except Algemeen. (Has id == 1) -->
			@if($class->id != 1)
			<div class="row well class_name_row">
				<div class="col-xs-1">
				</div>
				<div id="{{$class->id}}" class="col-xs-8 detail_name">
					{{ $class->class_name }}
					@if($class->is_player_class)
						 (Spelerklasse)
					@endif
				</div>
				<div class="col-xs-1">
					<a href="#" class="btn btn-default btn-class-{{$class->id}} btn-update" role="button">Aanpassen</a>
				</div>
				<div class="col-xs-1">
					<a href="#" class="btn btn-default btn-class-{{$class->id}} btn-delete" role="button">Verwijderen</a>
				</div>
			</div>
			<div id="class_detail_{{$class->id}}" class="row class_details">
				<div class="row">
					<div class="col-xs-1">
					</div>
					<div class="col-xs-9">
						{!! Blade::compileString($class->description); !!}
					</div>
				</div>
				
				<br>
				
				<div class="row">
					<div class="col-xs-1">
					</div>
					<div class="col-xs-4 rule_display">
						<b>Welvaart:</b><br>
						{{$class->wealth_type->wealth_type or 'Geen welvaart gezet'}}
					</div>
				</div>
				
				<br>
			</div>
			@endif
		@endforeach
		
<!-- 	Trick to be able to access the count of class in the JS below -->
		<div id="class_size" class="hidden" data-classes="{{ $classes }}" ></div>
		
		<script>PlayerClass.addListeners()</script>
 	</div>
@endsection