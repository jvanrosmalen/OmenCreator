<?php

namespace App\Http\Controllers;

use App\StatisticRule;
use App\ResistanceRule;
use App\Statistic;
use App\RulesOperator;
use App\Resistance;
use App\WealthRule;

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
		
		$resRules = ResistanceRule::all()->sortBy(function($rule)
		{
			return sprintf('%-30s%-5s%-5s', $rule->resistance->resistance_name, $rule->rulesOperator, $rule->value );
		});
		
// 		$wealthRules = WealthRule::all()->sortBy(function($rule){
// 			return sprintf(	'%-30s%-5s%-5i', 'Welvaart', $rule->rulesOperator, $rule->valueType_id );
// 		});
		
		$wealthRules = WealthRule::all();
		
		return view('rules/showAllRule', [ "statrules"=>$statRules, "resrules"=> $resRules, "wealthrules"=> $wealthRules]);
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
		
		$newRule->Statistics_id = $statId;
		$newRule->rulesOperator = $postData["rule_operator"];
		$newRule->value = $postData["rule_value"];
		
		$newRule->save();
	}
	
	private function submitRuleCreateResistance($resId, $postData){
		$newRule = new ResistanceRule();
	
		$newRule->Resistances_id = $resId;
		$newRule->rulesOperator = $postData["rule_operator"];
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
