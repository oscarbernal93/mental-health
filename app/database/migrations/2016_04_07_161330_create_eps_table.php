<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('eps', function($table)
		    {
		        $table->increments('id');
		        $table->string('nombre');
		        $table->string('telefono');
		        $table->string('direccion');
		        $table->text('info_sedes');
		        $table->string('email');
		        $table->boolean('aprobado');
		        $table->string('url_logo');
		        $table->timestamps();
		        $table->softDeletes();

		        //definicion de llaves
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
