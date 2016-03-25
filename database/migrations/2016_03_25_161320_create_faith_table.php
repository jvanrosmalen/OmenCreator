<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaithTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faiths', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('descr');
        });


        // Seed the faiths table
        DB::table ( 'faiths' )->insert ( array ('name' => 'De Alfar') );
        DB::table ( 'faiths' )->insert ( array ('name' => 'Hymier') );
        DB::table ( 'faiths' )->insert ( array ('name' => 'Tallathan') );
        DB::table ( 'faiths' )->insert ( array ('name' => 'Ahlénnia') );
        DB::table ( 'faiths' )->insert ( array ('name' => 'Senestha') );
        DB::table ( 'faiths' )->insert ( array ('name' => 'Het Beest') );
        DB::table ( 'faiths' )->insert ( array ('name' => 'Melanthios') );
        DB::table ( 'faiths' )->insert ( array ('name' => 'Agnost') );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('faiths');
    }
}
