<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SkillRulesEquipmentPivots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create ( 'call_rule_skill', function (Blueprint $table) {
			$table->integer( 'skill_id' )->unsigned()->index();
			$table->integer( 'call_rule_id' )->unsigned()->index();
		} );
		
		Schema::table('call_rule_skill', function(Blueprint $table){
			$table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
			$table->foreign('call_rule_id')->references('id')->on('call_rules')->onDelete('cascade');
		});

		Schema::create ( 'damage_rule_skill', function (Blueprint $table) {
			$table->integer( 'skill_id' )->unsigned()->index();
			$table->integer( 'damage_rule_id' )->unsigned()->index();
		} );
		
		Schema::table('damage_rule_skill', function(Blueprint $table){
			$table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
			$table->foreign('damage_rule_id')->references('id')->on('damage_rules')->onDelete('cascade');
		});
			
		Schema::create ( 'resistance_rule_skill', function (Blueprint $table) {
			$table->integer( 'skill_id' )->unsigned()->index();
			$table->integer( 'resistance_rule_id' )->unsigned()->index();
		} );
		
		Schema::table('resistance_rule_skill', function(Blueprint $table){
			$table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
			$table->foreign('resistance_rule_id')->references('id')->on('resistance_rules')->onDelete('cascade');
		});

		Schema::create ( 'skill_statistic_rule', function (Blueprint $table) {
			$table->integer( 'skill_id' )->unsigned()->index();
			$table->integer( 'statistic_rule_id' )->unsigned()->index();
		} );
		
		Schema::table('skill_statistic_rule', function(Blueprint $table){
			$table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
			$table->foreign('statistic_rule_id')->references('id')->on('statistic_rules')->onDelete('cascade');
		});
		
		Schema::create ( 'skill_wealth_rule', function (Blueprint $table) {
			$table->integer( 'skill_id' )->unsigned()->index();
			$table->integer( 'wealth_rule_id' )->unsigned()->index();
		} );
		
		Schema::table('skill_wealth_rule', function(Blueprint $table){
			$table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
			$table->foreign('wealth_rule_id')->references('id')->on('wealth_rules')->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::drop('call_rule_skill');
    	Schema::drop('damage_rule_skill');
    	Schema::drop('resistance_rule_skill');
    	Schema::drop('skill_statistic_rule');
    	Schema::drop('skill_wealth_rule');
    }
}
