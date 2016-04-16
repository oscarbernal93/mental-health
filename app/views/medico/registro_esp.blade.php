@extends('layout')

@section('content')
<div>
	<h1>Registro de Medico General en Mental Health</h1>
	
	{{ Form::open(array('action' => 'MedicoController@guardarRegistro','files'=> true)) }}
	<div>
		{{ Form::label('eps', 'Eps') }}
		{{ Form::select('eps',$array_eps,Input::old('eps')) }}
	</div>
	<div>
		{{ Form::label('usuario', 'Usuario') }}
		{{ Form::text('usuario',Input::old('usuario')) }}
	</div>
	<div>
		{{ Form::label('password', 'Contraseña') }}
		{{ Form::password('password') }}
	</div>
	<div>
		{{ Form::label('email', 'Correo Electronico') }}
		{{ Form::text('email',Input::old('email')) }}
	</div>
	<div>
		{{ Form::label('nombre', 'Nombre Completo') }}
		{{ Form::text('nombre',Input::old('nombre')) }}
	</div>
	<div>
		{{ Form::label('fecha_de_nacimiento', 'Fecha de Nacimiento') }}
		{{ Form::text('fecha_de_nacimiento',Input::old('fecha_de_nacimiento'),array('class'=>'datepicker')) }}
	</div>
	<div>
		{{ Form::label('documento', 'Documento') }}
		{{ Form::select('tipo_de_documento',$tipos_doc,Input::old('tipo_documento')) }} 
		{{ Form::text('documento',Input::old('documento')) }}
	</div>
	<div>
		{{ Form::label('rh', 'RH') }}
		{{ Form::select('rh',$tipos_rh,Input::old('rh')) }}
	</div>
	<div>
		{{ Form::label('estado_civil', 'Estado Civil') }}
		{{ Form::select('estado_civil',$tipos_estciv,Input::old('estado_civil')) }}
	</div>
	<div>
		{{ Form::label('telefono', 'Telefono') }}
		{{ Form::text('telefono',Input::old('telefono')) }}
	</div>
	<div>
		{{ Form::label('correo_institucional', 'Correo Electronico Institucional') }}
		{{ Form::text('correo_institucional',Input::old('correo_institucional')) }}
	</div>
	<div>
		{{ Form::label('info_academica', 'Informacion Academica') }}
		{{ Form::textarea('info_academica',Input::old('info_academica')) }}
	</div>
	<div>
		{{ Form::label('especialidad', 'Especialidad') }}
		{{ Form::text('especialidad',Input::old('especialidad')) }}
	</div>
	<div>
		{{ Form::label('foto_de_perfil', 'Foto de Perfil') }}
		{{ Form::file('foto_de_perfil',array('style'=>"display: inline-block;")) }}
	</div>
	<div>
		{{ Form::hidden('general',0) }}
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
@endsection

@section('script')
<script type="text/javascript">
	$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    languaje: 'es'
});
</script>
@endsection