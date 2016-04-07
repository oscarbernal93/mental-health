<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('new/{usuario}/{email}/{password}', function($usuario, $email, $password)
{
	Usuario::create(array(
        'usuario'     => $usuario,
        'email'    => $email,
        'passhash' => Hash::make($password),
        'super' => false,
    ));
    return Redirect::to('/')->with('message', "Usuario: $usuario, creado satisfactoriamente");
});

Route::get('usuarios', 'UsuarioController@mostrarUsuarios');
Route::get('persona/{usuario}', 'UsuarioController@detallesUsuario');
Route::get('login', 'UsuarioController@formularioLogin');
Route::post('login', 'UsuarioController@iniciarSesion');

Route::get('/', function()
{
	return View::make('hello');
	//de nada
});
