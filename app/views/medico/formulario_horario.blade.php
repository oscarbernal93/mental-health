@extends('layout')

@section('content')
<div>
	<h1>Editar Horario Medico en Mental Health</h1>
	{{ Form::open(array('action' => 'MedicoController@editarHorario','method'=>'post')) }}
	<table class='table'>
		<tr>
			<th>Turno</th>
			<th>Lunes</th>
			<th>Martes</th>
			<th>Miercoles</th> 
			<th>Jueves</th>
			<th>Viernes</th>
			<th>Sabado</th>
		</tr>
		@for ($i = 0; $i < 16; $i++)
			<tr>
				@if ($i%2==0)
					<td>{{(($i < 8)?8:10 )+$i/2}}:00</td>
				@else
					<td>{{(($i < 8)?8:10 )+($i-1)/2}}:30</td>
				@endif
				@foreach($turnos as $dia => $turno)
				<?php //{{$estado[substr($turno,$i,1)]}} ?>
					@if(($turno[$i]=='0')or($turno[$i]=='3')or($turno[$i]=='4'))
						<td>{{ Form::select($dia.$i, $estados, substr($turno,$i,1)) }}</td>
					@else
						@if ($turno[$i]=='1')
							<td>Cita General</td>
						@else
							<td>Cita Esp.</td>
						@endif
					@endif					
				@endforeach
			</tr>
		@endfor

	</table>
	{{ Form::submit('Enviar') }}
	{{ Form::close() }}
</div>
@endsection

@section('script')

@endsection