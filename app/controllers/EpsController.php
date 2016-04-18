<?php

class EpsController extends BaseController {

	private $repositorio_usuarios;
	private $repositorio_pacientes;
	private $repositorio_personas;
	private $repositorio_eps;

	function __construct()
	{
		$this->repositorio_usuarios = new UsuarioRepo;
		$this->repositorio_pacientes = new PacienteRepo;
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
		        'usuario' => 'required|unique:usuario',
		        'password' => 'required|min:8',
		        'email' => 'required|email|unique:usuario',
		        'nombre' => 'required',
		        'telefono' => 'required',
		        'direccion' => 'required',
		        'correo_institucional' => 'email|required',
		        'informacion_de_sedes' => 'required',
		        'logo' => 'required|image',
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
			$usuario = Input::get('usuario');
			$password = Input::get('password');
			$email = Input::get('email');
			$nombre = Input::get('nombre');
			$telefono = Input::get('telefono');
			$direccion = Input::get('direccion');
			$correo_institucional = Input::get('correo_institucional');
			$informacion_de_sedes = Input::get('informacion_de_sedes');
			//se almacena la imagen y se guarda la url
			$file = Input::file('logo');
			$destinationPath = 'uploads/';
			$filename = time().$file->getClientOriginalName();
			$file->move($destinationPath, $filename);
			$url_foto = asset("uploads/".$filename);
			//ahora se crean las entidades correspondientes
			//una eps y un usuario
			$entidad_eps = $this->repositorio_eps->crearEps($nombre,$telefono,$direccion,$correo_institucional,$informacion_de_sedes,$url_foto);
			$entidad_usuario = $this->repositorio_usuarios->crearUsuario($usuario,$password,$email);
			//ahora se establecen las relaciones entre las entidades
			$entidad_usuario->eps()->associate($entidad_eps);
			//se guardan los cambios
			$entidad_usuario->save();
			//finalmente se redirecciona
			return Redirect::to('/')->with('message','Su solicitud de registro se a almacenado correctamente, una vez sea aprovada se le notificará al correo electronico proporcionado');
		}
	}

	//recibe, valida y guarda la informacion del registro
	public function guardarReRol()
	{
		//se valida la informacion de acuerdo a las reglas especificadas
		$validator = Validator::make(
		    Input::all(),
		    array(
		        'nombre' => 'required',
		        'telefono' => 'required',
		        'direccion' => 'required',
		        'correo_institucional' => 'email|required',
		        'informacion_de_sedes' => 'required',
		        'logo' => 'required|image',
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
			$nombre = Input::get('nombre');
			$telefono = Input::get('telefono');
			$direccion = Input::get('direccion');
			$correo_institucional = Input::get('correo_institucional');
			$informacion_de_sedes = Input::get('informacion_de_sedes');
			//se almacena la imagen y se guarda la url
			$file = Input::file('logo');
			$destinationPath = 'uploads/';
			$filename = time().$file->getClientOriginalName();
			$file->move($destinationPath, $filename);
			$url_foto = asset("uploads/".$filename);
			//ahora se crean las entidades correspondientes
			//una eps y un usuario
			$entidad_eps = $this->repositorio_eps->crearEps($nombre,$telefono,$direccion,$correo_institucional,$informacion_de_sedes,$url_foto);
			$entidad_usuario = Auth::user();
			//ahora se establecen las relaciones entre las entidades
			$entidad_usuario->eps()->associate($entidad_eps);
			//se guardan los cambios
			$entidad_usuario->save();
			//finalmente se redirecciona
			return Redirect::to('/')->with('message','Su solicitud de registro se a almacenado correctamente, una vez sea aprovada se le notificará al correo electronico proporcionado');
		}
	}
	//funcion que permite aprobar una solicitud
	public function aprobarSolicitud()
	{
		$id = Input::get('id');
		$destinatario = Eps::find($id)->usuario->email;
		$this->repositorio_eps->aprobarEps($id);
		//se manda el mensaje
		mail($destinatario, 'Correo de Notificacion', "Su solicitud para registrarse como Eps en nuestra plataforma ha sido aprobada");
		//se redirecciona
		return Redirect::to('/')->with('message','Eps aprobado correctamente');
	}
	//funcion que permite borrar una solicitud
	public function borrarSolicitud()
	{
		$id = Input::get('id');
		$destinatario = Eps::find($id)->usuario->email;
		$this->repositorio_eps->borrarEps($id);
		//se manda el mensaje
		mail($destinatario, 'Correo de Notificacion', "Su solicitud para registrarse como Eps en nuestra plataforma ha sido rechazada");
		//se redirecciona
		return Redirect::to('/')->with('message','Eps eliminado correctamente');
	}
}
