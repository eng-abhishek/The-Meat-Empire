@extends('admin.layout.layout')
@section('title','Add Product Category')
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
            <li class="active">Add</li>
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
                  <h3 class="box-title">Add New Product Category</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" id="category-store" action="{{url('category-store')}}" enctype="multipart/form-data">                 
                  <div class="box-body">

                    <div class="form-group">
                      <label for="category_type">Select Category Type</label>
                     <select class="form-control" name="category_type" id="category_type" required="">                     
               <option value="">-- Select Category Type --</option>
               <option value="cate">General Category</option>
               <option value="ebc">Explore By Category</option>                 
                     </select>  
                    </div>

                    <div class="form-group">
                      <label for="category_name">Category Name</label>
                      <input type="text" class="form-control" name="category_name" id="category_name" required="">
                      @error('category_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>

                    @csrf
                      <div class="form-group">
                      <label for="category_img">Category Image</label>
                      <input type="file" class="form-control" name="category_img" id="category_img">
                      *Recommended Image Size 298*298(Optional)
                    
                      @error('category_img')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="category_logo">Category Logo</label>
                      <input type="file" class="form-control" name="category_logo" id="category_logo">
                     *Recommended Logo Size 220*180(Optional)
                      @error('category_logo')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="category_logo">Category Page Logo</label>
                      <input type="file" class="form-control" name="category_page_logo" id="category_logo">
                     *Recommended Logo Size 220*180(Optional)
                      @error('category_logo')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>

                    </div>                  
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-foodCat">Submit</button>
                  </div>
                </form>
               </div><!-- /.box-body -->
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
         
$('#category-store').validate({
 rules:{
  category_name:{
   required:true,
   minlength:5, 
   maxlength:30,   
  }
 },
 messages:{
   category_name:{
   required:'*Please Enter Category Name', 
   }    
 } 
});

});
</script>
@stop


      