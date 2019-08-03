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
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/jquery.dataTables.min.css')); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

</head>
<body data-spy="scroll" data-target="#mainNav" data-offset="70" style="background: #ffffff !important;">
<?php echo $__env->make('partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="latest_news_area p_120">
    <div class="container">
         <h5 id="complete-registration"  class="text-info">Complete registration to continue to dashboard.</h5>
        <?php if(Auth::user()->email_verified_at == null): ?>

        <?php if(!(\App\EmailVerification::where('email',Auth::user()->email)->exists())): ?>
          <div class="row col-md-12 col-sm-12 text-center">
              <div class="alert alert-warning" style="width: 100%;">
                  Please Confirm your email address, click the button to get the account verification link sent to your email address. <button class="btn btn-info btn-sm"  id="btn-email-confirmation" 
                  style="border-radius: 0px; width: 200px;" onclick="SendEmailVerificationLink('<?php echo e(Auth::user()->id); ?>')">Get link  &nbsp;<i class="spinner" id="send-email-verification-spinner" style="display: none;"></i></button> 
              </div>
          </div>
        <?php else: ?>
          <div class="row col-md-12 col-sm-12 text-center">
              <div class="alert alert-warning" style="width: 100%;">
                  Verification Link has been sent to your email address! If you have not yet received the link ,click the button for one. <button class="btn btn-info btn-sm"  id="btn-email-confirmation" style="border-radius: 0px; width: 200px;" onclick="SendEmailVerificationLink('<?php echo e(Auth::user()->id); ?>')">Get link  &nbsp;<i class="spinner" id="send-email-verification-spinner" style="display: none;"></i></button>
              </div>
          </div>
        <?php endif; ?>

        <?php endif; ?>
        <?php if(Auth::user()->profile_id == null): ?>
        <div class="row col-md-12 col-sm-12">
                    <form id="user-complete-registration"> 
                       

                        <div class="row">
                          <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" name="phonenumber" id="phonenumber" placeholder="phonenumber" required class="form-control">
                                <input type="hidden" name="user_id" id="user_id" placeholder="user_id" value="<?php echo e(Auth::user()->id); ?>" class="form-control">
                            </div>
                            
                          </div>
                          <div class="col-sm-12 col-md-3">
                              <div class="form-group">
                                  <label>Country</label>
                                  <select id="country" class="form-control " required name="country" onchange="getCities(this.value)">
                                      <option value="">--Select--</option>
                                      <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </select>
                              </div>
                            
                          </div>
                          <div class="col-sm-12 col-md-3">
                              <div class="form-group">
                                  <label>City</label>
                                  <select id="city" class="form-control" required name="city">
                                      <option value="">--Select--</option>
                                  </select>
                              </div>
                            
                          </div>
                          <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label>Facial Hair Type</label>
                                <select id="facial_hair_type" class="form-control  " name="facial_hair_type">
                                    <option value="">--Select--</option>
                                        <?php $__currentLoopData = $facialHairTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label>Hair Color</label>
                                <select id="hair_color" class="form-control " required name="hair_color">
                                    <option value="">--Select--</option>
                                        <?php $__currentLoopData = $hairColor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                         <option value="<?php echo e($color->id); ?>"><?php echo e($color->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                          </div>
                          <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label>Hair Type</label>
                                <select id="hair_type" class="form-control " required name="hair_type">
                                    <option value="">--Select--</option>
                                        <?php $__currentLoopData = $hairType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hair): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                         <option value="<?php echo e($hair->id); ?>"><?php echo e($hair->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                          </div>
                          <div class="col-sm-12 col-md-3">
                              <div class="form-group">
                                  <label>Eye color</label>
                                  <select id="eye_color" class="form-control " required name="eye_color">
                                      <option value="">--Select--</option>
                                          <?php $__currentLoopData = $eyeColor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eye): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                           <option value="<?php echo e($eye->id); ?>"><?php echo e($eye->name); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </select>
                              </div>
                          </div>
                          <div class="col-sm-12 col-md-3">
                              <div class="form-group">
                                  <label>Eye wear</label>
                                  <select id="eye_wear" class="form-control" required name="eye_wear">
                                      <option value="">--Select--</option>
                                          <?php $__currentLoopData = $eyeWear; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wear): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <option value="<?php echo e($wear->id); ?>"><?php echo e($wear->name); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </select>
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12 col-md-3">
                              <div class="form-group">
                                  <label>Seeking ?</label>
                                  <select id="seeking" class="form-control" required name="seeking">
                                      <option value="">--Select--</option>
                                          <?php $__currentLoopData = $gender; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <option value="<?php echo e($g->id); ?>"><?php echo e($g->name); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </select>
                              </div>
                          </div>
                          <div class="col-sm-12 col-md-3">
                              <div class="form-group">
                                  <label>Ethnicity ?</label>
                                  <select id="enthnicity" class="form-control " required name="enthnicity">
                                      <option value="">--Select--</option>
                                          <?php $__currentLoopData = $ethnicity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <option value="<?php echo e($e->id); ?>"><?php echo e($e->name); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </select>
                              </div>
                          </div>
                          <div class="col-sm-12 col-md-3">
                              <div class="form-group">
                                  <label>Height</label>
                                  <select id="height" class="form-control " required name="height">
                                      <option value="">--Select--</option>
                                          <?php $__currentLoopData = $height; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <option value="<?php echo e($h->id); ?>"><?php echo e($h->name); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </select>
                              </div>
                          </div>
                          <div class="col-sm-12 col-md-3">
                            
                          </div>
                        </div>





                        <div class="form-group">
                            <button class="btn btn-success btn-sm" id="btn-complete-registration" type="button" onclick="CompleteRegistration()" 
                            style="border-radius: 0px !important; width: 200px;">Update Profile &nbsp;<i class="spinner" id="spinner-complete-registration" style="display: none;"></i></button>
                        </div>
                    </form>


        </div>
        <?php endif; ?>
        <?php if(Auth::user()->profile_id !== null && Auth::user()->email_verified_at == null): ?>
        <div class="row col-md-12 col-sm-12 text-center" style="margin-top: 50px;">
            <div class="alert alert-info text-center" style="width: 100%;">
                Your Profile looks fine, kindly verify your email address!
            </div>
            
        </div>
        <?php endif; ?>
        <?php if(Auth::user()->profile_id !== null && Auth::user()->email_verified_at !== null): ?>
        <div class="row col-md-12 col-sm-12 text-center" style="margin-top: 10%;margin-bottom: 10%;">
            <div class="alert alert-info text-center" style="width: 100%;">
                Your Profile looks fine! &nbsp;<a href="<?php echo e(route('user-dashboard')); ?>" class="btn btn-success btn-sm" style="border-radius: 0px; width: 200px;" >
                  Go to dashboard
                </a>
            </div>
            
        </div>
        <?php endif; ?>
    </div>

</section>


<?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script>

$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

function getCities(id){
        PNotify.removeAll();
    if (id!==null &&id!=="") {
        $.ajax({

            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

            type:'POST',

            data:{id:id},

            url: '<?php echo e(route('get-country-cities')); ?>',

            success:function(response){
                if(response.status=='success'){
                  data =response.data;
                  var str = `<option value="">--Select--</option>`;
                  if (data.length>0) {

                    for (var i = data.length - 1; i >= 0; i--) {
                        var str1=`<option value="${data[i].id}">${data[i].name}</option>`;

                        str+=str1;
                    }
                  }else{
                      new PNotify({
                          text: 'No cities found for the selected country',
                          animate_speed: 'fast',
                          type: 'info'
                      });
                  }
                  $("select#city").html(str);
                  console.log(data)
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
                  text: "Error occurred, kindly refresh your browser!",
                  animate_speed: 'fast',
                  type: 'info'
              });
            }

        });
    }else{
      new PNotify({
          text: "Error occurred, kindly refresh your browser!",
          animate_speed: 'fast',
          type: 'info'
      });
    }
}


function CompleteRegistration(){
    PNotify.removeAll();
    $("#spinner-complete-registration").hide();
    var obj = {};

    var errors=[];

    $("form#user-complete-registration").find('.form-control').each(function(){

      $(this).css('border-color', '#ccc');

      if($(this).val()=="" || $(this).val()==null){
        errors.push($(this).attr('name'));
        $(this).css('border-color', 'red');

      }
      obj[$(this).attr('name')]=$(this).val();
    });

    // console.log(obj);

    if (errors.length>0) {
        new PNotify({
            text: "Fill in the all fields!",
            animate_speed: 'fast',
            type: 'info'
        });

      return ;
    }

    // console.log(obj);

    $("#spinner-complete-registration").show();
    $("#btn-complete-registration").addClass('disabled');

      $.ajax({

          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

          type:'POST',

          data:obj,

          url: '<?php echo e(route('complete-user-profile')); ?>',

          success:function(response){
            $("#btn-complete-registration").removeClass('disabled');
            $("#spinner-complete-registration").hide();
            // console.log(response);

              if(response.status=='success'){
                  new PNotify({
                      text: response.message,
                      animate_speed: 'fast',
                      type: 'success'
                  });
                  window.location.href= "<?php echo e(route('user-dashboard')); ?>";
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
            $("#spinner-complete-registration").hide();
            $("#btn-complete-registration").removeClass('disabled');
            new PNotify({
                text: "Error occurred , try again later!",
                animate_speed: 'fast',
                type: 'info'
            });
          }

      });

}

function SendEmailVerificationLink(id){
  PNotify.removeAll();
  if (id!==null && id!=="") {
      $("#send-email-verification-spinner").show();
      $.ajax({

          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

          type:'POST',

          data:{id:id},

          url: '<?php echo e(route('send-email-verification')); ?>',

          success:function(response){
            $("#btn-email-confirmation").removeClass('disabled');
            $("#send-email-verification-spinner").hide();
            // console.log(response);

              if(response.status=='success'){
                  new PNotify({
                      text: response.message,
                      animate_speed: 'fast',
                      type: 'success'
                  });
                  window.location.href= "<?php echo e(route('user-dashboard')); ?>";
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
            $("#send-email-verification-spinner").hide();
            $("#btn-email-confirmation").removeClass('disabled');
            new PNotify({
                text: "Error occurred , try again later!",
                animate_speed: 'fast',
                type: 'info'
            });
          }

      });
  }else{
    new PNotify({
        text: "Error occurred , try again later!",
        animate_speed: 'fast',
        type: 'info'
    });
  }
}
</script>
<script>
    <?php if(Session::has('message')): ?>

    var type = "<?php echo e(Session::get('status', 'info')); ?>";

    switch(type){
    case 'info':
        new PNotify({
            text: '<?php echo e(Session::get('message')); ?>',
            animate_speed: 'fast',
            type: 'info'
        });
      break;

    case 'warning':
        new PNotify({
            text: '<?php echo e(Session::get('message')); ?>',
            animate_speed: 'fast',
            type: 'warning'
        });
      break;

    case 'success':
        new PNotify({
            text: '<?php echo e(Session::get('message')); ?>',
            animate_speed: 'fast',
            type: 'success'
        });
      break;

    case 'error':
        new PNotify({
            text: '<?php echo e(Session::get('message')); ?>',
            animate_speed: 'fast',
            type: 'error'
        });
      break;
    }
    <?php endif; ?>
</body>
</html>

<?php /* C:\Users\WYN\winnie-project\resources\views/user/complete-profile.blade.php */ ?>