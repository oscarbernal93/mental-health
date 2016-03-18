<?php

class UsuarioController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function mostrarUsuarios()
	{
		$usuarios = Usuario::all();
    	return View::make('usuarios')->with('usuarios', $usuarios);
	}

	public function detallesUsuario($usuario)
	{
		$persona = Usuario::find($usuario);
    	return View::make('persona')->with('persona', $persona);
	}

	public function formularioLogin()
	{
		return View::make('login');
	}

	public function iniciarSesion()
	{
		$usuario = Input::get('username');
		$password = Input::get('password');

		$persona = Usuario::find($usuario);
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
