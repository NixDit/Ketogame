(function($) {

	"use strict";

	//Hide Loading Box (Preloader)
	function handlePreloader() {
		if($('.preloader').length){
			$('body').addClass('page-loaded');
			$('.preloader').delay(1000).fadeOut(300);
		}
	}

	//Update Header Style and Scroll to Top
	function headerStyle() {
		if($('.main-header').length){
			var windowpos = $(window).scrollTop();
			var siteHeader = $('.main-header');
			var scrollLink = $('.scroll-to-top');
			var sticky_header = $('.main-header .sticky-header');
			if (windowpos > 100) {
				siteHeader.addClass('fixed-header');
				sticky_header.addClass("animated slideInDown");
				scrollLink.fadeIn(300);
			} else {
				siteHeader.removeClass('fixed-header');
				sticky_header.removeClass("animated slideInDown");
				scrollLink.fadeOut(300);
			}
		}
	}

	headerStyle();

	//Submenu Dropdown Toggle
	if($('.main-header li.dropdown ul').length){
		$('.main-header .navigation li.dropdown').append('<div class="dropdown-btn"><span class="fa fa-angle-right"></span></div>');

	}

	//Mobile Nav Hide Show
	if($('.mobile-menu').length){

		$('.mobile-menu .menu-box').mCustomScrollbar();

		var mobileMenuContent = $('.main-header .nav-outer .main-menu').html();
		$('.mobile-menu .menu-box .menu-outer').append(mobileMenuContent);
		$('.sticky-header .main-menu').append(mobileMenuContent);

		//Dropdown Button
		$('.mobile-menu li.dropdown .dropdown-btn').on('click', function() {
			$(this).toggleClass('open');
			$(this).prev('ul').slideToggle(500);
		});
		//Menu Toggle Btn
		$('.mobile-nav-toggler').on('click', function() {
			$('body').addClass('mobile-menu-visible');
		});

		//Menu Toggle Btn
		$('.mobile-menu .menu-backdrop,.mobile-menu .close-btn').on('click', function() {
			$('body').removeClass('mobile-menu-visible');
		});
	}

	if ($('.banner-carousel').length) {
		$('.banner-carousel').owlCarousel({
			loop:true,
			margin:0,
			nav:true,
			smartSpeed: 500,
			autoplay: 6000,
			navText: [ '<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:1
				},
				1024:{
					items:1
				}
			}
		});
	}


	//Single Item Carousel
	if ($('.single-item-carousel').length) {
		$('.single-item-carousel').owlCarousel({
			loop:true,
			margin:0,
			nav:true,
			smartSpeed: 500,
			autoplay: 5000,
			navText: [ '<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:1
				},
				1024:{
					items:1
				}
			}
		});
	}


	// Sponsors Carousel
	if ($('.sponsors-carousel').length) {
		$('.sponsors-carousel').owlCarousel({
			loop:true,
			margin:40,
			nav:true,
			smartSpeed: 500,
			autoplay: 4000,
			navText: [ '<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:2
				},
				600:{
					items:3
				},
				800:{
					items:4
				},
				1024:{
					items:5
				}
			}
		});
	}

	// Awards Carousel
	if ($('.awards-carousel').length) {
		$('.awards-carousel').owlCarousel({
			loop:true,
			margin:40,
			nav:true,
			smartSpeed: 500,
			autoplay: 4000,
			navText: [ '<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:2
				},
				480:{
					items:2
				},
				600:{
					items:3
				},
				800:{
					items:4
				},
				1024:{
					items:5
				}
			}
		});
	}


	//Tabs Box
	if($('.tabs-box').length){
		$('.tabs-box .tab-buttons .tab-btn').on('click', function(e) {
			e.preventDefault();
			var target = $($(this).attr('data-tab'));

			if ($(target).is(':visible')){
				return false;
			}else{
				target.parents('.tabs-box').find('.tab-buttons').find('.tab-btn').removeClass('active-btn');
				$(this).addClass('active-btn');
				target.parents('.tabs-box').find('.tabs-content').find('.tab').fadeOut(0);
				target.parents('.tabs-box').find('.tabs-content').find('.tab').removeClass('active-tab');
				$(target).fadeIn(300);
				$(target).addClass('active-tab');
			}
		});
	}


	//Gallery Filters
	 if($('.filter-list').length){
	 	 $('.filter-list').mixItUp({});
	 }

	//LightBox / Fancybox
	if($('.lightbox-image').length) {
		$('.lightbox-image').fancybox({
			openEffect  : 'fade',
			closeEffect : 'fade',
			helpers : {
				media : {}
			}
		});
	}

	//Contact Form Validation
	if($('#contact-form').length){
		$('#contact-form').validate({
			rules: {
				username: {
					required: true
				},
				email: {
					required: true,
					email: true
				},
				message: {
					required: true
				}
			}
		});
	}

	// Scroll to a Specific Div
	if($('.scroll-to-target').length){
		$(".scroll-to-target").on('click', function() {
			var target = $(this).attr('data-target');
		   // animate
		   $('html, body').animate({
			   scrollTop: $(target).offset().top
			 }, 1500);

		});
	}

	// Elements Animation
	if($('.wow').length){
		var wow = new WOW(
		  {
			boxClass:     'wow',      // animated element css class (default is wow)
			animateClass: 'animated', // animation css class (default is animated)
			offset:       0,          // distance to the element when triggering the animation (default is 0)
			mobile:       false,       // trigger animations on mobile devices (default is true)
			live:         true       // act on asynchronously loaded content (default is true)
		  }
		);
		wow.init();
	}


/* ==========================================================================
   When document is Scrollig, do
   ========================================================================== */

	$(window).on('scroll', function() {
		headerStyle();
	});

/* ==========================================================================
   When document is loading, do
   ========================================================================== */

	$(window).on('load', function() {
		handlePreloader();
		scrollOnLogin();
	});

	function scrollOnLogin(){
		if(window.location.pathname == "/register"){
			$('#register-form').css('padding-top', '80px');
			$('#register-form').css('padding-right', '60');
			$('#register-form').css('padding-bootom', '80px');
			$('#register-form').css('padding-left', '60px');
			$('html, body').animate({scrollTop: '150px'}, 800);
		}else if(window.location.pathname == "/login"){
			$('html, body').animate({scrollTop: '150px'}, 800);
		}else if(window.location.pathname == "/myprofile"){
			$('html, body').animate({scrollTop: '420px'}, 800);
			// updateFortniteStats();
		}
	}

	$( "#update-stats" ).click(function() {
		showLoading(true);
		let epic_id = $(this).data('epic');
		let user 	= $(this).data('user');
		var settings = {
			"async": true,
			"crossDomain": true,
			"url": "https://fortnite-api.p.rapidapi.com/stats/" + epic_id,
			"method": "GET",
			"headers": {
				"x-rapidapi-host": "fortnite-api.p.rapidapi.com",
				"x-rapidapi-key": "69fcd3ec5amsh373352f57ad49c8p15e19ajsn44df53dcc832"
			}
		}

		$.ajax(settings).done(function (response) {
			if(response.error){
				swal("Oh algo salio mal", "El epic id que has registrado no corresponde a ninguno en fortnite", "error");
			}else{
				console.log(response);
				let formData = new FormData();
				formData.append('user_id', user)
				formData.append('name', epic_id);
				formData.append('solo_victory', response.season.all.defaultsolo.placetop1);
				formData.append('solo_matches', response.season.all.defaultsolo.matchesplayed);
				formData.append('solo_kills', response.season.all.defaultsolo.kills);
				formData.append('duo_victory', response.season.all.defaultduo.placetop1);
				formData.append('duo_matches', response.season.all.defaultduo.matchesplayed);
				formData.append('duo_kills', response.season.all.defaultduo.kills);
				formData.append('squad_victory', response.season.all.defaultsquad.placetop1);
				formData.append('squad_matches', response.season.all.defaultsquad.matchesplayed);
				formData.append('squad_kills', response.season.all.defaultsquad.kills);

				$.ajaxSetup({
				    headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    }
				})
				$.ajax({
					url: 'updatestats',
					data: formData,
					dataType: 'json',
					contentType: false,
					processData: false,
					type: 'POST',
					complete: function(){
						showLoading(false);
					}
				}).done(function(response){
					return response.error ? swal("Error!", response.message , "error") : swal("Actualizado!", response.message , "success");
				});
				// setTimeout(function(){
				// 	location.reload();
				// }, 3000);
			}
		});
	});

	function showLoading(choice){
		if(choice){
			$('.preloader').css('display', 'block');
			$('.preloader').css('background-color', 'rgba(0,0,0,.5)');
			$('.icon').css('opacity', '1');

		}else{
			$('.preloader').css('display', 'none');
			$('.preloader').css('background-color', 'rgba(0,0,0,0)');
			$('.icon').css('opacity', '1');
		}
	}
	$(document).ready(function() {
	    $('.select2').select2();
	});
})(window.jQuery);