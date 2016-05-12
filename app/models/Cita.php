<?php

class Cita extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cita';
	protected $primaryKey = 'id';
	use SoftDeletingTrait;
    protected $dates = array('deleted_at');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	//FALTAN FUNCIONES
	public function paciente()
	{
		return $this->BelongsTo('Paciente','id_paciente','id');
	}

	public function medico()
	{
		return $this->BelongsTo('Medico','id_medico','id');
	}
	public function medico_remitente()
	{
		return $this->BelongsTo('Medico','id_medico_remitente','id');
	}

	
}
