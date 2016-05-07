<?php

namespace App\Http\Controllers;

use App\StatisticRule;
use App\Statistic;
use App\RulesOperator;

class RulesController extends Controller
{
	protected $table = 'statisticRules';
	
	public function showAllRule(){
 		$statRules = StatisticRule::all();
// 		echo "$statRules";
// 		$test = StatisticRule::find($statRules[0]->id)->rulesOperator;
// 		echo "test1: ".$test;
// 		echo "<br>";
// 		$test = StatisticRule::find($statRules[0]->id)->statistic;
// 		echo "test2: ".$test;
// 		echo "<br>";
		$statRules = StatisticRule::all()->sortBy(function($rule)
		{
			return sprintf('%-30s%-5s%-5s', $rule->statistic->statistic_name, $rule->rulesOperator, $rule->value );
		});
		return view('rules/showAllRule', [ "statrules"=>$statRules]);
	}
	
	public function showCreateRule(){
		return view('rules/createRule', ["statistics"=>Statistic::all(),
											"rulesOperators"=>RulesOperator::all()
											]);
	}
	
	public function submitRuleCreate(){
		$postData = $_POST;
		list($ruletype, $statId) = explode("_", $postData["rule_statistic"]);
		
		if(strcasecmp($ruletype, 'statistic') == 0){
			$this->submitRuleCreateStatistic($statId, $postData);
		}
		
		return $this->gotoShowAllRule();
	}
	
	private function submitRuleCreateStatistic($statId, $postData){
		$newRule = new StatisticRule();
		
		$newRule->Statistics_id = $statId;
		$newRule->rulesOperator = $postData["rule_operator"];
		$newRule->value = $postData["rule_value"];
		
		$newRule->save();
	}
	
	public function showDeleteRuleStatistic($id){
		$rule = StatisticRule::find($id);
		return view('rules/showDeleteRule', ['rule'=>$rule, 'type'=>'statistic']);		
	}
	
	public function deleteRuleStatistic($id = -1){
		$rule = StatisticRule::find($id);
		$rule->delete();
	
		$this->gotoShowAllRule();
	}
	
	public function gotoShowAllRule(){
		$url = route('showall_rule');
		header("Location:".$url);
		die();
	}
}
