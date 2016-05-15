@extends('layout')

@section('content')
{{ Form::open(array('action' => 'PacienteController@efectuarCambioCita')) }}
	<div>
		{{ Form::label('cita', 'Seleccione el horario') }}
		<select name="cita">
		@foreach($datos as $dato)
			<option value="{{$dato['dia']."-".$dato['turno']}}">
				{{ $dato['dia'].' a las '}}
				<?php $i = $dato['turno']; ?>
				@if ($i%2==0)
						<td >{{(($i < 8)?8:10 )+$i/2}}:00</td>
					@else
						<td>{{(($i < 8)?8:10 )+($i-1)/2}}:30</td>
					@endif
				{{' - Con el medico '.$dato['tipo']}}
				{{' '.$medico}}
			</option>
		@endforeach
		</select>
	</div>
	<div>
		{{ Form::hidden('medico',$medico_id) }}
		{{ Form::hidden('cita_id_anterior',$cita_id_anterior) }}
		{{ Form::submit('Modificar!') }}
	</div>
{{ Form::close() }}
@endsection

@section('script')

@endsection