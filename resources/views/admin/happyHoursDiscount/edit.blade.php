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
                  <h3 class="box-title">Happy Hours Discount</h3>
                </div><!-- /.box-header -->

                <!-- form start -->
                <form role="form" method="post" id="editServicesForm" action="{{url('happy-hours-discount-update')}}" enctype="multipart/form-data">
                  <div class="box-body">
                  
                   <div class="form-group">
                    <label for="offer">offer</label>                      
                    <input type="number" placeholder="Amount Use As Precentage" id="offer" min="0" max="1000" value="{{$editAmount->offer}}" class="form-control" name="offer" required>
                        @error('amount')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>
<?php 
$FromdateAr=explode(' ',$editAmount->from_date);
$fromD1=$FromdateAr[0];
$fromD2=$FromdateAr[1];
$fromdate=$fromD1.'T'.$fromD2;

$TodateAr=explode(' ',$editAmount->to_date);
$ToD1=$TodateAr[0];
$ToD2=$TodateAr[1];
$todate=$ToD1.'T'.$ToD2;

$curr=explode(' ',date('Y-m-d h:i'));
$crDate=$curr[0];
$crTime=$curr[1];
$crDateTime=$crDate.'T'.$crTime;
?>

                   <div class="form-group">
                    <label for="surprise">From Date Time</label>                      
                    <input type="datetime-local" min="{{$crDateTime}}" id="formDate" value="{{$fromdate}}" class="form-control" name="formDate" required="">
                        @error('surprise')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     *Optional 
                   </div>

                    <div class="form-group">
                    <label for="surprise">To Date Time</label>                      
                    <input type="datetime-local" min="{{$crDateTime}}" id="toDate" value="{{$todate}}" class="form-control" name="toDate" required="">
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


      