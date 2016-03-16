@extends('layout')

@section('content')
<div>
	<h1>Mental Health</h1>
	@if(\Session::get('message'))
        <div class="alert alert-info col-md-12">{{Session::get('message')}}</div>
    @endif
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incidid unt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
</div>
@stop