<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreatedModifiedCharacterskillEpassignment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
   		Schema::table ( 'character_skill', function (Blueprint $table) {
  			$table->dropColumn('purchased_on_date');
   			$table->boolean('is_descent_skill');
   			$table->timestamps();
   		} );
   		
   		Schema::table( 'ep_assignment', function (Blueprint $table){
   			$table->dropColumn('assigned_on_date');
   			$table->timestamps();
   		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table ( 'character_skill', function (Blueprint $table) {
  			$table->dropColumn('created_at');
  			$table->dropColumn('updated_at');
  			$table->dropColumn('is_descent_skill');
  			$table->date('purchased_on_date');
   		} );
    	
    	Schema::table( 'ep_assignment', function (Blueprint $table){
  			$table->dropColumn('created_at');
  			$table->dropColumn('updated_at');
  			$table->date('assigned_on_date');
    	});
    }
}
