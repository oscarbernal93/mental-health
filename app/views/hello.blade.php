@extends('layout')

@section('content')
<div>
	<h1>Mental Health</h1>
    <p>Bienvenido {{$usuario}}</p>
    @if(is_null($roles))
    	<p>Usted no se ha autenticado todavia, por favor Inicie Sesión</p>
    @else
    	<p>
    	Usted cuenta con los siguientes roles en el sistema:
    	<ul>
    	@foreach ($roles as $rol)
    		<li>{{$rol}}</li>
    	@endforeach
    	</ul>
    	</p>
    @endif
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incidid unt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
</div>
<div>
@if($es_admin)
    {{ Form::open(array('action' => 'UsuarioController@reiniciarMedicos')) }}
    <div>
        {{ Form::submit('Actualizar todos los Médicos a "No disponible!') }}
    </div>
    {{ Form::close()}}
@endif
</div>
@stop