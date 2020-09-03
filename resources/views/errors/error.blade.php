<!DOCTYPE html>
<html>
<head>
	<title>Ketogame | 404 No encontrado </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/404-styles.css') }}">
</head>
<body>
	<div class="preloader"><div class="icon"></div></div>
	<div id="container">
		<div class="content">
			<h2 class="title">404</h2>
			<h4>Opps! Pagina no encontrada</h4>
			<p>En tu travesia has llegado a un lugar desconocido, sal de aqui antes de que las cosas se tornen feas.<br>Suerte en tu viaje</p>
			<a href="{{ route('home.show') }}">Regresar al inicio</a>
		</div>
	</div>
	<script src="{{ asset('js/404-script.js') }}"></script>
</body>
</html>