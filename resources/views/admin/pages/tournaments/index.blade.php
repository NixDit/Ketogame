@extends('admin.index_admin')
@section('title','Ketogame | Administrador')
@section('contenido')
@section('content-header','LISTADO DE TORNEOS')
@section('content-header-extra')
    <small>Aquí podrás realizar los ajustes necesarios para los torneos registrados</small>
@endsection
<div class="card change-card m-0">
    <div class="card-header row justify-content-between align-items-center">
        {{-- <div class="col-md-6">
            <h3 class="card-title">Admistración de torneos</h3>
        </div> --}}
        <div class="col-md-12 d-flex justify-content-end">
            <a href="{{ route('tournaments.create') }}" class="btn btn-success">Nuevo torneo &nbsp;<i class="fa fa-plus"></i></a>
        </div>
    </div>
    <div class="card-body table-overflow">
        <table class="dataTable table table-bordered table-striped change-table over-auto-datatable">
            <thead>
                <tr class="text-center">
                    <th class="align-middle">Nombre</th>
                    <th class="align-middle">Descripción</th>
                    <th class="align-middle">Premios</th>
                    <th class="align-middle">Máximo de jugadores</th>
                    <th class="align-middle">Fecha de inicio</th>
                    <th class="align-middle">Jugadores</th>
                    <th class="align-middle">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tournaments as $tournament)
                    <tr class="text-center">
                        <td class="align-middle" style="width: 15%">{{ $tournament->name }}</td>
                        <td class="align-middle" style="width: 35%">{{ $tournament->description }}</td>
                        <td class="align-middle" style="width: 10%">$ {{ $tournament->prize_pool }}</td>
                        <td class="align-middle" style="width: 10%">{{ $tournament->max_participants }}</td>
                        <td class="align-middle" style="width: 10%">{{ $tournament->start_date->formatLocalized('%d de %B del %Y') }}</td>
                        <td class="align-middle" style="width: 10%">
                            @if($tournament->players->count() > 0)
                                <a href="{{ route('showUserByTournament',$tournament->id) }}" class="btn btn-outline-info btn-xs">Ver más</a>
                            @else
                                <span class="badge badge-warning">Sin jugadores</span>
                            @endif
                        </td>
                        <td class="align-middle" style="width: 10%">
                            <button class="openModalAndGetValues btn btn-rounded btn-outline-primary btn-xs mt-1" data-route="{{ route('tournaments.edit', $tournament->id) }}" data-modal="editTournament" title="Editar torneo">
                                <i class="far fa-edit"></i>
                            </button>
                            @role('superadmin')
                                <button class="deleteRegister btn btn-rounded btn-outline-danger btn-xs mt-1" data-route="{{ route('tournaments.destroy', $tournament->id) }}" data-id="{{ $tournament->id }}" data-modal="deleteRegister" title="Eliminar torneo">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                                @if($tournament->active == 0)
                                    <button class="changeStatusTournament btn btn-rounded btn-outline-success btn-xs mt-1" data-route="{{ route('tournaments.status') }}" data-id="{{ $tournament->id }}" data-status="active" data-text="activar" title="Activar torneo">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                @elseif($tournament->active == 1)
                                    <button class="changeStatusTournament btn btn-rounded btn-outline-warning btn-xs mt-1" data-route="{{ route('tournaments.status') }}" data-id="{{ $tournament->id }}" data-status="close" data-text="cerrar" title="Cerrar registro del torneo">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                @else
                                    <button class="changeStatusTournament btn btn-rounded btn-outline-warning btn-xs mt-1" data-route="{{ route('tournaments.status') }}" data-id="{{ $tournament->id }}" data-status="active" data-text="re-activar" title="Reactivar torneo">
                                        <i class="fas fa-check"></i>
                                    </button>
                                @endif
                            @endrole
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('admin.pages.tournaments.edit')
@endsection