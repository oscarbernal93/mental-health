<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usuario';
	protected $primaryKey = 'usuario';
	use SoftDeletingTrait;
    protected $dates = array('deleted_at');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('remember_token');
	protected $fillable = array('usuario', 'email', 'passhash','admin');

	public function persona()
    {
        return $this->BelongsTo('Persona', 'id_persona', 'id');
    }
    
    public function eps()
	{
		return $this->BelongsTo('Eps','id_eps','id');
	}
}
