<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Ketogame')</title>
    
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="{{ asset('lte/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/css/datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/css/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('lte/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/css/fontawesome-iconpicker.min.css') }}">
    {{-- PRELOADER --}}
    <link rel="stylesheet" href="{{ asset('lte/css/preloader.css') }}">
</head>
{{-- HEADER --}}
<body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="loader_bg">
        <div class="loader"></div>
    </div>
    <div class="page-wrapper">