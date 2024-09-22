@extends('admin.layout.layout')
@section('title','Edit Co Brand')
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
                  <h3 class="box-title">Edit Co Brand</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
  <form role="form" method="post" id="cobrand-store" action="{{url('co-brand-update')}}" enctype="multipart/form-data">                 
                  <div class="box-body">
                    <div class="form-group">
                      <label for="name">Co Brand Name</label>
                      <input type="text" class="form-control" value="{{$editData->name}}" name="name" id="name" required="">
                      <input type="text" hidden name="editId" value="{{$editData->id}}"> 
                      @error('name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>
                    @csrf
                    
                    <div class="form-group">
                      <label for="img">Image</label>
                      <input type="file" class="form-control" name="img" id="img">
                  @if($editData->img)
                  <img src="{{asset("uploads/cobrands/$editData->img")}}" width="100px" required>
                   <input type="text" hidden name="OldImg" value="{{$editData->img}}">
                    @endif
                      @error('img')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>
                   

                    </div>                  
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
$('#editDoctorCatForm').validate({
rules:{
   name:{
   maxlength:30,
   minlength:5,  
   required:true, 
  },
},
messages:{
   category_name:{
   required:'*Please Enter Category Name', 
   },   
}
});

</script>
@stop



      