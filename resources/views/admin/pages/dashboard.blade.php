@extends('admin.index_admin')
@section('title','Ketogame | Administrador')
@section('contenido')
@section('content-header','DASHBOARD')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 d-flex flex-column">
            <div class="row">
                {{-- TORNEOS --}}
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="info-box change-card">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-medal"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Torneos</span>
                            <span class="info-box-number">
                                @if($data->tournaments->count() > 0)
                                    {{ $data->tournaments->count() }}
                                @else
                                    Sin torneos
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                {{-- JUGADORES --}}
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="info-box mb-3 change-card">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-gamepad"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Jugadores</span>
                            <span class="info-box-number">{{ $data->players->count() }}</span>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-12 col-sm-6 col-md-6">
                    <div class="info-box mb-3 change-card">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Likes</span>
                        <span class="info-box-number">41,410</span>
                    </div>
                    </div>
                </div> --}}
                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>
                {{-- <div class="col-12 col-sm-6 col-md-6">
                    <div class="info-box mb-3 change-card">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Juegos</span>
                            <span class="info-box-number">760</span>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- USERS LIST -->
                    <div class="card change-card">
                        <div class="card-header">
                            <h3 class="card-title">Últimos jugadores registrados</h3>
                            <div class="card-tools">
                                {{-- <span class="badge badge-danger">8 nuevos usuarios</span> --}}
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button> --}}
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="users-list clearfix">
                                @forelse($data->players->take(8) as $player)
                                    <li>
                                        <img src="{{ $player->profile_picture ? asset('storage/avatars/' . $player->profile_picture) : asset('images/avatars/default-white.jpg')}}" class="img-resize" alt="User Image">
                                        <a class="users-list-name text-info" href="{{ route('showTournamentsByUser', $player->id) }}">{{ $player->name }}</a>
                                        <span class="users-list-date text-info">{{ $player->created_at->diffForHumans() }}</span>
                                    </li>
                                @empty
                                    <div class="text-center mt-4">
                                        <p>Ningún jugador registrado</p>
                                    </div>
                                @endforelse
                            </ul>
                        </div>
                        <div class="card-footer text-center">
                            <a class="btn btn-primary" href="{{ route('usersAdmin.index') }}">Ver todos los jugadores</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card change-card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Torneos más recientes</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button> --}}
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        @if($data->tournaments->count() > 0)
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th class="align-middle text-center">Nombre</th>
                                        <th class="align-middle text-center">Jugadores</th>
                                        <th class="align-middle text-center">Estatus</th>
                                        <th class="align-middle text-center">Fecha de inicio</th>
                                        <th>Creado...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->tournaments->take(8) as $tournament)
                                        <tr>
                                            <td class="align-middle text-center"><a href="{{ route('showUserByTournament',$tournament->id) }}">{{ $tournament->name }}</a></td>
                                            <td class="align-middle text-center">{{ $tournament->players->count() }}</td>
                                            <td class="align-middle text-center">
                                                @if($tournament->active == 0)
                                                    <span class="badge badge-warning">Por activar</span>
                                                @elseif($tournament->active == 1)
                                                    <span class="badge badge-success">Activo</span>
                                                @else
                                                    <span class="badge badge-danger">Cerrado</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="sparkbar" data-color="#f39c12" data-height="20">{{ $tournament->start_date->diffForHumans() }}</div>
                                            </td>
                                            <td>{{ $tournament->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-center"><span class="badge badge-warning">Sin torneos recientes</span></p>
                        @endif
                    </div>
                </div>
                <div class="card-footer clearfix">
                    <a href="{{ route('tournaments.index') }}" class="btn btn-sm btn-secondary float-right">Ver todos los torneos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection