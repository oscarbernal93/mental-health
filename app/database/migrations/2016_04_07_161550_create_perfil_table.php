<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Perfil extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('perfil', function($table)
		    {
		        $table->increments('id');
		        $table->string('nombre')
		        $table->string('descripcion');
		        $table->timestamps();
		        $table->softDeletes();

		        //definicion de llaves
		        $table->primary('id');
		    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
