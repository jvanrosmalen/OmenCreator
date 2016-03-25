<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('races', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('descr');
        });


        // Seed the race table
        DB::table ( 'Races' )->insert ( array ('name' => 'Mannheimer') );
        DB::table ( 'Race' )->insert ( array ('name' => 'Goliad') );
        DB::table ( 'Race' )->insert ( array ('name' => 'Khalier') );
        DB::table ( 'Race' )->insert ( array ('name' => 'Bhanda Korr') );
        DB::table ( 'Race' )->insert ( array ('name' => 'Ranae') );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('races');
    }
}
