@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-6">
				<span class="overview_header">Overzicht Ambachtsuitrusting</span>
				<a href="/create_craft_equipment" type="button" class="btn btn-default button-add" aria-label="Left Align">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</a>
			</div>
		
			<div class="col-xs-3">
			</div>
			
			<div class="col-xs-3">
				<div class="input-group">
					<input id="craftEquipmentSearchInput"  type="text" class="search-query form-control" placeholder="Zoeken" onchange="CraftEquipment.searchCraftEquipment();"/>
                    <span class="input-group-btn">
    	                <button class="btn searchGlyphiconButton" type="button">
    			            <span class=" glyphicon glyphicon-search"></span>
            	        </button>
                    </span>
                </div>
			</div>
		</div>
		@foreach ($craft_equipments as $craft_equipment)
			<div class="row well equipment_name_row">
				<div class="col-xs-1">
				</div>
				<div id="{{$craft_equipment->id}}" class="col-xs-8 detail_name">
					{{ $craft_equipment->name }}
				</div>
				<div class="col-xs-1">
					<a href="#" class="btn btn-default btn-craft-equipment-{{$craft_equipment->id}} btn-update" role="button">Aanpassen</a>
				</div>
				<div class="col-xs-1">
					<a href="#" class="btn btn-default btn-craft-equipment-{{$craft_equipment->id}} btn-delete" role="button">Verwijderen</a>
				</div>
			</div>
			<div id="craft_equipment_detail_{{$craft_equipment->id}}" class="row equipment_details">
				<div class="row">
					<div class="col-xs-1">
					</div>
					<div class="col-xs-9">
						{!! Blade::compileString($craft_equipment->description); !!}
					</div>
				</div>
			</div>
		@endforeach
		
<!-- 	Trick to be able to access the count of equipment in the JS below -->
		<div id="craft_equipment_size" class="hidden" data-craft-equipments="{{ $craft_equipments }}" ></div>
		
			<script>CraftEquipment.addListeners()</script>
 	</div>
@endsection