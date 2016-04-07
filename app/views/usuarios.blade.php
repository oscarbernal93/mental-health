@extends('layout')

@section('content')
<div>
	<h1>Usuarios de Mental Health</h1>
	<p>
		@foreach($usuarios as $usuario)
        <p>{{ link_to("persona/".$usuario->usuario, $usuario->usuario) }}</p>
    	@endforeach
	</p>
</div>
@stop