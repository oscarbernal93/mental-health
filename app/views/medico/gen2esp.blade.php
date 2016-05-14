@extends('layout')

@section('content')
<div>
	<h1>Registro de Medico General en Mental Health</h1>
	{{ Form::open(array('action' => 'MedicoController@guardarGen2esp','files'=> true)) }}
	<div>
		{{ Form::label('especialidad', 'Especialidad') }}
		{{ Form::text('especialidad',Input::old('especialidad')) }}
	</div>
	<div>
		{{ Form::hidden('id',$medico_id) }}
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