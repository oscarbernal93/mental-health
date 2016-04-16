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
}
