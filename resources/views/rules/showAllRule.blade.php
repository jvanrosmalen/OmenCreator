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

<!-- STATISTIC RULES		 -->
		<?php $statCount = 0; ?>
		<div id="statrules" class="row well rule_name_row">
			<div class="col-xs-1">
			</div>
			<div class="col-xs-9 detail_name">
				Profiel Regels (
					@foreach ($statTypes as $statType)
						@if ($statCount != 0)
							,
						@endif
						{{$statType->statistic_name}}
						<?php $statCount++; ?>
					@endforeach
				)
			</div>
		</div>

		<?php $statCount = 0; ?>
		<div id="statistic_rule_details" class="row rule_details">
			@foreach ($statTypes as $statType)
				@if (($statCount%2) === 0)
					<div class="row">
				@endif
					<div class="col-xs-1"></div>
					<div class="col-xs-4">
						<div class ="row well rule_header">{{$statType->statistic_name}}</div>
						<div class ="row">
							@foreach ($statrules as $statRule)
								@if(strcasecmp($statRule->statistic->statistic_name, $statType->statistic_name) == 0)
									<div id="statrule_{{$statRule->id}}" class="col-xs-7 rule_line">
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
				@if (($statCount%2) === 1)
					</div>
				@endif
				
				<?php $statCount++;?>
			@endforeach
		</div>
		
<!-- 		RESISTANCE RULES -->
		<?php $statCount = 0; ?>
		<div id="resrules" class="row well rule_name_row">
			<div class="col-xs-1">
			</div>
			<div class="col-xs-9 detail_name">
				Resistentie Regels (
					@foreach ($resTypes as $resType)
						@if ($statCount != 0)
							,
						@endif
						{{$resType->resistance_name}}
						<?php $statCount++; ?>
					@endforeach
				)
			</div>
		</div>

		<?php $statCount = 0; ?>
		<div id="resistance_rule_details" class="row rule_details">
			@foreach ($resTypes as $resType)
				@if (($statCount%2) === 0)
					<div class="row">
				@endif
					<div class="col-xs-1"></div>
					<div class="col-xs-4">
						<div class ="row well rule_header">{{$resType->resistance_name}}</div>
						<div class ="row">
							@foreach ($resrules as $resRule)
								@if(strcasecmp($resRule->resistance->resistance_name, $resType->resistance_name) == 0)
									<div id="resrule_{{$resRule->id}}" class="col-xs-7 rule_line">
										{{ $resRule->resistance->resistance_name }}
										{{ $resRule->rulesOperator->operator }}
										{{ $resRule->value }}
									</div>
									<div class="col-xs-3">
										<a href="/show_delete_rule_resistance/{{$resRule->id}}" class="btn btn-default btn-delete" role="button">Verwijderen</a>
									</div>						
								@endif
							@endforeach
						</div>
					</div>
				@if (($statCount%2) === 1)
					</div>
				@endif
				
				<?php $statCount++;?>
			@endforeach
		</div>
<!-- 	END RESISTANCE RULES -->


<!-- 	DAMAGE RULES -->
		<?php $statCount = 0; ?>
		<div id="damrules" class="row well rule_name_row">
			<div class="col-xs-1">
			</div>
			<div class="col-xs-9 detail_name">
				Schade Regels (
					@foreach ($damTypes as $damType)
						@if ($statCount != 0)
							,
						@endif
						{{$damType->damage_name}}
						<?php $statCount++; ?>
					@endforeach
				)
			</div>
		</div>

		<?php $statCount = 0; ?>
		<div id="damage_rule_details" class="row rule_details">
			@foreach ($damTypes as $damType)
				@if (($statCount%2) === 0)
					<div class="row">
				@endif
					<div class="col-xs-1"></div>
					<div class="col-xs-4">
						<div class ="row well rule_header">{{$damType->damage_name}}</div>
						<div class ="row">
							@foreach ($damrules as $damRule)
								@if(strcasecmp($damRule->damageType->damage_name, $damType->damage_name) == 0)
									<div id="damrule_{{$damRule->id}}" class="col-xs-12 rule_line">
										{{ $damRule->rulesOperator->operator_name }}
										{{ $damRule->damageType->damage_name }}
										schade
									</div>
								@endif
							@endforeach
						</div>
					</div>
				@if (($statCount%2) === 1)
					</div>
				@endif
				
				<?php $statCount++;?>
			@endforeach
		</div>
<!-- 	END DAMAGE RULES -->

<!-- 	CALL RULES -->
		<?php $statCount = 0; ?>
		<div id="callrules" class="row well rule_name_row">
			<div class="col-xs-1">
			</div>
			<div class="col-xs-9 detail_name">
				Roepterm Regels (
					@foreach ($callTypes as $callType)
						@if ($statCount != 0)
							,
						@endif
						{{$callType->call_name}}
						<?php $statCount++; ?>
					@endforeach
				)
			</div>
		</div>

		<?php $statCount = 0; ?>
		<div id="call_rule_details" class="row rule_details">
			@foreach ($callTypes as $callType)
				@if (($statCount%2) === 0)
					<div class="row">
				@endif
					<div class="col-xs-1"></div>
					<div class="col-xs-4">
						<div class ="row well rule_header">{{$callType->call_name}}</div>
						<div class ="row">
							@foreach ($callrules as $callRule)
								@if(strcasecmp($callRule->callType->call_name, $callType->call_name) == 0)
									<div id="callrule_{{$callRule->id}}" class="col-xs-12 rule_line">
										{{ $callRule->rulesOperator->operator_name }}
										{{ $callRule->callType->call_name }}
									</div>
								@endif
							@endforeach
						</div>
					</div>
				@if (($statCount%2) === 1)
					</div>
				@endif
				
				<?php $statCount++;?>
			@endforeach
		</div>
<!-- 	END CALL RULES -->
	
<!-- 	WEALTH RULES -->
		<div id="wealthrules" class="row well rule_name_row">
			<div class="col-xs-1">
			</div>
			<div class="col-xs-8 detail_name">
				Welvaart Regels (Welvaart)
			</div>
		</div>

		<div id="wealth_rule_details" class="row rule_details">		
			<div class="row">
				<div class="col-xs-1"></div>
				<div class="col-xs-9">
					<div class ="row well rule_header">Welvaart</div>
					<div class ="row">
					@foreach ($wealthrules as $wealthRule)
						<div id="wealthrule_{{$wealthRule->id}}" class="col-xs-7 rule_line">
							{{ $wealthRule->wealth->wealth_name }}
							{{ $wealthRule->rulesOperator->operator }}
							{{ $wealthRule->wealthType->wealth_type }}
						</div>
					@endforeach
					</div>
				</div>
				<div class="col-xs-1"></div>
			</div>
		</div>
		
<!-- 	END WEALTH RULES -->

	</div>
		
	<script>Rule.addListeners()</script>
@endsection