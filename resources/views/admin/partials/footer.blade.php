  <footer class="main-footer">
 {{--    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved. --}}
  </footer>

  <!-- Control Sidebar -->
  {{-- @include('admin.partials.aside-control') --}}
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('temp/js/jquery-3.2.1.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src=" {{ asset('tempadmin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src=" {{ asset('tempadmin/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('tempadmin/dist/js/adminlte.min.js')}}"></script>
<!-- Sparkline -->
<script src=" {{ asset('tempadmin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap  -->
<script src="{{ asset('tempadmin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{ asset('tempadmin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- SlimScroll -->
<script src=" {{ asset('tempadmin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- ChartJS -->
<script src=" {{ asset('tempadmin/bower_components/chart.js/Chart.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('tempadmin/dist/js/pages/dashboard2.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('tempadmin/dist/js/demo.js')}}"></script>
<script src="{{ asset('tempadmin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('tempadmin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
 <script src="{{ asset('js/pnotify.custom.min.js') }}"></script>
 <script src="{{ asset('tempadmin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>


<script>

$('.select2').select2()

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

function SendEmailVerificationLink (user) {
  console.log(user);
}
</script>
</body>
</html>