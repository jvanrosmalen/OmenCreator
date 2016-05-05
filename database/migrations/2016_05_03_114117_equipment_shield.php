<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EquipmentShield extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create ( 'Shields', function (Blueprint $table) {
			$table->increments ( 'id' )->index ();
			$table->string ('name');
			$table->text( 'description' );
			$table->integer('price_normal');
			$table->integer('price_good');
			$table->integer('price_master');
			$table->integer('armor_normal');
			$table->integer('armor_good');
			$table->integer('armor_master');
			$table->integer('structure_normal');
			$table->integer('structure_good');
			$table->integer('structure_master');
		} );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Shields');
    }
}
