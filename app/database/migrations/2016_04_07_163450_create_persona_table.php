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
		        $table->integer('id',true);
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
		        $table->foreign('id_paciente')->references('id')->on('paciente');
		        $table->foreign('id_medico')->references('id')->on('medico');
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
