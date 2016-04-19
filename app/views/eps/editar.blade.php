@extends('layout')

@section('content')
<div>
	<h1>Editar Eps en Mental Health</h1>
	
	{{ Form::open(array('action' => 'EpsController@guardarEdicion','files'=> true)) }}
	<div>
		{{ Form::label('email', 'Correo Electronico') }}
		{{ Form::text('email',$eps->usuario->email) }}
	</div>
	<div>
		{{ Form::label('nombre', 'Nombre Eps') }}
		{{ Form::text('nombre',$eps->nombre) }}
	</div>
	<div>
		{{ Form::label('telefono', 'Telefono') }}
		{{ Form::text('telefono',$eps->telefono) }}
	</div>
	<div>
		{{ Form::label('direccion', 'Direccion') }}
		{{ Form::text('direccion',$eps->direccion) }}
	</div>
	<div>
		{{ Form::label('correo_institucional', 'Correo Institucional') }}
		{{ Form::text('correo_institucional',$eps->email) }}
	</div>
	<div>
		{{ Form::label('informacion_de_sedes', 'Informacion de Sedes') }}
		{{ Form::textarea('informacion_de_sedes',$eps->info_sedes) }}
	</div>
	<img class="img-thumbnail" src="{{$eps->logo_url}}" height="250">
	<div>
		{{ Form::label('logo', 'Logo de la Eps') }}
		{{ Form::file('logo',array('style'=>"display: inline-block;")) }}
	</div>
	<div>
		{{ Form::submit('Editar!') }}
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