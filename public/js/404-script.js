(function($) {

	//Hide Loading Box (Preloader)
	function handlePreloader() {
		if($('.preloader').length){
			$('body').addClass('page-loaded');
			$('.preloader').delay(1000).fadeOut(300);
		}
	}

	$(window).on('load', function() {
		handlePreloader();
	});

	var scene = document.getElementById('scene');
	var parallax = new Parallax(scene);

	$('.container').on('click', function() {
		$(location).attr('href', '/')
	});

})(window.jQuery);