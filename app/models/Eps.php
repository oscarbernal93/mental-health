<?php

class Eps extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'eps';
	protected $primaryKey = 'id';
	use SoftDeletingTrait;
    protected $dates = array('deleted_at');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public function usuario()
	{
		return $this->hasOne('Usuario', 'id_eps', 'id');
	}
	public function medicos()
	{
		return $this->hasMany('Medico', 'id_eps', 'id');
	}
	public function pacientes()
	{
		return $this->hasMany('Paciente', 'id_eps', 'id');
	}

}
