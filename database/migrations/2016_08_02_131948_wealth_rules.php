<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WealthRules extends Migration
{
	public function up() {
		Schema::create ( 'wealths', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->string ( 'wealth_name', 20 );
		} );
		
		// Seed the wealth table
		DB::table ( 'wealths' )->insert ( array (
				'wealth_name' => 'Welvaart'
		) );
		
		Schema::create ( 'wealth_types', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->string ( 'wealth_type', 20 );
		} );
		
		// Seed the wealth types table
		DB::table ( 'wealth_types' )->insert ( array (
				'wealth_type' => 'Arm' 
		) );
		DB::table ( 'wealth_types' )->insert ( array (
				'wealth_type' => 'Middenklasse'
		) );
		DB::table ( 'wealth_types' )->insert ( array (
				'wealth_type' => 'Welvarend'
		) );
		DB::table ( 'wealth_types' )->insert ( array (
				'wealth_type' => 'Rijk'
		) );
		
		Schema::create ( 'wealth_rules', function (Blueprint $table) {
			$table->increments ( 'id' )->index ();
			$table->integer ( 'wealth_id' )->unsigned ();
			$table->string ( 'rules_operator' );
			$table->integer ( 'value_type_id' ) ->unsigned();
		} );
		
		// set foreign keys
		Schema::table ( 'wealth_rules', function (Blueprint $table) {
			$table->foreign ( 'wealth_id' )->references ( 'id' )->on ( 'wealths' );
		} );
		Schema::table ( 'wealth_rules', function (Blueprint $table) {
			$table->foreign ( 'rules_operator' )->references ( 'operator' )->on ( 'rules_operators' );
		} );
		Schema::table ( 'wealth_rules', function (Blueprint $table) {
			$table->foreign ( 'value_type_id' )->references ( 'id' )->on ( 'wealth_types' );
		} );
		
		// Seed the wealth_rules table
		DB::table ( 'wealth_rules' )->insert ( array (
				'wealth_id' => 1,
				'rules_operator' => '=',
				'value_type_id' => 1
		) );
		DB::table ( 'wealth_rules' )->insert ( array (
				'wealth_id' => 1,
				'rules_operator' => '=',
				'value_type_id' => 2
		) );
		DB::table ( 'wealth_rules' )->insert ( array (
				'wealth_id' => 1,
				'rules_operator' => '=',
				'value_type_id' => 3
		) );
		DB::table ( 'wealth_rules' )->insert ( array (
				'wealth_id' => 1,
				'rules_operator' => '=',
				'value_type_id' => 4
		) );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('wealth_rules');
		Schema::drop('wealths');
		Schema::drop('wealth_types');
	}
}
