@extends('admin.layout.layout')
@section('title','Testimonial Detail')
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
                  <h3 class="box-title">Testimonial Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Client Name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$testDetails->clint_name}}</div>    
           </div>
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Client Message</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{!! $testDetails->clint_msg !!}</div>    
           </div>
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Client Image</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">
           <img class="img img-responsive thumbnail details-img-size" style="width:180px;height:180px;" src="{{asset("uploads/testimonial/$testDetails->clint_img")}}"/>
           </div>    
           </div>

                      <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Client Deasignation</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$testDetails->clint_designation}}</div>    
           </div>

                      <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Client Facebook URL</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$testDetails->clint_fb_url}}</div>    
           </div>
           
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Client Insta URL</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$testDetails->clint_insta_url}}</div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Client Rate</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$testDetails->client_rate}}</div>    
           </div>

              </div><!-- /.box -->
            </div><!--/.col (left) -->
            <!-- right column -->
          <!--   <div class="col-md-1"></div> -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection



      