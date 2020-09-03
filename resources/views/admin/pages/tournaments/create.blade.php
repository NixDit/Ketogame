@extends('admin.index_admin')
@section('title','Ketogame | Administrador')
@section('contenido')
@section('content-header','NUEVO TORNEO')
@section('content-header-extra')
    <small>Aquí podrás registrar un nuevo torneo</small>
@endsection
<div class="card change-card m-0">
    <div class="card-header">
        <h3 class="card-title">Agregar nuevo torneo</h3>
    </div>
    <form class="form-horizontal" method="POST" action="{{ route('tournaments.store') }}" id="new-register" style="display: contents;" enctype="multipart/form-data">
        <div class="card-body">
            @csrf
            <!-- Nombre del torneo -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text adjusting-append-icons"><i class="fab fa-elementor"></i></span>
                </div>
                <input type="text" class="form-control" id="name" name="name" data-name="nombre" placeholder="Nombre del torneo" data-required="true">
            </div>
            {{-- Descripción del torneo --}}
            <div class="form-group">
                <label for="description">Descripción del torneo</label>
                <textarea class="form-control" id="description" name="description" data-name="descripción" data-required="true" rows="3"></textarea>
            </div>
            {{-- Cantidad del premio --}}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text adjusting-append-icons"><i class="fas fa-dollar-sign"></i></span>
                </div>
                <input type="number" class="form-control" id="prize_pool" name="prize_pool" data-name="premio" placeholder="Cantidad del premio" data-required="true">
            </div>
            {{-- Máximo de participantes --}}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text adjusting-append-icons"><i class="fas fa-users"></i></span>
                </div>
                <input type="number" class="form-control" id="max_participants" name="max_participants" data-name="premio" placeholder="Máximo de jugadores" data-required="true">
            </div>
            <!-- Fecha del torneo -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text adjusting-append-icons"><i class="fas fa-calendar-alt"></i></span>
                </div>
                <input type="text" autocomplete="off" class="form-control datepickerSingle" id="start_date" name="start_date" data-name="fecha" placeholder="Fecha del torneo" data-required="true">
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