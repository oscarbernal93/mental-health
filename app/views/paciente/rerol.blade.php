@extends('layout')

@section('content')
<div>
	<h1>Registro de Paciente en Mental Health</h1>
	@if(is_null($persona))
		{{ Form::open(array('action' => 'PacienteController@guardarReRolSinPersona','files'=> true)) }}
	@else
		{{ Form::open(array('action' => 'PacienteController@guardarReRolConPersona','files'=> true)) }}
	@endif
	<div>
		{{ Form::label('eps', 'Eps') }}
		{{ Form::select('eps',$array_eps,Input::old('eps')) }}
	</div>
	@if(is_null($persona))
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
		{{ Form::label('foto_de_perfil', 'Foto de Perfil') }}
		{{ Form::file('foto_de_perfil',array('style'=>"display: inline-block;")) }}
	</div>
	@endif
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
@endsection

@section('script')
<script type="text/javascript">
	$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    languaje: 'es'
});
</script>
@endsection