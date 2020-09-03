@extends('admin.index_admin')
@section('title','Ketogame | Administrador')
@section('contenido')
@section('content-header','LISTADO DE ADMINISTRADORES')
@section('content-header-extra')
    <small>Aquí podrás realizar los ajustes necesarios para los administradores registrados</small>
@endsection
<div class="card change-card m-0">
    <div class="card-header row justify-content-between align-items-center">
        {{-- <div class="col-md-6">
            <h3 class="card-title">Admistración de administradores</h3>
        </div> --}}
        <div class="col-md-12 d-flex justify-content-end">
            <a href="{{ route('administrators.create') }}" class="btn btn-success">Nuevo administrador &nbsp;<i class="fa fa-plus"></i></a>
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
                    <th class="align-middle">Cargo</th>
                    <th class="align-middle">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                    @if(($admin->hasRole('superadmin') || $admin->hasRole('moderator')) && $admin->name != 'E-')
                        <tr class="text-center">
                            <td class="align-middle" style="width: 20%;">{{ $admin->name }} {{ $admin->lastname }}</td>
                            <td class="align-middle" style="width: 20%;">{{ $admin->email }}</td>
                            <td class="align-middle" style="width: 15%;">{{ $admin->epic->name ?? 'Epic ID no registrado' }}</td>
                            <td class="align-middle" style="width: 10%;"><a href="https://wa.me/52{{ $admin->mobile }}?text=Hola%20soy%20Keto%20te%20envio%20este%20mensaje%20para%20" title="Toca para enviar whatsapp" target="_blank">{{ $admin->mobile }}</a></td>
                            <td class="align-middle">
                                <img src="{{ $admin->profile_picture ? asset('storage/avatars/' . $admin->profile_picture) : asset('images/avatars/default-white.jpg')}}" class="img-circle elevation-2" style="width: 50px; height: 50px;" alt="User Image">
                            </td>
                            <td class="align-middle">
                                @foreach($countries as $country)
                                    @if($country->id == $admin->country->id)
                                        <span>{{ $country->name }}</span>
                                    @endif
                                @endforeach
                            </td>
                            <td class="align-middle">
                                @if($admin->hasRole('superadmin'))
                                    Superadmin
                                @else
                                    Moderador
                                @endif
                            </td>
                            <td class="align-middle">
                                <button class="openModalAndGetValues btn btn-rounded btn-outline-info btn-xs mt-1" data-modal="editAdmin" data-route="{{ route('administrators.edit', $admin->id) }}" title="Editar jugador">
                                    <i class="far fa-edit"></i>
                                </button>
                                <button class="deleteRegister btn btn-rounded btn-outline-danger btn-xs mt-1" data-modal="deleteRegister" data-route="{{ route('administrators.destroy', $admin->id) }}" data-id="{{ $admin->id }}" title="Eliminar jugador">
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
@include('admin.pages.admins.edit')
@endsection