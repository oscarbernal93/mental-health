@extends('layout')

@section('content')
<div>
	<h1>Medicos disponibles en Mental Health</h1>
	<table class='table table-condensed table-bordered'>
		<thead>
			<tr>
				<th>Medico</th>
				<th>Tipo</th>
			</tr>
		</thead>
		<tbody>	
			@foreach($medicos as $medico)
				<tr>
					<td >{{$medico->persona->nombre}}</td>
					<td>
					@if ($medico->general)
						General. 
					@endif
					@if (!is_null($medico->especialidad))
						Especialista en {{$medico->especialidad}}
					@endif
					</td>
					<td>
						<a href="{{action('PacienteController@verHorarioMedico',$medico->id)}}"><button>reservar</button></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<h3>Mis Citas :3</h3>
	<table class="table table-condensed table-bordered">
		<thead>
			<tr>
				<td>Dia</td>
				<td>Hora</td>
				<td>Tipo de Cita</td>
				<td>Nombre del Medico</td>
				<td>Opciones</td>
			</tr>
		</thead>
		<tbody>
		@foreach($citas as $cita)
			<tr>
				<td>
					{{$dias[$cita->dia]}}
					<?php $i=$cita->turno; ?>
					@if ($i%2==0)
						<td >{{(($i < 8)?8:10 )+$i/2}}:00</td>
					@else
						<td>{{(($i < 8)?8:10 )+($i-1)/2}}:30</td>
					@endif
				</td>
				<td>{{$cita->tipo}}</td>
				<td>{{$cita->medico->persona->nombre}}</td>
				<td>
				{{ Form::open(array('action' => 'PacienteController@eliminarCita'))}}
					
					<div>
						{{ Form::hidden('id',$cita->id) }}
						{{ Form::submit('Eliminar!')}}
					</div>
				{{ Form::close() }}
				<button onclick="alert('no implementado aun :P')">Calificar</button>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>
@endsection

@section('script')

@endsection