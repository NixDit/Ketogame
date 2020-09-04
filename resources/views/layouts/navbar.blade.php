<header class="main-header">
    {{-- HEADER TOP --}}
    <div class="header-top">
        <div class="auto-container clearfix">

            <div class="top-left clearfix">
                <ul class="info-list">
                    <li></li>
                </ul>
            </div>

            <div class="top-right">
                <ul class="social-icons">
                    <li><a href="https://www.youtube.com/channel/UCabhMugHn0d5FybCw2XriTA" target="_blank"><span class="fab fa-youtube"></span></a></li>
                    <li><a href="https://www.facebook.com/ketogame666" target="_blank"><span class="fab fa-facebook-square"></span></a></li>
                    <li><a href="https://www.twitch.tv/ketoxgame" target="_blank"><span class="fab fa-twitch"></span></a></li>
                    <li><a href="https://twitter.com/ketogame666" target="_blank"><span class="fab fa-twitter"></span></a></li>
                    <li><a href="https://www.instagram.com/ketogame_oficial" target="_blank"><span class="fab fa-instagram"></span></a></li>
                </ul>
            </div>
        </div>
    </div>
    {{-- END HEADER TOP --}}

    {{-- HEADER MENU --}}
    <div class="header-upper">
        <div class="inner-container">
            <div class="auto-container clearfix">
                <!--LOGO-->
                <div class="logo-outer">
                    <div class="logo"><a href="{{ route('home.show') }}"><img src="{{ asset('images/logo-white.png') }}" alt="" title="KETOGAME | STREAMER | GAMER"></a></div>
                </div>

                <!--Nav Box-->
                <div class="nav-outer clearfix">
                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler"><span class="icon flaticon-menu-1"></span></div>

                    <!-- Main Menu -->
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix pull-left">
                                <li class="current dropdown"><a href="{{ Request::path() == '/' ? 'javascript:void(0)' : route('home.show') }}" class="scroll-to-target" data-target="html">Inicio</a></li>
                                <li class="dropdown"><a href="{{ Request::path() == '/' ? 'javascript:void(0)' : route('home.show').'#about-me' }}" class="scroll-to-target" data-target="#about-me">Acerca de mí</a></li>
                                <li class="dropdown"><a href="{{ Request::path() == '/' ? 'javascript:void(0)' : route('home.show').'#my-livestream' }}" class="scroll-to-target" data-target="#my-livestream">Mis directos</a></li>
                            </ul>
                            <ul class="navigation pull-right clearfix">
                                <li class="dropdown"><a href="{{ route('tournament.show-all') }}">Torneos</a></li>
                                @auth
                                    <li class="dropdown"><a href="#">{{ Auth::user()->name }}</a>
                                        <ul>
                                            @if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('moderator'))
                                                <li><a href="{{ route('admin.index') }}">Panel de control</a></li>
                                            @endif
                                            <li><a href="{{ route('users.show') }}">Mi perfil</a></li>
                                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a></li>
                                        </ul>
                                    </li>
                                    {{-- FORM LOGOUT --}}
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @else
                                    <li><a href="{{ route('login') }}">Iniciar sesión</a></li>
                                    <li><a href="{{ route('register') }}">Registrarse</a></li>
                                @endauth

                            </ul>
                        </div>
                    </nav>
                    <!-- Main Menu End-->
                </div>
            </div>
        </div>
    </div>
    {{-- END HEADER MENU --}}

    {{-- STICKY HEADER MENU --}}
    <div class="sticky-header">
        <div class="auto-container clearfix w-75">
            <!--Logo-->
            <div class="logo pull-left">
                <a href="{{ route('home.show') }}" title=""><img src="{{ asset('images/logo-white.png') }}" alt="" title=""></a>
            </div>
            <!--Right Col-->
            <div class="pull-right">
                <!-- Main Menu -->
                <nav class="main-menu clearfix">
                    <!--Keep This Empty / Menu will come through Javascript-->
                </nav><!-- Main Menu End-->
            </div>
        </div>
    </div>
    {{-- END STICKY HEADER MENU --}}

    {{-- MOBILE MENU --}}
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><span class="icon flaticon-close"></span></div>

        <nav class="menu-box">
            <div class="nav-logo"><a href="{{ route('home.show') }}"><img src="{{ asset('images/logo-white.png') }}" alt="" title=""></a></div>
            <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
            <!--Social Links-->
            <div class="social-links">
                <ul class="clearfix">
                    <li><a href="https://www.youtube.com/channel/UCabhMugHn0d5FybCw2XriTA" target="_blank"><span class="fab fa-youtube"></span></a></li>
                    <li><a href="https://www.facebook.com/ketogame666" target="_blank"><span class="fab fa-facebook-square"></span></a></li>
                    <li><a href="https://www.twitch.tv/ketoxgame" target="_blank"><span class="fab fa-twitch"></span></a></li>
                    <li><a href="https://twitter.com/ketogame666" target="_blank"><span class="fab fa-twitter"></span></a></li>
                    <li><a href="https://www.instagram.com/ketogame_oficial" target="_blank"><span class="fab fa-instagram"></span></a></li>
                </ul>
            </div>
        </nav>
    </div>
    {{-- END MOBILE MENU --}}
</header>
{{-- END HEADER --}}