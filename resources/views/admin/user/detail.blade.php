@extends('admin.layout.layout')
@section('title','User Detail')
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
                  <h3 class="box-title">User Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">User Name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$testDetails->f_name." ".$testDetails->l_name}}</div>    
           </div>
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">User Email</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$testDetails->mobile_no}}</div>    
           </div>
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">User Contact No</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$testDetails->email}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Profile Picture</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">
           <?php 
           if($testDetails->img){
           $img=asset("uploads/user/$testDetails->img");
           }else{
           $img=asset("assets/front-end/img/default-img.png");
           }

           ?> 
           <img class="img img-responsive thumbnail details-img-size" style="width:180px;height:180px;" src="{{$img}}"/>
           </div>    
           </div>



           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">City</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$cityName}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Flat No</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$testDetails->flat_no}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Address</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$testDetails->address}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Landmark Address</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$locationName}}</div>    
           </div>

              </div><!-- /.box -->
            </div><!--/.col (left) -->
            <!-- right column -->
          <!--   <div class="col-md-1"></div> -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection



      