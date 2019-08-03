
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
<section class="latest_news_area p_120 bg-light">
    <div class="d-flex bg-light settings-wrapper" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action bg-light" id="email-tab">Change Emails</a>
                <a href="#" class="list-group-item list-group-item-action bg-light" id="password-tab">Change Password</a>
                <a href="#" class="list-group-item list-group-item-action bg-light" id="notifications-tab">Notifications</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper" style="width: 85%; height: 400px;">

            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                {{--<span class="btn btn-primary" id="menu-toggle">Toggle Menu</span>--}}

                <h2>Account Settings</h2>


            </nav>

            <div class="container-fluid bg-light" >


                <form class="email active" >

                <div class="form-group">

                    <div class="col-md-8" style="width: 100%;">
                        <h4 class="mt-4">Edit Email</h4>
                        <input type="email" name="email"  class="form-control" value="{{Auth::user()->email}}" id="Email">
                        <input type="hidden" name="user_id"  class="form-control" value="{{Auth::user()->id}}" id="user_id">
                        <br>

                        <button type="button" class="btn btn-success" style="float: right; margin-bottom: 5%">Save Cahnges</button>
                    </div>



                </div>

                </form>
                <form class="password" style="display: none;">

                    <div class="form-group">

                        <div class="col-md-8" style="width: 100%;">
                            <h4 class="mt-4">Change Password</h4>
                            <label for="email" class="col-sm-4 col-form-label">Enter your old password</label>
                            <input type="password" name="original_pass"  class="form-control"  id="old_pass">
                            <label for="email" class="col-sm-4 col-form-label">Enter New Password</label>
                            <input type="password" name="new_pass"  class="form-control"  id="new_pass">
                            <br>

                            <button type="button" class="btn btn-success" style="float: right; margin-bottom: 5%">Save New Password</button>
                        </div>



                    </div>

                </form>
                <form class="notifications" style="display: none;">

                    <div class="form-group">

                        <div class="col-md-8" style="width: 100%;">
                            <h4 class="mt-4">Notifications</h4>

                            <br>
                        </div>



                    </div>

                </form>


            </div>

        </div>
        <!-- /#page-content-wrapper -->

    </div>

</section>
@include('partials.footer')
<script type="text/javascript">
    $(document).ready(function() {
        $('#page-content-wrapper').find("#menu-toggle").click(function (e) {
            alert('why isnt anything happening?');
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    });
</script>
</body>
</html>
