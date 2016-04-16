@extends('layout')

@section('content')
<div>
	<h1>Solicitudes de Pecientes</h1>
	<div>
	<table>
	<thead>
		<tr>
		    <th>Documento</th>
		    <th>Nombre</th>
		    <th>Opcion</th>
		</tr>
	</thead>
	<tbody>
		@foreach($pacientes as $paciente)
			<tr>
			    <td>{{$paciente->persona->documento}}</td>
			    <td>{{$paciente->persona->nombre}}</td>
			    <td><button>Aprobar!</button><button>Eliminar!</button></td>
			</tr>
		@endforeach
	</tbody>
	</table>
	</div>
	<h1>Solicitudes de Medicos</h1>
	<div>
	<table>
	<thead>
		<tr>
		    <th>Documento</th>
		    <th>Nombre</th>
		    <th>Opcion</th>
		</tr>
	</thead>
	<tbody>
		@foreach($medicos as $medico)
			<tr>
				<td>{{$medico->persona->documento}}</td>
			    <td>{{$medico->persona->nombre}}</td>
			    <td>
			    {{ Form::open(array('action' => 'MedicoController@aprobarSolicitud','style'=>'display:inline-block;')) }}
			    {{ Form::hidden('id',$medico->id) }}
				{{ Form::submit('Aprobar!') }}
				{{Form::close()}}
			    <!---->
			    {{ Form::open(array('action' => 'MedicoController@borrarSolicitud','class'=>'eliminar','style'=>'display:inline-block;')) }}
			    {{ Form::hidden('id',$medico->id) }}
				{{ Form::submit('Eliminar!') }}
				{{Form::close()}}
			    </td>
			</tr>
		@endforeach
	</tbody>
	</table>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function(){
	    $('table').DataTable();
	});
</script>
<script type="text/javascript">
	$('.eliminar').submit(function (evt) {
		return confirm("Se eliminará el medico");
	});
</script>
@endsection