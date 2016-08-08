<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EquipmentCraft extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create ( 'call_types', function (Blueprint $table) {
    		$table->increments('id')->index();
    		$table->string ( 'call_name', 25 );
    	} );
    	
   		// Seed the CallTypes table
   		DB::table ( 'call_types' )->insert ( array (
			'call_name' => 'Angst'
   		) );
    	DB::table ( 'call_types' )->insert ( array (
   			'call_name' => 'Bevel'
   		) );
    	DB::table ( 'call_types' )->insert ( array (
    		'call_name' => 'Bloeding'
    	) );
    	DB::table ( 'call_types' )->insert ( array (
    		'call_name' => 'Bottenbreker'
    	) );
    	DB::table ( 'call_types' )->insert ( array (
    		'call_name' => 'Door Pantser'
    	) );
    	DB::table ( 'call_types' )->insert ( array (
   			'call_name' => 'Gif'
   		) );
    	DB::table ( 'call_types' )->insert ( array (
  			'call_name' => 'Impact'
   		) );
    	DB::table ( 'call_types' )->insert ( array (
			'call_name' => 'Infectie'
   		) );
    	DB::table ( 'call_types' )->insert ( array (
    		'call_name' => 'Klief'
    	) );
    	DB::table ( 'call_types' )->insert ( array (
    		'call_name' => 'Krachtslag'
    	) );
    	DB::table ( 'call_types' )->insert ( array (
    		'call_name' => 'Magisch'
    	) );
    	DB::table ( 'call_types' )->insert ( array (
    		'call_name' => 'Pareer'
    	) );
    	DB::table ( 'call_types' )->insert ( array (
    		'call_name' => 'Ontwapen'
    	) );
    	DB::table ( 'call_types' )->insert ( array (
    		'call_name' => 'Ontwijk'
    	) );
    	
    	Schema::create ( 'call_rules', function (Blueprint $table) {
    		$table->increments ( 'id' )->index ();
    		$table->integer ( 'call_type_id' )->unsigned ();
    		$table->string ( 'rules_operator' );
    	} );
    	
    	Schema::table ( 'call_rules', function (Blueprint $table) {
    		$table->foreign ( 'call_type_id' )->references ( 'id' )->on ( 'call_types' );
    	} );
    	
    	Schema::table ( 'call_rules', function (Blueprint $table) {
    		$table->foreign ( 'rules_operator' )->references ( 'operator_name' )->on ( 'immune_does_operators' );
    	} );
    	
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 1,
			'rules_operator' =>  'doet'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 1,
			'rules_operator' =>  'is immuun aan'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 2,
			'rules_operator' =>  'doet'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 2,
			'rules_operator' =>  'is immuun aan'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 3,
			'rules_operator' =>  'doet'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 3,
			'rules_operator' =>  'is immuun aan'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 4,
			'rules_operator' =>  'doet'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 4,
			'rules_operator' =>  'is immuun aan'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 5,
			'rules_operator' =>  'doet'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 5,
			'rules_operator' =>  'is immuun aan'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 6,
			'rules_operator' =>  'doet'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 6,
			'rules_operator' =>  'is immuun aan'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 7,
			'rules_operator' =>  'doet'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 7,
			'rules_operator' =>  'is immuun aan'
		) );
   		DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 8,
			'rules_operator' =>  'doet'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 8,
			'rules_operator' =>  'is immuun aan'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 9,
			'rules_operator' =>  'doet'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 9,
			'rules_operator' =>  'is immuun aan'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 10,
			'rules_operator' =>  'doet'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 10,
			'rules_operator' =>  'is immuun aan'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 11,
			'rules_operator' =>  'doet'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 11,
			'rules_operator' =>  'is immuun aan'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 12,
			'rules_operator' =>  'doet'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 12,
			'rules_operator' =>  'is immuun aan'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 13,
			'rules_operator' =>  'doet'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 13,
			'rules_operator' =>  'is immuun aan'
		) );
    	DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 14,
			'rules_operator' =>  'doet'
		) );
		DB::table ( 'call_rules' )->insert ( array (
			'call_type_id' => 14,
			'rules_operator' =>  'is immuun aan'
		) );
    					 
		Schema::create ( 'craft_equipments', function (Blueprint $table) {
			$table->increments ( 'id' )->index ();
			$table->string ('name');
			$table->text( 'description' );
			$table->integer('price');
		} );
		
		Schema::create ( 'call_rule_craft_equipment', function (Blueprint $table) {
			$table->integer( 'craft_equipment_id' )->unsigned()->index();
			$table->integer( 'call_rule_id' )->unsigned()->index();
		} );
		
		Schema::table('call_rule_craft_equipment', function(Blueprint $table){
			$table->foreign('craft_equipment_id')->references('id')->on('craft_equipments')->onDelete('cascade');
			$table->foreign('call_rule_id')->references('id')->on('call_rules')->onDelete('cascade');
		});

		Schema::create ( 'craft_equipment_damage_rule', function (Blueprint $table) {
			$table->integer( 'craft_equipment_id' )->unsigned()->index();
			$table->integer( 'damage_rule_id' )->unsigned()->index();
		} );
		
		Schema::table('craft_equipment_damage_rule', function(Blueprint $table){
			$table->foreign('craft_equipment_id')->references('id')->on('craft_equipments')->onDelete('cascade');
			$table->foreign('damage_rule_id')->references('id')->on('damage_rules')->onDelete('cascade');
		});
			
		Schema::create ( 'craft_equipment_resistance_rule', function (Blueprint $table) {
			$table->integer( 'craft_equipment_id' )->unsigned()->index();
			$table->integer( 'resistance_rule_id' )->unsigned()->index();
		} );
		
		Schema::table('craft_equipment_resistance_rule', function(Blueprint $table){
			$table->foreign('craft_equipment_id')->references('id')->on('craft_equipments')->onDelete('cascade');
			$table->foreign('resistance_rule_id')->references('id')->on('resistance_rules')->onDelete('cascade');
		});

		Schema::create ( 'craft_equipment_statistic_rule', function (Blueprint $table) {
			$table->integer( 'craft_equipment_id' )->unsigned()->index();
			$table->integer( 'statistic_rule_id' )->unsigned()->index();
		} );
		
		Schema::table('craft_equipment_statistic_rule', function(Blueprint $table){
			$table->foreign('craft_equipment_id')->references('id')->on('craft_equipments')->onDelete('cascade');
			$table->foreign('statistic_rule_id')->references('id')->on('statistic_rules')->onDelete('cascade');
		});
		
		Schema::create ( 'craft_equipment_wealth_rule', function (Blueprint $table) {
			$table->integer( 'craft_equipment_id' )->unsigned()->index();
			$table->integer( 'wealth_rule_id' )->unsigned()->index();
		} );
		
		Schema::table('craft_equipment_wealth_rule', function(Blueprint $table){
			$table->foreign('craft_equipment_id')->references('id')->on('craft_equipments')->onDelete('cascade');
			$table->foreign('wealth_rule_id')->references('id')->on('wealth_rules')->onDelete('cascade');
		});
			
		Schema::create ( 'craft_equipment_skill', function (Blueprint $table) {
			$table->integer( 'craft_equipment_id' )->unsigned()->index();
			$table->integer( 'skill_id' )->unsigned()->index();
		} );

		Schema::table('craft_equipment_skill', function(Blueprint $table){
			$table->foreign('craft_equipment_id')->references('id')->on('craft_equipments')->onDelete('cascade');
			$table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::drop('call_rule_craft_equipment');
    	Schema::drop('craft_equipment_damage_rule');
    	Schema::drop('craft_equipment_resistance_rule');
    	Schema::drop('craft_equipment_statistic_rule');
    	Schema::drop('craft_equipment_wealth_rule');
    	Schema::drop('craft_equipment_skill');
    	Schema::drop('craft_equipments');
    	Schema::drop('call_rules');
    	Schema::drop('call_types');
    }
}
