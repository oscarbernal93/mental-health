<?php

class UsuarioController extends BaseController {

	private $repositorio_usuarios;

	function __construct()
	{
		$this->repositorio_usuarios = new UsuarioRepo;
	}

	//muestra una lista de todos los usuarios existentes
	public function mostrarUsuarios()
	{
		$usuarios = $this->repositorio_usuarios->listarUsuarios();
    	return View::make('usuarios')->with('usuarios', $usuarios);
	}

	//muestra los detalles de un usuario especifico
	public function detallesUsuario($usuario)
	{
		$sujeto = $this->repositorio_usuarios->obtenerUsuario($usuario);
    	return View::make('usuario')->with('sujeto', $sujeto);
	}

	//carga el formulario de login y lo entrega a la vista
	public function formularioLogin()
	{
		return View::make('login');
	}

	//
	public function iniciarSesion()
	{
		$usuario = Input::get('username');
		$password = Input::get('password');

		$persona = $this->repositorio_usuarios->obtenerUsuario($usuario);
		if(!is_null($persona)){
			if (Hash::check($password, $persona->passhash)) {
				Auth::login($persona);
				return Redirect::to('/')->with('message','Todo bien, todo bonito');
			}else{
				if (Hash::needsRehash($persona->passhash)) {
					return Redirect::to('/')->with('message','La contraseña esta mala, comuniquese con el administrador del sistema');
				}else{
					return Redirect::to('/')->with('message','La contraseña es incorrecta');
				}
			}
		}else{
			return Redirect::to('/')->with('message','El usuario no existe');
		}
		return Redirect::to('/')->with('message','Algo salio mal');
	}

	//carga permite seleccionar el tipo de formulario a mostrar
	public function tipoRegistro()
	{
		$tipos = array('paciente' => 'Paciente',
					   'medico' => 'Medico',
					   'eps'=>'Eps');
		return View::make('registro')->with('tipos', $tipos);
	}

	//carga el formulario segun el tipo de registro que va a hacerse
	public function formularioRegistrarse()
	{
		$tipos_doc = array('cc' => 'Cedula de Ciudadania',
					   	   'ti' => 'Tarjeta de Identidad',
					   	   'ce' => 'Cedula de Extranjeria');
		$tipos_rh = array('op' => 'O+','on' => 'O-',
					   	  'ap' => 'A+','an' => 'A-',
					   	  'bp' => 'B+','bn' => 'B-',
					   	  'abp' => 'AB+','abn' => 'AB-');
		$tipos_estciv = array('s' => 'Soltero',
					   	      'c' => 'Casado',
					   	      'e' => 'Es Complidado',
					   	      'n' => 'Lechus no me Quiere');
		$tipo = Input::get('tipo');
		if("paciente"==$tipo){
			return View::make('paciente.registro')->with('tipos_doc', $tipos_doc)
												  ->with('tipos_estciv', $tipos_estciv)
												  ->with('tipos_rh', $tipos_rh);
		}elseif ("medico"==$tipo) {
			return View::make('medico.registro');
		}elseif ("eps"==$tipo) {
			return View::make('eps.registro');
		}else{
			return Redirect::back()->with('message','Seleccione un tipo Valido');
		}
	}
}
