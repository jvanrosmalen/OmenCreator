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
    	Schema::create ( 'RulesOperators', function (Blueprint $table) {
    		$table->string('operator')->index();
    	});
    	
    	// Seed the Statistics table
    	DB::table ( 'RulesOperators' )->insert ( array (
    		'operator' => '=',    		
    	) );
    	DB::table ( 'RulesOperators' )->insert ( array (
    			'operator' => '-',
    	) );
    	DB::table ( 'RulesOperators' )->insert ( array (
    			'operator' => '+',
    	) );
    	 
		Schema::create ( 'StatisticRules', function (Blueprint $table) {
			$table->increments ( 'id' )->index ();
			$table->integer('Statistics_id')->unsigned();
			$table->string( 'RulesOperator' );
			$table->integer('value');
		} );
		
		// set foreign keys
		Schema::table('StatisticRules', function(Blueprint $table){
			$table->foreign('Statistics_id')->references('id')->on('Statistics');
		});
		Schema::table('StatisticRules', function(Blueprint $table){
			$table->foreign('RulesOperator')->references('operator')->on('RulesOperators');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('StatisticRules');
        Schema::drop('RulesOperators');
    }
}
