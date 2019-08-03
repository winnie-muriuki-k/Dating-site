
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
        <div class=" l_news_item col-md-10 col-sm-12" style="margin: auto;">
            <div class="row">
                <div class="col-md-4 main-profile-holder">
                <h3 class="aside-header"><a href="{{route('edit-profile')}}">My Profile</a></h3>

                    <img src="{{asset('avatars/')}}/{{Auth::user()->avatar}}" alt="" style="width: 200px;height: 200px;">
                    <h5 style="color: black;">{{Auth::user()->username}}</h5>

                    <a class="attribute-title" style="display: block;" href="{{route('edit-profile')}}" title="Edit Profile">Update profile</a>
                    
                </div>
                <div class="col-md-4 col-sm-12 user-basics1">
                    <h5 style="text-align: center;">Basic Information</h5>
                    <table class="userPropertiesTable">
                        <tr>
                            <td class="userProperties">Age</td>
                            <td>{{Auth::user()->age}}</td>
                        </tr>
                        <tr>
                            <td class="userProperties">Phonenumber</td>
                            <td>{{Auth::user()->phonenumber}}</td>
                        </tr>
                        <tr>
                            <td class="userProperties">Email</td>
                            <td>{{Auth::user()->email}}</td>
                        </tr>
                        <tr>
                            <td class="userProperties">Gender</td>
                            <td>{{Auth::user()->gender}}</td>
                        </tr>
                        <tr>
                            <td class="userProperties">Interested In</td>
                            <td>{{ isset(Auth::user()->seeking) ? Auth::user()->seeking->name : "Not set!" }}</td>
                        </tr>
                        <tr>
                            <td class="userProperties">city</td>
                            <td>{{ isset(Auth::user()->profile->city) ? Auth::user()->profile->city->name :"Not set!"}}</td>
                        </tr>
                        <tr>
                            <td class="userProperties">Country</td>
                            <td>{{ isset(Auth::user()->profile->country) ? Auth::user()->profile->country->name :"Not set!"}}</td>
                        </tr>
                    </table>
                </div>

            <div class="col-md-4">
                @if(count($users)>0)
                <h6 class="aside-header">People You may know</h6>
                <div class="scrollable" style="width: 100%">
                    <aside class="single_sidebar_widget popular_post_widget">
                        @foreach($users as $user)
                            <div class="card" style="margin-bottom: 2%;" id="profile-display-cards">
                                <img src="{{asset('avatars/')}}/{{$user->avatar}}"  id="user-profile-image" style="max-height: 255px;"alt="Profile Image">
                                <div class="card-body" style="padding: 0px !important;">
                                    <p class="card-text text-center" style="margin: 1px !important;">
                                        {{ !empty($user->username) ? $user->username : 'No name' }}, <i>&nbsp;{{$user->age }}&nbsp;yrs</i>
                                    </p>

                                    <div style="text-align: center;padding-bottom: 5px;">
                                        <button type="button" class="btn btn-info btn-sm">
                                            <a style="color: white;" href="{{route('view-user',['id'=>$user->id])}}"> <i class="fa fa-eye user-information" style="    font-size: 20px;" aria-hidden="true" id="view-more-user-information" title="View profile and interests"
                                                ></i></a>

                                        </button>

                                        &nbsp;

                                        <button type="button" class="btn btn-info btn-sm" onclick="populateAndShowMessageDiv('{{$user->id}}','{{$user->username}}','{{Auth::user()->id}}')" id="send-message-btn">
                                            <i class="fa fa-send" title="message {{ !empty($user->username) ? $user->username : '' }}" style="    font-size: 20px;" aria-hidden="true" onclick=""></i>
                                        </button>

                                        &nbsp;

                                        <button type="button" class="btn btn-info btn-sm" onclick="Matchuser('{{Auth::user()->id}}','{{$user->id}}')" id="favorite-user-button">
                                            <i title="like {{ !empty($user->username) ? $user->username : '' }}" class="fa fa-heart favorite-icon" id="fa-heart-{{$user->id}}" style="font-size: 20px;" aria-hidden="true" onclick=""></i>

                                        </button>

                                        &nbsp;



                                        &nbsp;

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </aside>
                    
                </div>
                @endif


            </div>

        </div>
        <div class="row">
                <div class="col-md-4 col-sm-12 user-basics">
                    <h5 style="text-align: center;">Appearance</h5>
                    <table class="userPropertiesTable">
                        <tr>
                            <td class="userProperties">Hair Color</td>
                            <td>{{isset(Auth::user()->profile->hairColor)?Auth::user()->profile->hairColor->name:'Not Set'}}</td>
                        </tr>
                        <tr>
                            <td class="userProperties">Hair Length</td>
                            <td>{{isset(Auth::user()->profile->hairLength)?Auth::user()->profile->hairLength->name:'Not Set'}}</td>
                        </tr>
                        <tr>
                            <td class="userProperties">Hair Type</td>
                            <td>{{isset(Auth::user()->profile->hairType)?Auth::user()->profile->hairType->name:'Not Set'}}</td>
                        </tr>
                        <tr>
                            <td class="userProperties">Eye Color</td>
                            <td>{{isset(Auth::user()->profile->eyeColor)?Auth::user()->profile->eyeColor->name:'Not Set'}}</td>
                        </tr>
                        <tr>
                            <td class="userProperties">Heigth</td>
                            <td>{{isset(Auth::user()->profile->height)?Auth::user()->profile->height->name:'Not Set'}}</td>
                        </tr>
                        <tr>
                            <td class="userProperties">Eye Wear</td>
                            <td>{{isset(Auth::user()->profile->eyeWear)?Auth::user()->profile->eyeWear->name:'Not Set'}}</td>
                        </tr>
                        <tr>
                            <td class="userProperties">Weight</td>
                            <td>{{isset(Auth::user()->profile->weight)?Auth::user()->profile->weight->name:'Not Set'}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4 col-sm-12 user-basics">
                    <h5 style="text-align: center;">Appearance</h5>
                    <table class="userPropertiesTable">
                        <tr>
                            <td class="userProperties">Ethinicity</td>
                            <td>{{isset(Auth::user()->profile->ethnicity)?Auth::user()->profile->ethnicity->name:'Not Set'}}</td>
                        </tr>
                        <tr>
                            <td class="userProperties">Complexion</td>
                            <td>{{isset(Auth::user()->profile->complexion)?Auth::user()->profile->complexion->name:'Not Set'}}</td>
                        </tr>
                        <tr>
                            <td class="userProperties">Body Type</td>
                            <td>{{isset(Auth::user()->profile->bodyType)?Auth::user()->profile->bodyType->name:'Not Set'}}</td>
                        </tr>
                        <tr>
                            <td class="userProperties">Facial Hair</td>
                            <td>{{isset(Auth::user()->profile->facialHair)?Auth::user()->profile->facialHair->name:'Not Set'}}</td>
                        </tr>
                        <tr>
                            <td class="userProperties">Best Feature</td>
                            <td>{{isset(Auth::user()->profile->bestFeature)?Auth::user()->profile->bestFeature->name:'Not Set'}}</td>
                        </tr>
                        <tr>
                            <td class="userProperties">Body Art</td>
                            <td>{{isset(Auth::user()->profile->bodyArt)?Auth::user()->profile->bodyArt->name:'Not Set'}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4 col-sm-12 user-basics">
                    <!---<h5 style="text-align: center;">Life Style</h5>-->
                </div>
        </div>



        </div>

    </div>
    </div>

</section>
@include('partials.footer')
<script type="text/javascript">


</script>
</body>
</html>
