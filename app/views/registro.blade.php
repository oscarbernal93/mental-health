@extends('layout')

@section('content')
<div>
	<h1>Registro de Usuario en Mental Health</h1>
	
	{{ Form::open(array('action' => 'UsuarioController@formularioRegistrarse','method'=>'get')) }}
	<div>
		{{ Form::label('tipo', 'Tipo de Cuenta:') }}
		{{ Form::select('tipo', $tipos) }}
	</div>
	<div>
		{{ Form::submit('Registrarse!') }}
	</div>
	{{ Form::close() }}

</div>
@stop