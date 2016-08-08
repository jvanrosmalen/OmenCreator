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
		Schema::create ( 'resistances', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->string ( 'resistance_name', 20 );
		} );
		
		// Seed the Statistics table
		DB::table ( 'resistances' )->insert ( array (
				'resistance_name' => 'Angst' 
		) );
		DB::table ( 'resistances' )->insert ( array (
				'resistance_name' => 'Diefstal' 
		) );
		DB::table ( 'resistances' )->insert ( array (
				'resistance_name' => 'Trauma' 
		) );
		DB::table ( 'resistances' )->insert ( array (
				'resistance_name' => 'Gif' 
		) );
		DB::table ( 'resistances' )->insert ( array (
				'resistance_name' => 'Magie' 
		) );
		DB::table ( 'resistances' )->insert ( array (
				'resistance_name' => 'Ziekte' 
		) );
		
		Schema::create ( 'resistance_rules', function (Blueprint $table) {
			$table->increments ( 'id' )->index ();
			$table->integer ( 'resistance_id' )->unsigned ();
			$table->string ( 'rules_operator' );
			$table->integer ( 'value' );
		} );
		
		// set foreign keys
		Schema::table ( 'resistance_rules', function (Blueprint $table) {
			$table->foreign ( 'resistance_id' )->references ( 'id' )->on ( 'resistances' );
		} );
		Schema::table ( 'resistance_rules', function (Blueprint $table) {
			$table->foreign ( 'rules_operator' )->references ( 'operator' )->on ( 'rules_operators' );
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('resistance_rules');
		Schema::drop('resistances');
	}
}
