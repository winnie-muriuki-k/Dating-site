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
        <section class="latest_news_area p_120" style="background-image:url('{{ asset('temp/img/banner/smiling.jpg') }}');background-position: top;">
            <div class="container">
                <div class="latest_news_inner row">
                    <div class="col-md-6 col-sm-12">
                      <h1 style="margin-top:50%;margin-bottom: 40%;">{{$message}}. </h1>
                      <br>
                      <a href="{{route('welcome')}}" class="btn btn-success btn-sm" style="width: 200px; border-radius: 0px;">Go back to login page.</a>
                    </div>
                </div>
            </div>
        </section>


        <!--================ start footer Area  =================-->
        @include('partials.footer')
        <!--================ end footer Area  =================-->

    </body>
</html>
