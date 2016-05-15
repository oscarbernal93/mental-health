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
Route::get('recuperar', 'UsuarioController@formularioRecuperar');
Route::post('recuperar', 'UsuarioController@recuperarContrasena');
Route::get('recuperar/{usuario}/{token}', 'UsuarioController@rehacer');
Route::post('recuperar/guardar', 'UsuarioController@guardarContrasena');
Route::get('logout', 'UsuarioController@cerrarSesion');
Route::get('registro', 'UsuarioController@tipoRegistro');
Route::get('formulario', 'UsuarioController@formularioRegistrarse');
Route::get('solicitudes/{algo?}', 'UsuarioController@listarSolicitudes');
Route::get('adicionar-rol', 'UsuarioController@formularioOtroRol');
Route::get('editar', 'UsuarioController@tipoEdicion');
Route::post('edicion', 'UsuarioController@definirEdicion');
Route::post('usuario/guardare', 'UsuarioController@guardarEdicion');
//rutas de paciente
Route::post('paciente/guardar', 'PacienteController@guardarRegistro');
Route::post('paciente/guardar-rrcp', 'PacienteController@guardarReRolConPersona');
Route::post('paciente/guardar-rrsp', 'PacienteController@guardarReRolSinPersona');
Route::get('paciente/cita/eliminar', 'PacienteController@eliminarCita');
Route::post('paciente/cita/eliminar', 'PacienteController@eliminarCita');
Route::get('paciente/cita/modificar/{id}', 'PacienteController@modificarCita');

Route::post('solicitudes/paciente/aprobar/', 'PacienteController@aprobarSolicitud');
Route::post('solicitudes/paciente/eliminar/', 'PacienteController@borrarSolicitud');
Route::post('paciente/guardare', 'PacienteController@guardarEdicion');
Route::get('lista/medicos', 'PacienteController@listarMedicos');
Route::get('medico/agenda/{id}', 'PacienteController@verHorarioMedico');
Route::post('medico/agenda/', 'PacienteController@pedirCita');
Route::post('medico/cambio/cita', 'PacienteController@efectuarCambioCita');
//rutas de medico
Route::post('medico/guardar', 'MedicoController@guardarRegistro');
Route::post('solicitudes/medico/aprobar/', 'MedicoController@aprobarSolicitud');
Route::post('solicitudes/medico/eliminar/', 'MedicoController@borrarSolicitud');
Route::post('medico/guardare', 'MedicoController@guardarEdicion');
Route::get('medico/horario', 'MedicoController@verHorario');
Route::get('medico/horario/editar', 'MedicoController@formularioEditarHorario');
Route::post('medico/horario/editar', 'MedicoController@editarHorario');
Route::post('medico/rerolcon', 'MedicoController@guardarReRolConPersona');
Route::post('medico/rerolsin', 'MedicoController@guardarReRolSinPersona');
Route::post('medico/gen2esp', 'MedicoController@guardarGen2esp');
//rutas de Eps
Route::post('eps/guardar', 'EpsController@guardarRegistro');
Route::post('eps/guardar-rr', 'EpsController@guardarReRol');
Route::post('solicitudes/eps/aprobar/', 'EpsController@aprobarSolicitud');
Route::post('solicitudes/eps/eliminar/', 'EpsController@borrarSolicitud');
Route::post('eps/guardare', 'EpsController@guardarEdicion');

Route::get('/', 'InicioController@paginaInicio');

