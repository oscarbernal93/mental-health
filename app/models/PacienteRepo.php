<?php 

class PacienteRepo {

	//crea un nuevo usuario con la informacion recibida
	public function crearPaciente()
	{
		$entidad = new Paciente;
		$entidad->aprobado = false;
		$entidad->save();
		return $entidad;
	}

	//busca un Paciente por su llave primaria
	public function obtenerPaciente($id)
	{
		return Eps::query()->where('id','=',$id)->where('aprobado','=',1)->first();
	}

	//busca un Paciente por su llave primaria y lo borra
	public function borrarPaciente($id)
	{
		return Paciente::find($id)->delete();
	}

	//busca un Paciente por su llave primaria y lo aprueba
	public function aprobarPaciente($id)
	{
		$entidad = Paciente::find($id);
		$entidad->aprobado = true;
		$entidad->save();
		return $entidad;
	}

	//crea un collection con todos los Pacientes
	public function listarPacientes()
	{
		return Paciente::all();
	}

	//crea un collection con todos las solicitudes pendientes de aprobacion
	public function listarSolicitudes($id_eps)
	{
		return Paciente::query()->where('aprobado','=',0)->where('id_eps','=',$id_eps)->get();
	}
}
