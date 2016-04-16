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
		        'usuario' => 'required|unique:usuario',
		        'password' => 'required|min:8',
		        'email' => 'required|email|unique:usuario',
		        'nombre' => 'required',
		        'fecha_de_nacimiento' => 'required|date',
		        'tipo_de_documento' => 'required|in:cc,ti,ce',
		        'documento' => 'required',
		        'rh' => 'required|in:op,on,ap,an,bp,bn,abp,abn',
		        'estado_civil' => 'required|in:soltero,casado,complicado,triste',
		        'telefono' => 'required',
		        'foto_de_perfil' => 'required|image',
		    )
		);
		if ($validator->fails())
		{
		    return Redirect::back()->withErrors($validator)
		    					   ->withInput(Input::except('password','foto_de_perfil'));;
		}
		else
		{
			//si pasa la validacion obtiene toda la informacion
			$usuario = Input::get('usuario');
			$password = Input::get('password');
			$email = Input::get('email');
			$nombre = Input::get('nombre');
			$fecha_de_nacimiento = Input::get('fecha_de_nacimiento');
			$tipo_de_documento = Input::get('tipo_de_documento');
			$documento = Input::get('documento');
			$rh = Input::get('rh');
			$estado_civil = Input::get('estado_civil');
			$telefono = Input::get('telefono');
			//se almacena la imagen y se guarda la url
			$file = Input::file('foto_de_perfil');
			$destinationPath = 'uploads/';
			$filename = time().$file->getClientOriginalName();
			$file->move($destinationPath, $filename);
			$url = asset("uploads/".$filename);
			var_dump("<a href='".$url."'>$url</a>");
		}
		die();
	}
}
