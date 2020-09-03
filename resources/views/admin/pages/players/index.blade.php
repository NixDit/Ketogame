@extends('admin.index_admin')
@section('title','Ketogame | Administrador')
@section('contenido')
@section('content-header','LISTADO DE JUGADORES')
@section('content-header-extra')
    <small>Aquí podrás realizar los ajustes necesarios para los jugadores registrados</small>
@endsection
<div class="card change-card m-0">
    <div class="card-header row justify-content-between align-items-center">
        {{-- <div class="col-md-6">
            <h3 class="card-title">Admistración de jugadores</h3>
        </div> --}}
        <div class="col-md-12 d-flex justify-content-end">
            <a href="{{ route('usersAdmin.create') }}" class="btn btn-success">Nuevo jugador &nbsp;<i class="fa fa-plus"></i></a>
        </div>
    </div>
    <div class="card-body table-overflow">
        <table class="dataTable table table-bordered table-striped change-table over-auto-datatable">
            <thead>
                <tr class="text-center">
                    <th class="align-middle">Nombre</th>
                    <th class="align-middle">Correo</th>
                    <th class="align-middle">Epic ID</th>
                    <th class="align-middle">Teléfono de contacto</th>
                    <th class="align-middle">Foto</th>
                    <th class="align-middle">País</th>
                    <th class="align-middle">Torneos</th>
                    <th class="align-middle">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($players as $player)
                    @if($player->hasRole('guest'))
                        <tr class="text-center">
                            <td class="align-middle" style="width: 20%;">{{ $player->name }} {{ $player->lastname }}</td>
                            <td class="align-middle" style="width: 20%;">{{ $player->email }}</td>
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
                                @if($player->tournaments->count() > 0)
                                    <a href="{{ route('showTournamentsByUser', $player->id) }}" class="btn btn-outline-info btn-xs">Ver detalles</a>
                                @else
                                    <span class="badge badge-warning">Sin torneos</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <button class="openModalAndGetValues btn btn-rounded btn-outline-info btn-xs mt-1" data-modal="editPlayer" data-route="{{ route('usersAdmin.edit', $player->id) }}" title="Editar jugador">
                                    <i class="far fa-edit"></i>
                                </button>
                                <button class="deleteRegister btn btn-rounded btn-outline-danger btn-xs mt-1" data-modal="deleteRegister" data-route="{{ route('usersAdmin.destroy', $player->id) }}" data-id="{{ $player->id }}" title="Eliminar jugador">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('admin.pages.players.edit')
@endsection