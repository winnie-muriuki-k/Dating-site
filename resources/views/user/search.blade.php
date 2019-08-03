
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
<section class="latest_news_area p_120">
    <div class="container">
              <div class="row  col-md-10 col-sm-12" style="margin: auto;">
                <p style="color: white;margin: 0px auto; text-align: center;">Search your type.</p>
              </div>
        <div class="row"  id="search_form"  >
              
            <div class="l_news_item col-md-10 col-sm-12" style="box-shadow: 9px 10px 10px 10px #818181; background: #f9f9ff; padding: 37px 12px;margin:auto; border-radius: 2%">
                <div class=" tabs-title">
                    <button class="tablinks" id="keyword" ><p style="font-weight: bold;margin: 3px !important;padding: 0px !important;">Keyword Search </p> </button>
                    <button class="tablinks" id="advanced" ><p style="font-weight: bold;margin: 3px !important;padding: 0px !important;">Advanced Search</p></button>
                    <button class="tablinks" id="username" style ="width: 33.3%"><p style="font-weight: bold;margin: 3px !important;padding: 0px !important;">Username Search</p></button>
                </div>

                <div class="wrapper" style="padding: 2%; border: 3px solid #3e8000">

                <div class="row" style="padding: 1% ; border-bottom: 1px solid #c3bdc2; margin-bottom: 2%"> <h6  class='vokeh_label search_pages_header' style="color: #3e8000;">Simple Search</h6></div>
                    <div class=" form-wrapper" style="padding: 0% 0% 0% 5%;">

                <form class="search_user_form">
                 <div class="simple_search" >
                  <div class="form-group row" >
                    <label for="gender" class=" vokeh_label col-sm-3 col-form-label">I am</label>
                    <div class="col-sm-6 col-sm-offset-4">
                      <select class="form-control required" id="gender" name="gender">
                          <option value="">--Select--</option>
                          @foreach($genders as $gender)
                              <option value="{{$gender->name}}">{{$gender->name}}</option>
                         @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="seeking" class="vokeh_label col-sm-3 col-form-label">I'm seeking a</label>
                    <div class="col-sm-6 col-sm-offset-4">
                        <select class="form-control required" name="looking_for" id="gender">
                            <option value="">--Select--</option>
                            <option value="male">Male</option>
                            <option value="female">female</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="seeking" class="vokeh_label col-sm-3 col-form-label">Aged Between</label>
                    <div class="col-sm-3 col-sm-offset-2">
                          <select class="form-control required" name="age_starting" id="starting">
                              <option value="">--Select--</option>
                              @for($i=18; $i<100;$i++)
                              <option value="{{$i}}" >{{$i}}</option>
                              @endfor
                          </select>
                    </div>
                    <div class="col-sm-3 col-sm-offset-2">
                          <select class="form-control required" name="age_ending" id="ending">
                              <option value="">--Select--</option>
                              @for($i=18; $i<100;$i++)
                              <option value="{{$i}}" >{{$i}}</option>
                              @endfor
                          </select>
                    </div>

                  </div>
                  <div class="form-group row">
                    <label for="seeking" class="vokeh_label col-sm-3 col-form-label">Living in:</label>
                    <div class="col-sm-3 col-sm-offset-2">
                        <select class="form-control required" name="living_in_country" >
                            <option value="">Select Country</option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}" >{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3 col-sm-offset-2">
                          <select class="form-control required"   name="living_in_city" id="state">
                             @foreach($cities as $city)
                              <option value="{{$city->id}}">{{$city->name}}</option>
                                 @endforeach
                          </select>
                        <input class="form-control required" type="hidden" value="0" name="is_advanced_search" id="search_switch">
                    </div>


                    
                  </div>
                     <div class="form-group row">
                         <label for="seeking" class="vokeh_label col-sm-3 col-form-label">Has photo ?</label>
                         <div class="col-sm-6 col-sm-offset-4">
                             <input class="required" type="checkbox" name="has_photo">
                             <span>Yes, only show profiles with a photo.</span>
                         </div>

                     </div>

                     <div class="form-group row" >
                         <label for="gender" class="vokeh_label col-sm-3 col-form-label">Last Active</label>
                         <div class="col-sm-6 col-sm-offset-4">
                             <select class="form-control required" id="gender" name="last_seen">
                                 <option value="0">Any</option>
                                 <option value="7">Within a Week</option>
                                 <option value="30">within 1 Month</option>
                                 <option value="180">Within 6 Months</option>
                                 <option value="365">Within Year</option>

                             </select>
                         </div>
                     </div>
                     <div class="form-group row">
                         <label for="seeking" class="vokeh_label col-sm-3 col-form-label">Searching for :</label>
                         <div class="col-sm-6 col-sm-offset-4">
                             @foreach($motives as $motive)
                                 <div class="col-sm-6">
                                     <input type="radio" class="required" name="search_motive" value="{{$motive->id}}"> <span>{{$motive->name}}</span>
                                 </div>
                             @endforeach
                         </div>

                     </div>
                     <div class="form-group row" >
                         <label for="gender" class="vokeh_label col-sm-3 col-form-label">Sort Results By</label>
                         <div class="col-sm-6 col-sm-offset-4">
                             <select class="form-control required" id="gender" name="sort_results">
                                 <option value="1">Newest Members</option>
                                 <option value="2">Photos First</option>
                                 <option value="3">Last Active</option>
                             </select>
                         </div>
                     </div>
                    </div>
                <div class="advanced-search" style="display: none;">

                   <div class="row">
                   <div class="col-sm-12" style="background: #e7f5e7!important;">
                       <p class="pull-left" style="font-weight: bold;margin: 3px !important;padding: 0px !important;">Their Background / Cultural Values</p>
                       <p class="pull-right" style="font-weight: bold;margin: 3px !important;padding: 0px !important;">Expand Section</p>
                       
                   </div>
                    <div class="col-sm-12">
                        <div class="panel-group" id="accordion">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <span class="panel-title">
                                <i class="fa fa-arrow-circle-right"></i> &nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                Nationality</a>
                              </span>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse in">
                              <div class="panel-body" style="background: #f3f5f3;padding:15px;">
                                  <div class="row">
                                      <div class="form-group col-md-4 col-sm-6">
                                          <select class="form-control" name="from_country" id="nationality">
                                              <option value="">Select Country</option>
                                              @foreach($countries as $country)
                                                  <option value="{{$country->id}}" >{{$country->name}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <span class="panel-title">
                                <i class="fa fa-arrow-circle-right"></i> &nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                Tribe</a>
                              </span>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body" style="background: #f3f5f3;padding:15px;">
                                    <div class="row">
                                          <div class="form-group col-md-4 col-sm-6">
                                              <select class="form-control" name="nationality" id="nationality">
                                                  <option value="">--Select--</option>
                                              </select>
                                          </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <span class="panel-title">
                                <i class="fa fa-arrow-circle-right"></i> &nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                Education (or Above)</a>
                              </span>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                              <div class="panel-body" style="background: #f3f5f3;padding:15px;">
                                <div class="row">
                                      <div class="form-group col-md-4 col-sm-6">
                                          <select class="form-control" name="education_level" id="education">
                                        <option value="-1" selected="">Any</option>
                            
                                        <option value="312,313,314,315,316,317,318">Primary (Elementary) School</option>
                                    
                                        <option value="313,314,315,316,317,318">Middle School / Junior High</option>
                                    
                                        <option value="314,315,316,317,318">High School</option>
                                    
                                        <option value="315,316,317,318">Vocational College</option>
                                    
                                        <option value="316,317,318">Bachelors Degree</option>
                                    
                                        <option value="317,318">Masters Degree</option>
                                    
                                        <option value="318">PhD or Doctorate</option>          
                                          </select>
                                      </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          {{-- start --}}
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <span class="panel-title">
                                <i class="fa fa-arrow-circle-right"></i> &nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                Language Spoken</a>
                              </span>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse">
                              <div class="panel-body" style="background: #f3f5f3;padding:15px;">
                                <div class="row">
                                      <div class="form-group col-md-4 col-sm-6">
                                          <select class="form-control" name="education" id="education">
                                            @include('partials.languages')
                                          </select>
                                      </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          {{-- end --}}
                          {{-- start --}}
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <span class="panel-title">
                                <i class="fa fa-arrow-circle-right"></i> &nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">English Ability or Above</a>
                              </span>
                            </div>
                            <div id="collapse5" class="panel-collapse collapse">
                              <div class="panel-body" style="background: #f3f5f3;padding:15px;">
                                <div class="row">
                                      <div class="form-group col-md-4 col-sm-6">
                                          <select class="form-control" name="english_ability" id="english_ability">
                                        <option value="-1" selected="">Any</option>
                            
                                        <option value="928,735,734,733,732">None</option>
                                    
                                        <option value="735,734,733,732">Some</option>
                                    
                                        <option value="734,733,732">Good</option>
                                    
                                        <option value="733,732">Very Good</option>
                                    
                                        <option value="732">Fluent</option>
                                          </select>
                                      </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          {{-- end --}}
                        </div>
                        
                    </div>
                   </div>
                   <div class="row">
                       
                   </div><br>
                </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <button class="btn btn-success btn-sm" id="btn-search" type="button" onclick="AdvancedSearchUser()" style="width: 200px !important;">
                                Search &nbsp;<i class="spinner" id="spinner-search" style="display: none;"></i></button>
                            </button>
                        </div>
                    </div>
                </form>
                    </div>

                
            </div>
            </div>


        </div> <br>
        <div class="row" id="show_search_results" style="display: none;"  >

             <div class="l_news_item col-md-6" style="padding: 20px !important; margin:auto;" >
                 <div class="row"><div class="col-md-8"><h3 style="font-weight: bold; color: #3e8000;">Search Results</h3></div> <div class="col-md-4"><button class="search-back btn-default"> Back</button></div></div>

                 <div class="row" id="display-search-results">

                 </div>

             </div>
            
        </div>
    </div>

</section>
@include('partials.footer')
<script>

    $(function() {
        $('#keyword').addClass('active-tablink');
       $('.tablinks').on('click', function () {
           if($(this).attr('id')=='advanced') {
               $('.advanced-search').css('display', 'block');
               $('.search_pages_header').empty().html('Advanced Search');
               $(this).addClass('active-tablink');
               $('#keyword').removeClass('active-tablink');
               $('#search_switch').val('1');
           }
           else if($(this).attr('id')=='keyword'){
               $('.advanced-search').css('display', 'none');
               $('.search_pages_header').empty().html('Simple Search');
               $(this).addClass('active-tablink');
               $('#advanced').removeClass('active-tablink');
               $('#search_switch').val('0');
           }

       })
    });


    $('.search-back').on('click', function () {
        $("#display-search-results").html('');
        $("#search_form").show();
        $("#show_search_results").hide();

    });
    let form_data = {};
    let errors = [];
    function AdvancedSearchUser(){
        PNotify.removeAll();
        $('.simple_search').find('.required').each( function (){
            if($(this).val() !='') {
                form_data[$(this).attr('name')] = $(this).val();
            }else{
                $(this).css('border-color', 'red');
                errors.push($(this).attr('name'));
            }

        });

        $('.advanced-search').find('.form-control').each( function (){
            if($(this).val() !='') {
                form_data[$(this).attr('name')] = $(this).val();
            }

        });

        if(errors.length>1){
            console.log(errors);
            new PNotify({
                text: "Please fill in all the highlighted fields",
                animate_speed: 'fast',
                type: 'info'
            });
        }else{
            console.log(form_data);

            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                type:'POST',

                data: form_data,

                url: '{{route('user-search')}}',

                success:function(response){
                   // alert('results coming');
                   // $("#spinner-search").hide();
                    // console.log(response);

                    if(response.status=='success'){
                        var data =response.data;
                        console.log(data.length);
                        if (data.length>0) {
                            var str = "";

                            for (var i = data.length - 1; i >= 0; i--) {
                                var str1 =`
                                 <div class="col-md-4" id="div-match-${data[i].id}">

                                    <div class="l_news_item   member-profile-holder">
                                        <div class="row">
                                            <img src="http://localhost:8000/avatars/${data[i].avatar}" class="img-responsive" alt=""  style="width: 150px;height: 150px;border: 1px solid #bebebe; margin: auto;">
                                        </div>



                                      <div class="post_view" style="display: inline-block;">
                                          <div style="margin-bottom: 5px;"
                                          <span style="font-weight: bold;">${data[i].username}, &nbsp;${data[i].age}</span>
                                          </div>

                                              <i class="fa fa-info-circle user-information" style="font-size: 25px;margin-right: 5px;"
                                              aria-hidden="true" id="view-more-user-information" title="View profile and interests"
                                              onclick="showUserInformationOntheModal('${data[i].id}')"></i>


                                              <i class="fa fa-send" title="message ${data[i].username}" style="font-size: 25px;color: #57a700;margin-right: 5px;"
                                              aria-hidden="true" onclick="populateAndShowMessageDiv('${data[i].id}','${data[i].username}','{{Auth::user()->id}}')">
                                              </i>

                                              <i title="like ${data[i].username}"
                                              class="fa fa-heart favorite-icon" id="fa-heart-2" style="color: #3654ee;font-size: 25px;"
                                              aria-hidden="true" onclick="Matchuser('{{Auth::user()->id}}','${data[i].id}')"></i>

                                      </div>
                                    </div>
                                 </div>

                  `;
                                str+=str1
                            }
                            $("#display-search-results").html(str);
                            $("#search_form").hide();
                            $("#show_search_results").show();


                        }else{
                            $("#display-search-results").html('<h6> No results Found!</h6>');
                            $("#show_search_results").show();
                            $("#search_form").hide();
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
                    $("#spinner-search").hide();
                    $("#display-search-results").hide();
                    $("#display-search-results").html("");
                }

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

</script>
</body>
</html>
