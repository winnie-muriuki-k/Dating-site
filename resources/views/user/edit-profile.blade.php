
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
<body data-spy="scroll" data-target="#mainNav" data-offset="70">
@include('partials.header')
<section class="latest_news_area p_120">
    <div class="container">
        <div class="row">
            <div class=" col-md-11 col-sm-12 edit-profile" style="border-radius: 2%; box-shadow: 9px 10px 10px 10px #818181;" >
                <div class="row tabs-title" style ="text-align: center;margin:auto" >
                    <button class="tablinks" id="profile" ><p style="font-weight: bold;margin: 3px !important;padding: 0px !important;">Profile </p> </button>
                    <button class="tablinks" id="interests" ><p style="font-weight: bold;margin: 3px !important;padding: 0px !important;">Interests and Hobbies</p></button>
                    <button class="tablinks" id="photos" style="width: 34%;"><p style="font-weight: bold;margin: 3px !important;padding: 0px !important;">Add Photos</p></button>
                </div>
                <div class="profile" style="border: 4px solid rgb(62, 128, 0);padding: 1%;">

                <h4 class="text-info text-center "> Edit Profile</h4>
                <p class="text-center">Answering these profile questions will help other users find you in search results and help us to find you more accurate matches.</p>
                    <hr>
                <h4 class="text-info">Basic Information</h4>

                <form id="edit-profile-form" action="{{route('edit-profile')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-3 col-sm-12" style="text-align: center;">
                            <img id="profile-image" src="{{asset('avatars/')}}/{{Auth::user()->avatar}}" width="100" height="100">
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="username">Edit Profile picture</label>
                            <input type="file" onchange="readURL(this);" name="profile_image">
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="username">Phone number</label>
                            <input type="text" class="form-control" name="phonenumber" value="{{auth::user()->phonenumber}}" placeholder="phonenumber">
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="gender">Interested in</label>
                            <select class="form-control" name="seeking_id">
                                <option value="">--select--</option>
                                          @foreach($gender as $g)
                    <option {{!empty(auth::user()->seeking_id)& auth::user()->seeking_id ==$g->id ? "selected=selected": "" }}  value="{{$g->id}}">{{$g->name}}</option>
                                          @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-md-3 col-sm-12">
                            <label for="username">Username</label>
                            <input type="text" name="username" placeholder="username" class="form-control" value="{{auth::user()->username}}" id="username">
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="gender">Gender</label>
                            <select class="form-control" name="gender">
                                <option value="">--select--</option>
 <option {{auth::user()->gender=="male" ? 'selected=selected' :''}} value="male">Male</option>
<option {{auth::user()->gender=="female" ? 'selected=selected' :''}} value="female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="DOB" >Date of Birth</label>
                            <input type="date" class="form-control" name="dob" value="{{!empty(auth::user()->dob) ? auth::user()->dob :''}}">
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="country">Country</label>
                            <select class="form-control" name="country" id="country">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
<option {{!empty($userProfile)&& !empty($userProfile->country_id)  && $userProfile->country_id ==$country->id ? "selected=selected": "" }} 
                                        value="{{$country->id}}" >{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!----new -->
                    <hr>
                    <h4 class="text-info">Your Appearance and lifestyle</h4>
                    <div class="form-group row ">
                        <div class="col-md-3 col-sm-12">
                            <label for="Hair-color" class="">Hair Color</label>
                            <select class="form-control" name="hair_color" id="age">
                                <option value="">Select Hair Color</option>
                                @foreach($hair_colors as $hair_color)
                                <option {{!empty($userProfile)&& !empty($userProfile->hair_color_id) 
                                        && $userProfile->hair_color_id ==$hair_color->id ? "selected=selected": "" }} 
                                value="{{$hair_color->id}}">{{$hair_color->name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12">
                        <label for="Hair-length">Hair Length</label>
                            <select class="form-control" name="hair_length" id="">
                                <option value="">Select Hair Length</option>
                                @foreach($hair_lengths as $hairlength)
                                    <option {{!empty($userProfile)&& !empty($userProfile->hair_length_id) 
                                        && $userProfile->hair_length_id ==$hairlength->id ? "selected=selected": "" }}
                                    value="{{$hairlength->id}}">{{$hairlength->name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12">
                        <label for="Hair-length">Hair Type</label>
                            <select class="form-control" name="hair_type" id="">
                                <option value="">Select Hair Type</option>
                                @foreach($hair_types as $hairtype)
                                    <option {{!empty($userProfile)&& !empty($userProfile->hair_type_id) 
                                        && $userProfile->hair_type_id ==$hairtype->id ? "selected=selected": "" }}
                                    value="{{$hairtype->id}}">{{$hairtype->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12">
                          <label for="Eye-color">Eye Color</label>
                          <select class="form-control" name="eye_color" id="">
                                <option value="">Select Eye Color</option>
                                @foreach($eye_colors as $eyecolor)
                                    <option {{!empty($userProfile)&& !empty($userProfile->eye_color_id) 
                                        && $userProfile->eye_color_id ==$eyecolor->id ? "selected=selected": "" }}
                                    value="{{$eyecolor->id}}">{{$eyecolor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!----new -->
                    <div class="form-group row ">
                        <div class="col-md-3 col-sm-12">
                            <label for="Eye-wear">Eye Wear</label>
                            <select class="form-control" name="eye_wear" id="">
                                <option value="">Select Eye Wear</option>
                                @foreach($eye_wears as $eyewear)
                                    <option {{!empty($userProfile)&& !empty($userProfile->eye_wear_id) 
                                        && $userProfile->eye_wear_id ==$eyewear->id ? "selected=selected": "" }}
                                    value="{{$eyewear->id}}">{{$eyewear->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="height">Height</label>
                            <select class="form-control" name="height" id="">
                                <option value="">--select--</option>
                                @foreach($heights as $height)
<option {{!empty($userProfile)&& !empty($userProfile->height_id) 
                                        && $userProfile->height_id ==$height->id ? "selected=selected": "" }} value="{{$height->id}}">{{$height->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="weight">Weight</label>
                            <select class="form-control" name="weight" id="">
                                <option value="">--select--</option>
                                @foreach($weights as $weight)
 <option {{!empty($userProfile)&& !empty($userProfile->weight_id) 
                                        && $userProfile->weight_id ==$weight->id ? "selected=selected": "" }} value="{{$weight->id}}">{{$weight->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="body_type">Body Type</label>
                            <select class="form-control" name="body_type" id="">
                                <option value="">--select--</option>
                                @foreach($body_types as $body_type)
<option {{!empty($userProfile)&& !empty($userProfile->body_type_id) 
                                        && $userProfile->body_type_id ==$body_type->id ? "selected=selected": "" }} value="{{$body_type->id}}">{{$body_type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{--<div class="form-group row">--}}
                        {{--<label for="State/Province" class="col-sm-4 col-form-label">City/Town</label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<select class="form-control" name="city" id="age">--}}
                                {{--<option value="">Select City</option>--}}

                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="form-group row">

                        <div class="col-md-3 col-sm-12">
                        <label for="ethnicity">Your Ethnicity</label>
                            <select class="form-control" name="ethnicity" id="">
                                <option value="">--select--</option>
                                @foreach($ethnicities as $ethnicity)

                                    <option {{!empty($userProfile)&& !empty($userProfile->ethnicity_id) 
                                        && $userProfile->ethnicity_id ==$ethnicity->id ? "selected=selected": "" }}  value="{{$ethnicity->id}}">{{$ethnicity->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 col-sm-12">
                            <label for="Complexion">Complexion</label>
                            <select class="form-control" name="complexion" id="">
                                <option value="">Select your complexion </option>
                                @foreach($complexions as $complexion)
                                    <option {{!empty($userProfile)&& !empty($userProfile->ethnicity_id) 
                                        && $userProfile->ethnicity_id ==$complexion->id ? "selected=selected": "" }}  value="{{$complexion->id}}">{{$complexion->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 col-sm-12">
                            <label for="facial-hair">Facial Hair</label>
                            <select class="form-control" name="facial_hair_type" id="">
                                <option value="">--select-- </option>
                                @foreach($facial_hair_types as $type)
                                    <option {{!empty($userProfile)&& !empty($userProfile->facial_hair_type_id) 
                                        && $userProfile->facial_hair_type_id ==$type->id ? "selected=selected": "" }} value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 col-sm-12">
                        <label for="best-feature">My Best Feature</label>
                            <select class="form-control" name="best_feature" id="">
                                <option value="">--select--</option>
                                @foreach($best_features as $type)
                                    <option {{!empty($userProfile)&& !empty($userProfile->best_feature_id) 
                                        && $userProfile->best_feature_id ==$type->id ? "selected=selected": "" }}   value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 col-sm-12">
                            <label for="body-art" >Body Art</label>
                            <select class="form-control" name="body_art" id="">
                                <option value="">--select--</option>
                                @foreach($body_arts as $type)
                                    <option {{!empty($userProfile)&& !empty($userProfile->body_art_id) 
                                        && $userProfile->body_art_id ==$type->id ? "selected=selected": "" }}  value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12">
                        <label for="beauty-level">I consider my appearance as:</label>
                            <select class="form-control" name="beauty_level" id="">
                                <option value="">--select--</option>
                                @foreach($beauty_levels as $type)
                                    <option {{!empty($userProfile)&& !empty($userProfile->beauty_level_id) 
                                        && $userProfile->beauty_level_id ==$type->id ? "selected=selected": "" }}  value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12">
                                <label for="drink-status">Do you Drink?</label>
                                <select class="form-control" name="drink_status" id="">
                                    <option value="">--select--</option>
                                    @foreach($drinking_statuses as $type)
                                        <option  value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="smoke-status">Do you Smoke</label>
                                <select class="form-control" name="smoke_status" id="">
                                    <option value="">--select-- </option>
                                    @foreach($smoking_statuses as $type)
                                        <option   value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>




                    <div class="row form-group">
                        <div class="col-md-4 col-sm-12">
                        <button class="btn btn-success" type="submit">Update Profile</button>
                            
                        </div>
                    </div>
                </form>
                </div>
                <div class="interests" style="display: none; border: 4px solid rgb(62, 128, 0); padding: 1%;">
                    <h4 class="text-info text-center "> Edit  Interests & Hobbies   </h4>
                    <p class="text-center">Let others know what your interests are and help us connect you with other users that may have similar interests.</p>
                    <form id="edit-profile-form" onsubmit="editInterests(event)" method="POST" enctype="multipart/form-data">
                        @csrf
                        <hr>
                        <div class="form-group row hobbies">
                            <div class="col-md-3 col-sm-12 text-center" >
                                <img id="profile-image" src="{{asset('avatars/')}}/{{Auth::user()->avatar}}" style="width: 66%;height: 66%;">
                                <br>
                                <h4 class="text-info text-center ">{{Auth::user()->username}}</h4>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label class="vokeh_label" for="username">What do you do for fun / entertainment?</label>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="row">
                            @foreach($hobbies as $hobby)
                                <div class="col-md-6 col-sm-12">
                                    <input type="checkbox" class="hobby" value="{{$hobby->id}}" {{in_array($hobby->id, $hobbies_id_array)?'checked':''}}> <span>{{$hobby->name}}</span>
                                </div>
                            @endforeach
                            </div>
                            </div>

                        </div>
                        <hr>
                        <div class="form-group row foods">
                            <div class="col-md-3 col-sm-12">
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label class="vokeh_label" for="username">What sort of food do you like?</label>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="row">
                                    @foreach($foods as $food)
                                        <div class="col-md-6 col-sm-12">
                                            <input type="checkbox" class="food" value="{{$food->id}}" {{in_array($food->id, $food_id_array)?'checked':''}}> <span>{{$food->name}}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="form-group row music">
                            <div class="col-md-3 col-sm-12">
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label class="vokeh_label" for="username">What sort of music are you into?</label>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="row">
                                    @foreach($music_types as $type)
                                        <div class="col-md-6 col-sm-12">
                                            <input type="checkbox" class="music" value="{{$type->id}}" {{in_array($type->id, $music_id_array)?'checked':''}}> <span>{{$type->name}}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                        <hr>
                        <div class="form-group row sports">
                            <div class="col-md-3 col-sm-12">
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label class="vokeh_label" for="username">What sports do you play or like to watch?</label>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="row">
                                    @foreach($sports as $sport)
                                        <div class="col-md-6 col-sm-12">
                                            <input type="checkbox" class="sport" value="{{$sport->id}}" {{in_array($sport->id, $sports_id_array)?'checked':''}}> <span>{{$sport->name}}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 col-sm-12">
                                <button class="btn btn-success" type="submit" style="float: right;">Update Interests</button>

                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>

        </div>
    </div>

</section>
@include('partials.footer')
<script>

    $(function() {
        $('#profile').addClass('active-tablink');
        $('.tablinks').on('click', function () {
            if($(this).attr('id')=='interests') {
                $('.interests').css('display', 'block');
                $(this).addClass('active-tablink');
                $('.profile').css('display', 'none');
                $('#profile').removeClass('active-tablink');
            }
            else if($(this).attr('id')=='profile'){
                $('.interests').css('display', 'none');
                $(this).addClass('active-tablink');
                $('#interests').removeClass('active-tablink');
                $('.profile').css('display', 'block');

            }

        })

    });
    function editInterests(e){
        e.preventDefault();
        let hobbies = '';
        let foods = '';
        let music = '';
        let sports = '';
        $('.hobbies').find('input.hobby').each(function() {
            if($(this).prop('checked')==true){
                hobbies += $(this).val()+',';
            }
        });
        $('.foods').find('input.food').each(function() {
            if($(this).prop('checked')==true){
                foods += $(this).val()+',';
            }
        });

        $('.music').find('input.music').each(function() {
            if($(this).prop('checked')==true){
                music += $(this).val()+',';
            }
        });

        $('.sports').find('input.sport').each(function() {
            if($(this).prop('checked')==true){
                sports += $(this).val()+',';
            }
        });
        // console.log(hobbies);
        // console.log(music);
        // console.log(sports);
        // console.log(foods);

        $.ajax({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            type:'POST',

            data: {
                    hobbies:hobbies,
                    foods:foods,
                    sports:sports,
                    music:music,
            },

            url: '{{route('edit-interests')}}',

            success:function(response){
                if(response.status=='success'){
                    new PNotify({
                        text: response.message,
                        animate_speed: 'fast',
                        type: 'info'
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
                $("#spinner-search").hide();
                $("#display-search-results").hide();
                $("#display-search-results").html("");
            }

        });
    }

    $(function() {
        $('select[name=country]').change(function() {
            var country_id = $(this).val();
            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                type:'GET',

                url: '/country/'+country_id+'/cities',


                success:function(data) {
                    var select = $('form select[name= city]');

                    select.empty();

                    $.each(data,function(key, value) {
                        select.append('<option value=' + value.id + '>' + value.name + '</option>');
                    });
                }

            });
        });

        $('#edit-profile-form').on('submit',function(e){
            var errors = [];
            $(this).find(".form-control").each(function(){
                if ($(this).val()==""||$(this).val()==null|| $(this).val()==undefined) {
                    e.preventDefault();
                    $(this).css("borderColor","red");
                    errors.push($(this).attr('name'));

                }
            });
            if(errors.length>0){
                new PNotify({
                    text: 'Please fill in all the fields',
                    animate_speed: 'fast',
                    type: 'info'
                });
            }

        });

        $('.form-control').on('change', function () {

            if ($(this).val()!='' || $(this).val()!=null )
            {
                $(this).css("borderColor","#ced4da");
            }

        })

    });




    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#profile-image')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
</body>
</html>
