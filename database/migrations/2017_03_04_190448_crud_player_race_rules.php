<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CrudPlayerRaceRules extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::rename ( 'player_races', 'races' );
		
		Schema::table ( 'races', function ($table) {
			$table->text ( 'description' );
			$table->boolean ( 'is_player_race' );
		} );
		
		Schema::create ( 'call_rule_race', function (Blueprint $table) {
			$table->integer ( 'race_id' )->unsigned ()->index ();
			$table->integer ( 'call_rule_id' )->unsigned ()->index ();
		} );
		
		Schema::table ( 'call_rule_race', function (Blueprint $table) {
			$table->foreign ( 'race_id' )->references ( 'id' )->on ( 'races' )->onDelete ( 'cascade' );
			$table->foreign ( 'call_rule_id' )->references ( 'id' )->on ( 'call_rules' )->onDelete ( 'cascade' );
		} );
		
		Schema::create ( 'damage_rule_race', function (Blueprint $table) {
			$table->integer ( 'race_id' )->unsigned ()->index ();
			$table->integer ( 'damage_rule_id' )->unsigned ()->index ();
		} );
		
		Schema::table ( 'damage_rule_race', function (Blueprint $table) {
			$table->foreign ( 'race_id' )->references ( 'id' )->on ( 'races' )->onDelete ( 'cascade' );
			$table->foreign ( 'damage_rule_id' )->references ( 'id' )->on ( 'damage_rules' )->onDelete ( 'cascade' );
		} );
		
		Schema::create ( 'race_resistance_rule', function (Blueprint $table) {
			$table->integer ( 'race_id' )->unsigned ()->index ();
			$table->integer ( 'resistance_rule_id' )->unsigned ()->index ();
		} );
		
		Schema::table ( 'race_resistance_rule', function (Blueprint $table) {
			$table->foreign ( 'race_id' )->references ( 'id' )->on ( 'races' )->onDelete ( 'cascade' );
			$table->foreign ( 'resistance_rule_id' )->references ( 'id' )->on ( 'resistance_rules' )->onDelete ( 'cascade' );
		} );
		
		Schema::create ( 'race_statistic_rule', function (Blueprint $table) {
			$table->integer ( 'race_id' )->unsigned ()->index ();
			$table->integer ( 'statistic_rule_id' )->unsigned ()->index ();
		} );
		
		Schema::table ( 'race_statistic_rule', function (Blueprint $table) {
			$table->foreign ( 'race_id' )->references ( 'id' )->on ( 'races' )->onDelete ( 'cascade' );
			$table->foreign ( 'statistic_rule_id' )->references ( 'id' )->on ( 'statistic_rules' )->onDelete ( 'cascade' );
		} );
		
		Schema::create ( 'race_wealth_rule', function (Blueprint $table) {
			$table->integer ( 'race_id' )->unsigned ()->index ();
			$table->integer ( 'wealth_rule_id' )->unsigned ()->index ();
		} );
		
		Schema::table ( 'race_wealth_rule', function (Blueprint $table) {
			$table->foreign ( 'race_id' )->references ( 'id' )->on ( 'races' )->onDelete ( 'cascade' );
			$table->foreign ( 'wealth_rule_id' )->references ( 'id' )->on ( 'wealth_rules' )->onDelete ( 'cascade' );
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table ( 'races', function ($table) {
			$table->dropColumn ( 'description' );
			$table->dropColumn ( 'player_race' );
		} );
		
		Schema::drop ( 'call_rule_race' );
		Schema::drop ( 'damage_rule_race' );
		Schema::drop ( 'race_resistance_rule' );
		Schema::drop ( 'race_statistic_rule' );
		Schema::drop ( 'race_wealth_rule' );
		
		Schema::rename ( 'races', 'player_races' );
	}
}
