  @include('admin.partials.header')
  @include('admin.partials.aside')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Adminstration
        <small>Cities</small>
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
                <button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#new-system-city">
                  <span class="glyphicon glyphicon-plus"></span>&nbsp;
                New City</button>
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
                      <th>Country</th>
                      <th>Created At</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      
                      @foreach($cities as $i=>$city)
                      <tr>
                        <th>{{++$i}}</th>
                        <td>{{ !empty($city->name) ? $city->name : 'Not set' }}</td>
                        <td>{{ !empty($city->country) ? $city->country->name : 'Not set' }}</td>
                        <td>{{ !empty($city->created_at) ? $city->created_at : 'Not set' }}</td>
                        <td>
                          <button class="btn btn-info btn-xs" type="button" title="edit information" 
                          onclick="EditCity('{{$city->id}}','{{$city->name}}','{{$city->country_id}}')">
                            <span class="glyphicon glyphicon-pencil" style="color: white;"></span>
                          </button>&nbsp;&nbsp;
                          <button class="btn btn-danger btn-xs" type="button" title="delete country" onclick="deleteCity('{{$city->id}}')">
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


<div class="modal fade" id="new-system-city">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">New City</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <form class="form-horizontal" method="post" action="{{route('process-city')}}">
              {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="Name" class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="Name" class="col-sm-2 control-label">Country</label>

                  <div class="col-sm-10">
                    <select name="country" class="form-control select2" required style="width: 100%;">
                      <option value="">--Select--</option>
                      @foreach($countries as $country)
                      <option value="{{$country->id}}">{{$country->name}}</option>
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


<div class="modal fade" id="edit-system-city">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit City</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <form class="form-horizontal" method="post" id="edit-city-form" action="#">
              {{csrf_field()}}
              <div class="box-body">
                <input  class="form-control" type="hidden" id="city_id" name="city_id">
                <div class="form-group">
                  <label for="Name" class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="edit-name" placeholder="Name" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="Name" class="col-sm-2 control-label" >Country</label>

                  <div class="col-sm-10">
                    <select name="country" class="form-control" id="edit-country" required style="width: 100%;">
                      <option value="">--Select--</option>
                      @foreach($countries as $country)
                      <option value="{{$country->id}}">{{$country->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" onclick="SaveNewCity()" class="btn btn-primary">Submit</button>
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

  function deleteCity(id){
    PNotify.removeAll();
    if (id!==null) {
      if (confirm("Confirm deletion")) {
        $.ajax({

            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

            type:'POST',

            data:{id:id},

            url: '{{route('delete-city')}}',

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

  function EditCity(id,name,country){

    console.log(id,name,country);

    PNotify.removeAll();
    $("form#edit-city-form").find('.form-control').each(()=>{
      $(this).val("");
    });

    if (id!==null) {

      $("#edit-system-city").modal('show');
      $("input#city_id").val(id);
      $("input#edit-name").val(name);
      $("select#edit-country").val(country);

    }else{
      new PNotify({
          text: "Error occurred , try again later!",
          animate_speed: 'fast',
          type: 'info'
      });
    }
  }

  function SaveNewCity(){
    var obj = {};

    var errors=[];

    $("form#edit-city-form").find('.form-control').each(function(){

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

          url: '{{route('edit-city')}}',

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
