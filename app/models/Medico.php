<?php

class Medico extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'medico';
	protected $primaryKey = 'id';
	use SoftDeletingTrait;
    protected $dates = array('deleted_at');

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
        return $this->hasOne('Persona', 'id_medico', 'id');
    }
}
