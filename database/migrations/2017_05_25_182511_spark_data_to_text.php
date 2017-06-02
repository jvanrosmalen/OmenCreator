<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SparkDataToText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table ( 'characters', function (Blueprint $table) {
    		$table->dropColumn('spark_data');
    	} );
    	
   		Schema::table ( 'characters', function (Blueprint $table) {
   			$table->text('spark_data');
   		} );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table ( 'characters', function (Blueprint $table) {
    		$table->dropColumn('spark_data');
    	} );
    	
   		Schema::table ( 'characters', function (Blueprint $table) {
   			$table->string('spark_data');
   		} );
    }
}
