<?php

class Medico extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'medico';
	protected $primaryKey = 'id';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public function eps()
	{
		return $this->BelongsTo('Eps', 'id_eps', 'id');
	}

	public function persona()
    {
        return $this->hasOne('Persona', 'id_persona', 'id');
    }
}
