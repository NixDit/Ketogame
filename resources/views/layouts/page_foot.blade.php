<!-- Main Footer -->
<footer class="main-footer">
    <div class="auto-container">
        <!--Widgets Section-->
        <div class="widgets-section">
            <div class="row clearfix">
                <!--DESCRIPTION-->
                <div class="column col-lg-6 col-md-6 col-sm-12">
                    <div class="footer-widget logo-widget">
                        <div class="logo">
                            <a href="index.html"><img src="{{ asset('images/logo-white.png') }}" alt="" /></a>
                        </div>
                        <div class="text">Videojuegos, streaming, entretenimiento y mucho mas.</div>
                    </div>
                </div>
                <!--LINKS-->
                <div class="column col-lg-6 col-md-6 col-sm-12">
                    <div class="footer-widget links-widget">
                        <div class="widget-content">
                            <div class="footer-title">
                                <h2>Links</h2>
                            </div>
                            <div class="row clearfix">
                                <div class="column col-lg-6 col-md-6 col-sm-12">
                                    <ul class="list">
                                        <li class="current dropdown"><a href="{{ Request::path() == '/' ? '#' : route('home.show') }}" class="scroll-to-target" data-target="html">Inicio</a></li>
                                        <li class="dropdown"><a href="{{ route('tournament.show-all') }}">Torneos</a></li>
                                        <li class="dropdown"><a href="{{ Request::path() == '/' ? '#' : route('home.show').'#about-me' }}" class="scroll-to-target" data-target="#about-me">Acerca de mi</a></li>
                                        <li class="dropdown"><a href="{{ Request::path() == '/' ? '#' : route('home.show').'#my-livestream' }}" class="scroll-to-target" data-target="#my-livestream">Mis directos</a></li>
                                    </ul>
                                </div>
                                <div class="column col-lg-6 col-md-6 col-sm-12">
                                    <ul class="list">
                                        <li><a href="{{ route('login') }}">Terminos y condiciones</a></li>
                                        <li><a href="{{ route('help.privacy') }}">Aviso de privacidad</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PENDIENTE PARA FUTURAS VERSIONES --}}
                <!--Column-->
                {{-- <div class="column col-lg-4 col-md-6 col-sm-12">
                    <div class="footer-widget newsletter-widget">
                        <div class="footer-title">
                            <h2>Newsletter</h2>
                        </div>
                        <div class="text">Subsrcibe us now to get the latest news and updates</div>
                        <div class="newsletter-form">
                            <form method="post" action="contact.html">
                                <div class="form-group clearfix">
                                    <input type="email" name="email" value="" placeholder="Email address" required>
                                    <button type="submit" class="theme-btn newsletter-btn"><span class="fas fa-envelope"></span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="auto-container">
            <!--Scroll to top-->
            <div class="scroll-to-top scroll-to-target" data-target="html"><span class="flaticon-up-arrow"></span></div>
            <!--Scroll to top-->
            <div class="row clearfix">
                <!-- Column -->
                <div class="column col-lg-6 col-md-12 col-sm-12">
                    <div class="copyright">KetoGame &copy; {{ now()->year }} Todos los derechos reservados.</div>
                </div>
                <!-- Column -->
                <div class="column col-lg-6 col-md-12 col-sm-12">
                    <ul class="social-icons">
                        <li><a href="https://www.youtube.com/channel/UCabhMugHn0d5FybCw2XriTA" target="_blank"><span class="fab fa-youtube"></span></a></li>
                        <li><a href="https://www.facebook.com/ketogame666" target="_blank"><span class="fab fa-facebook-square"></span></a></li>
                        <li><a href="https://www.twitch.tv/ketoxgame" target="_blank"><span class="fab fa-twitch"></span></a></li>
                        <li><a href="https://twitter.com/ketogame666" target="_blank"><span class="fab fa-twitter"></span></a></li>
                        <li><a href="https://www.instagram.com/ketogame_oficial/" target="_blank"><span class="fab fa-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</footer>
</div>