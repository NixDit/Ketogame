(function($){
  $("#profileImage").change(function() {
    var formData          = new FormData();
    var profileImage      = $(this).prop('files')[0];

    if (profileImage.type.match('image.*')) {
      showLoading(true);
      formData.append('profileImage', profileImage);
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      })
      $.ajax({
        url: 'users/profile-picture',
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,
        type: 'POST',
        complete: function(){
          showLoading(false);
        }
      }).done(function(response){
        return swal(response.title, response.message , response.type, {timer: 2000});
      });
    }else{
      return swal("Error", "El archivo debe ser una imagen" , "error", {timer: 2000});
    }
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
})(window.jQuery);
