(function($) {
	//AJAX TO SIGN USER TO THE TOURNAMENT
	$( ".tournament-register" ).click(function(e) {
		e.preventDefault();
		showLoading(true);
		let formData 		= new FormData();
		let user_id 		= $(this).data('user');
		let tournament_id 	= $(this).data('tournament');
		formData.append('user_id', user_id);
		formData.append('tournament_id', tournament_id);
		//AJAX BEGINS
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		})
		$.ajax({
			url: 'tournaments-sign-me',
			data: formData,
			dataType: 'json',
			contentType: false,
			processData: false,
			type: 'POST',
			complete: function(){
				showLoading(false);
			}
		}).done(function(response){
			if(response.error){
				return swal("Error!", response.message , response.type);
			}else if(response.type == "info"){
				return swal("Torneo cerrado!", response.message , response.type);
			}else{
				$('#hidden_user_id').val(user_id);
				$('#hidden_tournament_id').val(tournament_id);

				if(response.picture_1){
					$('#image_preview_YT').css('background-image', `url(../storage/print-screens/${response.picture_1})`);
					$('.check-yt').removeClass('d-none');
				}

				if(response.picture_2){
					$('#image_preview_FB').css('background-image', `url(../storage/print-screens/${response.picture_2})`);
					$('.check-fb').removeClass('d-none');
				}

				if(response.picture_3){
					$('#image_preview_Twitch').css('background-image', `url(../storage/print-screens/${response.picture_3})`);
					$('.check-twitch').removeClass('d-none');
				}
				if(response.picture_4){
					$('#image_preview_Instagram').css('background-image', `url(../storage/print-screens/${response.picture_4})`);
					$('.check-instagram').removeClass('d-none');
				}
				if(response.picture_5){
					$('#image_preview_Twitter').css('background-image', `url(../storage/print-screens/${response.picture_5})`);
					$('.check-twitter').removeClass('d-none');
				}
				showModal();
				return swal("Correcto!", response.message , response.type, {timer: 3500});
			}
		});
	});

	function showModal(){
		setTimeout(function(){
			$('#user-printscreen-modal').modal('toggle');
		}, 3400);
	}

	//SEND PRINTSCREENS TO CONTROLLER
	$( "#send_images" ).click(function() {
		showLoading(true);
		var formData 		= new FormData();
		var picture_1 		= $('#image_Youtube').prop('files')[0];
		var picture_2		= $('#image_Facebook').prop('files')[0];
		var picture_3		= $('#image_Twitch').prop('files')[0];
		var picture_4		= $('#image_Instagram').prop('files')[0];
		var picture_5		= $('#image_Twitter').prop('files')[0];
		var user_id 		= $('#hidden_user_id').val();
		var tournament_id 	= $('#hidden_tournament_id').val();

		formData.append('user_id', user_id);
		formData.append('tournament_id', tournament_id);
		formData.append('picture_1', picture_1);
		formData.append('picture_2', picture_2);
		formData.append('picture_3', picture_3);
		formData.append('picture_4', picture_4);
		formData.append('picture_5', picture_5);

		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		})
		$.ajax({
			url: 'tournaments-send-images',
			data: formData,
			dataType: 'json',
			contentType: false,
			processData: false,
			type: 'POST',
			complete: function(){
				showLoading(false);
			}
		}).done(function(response){
			return response.error ? swal("Error!", response.message , "error") : swal("Imagenes subidas!", response.message , "success");
		});
		setTimeout(function(){
			location.reload();
		}, 3000);
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
//ON HIDE MODAL RESET EVERYTHING
$('#user-printscreen-modal').on('hidden.bs.modal', function (e) {
	$('#image_preview_YT').css('background-image', "url(../images/icons/yt-icon.png)");
	$('#image_preview_FB').css('background-image', "url(../images/icons/fb-icon.png)");
	$('#image_preview_Twitch').css('background-image', "url(../images/icons/twitch-icon.png)");
	$('#image_preview_Instagram').css('background-image', "url(../images/icons/instagram-icon.png)");
	$('#image_preview_Twitter').css('background-image', "url(../images/icons/twitter-icon.png)");
	$('.check-yt').addClass('d-none');
	$('.check-fb').addClass('d-none');
	$('.check-twitch').addClass('d-none');
	$('.check-instagram').addClass('d-none');
	$('.check-twitter').addClass('d-none');
	$(this)
		.find("input,textarea,select")
			.val('')
			.end()
		.find("input[type=checkbox], input[type=radio]")
			.prop("checked", "")
			.end();
});

	//FUNCTION TO ADD IMAGE AND IMAGE PREVIEW TO INPUTS
	function readURL(input, socialmedia) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function(e) {
	            $(`#image_preview_${socialmedia}`).css('background-image', 'url('+e.target.result +')');
	            $(`#image_preview_${socialmedia}`).hide();
	            $(`#image_preview_${socialmedia}`).fadeIn(650);
	        }
	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$(".imageUpload").change(function() {
	    readURL(this, $(this).data('socialmedia'));
	});

})(window.jQuery);