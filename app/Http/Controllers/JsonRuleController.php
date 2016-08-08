<?php

namespace App\Http\Controllers;

use Request;
use Response;
use App\StatisticRule;
use App\ResistanceRule;

class JsonRuleController extends Controller
{
	public function ruleExistsStatistic(){
		// True means the rule already exists.
		$statId = -1;
		$operatorId = -1;
		$value = -1;
		$retBool = false;
		
		if(Request::has('rule_statistic')){
			$statId = Request::input('rule_statistic');
		}
		
		if(Request::has('rule_operator')){
			$operatorId = Request::input('rule_operator');
		}
		
		if(Request::has('rule_value')){
			$value = Request::input('rule_value');
		}
		
		$rules = StatisticRule::where('statistic_id', '=', $statId)
								->where('rules_operator', '=', $operatorId)
								->where('value', '=', $value)->get();
		
		if(sizeof($rules)>0){
			$retBool = true;
		}
		
		return Response::json(json_encode($retBool));
	}
	
	public function ruleExistsResistance(){
		// True means the rule already exists.
		$resId = -1;
		$operatorId = -1;
		$value = -1;
		$retBool = false;
	
		if(Request::has('rule_statistic')){
			$resId = Request::input('rule_statistic');
		}
	
		if(Request::has('rule_operator')){
			$operatorId = Request::input('rule_operator');
		}
	
		if(Request::has('rule_value')){
			$value = Request::input('rule_value');
		}
	
		$rules = ResistanceRule::where('resistance_id', '=', $resId)
		->where('rules_operator', '=', $operatorId)
		->where('value', '=', $value)->get();
	
		if(sizeof($rules)>0){
			$retBool = true;
		}
	
		return Response::json(json_encode($retBool));
	}
}
