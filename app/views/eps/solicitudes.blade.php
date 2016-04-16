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
			    <td><button>Aprobar!</button><button>Eliminar!</button></td>
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
@endsection