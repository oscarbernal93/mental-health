@extends('layout')

@section('content')
<div>
	<h1>Registro de Usuario en Mental Health</h1>
	<p>Por favor seleccione el rol en el cual quiere registrarse</p>
	@if(Auth::check())
	<p>Usted ya se encunetra registrado en el sistema, puede aspirar a registrarse en un rol diferente</p>
	{{ Form::open(array('action' => 'UsuarioController@formularioOtroRol','method'=>'get')) }}
	@else
	{{ Form::open(array('action' => 'UsuarioController@formularioRegistrarse','method'=>'get')) }}
	@endif
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