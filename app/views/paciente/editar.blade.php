@extends('layout')

@section('content')
<div>
	<h1>Editar Paciente en Mental Health</h1>
	
	{{ Form::open(array('action' => 'PacienteController@guardarEdicion','files'=> true)) }}
	<div>
		{{ Form::label('email', 'Correo Electronico') }}
		{{ Form::text('email',$persona->usuario->email) }}
	</div>
	<div>
		{{ Form::label('nombre', 'Nombre Completo') }}
		{{ Form::text('nombre',$persona->nombre) }}
	</div>
	<div>
		{{ Form::label('fecha_de_nacimiento', 'Fecha de Nacimiento') }}
		{{ Form::text('fecha_de_nacimiento',$persona->fecha_nacimiento,array('class'=>'datepicker')) }}
	</div>
	<div>
		{{ Form::label('documento', 'Documento') }}
		{{ Form::select('tipo_de_documento',$tipos_doc,$persona->tipo_documento) }} 
		{{ Form::text('documento',$persona->documento) }}
	</div>
	<div>
		{{ Form::label('rh', 'RH') }}
		{{ Form::select('rh',$tipos_rh,$persona->rh) }}
	</div>
	<div>
		{{ Form::label('estado_civil', 'Estado Civil') }}
		{{ Form::select('estado_civil',$tipos_estciv,$persona->estado_civil) }}
	</div>
	<div>
		{{ Form::label('telefono', 'Telefono') }}
		{{ Form::text('telefono',$persona->telefono) }}
	</div>
		<img class="img-thumbnail" src="{{$persona->url_foto}}" style="height:100px;">
	<div>
		{{ Form::label('foto_de_perfil', 'Foto de Perfil') }}
		{{ Form::file('foto_de_perfil',array('style'=>"display: inline-block;")) }}
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
@endsection

@section('script')
<script type="text/javascript">
	$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    languaje: 'es'
});
</script>
@endsection