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
						<a href="{{action('PacienteController@verHorarioMedico',$medico->id)}}">reservar</a>
					</td>
				</tr>
			@endforeach
		</tbody>

	</table>	
</div>
@endsection

@section('script')

@endsection