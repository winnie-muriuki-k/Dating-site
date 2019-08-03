
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="<?php echo e(asset('img/favicon.png')); ?>" type="image/png">
        <title>Dating App</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('temp/css/bootstrap.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('temp/vendors/linericon/style.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('temp/css/font-awesome.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('temp/vendors/owl-carousel/owl.carousel.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('temp/vendors/lightbox/simpleLightbox.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('temp/vendors/nice-select/css/nice-select.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('temp/vendors/animate-css/animate.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('temp/vendors/popup/magnific-popup.css')); ?>">
        <!-- main css -->
        <link rel="stylesheet" href="<?php echo e(asset('temp/css/style.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('temp/css/responsive.css')); ?>">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo e(asset('css/pnotify.custom.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/custom-css.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/main.css')); ?>">
    </head>
    <body data-spy="scroll" data-target="#mainNav" data-offset="70" onload="doSomeWindowAdjustments()" onchange="doSomeWindowAdjustments()">
        <?php echo $__env->make('partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <section class="latest_news_area p_120" style="padding-bottom: 0px !important; background: #b3b3b3 !important;">
        	<div class="container">
        		<div class="row">
                    <div class="col-md-3 col-sm-12">

                        <div class="col-md-12  col-sm-12">
                            <div class="card">

                              <img class="card-img-top" src="<?php echo e(asset('avatars/')); ?>/<?php echo e(Auth::user()->avatar); ?>" onclick="window.location.href='<?php echo e(route('edit-profile')); ?>'" style="cursor: pointer;" 
                               title="Edit profile picture"  id="logged_in_user_profile_pic" alt="Profile Picture">
                              <div class="card-body">
                                <p class="card-text">
                                    <i class="fa fa-user"></i>&nbsp;
                                    <?php echo e(!empty(Auth::user()->username) ? Auth::user()->username : 'Set Username'); ?><br>
                                    <i class="fa fa-edit"></i>&nbsp;
                                    <a href="<?php echo e(route('edit-profile')); ?>" > Edit profile.</a>
                                    <br>
                                     Profile visitors count = <span style="color: green;"><?php echo e($visitorsCount); ?></span><br>

                                </p>
                              </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12  col-sm-12">
                            <div class="card">
                              <div class="card-body">
                                    <h4>What s new?</h4>
                                    <hr>

                                    <div class="post_view">
                                        Love is that condition in which the happiness of another person is essential to your own. <br>
                                        <small>Robert A. Heinlein, Stranger in a Strange Land</small>
                                    </div>
                              </div>
                            </div>
                        </div>
                    </div>

             

                    <div class="col-md-8 col-sm-12" id="row-two" style="margin-left: 0px;">

                        <div class="row col-sm-12" id="row-one">
                            <div class="col-md-12">
                                <h4>Recommended Matches</h4>
                            </div>
                            <?php if(count($users)>0): ?>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-3 col-sm-6 outer-profile-holder" id="div-match-<?php echo e($user->id); ?>">
                                    <!------start------>
                                    <!------start------>
<div class="card profile-holder" style="margin-bottom: 2%;" id="profile-display-cards">
  <img class="card-img-top" src="<?php echo e(asset('avatars/')); ?>/<?php echo e($user->avatar); ?>"  id="user-profile-image" style=""
  alt="Profile Image">
  <div class="card-body" style="padding: 0px !important;">
    <p class="card-text text-center" style="margin: 1px !important;">
        <?php echo e(!empty($user->username) ? $user->username : 'No name'); ?>, <strong>&nbsp;<?php echo e($user->age); ?>&nbsp;</strong>yrs <br>

        <span class="text-info">
            <?php echo e(!empty($user->profile->city) ? $user->profile->city->name : ""); ?>

            <?php echo e(!empty($user->profile->country) ? "," . $user->profile->country->name : ""); ?>

        </span>
    </p>

    <div style="text-align: center;padding-bottom: 5px;">
        <button type="button" class="btn btn-info btn-sm">
            <a style="color: white;" href="<?php echo e(route('view-user',['id'=>$user->id])); ?>"> <i class="fa fa-eye user-information" style="    font-size: 20px;" aria-hidden="true" id="view-more-user-information" title="View profile and interests"
        ></i></a>
            
        </button>

        &nbsp;

        <button type="button" class="btn btn-info btn-sm" onclick="populateAndShowMessageDiv('<?php echo e($user->id); ?>','<?php echo e($user->username); ?>','<?php echo e(Auth::user()->id); ?>','<?php echo e(asset('avatars/')); ?>/<?php echo e($user->avatar); ?>')" id="send-message-btn">
        <i class="fa fa-send" title="message <?php echo e(!empty($user->username) ? $user->username : ''); ?>" style="    font-size: 20px;" aria-hidden="true" onclick="">

        </i>
        </button>

        &nbsp;

        <button type="button" class="btn btn-info btn-sm" onclick="Matchuser('<?php echo e(Auth::user()->id); ?>','<?php echo e($user->id); ?>')" id="favorite-user-button">
<i title="like <?php echo e(!empty($user->username) ? $user->username : ''); ?>" class="fa fa-heart favorite-icon" id="fa-heart-<?php echo e($user->id); ?>" style="font-size: 20px;" aria-hidden="true" onclick=""></i>
            
        </button>

        <?php if(!in_array($user->id, $fav_id_array)): ?>
        <button type="button" class="btn btn-info btn-sm" onclick="addFav('<?php echo e(Auth::user()->id); ?>','<?php echo e($user->id); ?>')" id="add_fav_<?php echo e($user->id); ?>">
            <i title="Add <?php echo e(!empty($user->username) ? $user->username : ''); ?> To Favourites" class="fa fa-thumbs-up" id="fa-heart-<?php echo e($user->id); ?>" style="font-size: 20px;" aria-hidden="true" onclick=""></i>

        </button>
        <?php endif; ?>

        &nbsp;



        &nbsp;
        
    </div>
  </div>
</div>  
                                    <!-----end of new code------->
                                    <!-----end of new code------->                                  
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                        </div>
                        <hr>
                            <div class="row">
                                <?php echo e($users->links()); ?>

                            </div>

                    </div>

        		</div>
        	</div>

<!-- Large modal -->


        <div class="l_news_item" id="message-div">
            <div style="padding: 4%;">
                <img src="<?php echo e(asset('avatars/male-icon.png')); ?>" class="<?php echo e(URL::to('/')); ?>" width="50" height="50" id="user-profile-image-display" style="border-radius: 50px;">&nbsp;<span id="receiver_username"></span> 
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
            <table class="table" style="width: 100%;" id="display-information-table"></table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
        <button type="button" onclick="ReportUser()" class="btn btn-danger btn-sm" id="report-user" class="">Report</Button>
      </div>
    </div>
  </div>
</div>


        </section>
        <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

                    url: '<?php echo e(route('user-add-fav')); ?>',

                    success:function(response){
                        PNotify.removeAll();
                        if(response.status=='success'){
                            // new PNotify({
                            //     text: response.message,
                            //     animate_speed: 'fast',
                            //     type: 'success'
                            // });

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

                            url: '<?php echo e(route('user-send-message')); ?>',

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
            function ReportUser(){
                PNotify.removeAll();
                    new PNotify({
                        text: "Work on progress.",
                        animate_speed: 'fast',
                        type: 'info'
                    });
            }

            function returnUnreadMessageCount(user_id){


            }

            function Matchuser(logged_in_user,match_id){
                PNotify.removeAll();
                if (logged_in_user!==null && match_id!==null) {
                    // new PNotify({
                    //     text: "Sending match Request.",
                    //     animate_speed: 'fast',
                    //     type: 'info'
                    // });
                    $.ajax({

                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         },

                        type:'POST',

                        data:{initiator:logged_in_user,recipient:match_id},

                        url: '<?php echo e(route('match-user')); ?>',

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
            function fetchCoversations(sender,receiver){
                // console.log('sender ',sender, '  receiver' ,receiver);
                PNotify.removeAll();
                if (sender!=="" && receiver!=="") {
                    $.ajax({

                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         },

                        type:'POST',

                        data:{sender_id:sender,receiver_id:receiver},

                        url: '<?php echo e(route('user-get-convesations')); ?>',

                        success:function(response){
                            // console.log(response);
                            PNotify.removeAll();
                            var user_conversations =response.user_conversations;

                            if (response.confirmed=="false") {
                                if (response.match_request_status=="pending") {
                                    // new PNotify({
                                    //     text: 'You match request is awaiting confirmation',
                                    //     animate_speed: 'fast',
                                    //     type: 'info'
                                    // });
                                }else{

                                }
                            }

                            returnUserCoversationList(user_conversations,sender);
                            if (response.confirmed=="true") {
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

                        url: '<?php echo e(route('user-update-avatar')); ?>',

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

                        url: '<?php echo e(route('fetch-user-info')); ?>',

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

            url: '<?php echo e(route('clear-user-notifications')); ?>',

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

        url: '<?php echo e(route('confirm-match')); ?>',

        success:function(response){
          console.log(response);

            if(response.status=='success'){

              
                // new PNotify({
                //     text: response.message,
                //     animate_speed: 'fast',
                //     type: 'success'
                // });

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

        url: '<?php echo e(route('user-search')); ?>',

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


 function doSomeWindowAdjustments(){
    if ($(window).width()<=1024 && $(window).width() >=425) {
       $('.outer-profile-holder').removeClass('col-md-3');
       $('.outer-profile-holder').addClass('col-md-4');
    }else{
       $('.outer-profile-holder').addClass('col-md-3');
       $('.outer-profile-holder').removeClass('col-md-4');
    }
    if ($(window).width()<=800 && $(window).width() >=425) {
       $('.outer-profile-holder').removeClass('col-md-3');
       $('.outer-profile-holder').addClass('col-md-6');
    }else{
       $('.outer-profile-holder').addClass('col-md-3');
       $('.outer-profile-holder').removeClass('col-md-6');
    }
 }


        </script>
    </body>
</html>

<?php /* C:\Users\WYN\winnie-project\resources\views/user/dashboard.blade.php */ ?>