@extends('layouts/layout')
@section('title','Ketogame | Torneos')
@section('content')
	<!-- Matches Section -->
	<section class="matches-section">
		<div class="auto-container">

			<!-- Matches Info Tabs-->
			<div class="matches-info-tabs">
				<!-- Matches Tabs-->
				<div class="matches-tabs tabs-box">

					<!--Tab Btns-->
					<ul class="tab-btns tab-buttons clearfix">
						<li data-tab="#tournament-all" class="tab-btn active-btn"><span>Todos los torneos</span></li>
						<li data-tab="#signedup-tournaments" class="tab-btn"><span>Torneos a los que estoy inscrito</span></li>
					</ul>

					<!--Tabs Container-->
					<div class="tabs-content">
						<div class="tab active-tab" id="tournament-all">
							<div class="content">
								{{-- SINGLE TOURNAMENT --}}
								@forelse($data->tournaments as $tournament)
									<div class="matches-block">
										<div class="inner-block">
											<div class="row clearfix">
												{{-- TOURNAMENT INFO --}}
												<div class="content-column col-lg-7 col-md-12 col-sm-12">
													<div class="inner-column">

														{{-- <div class="title">Mira el Stream</div> --}}
														<h2><a href="https://twitch.tv/ketoxgame" target="_blank" style="font-size: 35px;">{{ $tournament->name }}</a></h2>
														<p>
															{{ $tournament->description }}
														</p>
														<p class="pt-4">
															{{ $tournament->total_participants }} participantes registrados de {{ $tournament->max_participants }}
														</p>
														<p class="pt-2">
															<strong>@currency( $tournament->prize_pool )</strong> en premios
														</p>
														<div class="date">Fecha: {{ $tournament->start_date->format('d-m-Y') }} | {{ Carbon\Carbon::parse($tournament->start_date)->diffInDays(Carbon\Carbon::now()) }} dias restantes hasta el evento </div>
													</div>
												</div>
												{{-- EXTRA INFO --}}
												<div class="match-column col-lg-5 col-md-12 col-sm-12">
													<div class="inner-column">
														<div class="row clearfix">
															{{-- ITEM --}}
															<div class="match-item col-lg-12 col-md-12 col-sm-12">
																<div class="inner-item" style="padding-top: 5px;">
																	@auth
																		<a href="#" class="{{-- {{ $tournament->total_participants < $tournament->max_participants ? '' : 'btn disabled'}} --}} tournament-register" data-user="{{ Auth::user()->id }}" data-tournament="{{ $tournament->id }}">
																			<div class="icon-box-tournaments">
																				<i class="fas fa-trophy"></i>
																			</div><br>
																			@if(Auth::user()->tournaments()->where('tournament_id', $tournament->id)->first())
																				Subir o cambiar mis archivos <br>
																				<small>{{ $tournament->percentage  }}% del registro completado</small>
																			@else
																				@if($tournament->total_participants < $tournament->max_participants)
																					Registrarme al torneo
																				@else
																					El torneo alcanzo el limite de jugadores permitidos
																				@endif
																			@endif
																		</a>
																	@else
																		<a href="{{ route('tournament.send-to-login') }}" class="tournament-register-login">
																			<div class="icon-box-tournaments">
																				<i class="fas fa-trophy"></i>
																			</div><br>
																			Inicia sesion para registrarte
																		</a>
																	@endauth
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								@empty
									<div class="matches-block">
										<div class="inner-block">
											<div class="row clearfix">
												{{-- TOURNAMENT INFO --}}
												<div class="content-column col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
													<div class="inner-column text-center">
														<h2 class="pb-3">The princess is in another castle</h2>
														<p>
															Lo sentimos por ahora no hay torneos activos a los cuales puedas inscribirte, vuelve despues, tal vez tengamos algo para ti...
														</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								@endforelse
							</div>
						</div>
						<div class="tab" id="signedup-tournaments">
							<div class="content">
								@auth
									@forelse($data->my_tournaments as $tournament)
										<div class="matches-block">
											<div class="inner-block">
												<div class="row clearfix">
													{{-- TOURNAMENT INFO --}}
													<div class="content-column col-lg-7 col-md-12 col-sm-12">
														<div class="inner-column">

															{{-- <div class="title">Mira el Stream</div> --}}
															<h2><a href="https://twitch.tv/ketoxgame" target="_blank" style="font-size: 35px;">{{ $tournament->name }}</a></h2>
															<p>
																{{ $tournament->description }}
															</p>
															<p class="pt-4">
																{{ $tournament->total_participants }} participantes registrados de {{ $tournament->max_participants }}
															</p>
															<p class="pt-2">
																<strong>@currency( $tournament->prize_pool )</strong> en premios
															</p>
															<div class="date">Fecha: {{ $tournament->start_date->format('d-m-Y') }} | {{ Carbon\Carbon::parse($tournament->start_date)->diffInDays(Carbon\Carbon::now()) }} dias restantes hasta el evento </div>
														</div>
													</div>
													{{-- EXTRA INFO --}}
													<div class="match-column col-lg-5 col-md-12 col-sm-12">
														<div class="inner-column">
															<div class="row clearfix">
																{{-- ITEM --}}
																<div class="match-item col-lg-12 col-md-12 col-sm-12">
																	<div class="inner-item" style="padding-top: 5px;">
																		{{-- @auth --}}
																			<a href="#" class="tournament-register" data-user="{{ Auth::user()->id }}" data-tournament="{{ $tournament->id }}">
																				<div class="icon-box-tournaments-signedup">
																					<i class="fas fa-trophy"></i>
																					<i class="fas fa-check"></i>
																				</div><br>
																				Subir o cambiar mis archivos <br>
																				<small>{{ $tournament->percentage  }}% del registro completado</small>
																			</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									@empty
										<div class="matches-block">
											<div class="inner-block">
												<div class="row clearfix">
													{{-- TOURNAMENT INFO --}}
													<div class="content-column col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
														<div class="inner-column text-center">
															<h2 class="pb-3">To be continued</h2>
															<p>
																Aun no te has inscrito a ningun torneo...
															</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									@endforelse
								@else
									<div class="matches-block">
										<div class="inner-block">
											<div class="row clearfix">
												{{-- TOURNAMENT INFO --}}
												<div class="content-column col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
													<div class="inner-column text-center">
														<h2 ><a href="{{ route('tournament.send-to-login') }}" style="font-size: 35px;">Game Over</a></h2>
														<p>
															Oh oh parece ser que no has iniciado sesion, vamos gamer hazlo de una vez, necesitas hacerlo para poder mostrarte los torneos a los que estas inscrito, te estare esperando...
														</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								@endauth
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Matches Section -->
@endsection
<div class="modal fade" id="user-printscreen-modal" tabindex="-1" role="dialog" aria-labelledby="userPrintScreenModal" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" style="background-color: #0b0c0c;">
			<div class="modal-header btm-grey">
				<h5 class="modal-title" style="color: #b5b5b5;">Completa tu registro</h5>
				<button type="button" class="close"  id="header_close_btn" data-dismiss="modal" aria-label="Close" style="color: #fff;">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="container">
			    <div class="socialmedia-pictures {{-- dl-lg-flex  --}} {{-- d-md-flex --}} d-sm-block justify-content-center">
			    	<div class="{{-- d-flex --}} dl-lg-flex  d-md-flex d-sm-block">
				    	<div class="avatar-upload printscreen-upload">
					        <div class="avatar-edit">
					            <input type='file' class="imageUpload" id="image_Youtube" name="image_Youtube" data-check="yt" data-socialmedia="YT" data-pluck="1" accept=".png, .jpg, .jpeg" />
					            <label for="image_Youtube"></label>
					        </div>
					        <div class="avatar-preview">
					            <div id="image_preview_YT" style="background-image: url({{asset('images/icons/yt-icon.png')}});">
					            </div>
					        </div>
					        <div class="pt-2 pr-2"><h4 class="text-center"><a href="https://www.youtube.com/channel/UCabhMugHn0d5FybCw2XriTA" target="_blank" style="font-size: 1.4rem;">Youtube </a> <small><i class="fas fa-check text-primary check-yt d-none " ></i></small></h4></div>
					    </div>
					    <div class="avatar-upload printscreen-upload">
					        <div class="avatar-edit">
					            <input type='file' class="imageUpload" id="image_Facebook" name="image_Facebook" data-check="fb" data-socialmedia="FB" data-pluck="2" accept=".png, .jpg, .jpeg" />
					            <label for="image_Facebook"></label>
					        </div>
					        <div class="avatar-preview">
					            <div id="image_preview_FB" style="background-image: url({{asset('images/icons/fb-icon.png')}});">
					            </div>
					        </div>
					        <div class="pt-2 pr-2"><h4 class="text-center"><a href="https://www.facebook.com/ketogame666" target="_blank" style="font-size: 1.4rem;">Facebook</a> <small><i class="fas fa-check text-primary check-fb d-none"></i></small></h4></div>
					    </div>
					</div>
					<div class="dl-lg-flex  d-md-flex d-sm-block justify-content-center">
					    <div class="avatar-upload printscreen-upload">
					        <div class="avatar-edit">
					            <input type='file' class="imageUpload" id="image_Twitch" name="image_Twitch" data-check="twitch" data-socialmedia="Twitch" data-pluck="3" accept=".png, .jpg, .jpeg" />
					            <label for="image_Twitch"></label>
					        </div>
					        <div class="avatar-preview">
					            <div id="image_preview_Twitch" style="background-image: url({{asset('images/icons/twitch-icon.png')}});">
					            </div>
					        </div>
					        <div class="pt-2 pr-2"><h4 class="text-center"><a href="https://www.twitch.tv/ketoxgame" target="_blank" style="font-size: 1.4rem;">Twitch </a> <small><i class="fas fa-check text-primary check-twitch d-none"></i></small></h4></div>
					    </div>
				    </div>
					<div class="{{-- d-flex --}} dl-lg-flex  d-md-flex d-sm-block">
					    <div class="avatar-upload printscreen-upload">
					        <div class="avatar-edit">
					            <input type='file' class="imageUpload" id="image_Instagram" name="image_Instagram" data-check="instagram" data-socialmedia="Instagram" data-pluck="4" accept=".png, .jpg, .jpeg" />
					            <label for="image_Instagram"></label>
					        </div>
					        <div class="avatar-preview">
					            <div id="image_preview_Instagram" style="background-image: url({{asset('images/icons/instagram-icon.png')}});">
					            </div>
					        </div>
					        <div class="pt-2 pr-2"><h4 class="text-center"><a href="https://www.instagram.com/ketogame_oficial" target="_blank" style="font-size: 1.4rem;">Instagram </a> <small><i class="fas fa-check text-primary check-instagram d-none"></i></small></h4></div>
					    </div>
					    <div class="avatar-upload printscreen-upload">
					        <div class="avatar-edit">
					            <input type='file' class="imageUpload" id="image_Twitter" name="image_Twitch" data-check="twitter" data-socialmedia="Twitter" data-pluck="5" accept=".png, .jpg, .jpeg" />
					            <label for="image_Twitter"></label>
					        </div>
					        <div class="avatar-preview">
					            <div id="image_preview_Twitter" style="background-image: url({{asset('images/icons/twitter-icon.png')}});">
					            </div>
					        </div>
					        <div class="pt-2 pr-2"><h4 class="text-center"><a href="https://twitter.com/ketogame666" target="_blank" style="font-size: 1.4rem;">Twitter </a> <small><i class="fas fa-check text-primary check-twitter d-none"></i></small></h4></div>
					    </div>
				    </div>
			    </div>
			</div>
			<div class="p-4"><p><small><b>*Este torneo es completamente gratuito, seguirme en mis diferentes redes sociales es el unico requisito para estar registrado. <br>*Desmuestra que eres seguidor subiendo las capturas de pantalla correspondientes. <br>*El administrador de la pagina se encargara de verificar que los archivos sean legitimos.</b></small></p></div>
			<div class="modal-footer">
				<button class="theme-btn btn-style-one tiny-btn" id="close_modal" style="line-height: 15px; font-size: 15px;">
					<span class="btn-title tiny-btn-title" style="padding: 18px 20px;" data-dismiss="modal">Listo</span>
				</button>
{{-- 				<button class="theme-btn btn-style-one tiny-btn d-none" id="ready_button" style="line-height: 15px; font-size: 15px;">
					<span class="btn-title tiny-btn-title" style="padding: 18px 25px;">Listo</span> --}}
				</button>
				<input type="hidden" id="hidden_user_id" name="hidden_user_id">
				<input type="hidden" id="hidden_tournament_id" name="hidden_tournament_id">
				<input type="hidden" id="has-changed" value="0">
			</div>
		</div>
	</div>
</div>
@section('scripts')
	<script src="{{ asset('js/tournament-script.js') }}"></script>
@endsection
