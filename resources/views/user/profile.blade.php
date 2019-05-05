
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
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
    <link rel="stylesheet" href="{{ asset('temp/vendors/nice-select/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/vendors/animate-css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/vendors/popup/magnific-popup.css') }}">
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('temp/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/pnotify.custom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-css.css') }}">
</head>
<body data-spy="scroll" data-target="#mainNav" data-offset="70" style="background: #c3bdc2 !important;">
@include('partials.header')
<section class="latest_news_area p_120">
    <div class="container">
    <div class="row">
        <div class=" l_news_item col-md-10 main-holder ">
            <div class="row">
                <div class="col-md-4 main-profile-holder">
           <h3 class="aside-header"><a href="{{route('edit-profile')}}">Edit Profile</a></h3>
            <img src="{{asset('avatars/')}}/{{Auth::user()->avatar}}" alt="" style="width: 200px;height: 200px;">
                </div>
                <div class="col-md-4">
                    <h4>{{Auth::user()->username}}</h4>
                    <p>Age : {{Auth::user()->age}}</p>
                    <hr>
                    <p class="gender-p">{{Auth::user()->gender}} / Single</p>
                    <hr>
                    @if(isset(Auth::user()->profile))
                    <p class="gender-p">{{Auth::user()->profile->country->name}} </p>
                        @endif
                    <hr>
                    <p clas="gender-p">Seeking :</p>
                    <hr>
                    <p clas="gender-p">Last Active :    </p>
                </div>

            <div class="col-md-4  scrollable">
                @if(count($users)>0)
                    <aside class="single_sidebar_widget popular_post_widget">
                        <h6 class="aside-header">People You may know</h6>

                        {{-- <div class="row member-holder"> --}}
                        @foreach($users as $user)
                            <div  id="div-match-{{$user->id}}">
                                <div class="l_news_item member-profile-holder" style="text-align: center;margin-bottom: 5px;">
                                    <img src="{{asset('avatars/')}}/{{$user->avatar}}" class="img-responsive" alt="" style="padding-top: 10px;width: 150px;height: 150px;">

                                    <div class="post_view" style="display: inline-block;">
                                        <div>
                                            <small class="text-info">{{ !empty($user->username) !==null ? $user->username : 'No name' }}</small>
                                        </div>

                                        <i class="fa fa-info-circle" style="font-size: 20px;margin-right: 5px;" aria-hidden="true" id="view-more-user-information" title="View profile and interests"
                                           onclick="showUserInformationOntheModal()"></i>
                                        <i class="fa fa-send" title="Send Message" style="font-size: 20px;color: #57a700;margin-right: 5px;" aria-hidden="true" onclick="populateAndShowMessageDiv('{{$user->id}}','{{$user->username}}','{{Auth::user()->id}}')">
                                        </i>

                                        <i class="fa fa-heart" id="fa-heart-{{$user->id}}" style="color: {{ !empty($user->match) &&
                                                        $user->match->initator == Auth::user()->id ? '#ed4956' :''  }};font-size: 20px;" aria-hidden="true" onclick="Matchuser('{{Auth::user()->id}}','{{$user->id}}')"></i>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- </div> --}}
                        @endif
                    </aside>


            </div>

        </div>
            <hr>

            <div class="row attribute-title">

                <div class="col-md-12">
                     <div class="row header"><h4> Member Overview</h4>  <hr></div>

                </div>
            </div>
            <div class="row">

                <div class="col-md-12 attribute-content-holder">
                    <p>Phenomenal</p>

                </div>
            </div>
            <div class="row attribute-title">

                <div class="col-md-6">
                    <div class="row header"><h4> About {{Auth::user()->username}}</h4>  <hr></div>

                </div>
                <div class="col-md-6">
                    @if(Auth::user()->gender=='male')
                    <div class="row header"><h4>He's  Looking For</h4>  <hr></div>
                        @else
                        <div class="row header"><h4>She's  Looking For</h4>  <hr></div>
                        @endif


                </div>


            </div>
            <hr>
            <div class="row">

                <div class="col-md-12 ">
                   <h3>Basic</h3>

                </div>
            </div>
            <hr>
            <div class="row">

                <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-6">
                          <h6>Gender</h6>
                      </div>
                        <div class="col-md-6">
                            @if(Auth::user()->gender=='male')
                                <p>Male</p>
                                @else
                            <p>Female</p>
                                @endif
                        </div>
                    </div>


                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            @if(Auth::user()->gender=='male')
                                <p>Female</p>
                            @else
                                <p>Male</p>
                                @endif
                        </div>
                    </div>


                </div>

            </div>
            <div class="row">

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Age</h6>
                        </div>
                        <div class="col-md-6">
                           <p>{{Auth::user()->age}}</p>
                        </div>
                    </div>


                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">

                        </div>
                    </div>


                </div>

            </div>


        </div>

    </div>
    </div>

</section>
@include('partials.footer')
</body>
</html>
