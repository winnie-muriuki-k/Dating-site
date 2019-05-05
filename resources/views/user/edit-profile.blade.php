
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
            <div class=" l_news_item col-md-10 edit-profile ">
                <h4> Edit Profile</h4>
                <p>Answering these profile questions will help other users find you in search results and help us to find you more accurate matches.</p>
                <h4> Your Basics</h4>
                <form id="edit-profile-form" action="{{route('edit-profile')}}" method="POST" >
                    @csrf
                    <div class="form-group row">
                        <label for="username" class="col-sm-4 col-form-label">First Name:</label>
                        <div class="col-sm-8">
                            <input type="text" name="username" placeholder="username" class="form-control" value="{{auth::user()->username}}" id="username">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="gender" class="col-sm-4 col-form-label">I am a:</label>
                        <div class="col-sm-8">
                            <select class="form-control">
                              <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="DOB" class="col-sm-4 col-form-label">Date of Birth</label>
                        <div class="col-sm-8" style="display: inline-flex;" id="radio_box">
                                <input type="date" class="form-control" name="dob">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="country" class="col-sm-4 col-form-label">Country</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="country" id="age">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}" >{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="State/Province" class="col-sm-4 col-form-label">City/Town</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="city" id="age">
                                <option value="">Select City</option>

                            </select>
                        </div>
                    </div>
                    <hr>
                    <h4> Your Appearance</h4>
                    <div class="form-group row">
                        <label for="Hair-color" class="col-sm-4 col-form-label">Hair Color</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="hair_color" id="age">
                                <option value="">Select Hair Color</option>
                                @foreach($hair_colors as $hair_color)
                                <option value="{{$hair_color->id}}">{{$hair_color->name}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="Hair-length" class="col-sm-4 col-form-label">Hair Length</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="hair_length" id="">
                                <option value="">Select Hair Length</option>
                                @foreach($hair_lengths as $hairlength)
                                    <option value="{{$hairlength->id}}">{{$hairlength->name}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                     <div class="form-group row">
                        <label for="Hair-length" class="col-sm-4 col-form-label">Hair Type</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="hair_type" id="">
                                <option value="">Select Hair Type</option>
                                @foreach($hair_types as $hairtype)
                                    <option value="{{$hairtype->id}}">{{$hairtype->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Eye-color" class="col-sm-4 col-form-label">Eye Color</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="eye_color" id="">
                                <option value="">Select Eye Color</option>
                                @foreach($eye_colors as $eyecolor)
                                    <option value="{{$eyecolor->id}}">{{$eyecolor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Eye-wear" class="col-sm-4 col-form-label">Eye Wear</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="eye_wear" id="">
                                <option value="">Select Eye Wear</option>
                                @foreach($eye_wears as $eyewear)
                                    <option value="{{$eyewear->id}}">{{$eyewear->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="row">
                        <button class="btn btn-success submit-changes" type="submit" id="btn-register" >Submit Changes &nbsp;<i class="spinner" id="spinner-register" style="display: none;"></i></button>
                    </div>
                </form>


                </div>
            </div>

        </div>
    </div>

</section>
@include('partials.footer')
<script>
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

        })
    });
</script>
</body>
</html>
