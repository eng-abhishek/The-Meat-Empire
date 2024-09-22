@extends('admin.layout.layout')
@section('content')
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admin 
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Edit</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
    <!--       <div class="col-md-1"></div> -->
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Delivery Location Management</h3>
                </div><!-- /.box-header -->

                <!-- form start -->
                <form role="form" method="post" id="editServicesForm" action="{{url('city-update')}}" enctype="multipart/form-data">
                  <div class="box-body">
                  
                   <div class="form-group">
                    <label for="offer">City Name</label>                      
                    <input type="text" id="city_name" value="{{$editAmount->name}}" class="form-control" name="city_name" required>
                        @error('city_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>

                   <div class="form-group">
                    <label for="surprise">Select Category</label>                      
                   <select name="cate" class="form-control">
                   <option value="">-- Select Category --</option>
                   <option <?php if($editAmount->category=='A'){ echo"selected";} ?> value="A">A</option>
                   <option <?php if($editAmount->category=='B'){ echo"selected";} ?> value="B">B</option>
                   <option <?php if($editAmount->category=='C'){ echo"selected";} ?> value="C">C</option>
                   </select>
                        @error('surprise')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     *Optional 
                   </div>

                    @csrf

                  </div><!-- /.box-body -->
                  <input type="text" hidden name="editId" value="{{$editAmount->id}}"> 
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->

            </div><!--/.col (left) -->
            <!-- right column -->
          <!--   <div class="col-md-1"></div> -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection
@section('script')
<script>
      $(function(){
$('.js-example-basic-multiple').select2();
$('#editServicesForm').validate({
 rules:{
  amount:{
  required:true,
  number:true,
  },
  offer:{
  required:false,
  number:true,
  },
  surprise:{
  number:true,  
  }
  },
messages:{
foodName:{
    required:'*Plese Enter Product Name',
},
  offer:{
    number:'*Food Offer Should Be Integer',
  },  
 }

});
});

</script>
@stop


      