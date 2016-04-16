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

	//crea un collection con todos los Pacientes
	public function listarPacientes()
	{
		return Paciente::all();
	}

}
