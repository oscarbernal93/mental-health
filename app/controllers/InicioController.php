<?php

class InicioController extends BaseController {

	public function paginaInicio()
	{
		if(\Auth::check())
		{
    		$usuario=\Auth::user()->usuario;
    		//se verifica que roles 
    		$roles = array();
    		//super-admin
    		if (\Auth::user()->admin)
    		{
    			$roles[]="Super Administrador";
    		}
    		//eps
    		if (\Auth::user()->eps)
    		{
    			$roles[]="Administrador de Eps";
    		}
    		if (\Auth::user()->persona)
    		{
    			//paciente
    			if (\Auth::user()->persona->paciente)
    			{
    				$roles[]="Paciente";
    			}
    			//medico
    			if (\Auth::user()->persona->medico)
    			{
    				if (\Auth::user()->persona->medico->general)
    				{
    					$roles[]="Medico General";
    				}
    				if (\Auth::user()->persona->medico->especialidad)
    				{
    					$roles[]="Medico Especialista";
    				}
    			}
    		}
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
