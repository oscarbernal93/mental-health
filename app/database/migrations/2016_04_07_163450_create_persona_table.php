<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('persona', function($table)
		    {
		        $table->increments('id');
		        $table->integer('id_paciente')->nullable();
		        $table->integer('id_medico')->nullable();
		        $table->string('nombre');
		        $table->string('fecha_nacimiento');
		        $table->string('tipo_documento');
		        $table->string('documento');
		        $table->string('rh');
		        $table->string('estado_civil');
		        $table->string('telefono');
		        $table->string('url_foto');
		        $table->timestamps();
		        $table->softDeletes();

		        //definicion de llaves
		        $table->primary('id');
		        $table->foreign('id_eps')->references('id')->on('eps');
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
