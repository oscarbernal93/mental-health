<?php

class InicioController extends BaseController {

    private $repositorio_usuarios;
    
    function __construct()
    {
        $this->repositorio_usuarios = new UsuarioRepo;
    }

	public function paginaInicio()
	{
		if(\Auth::check())
		{
    		$usuario=\Auth::user()->usuario;
    		//se verifica que roles 
    		$roles = $this->repositorio_usuarios->getRoles($usuario);
    		$the_bool=array_key_exists('admin',$roles);
		}
		else
		{
			$usuario="Invitado";
			$roles = null;
			$the_bool = false;
		}
		return View::make('hello')->with('usuario',$usuario)
								  ->with('roles',$roles)
								  ->with('es_admin',$the_bool);
	}

}
