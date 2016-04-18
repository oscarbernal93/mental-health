@extends('layout')

@section('content')
<div>
	<h1>Recuperacion de contraseña</h1>
	
	{{ Form::open(array('action' => 'UsuarioController@guardarContrasena')) }}
	<div>
		{{ Form::label('username', 'Usuario',$usuario) }}
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