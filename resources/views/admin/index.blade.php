@extends('admin.layout.layout')
@section('content')
<?php 
use App\User;
use App\FoodService;
use App\Booking;
use App\FoodCategory;
use App\Deal_of_day;
$totalUser=User::count('id');
$totalProduct=FoodService::count('id');
$totalCategory=FoodCategory::count('id');
$totalOrder=Booking::count('id');

$countEmpityStock=FoodService::where(['stock'=>'0'])->get()->toArray();
$totalEmpityStock=count($countEmpityStock);

$dealCountEmpityStock=Deal_of_day::where(['stock'=>'0'])->get()->toArray();
$totalDealEmpityStock=count($dealCountEmpityStock);
?>
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Meat Empire</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>{{$totalUser}}</h3>
                  <p>Total User</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="{{url('user')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>{{$totalProduct}}<sup style="font-size: 20px"></sup></h3>
                  <p>Total Product</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{url('product')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>{{$totalCategory}}</h3>
                  <p>Total Product Category</p>
                </div>
                <div class="icon">
                  <i class="ion  ion-pie-graph"></i>
                </div>
                <a href="{{url('categories')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>{{$totalOrder}}</h3>
                  <p>Total Order</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="{{url('order')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box" style="background-color:#607d8b;color:#fff">
                <div class="inner">
                  <h3>{{$totalEmpityStock + $totalDealEmpityStock}}</h3>
                  <p>Empity Stock</p>
                </div>
                <div class="icon">
                  <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="{{url('stock')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

          </div><!-- /.row -->

      </div><!-- /.content-wrapper -->
@endsection
