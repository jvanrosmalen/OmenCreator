<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    public $timestamps = false;
    
    /**
     * Appends to model definition from the DB
     */
    protected $appends = [	'call_rules',
    		'dam_rules',
    		'res_rules',
    		'stat_rules',
    		'wealth_rules',
    		'race_skills',
    		'lp_torso',
    		'lp_limbs',
    		'willpower',
    		'status',
    		'focus',
    		'trauma',
    		'prohibited_classes',
    		'descent_classes'
    ];
    
    public function race_skills(){
    	return $this->belongsToMany('App\Skill');
    }
    
    public function callRules(){
    	return $this->belongsToMany('App\CallRule');
    }
    
    public function damageRules(){
    	return $this->belongsToMany('App\DamageRule');
    }
    
    public function resistanceRules(){
    	return $this->belongsToMany('App\ResistanceRule');
    }
    
    public function statisticRules(){
    	return $this->belongsToMany('App\StatisticRule');
    }
    
    public function wealthRules(){
    	return $this->belongsToMany('App\WealthRule');
    }
    
    public function prohibitedClasses(){
     	return $this->belongsToMany('App\PlayerClass','prohibited_player_class_race');
    }
    
    public function descentClasses(){
    	return $this->belongsToMany('App\PlayerClass','descent_player_class_race');
    }
    
    /**
     * Functions to return various rules through the model
     * without them being saved in the DB
     */
    public function getCallRulesAttribute()
    {
    	return Race::find($this->id)->callRules()->get();
    }
    
    public function getDamRulesAttribute()
    {
    	return Race::find($this->id)->damageRules()->get();
    }
    
    public function getResRulesAttribute()
    {
    	return Race::find($this->id)->resistanceRules()->get();
    }
    
    public function getStatRulesAttribute()
    {
    	return Race::find($this->id)->statisticRules()->get();
    }
    
    public function getWealthRulesAttribute()
    {
    	return Race::find($this->id)->wealthRules()->get();
    }
    
    // Race Statistics
    public function getLpTorsoAttribute()
    {
 		$basic_value = 3;
    	
    	foreach($this->stat_rules as $stat_rule){
    		if($stat_rule->statisticName() === "Levenspunten"){
	    		if($stat_rule->rules_operator === "+"){
	    			$basic_value += $stat_rule->value;
	    		}
	
	    		if($stat_rule->rules_operator === "-"){
	    			$basic_value -= $stat_rule->value;
	    		}
    		}
    	}
    	
    	return $basic_value;
    }

    public function getLpLimbsAttribute()
    {
 		$basic_value = 2;
    	
    	foreach($this->stat_rules as $stat_rule){
    		if($stat_rule->statisticName() === "Levenspunten"){
	    		if($stat_rule->rules_operator === "+"){
	    			$basic_value += $stat_rule->value;
	    		}
	
	    		if($stat_rule->rules_operator === "-"){
	    			$basic_value -= $stat_rule->value;
	    		}
    		}
    	}
    	
    	return $basic_value;
    }

    public function getWillpowerAttribute()
    {
 		$basic_value = 2;
    	
    	foreach($this->stat_rules as $stat_rule){
    		if($stat_rule->statisticName() === "Wilskracht" ){
	    		if($stat_rule->rules_operator === "+"){
	    			$basic_value += $stat_rule->value;
	    		}
	
	    		if($stat_rule->rules_operator === "-"){
	    			$basic_value -= $stat_rule->value;
	    		}
    		}
    	}
    	
    	return $basic_value;
    }

    public function getStatusAttribute()
    {
 		$basic_value = 0;
    	
    	foreach($this->stat_rules as $stat_rule){
    		if($stat_rule->statisticName() === "Status"){
	    		if($stat_rule->rules_operator === "+"){
	    			$basic_value += $stat_rule->value;
	    		}
	
	    		if($stat_rule->rules_operator === "-"){
	    			$basic_value -= $stat_rule->value;
	    		}
    		}
    	}
    	
    	return $basic_value;
    }

    public function getFocusAttribute()
    {
 		$basic_value = 0;
    	
    	foreach($this->stat_rules as $stat_rule){
    		if( $stat_rule->statisticName() === "Focus" ){
	    		if($stat_rule->rules_operator === "+"){
	    			$basic_value += $stat_rule->value;
	    		}
	
	    		if($stat_rule->rules_operator === "-"){
	    			$basic_value -= $stat_rule->value;
	    		}
    		}
    	}
    	
    	return $basic_value;
    }

    public function getTraumaAttribute()
    {
    	$basic_value = 0;
    	 
    	foreach($this->stat_rules as $stat_rule){
    		if($stat_rule->statisticName() === "Trauma"){
    			if($stat_rule->rules_operator === "+"){
    				$basic_value += $stat_rule->value;
    			}
    	
    			if($stat_rule->rules_operator === "-"){
    				$basic_value -= $stat_rule->value;
    			}
    		}
    	}
    	 
    	return $basic_value;
    }
    
    public function getRaceSkillsAttribute(){
    	return Race::find($this->id)->race_skills()->get();
    }
    
    public function getProhibitedClassesAttribute(){
    	$retArray = array();
    	$resultArray = Race::find($this->id)->prohibitedClasses()->get();
    	
    	foreach($resultArray as $i=>$result){
    		array_push($retArray, $result->class_name);
    	}
    	
    	return $retArray;
    }
    
    public function getDescentClassesAttribute(){
    	$retArray = array();
    	$resultArray = Race::find($this->id)->descentClasses()->get();
    	
    	foreach($resultArray as $i=>$result){
    		array_push($retArray, $result->class_name);
    	}
    	
    	return $retArray;
    }
}
