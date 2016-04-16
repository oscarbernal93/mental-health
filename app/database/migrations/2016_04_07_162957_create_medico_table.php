<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medico', function($table)
		    {
		        $table->integer('id',true);
		        $table->integer('id_eps')->nullable();
		        $table->boolean('aprobado');
		        $table->string('email');
		        $table->boolean('general');
		        $table->string('info_academica');
		        $table->string('especialidad')->nullable();
		        $table->string('lunes')->nullable();
		        $table->string('martes')->nullable();
		        $table->string('miercoles')->nullable();
		        $table->string('jueves')->nullable();
		        $table->string('viernes')->nullable();
		        $table->string('sabado')->nullable();
		        $table->string('domingo')->nullable();
		        $table->timestamps();
		        $table->softDeletes();

		        //definicion de llaves
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
