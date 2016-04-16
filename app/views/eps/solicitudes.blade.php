@extends('layout')

@section('content')
<div>Paciente
	<h1>Solicitudes de Pecientes</h1>
	<div>
	<table id="tabla1">
	<thead>
		<tr>
		    <th>Nombre</th>
		    <th>Opcion</th>
		</tr>
	</thead>
	<tbody>
		@foreach($solicitudes as $eps)
			<tr>
			    <td>{{$eps->nombre}}</td>
			    <td>
				    {{ Form::open(array('action' => 'EpsController@aprobarSolicitud','style'=>'display:inline-block;')) }}
				    {{ Form::hidden('id',$eps->id) }}
					{{ Form::submit('Aprobar!') }}
					{{Form::close()}}
				<!---->
				    {{ Form::open(array('action' => 'EpsController@borrarSolicitud','class'=>'eliminar','style'=>'display:inline-block;')) }}
				    {{ Form::hidden('id',$eps->id) }}
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
	    $('#tabla1').DataTable();
	});
</script>
<script type="text/javascript">
	$('.eliminar').submit(function (evt) {
		return confirm("Se eliminará la solicitud de registro");
	});
</script>
@endsection