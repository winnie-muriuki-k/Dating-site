        <!--================Header Menu Area =================-->
        <header class="header_area navbar_fixed">
            <div class="main_menu" id="mainNav" style="background: green !important;">
            	<nav class="navbar navbar-expand-lg navbar-light" style="background: green !important;">
					<div class="container">
						<!-- Brand and toggle get grouped for better mobile display -->
						<a class="navbar-brand logo_h" id="logo_h" href="<?php echo e(route('welcome')); ?>" style="font-weight:bold; color:#fff;margin-left: 10%;">Dating App</a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
							<ul class="nav navbar-nav menu_nav ml-auto">
                                <?php if(Route::currentRouteName()!="user-dashboard"): ?>
								<li class="nav-item active"><a style="text-transform:none;" class="nav-link" href="<?php echo e(route('welcome')); ?>">Home</a></li>
                                <?php endif; ?>

								<?php if(Auth::check() && Auth::user()->role =="customer"): ?>
								<li class="nav-item">
									<a style="text-transform:none;" class="nav-link" href="<?php echo e(route('welcome')); ?>">Matches</a>
								</li>
								<?php if(Route::currentRouteName()!="advanced-search"): ?>
								<li class="nav-item">
									<a style="text-transform:none;" class="nav-link" href="<?php echo e(route('advanced-search')); ?>">Search</a>
								</li>
								<?php endif; ?>

								<?php if(Route::currentRouteName()!="user-messages"): ?>
								<li class="nav-item">
									<a style="text-transform:none;" class="nav-link" href="<?php echo e(route('user-messages')); ?>">Messages 
										<?php if(count(\App\Message::where(['receiver_id'=>Auth::user()->id,'read_status'=>'unread'])->get())>0): ?>
										 <span style="background: #fff;color: #000;" class="badge" id="">
										<?php echo e((count( \App\Message::where(['receiver_id'=>Auth::user()->id,'read_status'=>'unread'])->get() ))); ?>

											</span>
										<?php endif; ?>
									</a>
								</li>
								<?php endif; ?>

							<li class="nav-item activity-dropdown-btn">
									<a style="text-transform:none;" class="nav-link activity-dropdown-link">Favourites</a> <?php if(!empty($new_favourites) && count($new_favourites)!=0): ?><span  style="background: #fff;color: #000;" class="badge" id="notifications-count"><?php echo e(!empty($new_favourites)?count($new_favourites) : '0'); ?></span><?php endif; ?>
								<div class="dropdown-level-1 activity-dropdown" style="">
                                    <div class="row">
                                        <div class="col-md-6 drop-down-half">
                                            <p class="hide-on-mobile">Favourites</p>
									<ul class="level-1">
											<li class="">
												<a class="" href="<?php echo e(route('user-favourited', ['id'=>Auth::user()->id])); ?>">I am their favourite <?php if(!empty($new_favourites) && count($new_favourites)!=0): ?>  <span  style="background: #fff;color: #000;" class="badge" id="notifications-count"><?php echo e(!empty($new_favourites)?count($new_favourites) : '0'); ?></span> <?php endif; ?></a>
											</li>
										<li class="">
											<a class="" href="<?php echo e(route('user-favourites')); ?>">My Favourites</a>
										</li>
									</ul>
		
                                        </div>
                                        <div class="col-md-6 hide-on-mobile">
                                            <p>Recent Activity</p>
												<?php if(count($recent_activity)>0): ?>
													<?php $__currentLoopData = $recent_activity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<div class="row" style="color: black;">
														<div class="col-md-3 menu-profile-img-holder">
															<img src="<?php echo e(asset('avatars/')); ?>/<?php echo e(App\User::findOrFail($recent->initiator_id)->avatar); ?>" alt="">
														</div>
														<div class="col-md-9" ><p style="margin-bottom: 0px"><a
                                                                        href="<?php echo e(route('view-user', ['id'=>App\User::findOrFail($recent->initiator_id)->id])); ?>"><?php echo e(App\User::findOrFail($recent->initiator_id)->username); ?> (<?php echo e(App\User::findOrFail($recent->initiator_id)->age); ?>)</a> </p>
														<p style="margin-top: -7px; margin-bottom: 0px;font-size: 10px"><i class="fa fa-thumbs-up"></i>  Added you to their favourites</p></div>
													</div>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													<?php else: ?>
												<a class="" >No recent favourite activity</a>
													<?php endif; ?>

                                        </div>
                                    </div>
								</div>
								</li>
                                        <li class="nav-item notification-dropdown-link"><a style="text-transform:none;" class="nav-link">Interests <?php if(!empty($interest_recent_activity) && count($interest_recent_activity)!=0): ?> <span  style="background: #fff;color: #000;" class="badge" id="notifications-count"><?php echo e(!empty($interest_recent_activity)?count($interest_recent_activity) : '0'); ?></span><?php endif; ?></a>
                                            
                                            <div class="dropdown-level-1 notification-dropdown" >
                                                <div class="row">
                                                    <div class="col-md-6 drop-down-half">
                                                        <p class="hide-on-mobile">Interests</p>
                                                        <ul class="level-1">
                                                            <li class="">
                                                                <a class="" href="<?php echo e(route('interested',['id'=>Auth::user()->id])); ?>">Interested in me    <?php if(count($interest_recent_activity)>0): ?><span  style="background: #fff;color: #000;" class="badge" id="notifications-count"><?php echo e(!empty($interest_recent_activity)?count($interest_recent_activity) : '0'); ?></span> <?php endif; ?></a>
                                                            </li>
                                                            <li class="">
                                                                <a class="" href="<?php echo e(route('interests',['id'=>Auth::user()->id])); ?>">My Interests  <?php if(count($confirmed_recent_activity)>0): ?><span  style="background: #fff;color: #000;" class="badge" id="notifications-count"><?php echo e(!empty($confirmed_recent_activity)?count($confirmed_recent_activity) : '0'); ?></span> <?php endif; ?></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6 hide-on-mobile">
                                                        <p>Recent Activity</p>
														<u><a class="" >Interested in me</a></u> <br>
                                                        <?php if(count($interest_recent_activity)>0): ?>
                                                            <?php $__currentLoopData = $interest_recent_activity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="row" style="color: black;">
                                                                    <div class="col-md-3 menu-profile-img-holder">
                                                                        <img src="<?php echo e(asset('avatars/')); ?>/<?php echo e(App\User::findOrFail($recent->initator)->avatar); ?>" alt="">
                                                                    </div>
                                                                    <div class="col-md-9" ><p style="margin-bottom: 0px"><a
                                                                                    href="<?php echo e(route('view-user', ['id'=>App\User::findOrFail($recent->initator)->id])); ?>"><?php echo e(App\User::findOrFail($recent->initator)->username); ?> (<?php echo e(App\User::findOrFail($recent->initator)->age); ?>)</a> </p>
                                                                        <p style="margin-top: -7px; margin-bottom: 0px;font-size: 10px"><i class="fa fa-heart"></i> Showed Interest
                                                                        	<?php if(!empty($recent->notification)): ?>
																			<span class="btn btn-info btn-sm"
																				  id="button_not_confirmed_<?php echo e(!empty($recent->notification) ?  $recent->notification->id :''); ?>"
																				  onclick="ConfirmMatch('<?php echo e($recent->notification->type); ?>',
																						  '<?php echo e($recent->notification->extra_info); ?>','<?php echo e($recent->notification->id); ?>')"
																				  style="float: right;padding: 2px; width:43%; height: 20px;font-size: 10px; background: #3e8000; color:white;  display: <?php echo e((!empty($recent->notification->type) && $recent->notification->type =="match_request" &&$recent->notification->extra_info!=="confirmed") ? "" : "none"); ?> "
																				  class="">Confirm</span>


                                                                            <span type="button" class="text-info"
                                                                                  id="button_confirmed_<?php echo e($recent->notification->id); ?>"
                                                                                  style="float: right;line-height: 1;padding: 6px;font-size: 10px; display: <?php echo e(!empty($recent->notification->type) && $recent->notification->extra_info =="confirmed" ? " " : "none"); ?>; background: #fff;border: 1px solid;">Match Confirmed!</span>

                                                                            <?php endif; ?>











                                                                    </p></div>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                                        <?php else: ?>
															<p> No Recent Activity</p>
                                                        <?php endif; ?>

														<u><a class="" >Interested in me</a></u> <br>

														<?php if(count($confirmed_recent_activity)>0): ?>
															<?php $__currentLoopData = $confirmed_recent_activity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<div class="row" style="color: black;">
																	<div class="col-md-3 menu-profile-img-holder">
																		<img src="<?php echo e(asset('avatars/')); ?>/<?php echo e(App\User::findOrFail($recent->recipient)->avatar); ?>" alt="">
																	</div>
																	<div class="col-md-9" ><p style="margin-bottom: 0px"><a
																					href="<?php echo e(route('view-user', ['id'=>App\User::findOrFail($recent->recipient)->id])); ?>"><?php echo e(App\User::findOrFail($recent->recipient)->username); ?> (<?php echo e(App\User::findOrFail($recent->recipient)->age); ?>)</a> </p>
																		<p style="margin-top: -7px; margin-bottom: 0px;font-size: 10px"><i class="fa fa-heart"></i> Confirmed Your interest.

																		</p></div>
																</div>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



														<?php else: ?>
															<p> No Recent Activity</p>
														<?php endif; ?>

                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </li>
										<li class="nav-item views-dropdown-link"><a style="text-transform:none;" class="nav-link">Views <?php if(!empty($my_viewers) && count($my_viewers)!=0): ?> <span  style="background: #fff;color: #000;" class="badge" id="notifications-count"><?php echo e(!empty($my_viewers)?count($my_viewers) : '0'); ?></span><?php endif; ?></a>
											
											<div class="dropdown-level-1 views-dropdown" >
												<div class="row">
													<div class="col-md-6">
														<p>Profiles i have viewed</p>
														<?php if(count($viewed_profiles)>0): ?>
															<?php $__currentLoopData = $viewed_profiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<div class="row" style="color: black;">
																	<div class="col-md-3 menu-profile-img-holder">
																		<img src="<?php echo e(asset('avatars/')); ?>/<?php echo e(App\User::findOrFail($recent->recipientUser->id)->avatar); ?>" alt="">
																	</div>
																	<div class="col-md-9" ><p style="margin-bottom: 0px"><i class="fa fa-search"></i>  <a
																					href="<?php echo e(route('view-user', ['id'=>App\User::findOrFail($recent->recipientUser->id)->id])); ?>"><?php echo e(App\User::findOrFail($recent->recipientUser->id)->username); ?> (<?php echo e(App\User::findOrFail($recent->recipientUser->id)->age); ?>)</a> </p>
																		<p style="margin-top: -7px; margin-bottom: 0px;font-size: 10px">
																		</p></div>
																</div>
																<hr>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



														<?php else: ?>
															<p> No Profiles Viewed yet!</p>
														<?php endif; ?>

													</div>
													<div class="col-md-6">
														<p>Who viewed my Profile</p>
														<?php if(count($my_viewers)>0): ?>
															<?php $__currentLoopData = $my_viewers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<div class="row" style="color: black;">
																	<div class="col-md-3 menu-profile-img-holder">
																		<img  src="<?php echo e(asset('avatars/')); ?>/<?php echo e(App\User::findOrFail($recent->viewerUser->id)->avatar); ?>" alt="">
																	</div>
																	<div class="col-md-9" ><p style="margin-bottom: 0px"><a
																					href="<?php echo e(route('view-user', ['id'=>App\User::findOrFail($recent->viewerUser->id)->id])); ?>"><?php echo e(App\User::findOrFail($recent->viewerUser->id)->username); ?> (<?php echo e(App\User::findOrFail($recent->viewerUser->id)->age); ?>)</a> </p>
																		<p style="margin-top: -7px; margin-bottom: 0px;font-size: 10px"><i class="fa fa-eye"></i> Viewed Your Profile
																		</p></div>
																</div>
																<hr>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



														<?php else: ?>
															<p> Oops! You have no views yet</p>
														<?php endif; ?>

													</div>
												</div>
											</div>
											
										</li>
									<li class="nav-item">
										<a href="<?php echo e(route('settings')); ?>" style="text-transform:none; font-size: 10px" class="nav-link"><span class=""><i  style="font-size: 2em;" class="fa fa-cog 	 fa-3x fa-fw"></i></span></a></a>

									</li>
									<?php if(Route::currentRouteName()!="view-profile"): ?>
									<li class="nav-item profile-dropdown-btn">
										<a style="text-transform:none;" class="nav-link profile-dropdown-link"><span class="fa-profile"></span></a>
										<div class="dropdown-level-1 profile-dropdown" style="">
											<div class="row">
												<div class="col-md-4">
													
													<ul class="level-1">
														<li class="">
															<a href="<?php echo e(route('edit-profile')); ?>" > Edit Profile</a>
														</li>
														<li class="">
															<a class="">My Gallery  </a>
														</li>
														<li class="">
															<a class="">Matches </a>
														</li>
														<li class="">
															<a class="" href="#">Profile Visits  <span style="background: green;color: #fff;" class="badge" id=""><?php echo e(!empty($my_viewers)?count($my_viewers) : '0'); ?>														</span></a></a>
														</li>
														<li class="">
															<a class="" href="<?php echo e(route('edit-profile')); ?>">Hobbies & Interests </a>
														</li>

													</ul>

												</div>
												<div class="col-md-8">
													
													<div class="row">
														<div class="col-md-4 menu-profile-img-holder" >
															<img src="<?php echo e(asset('avatars/')); ?>/<?php echo e(Auth::user()->avatar); ?>" alt="">
														</div>
														<div class="col-md-8" >
															<h4 class="profile-head-nav"> <i class="fa fa-user"></i>&nbsp;
                                    							<?php echo e(!empty(Auth::user()->username) ? Auth::user()->username : 'Set Username'); ?></h4>

															<a href="<?php echo e(route('view-profile')); ?>">
																<i class="fa fa-eye" aria-hidden="true"></i>
																&nbsp; View profile</a>
																<hr>
																<small class="profile-head-nav">Your Profile is <?php echo e(isset(Auth::user()->profile->country)?50:25); ?>% complete</small>
																<div class="progress">

																	<div class="progress-bar" role="progressbar" style="width: <?php echo e(isset(Auth::user()->profile->country)?50:25); ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> <?php echo e(isset(Auth::user()->profile->country)?50:25); ?>%</div>
																</div>

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
									<?php endif; ?>

								<?php else: ?>
								<li class="nav-item"><a style="text-transform:none;" class="nav-link" href="#screen">About Us</a>
								<li class="nav-item"><a style="text-transform:none;" class="nav-link" href="#screen">Feedbacks</a>
                                <li class="nav-item"><a style="text-transform:none;" class="nav-link" href="<?php echo e(route('user-password-reset')); ?>">Reset Account</a></li>
                                <?php endif; ?>
                                <?php if(!empty(Auth::user())): ?>
                                    <li class="nav-item"><a style="text-transform:none;" class="nav-link" href="<?php echo e(route('user-logout')); ?>">&nbsp;Logout</a></li>
                                <?php endif; ?>
							</ul>
						</div>
					</div>
            	</nav>
            </div>
        </header>

        <!--================Header Menu Area =================-->

<?php /* C:\Users\WYN\winnie-project\resources\views/partials/header.blade.php */ ?>