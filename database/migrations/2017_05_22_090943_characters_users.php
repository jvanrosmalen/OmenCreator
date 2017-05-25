<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CharactersUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_user', function(Blueprint $table){
			$table->integer( 'character_id' )->unsigned()->index();
			$table->integer( 'user_id' )->unsigned()->index();			
		});
        
       	Schema::table('character_user', function (Blueprint $table) {
       		$table->foreign ( 'character_id' )->references ( 'id' )->on ( 'characters' )->onDelete('cascade');
       		$table->foreign ( 'user_id' )->references ( 'id' )->on ( 'users' )->onDelete('cascade');
       	} );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('character_user');
    }
}
