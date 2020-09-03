<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 change_dark background-blue">
    <!-- Brand Logo -->
    <a href="{{ route('home.show') }}" class="brand-link d-flex flex-column align-items-center pl-0 text-white" style="box-shadow: 0 14px 28px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.22)!important;">
        <img src="{{ asset('images/logo-white.png') }}"
            alt="Admin Logo"
            class="brand-image img-circle"
            style="opacity: .8">
        {{-- <span class="brand-text font-weight-light"><b>Panel de control</b></span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel my-3 pb-3 d-flex flex-column align-items-center pr-3">
            <div class="image">
                <img src="{{ Auth::user()->profile_picture ? asset('storage/avatars/' . Auth::user()->profile_picture) : asset('images/avatars/default-white.jpg')}}" class="img-circle elevation-2" style="width: 50px; height: 50px;" alt="User Image">
            </div>
            <div class="info d-flex flex-column text-center">
                <a href="#" class="d-block text-white" style="white-space: normal;">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</a>
                <div class="w-50">
                    <a class="btn btn-success btn-sm text-white w-100" href="{{ route('users.show', Auth::user()->id) }}">Mi perfil</a>
                    <a href="{{ route('showTournamentsByUser', Auth::user()->id) }}" class="btn btn-outline-info btn-sm w-100">Mis torneos</a>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link text-white">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                        Dashboard
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="{{ route('admin.index') }}" class="nav-link text-white">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Datos</p>
                        </a>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link text-white">
                        <i class="nav-icon fas fa-medal"></i>
                        <p>
                        Torneos
                        <i class="fas fa-angle-left right"></i>
                        <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="{{ route('tournaments.index') }}" class="nav-link text-white">
                                <i class="fas fa-list-alt nav-icon"></i>
                                <p>Ver todos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tournaments.create') }}" class="nav-link text-white">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Agregar</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link text-white">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                        Jugadores
                        <i class="fas fa-angle-left right"></i>
                        <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="{{ route('usersAdmin.index') }}" class="nav-link text-white">
                                <i class="fas fa-list-alt nav-icon"></i>
                                <p>Ver todos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('usersAdmin.create') }}" class="nav-link text-white">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Agregar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @role('superadmin')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-white">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>
                            Administradores
                            <i class="fas fa-angle-left right"></i>
                            <!-- <span class="badge badge-info right">6</span> -->
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('administrators.index') }}" class="nav-link text-white">
                                    <i class="fas fa-list-alt nav-icon"></i>
                                    <p>Ver todos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('administrators.create') }}" class="nav-link text-white">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Agregar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endrole
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
