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

	//entrega los roles de un usuario
	public function getRoles($id)
	{
		$roles = array();
		$usuario = $this->obtenerUsuario($id);
		//super-admin
		if ($usuario->admin)
		{
			$roles['admin']="Super Administrador";
		}
		//eps
		if ($usuario->eps)
		{
			$roles['eps']="Administrador de Eps";
		}
		if ($usuario->persona)
		{
			//paciente
			if ($usuario->persona->paciente)
			{
				$roles['paciente']="Paciente";
			}
			//medico
			if ($usuario->persona->medico)
			{
				if ($usuario->persona->medico->general)
				{
					$roles['medico']="Medico General";
				}
				if ($usuario->persona->medico->especialidad)
				{
					$roles['especialista']="Medico Especialista";
				}
			}
		}
		return $roles;
	}

}
