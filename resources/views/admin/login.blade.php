<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dating App Admin Sign In</title>
 
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <link rel="stylesheet" href=" {{ asset('tempadmin/bower_components/bootstrap/dist/css/bootstrap.min.css')}} ">
 
  <link rel="stylesheet" href=" {{ asset('tempadmin/bower_components/font-awesome/css/font-awesome.min.css')}} ">
  
  <link rel="stylesheet" href=" {{ asset('tempadmin/bower_components/Ionicons/css/ionicons.min.css')}} ">
  
  <link rel="stylesheet" href=" {{ asset('tempadmin/bower_components/jvectormap/jquery-jvectormap.css')}} ">

  <link rel="stylesheet" href="{{ asset('tempadmin/dist/css/AdminLTE.min.css')}} ">

  <link rel="stylesheet" href="{{ asset('tempadmin/dist/css/skins/_all-skins.min.css')}} ">


<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/pnotify.custom.min.css') }}">

  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Dating</b>App</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Administrator sign in.</p>

    <form action="{{route("process-admin-login")}}" method="post">
      {{csrf_field()}}
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Email" required value="{{old('email')}}" autocomplete="off">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password" required value="{{old('password')}}" autocomplete="off">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">

        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

        <script src="{{ asset('temp/js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('js/pnotify.custom.min.js') }}"></script>
        <script>
        @if(Session::has('message'))

        var type = "{{ Session::get('status', 'info') }}";
          
      switch(type){
          case 'info':
                new PNotify({
                    text: '{{ Session::get('message') }}',
                    animate_speed: 'fast',
                    type: 'info'
                });
              break;

          case 'warning':
                new PNotify({
                    text: '{{ Session::get('message') }}',
                    animate_speed: 'fast',
                    type: 'warning'
                });
              break;

          case 'success':
                new PNotify({
                    text: '{{ Session::get('message') }}',
                    animate_speed: 'fast',
                    type: 'success'
                });
              break;

          case 'error':
                new PNotify({
                    text: '{{ Session::get('message') }}',
                    animate_speed: 'fast',
                    type: 'error'
                });
              break;
       }
        @endif
        </script>

</body>
</html>
