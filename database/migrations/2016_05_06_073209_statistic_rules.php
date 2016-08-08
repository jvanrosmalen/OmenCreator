<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StatisticRules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create ( 'rules_operators', function (Blueprint $table) {
    		$table->string('operator')->index();
    	});
    	
    	// Seed the Statistics table
    	DB::table ( 'rules_operators' )->insert ( array (
    		'operator' => '=',    		
    	) );
    	DB::table ( 'rules_operators' )->insert ( array (
    			'operator' => '-',
    	) );
    	DB::table ( 'rules_operators' )->insert ( array (
    			'operator' => '+',
    	) );
    	 
		Schema::create ( 'statistic_rules', function (Blueprint $table) {
			$table->increments ( 'id' )->index ();
			$table->integer('statistic_id')->unsigned();
			$table->string( 'rules_operator' );
			$table->integer('value');
		} );
		
		// set foreign keys
		Schema::table('statistic_rules', function(Blueprint $table){
			$table->foreign('statistic_id')->references('id')->on('statistics');
		});
		Schema::table('statistic_rules', function(Blueprint $table){
			$table->foreign('rules_operator')->references('operator')->on('rules_operators');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('statistic_rules');
        Schema::drop('rules_operators');
    }
}
