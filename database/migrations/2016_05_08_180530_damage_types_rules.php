<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DamageTypesRules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create ( 'DamageTypes', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->string ( 'damage_name', 25 );
		} );
		
		// Seed the Statistics table
		DB::table ( 'DamageTypes' )->insert ( array (
				'damage_name' => 'Vuur' 
		) );
		DB::table ( 'DamageTypes' )->insert ( array (
				'damage_name' => 'Zuur' 
		) );
		DB::table ( 'DamageTypes' )->insert ( array (
				'damage_name' => 'Magische' 
		) );
		DB::table ( 'DamageTypes' )->insert ( array (
				'damage_name' => 'Niet-Magische'
		) );

		Schema::create ( 'ImmuneDoesOperators', function (Blueprint $table) {
			$table->string ( 'operator_name', 50 ) -> index();
		} );
		
		DB::table ( 'ImmuneDoesOperators' )->insert ( array (
				'operator_name' => 'doet'
		) );
			
		DB::table ( 'ImmuneDoesOperators' )->insert ( array (
				'operator_name' => 'is immuun aan'
		) );
		
		Schema::create ( 'DamageRules', function (Blueprint $table) {
			$table->increments ( 'id' )->index ();
			$table->integer ( 'DamageTypes_id' )->unsigned ();
			$table->string ( 'RulesOperator' );
		} );
		
		Schema::table ( 'DamageRules', function (Blueprint $table) {
			$table->foreign ( 'DamageTypes_id' )->references ( 'id' )->on ( 'DamageTypes' );
		} );
		
		Schema::table ( 'DamageRules', function (Blueprint $table) {
			$table->foreign ( 'RulesOperator' )->references ( 'operator_name' )->on ( 'ImmuneDoesOperators' );
		} );
		
		DB::table ( 'DamageRules' )->insert ( array (
				'DamageTypes_id' => 1,
				'RulesOperator' =>  'doet'
		) );
		
		DB::table ( 'DamageRules' )->insert ( array (
				'DamageTypes_id' => 1,
				'RulesOperator' =>  'is immuun aan'
		) );

		DB::table ( 'DamageRules' )->insert ( array (
				'DamageTypes_id' => 2,
				'RulesOperator' =>  'doet'
		) );
		
		DB::table ( 'DamageRules' )->insert ( array (
				'DamageTypes_id' => 2,
				'RulesOperator' =>  'is immuun aan'
		) );

		DB::table ( 'DamageRules' )->insert ( array (
				'DamageTypes_id' => 3,
				'RulesOperator' =>  'doet'
		) );
		
		DB::table ( 'DamageRules' )->insert ( array (
				'DamageTypes_id' => 3,
				'RulesOperator' =>  'is immuun aan'
		) );
		
		DB::table ( 'DamageRules' )->insert ( array (
				'DamageTypes_id' => 4,
				'RulesOperator' =>  'doet'
		) );
		
		DB::table ( 'DamageRules' )->insert ( array (
				'DamageTypes_id' => 4,
				'RulesOperator' =>  'is immuun aan'
		) );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('DamageRules');
        Schema::drop('ImmuneDoesOperators');
        Schema::drop('DamageTypes');
    }
}
