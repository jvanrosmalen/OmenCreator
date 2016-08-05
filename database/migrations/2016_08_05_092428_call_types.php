<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CallTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create ( 'CallTypes', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->string ( 'call_name', 25 );
		} );
		
		// Seed the CallTypes table
		DB::table ( 'CallTypes' )->insert ( array (
				'call_name' => 'Angst' 
		) );
		DB::table ( 'CallTypes' )->insert ( array (
				'call_name' => 'Bevel'
		) );
		DB::table ( 'CallTypes' )->insert ( array (
				'call_name' => 'Bloeding'
		) );
		DB::table ( 'CallTypes' )->insert ( array (
				'call_name' => 'Bottenbreker'
		) );
		DB::table ( 'CallTypes' )->insert ( array (
				'call_name' => 'Door Pantser'
		) );
		DB::table ( 'CallTypes' )->insert ( array (
				'call_name' => 'Gif'
		) );
		DB::table ( 'CallTypes' )->insert ( array (
				'call_name' => 'Impact'
		) );
		DB::table ( 'CallTypes' )->insert ( array (
				'call_name' => 'Infectie'
		) );
		DB::table ( 'CallTypes' )->insert ( array (
				'call_name' => 'Klief'
		) );
		DB::table ( 'CallTypes' )->insert ( array (
				'call_name' => 'Krachtslag'
		) );
		DB::table ( 'CallTypes' )->insert ( array (
				'call_name' => 'Magisch'
		) );
		DB::table ( 'CallTypes' )->insert ( array (
				'call_name' => 'Pareer'
		) );
		DB::table ( 'CallTypes' )->insert ( array (
				'call_name' => 'Ontwapen'
		) );
		DB::table ( 'CallTypes' )->insert ( array (
				'call_name' => 'Ontwijk'
		) );
				
		Schema::create ( 'CallRules', function (Blueprint $table) {
			$table->increments ( 'id' )->index ();
			$table->integer ( 'CallTypes_id' )->unsigned ();
			$table->string ( 'RulesOperator' );
		} );
		
		Schema::table ( 'CallRules', function (Blueprint $table) {
			$table->foreign ( 'CallTypes_id' )->references ( 'id' )->on ( 'CallTypes' );
		} );
		
		Schema::table ( 'CallRules', function (Blueprint $table) {
			$table->foreign ( 'RulesOperator' )->references ( 'operator_name' )->on ( 'ImmuneDoesOperators' );
		} );
		
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 1,
				'RulesOperator' =>  'doet'
		) );
		
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 1,
				'RulesOperator' =>  'is immuun aan'
		) );

		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 2,
				'RulesOperator' =>  'doet'
		) );
		
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 2,
				'RulesOperator' =>  'is immuun aan'
		) );
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 3,
				'RulesOperator' =>  'doet'
		) );
		
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 3,
				'RulesOperator' =>  'is immuun aan'
		) );
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 4,
				'RulesOperator' =>  'doet'
		) );
		
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 4,
				'RulesOperator' =>  'is immuun aan'
		) );
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 5,
				'RulesOperator' =>  'doet'
		) );
		
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 5,
				'RulesOperator' =>  'is immuun aan'
		) );
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 6,
				'RulesOperator' =>  'doet'
		) );
		
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 6,
				'RulesOperator' =>  'is immuun aan'
		) );
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 7,
				'RulesOperator' =>  'doet'
		) );
		
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 7,
				'RulesOperator' =>  'is immuun aan'
		) );
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 8,
				'RulesOperator' =>  'doet'
		) );
		
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 8,
				'RulesOperator' =>  'is immuun aan'
		) );
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 9,
				'RulesOperator' =>  'doet'
		) );
		
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 9,
				'RulesOperator' =>  'is immuun aan'
		) );
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 10,
				'RulesOperator' =>  'doet'
		) );
		
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 10,
				'RulesOperator' =>  'is immuun aan'
		) );
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 11,
				'RulesOperator' =>  'doet'
		) );
		
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 11,
				'RulesOperator' =>  'is immuun aan'
		) );
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 12,
				'RulesOperator' =>  'doet'
		) );
		
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 12,
				'RulesOperator' =>  'is immuun aan'
		) );
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 13,
				'RulesOperator' =>  'doet'
		) );
		
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 13,
				'RulesOperator' =>  'is immuun aan'
		) );
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 14,
				'RulesOperator' =>  'doet'
		) );
		
		DB::table ( 'CallRules' )->insert ( array (
				'CallTypes_id' => 14,
				'RulesOperator' =>  'is immuun aan'
		) );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('CallRules');
        Schema::drop('CallTypes');
    }
}
