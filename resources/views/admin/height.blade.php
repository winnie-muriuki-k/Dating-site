  @include('admin.partials.header')
  @include('admin.partials.aside')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
        <small>Height</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
              <div class="col-md-6 col-sm-12">
                {{-- <p>System Roles</p> --}}
              </div>
              <div class="col-md-6 col-sm-12">
                <button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#new-eye-color">
                  <span class="glyphicon glyphicon-plus"></span>&nbsp;
                New Height</button>
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
                      <th>Name</th>
                      <th>Created At</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      
                      @foreach($heights as $i=>$height)
                      <tr>
                        <th>{{++$i}}</th>
                        <td>{{ !empty($height->name) ? $height->name : 'Not set' }}</td>
                        <td>{{ !empty($height->created_at) ? $height->created_at : 'Not set' }}</td>
                        <td>
                          <button class="btn btn-info btn-xs" type="button" title="edit information" 
                          onclick="EditHeight('{{$height->id}}','{{$height->name}}')">
                            <span class="glyphicon glyphicon-pencil" style="color: white;"></span>
                          </button>&nbsp;&nbsp;
                          <button class="btn btn-danger btn-xs" type="button" title="delete Height" onclick="deleteHeight('{{$height->id}}')">
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


<div class="modal fade" id="new-eye-color">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">New Height</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <form class="form-horizontal" method="post" action="{{route('process-user-height')}}">
              {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="Name" class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
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


<div class="modal fade" id="edit-user-height">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Height</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <form class="form-horizontal" method="post" id="edit-height-form" action="#">
              {{csrf_field()}}
              <div class="box-body">
                <input  class="form-control" type="hidden" id="height_id" name="height_id">
                <div class="form-group">
                  <label for="Name" class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="edit-name" placeholder="Name" required>
                  </div>
                </div>
              </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" onclick="SaveNewHeight()" class="btn btn-primary">Submit</button>
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

  function deleteHeight(id){
    PNotify.removeAll();
    if (id!==null) {
      if (confirm("Confirm deletion")) {
        $.ajax({

            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

            type:'POST',

            data:{id:id},

            url: '{{route('delete-user-height')}}',

            success:function(response){
              console.log(response);

                if(response.status=='success'){
                    new PNotify({
                        text: response.message,
                        animate_speed: 'fast',
                        type: 'success'
                    });
                    location.reload();
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
                  text: "Error occurred , try again later!",
                  animate_speed: 'fast',
                  type: 'info'
              });
            }

        });
      }
    }else{
      new PNotify({
          text: "Error occurred , try again later!",
          animate_speed: 'fast',
          type: 'info'
      });
    }
  }

  function EditHeight(id,name){

    console.log(id,name);

    PNotify.removeAll();
    $("form#edit-height-form").find('.form-control').each(()=>{
      $(this).val("");
    });

    if (id!==null) {

      $("#edit-user-height").modal('show');
      $("input#height_id").val(id);
      $("input#edit-name").val(name);

    }else{
      new PNotify({
          text: "Error occurred , try again later!",
          animate_speed: 'fast',
          type: 'info'
      });
    }
  }

  function SaveNewHeight(){
    var obj = {};

    var errors=[];

    $("form#edit-height-form").find('.form-control').each(function(){

      $(this).css('border-color', '#ccc');

      if($(this).val()=="" || $(this).val()==null){
        errors.push($(this).attr('name'));
        $(this).css('border-color', 'red');

      }else{

        obj[$(this).attr('name')]=$(this).val();
      }
    });

    if (errors.length>0) {
        new PNotify({
            text: "Fill in the required fields!",
            animate_speed: 'fast',
            type: 'info'
        });

      return ;
    }

      $.ajax({

          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

          type:'POST',

          data:obj,

          url: '{{route('edit-user-height')}}',

          success:function(response){
            console.log(response);

              if(response.status=='success'){
                  new PNotify({
                      text: response.message,
                      animate_speed: 'fast',
                      type: 'success'
                  });
                  location.reload();
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
                text: "Error occurred , try again later!",
                animate_speed: 'fast',
                type: 'info'
            });
          }

      });
  }




  $(function () {
      $('#myTable').DataTable()
  });
</script>
