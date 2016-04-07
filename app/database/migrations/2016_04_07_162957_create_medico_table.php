<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Medico extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medico', function($table)
		    {
		        $table->increments('id');
		        $table->integer('id_eps');
		        $table->boolean('aprobado');
		        $table->string('email');
		        $table->boolean('general');
		        $table->string('info_academica');
		        $table->string('especialidad')->nullable();
		        $table->string('lunes');
		        $table->string('martes');
		        $table->string('miercoles');
		        $table->string('jueves');
		        $table->string('viernes');
		        $table->string('sabado');
		        $table->string('domingo');
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
