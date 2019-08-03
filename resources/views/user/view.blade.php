
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
                        <div class="card" style="margin-bottom: 2%;" id="profile-display-cards">
                            <img class="card-img-top" src="{{asset('avatars/')}}/{{$user->avatar}}"  id="user-profile-image"
                                 alt="Profile Image">
                            <div class="card-body" style="padding: 0px !important;">
                                <p class="card-text text-center" style="margin: 1px !important;">
                                    {{ !empty($user->username) ? $user->username : '' }}, <i>&nbsp;{{$user->age }}&nbsp;yrs</i>
                                </p>

                                <div style="text-align: center;padding-bottom: 5px;">
                                    <button type="button" class="btn btn-info btn-sm">
                                        <a style="color: white;" > <i class="fa fa-photo user-information" style="    font-size: 20px;" aria-hidden="true" id="view-more-user-information" title="View photos"
                                            ></i></a>

                                    </button>

                                    &nbsp;

                                    <button type="button" class="btn btn-info btn-sm" onclick="populateAndShowMessageDiv('{{$user->id}}','{{$user->username}}','{{Auth::user()->id}}')" id="send-message-btn">
                                        <i class="fa fa-send" title="message {{ !empty($user->username) ? $user->username : '' }}" style="    font-size: 20px;" aria-hidden="true" onclick="">

                                            {{-- populateAndShowMessageDiv(receiver_id,receiver_username,sender_id) --}}
                                        </i>
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
                    </div>
                    <div class="col-md-4 user-basics">
                        <h2>{{$user->username}}</h2>
                        <p>Age : {{$user->age}}</p>
                        <hr>
                        <p class="gender-p">{{$user->gender}} / Single</p>
                        <hr>
                        @if(isset($user->profile->country))
                            <p class="gender-p">{{$user->profile->country->name}} </p>
                        @else
                            <p class="gender-p"> Country: <a style="color: #777777;" href="{{route('edit-profile')}}"> Not Set</a> </p>
                        @endif
                        <hr>
                        <p clas="gender-p">Seeking: Not set</p>
                        <hr>
                        <p clas="gender-p">Last Active :   {{$user->last_seen}} </p>
                        <hr>
                    </div>

                    <div class="col-md-4  scrollable">
                        @if(count($users)>0)
                            <aside class="single_sidebar_widget popular_post_widget">
                                <h6 class="aside-header">People You may know</h6>

                                {{-- <div class="row member-holder"> --}}
                                @foreach($users as $u)
                                    <div class="card" style="margin-bottom: 2%;" id="profile-display-cards">
                                        <img style="width: 40%; margin: auto" src="{{asset('avatars/')}}/{{$u->avatar}}"  id="user-profile-image"
                                             alt="Profile Image">
                                        <div class="card-body" style="padding: 0px !important;">
                                            <p class="card-text text-center" style="margin: 1px !important;">
                                                {{ !empty($u->username) ? $u->username : 'No name' }}, <i>&nbsp;{{$u->age }}&nbsp;yrs</i>
                                            </p>

                                            <div style="text-align: center;padding-bottom: 5px;">
                                                <button type="button" class="btn btn-info btn-sm">
                                                    <a style="color: white;" href="{{route('view-user',['id'=>$u->id])}}"> <i class="fa fa-eye user-information" style="    font-size: 20px;" aria-hidden="true" id="view-more-user-information" title="View profile and interests"
                                                        ></i></a>

                                                </button>

                                                &nbsp;

                                                <button type="button" class="btn btn-info btn-sm" onclick="populateAndShowMessageDiv('{{$u->id}}','{{$u->username}}','{{Auth::user()->id}}')" id="send-message-btn">
                                                    <i class="fa fa-send" title="message {{ !empty($u->username) ? $u->username : '' }}" style="    font-size: 20px;" aria-hidden="true" onclick="">

                                                        {{-- populateAndShowMessageDiv(receiver_id,receiver_username,sender_id) --}}
                                                    </i>
                                                </button>

                                                &nbsp;

                                                <button type="button" class="btn btn-info btn-sm" onclick="Matchuser('{{Auth::user()->id}}','{{$u->id}}')" id="favorite-user-button">
                                                    <i title="like {{ !empty($u->username) ? $u->username : '' }}" class="fa fa-heart favorite-icon" id="fa-heart-{{$u->id}}" style="font-size: 20px;" aria-hidden="true" onclick=""></i>

                                                </button>

                                                &nbsp;



                                                &nbsp;

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- </div> --}}
                                @endif
                            </aside>


                    </div>

                </div>

                <div class="row attribute-title">

                    <div class="col-md-8    ">
                        <div class="row header"><h4> Member Overview</h4>  <hr></div>

                    </div>
                    <div class="col-md-4">
                        <div class="row header"><h4> Profile Information</h4>  <hr></div>

                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12 attribute-content-holder">
                        <p>Phenomenal</p>

                    </div>
                </div>
                <div class="row attribute-title">

                    <div class="col-md-6">
                        <div class="row header"><h4> About  {{$user->username}}</h4>  <hr></div>

                    </div>
                    <div class="col-md-6 hide">
                        @if($user->gender=='male')
                            <div class="row header"><h4>He's  Looking For</h4>  <hr></div>
                        @else
                            <div class="row header"><h4>She's  Looking For</h4>  <hr></div>
                        @endif


                    </div>

                </div>
                <div class="row">

                    <div class="col-md-12 sub-title attribute-title" >
                        <h3>Basic</h3>

                    </div>
                </div>
                <hr>
                <div class="row">

                    <div class="col-md-6 full-width" >
                        <div class="row">
                            <div class="col-md-6 responsive-div">
                                <h6>Gender</h6>
                            </div>
                            <div class="col-md-6 responsive-div">
                                @if($user->gender=='male')
                                    <p>Male</p>
                                @else
                                    <p>Female</p>
                                @endif
                            </div>
                        </div>


                    </div>
                    <div class="col-md-6 hide">
                        <div class="row">
                            <div class="col-md-6 responsive-div">
                                @if($user->gender=='male')
                                    <p>Female</p>
                                @else
                                    <p>Male</p>
                                @endif
                            </div>
                        </div>


                    </div>

                </div>
                <hr>
                <div class="row">

                    <div class="col-md-6 full-width">
                        <div class="row">
                            <div class="col-md-6 responsive-div">
                                <h6>Age</h6>
                            </div>
                            <div class="col-md-6 responsive-div">
                                <p>{{$user->age}}</p>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-6 hide">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="gender-p"> <a style="color: #777777;" href="{{route('edit-profile')}}"> Any</a> </p>

                            </div>
                        </div>
                    </div>


                </div>
                <div class="row">

                    <div class="col-md-12  sub-title attribute-title">
                        <h3>Appearance</h3>

                    </div>
                </div>
                <hr>
                <div class="row">

                    <div class="col-md-6 full-width">
                        <div class="row">
                            <div class="col-md-6 responsive-div">
                                <h6>Hair Color</h6>
                            </div>
                            <div class="col-md-6 responsive-div">
                                <p>{{isset($user->profile->hairColor)?$user->profile->hairColor->name:'Not Set'}}</p>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-6 hide">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="gender-p"> <a style="color: #777777;" href="{{route('edit-profile')}}"> Any</a> </p>

                            </div>
                        </div>
                    </div>


                </div>
                <hr>
                <div class="row">

                    <div class="col-md-6 full-width">
                        <div class="row">
                            <div class="col-md-6 responsive-div">
                                <h6>Hair Length</h6>
                            </div>
                            <div class="col-md-6 responsive-div">
                                <p>{{isset($user->profile->hairLength)?$user->profile->hairLength->name:'Not Set'}}</p>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-6 hide">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="gender-p"> <a style="color: #777777;" href="{{route('edit-profile')}}"> Any</a> </p>

                            </div>
                        </div>
                    </div>


                </div>
                <hr>
                <div class="row">

                    <div class="col-md-6 full-width">
                        <div class="row">
                            <div class="col-md-6 responsive-div">
                                <h6>Hair Type</h6>
                            </div>
                            <div class="col-md-6 responsive-div">
                                <p>{{isset($user->profile->hairType)?$user->profile->hairType->name:'Not Set'}}</p>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-6 hide">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="gender-p"> <a style="color: #777777;" href="{{route('edit-profile')}}"> Any</a> </p>

                            </div>
                        </div>
                    </div>



                </div>
                <hr>
                <div class="row">

                    <div class="col-md-6 full-width">
                        <div class="row">
                            <div class="col-md-6 responsive-div">
                                <h6>Eye Color</h6>
                            </div>
                            <div class="col-md-6 responsive-div">
                                <p>{{isset($user->profile->eyeColor)?$user->profile->eyeColor->name:'Not Set'}}</p>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-6 hide">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="gender-p"> <a style="color: #777777;" href="{{route('edit-profile')}}"> Any</a> </p>

                            </div>
                        </div>
                    </div>



                </div>
                <hr>
                <div class="row">

                    <div class="col-md-6 full-width">
                        <div class="row">
                            <div class="col-md-6 responsive-div">
                                <h6>Eye Wear</h6>
                            </div>
                            <div class="col-md-6 responsive-div">
                                <p>{{isset($user->profile->eyeWear)?$user->profile->eyeWear->name:'Not Set'}}</p>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-6 hide">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="gender-p"> <a style="color: #777777;" href="{{route('edit-profile')}}"> Any</a> </p>

                            </div>
                        </div>
                    </div>



                </div>
                <hr>
                <div class="row">

                    <div class="col-md-6 full-width">
                        <div class="row">
                            <div class="col-md-6 responsive-div">
                                <h6>Height</h6>
                            </div>
                            <div class="col-md-6 responsive-div">
                                <p>{{isset($user->profile->height)?$user->profile->height->name:'Not Set'}}</p>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-6 hide">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="gender-p"> <a style="color: #777777;" href="{{route('edit-profile')}}"> Any</a> </p>

                            </div>
                        </div>
                    </div>



                </div>
                <hr>
                <div class="row">

                    <div class="col-md-6 full-width">
                        <div class="row">
                            <div class="col-md-6 responsive-div">
                                <h6>Weight</h6>
                            </div>
                            <div class="col-md-6 responsive-div">
                                <p>{{isset($user->profile->weight)?$user->profile->weight->name:'Not Set'}}</p>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-6 hide">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="gender-p"> <a style="color: #777777;" href="{{route('edit-profile')}}"> Any</a> </p>

                            </div>
                        </div>
                    </div>



                </div>
                <hr>
                <div class="row">

                    <div class="col-md-6 full-width">
                        <div class="row">
                            <div class="col-md-6 responsive-div">
                                <h6>Body Style</h6>
                            </div>
                            <div class="col-md-6 responsive-div">
                                <p>{{isset($user->profile->bodyType)?$user->profile->bodyType->name:'Not Set'}}</p>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-6 hide">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="gender-p"> <a style="color: #777777;" href="{{route('edit-profile')}}"> Any</a> </p>

                            </div>
                        </div>
                    </div>



                </div>
                <hr>
                <div class="row">

                    <div class="col-md-6 full-width">
                        <div class="row">
                            <div class="col-md-6 responsive-div">
                                <h6>Ethnicity</h6>
                            </div>
                            <div class="col-md-6 responsive-div">
                                <p>{{isset($user->profile->ethnicity)?$user->profile->ethnicity->name:'Not Set'}}</p>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-6 hide">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="gender-p"> <a style="color: #777777;" href="{{route('edit-profile')}}"> Any</a> </p>

                            </div>
                        </div>
                    </div>



                </div>
                <hr>
                <div class="row">

                    <div class="col-md-6 full-width">
                        <div class="row">
                            <div class="col-md-6 responsive-div">
                                <h6>Complexion</h6>
                            </div>
                            <div class="col-md-6 responsive-div">
                                <p>{{isset($user->profile->complexion)?$user->profile->complexion->name:'Not Set'}}</p>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-6 hide">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="gender-p"> <a style="color: #777777;" href="{{route('edit-profile')}}"> Any</a> </p>

                            </div>
                        </div>
                    </div>



                </div>
                <hr>
                <div class="row">

                    <div class="col-md-6 full-width">
                        <div class="row">
                            <div class="col-md-6 responsive-div">
                                <h6>Facial Hair</h6>
                            </div>
                            <div class="col-md-6 responsive-div">
                                <p>{{isset($user->profile->facialHair)?$user->profile->facialHair->name:'Not Set'}}</p>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-6 hide">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="gender-p"> <a style="color: #777777;" href="{{route('edit-profile')}}"> Any</a> </p>

                            </div>
                        </div>
                    </div>



                </div>
                <hr>
                <div class="row">

                    <div class="col-md-6 full-width">
                        <div class="row">
                            <div class="col-md-6 responsive-div">
                                <h6>Best Feature</h6>
                            </div>
                            <div class="col-md-6 responsive-div">
                                <p>{{isset($user->profile->bestFeature)?$user->profile->bestFeature->name:'Not Set'}}</p>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-6 hide">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="gender-p"> <a style="color: #777777;" href="{{route('edit-profile')}}"> Any</a> </p>

                            </div>
                        </div>
                    </div>



                </div>
                <hr>
                <div class="row">

                    <div class="col-md-6 full-width">
                        <div class="row">
                            <div class="col-md-6 responsive-div">
                                <h6>Body Art</h6>
                            </div>
                            <div class="col-md-6 responsive-div">
                                <p>{{isset($user->profile->bodyArt)?$user->profile->bodyArt->name:'Not Set'}}</p>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-6 hide">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="gender-p"> <a style="color: #777777;" href="{{route('edit-profile')}}"> Any</a> </p>

                            </div>
                        </div>
                    </div>



                </div>
                <hr>
                <div class="row">

                    <div class="col-md-6 full-width">
                        <div class="row">
                            <div class="col-md-6 responsive-div">
                                <h6>Appearance</h6>
                            </div>
                            <div class="col-md-6 responsive-div">
                                <p>{{isset($user->profile->beautyLevel)?$user->profile->beautyLevel->name:'Not Set'}}</p>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-6 hide">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="gender-p"> <a style="color: #777777;" href="{{route('edit-profile')}}"> Any</a> </p>

                            </div>
                        </div>
                    </div>



                </div>
                <hr>
                <div class="row">

                    <div class="col-md-12  sub-title attribute-title">
                        <h3>LifeStyle</h3>

                    </div>
                </div>
                <hr>








            </div>

        </div>
    </div>
{{-- start --}}
{{-- <div class="row">
    <div class="col-md-4 col-sm-12">
        <div class="card" style="width: 60%; margin:0px auto;">

          <img class="card-img-top" src="{{asset('avatars/')}}/{{$user->avatar}}" onclick="window.location.href='{{route('edit-profile')}}'" style="cursor: pointer;" width="200" height="200" alt="Profile Picture">
          <div class="card-body">
            <p class="card-text">
                <i class="fa fa-user"></i>&nbsp;
                {{!empty(Auth::user()->username) ? Auth::user()->username : 'Set Username'}}<br>


                <i class="fa fa-envelope"></i>&nbsp;
                {{!empty(Auth::user()->email) ? Auth::user()->email : 'Set Email'}}<br>
                <i class="fa fa-edit"></i>&nbsp;
                <a href="{{route('edit-profile')}}" > Edit profile.</a>
                <br>
                 Profile visitors count = <span style="color: green;"></span><br>

            </p>
          </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <table style="width: 80%; margin: auto;">
            <tr>
                <td>Key</td>
                <td>Value</td>
            </tr>
            <tr>
                <td>Key</td>
                <td>Value</td>
            </tr>
            <tr>
                <td>Key</td>
                <td>Value</td>
            </tr>
            <tr>
                <td>Key</td>
                <td>Value</td>
            </tr>
        </table>
    </div>
    <div class="col-md-4 col-sm-12">

    </div>
</div> --}}
{{-- end --}}

</section>
@include('partials.footer')
<script type="text/javascript">

    function SendMessage(){
        $("button#btn-send-message").addClass('disabled');
        PNotify.removeAll();

        new PNotify({
            text: "Sending Message..." ,
            animate_speed: 'fast',
            type: 'success'
        });

        $("textarea#sender_message").css('border-color','#ccc');
        var receiver_id = $("input#receiver_id").val();
        var sender_id = $("input#sender_id").val();
        if (receiver_id !=="" && sender_id!=="") {
            var message = $("textarea#sender_message").val();
            if (message!=="") {
                var info ={
                    message:message,
                    receiver_id:receiver_id,
                    sender_id:sender_id
                };

                console.log(info);

                $.ajax({

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    type:'POST',

                    data:info,

                    url: '{{route('user-send-message')}}',

                    success:function(response){
                        PNotify.removeAll();
                        $("button#btn-send-message").removeClass('disabled');
                        console.log(response);

                        if(response.status=='success'){
                            $("textarea#sender_message").val("");
                            var extra = $("#receiver_username").text() !=="" ? ' to '+$("#receiver_username").text() + " !" : " !";

                            new PNotify({
                                text: response.message + extra ,
                                animate_speed: 'fast',
                                type: 'success'
                            });

                            var user_conversation=response.user_conversation;

                            returnUserCoversationList(user_conversation,sender_id);

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
                        new PNotify({
                            text: 'Error occurred , try again later',
                            animate_speed: 'fast',
                            type: 'info'
                        });
                    }

                });


            }else{
                $("textarea#sender_message").css('border-color','red');
                new PNotify({
                    text: 'Message is required!',
                    animate_speed: 'fast',
                    type: 'info'
                });

            }
        }else{
            new PNotify({
                text: 'Error occurred ,please try again later',
                animate_speed: 'fast',
                type: 'info'
            });
        }

    }

    function returnUnreadMessageCount(user_id){


    }

    function Matchuser(logged_in_user,match_id){
        PNotify.removeAll();
        if (logged_in_user!==null && match_id!==null) {
            new PNotify({
                text: "Sending match Request.",
                animate_speed: 'fast',
                type: 'info'
            });
            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                type:'POST',

                data:{initiator:logged_in_user,recipient:match_id},

                url: '{{ route('match-user')}}',

                success:function(response){
                    PNotify.removeAll();
                    if(response.status=='success'){

                        $("#fa-heart-"+match_id).css('color','#3654ee');

                        // new PNotify({
                        //     text: response.message,
                        //     animate_speed: 'fast',
                        //     type: 'success'
                        // });

                    }


                    if(response.status=='info'){
                        // new PNotify({
                        //     text: response.message,
                        //     animate_speed: 'fast',
                        //     type: 'info'
                        // });
                    }

                },

                error:function(response){
                    PNotify.removeAll();

                    new PNotify({
                        text: 'Error occurred , try again later',
                        animate_speed: 'fast',
                        type: 'info'
                    });
                }

            });
        }else{
            new PNotify({
                text: 'Could not match user, try again later',
                animate_speed: 'fast',
                type: 'error'
            });
        }
    }
    function fecthCoversations(sender,receiver){
        console.log('sender ',sender, '  receiver' ,receiver);
        PNotify.removeAll();
        if (sender!=="" && receiver!=="") {
            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                type:'POST',

                data:{sender_id:sender,receiver_id:receiver},

                url: '{{ route('user-get-convesations')}}',

                success:function(response){
                    console.log(response);
                    PNotify.removeAll();
                    var user_conversations =response.user_conversations;

                    if (response.confirmed=="false") {
                        if (response.match_request_status=="pending") {
                            new PNotify({
                                text: 'You match request is awaiting confirmation',
                                animate_speed: 'fast',
                                type: 'info'
                            });
                        }else{
                            new PNotify({
                                text: 'Kindly send a match request first!',
                                animate_speed: 'fast',
                                type: 'info'
                            });

                        }
                    }

                    if (response.confirmed=="true") {
                        returnUserCoversationList(user_conversations,sender);
                    }

                },

                error:function(response){
                    new PNotify({
                        text: 'Error occurred , try again later',
                        animate_speed: 'fast',
                        type: 'info'
                    });
                }

            });
        }else{
            new PNotify({
                text: 'Could not match user, try again later',
                animate_speed: 'fast',
                type: 'error'
            });
        }
    }

    function UploadAvatar(e){
        e.preventDefault();
        let avatar_form = $('#avatar')[0];

        let data = new FormData(avatar_form);

        let file = $('#file1').val().trim();
        PNotify.removeAll();
        if (file) {
            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                type:'POST',

                contentType: false,

                processData: false,

                data:data,

                url: '{{ route('user-update-avatar')}}',

                success:function(response){

                    if(response.status=='success'){
                        new PNotify({
                            text: response.message,
                            animate_speed: 'fast',
                            type: 'success'
                        });

                    }
                },

                error:function(response){
                    new PNotify({
                        text: 'Error occurred ,please try again later',
                        animate_speed: 'fast',
                        type: 'info'
                    });
                }

            });
        }else{
            new PNotify({
                text: 'Please select an image first',
                animate_speed: 'fast',
                type: 'error'
            });
        }
    }







    function showUserInformationOntheModal(id){
        PNotify.removeAll();

        if (id!==null&&id!=="") {
            $.ajax({

                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                type:'POST',

                data:{user_id:id},

                url: '{{ route('fetch-user-info')}}',

                success:function(response){

                    var info ="";

                    if(response.data!==null){
                        data=response.data;
                        info =`
                                        <tr>
                                            <td style="padding: 5px !important;border-top: 0px !important;">Name</td>
                                            <td style="padding: 5px !important;border-top: 0px !important;">${data.username}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 5px !important;">Age</td>
                                            <td style="padding: 5px !important;">${data.age} years</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 5px !important;">Current Location</td>
                                            <td style="padding: 5px !important;">Nairobi, Kenya</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding: 5px !important; text-align: center;background: #ececec;">Interests</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding: 5px !important;">
                                                <span>Coding</span>, <span>Community Development</span>, <span>Community Enrichment</span>, <span>Teaching</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding: 5px !important;text-align: center;background: #ececec;">Hobbies</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding: 5px !important;">
                                                <span>Coding</span>, <span>Community Development</span>, <span>Community Enrichment</span>, <span>Teaching</span>
                                            </td>
                                        </tr>
                                `
                    }else{
                        info= `<tr>
                                            <td colspan="2" style="padding: 5px !important;border-top: 0px !important;">
                                            User information unavailable!</td>
                                        </tr>`
                    }
                    $("table#display-information-table").html(info);
                    $("div#user-information-modal").modal('show');
                },

                error:function(response){
                    new PNotify({
                        text: 'Error occurred ,please try again later',
                        animate_speed: 'fast',
                        type: 'info'
                    });
                }

            });
        }else{
            new PNotify({
                text: 'Error occurred ,please try again later',
                animate_speed: 'fast',
                type: 'info'
            });
        }

    }


    function UpdateNotification(id){
        if (id!=="") {
            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                type:'POST',

                data:{user_id:id},

                url: '{{ route('clear-user-notifications')}}',

                success:function(response){
                    if(response.status=='success'){
                        $("#notifications-count").html("0");
                    }
                    if(response.status=='info'){
                    }

                },

                error:function(response){
                }

            });

        }
    }


    function ConfirmMatch(notification_type,match_id,notification_id){
        PNotify.removeAll();
        // console.log(notification_type,match_id,notification_id);

        if (notification_type!=="",match_id!=="",notification_id!=="") {
            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                type:'POST',

                data:{notification_type:notification_type,match_id:match_id,notification_id:notification_id},

                url: '{{route('confirm-match')}}',

                success:function(response){
                    console.log(response);

                    if(response.status=='success'){


                        new PNotify({
                            text: response.message,
                            animate_speed: 'fast',
                            type: 'success'
                        });

                        $("button_not_confirmed_"+notification_id).hide();
                        $("button_confirmed_"+notification_id).show();

                        if (response.user_id!==null) {
                            $("#fa-heart-"+response.user_id).css("color","#ed4956");
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
                }

            });

        }
    }




    // SearchUser
    function SearchUser(logged_in_user_id){

        $("p#search-results-heading").html('Search results.');
        PNotify.removeAll();
        var user_name =$("#search-user-name").val();
        $("#search-user-name").css("border-color","#ccc");
        if (user_name.trim()=="") {
            new PNotify({
                text: "Provide a username for search!",
                animate_speed: 'fast',
                type: 'info'
            });
            $("#search-user-name").css("border-color","red");

            return ;
        }else{
            $("#spinner-search").show();

            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                type:'POST',

                data:{key:user_name},

                url: '{{route('user-search')}}',

                success:function(response){
                    $("#spinner-search").hide();
                    // console.log(response);

                    if(response.status=='success'){
                        var data =response.data;
                        if (data.length>0) {
                            var str = "";

                            for (var i = data.length - 1; i >= 0; i--) {
                                var str1 =`
                      <div class="col-md-4 col-sm-4" id="div-match-${data[i].id}">
                          <div class="l_news_item member-profile-holder" style="text-align: center;margin-bottom: 5px;">
                                  <img src="http://157.230.101.229/wn/avatars/${data[i].avatar}" class="img-responsive" alt="" style="padding-top: 10px;width: 150px;height: 150px;">


                              <div class="post_view" style="display: inline-block;">
                                  <div>
                                      <small class="text-info">${data[i].username}</small>
                                  </div>

                                <i class="fa fa-user user-information" style="    font-size: 20px;margin-right: 5px;" aria-hidden="true" id="view-more-user-information" title="View profile and interests"
                                               onclick="showUserInformationOntheModal('>${data[i].id}')"></i>


                                      <i class="fa fa-send" title="message ${data[i].username}" style="font-size: 25px;color: #57a700;margin-right: 5px;"
                                      aria-hidden="true" onclick="populateAndShowMessageDiv('${data[i].id}','${data[i].username}','${logged_in_user_id}')">
                                      </i>

                                      <i title="like ${data[i].username}"
                                      class="fa fa-heart favorite-icon" id="fa-heart-2" style="color: #3654ee;font-size: 25px;"
                                      aria-hidden="true" onclick="Matchuser('${logged_in_user_id}','${data[i].id}')"></i>

                              </div>
                          </div>
                      </div>
                  `;
                                str+=str1
                            }
                            $("#display-search-results").html(str);
                            $("#display-search-results").show();


                        }else{
                            $("p#search-results-heading").html('no users found.');
                        }
                        $(".search-results-heading").show();

                    }
                    if(response.status=='info'){
                        new PNotify({
                            text: response.message,
                            animate_speed: 'fast',
                            type: 'info'
                        });
                        $(".search-results-heading").show();
                        $("#display-search-results").hide();
                        $("#display-search-results").html("");
                    }

                },

                error:function(response){
                    $("#spinner-search").hide();
                    $("#display-search-results").hide();
                    $("#display-search-results").html("");
                }

            });
        }
    }
    function UpdateNotification(id){
        if (id!=="") {
            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                type:'POST',

                data:{user_id:id},

                url: '{{ route('clear-user-notifications')}}',

                success:function(response){
                    if(response.status=='success'){
                        $("#notifications-count").html("0");
                    }
                    if(response.status=='info'){
                    }

                },

                error:function(response){
                }

            });

        }
    }
</script>
</body>
</html>
