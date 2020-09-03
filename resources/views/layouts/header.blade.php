<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title', 'Ketogame')</title>
		<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
		<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
		<link rel="icon" href="images/favicon.png" type="image/x-icon">
		<!-- Stylesheets -->
		<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
		<link href="{{ asset('css/style.css') }}" rel="stylesheet">
		<link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
		<link href="{{ asset('css/auth.css') }}" rel="stylesheet">
		<link href="{{ asset('css/general.css') }}" rel="stylesheet">
		{{-- STUFF --}}
		<link rel="stylesheet" type="text/css" href="{{ asset('stuff/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('stuff/assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('stuff/assets/vendor/animate/animate.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('stuff/assets/vendor/css-hamburgers/hamburgers.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('stuff/assets/vendor/animsition/css/animsition.min.css') }}">
		{{-- <link rel="stylesheet" type="text/css" href="{{ asset('lte/css/select2-bootstrap4.min.css') }}"> --}}
		<link rel="stylesheet" type="text/css" href="{{ asset('stuff/assets/vendor/select2/select2.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('stuff/assets/vendor/daterangepicker/daterangepicker.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('stuff/assets/css/util.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('stuff/assets/css/main.css') }}">
		{{-- <link rel="stylesheet" type="text/css" href="{{ asset('stuff/assets/vendor/bootstrap/css/bootstrap.min.css') }}"> --}}
		{{-- <link href="{{ asset('css/style.css') }}" rel="stylesheet"> --}}
		<!-- Responsive -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
		<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
	</head>
<body style="background-color: black;">
	<div class="page-wrapper">
		<div class="preloader"><div class="icon"></div></div>