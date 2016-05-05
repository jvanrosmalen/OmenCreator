@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<span class="overview_header">Verwijder Pantser</span>
			</div>
		</div>

		<div class="row">
		</div>
		
		<div class="row well warning-text">
			<div class="col-xs-12">
				Ben je er zeker van dat je onderstaande pantser wilt verwijderen
				uit de database?
			</div>		
		</div>

		<div class="row">
		</div>
		
		<div class="row well equipment_name_row">
			<div class="col-xs-1">
			</div>
			<div id="{{$armor->id}}" class="col-xs-8 detail_name">
				{{ $armor->name }}
			</div>
		</div>
		
		<div id="armor_detail_{{$armor->id}}" class="row">
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
			
			<div class="row button-row">
				<div class="col-xs-3"></div>
				<div class="col-xs-2">
					<a href="/delete_armor/{{ $armor->id }}" class="btn btn-default" id="cancel_button" type="button"	style="width: 120px; font-size: 18px;">
					Verwijderen
					</a>
				</div>
				<div class="col-xs-2"></div>
				<div class="col-xs-2">
					<a href="/showall_armor" class="btn btn-default" id="cancel_button" type="button"	style="width: 120px; font-size: 18px;">
					Cancel
					</a>
				</div>
			</div>
			
		</div>
 	</div>
@endsection