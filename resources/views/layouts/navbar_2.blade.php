<!-- Header Style Two -->
<header class="main-header header-style-two">
    <!-- Header Top -->
    <div class="header-top" style="display:none;">
        <div class="auto-container clearfix">
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

    <!-- Header Lower -->
    <div class="header-lower">
        <div class="auto-container">
            <div class="clearfix">
                <div class="logo pull-left m-2">
                    <a href="{{ route('home.show') }}" title=""><img src="{{ asset('images/logo-white.png') }}" alt="" title="KETOGAME | STREAMER | GAMER"></a>
                </div>
                <!--Nav Box-->
                <div class="nav-outer clearfix">
                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler"><span class="icon flaticon-menu-1"></span></div>

                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li class="current dropdown"><a href="{{ route('home.show') }}">Inicio</a></li>
                                <li class="dropdown"><a href="{{ Request::path() == '/' ? '#' : route('home.show').'#about-me' }}" class="scroll-to-target" data-target="#about-me">Acerca de mi</a></li>
                                <li class="dropdown"><a href="{{ Request::path() == '/' ? '#' : route('home.show').'#my-livestream' }}" class="scroll-to-target" data-target="#my-livestream">Mis directos</a></li>
                                <li class="dropdown"><a href="{{ route('tournament.show-all') }}">Torneos</a></li>
                                @guest
                                    @if(request()->routeIs('register'))
                                        <li><a href="{{ route('login') }}">Iniciar sesión</a></li>
                                    @else
                                        <li><a href="{{ route('register') }}">Registrarse</a></li>
                                    @endif
                                @else
                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @endguest
                            </ul>
                        </div>
                    </nav>
                    <!-- Main Menu End-->

                </div>
            </div>
        </div>
    </div>
    <!--End Header Upper-->

    <!-- Sticky Header  -->
    <div class="sticky-header">
        <div class="auto-container clearfix">
            <!--Logo-->
            <div class="logo pull-left">
                <a href="{{ route('home.show') }}" title=""><img src="images/logo.png" alt="" title=""></a>
            </div>
            <!--Right Col-->
            <div class="pull-right">
                <!-- Main Menu -->
                <nav class="main-menu clearfix">
                    <!--Keep This Empty / Menu will come through Javascript-->
                </nav><!-- Main Menu End-->
            </div>
        </div>
    </div><!-- End Sticky Menu -->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><span class="icon flaticon-close"></span></div>

        <nav class="menu-box">
            <div class="nav-logo"><a href="{{ route('home.show') }}"><img src="images/logo.png" alt="" title=""></a></div>
            <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
            <!--Social Links-->
            <div class="social-links">
                <ul class="clearfix">
                    <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                    <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                    <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                    <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                    <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                </ul>
            </div>
        </nav>
    </div><!-- End Mobile Menu -->
</header>
<!-- End Main Header -->