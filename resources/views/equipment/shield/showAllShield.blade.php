@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<span class="overview_header">Overzicht Schilden</span>
				<a href="/create_shield" type="button" class="btn btn-default button-add" aria-label="Left Align">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</a>
			</div>
		
			<div class="col-xs-4">
			</div>
			
			<div class="col-xs-3">
				<div class="input-group">
					<input id="shieldSearchInput"  type="text" class="search-query form-control" placeholder="Zoeken" onchange="Shield.searchShields();"/>
                    <span class="input-group-btn">
    	                <button class="btn searchGlyphiconButton" type="button">
    			            <span class=" glyphicon glyphicon-search"></span>
            	        </button>
                    </span>
                </div>
			</div>
		</div>
		@foreach ($shields as $shield)
			<div class="row well equipment_name_row">
				<div class="col-xs-1">
				</div>
				<div id="{{$shield->id}}" class="col-xs-8 detail_name">
					{{ $shield->name }}
				</div>
				<div class="col-xs-1">
					<a href="#" class="btn btn-default btn-shield-{{$shield->id}} btn-update" role="button">Aanpassen</a>
				</div>
				<div class="col-xs-1">
					<a href="#" class="btn btn-default btn-shield-{{$shield->id}} btn-delete" role="button">Verwijderen</a>
				</div>
			</div>
			<div id="shield_detail_{{$shield->id}}" class="row equipment_details">
				<div class="row">
					<div class="col-xs-1">
					</div>
					<div class="col-xs-9">
						{!! Blade::compileString($shield->description); !!}
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
									<td class="detail_rating">{{$shield->price_normal}}</td>
									<td class="detail_rating">{{$shield->price_good}}</td>
									<td class="detail_rating">{{$shield->price_master}}</td>
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
									<td class="detail_rating">{{$shield->armor_normal}}</td>
									<td class="detail_rating">{{$shield->armor_good}}</td>
									<td class="detail_rating">{{$shield->armor_master}}</td>
								</tr>
								<tr>
									<td class="detail_name">Structuur</td>
									<td class="detail_rating">{{$shield->structure_normal}}</td>
									<td class="detail_rating">{{$shield->structure_good}}</td>
									<td class="detail_rating">{{$shield->structure_master}}</td>
								</tr>
							</tbody>		
						</table>
					</div>
				</div>
			</div>
		@endforeach
		
<!-- 	Trick to be able to access the count of shields in the JS below -->
		<div id="shield_size" class="hidden" data-shields="{{ $shields }}" ></div>
		
<!-- 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> -->
<!-- 	    <script src="{{ URL::asset('js/equipment/shield/shield.js') }}"></script> -->
			<script>Shield.addListeners()</script>
 	</div>
@endsection