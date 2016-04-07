<?php 

class UsuarioRepo {

	//crea un nuevo usuario con la informacion recibida
	public function crearUsuario($atributo)
	{
		$entidad = new Usuario;
		$entidad->atributo = $atributo;
		$entidad->save();
	}

	//busca un usuario por su llave primaria
	public function obtenerUsuario($id)
	{
		return Usuario::find($id);
	}

	//busca un usuario por su llave primaria y lo borra
	public function borrarUsuario($id)
	{
		return Usuario::find($id)->delete();
	}

	//crea un collection con todos los usuarios
	public function listarUsuarios()
	{
		return Usuario::all();
	}

}
