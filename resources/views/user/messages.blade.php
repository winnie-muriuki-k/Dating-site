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
    <link rel="stylesheet" type="text/css" href="{{asset('css/jquery.dataTables.min.css')}}">

</head>
<body data-spy="scroll" data-target="#mainNav" data-offset="70" style="background: #c3bdc2 !important;">
@include('partials.header')
<section class="latest_news_area p_120">
    <div class="container">
        <div class="row col-sm-12" id="for-laptops-devices">
            <div class="l_news_item" style="padding: 20px !important; margin:auto; width: 100%;">

              <h3>Conversation List</h3>
              <div>
                <button id="delete-all-chats" type="button" onclick="deleteConversationAndMessages()">Delete Checked &nbsp;<i class="spinner" id="spinner_delete_conversations" style="display: none;"></i></button>
              </div>
                <table class="table" style="width: 100%;" id="myTable">

                  <thead>
                    <th>Action</th>
                    <th>Subject</th>
                    <th>From</th>
                    <th>Date</th>
                  </thead>
                  <tbody>

                    {{-- test one --}}
                    @if(count($userChats)>0)
                      @foreach($userChats as $chat)
                        <tr style="cursor: pointer;" >

                            <td style="width: 5%;padding: 0px !important;text-align: center; padding-top: 10px !important;">
                                <input type="checkbox" class="row_checkbox" id="deleted_checked_{{$chat->id}}" value="{{$chat->id}}" name="conversation_id" />
                            </td>

                              <td  title="text {{$chat->personTwo->id == Auth::user()->id ? $chat->personOne->username : $chat->personTwo->username }}" class="message-td" 
                        onclick="populateAndShowMessageDiv('{{$chat->personTwo->id == Auth::user()->id ? $chat->personOne->id : $chat->personTwo->id }}','{{$chat->personTwo->id == Auth::user()->id ? $chat->personOne->username : $chat->personTwo->username }}','{{Auth::user()->id}}','{{asset('avatars/')}}/{{$chat->personTwo->id == Auth::user()->id ? $chat->personOne->avatar : $chat->personTwo->avatar }}'),updateMessagesReadStatus('{{$chat->id}}','{{Auth::user()->id}}')"
                                  style="width: 55%;padding: 0px !important;cursor: pointer;padding-top: 10px !important;padding-left: 10px !important;" >
                                <i class="fa fa-envelope" style="color: green;"></i> &nbsp;
                                <small>{{substr($chat->messages[count($chat->messages)-1]['text'], 0,50)}} ...</small>
                                @if(count(\App\Message::where(['conversation_id'=>$chat->id,'receiver_id'=>Auth::user()->id,'read_status'=>'unread'])->get())>0)
                                <span class="badge span-message-count-{{$chat->id}}" style="background:#2cc011;color: #fff;">
                                    {{count(\App\Message::where(['conversation_id'=>$chat->id,'receiver_id'=>Auth::user()->id,'read_status'=>'unread'])->get())}}
                                </span>
                                @endif
                                <span>
                                <i class="spinner" id="spinner-login-{{$chat->personTwo->id == Auth::user()->id ? $chat->personOne->id : $chat->personTwo->id }}" style="display: none;line-height: 1;"></i>
                                    
                                </span>
                              </td>

                          <td style="width: 20%;padding: 0px !important;" class="message-td" 
                        onclick="populateAndShowMessageDiv('{{$chat->personTwo->id == Auth::user()->id ? $chat->personOne->id : $chat->personTwo->id }}','{{$chat->personTwo->id == Auth::user()->id ? $chat->personOne->username : $chat->personTwo->username }}','{{Auth::user()->id}}','{{asset('avatars/')}}/{{$chat->personTwo->id == Auth::user()->id ? $chat->personOne->avatar : $chat->personTwo->avatar }}'),updateMessagesReadStatus('{{$chat->id}}','{{Auth::user()->id}}')"> 
                            <div style="">
                              <img src="{{asset('avatars/')}}/{{$chat->personTwo->id == Auth::user()->id ? $chat->personOne->avatar : $chat->personTwo->avatar }}" style="width: 50px !important;border-radius: 50px;" > 
                              <span>{{$chat->personTwo->id == Auth::user()->id ? $chat->personOne->username : $chat->personTwo->username }}</span>
                            </div>
                          </td>
                          <td style="width: 20%;padding: 0px !important;" class="message-td" >
                              <div style="line-height: 3;text-indent: 10px;">{{ $chat->updated_at->diffForHumans() }}</div>
                          </td>
                        </tr>
                      @endforeach
                    @endif
                    {{-- end test --}}
                    
                  </tbody>
                </table>


                
            </div>


        </div>

        {{-- for mobile devices --}}
        <div class="row" id="for-mobile-devices">

            <div class="col-sm-12">
             <h4>Conversation  List</h4> 

                <div class="list-group">



                 @if(count($userChats)>0)
                    @foreach($userChats as $mbConvers )
                      <span  class="list-group-item list-group-item-action flex-column align-items-start" onclick="populateAndShowMessageDiv('{{$mbConvers->personTwo->id == Auth::user()->id ? $mbConvers->personOne->id : $mbConvers->personTwo->id }}',
                      '{{$mbConvers->personTwo->id == Auth::user()->id ? $mbConvers->personOne->username : $mbConvers->personTwo->username }}','{{Auth::user()->id}}','{{asset('avatars/')}}/{{$mbConvers->personTwo->id == Auth::user()->id ? $mbConvers->personOne->avatar : $mbConvers->personTwo->avatar }}'),updateMessagesReadStatus('{{$mbConvers->id}}','{{Auth::user()->id}}')">
                        <img src="{{asset('avatars/')}}/{{$mbConvers->personTwo->id == Auth::user()->id ? $mbConvers->personOne->avatar : $mbConvers->personTwo->avatar }}" style="width: 50px !important;border-radius: 50px;position: absolute;" >
                        <div class="d-flex justify-content-between"  style="margin-left: 55px;">
                          <h5 class="mb-1 text-info">
                            {{$mbConvers->personTwo->id == Auth::user()->id ? $mbConvers->personOne->username : $mbConvers->personTwo->username }}
                            
                            @if(count(\App\Message::where(['conversation_id'=>$mbConvers->id,'receiver_id'=>Auth::user()->id,'read_status'=>'unread'])->get())>0)
                            <span class="badge span-message-count-{{$mbConvers->id}}" style="background:#2cc011;color: #fff;">
                                {{count(\App\Message::where(['conversation_id'=>$mbConvers->id,'read_status'=>'unread'])->get())}}
                            </span>
                            @endif
                        </h5>
                          <small>{{$mbConvers->created_at->hour.":".
                          ($mbConvers->created_at->minute < 10 ? "0".$mbConvers->created_at->minute : $mbConvers->created_at->minute)}}</small>
                        </div>
                        <small class="mb-1" style="margin-left: 55px;">{{ substr($mbConvers->messages[count($mbConvers->messages)-1]['text'], 0,20)}} ....</small>
                      </span>
                    @endforeach
                @else
                  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <p class="mb-1">No chats available</p>
                  </a>
                @endif


                </div>
            </div>
        </div>
    </div>

</section>

{{-- new --}}
        <div class="l_news_item" id="message-div">
            <div style="padding: 4%;" >
                <img  src="{{asset('avatars/male-icon.png')}}" width="50" class="{{ URL::to('/')}}" height="50" id="user-profile-image-display" style="border-radius: 50px;">&nbsp;<span id="receiver_username"></span> 
                <span onclick="HideMessageDiv()" style="float:right; font-size: 20px;">
                    <i class="fa fa-close"></i>
                </span>
            </div>

            <div class="post_view" id="conversation-list-holder">
                <div id="conversation-list"></div>
        </div>

            <div class="container">
                <div class="form-group row" style="margin-bottom: 2%;padding-left: 2%;">
                    <input type="hidden" id="receiver_id">
                    <input type="hidden" id="sender_id">
                    <textarea class="form-control col-md-10 col-sm-12" id="sender_message" style="" placeholder="Send Message"></textarea>
                    <div class="col-md-2 col-sm-12" id="send-message-btn-div">
                            <button type="button" class="btn btn-default" style="background: #fff;" id="btn-send-message" onclick="SendMessage();">
                                <i class="fa fa-send"></i>
                            </button>
                    </div>

                </div>

            </div>
        </div>
{{-- new --}}
@include('partials.footer')
<script>

function fetchCoversations(sender,receiver){
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
                // console.log(response);
                PNotify.removeAll();
                var user_conversations =response.user_conversations;

                returnUserCoversationList(user_conversations,sender);

                if (response.confirmed=="true") {
                        returnUserCoversationList(user_conversations,sender);
                }
                $("#spinner-login-"+receiver).hide();

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


function deleteConversationAndMessages(){

  PNotify.removeAll();
  var conversation_ids=[];
  $("input.row_checkbox").each(function(){
    if ($(this).is(":checked")) {
      conversation_ids.push($(this).val());
    }
  });

  if (conversation_ids.length>0) {
    $("#delete-all-chats").addClass("disabled");
    $("#spinner_delete_conversations").show();

    $.ajax({

        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },

        type:'POST',

        data:{conversation_ids:conversation_ids},

        url: '{{route('delete-conversations')}}',

        success:function(response){
            // console.log(response);
            PNotify.removeAll();
            $("#delete-all-chats").removeClass("disabled");
            $("#spinner_delete_conversations").hide();
            if(response.status=='success'){
                new PNotify({
                    text: response.message,
                    animate_speed: 'fast',
                    type: 'success'
                });
                setTimeout(function(){
                  location.reload();
                },1000);

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
      new PNotify({
          text: 'Select atleast one conversation to delete' ,
          animate_speed: 'fast',
          type: 'info'
      });
  }

  // console.log(conversation_ids);
}



$(document).ready( function () {
    $('#myTable').DataTable();
} );


function updateMessagesReadStatus(conversation_id,logged_in_user_id){
    if (conversation_id!==null && conversation_id!=="" && logged_in_user_id!=="" && logged_in_user_id!==null) {

            $.ajax({

                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },

                type:'POST',

                data:{conversation_id:conversation_id,logged_in_user_id:logged_in_user_id},

                url: '{{route('update-message-read-status')}}',

                success:function(response){
                    $(".span-message-count-"+conversation_id).html("0");
                    $(".span-message-count-"+conversation_id).hide();


                },

                error:function(response){
                }

            });
    }
}


</script>
</body>
</html>
