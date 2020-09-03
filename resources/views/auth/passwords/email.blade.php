@include('layouts.header')
@include('layouts.navbar_2')
@section('title',' Ketogame | Reestablecer password')
<section class="contact-form-section style-two">
	<div class="auto-container" id="scrollItem">
		<div class="row-clearfix">
			<div class="form-column col-lg-12 col-md-12 col-sm-12">
				<div class="inner-column wow fadeInRight" data-wow-delay="0ms">
					{{-- FORM --}}
					<div class="default-form contact-form">
						<form method="POST" action="{{ route('password.email') }}">
							@csrf
							<div class="row clearfix justify-content-center">
								<div class="col-8 form-group">
									<div class="pb-4">
										@if(session('status'))
											{{ session('status') }}
										@endif
									</div>
									<input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email"></input>
									@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="col-md-12 col-sm-12 form-group d-flex justify-content-center">
                                    <button class="theme-btn btn-style-one" type="submit"><span class="btn-title">Enviar enlace al correo</span></button>
                                </div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@include('layouts.footer')
@include('layouts.page_foot')

