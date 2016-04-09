<?php

class Perfil extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'perfil';
	protected $primaryKey = 'id';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public function pacientes()
	{
		return $this->hasMany('Paciente', 'id_perfil', 'id');
	}

}
