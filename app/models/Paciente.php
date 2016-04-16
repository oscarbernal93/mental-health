<?php

class Paciente extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'paciente';
	protected $primaryKey = 'id';
	use SoftDeletingTrait;
    protected $dates = array('deleted_at');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public function perfil()
	{
		return $this->BelongsTo('Perfil','id_perfil', 'id');
	}

	public function eps()
	{
		return $this->BelongsTo('Eps','id_eps', 'id');
	}

	public function persona()
    {
        return $this->hasOne('Persona','id_paciente');
    }
}
