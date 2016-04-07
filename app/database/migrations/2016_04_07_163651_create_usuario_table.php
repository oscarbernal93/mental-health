<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Usuario extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuario', function($table)
		    {
		        $table->string('usuario');
		        $table->integer('id_persona');
		        $table->integer('id_eps');
		        $table->string('email')->unique();
		        $table->string('passhash');
		        $table->boolean('admin');
		        $table->rememberToken();
		        $table->timestamps();
		        $table->softDeletes();

		        //definicion de llaves
		        $table->primary('usuario');
		        $table->foreign('id_persona')->references('id')->on('persona');
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
