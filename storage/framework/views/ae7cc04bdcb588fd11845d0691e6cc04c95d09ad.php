<!doctype html>
<html lang="en">
    <head>
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
        <link rel="stylesheet" href="<?php echo e(asset('temp/vendors/animate-css/animate.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('temp/vendors/popup/magnific-popup.css')); ?>">
        <!-- main css -->
        <link rel="stylesheet" href="<?php echo e(asset('temp/css/style.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/main.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('temp/css/responsive.css')); ?>">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo e(asset('css/pnotify.custom.min.css')); ?>">
        <style type="text/css"></style>
    </head>
    <body data-spy="scroll" data-target="#mainNav" data-offset="70">
        <!--================Header Menu Area =================-->
        <?php echo $__env->make('partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!--================Header Menu Area =================-->

        <!--================Latest News Area =================-->
        <section class="latest_news_area p_120" style="background-image:url('<?php echo e(asset('temp/img/banner/smiling.jpg')); ?>');background-position: center; padding-bottom: 30px !important;">
            <div class="container">
                <div class="latest_news_inner row">
                    <div class="col-md-6 col-sm-12">
                        <div class="l_news_item" style="padding-top: 30px!important;padding-bottom: 30px!important;">
                        <h3>Create Account</h3>
                            <form id="join-us-form" onsubmit="return JoinUs();">
                              <div class="form-group row">
                                <label for="username" class="col-sm-4 col-form-label">Username</label>
                                <div class="col-sm-8">
                                  <input type="text" name="username" placeholder="username" class="form-control" id="username">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                  <input type="email" name="email" placeholder="email" class="form-control" id="Email">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="gender" class="col-sm-4 col-form-label">Gender</label>
                                <div class="col-sm-8" style="display: inline-flex;" id="radio_box">
                                      <div  class="col-md-4 col-md-offset-right-2">
                                        <input type="radio" name="optradio" value="male">
                                          <label class=""><img  class="" src="<?php echo e(asset("avatars/man-big.png")); ?>"></label>
                                      </div>
                                      <div class="col-md-4 col-md-offset-right-2">
                                          <input type="radio" name="optradio" value="female">
                                          <label class="radio-inline"><img class=""  src="<?php echo e(asset("avatars/woman-big.png")); ?>"></label>
                                        
                                      </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="age" class="col-sm-4 col-form-label">Age</label>
                                <div class="col-sm-8">
                                      <select class="form-control" name="age" id="age">
                                          <option value="">--Select--</option>
                                          <?php for($i=18; $i<100;$i++): ?>
                                          <option value="<?php echo e($i); ?>" ><?php echo e($i); ?></option>
                                          <?php endfor; ?>
                                      </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="password_1" class="col-sm-4 col-form-label">Password</label>
                                <div class="col-sm-8">
                                  <input type="password" name="password" id="password-one" class="form-control" placeholder="Password" autocomplete="off">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="password_2" class="col-sm-4 col-form-label">Confirm password</label>
                                <div class="col-sm-8">
                                  <input type="password" name="password_2" id="password-two" class="form-control" placeholder="Confirm Password" autocomplete="off">
                                </div>
                              </div>
                              <div class="row">
                                    <button type="submit" class="btn btn-success btn-sm col-md-4 col-sm-12 pull-left" type="button" id="btn-register" >Join Us &nbsp;<i class="spinner" id="spinner-register" style="display: none;"></i></button>
                              </div>
                              <div class="row">
                                  <a href="<?php echo e(route('user-login')); ?>" style="margin-top: 3%;">Or Login </a>
                              </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Latest News Area =================-->
        <!--================ start footer Area  =================-->
        <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!--================ end footer Area  =================-->

        <script type="text/javascript">
            function JoinUs(){
                event.preventDefault()
                PNotify.removeAll();

                var info={};

                var errors=[];

                $("#join-us-form").find('.form-control').each(function(){
                    $(this).css('border-color', '#ccc');
                    if ($(this).val()==""||$(this).val()==null) {
                        $(this).css("border", "1px solid #f77575");
                        errors.push($(this).attr('name'));
                    }
                    info[$(this).attr('name')]=$(this).val();
                });
               info['gender'] = $("#join-us-form").find('input[name="gender"]:checked').val();



                info.gender= $("#radio_box input[type='radio']:checked").val();


                if (errors.length>0) {
                    new PNotify({
                        text: 'Fill in the required Fields.',
                        animate_speed: 'fast',
                        type: 'error'
                    });
                    return;
                }

                if (info.gender=="") {
                    new PNotify({
                        text: 'Select Gender!',
                        animate_speed: 'fast',
                        type: 'error'
                    });
                    return;
                }

                if ($("#password-one").val() !== $("#password-two").val()) {
                    $("#password-one").css("border-color","red");
                    $("#password-two").css("border-color","red");
                    new PNotify({
                        text: 'Passwords should match!',
                        animate_speed: 'fast',
                        type: 'error'
                    });
                    return;
                }

                $("#spinner-register").show();

                $("#btn-register").addClass("disabled");

                CreateAccount(info);
            }
            function CreateAccount(info){
                PNotify.removeAll();
                $.ajax({

                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },

                    type:'POST',

                    data:info,

                    url: '<?php echo e(route('process-user-register')); ?>',

                    success:function(response){
                        $("#spinner-register").hide();
                         $("#btn-register").removeClass("disabled");
                        if(response.status=='success'){
                            new PNotify({
                                text: response.message,
                                animate_speed: 'fast',
                                type: 'info'
                            });
                            setTimeout(()=>{
                              window.location.href="<?php echo e(route('user-login')); ?>";
                            }, 1000);
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
                        $("#spinner-register").hide();
                        $("#btn-register").removeClass("disabled");
                          new PNotify({
                              text: 'Error occurred , try again later',
                              animate_speed: 'fast',
                              type: 'info'
                          });
                    }

                });
            }

        </script>

    </body>
</html>

<?php /* C:\Users\WYN\winnie-project\resources\views/user/register.blade.php */ ?>