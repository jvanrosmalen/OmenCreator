<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WealthRules extends Migration
{
	public function up() {
		Schema::create ( 'Wealth', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->string ( 'wealth_name', 20 );
		} );
		
		// Seed the Wealth table
		DB::table ( 'Wealth' )->insert ( array (
				'wealth_name' => 'Welvaart'
		) );
		
		Schema::create ( 'WealthTypes', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->string ( 'wealth_type', 20 );
		} );
		
		// Seed the Wealth types table
		DB::table ( 'WealthTypes' )->insert ( array (
				'wealth_type' => 'Arm' 
		) );
		DB::table ( 'WealthTypes' )->insert ( array (
				'wealth_type' => 'Middenklasse'
		) );
		DB::table ( 'WealthTypes' )->insert ( array (
				'wealth_type' => 'Welvarend'
		) );
		DB::table ( 'WealthTypes' )->insert ( array (
				'wealth_type' => 'Rijk'
		) );
		
		
		Schema::create ( 'WealthRules', function (Blueprint $table) {
			$table->increments ( 'id' )->index ();
			$table->integer ( 'Wealth_id' )->unsigned ();
			$table->string ( 'RulesOperator' );
			$table->integer ( 'ValueType_id' ) ->unsigned();
		} );
		
		// set foreign keys
		Schema::table ( 'WealthRules', function (Blueprint $table) {
			$table->foreign ( 'Wealth_id' )->references ( 'id' )->on ( 'Wealth' );
		} );
		Schema::table ( 'WealthRules', function (Blueprint $table) {
			$table->foreign ( 'RulesOperator' )->references ( 'operator' )->on ( 'RulesOperators' );
		} );
		Schema::table ( 'WealthRules', function (Blueprint $table) {
			$table->foreign ( 'ValueType_id' )->references ( 'id' )->on ( 'WealthTypes' );
		} );
		
		// Seed the WealthRules table
		DB::table ( 'WealthRules' )->insert ( array (
				'Wealth_id' => 1,
				'RulesOperator' => '=',
				'ValueType_id' => 1
		) );
		DB::table ( 'WealthRules' )->insert ( array (
				'Wealth_id' => 1,
				'RulesOperator' => '=',
				'ValueType_id' => 2
		) );
		DB::table ( 'WealthRules' )->insert ( array (
				'Wealth_id' => 1,
				'RulesOperator' => '=',
				'ValueType_id' => 3
		) );
		DB::table ( 'WealthRules' )->insert ( array (
				'Wealth_id' => 1,
				'RulesOperator' => '=',
				'ValueType_id' => 4
		) );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('WealthRules');
		Schema::drop('Wealth');
		Schema::drop('WealthTypes');
	}
}
