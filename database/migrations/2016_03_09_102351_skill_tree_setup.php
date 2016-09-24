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
		// Class: contains all player_classes (Algemeen, Priester, Ontwaakte, etc.)
		// class_name : String (key)
		Schema::create ( 'player_classes', function (Blueprint $table) {
			$table->increments( 'id')->index();
			$table->string ( 'class_name', 255 );
		} );
		
		// Seed the player_classes table
		DB::table ( 'player_classes' )->insert ( array (
				'class_name' => 'Algemeen' 
		) );
		DB::table ( 'player_classes' )->insert ( array (
				'class_name' => 'Geleerde' 
		) );
		DB::table ( 'player_classes' )->insert ( array (
				'class_name' => 'Handelaar' 
		) );
		DB::table ( 'player_classes' )->insert ( array (
				'class_name' => 'Krijger' 
		) );
		DB::table ( 'player_classes' )->insert ( array (
				'class_name' => 'Ontwaakte' 
		) );
		DB::table ( 'player_classes' )->insert ( array (
				'class_name' => 'Vagebond' 
		) );
		DB::table ( 'player_classes' )->insert ( array (
				'class_name' => 'Priester' 
		) );
		
		// skill_levels: contains all skill levels. (Debutant, Avonturier, Veteraan, Held)
		Schema::create ( 'skill_levels', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->string ( 'skill_level', 32 );
		} );
		// Seed the skill_levels table
		DB::table('skill_levels')->insert(array(
				'skill_level' => 'Debutant'
		));
		DB::table('skill_levels')->insert(array(
				'skill_level' => 'Avonturier'
		));
		DB::table('skill_levels')->insert(array(
				'skill_level' => 'Veteraan'
		));
		DB::table('skill_levels')->insert(array(
				'skill_level' => 'Held'
		));
		
		// Statistic: contains all stat names. (Wilskracht, Status, Levenspunten
		// statistic_name : String (key)
		Schema::create ( 'statistics', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->string ( 'statistic_name', 255 );
		} );
		// Seed the statistics table
		DB::table ( 'statistics' )->insert ( array (
				'statistic_name' => 'Levenspunten' 
		) );
		DB::table ( 'statistics' )->insert ( array (
				'statistic_name' => 'Wilskracht' 
		) );
		DB::table ( 'statistics' )->insert ( array (
				'statistic_name' => 'Status' 
		) );
		DB::table ( 'statistics' )->insert ( array (
				'statistic_name' => 'Focus' 
		) );
		
		// coins: contains all coin versions of the ingame money
		// coin: String (key)
		Schema::create ( 'coins', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->string ( 'coin', 32 );
		} );
		
		// Seed coins table
		DB::table ( 'coins' )->insert ( array (
				'coin' => 'Brons' 
		) );
		DB::table ( 'coins' )->insert ( array (
				'coin' => 'Zilver' 
		) );
		DB::table ( 'coins' )->insert ( array (
				'coin' => 'Goud' 
		) );
		
		// Skill: contains descriptions and all attributes for skills
		// id : auto_increment id (added for ease iso making
		// name the key)
		// name : String
		// ep_cost : int
		Schema::create ( 'skills', function (Blueprint $table) {
			$table->increments ( 'id' )->index ();
			$table->string ( 'name', 255 );
			$table->mediumInteger ( 'ep_cost' );
			$table->integer('skill_level_id')->unsigned();
			$table->string ( 'description_small', 255 );
			$table->text ( 'description_long' );
			$table->boolean('mentor_required');
			$table->integer( 'coin_id' )->unsigned();
			$table->mediumInteger ( 'income_amount' );

			$table->foreign('skill_level_id')->references('id')->on('skill_levels');
			$table->foreign('coin_id')->references('id')->on('coins');
				
		} );
		// set foreign keys
// 		Schema::table('skills', function(Blueprint $table){
// 			$table->foreign('skill_level_id')->references('id')->on('skill_levels');
// 			$table->foreign('coin_id')->references('id')->on('coins');
// 		});
		
		// player_class_skill: contains class prereqs for a certain skill
		// skill_id: foreign key to id in skills
		// player_classes_class_name: forign key to class_name in player_classes
		Schema::create ( 'player_class_skill', function (Blueprint $table) {
			$table->integer ( 'skill_id' )->unsigned ()->index ();
			$table->integer ( 'player_class_id' )->unsigned() -> index ();
		} );
		// set foreign keys
		Schema::table ( 'player_class_skill', function (Blueprint $table) {
			$table->foreign ( 'skill_id' )->references ( 'id' )->on ( 'skills' )->onDelete('cascade');
			$table->foreign ( 'player_class_id' )->references ( 'id' )->on ( 'player_classes' )->onDelete('cascade');
		} );
		
		// skillskillPrereqs: contains skill prereqs for a certain skill
		// skill_id: foreign key to id in skills
		// skills_prereq_id: foreign key to id in skills that is
		// prereq to skill_id
		Schema::create ( 'skill_skill_prereqs', function (Blueprint $table) {
			$table->integer ( 'skill_id' )->unsigned ()->index ();
			$table->integer ( 'skills_prereq_id' )->unsigned ()->index ();
			$table->mediumInteger('prereq_set');
		} );
		// set foreign keys
		Schema::table ( 'skill_skill_prereqs', function (Blueprint $table) {
			$table->foreign ( 'skill_id' )->references ( 'id' )->on ( 'skills' )->onDelete('cascade');
			$table->foreign ( 'skills_prereq_id' )->references ( 'id' )->on ( 'skills' )->onDelete('cascade');
		} );
		
		// skillstatisticPrereqs: contains statistic prereqs for a certain skill
		// skill_id: foreign key to id in skills
		// statistic_id: foreign key to statistic in statistics
		// level: level of required statistic
		Schema::create ( 'skill_statistic_prereqs', function (Blueprint $table) {
			$table->integer ( 'skill_id' )->unsigned ()->index ();
			$table->integer ( 'statistic_id' )->unsigned()->index ();
			$table->mediumInteger ( 'level' );
		} );
		// set foreign keys
		Schema::table ( 'skill_statistic_prereqs', function (Blueprint $table) {
			$table->foreign ( 'skill_id' )->references ( 'id' )->on ( 'skills' )->onDelete('cascade');
			$table->foreign ( 'statistic_id' )->references ( 'id' )->on ( 'statistics' )->onDelete('cascade');
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
// 		Schema::drop ( 'incomes' );
		Schema::drop ( 'skill_statistic_prereqs' );
		Schema::drop ( 'skill_skill_prereqs' );
		Schema::drop ( 'player_class_skill' );
		Schema::drop ( 'skills' );
		Schema::drop ( 'coins' );
		Schema::drop ( 'statistics' );
		Schema::drop ( 'skill_levels' );
		Schema::drop ( 'player_classes' );
	}
}
