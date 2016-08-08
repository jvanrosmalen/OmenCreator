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
		Schema::create ( 'damage_types', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->string ( 'damage_name', 25 );
		} );
		
		// Seed the Statistics table
		DB::table ( 'damage_types' )->insert ( array (
				'damage_name' => 'Vuur' 
		) );
		DB::table ( 'damage_types' )->insert ( array (
				'damage_name' => 'Zuur' 
		) );
		DB::table ( 'damage_types' )->insert ( array (
				'damage_name' => 'Magische' 
		) );
		DB::table ( 'damage_types' )->insert ( array (
				'damage_name' => 'Niet-Magische'
		) );

		Schema::create ( 'immune_does_operators', function (Blueprint $table) {
			$table->string ( 'operator_name', 50 ) -> index();
		} );
		
		DB::table ( 'immune_does_operators' )->insert ( array (
				'operator_name' => 'doet'
		) );
			
		DB::table ( 'immune_does_operators' )->insert ( array (
				'operator_name' => 'is immuun aan'
		) );
		
		Schema::create ( 'damage_rules', function (Blueprint $table) {
			$table->increments ( 'id' )->index ();
			$table->integer ( 'damage_type_id' )->unsigned ();
			$table->string ( 'rules_operator' );
		} );
		
		Schema::table ( 'damage_rules', function (Blueprint $table) {
			$table->foreign ( 'damage_type_id' )->references ( 'id' )->on ( 'damage_types' );
		} );
		
		Schema::table ( 'damage_rules', function (Blueprint $table) {
			$table->foreign ( 'rules_operator' )->references ( 'operator_name' )->on ( 'immune_does_operators' );
		} );
		
		DB::table ( 'damage_rules' )->insert ( array (
				'damage_type_id' => 1,
				'rules_operator' =>  'doet'
		) );
		
		DB::table ( 'damage_rules' )->insert ( array (
				'damage_type_id' => 1,
				'rules_operator' =>  'is immuun aan'
		) );

		DB::table ( 'damage_rules' )->insert ( array (
				'damage_type_id' => 2,
				'rules_operator' =>  'doet'
		) );
		
		DB::table ( 'damage_rules' )->insert ( array (
				'damage_type_id' => 2,
				'rules_operator' =>  'is immuun aan'
		) );

		DB::table ( 'damage_rules' )->insert ( array (
				'damage_type_id' => 3,
				'rules_operator' =>  'doet'
		) );
		
		DB::table ( 'damage_rules' )->insert ( array (
				'damage_type_id' => 3,
				'rules_operator' =>  'is immuun aan'
		) );
		
		DB::table ( 'damage_rules' )->insert ( array (
				'damage_type_id' => 4,
				'rules_operator' =>  'doet'
		) );
		
		DB::table ( 'damage_rules' )->insert ( array (
				'damage_type_id' => 4,
				'rules_operator' =>  'is immuun aan'
		) );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('damage_rules');
        Schema::drop('immune_does_operators');
        Schema::drop('damage_types');
    }
}
