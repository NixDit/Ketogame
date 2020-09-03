<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ketogame | Not found</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/4042-styles.css') }}">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="{{ asset('js/parallax.js') }}"></script>
</head>
<body>
	<div class="preloader"><div class="icon"></div></div>
	<div class="container" style="overflow: hidden;">
		<ul id="scene">
			<li class="layer" data-depth=".1"><img src="{{ 'images/background/text.png' }}"></li>
			<li class="layer" data-depth="-.1"><img src="{{ 'images/background/text-not-found.png' }}"></li>
			<li class="layer" data-depth=".2"><img src="{{ 'images/background/text-not-found-2.png' }}"></li>
			<li class="layer" data-depth="1"><img src="{{ 'images/background/planet1.png' }}"></li>
			<li class="layer" data-depth="-1"><img src="{{ 'images/background/planet2.png' }}"></li>
			<li class="layer" data-depth="0.5"><img src="{{ 'images/background/rocket.png' }}"></li>
		</ul>
	</div>
	<script src="{{ asset('js/404-script.js') }}"></script>
</body>
</html>