@extends('layouts.app') @section('content')
<div class='container'>
	<div class="row">
		<div class="col-xs-5">
			<span class="overview_header">Verwijder Ras</span>
		</div>
	</div>

	<div class="row"></div>

	<div class="row well warning-text">
		<div class="col-xs-12">Ben je er zeker van dat je onderstaand ras wilt
			verwijderen uit de database?</div>
	</div>

	<div class="row"></div>

	<div class="row well race_name_row">
		<div class="col-xs-1"></div>
		<div id="{{$race->id}}" class="col-xs-8 detail_name">{{
			$race->race_name }}</div>
	</div>

	<div id="race_detail_{{$race->id}}" class="row">
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-9">{!! Blade::compileString($race->description);
				!!}</div>
		</div>
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-8">
				<table class="table borderless detail_table">
					<thead>
						<tr>
							<th>LP Torso</th>
							<th>LP Ledematen</th>
							<th>Wilskracht</th>
							<th>Status</th>
							<th>Focus</th>
							<th>Trauma</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="detail_rating">{{ $race->lp_torso }}</td>
							<td class="detail_rating">{{ $race->lp_limbs }}</td>
							<td class="detail_rating">{{ $race->willpower }}</td>
							<td class="detail_rating">{{ $race->status }}</td>
							<td class="detail_rating">{{ $race->focus }}</td>
							<td class="detail_rating">{{ $race->trauma }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-6 rule_display">
				<b>Speciale regels:</b><br>
				@foreach($race->dam_rules as $dam_rule)
					{{$dam_rule->toString()}}<br> @endforeach
				@foreach($race->call_rules as $call_rule)
					{{$call_rule->toString()}}<br> @endforeach
				@foreach($race->res_rules as $res_rule)
					{{$res_rule->toString()}}<br> @endforeach
				@foreach($race->stat_rules as $stat_rule)
					{{$stat_rule->toString()}}<br> @endforeach
				@foreach($race->wealth_rules as $wealth_rule)
					{{$wealth_rule->toString()}}<br> @endforeach
			</div>
		</div>

		<div class="row button-row">
			<div class="col-xs-3"></div>
			<div class="col-xs-2">
				<a href="/delete_race/{{ $race->id }}"
					class="btn btn-default" id="cancel_button" type="button"
					style="width: 120px; font-size: 18px;"> Verwijderen </a>
			</div>
			<div class="col-xs-2"></div>
			<div class="col-xs-2">
				<a href="/showall_race" class="btn btn-default"
					id="cancel_button" type="button"
					style="width: 120px; font-size: 18px;"> Cancel </a>
			</div>
		</div>

	</div>
</div>
@endsection
