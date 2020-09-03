@extends('layouts/layout')
@section('title','Ketogame | Torneo')
@section('content')
	{{-- INFORMACION DEL TORNEO --}}
	<section class="player-info-section">
		<div class="auto-container">
			<div class="row clearfix">
            	<!--Text Column-->
                <div class="text-column col-lg-6 col-md-6 col-sm-12">
                	<div class="inner wow fadeInRight">
                    	<div class="title-box">
                        	<div class="user-title">{{ @$tournaments->name ?? ''}}</div>
                            <div class="user-info"> <strong>@currency(@$tournaments->prize_pool ?? 0)</strong> en juego.</div>
                        </div>
                        <div class="text">{{ $tournaments->description ?? '' }}.</div>
                        <div class="col-md-12 col-sm-12 form-group p-0">
							@auth
								<a href="{{ route('tournament.show-all') }}" class="theme-btn btn-style-one"><span class="btn-title">Registrarse al torneo</span></a>
							@else
                            	<a href="{{ route('login') }}" class="theme-btn btn-style-one"><span class="btn-title">Iniciar sesión</span></a>
							@endguest
                        </div>
                        <ul class="social-icons">
						</ul>
                    </div>
                </div>
                <!--Image Column-->
                <div class="image-column col-lg-6 col-md-6 col-sm-12">
                	<div class="inner wow fadeInLeft">
                    	<figure class="image"><img src="images/resource/about-4.jpg" alt=""></figure>
                    </div>
                </div>
            </div>
		</div>
	</section>
@endsection