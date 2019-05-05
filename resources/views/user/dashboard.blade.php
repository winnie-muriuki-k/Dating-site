
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
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    </head>
    <body data-spy="scroll" data-target="#mainNav" data-offset="70" style="background: #c3bdc2 !important;">
        @include('partials.header')
        <section class="latest_news_area p_120" style="padding-bottom: 0px !important; background: #ded0e4 !important;">
        	<div class="container">
        		<div class="row">
                    <div class="col-md-3 col-sm-12">

        				<div class="l_news_item profile-holder">
        					<h4>Hi  {{ Auth::user()->username }}</h4>
                            <div class="profile-img-container ">

                                <form onsubmit="UploadAvatar(event)" enctype="multipart/form-data" action="{{route('user-update-avatar')}}" method="POST" id="avatar">
                                    <small id="upload-profile-image" style="display: none;">To upload an image click on your Avatar</small>
                                    <input type="file" id="file1" name="avatar" accept="image/*" capture style="display:none"/>
                                    <img src="{{asset('avatars/')}}/{{Auth::user()->avatar}}" id="upfile1" style="cursor:pointer" />
                                    </p>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-sm btn-success">Upload profile image</button>
                                </form>
                            </div>
        					<div class="post_view text-center">
                                <a href="{{route('view-profile')}}"><i class="fa fa-eye" aria-hidden="true"></i>View my profile</a>
{{--         						<a href="#"><i class="fa fa-commenting" aria-hidden="true"></i> 07</a>
        						<a href="#"><i class="fa fa-reply" aria-hidden="true"></i> 362</a> --}}
        					</div>
                        </div>

                        <div class="l_news_item profile-holder">
                            <h4>What s new?</h4>
                            <hr>

                            <div class="post_view">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
{{--                         <div class="row card" style="padding:1%; margin-bottom: 1%;">
                            <div class="col-sm-12 col-md-12 form-inline">
                                <div class="form-group col-md-8 col-sm-8">
                                    <input type="text" id="search-user-name" name="search-user-name" style="width: 100%;" class="form-control" placeholder="enter username">
                                </div>
                                <div class="form-group col-md-4 col-sm-4">
                                    <button class="btn btn-info btn-sm" style="width: 100%;" type="button" onclick="SearchUser('{{Auth::user()->id}}')">Search&nbsp;<i class="spinner" id="spinner-search" style="display: none;"></i></button>
                                </div>
                            </div>

                        </div> --}}
                        <div class="row search-results-heading" style="background: #bdd2c2;display: none;">
                                <p class="text-center search-results-heading"  id="search-results-heading"
                                style="width: 100%; padding: 0px !important; margin: 0px;font-size: 12px; color: #fff;">Search results.</p>
                                <span onclick="ResetSearch()" class="reset-search">X</span>
                        </div>
                        <div class="row" style="background: #bdd2c2; display: none;padding-bottom: 2%" id="display-search-results">

                        </div>
                        <hr class="search-results-heading" style="display: none;">
                        <div class="row">
                            @if(count($users)>0)
                                    @foreach($users as $user)
                                    <div class="col-md-4" id="div-match-{{$user->id}}">
                                        <div class="l_news_item member-profile-holder" style="text-align: center;margin-bottom: 5px;">
                                                <img src="{{asset('avatars/')}}/{{$user->avatar}}" class="img-responsive" alt="" style="padding-top: 10px;width: 150px;height: 150px;">


                                            <div class="post_view" style="display: inline-block;">
                                                <div>
                                                    <small class="text-info">{{ !empty($user->username) !==null ? $user->username : 'No name' }}</small>
                                                </div>

                                                    <i class="fa fa-info-circle user-information" style="    font-size: 25px;margin-right: 5px;" aria-hidden="true" id="view-more-user-information" title="View profile and interests"
                                                    onclick="showUserInformationOntheModal('{{$user->id}}')"></i>


                                                    <i class="fa fa-send" title="message {{ !empty($user->username) !==null ? $user->username : '' }}" style="    font-size: 25px;color: #57a700;margin-right: 5px;" aria-hidden="true" onclick="populateAndShowMessageDiv('{{$user->id}}','{{$user->username}}','{{Auth::user()->id}}')">

                                                        {{-- populateAndShowMessageDiv(receiver_id,receiver_username,sender_id) --}}
                                                    </i>

                                                    <i title="like {{ !empty($user->username) !==null ? $user->username : '' }}" class="fa fa-heart favorite-icon" id="fa-heart-{{$user->id}}" style="color: {{ $user->match!==null && $user->match->confirmed==1 ? "#ed4956" : "" }};    font-size: 25px;" aria-hidden="true" onclick="Matchuser('{{Auth::user()->id}}','{{$user->id}}')"></i>

                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                            @endif

                        </div>

                        <div class="row">
                            {{$users->links()}}
                        </div>

                    </div>

                    <div class="col-md-3 col-sm-12">
                        <div class="l_news_item profile-holder">
                            <h4>Recent Activities</h4>
                            <hr>

                            <div class="post_view" style="height: 200px;overflow: auto;">
                                    @if(!empty($all_notifications) && count($all_notifications)>0)
                                        @foreach($all_notifications as $notif)
                                        <div style="font-size: 12px;border-bottom:1px solid #d6d5d8;    padding-left: 5px;color: black;padding-bottom: 10px;">
                                            {{$notif->description}}

                                            

                                            

                                        </div>
                                        @endforeach
                                    @else
                                        <div style="font-size: 12px;border-bottom:1px solid #d6d5d8;    padding-left: 5px;color: black;padding-bottom: 10px;">
                                            No activities.
                                        </div>

                                    @endif
                            </div>
                        </div>
                    </div>

        		</div>
        	</div>

<!-- Large modal -->
        <div class="l_news_item profile-holder" id="message-div"  style="position: fixed;width: 400px;right: 45px;bottom: 0;background: #b1ffdf;padding: 10px !important;display: none;z-index: 99999;">
            <span><i class="fa fa-user"></i> <span id="receiver_username"></span> </span>
            <span onclick="HideMessageDiv()" style="float:right; font-size: 20px;"><i class="fa fa-close"></i></span>

            <div class="post_view" style="height: 300px ;overflow: auto; background: #fff; margin-bottom: 10px;padding-top: 20px;"><div style="padding-bottom: 20px;" id="conversation-list"></div></div>

            <div class="container">
                <div class="form-group row" style="margin-bottom: 0px;">
                    <input type="hidden" id="receiver_id">
                    <input type="hidden" id="sender_id">
                    <textarea class="form-control col-md-10 col-sm-12" id="sender_message" style="font-size: 12px;padding: 0px ;resize: none;text-indent:10px;" placeholder="Send Message"></textarea>
                    <div class="col-md-2 col-sm-12">
                            <button type="button" class="btn btn-default" style="background: #fff;" onclick="SendMessage();">
                                <i class="fa fa-send"></i>
                            </button>
                    </div>

                </div>

            </div>
        </div>

{{-- modal --}}
<!-- Modal -->
<div class="modal fade" id="user-information-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-info" id="user-name-details">User Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="padding-top: 0px !important;padding-bottom: 0px !important;">
        <div class="panel panel-info">
          <div class="panel-heading">
          </div>
          <div class="panel-body">
            <table class="table" style="width: 100%;" id="display-information-table">
{{--                 <tr>
                    <td style="padding: 5px !important;border-top: 0px !important;">Name</td>
                    <td style="padding: 5px !important;border-top: 0px !important;">Peter Kariuki Mutuura</td>
                </tr>
                <tr>
                    <td style="padding: 5px !important;">Age</td>
                    <td style="padding: 5px !important;">25 Years</td>
                </tr>
                <tr>
                    <td style="padding: 5px !important;">Phone Number</td>
                    <td style="padding: 5px !important;">25 Years</td>
                </tr>
                <tr>
                    <td style="padding: 5px !important;">Email</td>
                    <td style="padding: 5px !important;">peterkariukimutuura@gmail.com</td>
                </tr>
                <tr>
                    <td style="padding: 5px !important;">Current Location</td>
                    <td style="padding: 5px !important;">Nairobi, Kenya</td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 5px !important; text-align: center;background: #dedede;">Interests</td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 5px !important;">
                        <span>Coding</span>, <span>Community Development</span>, <span>Community Enrichment</span>, <span>Teaching</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 5px !important;text-align: center;background: #dedede;">Hobbies</td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 5px !important;">
                        <span>Coding</span>, <span>Community Development</span>, <span>Community Enrichment</span>, <span>Teaching</span>
                    </td>
                </tr> --}}
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
{{-- modal --}}

        </section>
        @include('partials.footer')
        <script type="text/javascript">
            function SendMessage(){
                PNotify.removeAll();
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

                                    returnUserCoversationList(user_conversation);

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
            function returnUserCoversationList(conversations){
                console.log(conversations);
                if (conversations.length>0) {
                    var str="";
                    for (var i = conversations.length - 1; i >= 0; i--) {
                        var str1 ="";
                        if (conversations[i].user.id=='{{Auth::user()->id}}') {
                         str1 +=`<li style="list-style: none; text-indent: 10px;">
                                <small>${conversations[i].text}</small><span style="margin-left: 10px;font-size: 10px;margin-right: 7px;color: #54c185;">${conversations[i].created_at}</span>`;

                        }else{
                                str1+=`
                                <ul style="margin-bottom:1px !important;">
                                    <li style="list-style: none;background: #e6fbf5; padding-left: 30px;border-radius: 25px;">
                                        <small>${conversations[i].text}</small>
                                        <span style="font-size: 10px;margin-left: 10px;color: #eab38d;">${conversations[i].created_at}</span>
                                    </li>
                                </ul>
                            </li>`.trim();

                        }

                            str+=str1;
                    }

                    $("div#conversation-list").html(str);
                    $("#conversation-list").scrollTop($('#conversation-list')[0].scrollHeight)

                }else{
                $("div#conversation-list").html(`<small style="margin-left:20%;">No conversations added.</small>`);
                }
                $("div#message-div").show();

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

                                new PNotify({
                                    text: response.message,
                                    animate_speed: 'fast',
                                    type: 'success'
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
                                    returnUserCoversationList(user_conversations);
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

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#upfile1').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $(document).ready(function(){
                $("input#file1").hover(function(){
                    $("#upload-profile-image").show();
                },function(){
                   $("#upload-profile-image").hide();
                });
            });
            $("#file1").change(function(){
                readURL(this);
            });



            function populateAndShowMessageDiv(receiver_id,receiver_username,sender_id){
                console.log('sender_id ',sender_id, '  receiver' ,receiver_id);
                $("div#message-div").hide();
                if (receiver_id!==""&&sender_id!=="") {
                    receiver_username = receiver_username!==""? receiver_username : 'User';
                    $("input#receiver_id").val(receiver_id);
                    $("input#sender_id").val(sender_id);
                    $("textarea#message").val("");
                    $("span#receiver_username").html(receiver_username);

                    fecthCoversations(sender_id,receiver_id);



                }
            }
            function HideMessageDiv(){
                $("span#receiver_username").html("User");
                $("input#receiver_id").val("");
                $("input#sender_id").val("");
                $("textarea#sender_message").val("");
                $("div#message-div").hide();

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
                                  <img src="http://localhost:8000/avatars/${data[i].avatar}" class="img-responsive" alt="" style="padding-top: 10px;width: 150px;height: 150px;">


                              <div class="post_view" style="display: inline-block;">
                                  <div>
                                      <small class="text-info">${data[i].username}</small>
                                  </div>
                                  
                                      <i class="fa fa-info-circle user-information" style="font-size: 25px;margin-right: 5px;" 
                                      aria-hidden="true" id="view-more-user-information" title="View profile and interests" 
                                      onclick="showUserInformationOntheModal('${data[i].id}')"></i>


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
// SearchUser





        </script>
    </body>
</html>
