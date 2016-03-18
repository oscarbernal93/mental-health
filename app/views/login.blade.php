@extends('layout')

@section('content')
<div>
	<h1>Inicio de Sesion en Mental Health</h1>
	
	{{ Form::open(array('action' => 'UsuarioController@iniciarSesion')) }}
	<div>
		{{ Form::label('username', 'Usuario') }}
		{{ Form::text('username') }}
	</div>
	<div>
		{{ Form::label('password', 'Contraseña') }}
		{{ Form::password('password') }}
	</div>
	<div>
		{{ Form::submit('Entrar!') }}
	</div>
	{{ Form::close() }}

</div>
@stop