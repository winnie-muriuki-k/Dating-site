        <!--================Header Menu Area =================-->
        <header class="header_area navbar_fixed">
            <div class="main_menu" id="mainNav" style="background: green !important;">
            	<nav class="navbar navbar-expand-lg navbar-light" style="background: green !important;">
					<div class="container">
						<!-- Brand and toggle get grouped for better mobile display -->
						<a class="navbar-brand logo_h" href="{{ route('welcome') }}" style="font-weight:bold; color:#fff;">Dating App</a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
							<ul class="nav navbar-nav menu_nav ml-auto">
								<li class="nav-item active"><a class="nav-link" href="{{ route('welcome') }}">Home</a></li>

								@if(Auth::check() && Auth::user()->role =="customer")
								<li class="nav-item">
									<a class="nav-link" href="{{ route('welcome') }}">Matches</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="{{ route('advanced-search') }}">Search</a>
								</li>
{{-- 								<li class="nav-item">
									<a class="nav-link" href="#messages">Messages <span style="background: #fff;color: #000;" class="badge" id="">{{ !empty($unread_messages) ? count($unread_messages) : '0'}}</span></a>
								</li> --}}
								<li class="nav-item notification-dropdown-link"><a class="nav-link" onclick="UpdateNotification('{{Auth::user()->id}}')">Notification <span  style="background: #fff;color: #000;" class="badge" id="notifications-count">{{!empty($notifications)?count($notifications) : '0'}}</span></a>
									{{-- start --}}
								<div class="dropdown-level-1 notification-dropdown" style="">
                                    <div>
                                        <div class="col-md-12">
                                        	@if(!empty($all_notifications) && count($all_notifications)>0)
	                                        	@foreach($all_notifications as $notif)
	                                            <div style="font-size: 12px;border-bottom:1px solid #d6d5d8;    padding-left: 5px;color: black;padding-bottom: 10px;">
	                                            	{{$notif->description}}

	                                            	

	                                            	<span  class="btn btn-info btn-sm" 
	                                            	id="button_not_confirmed_{{$notif->id}}" 
	                                            	 onclick="ConfirmMatch('{{$notif->type}}',
	                                            	 '{{$notif->extra_info}}','{{$notif->id}}')" 
	                                            	 style="float: right;line-height: 1;padding: 6px;font-size: 10px; display: {{(!empty($notif->type) && $notif->type =="match_request" && $notif->extra_info!=="confirmed") ? "" : "none" }} "
	                                            		>Confirm request
	                                            	 </span>

	                                            	
	                                            	<span type="button" class="text-info"
	                                            	id="button_confirmed_{{$notif->id}}" 
	                                            	 style="float: right;line-height: 1;padding: 6px;font-size: 10px; display: {{!empty($notif->type) && $notif->extra_info =="confirmed" ? " " : "none"}}; background: #fff;border: 1px solid;">Match Confirmed!</span>

	                                            	

	                                            </div>
	                                            @endforeach
                                            @else
                                            <div>
                                            	<small>No notifications available.</small>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
								</div>
									{{-- start --}}
								</li>

							<li class="nav-item activity-dropdown-btn">
									<a class="nav-link activity-dropdown-link">Activity</a></a>
								<div class="dropdown-level-1 activity-dropdown" style="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Activities Towards Me</p>
									<ul class="level-1">
											<li class="">
												<a class="">Interested in me</a>
											</li>
											<li class="">
												<a class="" href="#video">I am their favourite </a>
											</li>
										<li class="">
											<a class="" href="#video">Viewed my profile </a>
										</li>
									</ul>
											<p>Activity From Me</p>
											<ul class="level-1">
												<li class="">
													<a class="">My Interests</a>
												</li>
												<li class="">
													<a class="" >My Favourites</a>
												</li>
												<li class="">
													<a class="" >Profiles I viewed</a>
												</li>
												<li class="">
													<a class="" >Block List</a>
												</li>
												<hr>

											</ul>
                                        </div>
                                        <div class="col-md-6">
                                            <p>Recent Activity</p>
                                            <ul class="nav navbar-nav menu_nav">
												<a class="" >No results found</a>

                                            </ul>
                                        </div>
                                    </div>
								</div>
								</li>
									<li class="nav-item profile-dropdown-btn">
										<a class="nav-link profile-dropdown-link"><span class="fa-profile"></span></a></a>
										<div class="dropdown-level-1 profile-dropdown" style="">
											<div class="row">
												<div class="col-md-4">
													<p>Edit Profile</p>
													<ul class="level-1">
														<li class="">
															<a href="{{route('edit-profile')}}">Profile</a>
														</li>
														<li class="">
															<a class="">Photos </a>
														</li>
														<li class="">
															<a class="">Matches </a>
														</li>
														<li class="">
															<a class="">Hobbies & Interests </a>
														</li>
														<li class="">
															<a class="">Personality Questions </a>
														</li>
													</ul>

												</div>
												<div class="col-md-8">
													<p>Your Profile</p>
													<div class="row">
														<div class="col-md-4 menu-profile-img-holder" >
															<img src="{{asset('avatars/')}}/{{Auth::user()->avatar}}" alt="">
														</div>
														<div class="col-md-8" >
															<h4>Hi  {{ Auth::user()->username }}</h4>
															<a href="{{route('view-profile')}}"><i class="fa fa-eye" aria-hidden="true"></i>View my profile</a>

														</div>
													</div>
													<div class="row">
														<div class="col-md-12" >


														</div>
													</div>
												</div>
											</div>
										</div>
									</li>

								@else
								<li class="nav-item"><a class="nav-link" href="#screen">About Us</a>
								<li class="nav-item"><a class="nav-link" href="#screen">Feedbacks</a>
								<li class="nav-item submenu dropdown">
									<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages</a>
									<ul class="dropdown-menu">
										<li class="nav-item"><a class="nav-link" href="elements.html">Elements</a></li>
									</ul>
								</li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('user-password-reset') }}">Reset Account</a></li>
                                @endif
                                @if(!empty(Auth::user()))
                                    <li class="nav-item"><a class="nav-link" href="{{ route('user-logout') }}">&nbsp;Logout</a></li>
                                @endif
							</ul>
						</div>
					</div>
            	</nav>
            </div>
        </header>

        <!--================Header Menu Area =================-->
