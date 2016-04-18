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
		}
		else
		{
			$usuario="Invitado";
			$roles = null;
		}
		return View::make('hello')->with('usuario',$usuario)
								  ->with('roles',$roles);
	}

}
