<?php

class PacienteController extends BaseController {

	private $repositorio_usuarios;
	private $repositorio_pacientes;

	function __construct()
	{
		$this->repositorio_usuarios = new UsuarioRepo;
		$this->repositorio_pacientes = new PacienteRepo;
	}

	//recibe, valida y guarda la informacion del registro
	public function guardarRegistro()
	{
		//se valida la informacion de acuerdo a las reglas especificadas
		$validator = Validator::make(
		    Input::all(),
		    array(
		        'name' => 'required',
		        'password' => 'required|min:8',
		        'email' => 'required|email|unique:users'
		    )
		);
		if ($validator->fails())
		{
		    return Redirect::back()->withErrors($validator);
		}

		var_dump(Input::all());
		die();
	}
}
