@extends('admin.layout.layout')
@section('title','Deal of Day Details')
@section('content')
<?php 
//       echo"<pre>";
// print_r($dealOfDayDetails[0]['foodName']);
// die;
?>








      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admin 
            <small>Meat Empire</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Detail</li>
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
                  <h3 class="box-title">Deal of Day Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Product Name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$dealOfDayDetails[0]['foodName']}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Product Image</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">
           <img style="width:180px;height:180px;" class="img img-responsive thumbnail details-img-size" src="{{asset('uploads/dealOfDay/'.$dealOfDayDetails[0]['productImg'])}}"/>
           </div>    
           </div>

           @foreach($dealOfDayDetails[0]['price'] as $key=>$tblprice)



                  <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Product Pices {{$key+1}}</div>
           <div class="col-sm-2">:</div>  

           <div class="row">
           <div class="col-sm-2">{{$tblprice[0]['quantity']}}</div>
           <div class="col-sm-2">{{$tblprice[0]['quantity_type']}}</div>

           <div class="col-sm-1">
           <i class="fa fa-rupee"></i>
           {{$tblprice[0]['price']}}</div>
            </div>
           
           </div>


           @endforeach  

           </div><!-- /.box -->
            </div><!--/.col (left) -->
            <!-- right column -->
          <!--   <div class="col-md-1"></div> -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->










@endsection



      