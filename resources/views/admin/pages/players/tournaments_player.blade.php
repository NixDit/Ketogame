@extends('admin.index_admin')
@section('title','Ketogame | Administrador')
@section('contenido')
@section('content-header','TORNEOS')
@section('content-header-extra')
    <small>Aquí podrás visualizar los torneos donde participa <b class="text-primary">{{ $player->name }} {{ $player->lastname }}</b></small>
@endsection
<div class="col-md-12">
    <div class="card card-widget widget-user change_dark mt-2 mb-0">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header text-white" style="background: url('{{ asset('images/background/banner-bg.jpg') }}') center center;">
            <h3 class="widget-user-username text-right">{{ $player->name }}  {{ $player->lastname }}</h3>
            {{-- <h5 class="widget-user-desc text-right">Web Designer</h5> --}}
        </div>
        <div class="widget-user-image">
            <img class="img-circle" src="{{ $player->profile_picture ? asset('storage/avatars/' . $player->profile_picture) : asset('images/avatars/default-white.jpg')}}" alt="User Avatar">
        </div>
        <div class="description-block mt-5 mb-3">
            <span class="description-text">TORNEOS</span>
            <h5 class="description-header">{{ $player->tournaments->count() }}</h5>
        </div>
        <div class="card-footer pt-2">
            @foreach($player->tournaments as $tournament)
                <div class="row">
                    <div class="col-sm-3 border-right border-bottom d-flex justify-content-center align-items-center">
                        <div class="description-block col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="description-text d-block mb-3">Nombre del torneo</span>
                                    <a href="{{ route('showUserByTournament',$tournament->id) }}" class="btn btn-outline-success btn-sm">
                                        <span class="description-header">{{ $tournament->name }}</span>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <span class="description-text d-block mb-3">Estatus del torneo</span>
                                    <h5 class="description-header">
                                        @if($tournament->active == 1)
                                            <span class="text-primary">Activo</span>
                                        @else
                                            <span class="text-danger">Cerrado</span>
                                        @endif
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9 border-right border-bottom d-flex justify-content-center align-items-center">
                        <div class="description-block col-md-12">
                            {{-- <span class="description-text d-block mb-3">IMAGENES SUBIDAS</span> --}}
                            <div class="progress-group">
                                IMAGENES SUBIDAS
                                @php
                                    $total    = 0;
                                    $progress = 0;
                                    if($tournament->pivot->picture_1 != null){
                                        $total    += 1;
                                        $progress += 20;
                                    }
                                    if($tournament->pivot->picture_2 != null){
                                        $total    += 1;
                                        $progress += 20;
                                    }
                                    if($tournament->pivot->picture_3 != null){
                                        $total    += 1;
                                        $progress += 20;
                                    }
                                    if($tournament->pivot->picture_4 != null){
                                        $total    += 1;
                                        $progress += 20;
                                    }
                                    if($tournament->pivot->picture_5 != null){
                                        $total    += 1;
                                        $progress += 20;
                                    }
                                    $progress == 99 ? $progress = 100 : $progress = $progress;
                                @endphp
                                <span class="float-right"><b>{{ $total }}</b>/5</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary" style="width: {{ $progress }}%"><span>{{ $progress }}%</span></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 modal-container mt-2">
                                    <span class="fab fa-youtube"></span>
                                    {{-- <img class="elevation-2 align-middle @if($tournament->pivot->picture_1 != null) modal-img @endif" id="myImg" style="max-width: 100%; height: 80px; object-fit: contain;" src="{{ $tournament->pivot->picture_1 ? asset('storage/print-screens/'.$tournament->pivot->picture_1) : asset('images/avatars/default-white.jpg') }}" alt="Youtube"> --}}
                                </div>
                                <div class="col-md-2 modal-container mt-2">
                                    <span class="fab fa-facebook-square"></span>
                                    <img class="elevation-2 align-middle @if($tournament->pivot->picture_2 != null) modal-img @endif" style="max-width: 100%; height: 80px; object-fit: contain;" src="{{ $tournament->pivot->picture_2 ? asset('storage/print-screens/'.$tournament->pivot->picture_2) : asset('images/avatars/default-white.jpg') }}" alt="Facebook">
                                </div>
                                <div class="col-md-2 modal-container mt-2">
                                    <span class="fab fa-twitch"></span>
                                    <img class="elevation-2 align-middle @if($tournament->pivot->picture_3 != null) modal-img @endif" style="max-width: 100%; height: 80px; object-fit: contain;" src="{{ $tournament->pivot->picture_3 ? asset('storage/print-screens/'.$tournament->pivot->picture_3) : asset('images/avatars/default-white.jpg') }}" alt="Twitch">
                                </div>
                                <div class="col-md-2 modal-container mt-2">
                                    <span class="fab fa-instagram"></span>
                                    <img class="elevation-2 align-middle @if($tournament->pivot->picture_4 != null) modal-img @endif" style="max-width: 100%; height: 80px; object-fit: contain;" src="{{ $tournament->pivot->picture_4 ? asset('storage/print-screens/'.$tournament->pivot->picture_4) : asset('images/avatars/default-white.jpg') }}" alt="Instagram">
                                </div>
                                <div class="col-md-2 modal-container mt-2">
                                    <span class="fab fa-twitter"></span>
                                    <img class="elevation-2 align-middle @if($tournament->pivot->picture_5 != null) modal-img @endif" style="max-width: 100%; height: 80px; object-fit: contain;" src="{{ $tournament->pivot->picture_5 ? asset('storage/print-screens/'.$tournament->pivot->picture_5) : asset('images/avatars/default-white.jpg') }}" alt="Twitter">
                                </div>
                                <div class="col-md-2 modal-container mt-2 d-flex align-items-center justify-content-center">
                                    <button class="deleteUserTournament btn btn-rounded btn-outline-danger w-100" data-route="{{ route('deleteUserParticipation') }}" data-id="{{ $player->id }}" data-tournament="{{ $tournament->id }}" title="Eliminar participación en el torneo">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
{{-- MODAL IMG --}}
<div id="modal-img" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content img-fluid" id="set-img" style="max-width: 900px;">
    <div id="caption"></div>
</div>
@include('admin.pages.admins.edit')
@endsection