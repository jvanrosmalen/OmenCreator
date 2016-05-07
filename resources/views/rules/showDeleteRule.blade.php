@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<span class="overview_header">Verwijder Bonusregel</span>
			</div>
		</div>

		<div class="row">
		</div>
		
		<div class="row well warning-text">
			<div class="col-xs-12">
				Ben je er zeker van dat je onderstaande regel wilt verwijderen
				uit de database?
			</div>		
		</div>

		<div class="row">
		</div>
		
		<div class="row">
			<div class="row">
				<div class="col-xs-1">
				</div>
				<div class="col-xs-9 rule_line">
					@if(strcasecmp($type, "statistic")==0)
								{{ $rule->statistic->statistic_name }}
								{{ $rule->rulesOperator->operator }}
								{{ $rule->value }}
					@endif
				</div>
			</div>
			
			<div class="row button-row">
				<div class="col-xs-3"></div>
				<div class="col-xs-2">
					<a href="/delete_rule_{{$type}}/{{ $rule->id }}" class="btn btn-default" id="cancel_button" type="button"	style="width: 120px; font-size: 18px;">
					Verwijderen
					</a>
				</div>
				<div class="col-xs-2"></div>
				<div class="col-xs-2">
					<a href="/showall_rule" class="btn btn-default" id="cancel_button" type="button"	style="width: 120px; font-size: 18px;">
					Cancel
					</a>
				</div>
			</div>
			
		</div>
 	</div>
@endsection