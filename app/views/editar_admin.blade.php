@extends('layout')

@section('content')
<div>
	<h1>Editar Administrador en Mental Health</h1>
	
	{{ Form::open(array('action' => 'UsuarioController@guardarEdicion','files'=> true)) }}
	<div>
		{{ Form::label('email', 'Correo Electronico') }}
		{{ Form::text('email',$usuario->email) }}
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