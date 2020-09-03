@extends('admin.index_admin')
@section('title','Ketogame | Administrador')
@section('contenido')
@section('content-header','TORNEOS')
@section('content-header-extra')
    <small>Aquí podrás visualizar los jugadores registrados en el torneo <b class="text-primary">{{ $tournament->name }}</b></small>
@endsection
<div class="col-md-12">
    <div class="card card-widget widget-user change_dark mt-2 mb-0">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header text-white" style="background: url('{{ asset('images/background/banner-bg.jpg') }}') center center;">
            <h3 class="widget-user-username text-right">{{ $tournament->name }}</h3>
            {{-- <h5 class="widget-user-desc text-right">Web Designer</h5> --}}
        </div>
        <div class="description-block mt-5 mb-3">
            <span class="description-text">JUGADORES REGISTRADOS</span>
            <h5 class="description-header mb-2">{{ (int)$tournament->total_participants }} / {{ (int)$tournament->max_participants }}</h5>
            <div class="d-flex flex-column">
                <div class="">
                    <button class="btn btn-success mt-2" id="downloadExcel" data-id="{{ $tournament->id }}" @if(((int)$tournament->total_participants < (int)$tournament->max_participants) && $tournament->active != 2) disabled @endif>
                        Descargar relación de jugadores
                    </button>
                    <div class="row align-items-center justify-content-around w-50 m-auto pt-2">
                        <div class="custom-control custom-checkbox col-md-6">
                            <input type="checkbox" class="custom-control-input" id="complete" @if(((int)$tournament->total_participants < (int)$tournament->max_participants) && $tournament->active != 2) disabled @endif>
                            <label class="custom-control-label" for="complete">Jugadores con registro completo</label>
                        </div>
                        <div class="custom-control custom-checkbox  col-md-6">
                            <input type="checkbox" class="custom-control-input" id="incomplete" @if(((int)$tournament->total_participants < (int)$tournament->max_participants) && $tournament->active != 2) disabled @endif>
                            <label class="custom-control-label" for="incomplete">Jugadores con registro incompleto</label>
                        </div>
                    </div>
                </div>
                @if(((int)$tournament->total_participants < (int)$tournament->max_participants) && $tournament->active != 2)
                    <small class="text-danger">El reporte está disponible únicamente cuando el torneo está a su máximo de jugadores registrados ó se encuentre "cerrado"</small>
                @endif
            </div>
        </div>
        <div class="card-footer pt-2">
            <table class="dataTable table table-bordered table-striped change-table over-auto-datatable">
                <thead>
                    <tr class="text-center">
                        <th class="align-middle">Nombre</th>
                        <th class="align-middle">Epic ID</th>
                        <th class="align-middle">Telefono de contacto</th>
                        <th class="align-middle">Foto</th>
                        <th class="align-middle">País</th>
                        <th class="align-middle">Campeonato</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tournament->players as $player)
                        <tr class="text-center">
                            <td class="align-middle" style="width: 30%;">
                                <a href="{{ route('showTournamentsByUser', $player->id) }}">{{ $player->name }} {{ $player->lastname }}</a>
                            </td>
                            <td class="align-middle" style="width: 15%;">{{ $player->epic->name ?? 'Epic ID no registrado' }}</td>
                            <td class="align-middle" style="width: 10%;"><a href="https://wa.me/{{ $player->country->phonecode }}{{ $player->mobile }}?text=Hola%20soy%20Keto%20te%20envio%20este%20mensaje%20para%20" title="Toca para enviar whatsapp" target="_blank">{{ $player->mobile }}</a></td>
                            <td class="align-middle">
                                <img src="{{ $player->profile_picture ? asset('storage/avatars/' . $player->profile_picture) : asset('images/avatars/default-white.jpg')}}" class="img-circle elevation-2" style="width: 50px; height: 50px;" alt="User Image">
                            </td>
                            <td class="align-middle">
                                @foreach($countries as $country)
                                    @if($country->id == $player->country->id)
                                        <span>{{ $country->name }}</span>
                                    @endif
                                @endforeach
                            </td>
                            <td class="align-middle">
                                @if(is_object($tournament->champion))
                                    @if($tournament->champion->id == $player->id)
                                        <span class="badge badge-primary">¡CAMPEÓN!</span>
                                    @else
                                        <button data-route="{{ route('setChampion') }}" data-id="{{ $tournament->id }}" data-player="{{ $player->id }}" class="btn btn-outline-success btn-xs setChampion">Asignar victoria</button>
                                    @endif
                                @else
                                    <button data-route="{{ route('setChampion') }}" data-id="{{ $tournament->id }}" data-player="{{ $player->id }}" class="btn btn-outline-success btn-xs setChampion">Asignar victoria</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('admin.pages.admins.edit')
@endsection