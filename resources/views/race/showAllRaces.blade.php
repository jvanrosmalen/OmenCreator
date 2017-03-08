@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-6">
				<span class="overview_header">Rassen</span>
				<a href="/create_race" type="button" class="btn btn-default button-add" aria-label="Left Align">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</a>
			</div>
		
			<div class="col-xs-3">
			</div>
			
			<div class="col-xs-3">
				<div class="input-group">
					<input id="raceSearchInput"  type="text" class="search-query form-control" placeholder="Zoeken" onchange="Race.searchRaces();"/>
                    <span class="input-group-btn">
    	                <button class="btn searchGlyphiconButton" type="button">
    			            <span class=" glyphicon glyphicon-search"></span>
            	        </button>
                    </span>
                </div>
			</div>
		</div>
		@foreach ($races as $race)
				<div class="row well race_name_row">
				<div class="col-xs-1">
				</div>
				<div id="{{$race->id}}" class="col-xs-8 detail_name">
					{{ $race->race_name }}
					@if($race->is_player_race)
						 (Spelerras)
					@endif
				</div>
				<div class="col-xs-1">
					<a href="#" class="btn btn-default btn-race-{{$race->id}} btn-update" role="button">Aanpassen</a>
				</div>
				<div class="col-xs-1">
					<a href="#" class="btn btn-default btn-race-{{$race->id}} btn-delete" role="button">Verwijderen</a>
				</div>
			</div>
			<div id="race_detail_{{$race->id}}" class="row race_details">
				<div class="row">
					<div class="col-xs-1">
					</div>
					<div class="col-xs-9">
						{!! Blade::compileString($race->description); !!}
					</div>
				</div>
				
				<div class="row">
					<div class="col-xs-1">
					</div>
					<div class="col-xs-8">
						<table class="table borderless detail_table">
							<thead>
						            <tr>
						                <th>
						                    LP Torso
						                </th>
						                <th>
						                	LP Ledematen
						                </th>
						                <th>
						                	Wilskracht
						                </th>
						                <th>
						                	Status
						                </th>
						                <th>
						                	Focus
						                </th>
						                <th>
						                	Trauma
						                </th>
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
					<div class="col-xs-1">
					</div>
					<div class="col-xs-4 rule_display">
						<b>Speciale regels (zijn al verwerkt in het profiel):</b><br>
						@foreach($race->dam_rules as $dam_rule)
							{{$dam_rule->toString()}}<br>
						@endforeach
						@foreach($race->call_rules as $call_rule)
							{{$call_rule->toString()}}<br>
						@endforeach
						@foreach($race->res_rules as $res_rule)
							{{$res_rule->toString()}}<br>
						@endforeach
						@foreach($race->stat_rules as $stat_rule)
							{{$stat_rule->toString()}}<br>
						@endforeach
						@foreach($race->wealth_rules as $wealth_rule)
							{{$wealth_rule->toString()}}<br>
						@endforeach
					</div>
					<div class="col-xs-1"></div>
					<div class="col-xs-4 rule_display">
						<b>Afkomstklasses</b><br>
						@forelse($race->descent_classes as $descent_class)
						    {{$descent_class}}<br>
						@empty
						    Geen afkomstklasses<br>
						@endforelse
					</div>
				</div>
				
				<br>
				
				<div class="row">
					<div class="col-xs-1">
					</div>
					<div class="col-xs-4 rule_display">
						<b>Rasvaardigheden:</b><br>
						@foreach($race->race_skills as $race_skill)
							{{$race_skill->name}}<br>
						@endforeach
					</div>
					<div class="col-xs-1"></div>
					<div class="col-xs-4 rule_display">
						<b>Verboden klasses</b><br>
						@forelse($race->prohibited_classes as $prohibited_class)
						    {{$prohibited_class}}<br>
						@empty
						    Geen verboden klassen<br>
						@endforelse
					</div>
				</div>
				
				<br>
				
			</div>
		@endforeach
		
<!-- 	Trick to be able to access the count of race in the JS below -->
		<div id="race_size" class="hidden" data-races="{{ $races }}" ></div>
		
		<script>Race.addListeners()</script>
 	</div>
@endsection