<?php

class PacienteController extends BaseController {

	private $repositorio_usuarios;
	private $repositorio_pacientes;
	private $repositorio_personas;
	private $repositorio_eps;
	private $repositorio_medicos;
	private $repositorio_citas;
	function __construct()
	{
		$this->repositorio_usuarios = new UsuarioRepo;
		$this->repositorio_pacientes = new PacienteRepo;
		$this->repositorio_personas = new PersonaRepo;
		$this->repositorio_eps = new EpsRepo;
		$this->repositorio_medicos = new MedicoRepo;
		$this->repositorio_citas = new CitaRepo;
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
			//se almacena la imagen y se guarda la url
			$file = Input::file('foto_de_perfil');
			$destinationPath = 'uploads/';
			$filename = time().$file->getClientOriginalName();
			$file->move($destinationPath, $filename);
			$url_foto = asset("uploads/".$filename);
			//ahora se crean las entidades correspondientes
			//un paciente, una persona y un usuario
			$entidad_paciente = $this->repositorio_pacientes->crearPaciente();
			$entidad_persona = $this->repositorio_personas->crearPersona($nombre,$fecha_de_nacimiento,$tipo_de_documento,$documento,$rh,$estado_civil,$telefono,$url_foto);
			$entidad_usuario = $this->repositorio_usuarios->crearUsuario($usuario,$password,$email);
			//se busca la entidad de la eps
			$entidad_eps = $this->repositorio_eps->obtenerEps($eps);
			//ahora se establecen las relaciones entre las entidades
			$entidad_usuario->persona()->associate($entidad_persona);
			$entidad_persona->paciente()->associate($entidad_paciente);
			$entidad_paciente->eps()->associate($entidad_eps);
			//se guardan los cambios
			$entidad_usuario->save();
			$entidad_persona->save();
			$entidad_paciente->save();
			//finalmente se redirecciona
			return Redirect::to('/')->with('message','Su solicitud de registro se a almacenado correctamente, una vez sea aprobada se le notificará al correo electronico proporcionado');
		}
	}

	//recibe, valida y guarda la informacion del registro
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
			//se almacena la imagen y se guarda la url
			$file = Input::file('foto_de_perfil');
			$destinationPath = 'uploads/';
			$filename = time().$file->getClientOriginalName();
			$file->move($destinationPath, $filename);
			$url_foto = asset("uploads/".$filename);
			//ahora se crean las entidades correspondientes
			//un paciente, una persona y un usuario
			$entidad_paciente = $this->repositorio_pacientes->crearPaciente();
			$entidad_persona = $this->repositorio_personas->crearPersona($nombre,$fecha_de_nacimiento,$tipo_de_documento,$documento,$rh,$estado_civil,$telefono,$url_foto);
			$entidad_usuario = Auth::user();
			//se busca la entidad de la eps
			$entidad_eps = $this->repositorio_eps->obtenerEps($eps);
			//ahora se establecen las relaciones entre las entidades
			$entidad_usuario->persona()->associate($entidad_persona);
			$entidad_persona->paciente()->associate($entidad_paciente);
			$entidad_paciente->eps()->associate($entidad_eps);
			//se guardan los cambios
			$entidad_usuario->save();
			$entidad_persona->save();
			$entidad_paciente->save();
			//finalmente se redirecciona
			return Redirect::to('/')->with('message','Su solicitud de registro se a almacenado correctamente, una vez sea aprobada se le notificará al correo electronico proporcionado');
		}
	}
	//recibe, valida y guarda la informacion del registro
	public function guardarReRolConPersona()
	{
		//se valida la informacion de acuerdo a las reglas especificadas
		$validator = Validator::make(
		    Input::all(),
		    array(
		        'eps' => 'required|exists:eps,id',
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
			//ahora se crean las entidades correspondientes
			//un paciente, una persona y un usuario
			$entidad_paciente = $this->repositorio_pacientes->crearPaciente();
			$entidad_persona = Auth::user()->persona;
			//se busca la entidad de la eps
			$entidad_eps = $this->repositorio_eps->obtenerEps($eps);
			//ahora se establecen las relaciones entre las entidades
			$entidad_persona->paciente()->associate($entidad_paciente);
			$entidad_paciente->eps()->associate($entidad_eps);
			//se guardan los cambios
			$entidad_persona->save();
			$entidad_paciente->save();
			//finalmente se redirecciona
			return Redirect::to('/')->with('message','Su solicitud de registro se a almacenado correctamente, una vez sea aprobada se le notificará al correo electronico proporcionado');
		}
	}

	//funcion que permite aprobar una solicitud
	public function aprobarSolicitud()
	{
		$id = Input::get('id');
		$destinatario = Paciente::find($id)->persona->usuario->email;
		$this->repositorio_pacientes->aprobarPaciente($id);
		//se manda el mensaje
		mail($destinatario, 'Correo de Notificacion', "Su solicitud para registrarse como Paciente en nuestra plataforma ha sido aprobada");
		//se redirecciona
		return Redirect::to('/')->with('message','Paciente aprobado correctamente');
	}
	//funcion que permite borrar una solicitud
	public function borrarSolicitud()
	{
		$id = Input::get('id');
		$destinatario = Paciente::find($id)->persona->usuario->email;
		$this->repositorio_pacientes->borrarPaciente($id);
		//se manda el mensaje
		mail($destinatario, 'Correo de Notificacion', "Su solicitud para registrarse como Paciente en nuestra plataforma ha sido rechazada");
		//se redirecciona
		return Redirect::to('/')->with('message','Paciente eliminado correctamente');
	}
	public function listarMedicos()
	{
		$dias = array(
			0=>'lunes',
			1=>'martes',
			2=>'miercoles',
			3=>'jueves',
			4=>'viernes',
			5=>'sabado'
		);
		$usuario= Auth::user();
		if(!is_null($usuario)){
			if(!is_null($usuario->persona)){
				if(!is_null($usuario->persona->paciente)){
					$medicos = $this->repositorio_medicos->listarMedicosByEps($usuario->persona->paciente->eps->id);
					$citas = $this->repositorio_citas->listarCitasByPaciente($usuario->persona->paciente->id);
					return View::make('paciente.medicos')->with('medicos',$medicos)->with('citas',$citas)->with('dias',$dias);
				}else{
					return Redirect::to('/')->with('message','Usted no ha iniciado sesion como paciente');
				}						
			}else{
				return Redirect::to('/')->with('message','Usted no deberia estar en esta seccion');
			}
		}else{
			return Redirect::to('/')->with('message','Usted no ha iniciado sesion correctamente');
		}
	}
	public function verHorarioMedico($id_medico)
	{
		$medico = $this->repositorio_medicos->obtenerMedico($id_medico);
		$dia = date('N');
		$dia = 1; //ESTO SE TIENE QUE QUITAR
		//SOLO ESTA PUESTO PARA HACER PRUEBAS
		//Y USO TODO EL TIEMPO MAYUSCULAS SOSTENIDAS
		//PARA LLAMAR LA ATENCION Y QUE ESTO SE VEA
		//PORQUE AL SER SOLO ALGO DE PRUEBA
		//DEBE QUITARSE OBLIGATORIAMENTE
		//Y SI NO SE QUITA, QUEDARÁ MAL Y LECHUS
		//NOS MATARÁ A TODOS (IGUAL ESO ULTIMO PASARÁ
		//SIN IMPORTAR EL MOTIVO, PERO ALMENOS QUE NO
		//SEA POR ESO).
		$horario = array(
				1=>$medico->lunes,
				2=>$medico->martes,
				3=>$medico->miercoles,
				4=>$medico->jueves,
				5=>$medico->viernes,
				6=>$medico->sabado);
		$datos = array();
		for ($i=$dia;$i<7;$i++){
			$datos[$i]=$horario[$i];
		}
		$temp = array(
			1=>'lunes',
			2=>'martes',
			3=>'miercoles',
			4=>'jueves',
			5=>'viernes',
			6=>'sabado'
		);
		foreach ($datos as $dato) {
			$dato=str_replace("1","0", $dato);
			$dato=str_replace("2","0", $dato);
		}
		$salida=array();
		$j=0;
		for($i=$dia;$i<7;$i++){
			for($j=0;$j<16;$j++){
				if(substr($datos[$i],$j,1)!='0'){
					$estado='General';
					if (substr($datos[$i],$j,1)=='4'){
						$estado='Especialista';
					}
					$salida[]=array('dia'=>$temp[$i],'tipo'=>$estado,'turno'=>$j);
				}
			}
		}
		return View::make('paciente.disponibilidad')->with('datos',$salida)->with('medico',$medico->persona->nombre)->with('medico_id',$medico->id);
	}
	public function pedirCita()
	{
		$medico=Input::get('medico');
		$medico=$this->repositorio_medicos->obtenerMedico($medico);
		$explosion = explode('-', Input::get('cita'));
		$dia = $explosion[0];
		$turno = $explosion[1];
		$turnos_del_dia_actual=substr($medico->$dia,0);
		if ($turnos_del_dia_actual[(int)$turno]=='3'){
			$tipo='General';
		}else{
			$tipo='Especialista';
		}
		$paciente= Auth::user()->persona->paciente;
		$cita = $this->repositorio_citas->crearCita($tipo,0,$turno,$dia);
		$cita->paciente()->associate($paciente);
		$cita->medico()->associate($medico);
		//$medico->$dia[(int)$turno]=((int)$medico->$dia[(int)$turno])-2;
		$turnos_del_dia_actual[$turno] = $turnos_del_dia_actual[$turno] -2;
		$medico->$dia=$turnos_del_dia_actual;
		//se guardan los cambios
		$medico->save();
		$cita->save();
		$correopaciente=$cita->paciente->persona->usuario->email;
		$correomedico=$cita->medico->persona->usuario->email;
		mail($correopaciente, 'Correo de Notificacion Cita', "Su cita ha sido guardada correctamente");
		mail($correomedico, 'Correo de Notificacion Cita', "Se le ha asignado una cita");
		return Redirect::to('/')->with('message','Se ha guardado su cita');
	}
	public function eliminarCita()
	{
		$id= Input::get('id');
		$cita=$this->repositorio_citas->obtenerCita($id);
		$medico=$cita->medico;
		$dia=$cita->dia;
		$turno=$cita->turno;
		if($dia==0){
			$dia='lunes';
		}elseif($dia==1){
			$dia='martes';
		}elseif($dia==2){
			$dia='miercoles';
		}elseif($dia==3){
			$dia='jueves';
		}elseif($dia==4){
			$dia='viernes';
		}elseif($dia==5){
			$dia='sabado';
		}
		$temp=$medico->$dia;
		$temp[$turno]='0';
		$medico->$dia=$temp;
		$medico->save();
		$this->repositorio_citas->borrarCita($id);
		$correopaciente=$cita->paciente->persona->usuario->email;
		$correomedico=$cita->medico->persona->usuario->email;
		mail($correopaciente, 'Cancelacion de Cita', "Su cita ha sido cancelada correctamente");
		mail($correomedico, 'Cancelacion de Cita', "Le cancelaron la cita con ".$cita->paciente->persona->nombre);
		return Redirect::to('/')->with('message','Se ha eliminado su cita con el doctor ');
	}
}
