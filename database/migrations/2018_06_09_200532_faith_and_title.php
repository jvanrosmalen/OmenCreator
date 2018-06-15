<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FaithAndTitle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create ( 'faiths', function (Blueprint $table) {
    		$table->increments('id')->index();
    		$table->string('faith_name');
    	} );

        Schema::table ( 'characters', function (Blueprint $table) {
            $table->integer( 'faith_id' )->unsigned();
            $table->string('title');
        } );

    	Schema::table ( 'characters', function (Blueprint $table) {
    		$table->foreign ( 'faith_id' )->references ( 'id' )->on ( 'faiths' );
        } );
        
        DB::table ( 'faiths' )->insert ( array (
            'faith_name' => 'geen'
        ) );
        DB::table ( 'faiths' )->insert ( array (
            'faith_name' => 'Alh&eacute;nnia'
        ) );
        DB::table ( 'faiths' )->insert ( array (
            'faith_name' => 'Alfar'
        ) );
        DB::table ( 'faiths' )->insert ( array (
            'faith_name' => 'Het Beest'
        ) );
        DB::table ( 'faiths' )->insert ( array (
            'faith_name' => 'Hymir'
        ) );
        DB::table ( 'faiths' )->insert ( array (
            'faith_name' => 'Melanthios'
        ) );
        DB::table ( 'faiths' )->insert ( array (
            'faith_name' => 'Senestha'
        ) );
        DB::table ( 'faiths' )->insert ( array (
            'faith_name' => 'Tallathan'
        ) );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table ( 'characters', function (Blueprint $table) {
            $table->dropColumn('faith_id');
        } );

        Schema::drop('faiths');
    }
}
