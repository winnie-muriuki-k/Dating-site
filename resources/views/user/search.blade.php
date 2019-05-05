
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
        <div class="row"  id="search_form" >
            <div class="l_news_item col-md-6 col-md-offset-3 col-sm-12" style="padding: 20px !important; margin:auto;">
                <h6 style="font-weight: bold;">Advanced Search</h6>
                <p>Basic</p>

                <form>
                  <div class="form-group row">
                    <label for="gender" class="col-sm-2 col-form-label">I am</label>
                    <div class="col-sm-6 col-sm-offset-4">
                      <select class="form-control" id="gender">
                          <option value="">--Select--</option>
                          <option value="male">Male</option>
                          <option value="Female">Female</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="seeking" class="col-sm-2 col-form-label">I'm seeking a</label>
                    <div class="col-sm-6 col-sm-offset-4">
                      <select class="form-control" id="seeking">
                          <option value="">--Select--</option>
                          <option value="male">Male</option>
                          <option value="Female">Female</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="seeking" class="col-sm-2 col-form-label">Aged Between</label>
                    <div class="col-sm-3 col-sm-offset-2">
                          <select class="form-control" name="starting" id="starting">
                              <option value="">--Select--</option>
                              @for($i=18; $i<100;$i++)
                              <option value="{{$i}}" >{{$i}}</option>
                              @endfor
                          </select>
                    </div>
                    <div class="col-sm-3 col-sm-offset-2">
                          <select class="form-control" name="ending" id="ending">
                              <option value="">--Select--</option>
                              @for($i=18; $i<100;$i++)
                              <option value="{{$i}}" >{{$i}}</option>
                              @endfor
                          </select>
                    </div>

                  </div>
                  <div class="form-group row">
                    <label for="seeking" class="col-sm-2 col-form-label">Living in:</label>
                    <div class="col-sm-3 col-sm-offset-2">
                          <select class="form-control" name="country" id="country">
                              <option value="">Any Country</option>
                              <option value="">Kenya</option>
                          </select>
                    </div>
                    <div class="col-sm-3 col-sm-offset-2">
                          <select class="form-control" name="state" id="state">
                              <option value="">Any Country</option>
                              <option value="">Nakuru</option>
                          </select>
                    </div>
                    
                  </div>
                  <div class="form-group row">
                    <label for="seeking" class="col-sm-2 col-form-label">Has photo ?</label>
                    <div class="col-sm-6 col-sm-offset-4">
                      <input type="checkbox" name="has_photo" id="has_photo">
                      Yes, only show profiles with a photo.
                    </div>
                    
                  </div>
                  <div class="form-group row">
                    <label for="seeking" class="col-sm-2 col-form-label">Last Active: </label>
                    <div class="col-sm-6 col-sm-offset-4">
                          <select class="form-control" name="last_active" id="last_active">
                                <option value="-1">Any</option>
                                <option value="7">within week</option>
                                <option value="31">within 1 month</option>
                                <option value="92">within 3 months</option>
                                <option value="185">within 6 months</option>
                                <option value="365">within year</option>
                          </select>
                    </div>
                    
                   </div>
                  <div class="form-group row">
                    <label for="seeking" class="col-sm-2 col-form-label">Searching for :</label>
                    <div class="col-sm-6 col-sm-offset-4">
                         <div class="col-sm-6">
                            <input type="radio" name="searchin_for" value="any"> Any 
                         </div>
                         <div class="col-sm-6">
                            <input type="radio" name="searchin_for" value="friendship">
                            Friendship 
                         </div>
                         <div class="col-sm-6">
                            <input type="radio" name="searchin_for" value="marriage">
                            Marriage 
                         </div>
                         <div class="col-sm-6">
                            <input type="radio" name="searchin_for" value="Penpal">
                            Penpal 
                         </div>
                         <div class="col-sm-6">
                            <input type="radio" name="searchin_for" value="Penpal">
                            Romantic Dating 
                         </div>
                    </div>
                    
                   </div>
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
                                          <select class="form-control" name="education" id="education">
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
                   <div class="row">
                        <div class="col-sm-12">
                           <button class="btn btn-success btn-sm" type="button" style="width: 200px !important;">
                               Search &nbsp;<i class="spinner" id="spinner-search" style="display: ;"></i></button>
                           </button>
                        </div>
                   </div>
                </form>

                
            </div>


        </div> <br>
        <div class="row" id="show_search_results" >
             <div class="l_news_item col-md-6 col-sm-12" style="padding: 20px !important; margin:auto;">
                search results come in here.
             </div>
            
        </div>
    </div>

</section>
@include('partials.footer')
<script>

</script>
</body>
</html>
