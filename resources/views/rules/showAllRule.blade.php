@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<span class="overview_header">Overzicht Bonusregels</span>
				<a href="/create_rule" type="button" class="btn btn-default button-add" aria-label="Left Align">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</a>
			</div>
		</div>
		
		<div class="row well rule_name_row">
			<div class="col-xs-1">
			</div>
			<div id="statrules" class="col-xs-8 detail_name">
				Profiel Regels (Levenspunten, Wilskracht, Status, Focus)
			</div>
		</div>

		<div id="statistic_rule_details" class="row rule_details">		
			<div class="row">
				<div class="col-xs-1"></div>
				<div class="col-xs-5">
					<div class ="row well rule_header">Levenspunten</div>
					<div class ="row">
					@foreach ($statrules as $statRule)
						@if(strcasecmp($statRule->statistic->statistic_name, 'levenspunten') == 0)
							<div id="statrule_{{$statRule->id}}" class="col-xs-9 rule_line">
								{{ $statRule->statistic->statistic_name }}
								{{ $statRule->rulesOperator->operator }}
								{{ $statRule->value }}
							</div>
							<div class="col-xs-3">
								<a href="/show_delete_rule_statistic/{{$statRule->id}}" class="btn btn-default btn-delete" role="button">Verwijderen</a>
							</div>						
						@endif
					@endforeach
					</div>
				</div>
				<div class="col-xs-1"></div>
				<div class="col-xs-5">
					<div class ="row well rule_header">Wilskracht</div>
					<div class ="row">
					@foreach ($statrules as $statRule)
						@if(strcasecmp($statRule->statistic->statistic_name, 'wilskracht') == 0)
							<div id="statrule_{{$statRule->id}}" class="col-xs-9 rule_line">
								{{ $statRule->statistic->statistic_name }}
								{{ $statRule->rulesOperator->operator }}
								{{ $statRule->value }}
							</div>
							<div class="col-xs-3">
								<a href="/show_delete_rule_statistic/{{$statRule->id}}" class="btn btn-default btn-delete" role="button">Verwijderen</a>
							</div>						
						@endif
					@endforeach
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-1"></div>
				<div class="col-xs-5">
					<div class ="row well rule_header">Status</div>
					<div class ="row">
					@foreach ($statrules as $statRule)
						@if(strcasecmp($statRule->statistic->statistic_name, 'status') == 0)
							<div id="statrule_{{$statRule->id}}" class="col-xs-9 rule_line">
								{{ $statRule->statistic->statistic_name }}
								{{ $statRule->rulesOperator->operator }}
								{{ $statRule->value }}
							</div>
							<div class="col-xs-3">
								<a href="/show_delete_rule_statistic/{{$statRule->id}}" class="btn btn-default btn-delete" role="button">Verwijderen</a>
							</div>						
						@endif
					@endforeach
					</div>
				</div>
				<div class="col-xs-1"></div>
				<div class="col-xs-5">
					<div class ="row well rule_header">Focus</div>
					<div class ="row">
					@foreach ($statrules as $statRule)
						@if(strcasecmp($statRule->statistic->statistic_name, 'focus') == 0)
							<div id="statrule_{{$statRule->id}}" class="col-xs-9 rule_line">
								{{ $statRule->statistic->statistic_name }}
								{{ $statRule->rulesOperator->operator }}
								{{ $statRule->value }}
							</div>
							<div class="col-xs-3">
								<a href="/show_delete_rule_statistic/{{$statRule->id}}" class="btn btn-default btn-delete" role="button">Verwijderen</a>
							</div>						
						@endif
					@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<script>Rule.addListeners()</script>
@endsection