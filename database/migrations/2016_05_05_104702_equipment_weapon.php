<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EquipmentWeapon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create ( 'weapons', function (Blueprint $table) {
			$table->increments ( 'id' )->index ();
			$table->string ('name');
			$table->text( 'description' );
			$table->integer('price_normal');
			$table->integer('price_good');
			$table->integer('price_master');
		} );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('weapons');
    }
}
