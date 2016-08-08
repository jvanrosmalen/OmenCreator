<!-- Partial view. No HTML tags -->
	<h3>Regels Toevoegen</h3>
	
	<div class='row well'>
		<div class='col-xs-2'>
			Toegevoegde regels:
		</div>
		<div class='col-xs-10'>
			<div id="added_rules_list" class='col-xs-6 empty'>
				<div>Geen regels geselecteerd</div>
			</div>
			<input id="rules_list_hidden" name="rules_list" class="hidden">
		</div>
	</div>

	<div class='row well'>
		<div class='col-xs-2'>
			Regels Toevoegen:
		</div>
		
<!-- STAT RULES -->
		<?php $statCount=0; ?>
		<div class='col-xs-10'>
			<div id="statrules" class='well innerWell detail_name rule_name_row col-xs-12'>
				Profiel Regels (
					@foreach ($rules['statTypes'] as $statType)
						@if ($statCount != 0)
							,
						@endif
						{{$statType->statistic_name}}
						<?php $statCount++; ?>
					@endforeach
				)
			</div>
		
			<?php $statCount = 0; ?>
			<div id="statistic_rule_details" class="row rule_details">
				@foreach ($rules['statTypes'] as $statType)
					@if (($statCount%2) === 0)
						<div class="row">
					@endif
						<div class="col-xs-1"></div>
						<div class="col-xs-4 innerBlock">
							<div class ="row well innerWell rule_header">{{$statType->statistic_name}}</div>
							<div class ="row">
								@foreach ($rules['statRules'] as $statRule)
									@if(strcasecmp($statRule->statistic->statistic_name, $statType->statistic_name) == 0)
										<div id="statrule_{{$statRule->id}}" class="col-xs-8 rule_line">{{ $statRule->statistic->statistic_name }} {{ $statRule->rulesOperator->operator }} {{ $statRule->value }}</div>
										<div class="col-xs-3">
											<button class="btn btn-default btn-add btn-ruleIncludeAdd-{{$statRule->id}} statRuleIncludeAdd" data-id="{{$statRule->id}}">Toevoegen</button>
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
		</div>
<!-- END STAT RULES		 -->

<!-- RESISTANCE RULES -->
		<?php $statCount=0; ?>
		<div class='col-xs-2'></div>
		
		<div class='col-xs-10'>
			<div id="resrules" class='well innerWell detail_name rule_name_row col-xs-12'>
				Resistentie Regels (
					@foreach ($rules['resTypes'] as $resType)
						@if ($statCount != 0)
							,
						@endif
						{{$resType->resistance_name}}
						<?php $statCount++; ?>
					@endforeach
				)
			</div>
		
			<?php $statCount = 0; ?>
			<div id="resistance_rule_details" class="row rule_details">
				@foreach ($rules['resTypes'] as $resType)
					@if (($statCount%2) === 0)
						<div class="row">
					@endif
						<div class="col-xs-1"></div>
						<div class="col-xs-4 innerBlock">
							<div class ="row well innerWell rule_header">{{$resType->resistance_name}}</div>
							<div class ="row">
								@foreach ($rules['resRules'] as $resRule)
									@if(strcasecmp($resRule->resistance->resistance_name, $resType->resistance_name) == 0)
										<div id="resrule_{{$resRule->id}}" class="col-xs-8 rule_line">{{ $resRule->resistance->resistance_name }} {{ $resRule->rulesOperator->operator }} {{ $resRule->value }}</div>
										<div class="col-xs-3">
											<button class="btn btn-default btn-add btn-ruleIncludeAdd-{{$resRule->id}} resRuleIncludeAdd" data-id="{{$resRule->id}}">Toevoegen</button>
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
		</div>
<!-- END RESISTANCE RULES		 -->

<!-- DAMAGE RULES -->
		<?php $statCount=0; ?>
		<div class='col-xs-2'></div>
		
		<div class='col-xs-10'>
			<div id="damrules" class='well innerWell detail_name rule_name_row col-xs-12'>
				Schade Regels (
					@foreach ($rules['damTypes'] as $damType)
						@if ($statCount != 0)
							,
						@endif
						{{$damType->damage_name}}
						<?php $statCount++; ?>
					@endforeach
				)
			</div>
		
			<?php $statCount = 0; ?>
			<div id="damage_rule_details" class="row rule_details">
				@foreach ($rules['damTypes'] as $damType)
					@if (($statCount%2) === 0)
						<div class="row">
					@endif
						<div class="col-xs-1"></div>
						<div class="col-xs-4 innerBlock">
							<div class ="row well innerWell rule_header">{{$damType->damage_name}}</div>
							<div class ="row">
								@foreach ($rules['damRules'] as $damRule)
									@if(strcasecmp($damRule->damageType->damage_name, $damType->damage_name) == 0)
										<div id="damrule_{{$damRule->id}}" class="col-xs-8 rule_line">{{ $damRule->rulesOperator->operator_name }} {{ $damRule->damageType->damage_name }} schade</div>
										<div class="col-xs-3">
											<button class="btn btn-default btn-add btn-ruleIncludeAdd-{{$damRule->id}} damRuleIncludeAdd" data-id="{{$damRule->id}}">Toevoegen</button>
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
		</div>
<!-- END DAMAGE RULES		 -->

<!-- CALL RULES -->
		<?php $statCount=0; ?>
		<div class='col-xs-2'></div>
		
		<div class='col-xs-10'>
			<div id="callrules" class='well innerWell detail_name rule_name_row col-xs-12'>
				Roepterm Regels (
					@foreach ($rules['callTypes'] as $callType)
						@if ($statCount != 0)
							,
						@endif
						{{$callType->call_name}}
						<?php $statCount++; ?>
					@endforeach
				)
			</div>
		
			<?php $statCount = 0; ?>
			<div id="call_rule_details" class="row rule_details">
				@foreach ($rules['callTypes'] as $callType)
					@if (($statCount%2) === 0)
						<div class="row">
					@endif
						<div class="col-xs-1"></div>
						<div class="col-xs-4 innerBlock">
							<div class ="row well innerWell rule_header">{{$callType->call_name}}</div>
							<div class ="row">
								@foreach ($rules['callRules'] as $callRule)
									@if(strcasecmp($callRule->callType->call_name, $callType->call_name) == 0)
										<div id="callrule_{{$callRule->id}}" class="col-xs-8 rule_line">{{ $callRule->rulesOperator->operator_name }} {{ $callRule->callType->call_name }}</div>
										<div class="col-xs-3">
											<button class="btn btn-default btn-add btn-ruleIncludeAdd-{{$callRule->id}} callRuleIncludeAdd" data-id="{{$callRule->id}}">Toevoegen</button>
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
		</div>
<!-- END CALL RULES		 -->

<!-- WEALTH RULES -->
		<?php $statCount=0; ?>
		<div class='col-xs-2'></div>
		
		<div class='col-xs-10'>
			<div id="wealthrules" class='well innerWell detail_name rule_name_row col-xs-12'>
				Welvaart Regels (Welvaart)
			</div>
		
			<div id="wealth_rule_details" class="row rule_details">		
				<div class="row">
					<div class="col-xs-1"></div>
					<div class="col-xs-4 innerBlock">
						<div class ="row well innerWell rule_header">Welvaart</div>
						<div class ="row">
						@foreach ($rules['wealthRules'] as $wealthRule)
							<div id="wealthrule_{{$wealthRule->id}}" class="col-xs-8 rule_line">{{ $wealthRule->wealth->wealth_name }} {{ $wealthRule->rulesOperator->operator }} {{ $wealthRule->wealthType->wealth_type }}</div>
							<div class="col-xs-3">
								<button class="btn btn-default btn-add btn-ruleIncludeAdd-{{$wealthRule->id}} wealthRuleIncludeAdd" data-id="{{$wealthRule->id}}">Toevoegen</button>
							</div>						
						@endforeach
						</div>
					</div>
					<div class="col-xs-1"></div>
				</div>
			</div>
		</div>
<!-- END WEALTH RULES		 -->
	</div>

	<script>Rule.addListeners()</script>

	<script>Rule.addRulesIncludeListeners()</script>
	
	@if(!($item_rules == null || $item_rules == ""))
		<!-- 	Dirty trick to be able to access the rules of this equipment in the JS below -->
		<div id="item_rules" class="hidden" data-item-rules="{{ $item_rules }}" ></div>
		<script>Rule.addRulesToOverview()</script>
	@endif
	