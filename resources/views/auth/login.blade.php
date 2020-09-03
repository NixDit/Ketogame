@extends('layouts.auth_layout')
@section('title','Ketogame | login')
@section('content')
<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100" id="content-div">
			{{-- LOGIN --}}
			<form method="POST" action="{{ route('login') }}" class="login100-form validate-form" id="content-div">
				@csrf
				<span class="login100-form-title p-b-43">
					Iniciar Sesion
				</span>

				<div class="wrap-input100 validate-input" >
					<input id="email" placeholder="Email" type="email" class="input100 @error('email') is-invalid @enderror"  name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
					<span class="focus-input100"></span>
					<span class="label-input100"></span>
					@error('email')
						<span class="invalid_feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="wrap-input100 validate-input" data-validate="Password is required">
					<input id="password" placeholder="Password" type="password" class="input100 @error('password') is-invalid @enderror"  name="password" autocomplete="current-password">
					<span class="focus-input100"></span>
					<span class="label-input100"></span>
					@error('password')
                        <span class="invalid_feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
				</div>
				<div class="flex-sb-m w-full p-t-3 p-b-32">
					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
						<label class="label-checkbox100" for="remember">
							Recuerdame
						</label>
					</div>
					<div>
						@if (Route::has('password.request'))
                            <a class="txt1" href="{{ route('password.request') }}">
                                Olvide mi contraseña
                            </a>
                        @endif
					</div>
				</div>
				<div class="container-login100-form-btn">
					<div class="content-box">
                        <div class="btn-box">
							<button class="theme-btn btn-style-one" type="submit">
								<span class="btn-title">Ingresar</span>
							</button>
                        </div>
                    </div>
				</div>
				<div class="text-center p-t-46 p-b-20">
					<span class="txt2">
						<a class="txt1" href="{{ route('register') }}">
                            o registrate
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