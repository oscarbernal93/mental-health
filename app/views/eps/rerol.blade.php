@extends('layout')

@section('content')
<div>
	<h1>Registro de Eps en Mental Health</h1>
	
	{{ Form::open(array('action' => 'EpsController@guardarReRol','files'=> true)) }}
	<div>
		{{ Form::label('nombre', 'Nombre Eps') }}
		{{ Form::text('nombre',Input::old('nombre')) }}
	</div>
	<div>
		{{ Form::label('telefono', 'Telefono') }}
		{{ Form::text('telefono',Input::old('telefono')) }}
	</div>
	<div>
		{{ Form::label('direccion', 'Direccion') }}
		{{ Form::text('direccion',Input::old('direccion')) }}
	</div>
	<div>
		{{ Form::label('correo_institucional', 'Correo Institucional') }}
		{{ Form::text('correo_institucional',Input::old('correo_institucional')) }}
	</div>
	<div>
		{{ Form::label('informacion_de_sedes', 'Informacion de Sedes') }}
		{{ Form::textarea('informacion_de_sedes',Input::old('informacion_de_sedes')) }}
	</div>
	<div>
		{{ Form::label('logo', 'Logo de la Eps') }}
		{{ Form::file('logo',array('style'=>"display: inline-block;")) }}
	</div>
	<div>
		{{ Form::submit('Registrarse!') }}
	</div>
	{{ Form::close() }}

	@if (0 < $errors->count())
		<div>
			<h3>Errores en el formulario:</h3>
			<ul>
				@foreach($errors->all() as $error)	
					<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
	@endif
</div>
@stop