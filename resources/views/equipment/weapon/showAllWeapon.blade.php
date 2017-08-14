@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<span class="overview_header">Overzicht Wapens</span>
				@if($user->is_admin || $user->is_system_rep)
				<a href="/create_weapon" type="button" class="btn btn-default button-add" aria-label="Left Align">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</a>
				@endif
			</div>
		
			<div class="col-xs-4">
			</div>
			
			<div class="col-xs-3">
				<div class="input-group">
					<input id="weaponSearchInput"  type="text" class="search-query form-control" placeholder="Zoeken" onchange="Weapon.searchWeapons();"/>
                    <span class="input-group-btn">
    	                <button class="btn searchGlyphiconButton" type="button">
    			            <span class=" glyphicon glyphicon-search"></span>
            	        </button>
                    </span>
                </div>
			</div>
		</div>
		@foreach ($weapons as $weapon)
			<div class="row well equipment_name_row">
				<div class="col-xs-1">
				</div>
				<div id="{{$weapon->id}}" class="col-xs-8 detail_name">
					{{ $weapon->name }}
				</div>
				@if($user->is_admin || $user->is_system_rep)
				<div class="col-xs-1">
					<a href="#" class="btn btn-default btn-weapon-{{$weapon->id}} btn-update" role="button">Aanpassen</a>
				</div>
				<div class="col-xs-1">
					<a href="#" class="btn btn-default btn-weapon-{{$weapon->id}} btn-delete" role="button">Verwijderen</a>
				</div>
				@endif
			</div>
			<div id="weapon_detail_{{$weapon->id}}" class="row equipment_details">
				<div class="row">
					<div class="col-xs-1">
					</div>
					<div class="col-xs-9">
						{!! Blade::compileString($weapon->description); !!}
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
									<td class="detail_rating">{{$weapon->price_normal}}</td>
									<td class="detail_rating">{{$weapon->price_good}}</td>
									<td class="detail_rating">{{$weapon->price_master}}</td>
								</tr>
							</tbody>		
						</table>
					</div>
				</div>
			</div>
		@endforeach
		
<!-- 	Trick to be able to access the count of weapons in the JS below -->
		<div id="weapon_size" class="hidden" data-weapons="{{ $weapons }}" ></div>
		
			<script>Weapon.addListeners()</script>
 	</div>
@endsection