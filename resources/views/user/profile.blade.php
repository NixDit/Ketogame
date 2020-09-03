@extends('layouts/layout')
@section('title','Ketogame | Mi perfil')
@section('content')
	<section class="page-banner" style="background-image:url({{ asset('images/background/banner-bg.jpg') }});">
	    <div class="auto-container">
	        <div class="inner-container clearfix">
	            <h1>Mi perfil</h1>
	        </div>
	    </div>
	</section>
    <section class="contact-form-section style-two" style="padding-top: 20px !important;">
        <div class="auto-container" id="scrollItem">
            <div class="row clearfix">
                <div class="form-column col-lg-7 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInRight" data-wow-delay="0ms">

                        <!--Default Form-->
                        <div class="default-form contact-form">

                            <form method="POST" action="{{ route('users.update') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group text-center" style="position: relative;" >
                                    <span class="img-div">
                                        <div class="text-center img-placeholder"  onClick="triggerClick()">
                                            <h4>Actualizar imagen</h4>
                                        </div>
                                        <img src="{{ Auth::user()->profile_picture ? asset('storage/avatars/' . Auth::user()->profile_picture) : asset('images/avatars/default-white.jpg')}}" onClick="triggerClick()" id="profileDisplay" class="profilePicture">
                                    </span>
                                    <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" name="profileImage" class="form-control" style="display: none;" accept="image/png, image/jpeg">
                                    <label>Foto de perfil</label>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-6 col-sm-12 form-group">
                                        <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                                        <input type="text" name="name" placeholder="Nombre(s)" value="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="col-md-6 col-sm-12 form-group">
                                        <input type="text" name="lastname" placeholder="Apellidos" value="{{ Auth::user()->lastname }}">
                                    </div>
                                    <div class="col-md-12 col-sm-12 form-group">
                                        <input type="text" name="email" placeholder="Email" value="{{ Auth::user()->email }}">
                                    </div>
                                    <div class="col-md-12 col-sm-12 form-group">
                                        <input type="text" name="epic_id" placeholder="Epic ID" value="{{ Auth::user()->epic ? Auth::user()->epic->name : '' }}">
                                    </div>
                                    <div class="col-md-12 col-sm-12 form-group">
                                        <select placeholder="País" name="country_id" id="country_id">
                                            <option value="">- País -</option>
                                            @foreach($countries as $key => $country)
                                                <option value="{{ $country->id }}" {{ Auth::user()->country_id == $country->id ? 'selected' : '' }}>{{ $country->nicename }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 col-sm-12 form-group">
                                        <input type="tel" name="mobile" placeholder="Telefono" value="{{ Auth::user()->mobile }}">
                                    </div>
                                    <div class="col-md-12 col-sm-12 form-group d-flex justify-content-center">
                                        <button class="theme-btn btn-style-one" type="submit"><span class="btn-title">Actualizar datos</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                {{-- PAGE INFORMATION --}}
                <div class="title-column col-lg-5 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInLeft" data-wow-delay="0ms" style="padding-top: 230px; padding-left: 10px;">
                        <!-- Sec Title -->
                        @if(Auth::user()->epic)
                            <div class="sec-title d-flex align-items-center">
                                <div class="title stats-title">Estadisticas</div>
                                <div class="update-stats"><button class=" btn-style-one" id="update-stats" data-epic="{{ Auth::user()->epic->name }}" data-user="{{ Auth::user()->id }}"><span class="btn-title" style="font-size: 10px; padding: 0px 5px">Actualizar</span></button></div>
                                <input type="hidden" id="user_id" value="{{ Auth::user()->id }}">
                            </div>
                            <div class="question-block-two">
                                <div class="inner-box">
                                    <div class="icon-box-solo">
                                    </div>
                                    <h3><a href="#" class="padding-stats">Solitario</a></h3>
                                    <b class="padding-stats">Victorias: {{ Auth::user()->epic->solo_victory }}</b>
                                    <b class="padding-stats">Partidas: {{ Auth::user()->epic->solo_matches }}</b>
                                    <b class="padding-stats">Kills: {{ Auth::user()->epic->solo_kills }}</b>
                                </div>
                            </div>
                            <div class="question-block-two">
                                <div class="inner-box">
                                    <div class="icon-box-duo">
                                    </div>
                                    <h3><a href="#" class="padding-stats">Duo</a></h3>
                                    <b class="padding-stats">Victorias: {{ Auth::user()->epic->duo_victory }}</b>
                                    <b class="padding-stats">Partidas: {{ Auth::user()->epic->duo_matches }}</b>
                                    <b class="padding-stats">Kills: {{ Auth::user()->epic->duo_kills }}</b>
                                </div>
                            </div>
                            <div class="question-block-two">
                                <div class="inner-box">
                                    <div class="icon-box-squad">
                                    </div>
                                    <h3><a href="#" class="padding-stats">Escuadron</a></h3>
                                    <b class="padding-stats">Victorias: {{ Auth::user()->epic->squad_victory }}</b>
                                    <b class="padding-stats">Partidas: {{ Auth::user()->epic->squad_matches }}</b>
                                    <b class="padding-stats">Kills: {{ Auth::user()->epic->squad_kills }}</b>
                                </div>
                            </div>
                        @else
                            <div class="inner-column wow fadeInLeft" data-wow-delay="0ms">
                                <!-- Sec Title -->
                                <div class="sec-title">
                                    <div class="title">{{ Auth::user()->name }} vincula tu Epic ID para revisar tus</div>
                                    <h2>Estadisticas</h2>
                                </div>
                                <div class="text">Al vincular tu Epic ID nosotros podremos ofrecerte las estadisticas basicas que has tenido a lo largo de la temporada actual de Fortnite, de esta manera podras conocer tu desempeño sin la necesidad de revisar directamente en el juego, no te preocupes esto no afecta a la seguridad o integradad de tu cuenta.</div>
                                <ul class="social-icons">
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function triggerClick(e) {
            document.querySelector('#profileImage').click();
        }
        function displayImage(e) {
            if (e.files[0]) {
                if (e.files[0].type.match('image.*')) {
                    var reader = new FileReader();
                    reader.onload = function(e){
                        document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
                    }
                    reader.readAsDataURL(e.files[0]);
                }
          }
        }
    </script>
@endsection
@section('scripts')
    <script src="{{ asset('js/profile-script.js') }}"></script>
@endsection