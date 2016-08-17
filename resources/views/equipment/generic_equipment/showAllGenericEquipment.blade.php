@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-6">
				<span class="overview_header">Algemene Uitrusting</span>
				<a href="/create_generic_equipment" type="button" class="btn btn-default button-add" aria-label="Left Align">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</a>
			</div>
		
			<div class="col-xs-3">
			</div>
			
			<div class="col-xs-3">
				<div class="input-group">
					<input id="genericEquipmentSearchInput"  type="text" class="search-query form-control" placeholder="Zoeken" onchange="GenericEquipment.searchGenericEquipments();"/>
                    <span class="input-group-btn">
    	                <button class="btn searchGlyphiconButton" type="button">
    			            <span class=" glyphicon glyphicon-search"></span>
            	        </button>
                    </span>
                </div>
			</div>
		</div>
		@foreach ($generic_equipments as $generic_equipment)
				<div class="row well equipment_name_row">
				<div class="col-xs-1">
				</div>
				<div id="{{$generic_equipment->id}}" class="col-xs-8 detail_name">
					{{ $generic_equipment->name }}
				</div>
				<div class="col-xs-1">
					<a href="#" class="btn btn-default btn-generic-equipment-{{$generic_equipment->id}} btn-update" role="button">Aanpassen</a>
				</div>
				<div class="col-xs-1">
					<a href="#" class="btn btn-default btn-generic-equipment-{{$generic_equipment->id}} btn-delete" role="button">Verwijderen</a>
				</div>
			</div>
			<div id="generic_equipment_detail_{{$generic_equipment->id}}" class="row equipment_details">
				<div class="row">
					<div class="col-xs-1">
					</div>
					<div class="col-xs-9">
						{!! Blade::compileString($generic_equipment->description); !!}
					</div>
				</div>
				
				<div class="row">
					<div class="col-xs-1">
					</div>
					<div class="col-xs-4">
						<table class="table borderless detail_table">
							<thead>
								<tr>
									<td></td>
									<td class="detail_name detail_rating">Normaal</td>
									<td class="detail_name detail_rating">Goed</td>
									<td class="detail_name detail_rating">Meesterlijk</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="detail_name">Prijs</td>
									<td class="detail_rating">{{$generic_equipment->price_normal}}</td>
									<td class="detail_rating">{{$generic_equipment->price_good}}</td>
									<td class="detail_rating">{{$generic_equipment->price_master}}</td>
								</tr>
							</tbody>		
						</table>
					</div>
				</div>
				
				<div class="row">
					<div class="col-xs-1">
					</div>
					<div class="col-xs-6 rule_display">
						<b>Speciale regels:</b><br>
						@foreach($generic_equipment->dam_rules as $dam_rule)
							{{$dam_rule->toString()}}<br>
						@endforeach
						@foreach($generic_equipment->call_rules as $call_rule)
							{{$call_rule->toString()}}<br>
						@endforeach
						@foreach($generic_equipment->res_rules as $res_rule)
							{{$res_rule->toString()}}<br>
						@endforeach
						@foreach($generic_equipment->stat_rules as $stat_rule)
							{{$stat_rule->toString()}}<br>
						@endforeach
						@foreach($generic_equipment->wealth_rules as $wealth_rule)
							{{$wealth_rule->toString()}}<br>
						@endforeach
					</div>
				</div>
			</div>
		@endforeach
		
<!-- 	Trick to be able to access the count of equipment in the JS below -->
		<div id="generic_equipment_size" class="hidden" data-generic-equipments="{{ $generic_equipments }}" ></div>
		
		<script>GenericEquipment.addListeners()</script>
 	</div>
@endsection