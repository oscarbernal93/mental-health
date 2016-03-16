<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioTable extends Migration {

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
		        $table->string('email')->unique();
		        $table->string('passhash');
		        $table->boolean('super');
		        $table->rememberToken();
		        $table->timestamps();
		        $table->softDeletes();

		        //definicion de llaves
		        $table->primary('usuario');
		    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuario');
	}

}
