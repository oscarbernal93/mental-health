<?php

return 
	array(
		array('url' => action('UsuarioController@formularioLogin'),
			  'nombre' => 'Iniciar Sesion'),
		array('url' => action('UsuarioController@tipoRegistro'),
			  'nombre' => 'Registrarse'),
		array('url' => action('UsuarioController@listarSolicitudes'),
			  'nombre' => 'Listar Solicitudes'),
		array('url' => action('UsuarioController@cerrarSesion'),
			  'nombre' => 'Cerrar Sesion'),
	);



