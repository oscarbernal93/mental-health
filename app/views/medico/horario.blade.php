@extends('layout')

@section('content')
<div>
	<h1>Registro de Medico General en Mental Health</h1>
	<table class='table table-condensed table-bordered'>
		<thead>
			<tr> 
				<th>Turno</th>
				<th>Lunes</th>
				<th>Martes</th>
				<th>Miercoles</th>
				<th>Jueves</th>
				<th>Viernes</th>
				<th>Sabado</th>
			</tr>
		</thead>
		<tbody>	
			@for ($i = 0; $i < 16; $i++)
				<tr>
					@if ($i%2==0)
						<td >{{(($i < 8)?8:10 )+$i/2}}:00</td>
					@else
						<td>{{(($i < 8)?8:10 )+($i-1)/2}}:30</td>
					@endif
					@foreach($turnos as $turno)
						<td class="{{$colores[substr($turno,$i,1)]}}">{{$estado[substr($turno,$i,1)]}}</td>
					@endforeach
				</tr>
			@endfor
		</tbody>

	</table>
	<a href= '{{action('MedicoController@formularioEditarHorario')}}'><button>Editar</button></a>
	<a href= '{{action('MedicoController@eliminarHorario')}}'><button>Eliminar :o</button></a>
	
</div>
@endsection

@section('script')

@endsection