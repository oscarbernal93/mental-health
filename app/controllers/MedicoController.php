<?php

class MedicoController extends BaseController {

	private $repositorio_usuarios;
	private $repositorio_medicos;
	private $repositorio_personas;
	private $repositorio_eps;

	function __construct()
	{
		$this->repositorio_usuarios = new UsuarioRepo;
		$this->repositorio_medicos = new MedicoRepo;
		$this->repositorio_personas = new PersonaRepo;
		$this->repositorio_eps = new EpsRepo;
	}

	//recibe, valida y guarda la informacion del registro
	public function guardarRegistro()
	{
		//se valida la informacion de acuerdo a las reglas especificadas
		$validator = Validator::make(
		    Input::all(),
		    array(
		        'eps' => 'required|exists:eps,id',
		        'usuario' => 'required|unique:usuario',
		        'password' => 'required|min:8',
		        'email' => 'required|email|unique:usuario',
		        'nombre' => 'required',
		        'fecha_de_nacimiento' => 'required|date',
		        'tipo_de_documento' => 'required|in:cc,ti,ce',
		        'documento' => 'required',
		        'rh' => 'required|in:op,on,ap,an,bp,bn,abp,abn',
		        'estado_civil' => 'required|in:soltero,casado,complicado,triste',
		        'telefono' => 'required',
		        'foto_de_perfil' => 'required|image',
		        'correo_institucional' => 'email',
		        'general' => 'required|boolean',
		        'info_academica' => 'required',
		        'especialidad' => ''
		    )
		);
		if ($validator->fails())
		{
		    return Redirect::back()->withErrors($validator)
		    					   ->withInput(Input::except('password','foto_de_perfil'));;
		}
		else
		{
			//si pasa la validacion obtiene toda la informacion
			$eps = Input::get('eps');
			$usuario = Input::get('usuario');
			$password = Input::get('password');
			$email = Input::get('email');
			$nombre = Input::get('nombre');
			$fecha_de_nacimiento = Input::get('fecha_de_nacimiento');
			$tipo_de_documento = Input::get('tipo_de_documento');
			$documento = Input::get('documento');
			$rh = Input::get('rh');
			$estado_civil = Input::get('estado_civil');
			$telefono = Input::get('telefono');
			$correo_institucional = Input::get('correo_institucional');
			$general = Input::get('general');
			$info_academica = Input::get('info_academica');
			$especialidad = Input::get('especialidad');
			//se almacena la imagen y se guarda la url
			$file = Input::file('foto_de_perfil');
			$destinationPath = 'uploads/';
			$filename = time().$file->getClientOriginalName();
			$file->move($destinationPath, $filename);
			$url_foto = asset("uploads/".$filename);
			//ahora se crean las entidades correspondientes
			//un medico, una persona y un usuario
			$entidad_medico = $this->repositorio_medicos->crearMedico($correo_institucional,$general,$info_academica,$especialidad);
			$entidad_persona = $this->repositorio_personas->crearPersona($nombre,$fecha_de_nacimiento,$tipo_de_documento,$documento,$rh,$estado_civil,$telefono,$url_foto);
			$entidad_usuario = $this->repositorio_usuarios->crearUsuario($usuario,$password,$email);
			//se busca la entidad de la eps
			$entidad_eps = $this->repositorio_eps->obtenerEps($eps);
			//ahora se establecen las relaciones entre las entidades
			$entidad_usuario->persona()->associate($entidad_persona);
			$entidad_persona->medico()->associate($entidad_medico);
			$entidad_medico->eps()->associate($entidad_eps);
			//se guardan los cambios
			$entidad_usuario->save();
			$entidad_persona->save();
			$entidad_medico->save();
			//finalmente se redirecciona
			return Redirect::to('/')->with('message','Su solicitud de registro se a almacenado correctamente, una vez sea aprobada se le notificará al correo electronico proporcionado');
		}
	}
	//funcion que permite aprobar una solicitud
	public function aprobarSolicitud()
	{
		$id = Input::get('id');
		$destinatario = Medico::find($id)->persona->usuario->email;
		$this->repositorio_medicos->aprobarMedico($id);
		//se manda el mensaje
		mail($destinatario, 'Correo de Notificacion', "Su solicitud para registrarse como Medico en nuestra plataforma ha sido aprobada");
		//se redirecciona
		return Redirect::to('/')->with('message','Medico aprobado correctamente');
	}
	//funcion que permite borrar una solicitud
	public function borrarSolicitud()
	{
		$id = Input::get('id');
		$destinatario = Medico::find($id)->persona->usuario->email;
		$this->repositorio_medicos->borrarMedico($id);
		//se manda el mensaje
		mail($destinatario, 'Correo de Notificacion', "Su solicitud para registrarse como Medico en nuestra plataforma ha sido rechazada");
		//se redirecciona
		return Redirect::to('/')->with('message','Medico eliminado correctamente');
	}
	public function verHorario()
	{
		$estado = array(
			'0' => 'No disponible',
			'1' => 'Cita como Esp.',
			'2' => 'Cita como Gen.',
			'3' => 'Libre como Esp.',
			'4' => 'Libre como Gen.'
			);
		$colores = array(
			'0' => 'active',
			'1' => 'danger',
			'2' => 'danger',
			'3' => 'info',
			'4' => 'success',
			);
		if (Auth::check()) {
			$persona = Auth::user()->persona;
			if (is_null($persona)) {
				$medico = NULL;
			}else{
				$medico = $persona->medico;
			}
			if (!is_null($medico)){
				$turnos = array();
				$turnos['lunes'] = $medico->lunes;
				$turnos['martes'] = $medico->martes;
				$turnos['miercoles'] = $medico->miercoles;
				$turnos['jueves'] = $medico->jueves;
				$turnos['viernes'] = $medico->viernes;
				$turnos['sabado'] = $medico->sabado;
				return View::make('medico.horario')->with('turnos',$turnos)->with('estado',$estado)->with('colores',$colores);
				
			}
			else
			{
				$paciente = $persona->paciente;
				if (!is_null($paciente)) {
					return Redirect::action('PacienteController@listarMedicos');
				}
				return Redirect::to('/')->with('message','Usted no es medico');
			}
		}
		else
		{
			return Redirect::to('/')->with('message','usted no ha iniciado sesion correctamente');
		}
	}
	public function formularioEditarHorario()
	{		
		if (Auth::check()) {
			$persona = Auth::user()->persona;
			if (is_null($persona)) {
				$medico = NULL;
			}else{
				$medico = $persona->medico;
			}
			if (!is_null($medico)){
				if((!is_null($medico->especialidad))and($medico->general==1)){				
				$estados = array(
						'0' => 'No disponible',
						'3' => 'Libre como Esp.',
						'4' => 'Libre como Gen.'
					);
				}else{
					if(is_null($medico->especialidad)){
						$estados = array(
							'0' => 'No disponible',
							'4' => 'Libre como Gen.'
						);
					}else{
						$estados = array(
							'0' => 'No disponible',
							'3' => 'Libre como Esp.'
						);
					}					
				}
				
				$turnos = array();
				$turnos['lunes'] = $medico->lunes;
				$turnos['martes'] = $medico->martes;
				$turnos['miercoles'] = $medico->miercoles;
				$turnos['jueves'] = $medico->jueves;
				$turnos['viernes'] = $medico->viernes;
				$turnos['sabado'] = $medico->sabado;
				return View::make('medico.formulario_horario')->with('turnos',$turnos)->with('estados',$estados);
				
			}
			else
			{
				return Redirect::to('/')->with('message','Usted no es medico');
			}
		}
		else
		{
			return Redirect::to('/')->with('message','usted no ha iniciado sesion correctamente');
		}		
	}
	public function editarHorario()
	{
		$medico = Auth::user()->persona->medico;
		$horario = (Input::all());
		$salida = array();
		$dias = array('lunes','martes','miercoles','jueves','viernes','sabado');
		foreach ($dias as $dia) {
			$temp='';
			for($j=0;$j<16;$j++){
				$temp.=$horario[$dia.$j];
			}
			$salida[$dia]=$temp;	
		}
		$this->repositorio_medicos->actualizarAgenda($medico->id,$salida);
		mail($medico->email,'Actualizacion de Agenda','Su horario ha sido modificado correctamente.');
		return Redirect::action('MedicoController@verHorario')->with('message','horario actualizado correctamente');
	}
	public function guardarReRolSinPersona()
	{
		//se valida la informacion de acuerdo a las reglas especificadas
		$validator = Validator::make(
		    Input::all(),
		    array(
		        'eps' => 'required|exists:eps,id',
		        'nombre' => 'required',
		        'fecha_de_nacimiento' => 'required|date',
		        'tipo_de_documento' => 'required|in:cc,ti,ce',
		        'documento' => 'required',
		        'rh' => 'required|in:op,on,ap,an,bp,bn,abp,abn',
		        'estado_civil' => 'required|in:soltero,casado,complicado,triste',
		        'telefono' => 'required',
		        'foto_de_perfil' => 'required|image',
		        'correo_institucional' => 'email',
		        'general' => 'required|boolean',
		        'info_academica' => 'required',
		        'especialidad' => ''
		    )
		);
		if ($validator->fails())
		{
		    return Redirect::back()->withErrors($validator)
		    					   ->withInput(Input::except('password','foto_de_perfil'));;
		}
		else
		{
			//si pasa la validacion obtiene toda la informacion
			$eps = Input::get('eps');
			$nombre = Input::get('nombre');
			$fecha_de_nacimiento = Input::get('fecha_de_nacimiento');
			$tipo_de_documento = Input::get('tipo_de_documento');
			$documento = Input::get('documento');
			$rh = Input::get('rh');
			$estado_civil = Input::get('estado_civil');
			$telefono = Input::get('telefono');
			$correo_institucional = Input::get('correo_institucional');
			$general = Input::get('general');
			$info_academica = Input::get('info_academica');
			$especialidad = Input::get('especialidad');
			//se almacena la imagen y se guarda la url
			$file = Input::file('foto_de_perfil');
			$destinationPath = 'uploads/';
			$filename = time().$file->getClientOriginalName();
			$file->move($destinationPath, $filename);
			$url_foto = asset("uploads/".$filename);
			//ahora se crean las entidades correspondientes
			//un paciente, una persona y un usuario
			$entidad_medico = $this->repositorio_medicos->crearMedico($correo_institucional,$general,$info_academica,$especialidad);
			$entidad_persona = $this->repositorio_personas->crearPersona($nombre,$fecha_de_nacimiento,$tipo_de_documento,$documento,$rh,$estado_civil,$telefono,$url_foto);
			$entidad_usuario = Auth::user();
			//se busca la entidad de la eps
			$entidad_eps = $this->repositorio_eps->obtenerEps($eps);
			//ahora se establecen las relaciones entre las entidades
			$entidad_usuario->persona()->associate($entidad_persona);
			$entidad_persona->medico()->associate($entidad_medico);
			$entidad_medico->eps()->associate($entidad_eps);
			//se guardan los cambios
			$entidad_usuario->save();
			$entidad_persona->save();
			$entidad_medico->save();
			//finalmente se redirecciona
			return Redirect::to('/')->with('message','Su solicitud de registro se a almacenado correctamente, una vez sea aprobada se le notificará al correo electronico proporcionado');
		}
	}
	public function guardarReRolConPersona()
	{
		//se valida la informacion de acuerdo a las reglas especificadas
		$validator = Validator::make(
		    Input::all(),
		    array(
		        
		        'eps' => 'required|exists:eps,id',
		        'correo_institucional' => 'email',
		        'general' => 'required|boolean',
		        'info_academica' => 'required',
		        'especialidad' => ''
		    )
		);
		if ($validator->fails())
		{
		    return Redirect::back()->withErrors($validator)
		    					   ->withInput(Input::except('password','foto_de_perfil'));;
		}
		else
		{
			//si pasa la validacion obtiene toda la informacion
			$eps = Input::get('eps');
			$correo_institucional = Input::get('correo_institucional');
			$general = Input::get('general');
			$info_academica = Input::get('info_academica');
			$especialidad = Input::get('especialidad');
			//ahora se crean las entidades correspondientes
			//un paciente, una persona y un usuario
			$entidad_medico = $this->repositorio_medicos->crearMedico($correo_institucional,$general,$info_academica,$especialidad);
			$entidad_persona = Auth::user()->persona;
			//se busca la entidad de la eps
			$entidad_eps = $this->repositorio_eps->obtenerEps($eps);
			//ahora se establecen las relaciones entre las entidades
			$entidad_persona->medico()->associate($entidad_medico);
			$entidad_medico->eps()->associate($entidad_eps);
			//se guardan los cambios
			$entidad_persona->save();
			$entidad_medico->save();
			//finalmente se redirecciona
			return Redirect::to('/')->with('message','Su solicitud de registro se a almacenado correctamente, una vez sea aprobada se le notificará al correo electronico proporcionado');
		}
	}

	public function guardarGen2esp()
	{
		//se valida la informacion de acuerdo a las reglas especificadas
		$validator = Validator::make(
		    Input::all(),
		    array(
		    	'id' => 'required|exists:medico,id',
		        'especialidad' => 'required'
		    )
		);
		if ($validator->fails())
		{
		    return Redirect::back()->withErrors($validator)
		    					   ->withInput(Input::except('password','foto_de_perfil'));;
		}
		else
		{
			//si pasa la validacion obtiene toda la informacion
			$id = Input::get('id');
			$especialidad = Input::get('especialidad');
			//ahora se crean las entidades correspondientes
			//un paciente, una persona y un usuario
			$entidad_medico = $this->repositorio_medicos->obtenerMedico($id);
			$entidad_medico->especialidad = $especialidad;
			//se guardan los cambios
			$entidad_medico->save();
			//finalmente se redirecciona
			return Redirect::to('/')->with('message','El cambio se ha realizado "correctamente"');
		}
	}

}
