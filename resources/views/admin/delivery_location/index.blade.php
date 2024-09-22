@extends('admin.layout.layout')
@section('title','City Management')
@section('content')

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Delivery Location Management
            <small>Meat Empire</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Delivery Location</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Delivery Location List</h3>
<!--                   <a href="{{url('deal-of-day-add')}}" style="float: right"><button class="btn btn-info"><i class="fa fa-plus"></i>Add Deal of Day</button></a>  -->
                </div><!-- /.box-header -->
                <div class="box-body">

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Name</th>                  
                        <th>Category</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                   @foreach($offer as $key => $discountval)
                   <tr>
                   <td>{{$key + 1}}</td>
                   <td>{{$discountval->name}}</td>
                   <td>{{$discountval->category}}</td> 
                   <td class="action-icon">
 <a href="{{url("city-edit/$discountval->id")}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
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
