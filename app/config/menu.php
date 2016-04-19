<?php

return 
	array(
		array('url' => action('UsuarioController@formularioLogin'),
			  'nombre' => 'Iniciar Sesion'),
		array('url' => action('UsuarioController@tipoRegistro'),
			  'nombre' => 'Registrarse'),
		array('url' => action('UsuarioController@listarSolicitudes'),
			  'nombre' => 'Solicitudes'),
		array('url' => action('UsuarioController@tipoEdicion'),
			  'nombre' => 'Editar Cuenta'),
		array('url' => action('UsuarioController@cerrarSesion'),
			  'nombre' => 'Cerrar Sesion'),
	);



