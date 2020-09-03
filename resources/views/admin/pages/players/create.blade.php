@extends('admin.index_admin')
@section('title','Ketogame | Administrador')
@section('contenido')
@section('content-header','NUEVO JUGADOR')
@section('content-header-extra')
    <small>Aquí podrás registrar un nuevo jugador</small>
@endsection
<div class="card change-card m-0">
    <div class="card-header">
        <h3 class="card-title">Agregar nuevo jugador</h3>
    </div>
    <form class="form-horizontal" method="POST" action="{{ route('usersAdmin.store') }}" id="new-register" style="display: contents;" enctype="multipart/form-data">
        <div class="card-body">
            @csrf
            <!-- Nombre del jugador -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text adjusting-append-icons"><i class="fab fa-elementor"></i></span>
                </div>
                <input type="text" class="form-control" id="name" name="name" data-name="nombre(s)" placeholder="Nombre(s) del jugador" data-required="true">
            </div>
            <!-- Apellidos del jugador -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text adjusting-append-icons"><i class="fab fa-elementor"></i></span>
                </div>
                <input type="text" class="form-control" id="lastname" name="lastname" data-name="apellido(s)" placeholder="Apellidos(s) del jugador" data-required="true">
            </div>
            <!-- Correo del jugador -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text adjusting-append-icons"><i class="fas fa-at"></i></span>
                </div>
                <input type="email" class="form-control" id="email" name="email" data-name="correo" placeholder="Correo del jugador" data-required="true">
            </div>
            <!-- Contraseña del jugador -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text adjusting-append-icons"><i class="fas fa-key"></i></span>
                </div>
                <input type="password" class="form-control" id="password" name="password" data-name="contraseña" placeholder="Contraseña del jugador" data-required="true">
            </div>
            <!-- EPIC ID -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text adjusting-append-icons"><i class="fas fa-user"></i></span>
                </div>
                <input type="number" class="form-control" id="epic_id" name="epic_id" data-name="epic ID" placeholder="EPIC ID">
            </div>
            <!-- País del jugador -->
            <div class="input-group mb-3" style="color: #495057;">
                <div class="input-group-prepend">
                    <span class="input-group-text adjusting-append-icons"><i class="fas fa-globe"></i></span>
                </div>
                <select class="form-control select2" data-placeholder="País del jugador" name="country_id" id="country_id" data-name="país" data-required="true">
                    <option value=""></option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Teléfono del jugador -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text adjusting-append-icons"><i class="fas fa-phone"></i></span>
                </div>
                <input type="tel" class="form-control" id="mobile" name="mobile" data-name="teléfono" placeholder="Teléfono de contacto" data-required="true" data-inputmask="'mask': ['999-999-9999']" data-mask>
            </div>
            {{-- Imagen del jugador --}}
            <div class="form-group">
                <label for="profile_picture">Imagen del jugador (Opcional)</label>
                <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
            </div>
        </div>
        <div class="card-footer d-flex justify-content-center">
            <div class="btn-group">
                <button type="button" class="btn btn-info resetForm">Limpiar</button>
                <button type="submit" class="btn btn-success spinEfect d-flex align-items-center">
                    <span class="spinner-border spinner-border-sm mr-1 d-none" role="status" aria-hidden="true"></span>
                    <span id="button-text">Agregar</span>
                </button>
            </div>
        </div>
    </form>
</div>
@endsection