@extends('admin.layout.layout')
@section('title','Edit Sector')
@section('content')
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admin 
            <small>Meat Empire</small>
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
                  <h3 class="box-title">Edit Sector</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" id="editDoctorCatForm" action="{{url('sector-update')}}" enctype="multipart/form-data">
                  <div class="box-body">

                  <div class="form-group">
                     <label for="cityId">Select City</label>
                     <select name="cityId" class="form-control" required="">
                     <option value="">-- Select City --</option> 
                     @if($city)
                     @foreach($city as $citydata)
                     <option <?php if($citydata->id==$location->cate_id){ echo"selected";}?> value="{{$citydata->id}}">{{$citydata->name}}</option>
                     @endforeach
                     @else
                     @endif
                     </select> 
                     </div>
                     <div class="form-group">
                      <label for="sectorname">Enter Sector Name</label>
                      <input type="text" value="{{$location->location_name}}" class="form-control" name="sectorname" id="sectorname" required="">
                     </div>
                     @csrf
   
                  </div><!-- /.box-body -->
                  <input type="text" hidden name="editId" value="{{$location->id}}"> 
          
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary edit-btn-foodCat">Submit</button>
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
 
$('.topbar-errmsg').hide();  
$('.catSec-errmsg').hide();   
$('#editDoctorCatForm').validate({
rules:{
  couponCode:{
   required:true, 
   maxlength:6,
   minlength:3,
     },
  user_id:{
   required:true,
  }
},
messages:{
   couponCode:{
   required:'*Please Enter Category Name', 
   },
  user_id:{
   required:'*Please Select User',
  }
}
});

});
</script>
@stop



      