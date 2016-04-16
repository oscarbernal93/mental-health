@extends('layout')

@section('content')
<div>
	<h1>Detalles de Usuario</h1>
    <p>Nombre: {{ $sujeto->usuario }}</p>
    <p>Correo: {{ $sujeto->email }}</p>
    <p>SuperAdmin: {{ $sujeto->super?"Si":"No" }}</p>
    <p>Hash: {{ $sujeto->passhash }}</p>
</div>
@stop