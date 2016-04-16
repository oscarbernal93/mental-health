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

//rutas de usuario
Route::get('usuarios', 'UsuarioController@mostrarUsuarios');
Route::get('usuario/{usuario}', 'UsuarioController@detallesUsuario');
Route::get('login', 'UsuarioController@formularioLogin');
Route::post('login', 'UsuarioController@iniciarSesion');
Route::get('registro', 'UsuarioController@tipoRegistro');
Route::get('formulario', 'UsuarioController@formularioRegistrarse');
//rutas de paciente
Route::post('paciente/guardar', 'PacienteController@guardarRegistro');

Route::get('/', function()
{
	return View::make('hello');
});
