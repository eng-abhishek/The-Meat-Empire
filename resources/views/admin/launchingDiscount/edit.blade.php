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
                  <h3 class="box-title">Launching Discount</h3>
                </div><!-- /.box-header -->

                <!-- form start -->
                <form role="form" method="post" id="editServicesForm" action="{{url('launching-discount-update')}}">
                  <div class="box-body">
                  
                   <div class="form-group">
                    <label for="offer">offer</label>                      
                    <input type="number" placeholder="Amount Use As Precentage" id="offer" min="0" max="1000" value="{{$editAmount->offer}}" class="form-control" name="offer" required>
                        @error('amount')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>

                   <div class="form-group">
                    <label for="surprise">From Date</label>                      
                    <input type="date" id="formDate"  min="{{date('Y-m-d')}}" value="{{$editAmount->from_date}}" class="form-control" name="formDate">
                        @error('surprise')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     *Optional 
                   </div>

                    <div class="form-group">
                    <label for="surprise">To Date</label>                      
                    <input type="date" id="toDate"  min="{{date('Y-m-d')}}" value="{{$editAmount->to_date}}" class="form-control" name="toDate">
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


      