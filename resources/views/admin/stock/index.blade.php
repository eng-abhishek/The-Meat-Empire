@extends('admin.layout.layout')
@section('title','Stock')
@section('content')
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
              Stock
            <small>Meat Empire</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Stock</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Empity Stock</h3>
          <!--         <a href="{{url('order-report-excel')}}" style="float: right"><button class="btn btn-sm btn-info"><i class="fa fa-file-excel-o"></i>&nbsp;Export Excel</button></a>  -->
                </div><!-- /.box-header -->
                <div class="box-body">

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Product Type</th>
                        <th>Product Category Name</th>
                        <th>Product Name</th>                  
                        <th>Product Image</th>
                        <th>Stock</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                   @foreach($stock as $key => $orderDetails)
                   <tr>
                   <td>{{$key + 1}}</td>
                   <td>General</td>
                   <td>{{$orderDetails['cate_name']}}</td> 
                   <td>{{$orderDetails['service_name']}}</td>
                   <td>
         
<img src="{{asset('uploads/foodService/'.$orderDetails['service_img'])}}" width="50px">
                    </td>
                    <td>N/A</td>
                    <td>
<a href="{{url('product-edit/'.$orderDetails['id'])}}" class="btn btn-info"><i class="fa fa-edit"></i></a>    
                    </td>
                    </tr>

                      @endforeach

    @foreach($dealStock as $Skey => $dealStockval)
                     <tr>
                   <td>{{$Skey+ 1}}</td>
                   <td>Deal Of Day</td>
                   <td>N/A</td> 
                   <td>{{$dealStockval['foodName']}}</td>
                   <td>         
<img src="{{asset('uploads/dealOfDay/'.$dealStockval['productImg'])}}" width="50px">
                    </td>
                    <td>N/A</td>
                    <td>
<a href="{{url('deal-of-day-edit/'.$dealStockval['id'])}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
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