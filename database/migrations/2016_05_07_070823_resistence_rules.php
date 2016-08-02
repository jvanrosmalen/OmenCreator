<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class ResistenceRules extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ( 'Resistances', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->string ( 'resistance_name', 20 );
		} );
		
		// Seed the Statistics table
		DB::table ( 'Resistances' )->insert ( array (
				'resistance_name' => 'Angst' 
		) );
		DB::table ( 'Resistances' )->insert ( array (
				'resistance_name' => 'Diefstal' 
		) );
		DB::table ( 'Resistances' )->insert ( array (
				'resistance_name' => 'Trauma' 
		) );
		DB::table ( 'Resistances' )->insert ( array (
				'resistance_name' => 'Gif' 
		) );
		DB::table ( 'Resistances' )->insert ( array (
				'resistance_name' => 'Magie' 
		) );
		DB::table ( 'Resistances' )->insert ( array (
				'resistance_name' => 'Ziekte' 
		) );
		
		Schema::create ( 'ResistanceRules', function (Blueprint $table) {
			$table->increments ( 'id' )->index ();
			$table->integer ( 'Resistances_id' )->unsigned ();
			$table->string ( 'RulesOperator' );
			$table->integer ( 'value' );
		} );
		
		// set foreign keys
		Schema::table ( 'ResistanceRules', function (Blueprint $table) {
			$table->foreign ( 'Resistances_id' )->references ( 'id' )->on ( 'Resistances' );
		} );
		Schema::table ( 'ResistanceRules', function (Blueprint $table) {
			$table->foreign ( 'RulesOperator' )->references ( 'operator' )->on ( 'RulesOperators' );
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('ResistanceRules');
		Schema::drop('Resistances');
	}
}
