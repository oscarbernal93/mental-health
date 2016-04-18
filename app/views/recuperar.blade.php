@extends('layout')

@section('content')
<div>
	<h1>Recuperar Contraseña</h1>
	
	{{ Form::open(array('action' => 'UsuarioController@recuperarContrasena')) }}
	<div>
		{{ Form::label('username', 'Usuario') }}
		{{ Form::text('username') }}
	</div>
	<div>
		{{ Form::submit('Recuperar!') }}
	</div>
	{{ Form::close() }}

</div>
@stop