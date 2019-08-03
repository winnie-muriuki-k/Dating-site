
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

<section class="latest_news_area p_120 " style="padding-bottom: 0px !important; background: #ded0e4 !important;">
    <div class="l_news_item col-md-10 main-holder">
        <div class="row">
            <div class="col-md-8">
                <h4 style="color: #403a3a;">My Favourites</h4>
            </div>
            <div class="col-md-4">
                <h4 style="color: #403a3a;  color:black; font-size: 15px;">Related Searches <u><a href="{{route('user-favourited', ['id'=>Auth::user()->id])}}" class="">Who has Favourited me</a> </u></h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                {{  $favourited->links() }}
            </div>
        </div>



        <div class="row attribute-title interest-head">

            <div class="col-md-2">
                <button class="btn-default btn-primary interest-button">Delete Favourites  </button>

            </div>
            <div class="col-md-2">
                {{--<button class="btn-default btn-primary interest-button">Delete Interest  </button>--}}
            </div>
        </div>
        <div class="row">
            @if(count($favourited)>0)
                @foreach($favourited as $fav)
                    <div style="border: 1px solid green; margin: 0px 10px 10px 10px" class="col-md-2 col-sm-6" id="div-match-{{$fav->recipient_id}}">
                        <!------start------>
                        <!------start------>
                        <div class="card" style="margin-bottom: 2%;" id="profile-display-cards">
                            <img src="{{asset('avatars/')}}/{{App\User::findOrFail($fav->recipient_id)->avatar}}"  id="user-profile-image"
                                 alt="Profile Image">
                            <div class="card-body" style="padding: 0px !important;">
                                <p class="card-text text-center" style="margin: 1px !important;">
                                    {{ !empty(App\User::findOrFail($fav->recipient_id)->username) ? App\User::findOrFail($fav->recipient_id)->username : 'No name' }}, <i>&nbsp;{{App\User::findOrFail($fav->recipient_id)->age }}&nbsp;yrs</i>
                                </p>

                                <div style="text-align: center;padding-bottom: 5px;">
                                    <button type="button" class="btn btn-info btn-sm">
                                        <a style="color: white;" href="{{route('view-user',['id'=>$fav->recipient_id])}}"> <i class="fa fa-eye user-information" style="    font-size: 20px;" aria-hidden="true" id="view-more-user-information" title="View profile and interests"
                                            ></i></a>

                                    </button>

                                    &nbsp;

                                    <button type="button" class="btn btn-info btn-sm" onclick="populateAndShowMessageDiv('{{$fav->initiator_id}}','{{App\User::findOrFail($fav->recipient_id)->username}}','{{Auth::user()->id}}')" id="send-message-btn">
                                        <i class="fa fa-send" title="message {{ !empty(App\User::findOrFail($fav->recipient_id)->username) ? App\User::findOrFail($fav->recipient_id)->username: '' }}" style="    font-size: 20px;" aria-hidden="true" onclick="">

                                        </i>
                                    </button>

                                    &nbsp;

                                    <button type="button" class="btn btn-info btn-sm" onclick="Matchuser('{{Auth::user()->id}}','{{$fav->recipient_id}}')" id="favorite-user-button">
                                        <i title="like {{ !empty(App\User::findOrFail($fav->recipient_id)->username) ? App\User::findOrFail($fav->recipient_id)->username : '' }}" class="fa fa-heart favorite-icon" id="fa-heart-{{$fav->recipient_id}}" style="font-size: 20px;" aria-hidden="true" onclick=""></i>

                                    </button>

                                    &nbsp;
                                    @if(!in_array($fav->recipient_id, $fav_id_array))
                                        <button type="button" class="btn btn-info btn-sm" onclick="addFav('{{Auth::user()->id}}','{{$fav->recipient_id}}')" id="add_fav_{{$fav->recipient_id}}">
                                            <i title="Add {{ !empty(App\User::findOrFail($fav->recipient_id)->username) ? App\User::findOrFail($fav->recipient_id)->username : '' }} To Favourites" class="fa fa-thumbs-up" id="fa-heart-{{$fav->recipient_id}}" style="font-size: 20px;" aria-hidden="true" onclick=""></i>

                                        </button>
                                    @endif


                                    &nbsp;

                                </div>
                            </div>
                        </div>
                        <!-----end of new code------->
                        <!-----end of new code------->
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</section>
@include('partials.footer')
<script type="text/javascript">
    function addFav(logged_in_user, recipient)
    {
        let user = logged_in_user;
        let fav = recipient;
        let my_button = '#add_fav_'+fav;
        $(my_button).hide();

        $.ajax({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            type:'POST',

            data:{user:user, fav:fav},

            url: '{{route('user-add-fav')}}',

            success:function(response){
                PNotify.removeAll();
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
                    text: 'Error occurred , try again later',
                    animate_speed: 'fast',
                    type: 'info'
                });
            }

        });


    }
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
