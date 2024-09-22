@extends('admin.layout.layout')
@section('title','Add Testimonial')
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
            <li class="active">Tax</li>
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
                  <h3 class="box-title">Tax Management</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" id="testimonialForm" action="{{url('tax-store')}}">
                  <div class="box-body">

<div class="row">
<div class="col-md-12">
 @if($tax)              
                      <label for="tax">Enter Tax Amount</label>
                      <input type="number" min="0" maxlength="5" value="{{$tax->amount}}" class="form-control" name="tax" id="tax" required>
                      <input type="text" hidden="" name="editId" value="{{$tax->id}}">
                      @error('service_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
@else
                      <label for="tax">Enter Tax Amount</label>
                      <input type="number" min="0" maxlength="5" class="form-control" name="tax" id="tax" required>
                      @error('service_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
@endif
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
  tax:{
  required:true, 
  number:true,
    }
    },
  messages:{
  tax:{
  required:'*Please Enter Tax Amount',
     }
     }
});

});
 

</script>
@stop
      