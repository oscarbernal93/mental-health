<?php 

class PacienteRepo {

	//crea un nuevo usuario con la informacion recibida
	public function crearPaciente($atributo)
	{
		$entidad = new Paciente;
		$entidad->atributo = $atributo;
		$entidad->save();
	}

	//busca un Paciente por su llave primaria
	public function obtenerPaciente($id)
	{
		return Paciente::find($id);
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
