<?php 

class EpsRepo {

	//crea un nuevo usuario con la informacion recibida
	public function crearEps()
	{
		$entidad = new Eps;
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

}
