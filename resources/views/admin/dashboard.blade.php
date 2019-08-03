  @include('admin.partials.header')
  @include('admin.partials.aside')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrator
        <small>dashboard</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
              <div class="col-md-6 col-sm-12">
                <p>System Users</p>
              </div>
              <div class="col-md-6 col-sm-12">
                <button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#new-system-user">
                  <span class="glyphicon glyphicon-plus"></span>&nbsp;
                New User</button>
              </div>  
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
               <table style="width: 100%" id="myTable" class="table table-bordered table-striped">
                    <thead>
                      <th>#</th>
                      <th>Username</th>
                      <th>Account Status</th>
                      <th>Role</th>
                      <th>Phonenumber</th>
                      <th>Gender</th>
                      <th>Age</th>
                      <th>Date of Birth</th>
                      <th>Email</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      
                      @foreach($users as $i=>$user)
                      <tr>
                        <th>{{++$i}}</th>
                        <td>{{ !empty($user->username) ? $user->username : 'Not set' }}</td>
                        <td style="color: {{ !empty($user->status) &&$user->status !=="active" ? "red" : ""}}" >
                          {{ !empty($user->status) ? $user->status : 'Not set' }}
                        </td>
                        <td>{{ !empty($user->role) ? $user->role : 'Not set' }}</td>
                        <td>{{ !empty($user->phonenumber) ? $user->phonenumber : 'Not set' }}</td>
                        <td>{{ !empty($user->gender) ? $user->gender : 'Not set' }}</td>
                        <td>{{ !empty($user->age) ? $user->age : 'Not set' }}</td>
                        <td>{{ !empty($user->dob) ? $user->dob : 'Not set' }}</td>
                        <td>{{ !empty($user->email) ? $user->email : 'Not set' }}</td>
                        <td style="display: inline-flex;">
                          <button class="btn btn-primary btn-xs" type="button" title="edit information">
                            <span class="glyphicon glyphicon-pencil" style="color: white;"></span>
                          </button>&nbsp;&nbsp;
                          @if(!empty($user->status)&&$user->status !=="active")
                            <button class="btn btn-warning btn-xs" type="button" title="click button to activate account" 
                                 onclick="unblockAccount('{{$user->id}}','{{$user->username}}')">
                              {{$user->status}}
                            </button>&nbsp;&nbsp;

                          @else
                            <button class="btn btn-info btn-xs" type="button" title="ban user" 
                                 onclick="prepareBanUser('{{$user->id}}','{{$user->username}}')">
                              Ban
                            </button>&nbsp;&nbsp;
                          @endif

                          <button class="btn btn-danger btn-xs" type="button" title="delete user">
                            <span class="glyphicon glyphicon-trash" style="color: #fff;"></span>
                          </button>&nbsp;&nbsp;
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
               </table>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<div class="modal fade" id="new-system-user">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">New User</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <form class="form-horizontal" method="post" action="{{route('process-new-user')}}">
              {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="Username" class="col-sm-2 control-label">Username</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" name="username" 
                    placeholder="Username" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="email" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control"  id="email" name="email" 
                    placeholder="Email" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="gender" class="col-sm-2 control-label">Gender</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="gender" id="gender">
                       <option value="">--Select--</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="age" class="col-sm-2 control-label">Age</label>

                  <div class="col-sm-10">
                    <input type="number" class="form-control" min="0" name="age" 
                    max="100" id="age" placeholder="Age" required>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="phonenumber" class="col-sm-2 control-label">Phonenumber</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="phonenumber" name="phonenumber"
                     placeholder="phonenumber" required>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="role" class="col-sm-2 control-label">Role</label>

                  <div class="col-sm-10">
                    <select class="form-control" required name="role" id="role" required>
                      <option value="">--Select--</option>
                      @foreach($roles as $role)
                      <option value="{{$role->id}}">{{$role->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

              </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="ban-user-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ban User</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <form class="form-horizontal" method="post" action="#">
              {{csrf_field()}}
              <div class="box-body">
                <h5 class="text-info text-center" id="p-message"></h5>
                
                <div class="form-group">
                  <label for="phonenumber" class="col-sm-2 control-label">Reasons</label>
                  <input type="hidden" id="userToBebanned" name="user">
                  <div class="col-sm-10">
                    <textarea id="block-message" class="form-control" style="resize: none;height: 300px;" placeholder="Why are you blocking this person?"></textarea>
                  </div>
                </div>

              </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" style="width: 150px;" onclick="BanUser()">Ban User<i class="spinner" id="spinner-ban" style="display:none;margin-left: 5px;"></i></button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@include('admin.partials.footer')

<script type="text/javascript">
  $(function () {
      $('#myTable').DataTable()
  });
  function prepareBanUser(userId,username="this user"){
    PNotify.removeAll();
    $("#spinner-ban").hide();
    $("#block-message").css("border-color","#d2d6de");
    $("#userToBebanned").val("");
    $("#block-message").val("");
    $("h5#p-message").html("");
    console.log(userId);

    if(userId=="") {
      new PNotify({
          text: "System error, Kindly try again later.",
          animate_speed: 'fast',
          type: 'error'
      });
      return
    }

    $("#userToBebanned").val(userId);

    if (userId=='{{Auth::id()}}') {
      $("h5#p-message").html("Provide reasons to why you  suspending your account ?");
    }else{
      $("h5#p-message").html("Provide reasons to why your blocking <strong>" +username + "</strong> ?");
    }
    

    $("#ban-user-modal").modal("show");


  }

  function BanUser(){
    $("#spinner-ban").hide();

    PNotify.removeAll();

    var user =$("#userToBebanned").val();
    var message =$("#block-message").val();

    $("#block-message").css("border-color","#d2d6de");

    if(message=="") {
      $("#block-message").css("border-color","red");
      new PNotify({
          text: "Provide a statement or reasons to block this user.",
          animate_speed: 'fast',
          type: 'error'
      });
      return 

    }
    if(user=="") {
        new PNotify({
            text: "System error, Kindly try again later.",
            animate_speed: 'fast',
            type: 'info'
        });
       return 
    }

    var info={
      user:user,
      message:message
    };

    // console.log(info);

    $("#spinner-ban").show();
    $.ajax({

        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

        type:'post',

        data:info,

        url: '{{route('ban-user')}}',


        success:function(response) {
          $("#spinner-ban").hide();
          if(response.status=='success'){
            new PNotify({
                text: response.message,
                animate_speed: 'fast',
                type: 'success'
            });

            setTimeout(function(){
              location.reload();
            },1000);
            
          }
          if(response.status=='info'){
            new PNotify({
                text: response.message,
                animate_speed: 'fast',
                type: 'info'
            });
          }
        },


        error:function(response) {
          $("#spinner-ban").hide();
          new PNotify({
              text: "System error, Kindly try again later.",
              animate_speed: 'fast',
              type: 'error'
          });
        }

    });

  }

  function unblockAccount(){
    if (confirm("Are you sure you want to activate this User?")) {

    }
  }
</script>
