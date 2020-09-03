<nav class="main-header navbar navbar-expand navbar-dark navbar-light sticky-top change_dark background-blue">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.index') }}" class="nav-link text-white">Inicio</a>
        </li>
    </ul>
    <!-- SEARCH FORM -->
    {{-- <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Buscar..." aria-label="Buscar...">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form> --}}
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <input type="hidden" id="status_dark_mode" value="{{ Auth::user()->dark_mode }}">
            <button class="switch @if(Auth::user()->dark_mode == 0) active @endif" id="dark-mode">
                <span><i class="fas fa-sun"></i></span>
                <span><i class="fas fa-moon"></i></span>
            </button>
        </li>
        <li class="nav-item">
            <a class="btn btn-danger btn-sm text-white ml-2" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        @role('superadmin')
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown">
                    <i class="far fa-bell"></i>
                    @if(count($logs) > 0)
                        <span class="badge badge-danger navbar-badge" id="totalNotRead">{{ $notReadLogs->count() }}</span>
                    @else
                        <span class="badge badge-danger navbar-badge" id="totalNotRead">0</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div style="overflow: auto; max-height: 350px; overflow-x: hidden;" id="log-box">
                        @forelse ($logs as $log)
                            <div class="dropdown-item logDetail">
                                <div class="media">
                                    <img src="{{ $log->user->profile_picture ? asset('storage/avatars/' . $log->user->profile_picture) : asset('images/avatars/default-white.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            <span><b>{{ $log->user->name }} {{ $log->user->lastname }}</b></span>
                                            @if($log->type == 'created')
                                                <span class="float-right text-sm text-success mt-2"><i class="fas fa-star"></i></span>
                                            @elseif($log->type == 'edited')
                                                <span class="float-right text-sm text-warning mt-2"><i class="fas fa-star"></i></span>
                                            @elseif($log->type == 'deleted')
                                                <span class="float-right text-sm text-danger mt-2"><i class="fas fa-star"></i></span>
                                            @elseif($log->type == 'email')
                                                <span class="float-right text-sm text-info mt-2"><i class="fas fa-envelope"></i></span>
                                            @endif
                                        </h3>
                                        <p class="text-sm">{{ $log->description }}</p>
                                        <p class="text-sm text-muted">
                                            <i class="far fa-clock mr-1"></i>{{ $log->created_at->diffForHumans() }}
                                            <span class="float-right text-sm text-info mt-2 logRead" data-id="{{ $log->id }}" title="Eliminar y marcar como leído" style="cursor: pointer;"><i class="fas fa-check"></i></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                        @empty
                            <div class="container my-2">
                                <div class="alert alert-warning text-center m-0" role="alert" style="background: rgba(255,193,7,0.5);">
                                    Ninguna notificación
                                </div>
                            </div>
                        @endforelse
                    </div>
                    @if(count($logs) > 0)
                        <a href="#" class="dropdown-item dropdown-footer" id="deleteAllLogs">
                            Eliminar todo
                        </a>
                    @endif
                </div>
            </li>
        @endrole
        <!-- Messages Dropdown Menu -->
        {{-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li> --}}
        {{-- <li>
            <a class="btn btn-danger btn-sm ml-3" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li> --}}
        {{-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                <i class="fas fa-th-large"></i>
            </a>
        </li> --}}
    </ul>
</nav>