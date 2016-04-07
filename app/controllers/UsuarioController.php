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
		$persona = $this->repositorio_usuarios->obtenerUsuario($usuario);
    	return View::make('persona')->with('persona', $persona);
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
}
