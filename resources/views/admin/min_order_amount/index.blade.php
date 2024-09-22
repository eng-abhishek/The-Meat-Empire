@extends('admin.layout.layout')
@section('title','Min Order Amount Management')
@section('content')

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Min Order/Express Delivery Amount Management
            <small>Meat Empire</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Min Order</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Min Order Amount List</h3>
<!--                   <a href="{{url('deal-of-day-add')}}" style="float: right"><button class="btn btn-info"><i class="fa fa-plus"></i>Add Deal of Day</button></a>  -->
                </div><!-- /.box-header -->
                <div class="box-body">

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Category</th>
                        <th>Min Order Amount</th>
                        <th>Express Delivery Amount</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                   @foreach($offer as $key => $discountval)
                   <tr>
                   <td>{{$key + 1}}</td>
                   <td>{{$discountval->category}}</td>
                   <td>{{$discountval->amount}}</td> 
                   <td>{{$discountval->expressDelAmount}}</td> 
                   <td class="action-icon">
 <a href="{{url("min-order-amount-edit/$discountval->id")}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
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
