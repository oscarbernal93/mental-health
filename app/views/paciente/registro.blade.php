@extends('layout')

@section('content')
<div>
	<h1>Registro de Paciente en Mental Health</h1>
	
	{{ Form::open(array('action' => 'PacienteController@guardarRegistro','files'=> true)) }}
	<div>
		{{ Form::label('usuario', 'Usuario') }}
		{{ Form::text('usuario') }}
	</div>
	<div>
		{{ Form::label('password', 'Contraseña') }}
		{{ Form::text('password') }}
	</div>
	<div>
		{{ Form::label('email', 'Correo Electronico') }}
		{{ Form::text('email') }}
	</div>
	<div>
		{{ Form::label('nombre', 'Nombre Completo') }}
		{{ Form::text('nombre') }}
	</div>
	<div>
		{{ Form::label('fecha-de-nacimiento', 'Fecha de Nacimiento') }}
		{{ Form::text('fecha-de-nacimiento',null,array('class'=>'datepicker')) }}
	</div>
	<div>
		{{ Form::label('docuemento', 'Documento') }}
		{{ Form::select('tipo-de-documento',$tipos_doc) }} {{ Form::text('documento') }}
	</div>
	<div>
		{{ Form::label('rh', 'RH') }}
		{{ Form::select('rh',$tipos_rh) }}
	</div>
	<div>
		{{ Form::label('estado-civil', 'Estado Civil') }}
		{{ Form::select('estado-civil',$tipos_estciv) }}
	</div>
	<div>
		{{ Form::label('telefono', 'Telefono') }}
		{{ Form::text('telefono') }}
	</div>
	<div>
		{{ Form::label('imagen', 'Foto de Perfil') }}
		{{ Form::file('imagen',array('style'=>"display: inline-block;")) }}
	</div>
	<div>
		{{ Form::submit('Registrarse!') }}
	</div>
	{{ Form::close() }}
<div>
	<h3>Errores en el formulario:</h3>
	<ul>
		@foreach($errors->all() as $error)	
			<li>{{$error}}</li>
		@endforeach
	</ul>
</div>
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