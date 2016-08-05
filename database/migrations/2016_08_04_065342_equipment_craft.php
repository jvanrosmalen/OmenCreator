<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EquipmentCraft extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create ( 'CraftEquipments', function (Blueprint $table) {
			$table->increments ( 'id' )->index ();
			$table->string ('name');
			$table->text( 'description' );
			$table->integer('price');
		} );
		
		Schema::create ( 'CraftEquipmentsStatisticRules', function (Blueprint $table) {
			$table->integer( 'craft_equipment_id' )->unsigned()->index();
			$table->integer( 'statistic_rules_id' )->unsigned()->index();
		} );
		
		Schema::table('CraftEquipmentsStatisticRules', function(Blueprint $table){
			$table->foreign('craft_equipment_id')->references('id')->on('CraftEquipments');
			$table->foreign('statistic_rules_id')->references('id')->on('StatisticRules');
		});
		
		Schema::create ( 'CraftEquipmentsSkills', function (Blueprint $table) {
			$table->integer( 'craft_equipment_id' )->unsigned()->index();
			$table->integer( 'skills_id' )->unsigned()->index();
		} );

		Schema::table('CraftEquipmentsSkills', function(Blueprint $table){
			$table->foreign('craft_equipment_id')->references('id')->on('CraftEquipments');
			$table->foreign('skills_id')->references('id')->on('Skills');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::drop('CraftEquipmentsStatisticRules');
    	Schema::drop('CraftEquipmentsSkills');
    	Schema::drop('CraftEquipments');
    }
}
