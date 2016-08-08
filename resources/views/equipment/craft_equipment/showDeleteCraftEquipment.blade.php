@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<span class="overview_header">Verwijder Ambachtsuitrusting</span>
			</div>
		</div>

		<div class="row">
		</div>
		
		<div class="row well warning-text">
			<div class="col-xs-12">
				Ben je er zeker van dat je onderstaande ambachtsuitrusting wilt verwijderen
				uit de database?
			</div>		
		</div>

		<div class="row">
		</div>
		
		<div class="row well equipment_name_row">
			<div class="col-xs-1">
			</div>
			<div id="{{$craft_equipment->id}}" class="col-xs-8 detail_name">
				{{ $craft_equipment->name }}
			</div>
		</div>
		
		<div id="craft_equipment_detail_{{$craft_equipment->id}}" class="row">
			<div class="row">
				<div class="col-xs-1">
				</div>
				<div class="col-xs-9">
					{!! Blade::compileString($craft_equipment->description); !!}
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
								<td class="detail_rating">{{$craft_equipment->price}}</td>
								<td class="detail_rating">Nvt</td>
								<td class="detail_rating">Nvt</td>
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
						@foreach($craft_equipment->dam_rules as $dam_rule)
							{{$dam_rule->toString()}}<br>
						@endforeach
						@foreach($craft_equipment->call_rules as $call_rule)
							{{$call_rule->toString()}}<br>
						@endforeach
						@foreach($craft_equipment->res_rules as $res_rule)
							{{$res_rule->toString()}}<br>
						@endforeach
						@foreach($craft_equipment->stat_rules as $stat_rule)
							{{$stat_rule->toString()}}<br>
						@endforeach
						@foreach($craft_equipment->wealth_rules as $wealth_rule)
							{{$wealth_rule->toString()}}<br>
						@endforeach
					</div>
				</div>
					
			<div class="row button-row">
				<div class="col-xs-3"></div>
				<div class="col-xs-2">
					<a href="/delete_craft_equipment/{{ $craft_equipment->id }}" class="btn btn-default" id="cancel_button" type="button"	style="width: 120px; font-size: 18px;">
					Verwijderen
					</a>
				</div>
				<div class="col-xs-2"></div>
				<div class="col-xs-2">
					<a href="/showall_craft_equipment" class="btn btn-default" id="cancel_button" type="button"	style="width: 120px; font-size: 18px;">
					Cancel
					</a>
				</div>
			</div>
			
		</div>
 	</div>
@endsection