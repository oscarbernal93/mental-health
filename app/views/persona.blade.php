@extends('layout')

@section('content')
<div>
	<h1>Detalles de Usuario</h1>
    <p>Nombre: {{ $persona->usuario }}</p>
    <p>Correo: {{ $persona->email }}</p>
    <p>SuperAdmin: {{ $persona->super?"Si":"No" }}</p>
    <p>Hash: {{ $persona->passhash }}</p>
</div>
@stop