@extends('layouts.auth_layout')
@section('title',' Ketogame | registro')
@section('content')
<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100">
			<form method="POST" action="{{ route('register') }}" class="login100-form validate-form" id="register-form">
				@csrf
				<div id="content-div"></div>
				<span class="login100-form-title p-b-43">
					Registrarse
                </span>
                {{-- NOMBRE --}}
                <div class="wrap-input100 validate-input" >
					<input id="name" placeholder="Nombre(s)" type="text" class="input100"  name="name" value="{{ old('name') }}" autocomplete="off" autofocus>
					<span class="focus-input100"></span>
					<span class="label-input100"></span>
					@error('name')
						<span class="invalid_feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
                </div>
                {{-- APELLIDOS --}}
                <div class="wrap-input100 validate-input" >
					<input id="lastname" placeholder="Apellido(s)" type="text" class="input100"  name="lastname" value="{{ old('lastname') }}" autocomplete="off" autofocus>
					<span class="focus-input100"></span>
					<span class="label-input100"></span>
					@error('lastname')
						<span class="invalid_feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
                </div>
                {{-- EMAIL --}}
				<div class="wrap-input100 validate-input" >
					<input id="email" placeholder="Email" type="email" name="email" value="{{ old('email') }}" class="input100" autocomplete="email" autofocus>
					<span class="focus-input100"></span>
					<span class="label-input100"></span>
					@error('email')
						<span class="invalid_feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
                </div>
                {{-- CONTRASEÑA --}}
				<div class="wrap-input100 validate-input" data-validate="Password is required">
					<input id="password" placeholder="Contraseña" value="{{ old('password') }}"type="password" class="input100"  name="password" autocomplete="current-password">
					<span class="focus-input100"></span>
					<span class="label-input100"></span>
					@error('password')
                        <span class="invalid_feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
				</div>
                {{-- TELEFONO --}}
				<div class="wrap-input100 validate-input" >
					<input id="mobile" placeholder="Teléfono" maxlength="10" type="tel" class="input100"  name="mobile" value="{{ old('mobile') }}" autocomplete="off" autofocus>
					<span class="focus-input100"></span>
					<span class="label-input100"></span>
					@error('mobile')
						<span class="invalid_feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
                {{-- PAÍS --}}
				<div class="wrap-input100 validate-input" >
					<select data-placeholder="País" style="height: 45px;" class="input100 select2" name="country_id" id="country_id" autofocus>
						<option value=""></option>
						@foreach($countries as $key => $country)
							<option value="{{ $country->id }}" {{ (old('country_id') == $country->id) ? 'selected' : '' }}>{{ $country->nicename }}</option>
						@endforeach
                    </select>
					<span class="focus-input100"></span>
					<span class="label-input100"></span>
					@error('country_id')
						<span class="invalid_feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
                </div>
                {{-- SUBMIT --}}
				<div class="container-login100-form-btn pt-5">
					<div class="content-box">
                        <div class="btn-box">
							<button class="theme-btn btn-style-one" type="submit">
								<span class="btn-title">Registrarse</span>
							</button>
                        </div>
                    </div>
				</div>
				<div class="text-center p-t-46 p-b-20">
					<span class="txt2">
						<a class="txt1" href="{{ route('login') }}">
                            o si ya estas registrado inicia sesión aquí
                        </a>
					</span>
				</div>
			</form>
			<div class="login100-more" style="background-image: url('images/background/bg-login.jpg');">
			</div>
		</div>
	</div>
</div>
@endsection
