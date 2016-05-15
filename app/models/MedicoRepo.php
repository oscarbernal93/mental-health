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
		//0 no disponible, 1 cita especialista, 2 cita general, 3 libre especialista
		//4 libre general
		$entidad->lunes = '0000000000000000';
		$entidad->martes = '0000000000000000';
		$entidad->miercoles = '0000000000000000';
		$entidad->jueves = '0000000000000000';
		$entidad->viernes = '0000000000000000';
		$entidad->sabado = '0000000000000000';
		$entidad->save();
		return Medico::find($entidad->id);
	}

	//busca un Medico por su llave primaria
	public function obtenerMedico($id)
	{
		return Medico::find($id);
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
	public function reiniciaMedicos()
	{
		$medicos=$this->listarMedicos();
		foreach ($medicos as $medico) {
			$medico->lunes='0000000000000000';		
			$medico->martes='0000000000000000';		
			$medico->miercoles='0000000000000000';		
			$medico->jueves='0000000000000000';		
			$medico->viernes='0000000000000000';		
			$medico->sabado='0000000000000000';
			$medico->save();
			mail($entidad->email, 'ACTUALIZR AGENDA', "Se ha reiniciado su agenda, porfavor actualizela lo mas pronto posible");

		}	
	}
	public function listarMedicosByEps($id_eps)
	{
		return Medico::query()->where('id_eps','=',$id_eps)->get();
	}

	//crea un collection con todos las solicitudes pendientes de aprobacion
	public function listarSolicitudes($id_eps)
	{
		return Medico::query()->where('aprobado','=',0)->where('id_eps','=',$id_eps)->get();
	}
	public function actualizarAgenda($id,$horario)
	{
		$medico = $this->obtenerMedico($id);
		$medico->lunes = $horario['lunes'];
		$medico->martes = $horario['martes'];
		$medico->miercoles = $horario['miercoles'];
		$medico->jueves = $horario['jueves'];
		$medico->viernes = $horario['viernes'];
		$medico->sabado = $horario['sabado'];
		$medico->save();
		return true;
	}

}
