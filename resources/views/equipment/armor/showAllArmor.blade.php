@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<span class="overview_header">Overzicht Pantsers</span>
				<a href="/create_armor" type="button" class="btn btn-default button-add" aria-label="Left Align">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</a>
			</div>
		
			<div class="col-xs-4">
			</div>
			
			<div class="col-xs-3">
				<div class="input-group">
					<input id="armorSearchInput"  type="text" class="search-query form-control" placeholder="Zoeken" onchange="Armor.searchArmors();"/>
                    <span class="input-group-btn">
    	                <button class="btn searchGlyphiconButton" type="button">
    			            <span class=" glyphicon glyphicon-search"></span>
            	        </button>
                    </span>
                </div>
			</div>
		</div>
		@foreach ($armors as $armor)
			<div class="row well equipment_name_row">
				<div class="col-xs-1">
				</div>
				<div id="{{$armor->id}}" class="col-xs-8 detail_name">
					{{ $armor->name }}
				</div>
				<div class="col-xs-1">
					<a href="#" class="btn btn-default btn-armor-{{$armor->id}} btn-update" role="button">Aanpassen</a>
				</div>
				<div class="col-xs-1">
					<a href="#" class="btn btn-default btn-armor-{{$armor->id}} btn-delete" role="button">Verwijderen</a>
				</div>
			</div>
			<div id="armor_detail_{{$armor->id}}" class="row equipment_details">
				<div class="row">
					<div class="col-xs-1">
					</div>
					<div class="col-xs-9">
						{!! Blade::compileString($armor->description); !!}
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
									<td class="detail_rating">{{$armor->price_normal}}</td>
									<td class="detail_rating">{{$armor->price_good}}</td>
									<td class="detail_rating">{{$armor->price_master}}</td>
								</tr>
							</tbody>		
						</table>
					</div>
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
									<td class="detail_name">Pantser</td>
									<td class="detail_rating">{{$armor->armor_normal}}</td>
									<td class="detail_rating">{{$armor->armor_good}}</td>
									<td class="detail_rating">{{$armor->armor_master}}</td>
								</tr>
								<tr>
									<td class="detail_name">Structuur</td>
									<td class="detail_rating">{{$armor->structure_normal}}</td>
									<td class="detail_rating">{{$armor->structure_good}}</td>
									<td class="detail_rating">{{$armor->structure_master}}</td>
								</tr>
							</tbody>		
						</table>
					</div>
				</div>
			</div>
		@endforeach
		
<!-- 	Trick to be able to access the count of armors in the JS below -->
		<div id="armor_size" class="hidden" data-armors="{{ $armors }}" ></div>
		
<!-- 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> -->
<!-- 	    <script src="{{ URL::asset('js/equipment/armor/armor.js') }}"></script> -->
			<script>Armor.addListeners()</script>
 	</div>
@endsection