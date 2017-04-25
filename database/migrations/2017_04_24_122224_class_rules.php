<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClassRules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create ( 'class_rules', function (Blueprint $table) {
			$table->increments ( 'id' )->index ();
			$table->integer('player_class_id')->unsigned();
		} );
		
		// set foreign keys
		Schema::table('class_rules', function(Blueprint $table){
			$table->foreign('player_class_id')->references('id')->on('player_classes');
		});
		
		DB::table ( 'class_rules' )->insert ( array (
				'player_class_id' => '2',
		) );

		DB::table ( 'class_rules' )->insert ( array (
				'player_class_id' => '3',
		) );

		DB::table ( 'class_rules' )->insert ( array (
				'player_class_id' => '4',
		) );
    
		DB::table ( 'class_rules' )->insert ( array (
				'player_class_id' => '5',
		) );
    
		DB::table ( 'class_rules' )->insert ( array (
				'player_class_id' => '6',
		) );
    
		DB::table ( 'class_rules' )->insert ( array (
				'player_class_id' => '7',
		) );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('class_rules');
    }
}
