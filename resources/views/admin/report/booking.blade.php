@extends('admin.layout.layout')
@section('title','Booking Report')
@section('content')
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Booking Report
            <small>Meat Empire</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Report</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Booking Report</h3>
                  <a href="{{url('order-report-excel')}}" style="float: right"><button class="btn btn-sm btn-info"><i class="fa fa-file-excel-o"></i>&nbsp;Export Excel</button></a> 
                </div><!-- /.box-header -->
<form method="post" action="{{url('payment-report')}}">                
<div class="col-sm-3"></div>
<div class="col-sm-2">
<span>From</span><input type="date" class="form-control" max="{{date('Y-m-d')}}" name="fromDate" required="">
</div>
@csrf
<div class="col-sm-2">
<span>To</span></span><input type="date"  class="form-control"  max="{{date('Y-m-d')}}" name="toDate" required="">
</div>
<div class="col-md-1" style="margin-top:15px">
<button type="submit" class="btn btn-warning" name="dateFilter">Submit</button>  
</div>
<div class="col-md-4"></div>
</form>

                <div class="box-body">

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Order Id</th>                  
                        <th>User Name</th>
                        <th>User Email Id</th>
                        <th>Delivery Date</th>
                        <th>Delivery Time</th>
                        <th>Booking Date</th>
                        <th>Order Status</th>
                      </tr>
                    </thead>
                    <tbody>
                   @foreach($order as $key => $orderDetails)
                   <tr>
                   <td>{{$key + 1}}</td>
                   <td>{{$orderDetails->order_id}}</td>
                   <td>{{$orderDetails->f_name." ".$orderDetails->l_name}}</td> 
                   <td>
                   {{$orderDetails->email}}
                    </td>
                    <td>{{$orderDetails->delDate}}</td>
                    <td>{{$orderDetails->delTime}}</td>
                    <td>{{$orderDetails->bokDate}}</td>
                    <td>
                        {{$orderDetails->order_status}}
                    </td>
                     </tr>
                      @endforeach
                    </tbody>                   
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection