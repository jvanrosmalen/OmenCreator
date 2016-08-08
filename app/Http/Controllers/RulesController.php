<?php

namespace App\Http\Controllers;

use App\StatisticRule;
use App\ResistanceRule;
use App\Statistic;
use App\RulesOperator;
use App\Resistance;
use App\WealthRule;
use App\DamageRule;
use App\CallRule;
use App\WealthType;
use App\DamageType;
use App\CallType;

class RulesController extends Controller
{
	
	public function showAllRule(){
		$rules = RulesController::getAllRules();
		
		return view('rules/showAllRule',[ 	"statrules"=>$rules['statRules'],
											"statTypes"=>$rules['statTypes'],
											"resrules"=> $rules['resRules'],
											"resTypes"=>$rules['resTypes'],
											"damrules"=> $rules['damRules'],
											"damTypes"=>$rules['damTypes'],
											"callrules"=> $rules['callRules'],
											"callTypes"=> $rules['callTypes'],
											"wealthTypes"=> $rules['wealthTypes'],
											"wealthrules"=> $rules['wealthRules']
										]);
	}
	
	public static function getAllRules(){
		$rules = array();
		
		$rules['statTypes'] = Statistic::all();
		$rules['statRules'] = StatisticRule::all()->sortBy(function($rule)
		{
			return sprintf('%-30s%-5s%-5s', $rule->statistic->statistic_name, $rule->rules_operator, $rule->value );
		});
		
		$rules['resTypes'] = Resistance::all();
		$rules['resRules'] = ResistanceRule::all()->sortBy(function($rule)
		{
			return sprintf('%-30s%-5s%-5s', $rule->resistance->resistance_name, $rule->rules_operator, $rule->value );
		});
		
		$rules['wealthTypes'] = WealthType::all();
		$rules['wealthRules'] = WealthRule::all();
		
		$rules['damTypes'] = DamageType::all();
		$rules['damRules'] = DamageRule::all()->sortBy(function($rule){
			return sprintf('%-30s%-30s', $rule->damageType->damage_name, $rule->rules_operator);
		}); 
		
		$rules['callTypes'] = CallType::all();
		$rules['callRules'] = CallRule::all()->sortBy(function($rule){
			return sprintf('%-30s%-30s', $rule->callType->call_name, $rule->rules_operator);
		});
		
		return $rules;
	}
	
	public function showCreateRule(){
		return view('rules/createRule', [	"statistics"=>Statistic::all(),
											"resistances"=>Resistance::all(),
											"rulesOperators"=>RulesOperator::all()
											]);
	}
	
	public function submitRuleCreate(){
		$postData = $_POST;
		list($ruletype, $statId) = explode("_", $postData["rule_statistic"]);
		
		if(strcasecmp($ruletype, 'statistic') == 0){
			$this->submitRuleCreateStatistic($statId, $postData);
		}else if(strcasecmp($ruletype, 'resistance') == 0){
			$this->submitRuleCreateResistance($statId, $postData);
		}
		
		return $this->gotoShowAllRule();
	}
	
	private function submitRuleCreateStatistic($statId, $postData){
		$newRule = new StatisticRule();
		
		$newRule->statistic_id = $statId;
		$newRule->rules_operator = $postData["rule_operator"];
		$newRule->value = $postData["rule_value"];
		
		$newRule->save();
	}
	
	private function submitRuleCreateResistance($resId, $postData){
		$newRule = new ResistanceRule();
	
		$newRule->resistance_id = $resId;
		$newRule->rules_operator = $postData["rule_operator"];
		$newRule->value = $postData["rule_value"];
	
		$newRule->save();
	}
	
	
	public function showDeleteRuleStatistic($id){
		$rule = StatisticRule::find($id);
		return view('rules/showDeleteRule', ['rule'=>$rule, 'type'=>'statistic']);		
	}

	public function showDeleteRuleResistance($id){
		$rule = ResistanceRule::find($id);
		return view('rules/showDeleteRule', ['rule'=>$rule, 'type'=>'resistance']);
	}
	
	public function deleteRuleStatistic($id = -1){
		$rule = StatisticRule::find($id);
		$rule->delete();
	
		$this->gotoShowAllRule();
	}

	public function deleteRuleResistance($id = -1){
		$rule = ResistanceRule::find($id);
		$rule->delete();
	
		$this->gotoShowAllRule();
	}
	
	public function gotoShowAllRule(){
		$url = route('showall_rule');
		header("Location:".$url);
		die();
	}
}
