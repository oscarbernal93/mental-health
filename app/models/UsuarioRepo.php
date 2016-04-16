<?php 

class UsuarioRepo {

	//crea un nuevo usuario con la informacion recibida
	public function crearUsuario($usuario,$password,$email)
	{
		$entidad = new Usuario;
		$entidad->usuario = $usuario;
		$entidad->passhash = Hash::make($password);
		$entidad->email = $email;
		$entidad->admin = false;
		$entidad->save();
		return $entidad;
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
