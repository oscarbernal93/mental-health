@extends('layout')

@section('content')
<div>
	<h1>Registro de Medico en Mental Health</h1>
	
	{{ Form::open(array('action' => 'UsuarioController@iniciarSesion')) }}
	<div>
		{{ Form::label('username', 'Usuario') }}
		{{ Form::text('username') }}
	</div>
	<div>
		{{ Form::submit('Registrarse!') }}
	</div>
	{{ Form::close() }}

</div>
@stop