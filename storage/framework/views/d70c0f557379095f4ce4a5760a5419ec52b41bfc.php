        <footer class="footer-area p_120">
            <div class="container text-center">
                <div class="row">
                    <div class="col-lg-3  col-md-6 col-sm-6">
                        <div class="single-footer-widget tp_widgets">
                           <h6 class="footer_title">Company</h6>
                            <ul class="list">
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Other sites</a></li>
                                <li><a href="#">Corporate</a></li>
                                <li><a href="#">Affiliates</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3  col-md-6 col-sm-6">
                        <div class="single-footer-widget tp_widgets">
                           <h6 class="footer_title">Information</h6>
                            <ul class="list">
                                <li><a href="#">Success Stories</a></li>
                                <li><a href="#">Contact us</a></li>
                                <li><a href="#">Dating safety</a></li>
                                <li><a href="#">Site map</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3  col-md-6 col-sm-6">
                        <div class="single-footer-widget tp_widgets">
                           <h6 class="footer_title">Legal</h6>
                            <ul class="list">
                                <li><a href="#">Terms of sale</a></li>
                                <li><a href="#">Privacy Statement</a></li>
                                <li><a href="#">Dating safety</a></li>
                                <li><a href="#">Cookie Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3  col-md-6 col-sm-6">
                        <div class="single-footer-widget tp_widgets">
                           <h6 class="footer_title">Follow US</h6>
                            <ul class="list">
                                <li><a href="#"><i class="fa fa-facebook"></i> Facebook</a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i> Twitter</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <p class="col-lg-12 col-md-12 footer-text m-0 text-center">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved </p>
                </div>
            </div>
        </footer>
        <!--================ End footer Area  =================-->





<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo e(asset('temp/js/jquery-3.2.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('temp/js/popper.js')); ?>"></script>
<script src="<?php echo e(asset('temp/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('temp/js/stellar.js')); ?>"></script>
<script src="<?php echo e(asset('temp/vendors/lightbox/simpleLightbox.min.js')); ?>"></script>
<script src="<?php echo e(asset('temp/vendors/isotope/imagesloaded.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(asset('temp/vendors/isotope/isotope-min.js')); ?>"></script>
<script src="<?php echo e(asset('temp/vendors/owl-carousel/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(asset('temp/js/jquery.ajaxchimp.min.js')); ?>"></script>
<script src="<?php echo e(asset('temp/vendors/counter-up/jquery.waypoints.min.js')); ?>"></script>
<script src="<?php echo e(asset('temp/vendors/counter-up/jquery.counterup.js')); ?>"></script>
<script src="<?php echo e(asset('temp/js/mail-script.js')); ?>"></script>
<script src="<?php echo e(asset('temp/vendors/popup/jquery.magnific-popup.min.js')); ?>"></script>
<script src="<?php echo e(asset('temp/js/theme.js')); ?>"></script>
<script src="<?php echo e(asset('js/pnotify.custom.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/main.js')); ?>"></script>
<script src="<?php echo e(asset('js/custom-main.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script>

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

function SendEmailVerificationLink (user) {
  console.log(user);
}

</script>

<?php Session::pull('status'); ?>
<?php Session::pull('message'); ?>




<?php /* C:\Users\WYN\winnie-project\resources\views/partials/footer.blade.php */ ?>