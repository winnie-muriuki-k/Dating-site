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
                        <h3>Sign In</h3>
                            <form id="login-us-form" onsubmit="return SignUp()">
                              <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                  <input type="email" name="email" placeholder="email" class="form-control" id="Email">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="password_1" class="col-sm-4 col-form-label">Password</label>
                                <div class="col-sm-8">
                                  <input type="password" name="password" id="password-one" class="form-control" placeholder="Password" autocomplete="off">
                                </div>
                              </div>
                              <div class="row">
                                    <button type="submit" class="btn btn-success btn-sm col-md-4 col-sm-12 pull-left" type="button" id="btn-login" >Login &nbsp;<i class="spinner" id="spinner-login" style="display: none;"></i></button>
                              </div>
                              <div class="row" style="margin-top: 2%;">
                                  <a href="{{ route('user-register') }}" title="register for a new account."> Create Account </a> 
                                  <span style="margin-left: 1%;margin-right: 1%;">||</span>
                                  <a href="{{ route('user-password-reset') }}" title="Forgot account password, follow this link.">Recover account password ? </a>
                                  {{-- <p>{{config('app.url')}}</p> --}}
                                  
                              </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Latest News Area =================-->

        <script type="text/javascript">
            function SignUp(){
                event.preventDefault()
                PNotify.removeAll();
                var info = {};
                var errors = [];
                  $("#login-us-form")
                  .find("input")
                  .each(function() {
                    $(this).css("border", "1px solid #ccc");
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
                // console.log(info);

                $("#spinner-login").show();

                $("#btn-login").addClass("disabled");
                login(info);

            }


            function login(info) {
                $.ajax({

                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },

                    type:'POST',

                    data:info,

                    url: '{{route('process-user-login')}}',

                    success:function(response){
                        $("#spinner-login").hide();
                        $("#spinner-login-form").hide();

                         $("#btn-login").removeClass("disabled");
                         $("#btn-login-home").removeClass("disabled");
                        if(response.status=='success'){
                          if (response.code==1) {
                            window.location.href="{{route('user-dashboard')}}";
                          }
                          if (response.code==2) {
                            window.location.href="{{route('admin-dashboard')}}";
                          }

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
                        $("#spinner-login").hide();
                        $("#btn-login").removeClass("disabled");
                            new PNotify({
                                text: 'Error occurred , try again later',
                                animate_speed: 'fast',
                                type: 'info'
                            });
                    }

                });
            }
        </script>


        <!--================ start footer Area  =================-->
        @include('partials.footer')
        <!--================ end footer Area  =================-->

    </body>
</html>
