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
		<div id="statrules" class="row well rule_name_row">
			<div class="col-xs-1">
			</div>
			<div class="col-xs-9 detail_name">
				Profiel Regels (Levenspunten, Wilskracht, Status, Focus)
			</div>
		</div>

		<div id="statistic_rule_details" class="row rule_details">		
			<div class="row">
				<div class="col-xs-1"></div>
				<div class="col-xs-4">
					<div class ="row well rule_header">Levenspunten</div>
					<div class ="row">
					@foreach ($statrules as $statRule)
						@if(strcasecmp($statRule->statistic->statistic_name, 'levenspunten') == 0)
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
				<div class="col-xs-1"></div>
				<div class="col-xs-4">
					<div class ="row well rule_header">Wilskracht</div>
					<div class ="row">
					@foreach ($statrules as $statRule)
						@if(strcasecmp($statRule->statistic->statistic_name, 'wilskracht') == 0)
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
			</div>
			<div class="row">
				<div class="col-xs-1"></div>
				<div class="col-xs-4">
					<div class ="row well rule_header">Status</div>
					<div class ="row">
					@foreach ($statrules as $statRule)
						@if(strcasecmp($statRule->statistic->statistic_name, 'status') == 0)
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
				<div class="col-xs-1"></div>
				<div class="col-xs-4">
					<div class ="row well rule_header">Focus</div>
					<div class ="row">
					@foreach ($statrules as $statRule)
						@if(strcasecmp($statRule->statistic->statistic_name, 'focus') == 0)
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
			</div>
		</div>
		
<!-- 		RESISTANCE RULES -->
		<div id="resrules" class="row well rule_name_row">
			<div class="col-xs-1">
			</div>
			<div class="col-xs-8 detail_name">
				Resistentie Regels (Angst, Diefstal, Trauma, Gif, Magie, Ziekte)
			</div>
		</div>

		<div id="resistance_rule_details" class="row rule_details">		
			<div class="row">
				<div class="col-xs-1"></div>
				<div class="col-xs-4">
					<div class ="row well rule_header">Angst</div>
					<div class ="row">
					@foreach ($resrules as $resRule)
						@if(strcasecmp($resRule->resistance->resistance_name, 'angst') == 0)
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
				<div class="col-xs-1"></div>
				<div class="col-xs-4">
					<div class ="row well rule_header">Diefstal</div>
					<div class ="row">
					@foreach ($resrules as $resRule)
						@if(strcasecmp($resRule->resistance->resistance_name, 'diefstal') == 0)
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
			</div>
			<div class="row">
				<div class="col-xs-1"></div>
				<div class="col-xs-4">
					<div class ="row well rule_header">Trauma</div>
					<div class ="row">
					@foreach ($resrules as $resRule)
						@if(strcasecmp($resRule->resistance->resistance_name, 'trauma') == 0)
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
				<div class="col-xs-1"></div>
				<div class="col-xs-4">
					<div class ="row well rule_header">Gif</div>
					<div class ="row">
					@foreach ($resrules as $resRule)
						@if(strcasecmp($resRule->resistance->resistance_name, 'gif') == 0)
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
			</div>
			<div class="row">
				<div class="col-xs-1"></div>
				<div class="col-xs-4">
					<div class ="row well rule_header">Magie</div>
					<div class ="row">
					@foreach ($resrules as $resRule)
						@if(strcasecmp($resRule->resistance->resistance_name, 'magie') == 0)
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
				<div class="col-xs-1"></div>
				<div class="col-xs-4">
					<div class ="row well rule_header">Ziekte</div>
					<div class ="row">
					@foreach ($resrules as $resRule)
						@if(strcasecmp($resRule->resistance->resistance_name, 'ziekte') == 0)
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
			</div>
		</div>

<!-- 	DAMAGE RULES -->
		<div id="damrules" class="row well rule_name_row">
			<div class="col-xs-1">
			</div>
			<div class="col-xs-8 detail_name">
				Schade Regels (Vuur, Zuur, Magische, Niet-magische)
			</div>
		</div>

		<div id="damage_rule_details" class="row rule_details">		
			<div class="row">
				<div class="col-xs-1"></div>
				<div class="col-xs-4">
					<div class ="row well rule_header">Vuur</div>
					<div class ="row">
					@foreach ($damrules as $damRule)
						@if(strcasecmp($damRule->damageType->damage_name, 'vuur') == 0)
							<div id="damrule_{{$damRule->id}}" class="col-xs-12 rule_line">
								{{ $damRule->rulesOperator->operator_name }}
								{{ $damRule->damageType->damage_name }}
								schade
							</div>
						@endif
					@endforeach
					</div>
				</div>
				<div class="col-xs-1"></div>
				<div class="col-xs-4">
					<div class ="row well rule_header">Zuur</div>
					<div class ="row">
					@foreach ($damrules as $damRule)
						@if(strcasecmp($damRule->damageType->damage_name, 'zuur') == 0)
							<div id="damrule_{{$damRule->id}}" class="col-xs-12 rule_line">
								{{ $damRule->rulesOperator->operator_name }}
								{{ $damRule->damageType->damage_name }}
								schade
							</div>
						@endif
					@endforeach
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-1"></div>
				<div class="col-xs-4">
					<div class ="row well rule_header">Magisch</div>
					<div class ="row">
					@foreach ($damrules as $damRule)
						@if(strcasecmp($damRule->damageType->damage_name, 'magische') == 0)
							<div id="damrule_{{$damRule->id}}" class="col-xs-12 rule_line">
								{{ $damRule->rulesOperator->operator_name }}
								{{ $damRule->damageType->damage_name }}
								schade
							</div>
						@endif
					@endforeach
					</div>
				</div>
				<div class="col-xs-1"></div>
				<div class="col-xs-4">
					<div class ="row well rule_header">Niet-magische</div>
					<div class ="row">
					@foreach ($damrules as $damRule)
						@if(strcasecmp($damRule->damageType->damage_name, 'niet-magische') == 0)
							<div id="damrule_{{$damRule->id}}" class="col-xs-12 rule_line">
								{{ $damRule->rulesOperator->operator_name }}
								{{ $damRule->damageType->damage_name }}
								schade
							</div>
						@endif
					@endforeach
					</div>
				</div>
			</div>
		</div>
<!-- 	END DAMAGE RULES -->
	
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