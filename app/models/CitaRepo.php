<?php 

class CitaRepo {

	//crea un nuevo usuario con la informacion recibida
	public function crearCita($tipo,$calificacion,$turno,$dia)
	{
		$entidad = new Cita;
		$entidad->tipo=$tipo;
		$entidad->calificacion=$calificacion;
		$entidad->turno=$turno;
		$entidad->dia=$dia;
		$entidad->finalizado=false;
		$entidad->save();
		return Cita::find($entidad->id);
	}

	//busca una Cita por su llave primaria
	public function obtenerCita($id)
	{
		return Cita::query()->where('id','=',$id)->first();
	}

	//busca una Cita por su llave primaria y la borra
	public function borrarCita($id)
	{
		return Cita::find($id)->delete();
	}

	//crea un collection con todas las Citas
	public function listarCitas()
	{
		return Cita::all();
	}

}
