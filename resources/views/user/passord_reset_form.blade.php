<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
        <title>Dating App</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('temp/css/bootstrap.css') }}">

        <link rel="stylesheet" href="{{ asset('temp/vendors/linericon/style.css') }}">
        
        <link rel="stylesheet" href="{{ asset('temp/css/font-awesome.min.css') }}">

        <link rel="stylesheet" href="{{ asset('temp/vendors/owl-carousel/owl.carousel.min.css') }}">

        <link rel="stylesheet" href="{{ asset('temp/vendors/lightbox/simpleLightbox.css') }}">

        <link rel="stylesheet" href="{{ asset('temp/vendors/animate-css/animate.css') }}">

        <link rel="stylesheet" href="{{ asset('temp/vendors/popup/magnific-popup.css') }}">
        <!-- main css -->
        <link rel="stylesheet" href="{{ asset('temp/css/style.css') }}">

        <link rel="stylesheet" href="{{ asset('css/main.css') }}">

        <link rel="stylesheet" href="{{ asset('temp/css/responsive.css') }}">

        <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/pnotify.custom.min.css') }}">

        <style type="text/css"></style>
    </head>
    <body data-spy="scroll" data-target="#mainNav" data-offset="70">
        <!--================Header Menu Area =================-->
        @include('partials.header')
        <!--================Header Menu Area =================-->

        <!--================Latest News Area =================-->
        <section class="latest_news_area p_120" style="background-image:url('{{ asset('temp/img/banner/smiling.jpg') }}');background-position: top;">
            <div class="container">
                <div class="latest_news_inner row">
                    <div class="col-md-6 col-sm-12">
                        <div class="l_news_item" style="">
                          @if(!empty($token))
                          <h3>Account Password Reset </h3>
                            <form id="password-reset-form-real">
                              <div class="form-group row">
                                <input type="hidden" name="token" value="{{ $token }}">
                                <label for="password" class="col-sm-4 col-form-label">New Password</label>
                                <div class="col-sm-8">
                                 <input type="password" class="form-control" id="new_password" name="password" placeholder="New password" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="confirm-password" class="col-sm-4 col-form-label">Confirm Password</label>
                                <div class="col-sm-8">
                                 <input type="password" id="confirm_new" class="form-control" name="confirm_new" placeholder="Confirm password" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label" style="opacity: 0;">Email</label>
                                <div class="col-sm-8">
                                    <button class="btn btn-success btn-sm" style="width: 100%;" type="button" id="btn-password-reset-real" onclick="PasswordResetTrue()">Reset Password &nbsp;<i class="spinner" id="spinner-password-reset-real" style="display: none;"></i></button>
                                </div>
                              </div>
                            </form>
                            @else
                              <a href="{{ route('user-login') }}" class="btn btn-info">Login</a>
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Latest News Area =================-->


        <!--================ start footer Area  =================-->
        @include('partials.footer')
        <!--================ end footer Area  =================-->

        <script type="text/javascript">
function PasswordResetTrue() {
  PNotify.removeAll();
  var info = {};
  var errors = [];
    $("#password-reset-form-real")
    .find("input")
    .each(function() {
      $(this).css('border-color', '#ccc');
      if ($(this).val() == "" || $(this).val() == null) {
        $(this).css("border", "1px solid #f77575");
        errors.push($(this).attr("name"));
      }
      info[$(this).attr("name")] = $(this).val();
    });
  if (errors.length > 0) {
    new PNotify({
      text: "Fill in the required Fields.",
      animate_speed: "fast",
      type: "error"
    });
    return;
  }


    if ($("#new_password").val() !== $("#confirm_new").val()) {
        $("#new_password").css("border-color","red");
        $("#confirm_new").css("border-color","red");
        new PNotify({
            text: 'Passwords should match!',
            animate_speed: 'fast',
            type: 'error'
        });
        return;
    }

  // console.log(info);

    $("#spinner-password-reset-real").show();

    $("#btn-password-reset-real").addClass("disabled");
    
    $.ajax({

        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },

        type:'POST',

        data:info,

        url: '{{ route('user-reset-real')}}',

        success:function(response){

            // console.log(response);
          $("#spinner-password-reset-real").hide();

          $("#btn-password-reset-real").removeClass("disabled");
            
            if(response.status=='success'){
                new PNotify({
                    text: response.message,
                    animate_speed: 'fast',
                    type: 'success'
                });
                setTimeout(function(){
                  window.location.href="{{ route('user-login') }}";
                },2000);

            }


            if(response.status=='info'){
                new PNotify({
                    text: response.message,
                    animate_speed: 'fast',
                    type: 'info'
                });
            }

        },

        error:function(response){
    $("#spinner-password-reset-real").show();

    $("#btn-password-reset-real").addClass("disabled");
                new PNotify({
                    text: 'Error occurred , try again later',
                    animate_speed: 'fast',
                    type: 'info'
                });
        }

    });
}


        </script>
    </body>
</html>
