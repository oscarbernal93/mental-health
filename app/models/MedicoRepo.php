<?php 

class MedicoRepo {

	//crea un nuevo usuario con la informacion recibida
	public function crearMedico($correo_institucional,$general,$info_academica,$especialidad)
	{
		$entidad = new Medico;
		$entidad->email = $correo_institucional;
		$entidad->general = $general;
		$entidad->info_academica = $info_academica;
		if(!is_null($especialidad)){
			$entidad->especialidad = $especialidad;
		}
		$entidad->save();
		return $entidad;
	}

	//busca un Medico por su llave primaria
	public function obtenerMedico($id)
	{
		return Eps::query()->where('id','=',$id)->where('aprobado','=',1)->first();
	}

	//busca un Medico por su llave primaria y lo borra
	public function borrarMedico($id)
	{
		return Medico::find($id)->delete();
	}

	//crea un collection con todos los Medicos
	public function listarMedicos()
	{
		return Medico::all();
	}

}
