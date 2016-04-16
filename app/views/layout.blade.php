<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Mental Health</title>
		<!-- Estilos -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.min.css" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" crossorigin="anonymous">
		@yield('style')
	</head>
	<body style='margin-top:40px;'>


	    <nav class="navbar navbar-inverse navbar-fixed-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="{{asset('/')}}">Mental Health</a>
	        </div>
	        <!-- Aqui Comienza el Menú -->
	        <div id="navbar" class="collapse navbar-collapse">
	          <ul class="nav navbar-nav">
	        	@foreach(Config::get('menu') as $item)
	        		<li><a href="{{$item['url']}}">{{$item['nombre']}}</a></li>
	        	@endforeach
	          </ul>
	        </div>
	        <!-- Fin del Menú -->
	      </div>
	    </nav>

	    <div class="container">

	      @yield('content')

	    </div>

	    <!-- Scripts -->
	    <script src="https://code.jquery.com/jquery-2.2.1.min.js" integrity="sha256-gvQgAFzTH6trSrAWoH1iPo9Xc96QxSZ3feW6kem+O00=" crossorigin="anonymous"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/locales/bootstrap-datepicker.es.min.js" crossorigin="anonymous"></script>
	    <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
	    @yield('script')
	</body>
</html>
