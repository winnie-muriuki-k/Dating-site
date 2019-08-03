 <!doctype html>
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
        <section class="latest_news_area p_120" style="background-image:url('{{ asset('temp/img/banner/smiling.jpg') }}');background-position: center;">
            <div class="container" style="margin-bottom: 10%;margin-top: 10%;">
                <div class="latest_news_inner row">
                    <div class="col-md-6 col-sm-12">
                        <div class="l_news_item" style="">
                        <h3>Reset Account</h3>
                            <form id="reset-password">
                              <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                  <input type="email" name="email" placeholder="Enter email" class="form-control" id="Email">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label" style="opacity: 0;">Email</label>
                                <div class="col-sm-8">
                                    <button class="btn btn-success btn-sm" style="width: 100%;" type="button" id="btn-password-reset" onclick="PasswordReset()">Get Password Reset Link &nbsp;<i class="spinner" id="spinner-password-reset" style="display: none;"></i></button>
                                </div>
                              </div>
                              <div class="row">
                                  <a href="{{ route('user-login') }}" title="Login to account."> Got to login.  </a> 
                                  <span style="margin-left: 1%;margin-right: 1%;">||</span>
                                  <a href="{{ route('user-register') }}" title="register for a new account.">or create account. </a>
                              </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Latest News Area =================-->


        <!--================ start footer Area  =================-->
        @include('partials.footer')

        <script type="text/javascript">

            function PasswordReset() {
              PNotify.removeAll();
              var info = {};
              var errors = [];
                $("#reset-password")
                .find("input")
                .each(function() {
                  $(this).css("border", "0px");
                  if ($(this).val() == "" || $(this).val() == null) {
                    $(this).css("border", "1px solid #f77575");
                    errors.push($(this).attr("name"));
                  }
                  info[$(this).attr("name")] = $(this).val();
                });
              if (errors.length > 0) {
                new PNotify({
                  text: "Email is required.",
                  animate_speed: "fast",
                  type: "error"
                });
                return;
              }
              // console.log(info);
                  $("#spinner-password-reset").show();
                  $("#btn-password-reset").addClass("disabled");
                $.ajax({

                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },

                    type:'POST',

                    data:info,

                    url: '{{route('user-password-reset')}}',

                    success:function(response){
                  $("#spinner-password-reset").hide();
                  $("#btn-password-reset").removeClass("disabled");

                      // console.log(response);

                        if(response.status=='success'){
                           new PNotify({
                                text: response.message,
                                animate_speed: 'fast',
                                type: 'info'
                            });
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
                  $("#spinner-password-reset").hide();
                  $("#btn-password-reset").removeClass("disabled");
                            new PNotify({
                                text: 'Error occurred , try again later',
                                animate_speed: 'fast',
                                type: 'info'
                            });
                    }

                });
            }

        </script>
        <!--================ end footer Area  =================-->
    </body>
</html>
