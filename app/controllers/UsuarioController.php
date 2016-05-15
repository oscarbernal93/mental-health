<?php

class UsuarioController extends BaseController {

	private $repositorio_usuarios;
	private $repositorio_pacientes;
	private $repositorio_medicos;
	private $repositorio_eps;
	private $repositorio_personas;
	function __construct()
	{
		$this->repositorio_usuarios = new UsuarioRepo;
		$this->repositorio_pacientes = new PacienteRepo;
		$this->repositorio_medicos = new MedicoRepo;
		$this->repositorio_eps = new EpsRepo;
		$this->repositorio_personas = new PersonaRepo;
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
		if (Auth::check()) {
			return Redirect::to('/')->with('message','Usted ya ha iniciado sesion en el sistema');
		}
		return View::make('login');
	}

	//carga el formulario de recuperar contraseña
	public function formularioRecuperar()
	{
		return View::make('recuperar');
	}

	//recuperar contraseña
	public function recuperarContrasena()
	{
		$usuario = Input::get('username');
		$entidad = $this->repositorio_usuarios->obtenerUsuario($usuario);
		if (is_null($entidad)) {
			return Redirect::to('/')->with('message','usuario incorrecto');
		}
		$token=base64_encode(Hash::make($usuario.$entidad->passhash));
		//generar un token-link y enviarlo al correo
		$link=action('UsuarioController@rehacer',array($usuario,$token));
		mail($entidad->email, 'Recuperacion de contraseña', "para recuperar su contraseña ingrese a <a href=\"$link\">$link</a>");
		return Redirect::to('/')->with('message','se ha mandado un correo de recuperacion! '.$link);
	}
	public function rehacer($usuario,$token)
	{
		$entidad = $this->repositorio_usuarios->obtenerUsuario($usuario);
		if (is_null($entidad)) {
			return Redirect::to('/')->with('message','usuario incorrecto');
		}
		$hash = base64_decode($token);
		if(Hash::check($usuario.$entidad->passhash, $hash)){
			return View::make('newpass')->with('usuario',$usuario);
		}else{
			return Redirect::to('/')->with('message','TokenIncorrecto');
		}
	}
	public function guardarContrasena()
	{
		$usuario = Input::get('username');
		$password = Input::get('password');
		$entidad = $this->repositorio_usuarios->obtenerUsuario($usuario);
		if (is_null($entidad)) {
			return Redirect::to('/')->with('message','usuario incorrecto');
		}
		$entidad->passhash = Hash::make($password);
		$entidad->save();
		return Redirect::to('/')->with('message','contraseña actualizada correctamenta');
	}

	//cierra sesion
	public function cerrarSesion()
	{
		Auth::logout();
		return Redirect::to('/')->with('message','Adios!');
	}
	//inicia sesion
	public function iniciarSesion()
	{
		$usuario = Input::get('username');
		$password = Input::get('password');

		$persona = $this->repositorio_usuarios->obtenerUsuario($usuario);
		if(is_null($persona))
		{
			$persona = $this->repositorio_personas->obtenerPersonaByDoc($usuario);
			$persona = $persona->usuario;
		}
		if (Hash::check($password, $persona->passhash))
		{
			Auth::login($persona);
			return Redirect::to('/')->with('message','Todo bien, todo bonito');
		}
		else
		{
			if (Hash::needsRehash($persona->passhash))
			{
				return Redirect::to('/')->with('message','La contraseña esta mala, comuniquese con el administrador del sistema');
			}
			else
			{
				return Redirect::to('/')->with('message','La contraseña es incorrecta');
			}
		}
		return Redirect::to('/')->with('message','No se encontró el usuario');
	}

	//carga permite seleccionar el tipo de formulario a mostrar
	public function tipoRegistro()
	{
		$tipos = array('paciente' => 'Paciente',
					   'medico' => 'Medico General',
					   'especialista' => 'Medico Especialista',
					   'eps'=>'Eps');
		//aqui se identifica si el usuario esta logueado
		if (Auth::check()) {
			$usuario = Auth::user();
			$roles = $this->repositorio_usuarios->getRoles($usuario->usuario);
			//y si lo que va a hacer es una reacomodacion
			$tipos = array_diff_key($tipos,$roles);
		}
		return View::make('registro')->with('tipos', $tipos);
	}

	//carga el formulario segun el tipo de registro que va a hacerse
	public function formularioRegistrarse()
	{
		$array_eps = array();
		foreach ($this->repositorio_eps->listarEps() as $eps) {
			$array_eps[$eps->id] = $eps->nombre;
		}
		$tipos_doc = array('cc' => 'Cedula de Ciudadania',
					   	   'ti' => 'Tarjeta de Identidad',
					   	   'ce' => 'Cedula de Extranjeria');
		$tipos_rh = array('op' => 'O+','on' => 'O-',
					   	  'ap' => 'A+','an' => 'A-',
					   	  'bp' => 'B+','bn' => 'B-',
					   	  'abp' => 'AB+','abn' => 'AB-');
		$tipos_estciv = array('soltero' => 'Soltero',
					   	      'casado' => 'Casado',
					   	      'complicado' => 'Es Complidado',
					   	      'triste' => 'Lechus no me Quiere');
		$tipo = Input::get('tipo');
		if("paciente"==$tipo)
		{
			return View::make('paciente.registro')->with('tipos_doc', $tipos_doc)
												  ->with('tipos_estciv', $tipos_estciv)
												  ->with('array_eps', $array_eps)
												  ->with('tipos_rh', $tipos_rh);
		}
		elseif ("medico"==$tipo)
		{
			return View::make('medico.registro')->with('tipos_doc', $tipos_doc)
												  ->with('tipos_estciv', $tipos_estciv)
												  ->with('array_eps', $array_eps)
												  ->with('tipos_rh', $tipos_rh);
		}
		elseif ("especialista"==$tipo)
		{
			return View::make('medico.registro_esp')->with('tipos_doc', $tipos_doc)
												  ->with('tipos_estciv', $tipos_estciv)
												  ->with('array_eps', $array_eps)
												  ->with('tipos_rh', $tipos_rh);
		}
		elseif ("eps"==$tipo)
		{
			return View::make('eps.registro');
		}
		else
		{
			return Redirect::back()->with('message','Seleccione un tipo Valido');
		}
	}

	//lista las solicitudes segun el rol del usuario logueado
	public function listarSolicitudes($algo=null)
	{
		if (Auth::check())
		{
			if(!is_null($algo))
			{
				if ('eps' == $algo)
				{
					if (Auth::user()->eps)
					{
						if (Auth::user()->eps->aprobado)
						{
							$solicitudes1 = $this->repositorio_pacientes->listarSolicitudes(Auth::user()->eps->id);
							$solicitudes2 = $this->repositorio_medicos->listarSolicitudes(Auth::user()->eps->id);
							return View::make('solicitudes')->with('pacientes',$solicitudes1)
															->with('medicos',$solicitudes2);
						}
					}
				}
			}
		    if(Auth::user()->admin)
		    {
		    	#es un administrador
		    	//se listan las solicitudes de eps
				$solicitudes = $this->repositorio_eps->listarSolicitudes();
				return View::make('eps.solicitudes')->with('solicitudes',$solicitudes);
		    }
		    elseif(!is_null(Auth::user()->eps))
		    {
		    	#se verifica si administra una eps
		    	if (Auth::user()->eps->aprobado)
		    	{
		    		#se verifica que la eps este aprobada
		    		//se listan las solicitudes de medicos y pacientes
		    		$solicitudes1 = $this->repositorio_pacientes->listarSolicitudes(Auth::user()->eps->id);
					$solicitudes2 = $this->repositorio_medicos->listarSolicitudes(Auth::user()->eps->id);
					return View::make('solicitudes')->with('pacientes',$solicitudes1)
													->with('medicos',$solicitudes2);
		    	}
		    }
		    else
		    {
		    	return Redirect::to('/')->with('message','Usted no tiene acceso a la gestion de solicitudes');
		    }
		}
		else
		{
			return Redirect::to('/')->with('message','Usted no ha iniciado sesion en el sistema');
		}
	}
	//carga el formulario para obtener otro rol
	public function formularioOtroRol()
	{
		//los diferentes formularios pueden ser
		//si quiere ser eps, no pide la info de usuario
		//si quiere ser paciente, medico o especialista
		//	si no tiene persona le pide toda la info menos usuario
		//	si tiene persona
		//	si quiere ser paciente solicita ser paciente sin pedir mas
		//	si quiere ser medico verifica si era especialista y pide solo lo faltante
		//	si no pide todos los datos de medico
		//	si quiere ser especialista verifica si era medico

		$array_eps = array();
		foreach ($this->repositorio_eps->listarEps() as $eps) {
			$array_eps[$eps->id] = $eps->nombre;
		}
		$tipos_doc = array('cc' => 'Cedula de Ciudadania',
					   	   'ti' => 'Tarjeta de Identidad',
					   	   'ce' => 'Cedula de Extranjeria');
		$tipos_rh = array('op' => 'O+','on' => 'O-',
					   	  'ap' => 'A+','an' => 'A-',
					   	  'bp' => 'B+','bn' => 'B-',
					   	  'abp' => 'AB+','abn' => 'AB-');
		$tipos_estciv = array('soltero' => 'Soltero',
					   	      'casado' => 'Casado',
					   	      'complicado' => 'Es Complidado',
					   	      'triste' => 'Lechus no me Quiere :(');
		$tipo = Input::get('tipo');
		if("eps"==$tipo)
		{
			return View::make('eps.rerol');
		}
		elseif ("paciente"==$tipo)
		{
			$persona = Auth::user()->persona;
			return View::make('paciente.rerol')->with('tipos_doc', $tipos_doc)
												  ->with('tipos_estciv', $tipos_estciv)
												  ->with('array_eps', $array_eps)
												  ->with('tipos_rh', $tipos_rh)
												  ->with('persona',$persona);
		}
		elseif ("medico"==$tipo)
		{
			$persona = Auth::user()->persona;//sin implmentar aun
			if(!is_null($persona)){
				if (!is_null($persona->medico)){
					if ($persona->medico->general) {
						return Redirect::back()->with('Usted ya es medico general');
					}else{
						//es especialista y quiere ser general
						$persona->medico->general = 1; //aqui hay un error pero nadie lo sabe
						$persona->medico->save();
					}
					
				}
				return View::make('medico.rerol')->with('tipos_doc', $tipos_doc)
												->with('tipos_estciv', $tipos_estciv)
												->with('array_eps', $array_eps)
												->with('tipos_rh', $tipos_rh)
												->with('persona',$persona);
			}
		}
		elseif ("especialista"==$tipo)
		{
		//sin implmentar aun
		//return Redirect::back()->with('message','Error de Implementacion');
			$persona = Auth::user()->persona;//sin implmentar aun
			if(!is_null($persona)){
				if (!is_null($persona->medico)){
					if ($persona->medico->especialidad != '' && !is_null($persona->medico->especialidad) ) {
						return Redirect::back()->with('Usted ya es medico especialista');
					}else{
						//es general y quiere ser especialista
						//se le pide el dato
						return View::make('medico.gen2esp')->with('medico_id',$persona->medico->id);
					}
					
				}
				return View::make('medico.rerol')->with('tipos_doc', $tipos_doc)
												->with('tipos_estciv', $tipos_estciv)
												->with('array_eps', $array_eps)
												->with('tipos_rh', $tipos_rh)
												->with('persona',$persona);
			}
		}
		else
		{
			return Redirect::back()->with('message','Seleccione un tipo Valido');
		}
	}
	//muesta una lista con los roles y le permite al usuario elegir cual rol editar
	public function tipoEdicion($value='')
	{
		if (Auth::check())
		{
			$usuario = Auth::user();
			$roles = $this->repositorio_usuarios->getRoles($usuario->usuario);
			return View::make('seleccionar_editar')->with('roles',$roles);
		}
		else
		{
			return Redirect::to('/')->with('message','Usted no ha iniciado sesion en el sistema');
		}
	}
	public function definirEdicion()
	{		
		$tipos_doc = array('cc' => 'Cedula de Ciudadania',
					   	   'ti' => 'Tarjeta de Identidad',
					   	   'ce' => 'Cedula de Extranjeria');
		$tipos_rh = array('op' => 'O+','on' => 'O-',
					   	  'ap' => 'A+','an' => 'A-',
					   	  'bp' => 'B+','bn' => 'B-',
					   	  'abp' => 'AB+','abn' => 'AB-');
		$tipos_estciv = array('soltero' => 'Soltero',
					   	      'casado' => 'Casado',
					   	      'complicado' => 'Es Complidado',
					   	      'triste' => 'Lechus no me Quiere');
		$rol = Input::get('rol');
		$usuario = Auth::user();
		if ('admin' == $rol)
		{
			# code...
			return View::make('editar_admin')->with('usuario',$usuario);
		}
		elseif('eps' == $rol)
		{
			# code...
			return View::make('eps.editar')->with('eps',$usuario->eps);
		}
		elseif('paciente' == $rol)
		{
			# code...
			return View::make('paciente.editar')->with('persona',$usuario->persona)
												  ->with('tipos_estciv', $tipos_estciv)
												  ->with('tipos_rh', $tipos_rh)
												  ->with('tipos_doc', $tipos_doc);
		}
		elseif('medico' == $rol)
		{
			# code...
			return View::make('medico.editar')->with('persona',$usuario->persona)
												->with('tipos_estciv', $tipos_estciv)
												  ->with('tipos_rh', $tipos_rh)
												  ->with('tipos_doc', $tipos_doc);
		}
		elseif('especialista' == $rol)
		{
			# code...
			return View::make('medico.editar_esp')->with('persona',$usuario->persona)
													->with('tipos_estciv', $tipos_estciv)
												  	->with('tipos_rh', $tipos_rh)
												  	->with('tipos_doc', $tipos_doc);
		}
		else
		{
			#code
			return Redirect::to('/')->with('message','Debe seleccionar un rol valido');
		}
	}

}
