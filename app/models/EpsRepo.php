<?php 

class EpsRepo {

	//crea un nuevo usuario con la informacion recibida
	public function crearEps($nombre,$telefono,$direccion,$correo_institucional,$informacion_de_sedes,$url_foto)
	{
		$entidad = new Eps;
		$entidad->nombre = $nombre;
		$entidad->telefono = $telefono;
		$entidad->direccion = $direccion;
		$entidad->email = $correo_institucional;
		$entidad->info_sedes = $informacion_de_sedes;
		$entidad->url_logo = $url_foto;
		$entidad->aprobado = false;
		$entidad->save();
		return $entidad;
	}

	//busca un Eps por su llave primaria
	public function obtenerEps($id)
	{
		return Eps::query()->where('id','=',$id)->where('aprobado','=',1)->first();
	}

	//busca un Eps por su llave primaria y lo borra
	public function borrarEps($id)
	{
		return Eps::find($id)->delete();
	}

	//crea un collection con todos las Eps
	public function listarEps()
	{
		return Eps::query()->where('aprobado','=',1)->get();
	}

	//crea un collection con todos las solicitudes pendientes de aprobacion
	public function listarSolicitudes()
	{
		return Eps::query()->where('aprobado','=',0)->get();
	}

}
