<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cita', function($table)
		    {
		    	//Campos de la tabla
		        $table->integer('id',true);
		        $table->integer('id_paciente')->nullable();
		        $table->integer('id_medico')->nullable();
		        $table->integer('id_medico_remitente')->nullable();
		        $table->string('tipo');
		        $table->integer('calificacion');
		        $table->integer('turno');
		        $table->integer('dia');
		        $table->boolean('finalizado');
		        $table->timestamps();
		        $table->softDeletes();

		        //definicion de llaves
		        $table->foreign('id_paciente')->references('id')->on('paciente');
		        $table->foreign('id_medico')->references('id')->on('medico');
		        $table->foreign('id_medico_remitente')->references('id')->on('medico');
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