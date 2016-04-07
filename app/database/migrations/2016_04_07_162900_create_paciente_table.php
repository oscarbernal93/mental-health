<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paciente', function($table)
		    {
		        $table->integer('id',true);
		        $table->integer('id_perfil');
		        $table->integer('id_eps');
		        $table->boolean('aprobado');
		        $table->timestamps();
		        $table->softDeletes();

		        //definicion de llaves
		        $table->foreign('id_eps')->references('id')->on('eps');
		        $table->foreign('id_perfil')->references('id')->on('perfil');
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
