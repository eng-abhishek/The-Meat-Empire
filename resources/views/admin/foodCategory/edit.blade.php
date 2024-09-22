@extends('admin.layout.layout')
@section('title','Edit Product Category')
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
                  <h3 class="box-title">Edit Product Category</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" id="editDoctorCatForm" action="{{url('category-update')}}" enctype="multipart/form-data">
                  <div class="box-body">

                 <div class="form-group">
                      <label for="category_type">Select Category Type</label>
                     <select class="form-control" name="category_type" id="category_type" required="">                     
               <option value="">-- Select Category Type --</option>
               <option <?php if($editData->category_type=='cate'){ echo"selected";}?> value="cate">General Category</option>
               <option  <?php if($editData->category_type=='ebc'){ echo"selected";}?> value="ebc">Explore By Category</option>                 
                     </select>  
                    </div>

                    <div class="form-group">
                      <label for="service_name">Category Name</label>
                      <input type="text" class="form-control" name="category_name" id="service_name" value="{{$editData->category_name}}" required="">
                      @error('category_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>
                    @csrf

                     <div class="form-group">
                      <label for="category_img">Category Image</label>
                      <input type="file" class="form-control" name="category_img" id="category_img">
                      *Recommended Image Size Image Size 298*298<br> 
                         
                      @error('category_img')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>

<?php 
if($editData->category_img=='NULL'){
  ?>
  <input type="text" hidden name="OldImg" value="NULL"> 
<?php
}else{
  ?>
<img src="{{ asset("uploads/foodCategory/$editData->category_img")}}" width="50px">
<input type="text" hidden name="OldImg" value="{{$editData->category_img}}"> 
<?php
}
?>


                     <div class="form-group">
                      <label for="category_img">Category Logo</label>
                      <input type="file" class="form-control" name="category_logo" id="category_logo">
                     *Recommended Logo Size Max 220*180(Optional)<br>
                     @error('category_logo')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                              
<?php 
if($editData->category_logo=='NULL'){
  ?>
 <input type="text" hidden name="OldLogo" value="NULL">
<?php
}else{
  ?>
<img src="{{ asset("uploads/foodCategoryLogo/$editData->category_logo")}}" width="50px">
 <input type="text" hidden name="OldLogo" value="{{$editData->category_logo}}">
<?php
}
?>
                    </div>

                   <div class="form-group">
                      <label for="category_logo">Category Page Logo</label>
                      <input type="file" class="form-control" name="category_page_logo" id="category_logo">
                     *Recommended Logo Size 220*180(Optional)
                      @error('category_logo')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      <?php 
if($editData->pageLogo=='NULL'){
  ?>
 <input type="text" hidden name="OldLogo" value="NULL">
<?php
}else{
  ?>
<img src="{{ asset("uploads/categoryPageLogo/$editData->pageLogo")}}" width="50px">
 <input type="text" hidden name="OldPLogo" value="{{$editData->pageLogo}}">
<?php
}
?>
                    </div>



              </div><!-- /.box-body -->
                  <input type="text" hidden name="editId" value="{{$editData->id}}"> 
          
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
  category_name:{
   required:true, 
   maxlength:30,
   minlength:5,
  },
},
messages:{
   category_name:{
   required:'*Please Enter Category Name', 
   },   
}
});

});
</script>
@stop



      