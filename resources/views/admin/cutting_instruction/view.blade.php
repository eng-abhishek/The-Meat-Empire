@extends('admin.layout.layout')
@section('title','Cutting Instruction')
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
            <li class="active">CMS</li>
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
                  <h3 class="box-title">Cutting Instructions</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" id="testimonialForm" action="{{url('cutting-instructions-add')}}" enctype="multipart/form-data">
                  <div class="box-body">

                <div class="row">
                <div class="col-md-12">
                <label for="clint_name">Enter Cutting Instruction</label>
                </div>  
                </div>

<div class="row">
<div class="col-md-12">              
                    <input type="text" name="cuttingIns" required class="form-control">
                     @error('product')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>
</div>
                    @csrf
                  </div><!-- /.box-body -->                
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

$('#testimonialForm').validate({
rules:{
cuttingIns:{
    required:true,
   minlength:3, 
   maxlength:50, 
  }
},
messages:{
cuttingIns:{
required:"Please Enter Cutting Instructions",
  }
   
}
});

});
</script>
@stop   
         