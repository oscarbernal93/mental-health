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
Route::get('solicitudes', 'UsuarioController@listarSolicitudes');
Route::get('adicionar-rol', 'UsuarioController@formularioOtroRol');
//rutas de paciente
Route::post('paciente/guardar', 'PacienteController@guardarRegistro');
Route::post('paciente/guardar-rrcp', 'PacienteController@guardarReRolConPersona');
Route::post('paciente/guardar-rrsp', 'PacienteController@guardarReRolSinPersona');
Route::post('solicitudes/paciente/aprobar/', 'PacienteController@aprobarSolicitud');
Route::post('solicitudes/paciente/eliminar/', 'PacienteController@borrarSolicitud');
//rutas de medico
Route::post('medico/guardar', 'MedicoController@guardarRegistro');
Route::post('solicitudes/medico/aprobar/', 'MedicoController@aprobarSolicitud');
Route::post('solicitudes/medico/eliminar/', 'MedicoController@borrarSolicitud');
//rutas de Eps
Route::post('eps/guardar', 'EpsController@guardarRegistro');
Route::post('eps/guardar-rr', 'EpsController@guardarReRol');
Route::post('solicitudes/medico/aprobar/', 'EpsController@aprobarSolicitud');
Route::post('solicitudes/medico/eliminar/', 'EpsController@borrarSolicitud');

Route::get('/', 'InicioController@paginaInicio');

