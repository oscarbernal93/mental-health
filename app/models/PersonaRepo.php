<?php 

class PersonaRepo {

	//crea un nuevo usuario con la informacion recibida
	public function crearPersona($nombre,$fecha_de_nacimiento,$tipo_de_documento,$documento,$rh,$estado_civil,$telefono,$url_foto)
	{
		$entidad = new Persona;
		$entidad->nombre=$nombre;
		$entidad->fecha_nacimiento=$fecha_de_nacimiento;
		$entidad->tipo_documento=$tipo_de_documento;
		$entidad->documento=$documento;
		$entidad->rh=$rh;
		$entidad->estado_civil=$estado_civil;
		$entidad->telefono=$telefono;
		$entidad->url_foto=$url_foto;
		$entidad->save();
		return $entidad;
	}

	//busca un Persona por su llave primaria
	public function obtenerPersona($id)
	{
		return Eps::query()->where('id','=',$id)->where('aprobado','=',1)->first();
	}

	//busca un Persona por su llave primaria y lo borra
	public function borrarPersona($id)
	{
		return Persona::find($id)->delete();
	}

	//crea un collection con todos los Personas
	public function listarPersonas()
	{
		return Persona::all();
	}

}
