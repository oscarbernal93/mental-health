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

	//busca un Medico por su llave primaria y lo aprueba
	public function aprobarMedico($id)
	{
		$medico = Medico::find($id);
		$medico->aprobado = true;
		$medico->save();
		return $medico;
	}

	//crea un collection con todos los Medicos
	public function listarMedicos()
	{
		return Medico::all();
	}

	//crea un collection con todos las solicitudes pendientes de aprobacion
	public function listarSolicitudes($id_eps)
	{
		return Medico::query()->where('aprobado','=',0)->where('id_eps','=',$id_eps)->get();
	}

}
