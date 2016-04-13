<?php

class Persona extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'persona';
	protected $primaryKey = 'id';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public function paciente()
	{
		return $this->BelongsTo('Paciente');
	}

	public function medico()
	{
		return $this->BelongsTo('Medico');
	}

	public function usuario()
    {
        return $this->BelongsTo('Usuario');
    }
}
