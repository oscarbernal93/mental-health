@extends('layout')

@section('content')
<div>
	<h1>Editar Usuario en Mental Health</h1>
	<p>Por favor seleccione el rol del cual desea editar la informacion</p>
	{{ Form::open(array('action' => 'UsuarioController@definirEdicion')) }}
	<div>
		{{ Form::label('rol', 'Rol:') }}
		{{ Form::select('rol', $roles) }}
	</div>
	<div>
		{{ Form::submit('Editar!') }}
	</div>
	{{ Form::close() }}

</div>
@stop