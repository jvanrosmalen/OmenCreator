<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class SkillTreeSetup extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		// Class: contains all PlayerClasses (Algemeen, Priester, Ontwaakte, etc.)
		// class_name : String (key)
		Schema::create ( 'PlayerClasses', function (Blueprint $table) {
			$table->increments( 'id')->index();
			$table->string ( 'class_name', 255 );
		} );
		
		// Seed the PlayerClasses table
		DB::table ( 'PlayerClasses' )->insert ( array (
				'class_name' => 'Algemeen' 
		) );
		DB::table ( 'PlayerClasses' )->insert ( array (
				'class_name' => 'Geleerde' 
		) );
		DB::table ( 'PlayerClasses' )->insert ( array (
				'class_name' => 'Handelaar' 
		) );
		DB::table ( 'PlayerClasses' )->insert ( array (
				'class_name' => 'Krijger' 
		) );
		DB::table ( 'PlayerClasses' )->insert ( array (
				'class_name' => 'Ontwaakte' 
		) );
		DB::table ( 'PlayerClasses' )->insert ( array (
				'class_name' => 'Vagebond' 
		) );
		DB::table ( 'PlayerClasses' )->insert ( array (
				'class_name' => 'Priester' 
		) );
		
		// SkillLevels: contains all skill levels. (Debutant, Avonturier, Veteraan, Held)
		Schema::create ( 'SkillLevels', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->string ( 'skill_level', 32 );
		} );
		// Seed the SkillLevels table
		DB::table('SkillLevels')->insert(array(
				'skill_level' => 'Debutant'
		));
		DB::table('SkillLevels')->insert(array(
				'skill_level' => 'Avonturier'
		));
		DB::table('SkillLevels')->insert(array(
				'skill_level' => 'Veteraan'
		));
		DB::table('SkillLevels')->insert(array(
				'skill_level' => 'Held'
		));
		
		// Statistic: contains all stat names. (Wilskracht, Status, Levenspunten
		// statistic_name : String (key)
		Schema::create ( 'Statistics', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->string ( 'statistic_name', 255 );
		} );
		// Seed the Statistics table
		DB::table ( 'Statistics' )->insert ( array (
				'statistic_name' => 'Levenspunten' 
		) );
		DB::table ( 'Statistics' )->insert ( array (
				'statistic_name' => 'Wilskracht' 
		) );
		DB::table ( 'Statistics' )->insert ( array (
				'statistic_name' => 'Status' 
		) );
		DB::table ( 'Statistics' )->insert ( array (
				'statistic_name' => 'Focus' 
		) );
		
		// Coins: contains all coin versions of the ingame money
		// coin_name: String (key)
		Schema::create ( 'Coins', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->string ( 'coin_name', 32 );
		} );
		
		// Seed Coins table
		DB::table ( 'Coins' )->insert ( array (
				'coin_name' => 'Brons' 
		) );
		DB::table ( 'Coins' )->insert ( array (
				'coin_name' => 'Zilver' 
		) );
		DB::table ( 'Coins' )->insert ( array (
				'coin_name' => 'Goud' 
		) );
		
		// Skill: contains descriptions and all attributes for Skills
		// id : auto_increment id (added for ease iso making
		// name the key)
		// name : String
		// ep_cost : int
		Schema::create ( 'Skills', function (Blueprint $table) {
			$table->increments ( 'id' )->index ();
			$table->string ( 'name', 255 );
			$table->mediumInteger ( 'ep_cost' );
			$table->integer('level')->unsigned();
			$table->string ( 'descriptionSmall', 255 );
			$table->text ( 'descriptionLong' );
			$table->boolean('mentorRequired');
		} );
		// set foreign keys
		Schema::table('Skills', function(Blueprint $table){
			$table->foreign('level')->references('id')->on('SkillLevels');
		});
		
		// SkillClassPrereqs: contains class prereqs for a certain skill
		// Skills_id: foreign key to id in Skills
		// PlayerClasses_class_name: forign key to class_name in PlayerClasses
		Schema::create ( 'SkillClassPrereqs', function (Blueprint $table) {
			$table->integer ( 'Skills_id' )->unsigned ()->index ();
			$table->integer ( 'PlayerClasses_id' )->unsigned() -> index ();
		} );
		// set foreign keys
		Schema::table ( 'SkillClassPrereqs', function (Blueprint $table) {
			$table->foreign ( 'Skills_id' )->references ( 'id' )->on ( 'Skills' );
			$table->foreign ( 'PlayerClasses_id' )->references ( 'id' )->on ( 'PlayerClasses' );
		} );
		
		// SkillskillPrereqs: contains skill prereqs for a certain skill
		// Skills_id: foreign key to id in Skills
		// Skills_prereq_id: foreign key to id in Skills that is
		// prereq to Skills_id
		Schema::create ( 'SkillSkillPrereqs', function (Blueprint $table) {
			$table->integer ( 'Skills_id' )->unsigned ()->index ();
			$table->integer ( 'Skills_prereq_id' )->unsigned ()->index ();
			$table->mediumInteger('prereq_set');
		} );
		// set foreign keys
		Schema::table ( 'SkillSkillPrereqs', function (Blueprint $table) {
			$table->foreign ( 'Skills_id' )->references ( 'id' )->on ( 'Skills' );
			$table->foreign ( 'Skills_prereq_id' )->references ( 'id' )->on ( 'Skills' );
		} );
		
		// SkillstatisticPrereqs: contains statistic prereqs for a certain skill
		// Skills_id: foreign key to id in Skills
		// Statistics_id: foreign key to statistic in Statistics
		// level: level of required statistic
		Schema::create ( 'SkillStatisticPrereqs', function (Blueprint $table) {
			$table->integer ( 'Skills_id' )->unsigned ()->index ();
			$table->integer ( 'Statistics_id' )->unsigned()->index ();
			$table->mediumInteger ( 'level' );
		} );
		// set foreign keys
		Schema::table ( 'SkillStatisticPrereqs', function (Blueprint $table) {
			$table->foreign ( 'Skills_id' )->references ( 'id' )->on ( 'Skills' );
			$table->foreign ( 'Statistics_id' )->references ( 'id' )->on ( 'Statistics' );
		} );
		
		// Incomes: contains relation between Skill and Coins
		// Skills_id: foreign key to id in Skills
		// Coins_coin_name: foreign key to coin_name in Coins
		// amount: the amount of income
		Schema::create ( 'Incomes', function (Blueprint $table) {
			$table->integer ( 'Skills_id' )->unsigned ()->index ();
			$table->integer( 'Coins_id', 32 )->unsigned()->index ();
			$table->mediumInteger ( 'amount' );
		} );
		// set foreign keys
		Schema::table ( 'Incomes', function (Blueprint $table) {
			$table->foreign ( 'Skills_id' )->references ( 'id' )->on ( 'Skills' );
			$table->foreign ( 'Coins_id' )->references ( 'id' )->on ( 'Coins' );
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop ( 'Incomes' );
		Schema::drop ( 'SkillStatisticPrereqs' );
		Schema::drop ( 'SkillSkillPrereqs' );
		Schema::drop ( 'SkillClassPrereqs' );
		Schema::drop ( 'Skills' );
		Schema::drop ( 'Coins' );
		Schema::drop ( 'Statistics' );
		Schema::drop ( 'SkillLevels' );
		Schema::drop ( 'PlayerClasses' );
	}
}
