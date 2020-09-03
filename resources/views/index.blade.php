@extends('layouts/layout')
@section('title','Ketogame | Inicio')
@section('content')
	<section class="banner-section" id="home-section">
        <div class="banner-carousel owl-theme owl-carousel">
            <!-- Slide Item -->
            <div class="slide-item">
            	<div class="image-layer" style="background-image:url(images/main-slider/1.jpg)"></div>

                <div class="auto-container">
                    <div class="content-box">
                        <h2>EL<br>TORNEO</h2>
                        <div class="btn-box"><a href="{{route('tournament.show')}}" class="theme-btn btn-style-one"><span class="btn-title">Me interesa</span></a></div>
                    </div>
                </div>
            </div>

            <!-- Slide Item -->
            <div class="slide-item">
            	<div class="image-layer" style="background-image:url(images/main-slider/2.jpg)"></div>
                <div class="auto-container">
                    <div class="content-box">
                        <h2>MAS <br> GRANDE</h2>
                        <div class="btn-box"><a href="{{route('tournament.show')}}" class="theme-btn btn-style-one"><span class="btn-title">Me interesa</span></a></div>
                    </div>
                </div>
            </div>

			<!-- Slide Item -->
            <div class="slide-item">
            	<div class="image-layer" style="background-image:url(images/main-slider/3.jpg)"></div>
                <div class="auto-container">
                    <div class="content-box">
                        <h2>DE <br> LATINOAMERICA</h2>
                        <div class="btn-box"><a href="{{route('tournament.show')}}" class="theme-btn btn-style-one"><span class="btn-title">Me interesa</span></a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- QUIEN SOY --}}
    <section class="welcome-section-two" id="about-me">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Title Column -->
                <div class="title-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInLeft" data-wow-delay="0ms">
                        <!-- Sec Title -->
                        <div class="sec-title">
                            <div class="title">Quien soy?</div>
                            <h2>IVÁN ALEJANDRO <br> Tercero</h2>
                        </div>
                        <div class="text text-justify" style="line-height: 1.5;">
                            Hola, mi nombre es Iván Alejandro, mejor conocido como "KetoGame", originario de Puebla, México, lider del equipo "Viciouz Esports". 
                            <br /><br />
                            Me dedico a la creación de contenido en Youtube, Facebook Y Twitch, soy organizador de eventos y mucho mas!. <br /><br />
                            Te doy la bienvenida a mi sitio web, en el cual podrás obtener muchos premios participando en los distintos torneos que estaré organizando, compite con una multitud de excelentes jugadores y prueba ser el mejor de ellos.
                        </div>
                        {{-- <a href="#" class="theme-btn btn-style-one"><span class="btn-title">Learn More</span></a> --}}
                    </div>
                </div>

                <!-- Image Column -->
                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInRight" data-wow-delay="0ms">
                        <div class="image">
                            <img src="{{ asset('images/background/who-am-i-bg.jpg') }}" alt="" />
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- LIVESTREAM --}}
    <section class="gallery-section" style="background-image:url(images/background/gaming-bg.jpg)" id="my-livestream">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title centered">
                <div class="title">Sigue mis</div>
                <h2>Directos</h2>
            </div>

            <div class="row clearfix">

                <!-- Column -->
                <div class="column col-lg-6 col-md-12 col-sm-12">

                    <!-- Gallery Block -->
                    <div class="gallery-block">
                        <div class="inner-box wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms" style="border: none;">
                            <div class="image hvr-bob">
                                <img src="{{ asset('images/background/fortnite-bg.png') }}" alt="" />
                                <div class="overlay-box">
                                    <div class="overlay-inner">
                                        <a href="https://www.youtube.com/watch?v=nfdjZg3imIc" class="lightbox-image play-box"><span class="flaticon-play-button"><i class="ripple"></i></span></a>
                                        <div class="content">
                                            <div class="title">Youtube</div>
                                            <h2><a href="https://www.youtube.com/watch?v=nfdjZg3imIc" class="lightbox-image">Fortnite <br> </a></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Column -->
                <div class="column col-lg-6 col-md-12 col-sm-12">

                    <!-- Gallery Block Two -->
                    <div class="gallery-block-two">
                        <div class="inner-box wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms" style="border: none;">
                            <div class="image hvr-bob">
                                <img src="{{ asset('images/background/minecraft-bg.png') }}" alt="" />
                                <div class="overlay-box">
                                    <a target="_blank" href="https://www.youtube.com/watch?v=itmbkVzPY6Y" class="overlay-link"></a>
                                    <h3><span class="icon flaticon-play-button"></span> Minecraft</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery Block Two -->
                    <div class="gallery-block-two">
                        <div class="inner-box wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms" style="border: none;">
                            <div class="image hvr-bob">
                                <img src="{{ asset('images/background/warzone-bg.png') }}" alt="" />
                                <div class="overlay-box">
                                    <a target="_blank" href="https://www.twitch.tv/ketoxgame" class="overlay-link"></a>
                                    <h3><span class="icon flaticon-play-button"></span> Warzone</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    {{-- LIVESTREAM --}}

    {{-- CHAMPIONS --}}
    @if($data->latest_tournaments->count())
        <section class="matches-section pt-4" style="background-color: #040404;" id="our-champions">
            <div class="auto-container pt-4">
                <!-- Sec Title -->
                <div class="sec-title centered">
                    <div class="title">Nuestros recientes</div>
                    <h2>Campeones</h2>
                </div>

                <div class="row clearfix d-flex justify-content-center">
                    {{-- LATEST CHAMPIONS --}}
                    @foreach($data->latest_tournaments as $tournament)
                        <div class="player-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="inner-box hvr-bob">
                                @php $picture_route = $tournament->champion->profile_picture ? 'storage/avatars/'.$tournament->champion->profile_picture : 'images/avatars/default-white.jpg' @endphp
                                <div class="image" style="background-image:url({{ asset($picture_route) }}); background-size: cover;">
                                    <a href="#"><img src="{{ asset('images/background/champions-bg-2.png') }}" alt="" /></a>
                                </div>
                                <div class="lower-content">
                                    <h3><a href="#">{{ $tournament->champion->name }}</a></h3>
                                    <div class="level">Campeon de: <strong>{{ $tournament->name }}</strong></div>
                                    {{-- <ul class="social-icons">
                                        <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                        <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                                        <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                                        <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                                    </ul> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- END LATES CHAMPIONS --}}
                </div>
            </div>
        </section>
    @endif
    {{-- END CHAMPIONS --}}

    {{-- CLOSEST TOURNAMENT --}}
    @if($data->tournament != null)
        <section class="matches-section pt-4">
            <div class="auto-container pt-4">
                <div class="sec-title centered">
                    <div class="title">Nuestro mas cercano</div>
                    <h2>Torneo</h2>
                </div>
                <!-- Matches Info Tabs-->
                <div class="matches-info-tabs">
                    <!-- Matches Tabs-->
                    <div class="matches-tabs tabs-box" style="border-top: 1px solid #2e2d2d;">
                        <!--Tabs Container-->
                        <div class="tabs-content">
                            <div class="tab active-tab" id="tournament-all">
                                <div class="content">
                                    {{-- SINGLE TOURNAMENT --}}
                                    <div class="matches-block">
                                        <div class="inner-block">
                                            <div class="row clearfix">
                                                {{-- TOURNAMENT INFO --}}
                                                <div class="content-column col-lg-7 col-md-12 col-sm-12">
                                                    <div class="inner-column">

                                                        {{-- <div class="title">Mira el Stream</div> --}}
                                                        <h2><a href="{{ route('tournament.show-all') }}" style="font-size: 35px;">{{ $data->tournament->name }}</a></h2>
                                                        <p>
                                                            {{ $data->tournament->description }}
                                                        </p>
                                                        <p class="pt-4">
                                                            {{ $data->tournament->total_participants }} participantes registrados de {{ $data->tournament->max_participants }}
                                                        </p>
                                                        <p class="pt-2">
                                                            <strong>@currency( $data->tournament->prize_pool )</strong> en premios
                                                        </p>
                                                        <div class="date">Fecha: {{ $data->tournament->start_date->format('d-m-Y') }} | {{ Carbon\Carbon::parse($data->tournament->start_date)->diffInDays(Carbon\Carbon::now()) }} dias restantes hasta el evento </div>
                                                    </div>
                                                </div>
                                                {{-- EXTRA INFO --}}
                                                <div class="match-column col-lg-5 col-md-12 col-sm-12">
                                                    <div class="inner-column">
                                                        <div class="row clearfix">
                                                            {{-- ITEM --}}
                                                            <div class="match-item col-lg-12 col-md-12 col-sm-12">
                                                                <div class="inner-item" style="padding-top: 5px;">
                                                                    <a href="{{ route('tournament.show-all') }}" class="tournament-register">
                                                                        <div class="icon-box-tournaments">
                                                                            <i class="fas fa-trophy"></i>
                                                                        </div><br>
                                                                        Ver todos los torneos
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    {{-- END TOURNAMENTS --}}

    {{-- CONTACT --}}
    <section class="contact-form-section style-two">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Title Column -->
                <div class="title-column col-lg-5 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInLeft" data-wow-delay="0ms">
                        <!-- Sec Title -->
                        <div class="sec-title">
                            <div class="title">Contáctame</div>
                            <h2>estamos para escucharte</h2>
                        </div>
                        <div class="text">Si tienes alguna duda, queja o sugerencia nos encantaria escucharla, envianos un mensaje y te responderemos lo mas pronto posible.</div>
                        {{-- <ul class="social-icons">
                            <li><a href="https://www.youtube.com/channel/UCabhMugHn0d5FybCw2XriTA" target="_blank"><span class="fab fa-youtube"></span></a></li>
                            <li><a href="https://www.facebook.com/ketogame666" target="_blank"><span class="fab fa-facebook-square"></span></a></li>
                            <li><a href="https://www.twitch.tv/ketoxgame" target="_blank"><span class="fab fa-twitch"></span></a></li>
                            <li><a href="https://twitter.com/ketogame666" target="_blank"><span class="fab fa-twitter"></span></a></li>
                            <li><a href="https://www.instagram.com/ketogame_oficial" target="_blank"><span class="fab fa-instagram"></span></a></li>
                        </ul> --}}
                    </div>
                </div>

                <!-- Form Column -->
                <div class="form-column col-lg-7 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInRight" data-wow-delay="0ms">

                        <!--Default Form-->
                        <div class="default-form contact-form">

                            <form method="POST" action="{{ route('message.send') }}">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-md-6 col-sm-12 form-group">
                                        <input type="text" name="name" placeholder="Nombre completo" value="{{ Auth::user() ? Auth::user()->FullName() : '' }}">
                                    </div>

                                    <div class="col-md-6 col-sm-12 form-group">
                                        <div class="newsletter-form">
                                            <div class="form-group clearfix">
                                                <input type="email" name="email" placeholder="Correo electronico" value="{{ Auth::user() ? Auth::user()->email : '' }}"><button disabled class="theme-btn newsletter-btn" style="cursor: text;"><span class="fas fa-envelope"></span></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 form-group">
                                        <textarea name="content" placeholder="Escribe un mensaje"></textarea>
                                    </div>

                                    <div class="col-md-12 col-sm-12 form-group">
                                        <button class="theme-btn btn-style-one" type="submit" name="submit-form"><span class="btn-title">Enviar mensaje</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- END CONTACT --}}

@endsection