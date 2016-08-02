@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class='row'>
			<div class='col-xs-12'>
					<h3>Cre&euml;er Nieuwe Bonusregel</h3>
			</div>
		</div>
	
		<form action="/create_rule_submit" method="POST">
			<div class="row well">
				<div class="col-xs-2">Regeldefinitie</div>
				<div class="col-xs-4">
					<table class="table borderless">
				        <thead>
				            <tr>
				                <th>
				                    Statistiek
				                </th>
				                <th>
				                	Operator
				                </th>
				                <th>
				                	Waarde
				                </th>
				            </tr>
				        </thead>
				        
				        <tbody>
				        	<tr>
				        		<td>
				        			<select id="rule_statistic" name="rule_statistic" onfocus="Rule.hideNameWarning()">
				        				@foreach($statistics as $statistic)
				        				<option value="statistic_{{$statistic->id}}">{{$statistic->statistic_name}}</option>
				        				@endforeach
				        				@foreach($resistances as $resistance)
				        				<option value="resistance_{{$resistance->id}}">{{$resistance->resistance_name}} Resistentie</option>
				        				@endforeach
				        			</select>
				        		</td>
				        		<td>
				        			<select id="rule_operator" name="rule_operator" onfocus="Rule.hideNameWarning()">
				        				@foreach($rulesOperators as $rulesOperator)
				        				<option class="operator" value="{{$rulesOperator->operator}}">{{$rulesOperator->operator}}</option>
				        				@endforeach
				        			</select>
				        		</td>
				        		<td>
				        			<input id="rule_value" type="text" name="rule_value" style="width: 100%;" value="" onfocus="Rule.hideNameWarning()">
				        		</td>
				        	</tr>
				        </tbody>					
					</table>
				</div>
				
				<div class='col-xs-1'></div>
				
				<div class='col-xs-4 rule_warning hidden'>Deze regel bestaat al. Kies een andere.</div>
			</div>
	
			<div class="row button-row">
				<div class="col-xs-3"></div>
				<div class="col-xs-2">
					<input class="btn btn-default" id="submit_button" type="submit" value="Cre&euml;er"
						style="width: 120px; font-size: 18px;">
				</div>
				<div class="col-xs-2"></div>
				<div class="col-xs-2">
					<a href="/showall_rule" class="btn btn-default" id="cancel_button" type="button"	style="width: 120px; font-size: 18px;">
					Cancel
					</a>
				</div>
			</div>
		
		</form>
	</div>
	
	<script>
		Rule.addCreateListeners();
		Rule.sortOptionsInSelect("rule_statistic");
	</script>
@endsection