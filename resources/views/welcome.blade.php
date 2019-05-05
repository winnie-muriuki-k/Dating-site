
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
        <title>BulkApp</title>
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
    </head>
    <body data-spy="scroll" data-target="#mainNav" data-offset="70">

        <!--================Header Menu Area =================-->
        @include('partials.header')
        <!--================Header Menu Area =================-->

        <!--================Home Banner Area =================-->
        <section class="home_banner_area" id="home" style="background-image:url('{{ asset('temp/img/banner/smiling.jpg') }}')">
            <div class="banner_inner">
				<div class="container">
					<div class="row banner_content" >
						<div class="col-lg-4" style="background: #bf83f7;padding: 20px;">
                                <form id="login-form-home">
                                        <h1>Sign In</h1>
                                        <div class="form-group">
                                                <label for="email">Email</label>
                                                <input class="form-control" type="text" name="email" placeholder="Email Address" />
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input class="form-control" type="password" name="password" placeholder="Password" />
                                        </div>


                                        <button type="button" class="btn btn-outline-default" style="outline: none; border-radius: 0px !important" id="btn-login-home" onclick="loginForm()">Login &nbsp;<i class="spinner" id="spinner-login-form" style="display: none;"></i></button>
                                        <hr/>
                                        <p class="message">Not registered? <a href="{{ route('user-register') }}" style="color:black;">Create an account</a></p>
                                    </form>
						</div>
						<div class="col-lg-8">
							<div class="banner_map_img">
                            </div>
                            <h2 style="position:absolute; bottom:0px; right:0px; color:#9047d2;">Come find your soul mate</h2>
						</div>
					</div>
				</div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->

        <!--================Feature Area =================-->
        <section class="feature_area p_120" id="feature">
        	<div class="container">
        		<div class="main_title">
        			<h2>Unique Features</h2>
        			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua.</p>
        		</div>
        		<div class="feature_inner row">
        			<div class="col-lg-3 col-md-6">
        				<div class="feature_item">
        					<img src="img/icon/f-icon-1.png" alt="">
        					<h4>Maintenance</h4>
        					<p>inappropriate behavior is often laughed off as boys will be boys,” women face higher conduct standards especially in the workplace. That’s why.</p>
        				</div>
        			</div>
        			<div class="col-lg-3 col-md-6">
        				<div class="feature_item">
        					<img src="img/icon/f-icon-1.png" alt="">
        					<h4>Maintenance</h4>
        					<p>inappropriate behavior is often laughed off as boys will be boys,” women face higher conduct standards especially in the workplace. That’s why.</p>
        				</div>
        			</div>
        			<div class="col-lg-3 col-md-6">
        				<div class="feature_item">
        					<img src="img/icon/f-icon-1.png" alt="">
        					<h4>Maintenance</h4>
        					<p>inappropriate behavior is often laughed off as boys will be boys,” women face higher conduct standards especially in the workplace. That’s why.</p>
        				</div>
        			</div>
        			<div class="col-lg-3 col-md-6">
        				<div class="feature_item">
        					<img src="img/icon/f-icon-1.png" alt="">
        					<h4>Maintenance</h4>
        					<p>inappropriate behavior is often laughed off as boys will be boys,” women face higher conduct standards especially in the workplace. That’s why.</p>
        				</div>
        			</div>
        		</div>
        	</div>
        </section>
        <!--================End Feature Area =================-->

        <!--================Interior Area =================-->
        <section class="interior_area">
        	<div class="container">
        		<div class="interior_inner row">
        			<div class="col-lg-6">
        				<img class="img-fluid" src="img/interior-1.png" alt="">
        			</div>
        			<div class="col-lg-5 offset-lg-1">
        				<div class="interior_text">
        					<h4>We Believe that Interior beautifies the Total Architecture</h4>
        					<p>inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards especially in the workplace. That’s why it’s crucial that, as women, our behavior on the job is beyond reproach. inappropriate behavior is often laughed off.</p>
        					<a class="main_btn" href="#">See Details</a>
        				</div>
        			</div>
        		</div>
        	</div>
        </section>
        <!--================End Interior Area =================-->

        <!--================Interior Area =================-->
        <section class="interior_area interior_two">
        	<div class="container">
        		<div class="interior_inner row">
        			<div class="col-lg-5 offset-lg-1">
        				<div class="interior_text">
        					<h4>We Believe that Interior beautifies the Total Architecture</h4>
        					<p>inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards especially in the workplace. That’s why it’s crucial that, as women, our behavior on the job is beyond reproach. inappropriate behavior is often laughed off.</p>
        					<a class="main_btn" href="#">See Details</a>
        				</div>
        			</div>
        			<div class="col-lg-6">
        				<img class="img-fluid" src="img/interior-2.png" alt="">
        			</div>
        		</div>
        		<div class="video_area" id="video">
        			<img class="img-fluid" src="img/video-1.png" alt="">
        			<a class="popup-youtube" href="https://www.youtube.com/watch?v=VufDd-QL1c0">
        				<img src="img/icon/video-icon-1.png" alt="">
        			</a>
        		</div>
        	</div>
        </section>
        <!--================End Interior Area =================-->

        <!--================Price Area =================-->
        <section class="price_area p_120" id="price">
        	<div class="container">
        		<div class="main_title">
        			<h2>Pricing Table</h2>
        			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua.</p>
        		</div>
        		<div class="price_item_inner row">
        			<div class="col-lg-4">
        				<div class="price_item">
        					<div class="price_head">
        						<div class="float-left">
        							<h3>Standard</h3>
        							<p>For the individuals</p>
        						</div>
        						<div class="float-right">
        							<h2>£199</h2>
        						</div>
        					</div>
        					<div class="price_body">
        						<ul class="list">
        							<li><a href="#">2.5 GB Free Photos</a></li>
        							<li><a href="#">Secure Online Transfer Indeed</a></li>
        							<li><a href="#">Unlimited Styles for interface</a></li>
        							<li><a href="#">Reliable Customer Service</a></li>
        							<li><a href="#">Manual Backup Provided</a></li>
        						</ul>
        					</div>
        					<div class="price_footer">
        						<a class="main_btn2" href="#">Purchase Plan</a>
        					</div>
        				</div>
        			</div>
        			<div class="col-lg-4">
        				<div class="price_item">
        					<div class="price_head">
        						<div class="float-left">
        							<h3>Standard</h3>
        							<p>For the individuals</p>
        						</div>
        						<div class="float-right">
        							<h2>£199</h2>
        						</div>
        					</div>
        					<div class="price_body">
        						<ul class="list">
        							<li><a href="#">2.5 GB Free Photos</a></li>
        							<li><a href="#">Secure Online Transfer Indeed</a></li>
        							<li><a href="#">Unlimited Styles for interface</a></li>
        							<li><a href="#">Reliable Customer Service</a></li>
        							<li><a href="#">Manual Backup Provided</a></li>
        						</ul>
        					</div>
        					<div class="price_footer">
        						<a class="main_btn2" href="#">Purchase Plan</a>
        					</div>
        				</div>
        			</div>
        			<div class="col-lg-4">
        				<div class="price_item">
        					<div class="price_head">
        						<div class="float-left">
        							<h3>Standard</h3>
        							<p>For the individuals</p>
        						</div>
        						<div class="float-right">
        							<h2>£199</h2>
        						</div>
        					</div>
        					<div class="price_body">
        						<ul class="list">
        							<li><a href="#">2.5 GB Free Photos</a></li>
        							<li><a href="#">Secure Online Transfer Indeed</a></li>
        							<li><a href="#">Unlimited Styles for interface</a></li>
        							<li><a href="#">Reliable Customer Service</a></li>
        							<li><a href="#">Manual Backup Provided</a></li>
        						</ul>
        					</div>
        					<div class="price_footer">
        						<a class="main_btn2" href="#">Purchase Plan</a>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </section>
        <!--================End Price Area =================-->

        <!--================Feature Area =================-->
        <section class="screenshot_area p_120" id="screen">
        	<div class="container">
        		<div class="main_title">
        			<h2>Unique Screenshots</h2>
        			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua.</p>
        		</div>
        		<div class="screenshot_inner owl-carousel">
        			<div class="item">
        				<img src="img/feature/feature-1.jpg" alt="">
        			</div>
        			<div class="item">
        				<img src="img/feature/feature-2.jpg" alt="">
        			</div>
        			<div class="item">
        				<img src="img/feature/feature-3.jpg" alt="">
        			</div>
        			<div class="item">
        				<img src="img/feature/feature-4.jpg" alt="">
        			</div>
        		</div>
        	</div>
        </section>
        <!--================End Feature Area =================-->

        <!--================Testimonials Area =================-->
        <section class="testimonials_area p_120">
        	<div class="container">
        		<div class="main_title">
        			<h2>Testimonials</h2>
        			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua.</p>
        		</div>
        		<div class="testi_slider owl-carousel">
        			<div class="item">
        				<div class="testi_item">
							<div class="media">
								<div class="d-flex">
									<img src="img/testimonials/testi-1.png" alt="">
								</div>
								<div class="media-body">
									<p>Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker, projector, hardware.</p>
									<h4>Mark Alviro Wiens</h4>
									<h5>CEO at Google</h5>
								</div>
							</div>
        				</div>
        			</div>
        			<div class="item">
        				<div class="testi_item">
							<div class="media">
								<div class="d-flex">
									<img src="img/testimonials/testi-2.png" alt="">
								</div>
								<div class="media-body">
									<p>Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker, projector, hardware.</p>
									<h4>Mark Alviro Wiens</h4>
									<h5>CEO at Google</h5>
								</div>
							</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </section>
        <!--================End Testimonials Area =================-->

        <!--================Download App Area =================-->
        <section class="download_app_area p_120">
        	<div class="container">
        		<div class="app_inner">
        			<h2>Download This App Today!</h2>
        			<p>It won’t be a bigger problem to find one video game lover in your neighbor. Since the introduction of Virtual Game, it has been achieving great heights so far as its popularity and technological advancement are concerned.</p>
        			<div class="app_btn_area">
        				<div class="app_btn">
        					<div class="media">
								<div class="d-flex">
									<i class="fa fa-apple" aria-hidden="true"></i>
								</div>
								<div class="media-body">
									<a href="#"><h4>Available</h4></a>
									<p>on App Store</p>
								</div>
							</div>
        				</div>
        				<div class="app_btn">
        					<div class="media">
								<div class="d-flex">
									<i class="fa fa-android" aria-hidden="true"></i>
								</div>
								<div class="media-body">
									<a href="#"><h4>Available</h4></a>
									<p>on App Store</p>
								</div>
							</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </section>
        <!--================End Download App Area =================-->

        <!--================Latest News Area =================-->
        <section class="latest_news_area p_120">
        	<div class="container">
        		<div class="main_title">
        			<h2>Latest News</h2>
        			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua.</p>
        		</div>
        		<div class="latest_news_inner row">
        			<div class="col-lg-4">
        				<div class="l_news_item">
        					<a class="date" href="#">10 April, 2018</a>
        					<a href="#"><h4>Benjamin Franklin Method Of Habit Formation</h4></a>
        					<p>There are many kinds of narratives and organizing principles. Science is driven by evidence gathered in experiments, and by the falsification of extant theories and their </p>
        					<div class="post_view">
        						<a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 4.5k Views</a>
        						<a href="#"><i class="fa fa-commenting" aria-hidden="true"></i> 07</a>
        						<a href="#"><i class="fa fa-reply" aria-hidden="true"></i> 362</a>
        					</div>
        				</div>
        			</div>
        			<div class="col-lg-4">
        				<div class="l_news_item">
        					<a class="date" href="#">10 April, 2018</a>
        					<a href="#"><h4>Benjamin Franklin Method Of Habit Formation</h4></a>
        					<p>There are many kinds of narratives and organizing principles. Science is driven by evidence gathered in experiments, and by the falsification of extant theories and their </p>
        					<div class="post_view">
        						<a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 4.5k Views</a>
        						<a href="#"><i class="fa fa-commenting" aria-hidden="true"></i> 07</a>
        						<a href="#"><i class="fa fa-reply" aria-hidden="true"></i> 362</a>
        					</div>
        				</div>
        			</div>
        			<div class="col-lg-4">
        				<div class="l_news_item">
        					<a class="date" href="#">10 April, 2018</a>
        					<a href="#"><h4>Benjamin Franklin Method Of Habit Formation</h4></a>
        					<p>There are many kinds of narratives and organizing principles. Science is driven by evidence gathered in experiments, and by the falsification of extant theories and their </p>
        					<div class="post_view">
        						<a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 4.5k Views</a>
        						<a href="#"><i class="fa fa-commenting" aria-hidden="true"></i> 07</a>
        						<a href="#"><i class="fa fa-reply" aria-hidden="true"></i> 362</a>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </section>
        <!--================End Latest News Area =================-->

        <!--================ start footer Area  =================-->
        @include('partials.footer')

        <script type="text/javascript">

            function loginForm(){
                PNotify.removeAll();

                var info={};

                var errors=[];

                $("#login-form-home").find('.form-control').each(function(){
                    $(this).css('border-color', '#ccc');
                    if ($(this).val()==""||$(this).val()==null) {
                        $(this).css("border", "1px solid #f77575");
                        errors.push($(this).attr('name'));
                    }
                    info[$(this).attr('name')]=$(this).val();
                });

                // console.log(info);

                if (errors.length>0) {
                    new PNotify({
                        text: 'Fill in the required Fields.',
                        animate_speed: 'fast',
                        type: 'error'
                    });
                    return;
                }

                $("#spinner-login-form").show();

                $("#btn-login-home").addClass("disabled");

                login(info);
            }

            function login(info) {
                $.ajax({

                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },

                    type:'POST',

                    data:info,

                    url: '{{route('process-user-login')}}',

                    success:function(response){
                        $("#spinner-login").hide();
                        $("#spinner-login-form").hide();

                         $("#btn-login").removeClass("disabled");
                         $("#btn-login-home").removeClass("disabled");
                        if(response.status=='success'){
                          if (response.code==1) {
                            window.location.href="{{route('user-dashboard')}}";
                          }
                          if (response.code==2) {
                            window.location.href="/admin/dashboard";
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
                        $("#spinner-login").hide();
                        $("#btn-login").removeClass("disabled");
                            new PNotify({
                                text: 'Error occurred , try again later',
                                animate_speed: 'fast',
                                type: 'info'
                            });
                    }

                });
            }
        </script>
        <!--================ end footer Area  =================-->
    </body>
</html>
