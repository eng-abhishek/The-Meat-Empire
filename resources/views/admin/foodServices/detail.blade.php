@extends('admin.layout.layout')
@section('title','Product Details')
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
                  <h3 class="box-title">Product Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Product Name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$ServDetails[0][0]['service_name']}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Product Short Description</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$ServDetails[0][0]['service_short_des']}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Product Image</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">
           <img style="width:180px;height:180px" class="img img-responsive thumbnail details-img-size" src="{{asset('uploads/foodService/'.$ServDetails[0][0]['service_img'])}}"/>
           </div>    
           </div>

@foreach($ServDetails[0]['price'] as $key=>$tblprice)
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Product Price {{$key+1}}</div>
           <div class="col-sm-2">:</div>  

           <div class="row">
           <div class="col-sm-3">{{$tblprice[quantity]}} {{$tblprice[quantity_type]}} 
            <i class="fa fa-rupee"></i>
           {{$tblprice[price]}}
           </div>
       <!--     <div class="col-sm-1"></div>

           <div class="col-sm-1">
          </div> -->
            </div>
           
           </div>
@endforeach  
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Product Offer</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">
<?php if($ServDetails[0][0]['service_offer']){
$offer=$ServDetails[0][0]['service_offer'];
}else{
$offer='0';
}
?>
           {{$offer}}%</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Tax On Product</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">
<?php if($ServDetails[0][0]['tax']){
$tax=$ServDetails[0][0]['tax'];
}else{
$tax='0';
}
?>
           {{$tax}}%</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Available Stock</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">
<?php if($ServDetails[0][0]['stock']){
$stock=$ServDetails[0][0]['stock'];
}else{
$stock='0';
}
?>
           {{$stock}} {{$ServDetails[0][0]['stock_qty_type']}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Product Available In City</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">

<?php if($availableCityData){
foreach ($availableCityData as $availableCityDataval) {
 echo $availableCityDataval."  ";
?>
<?php
}
}else{

}
?>
          </div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Product Cutting Instructions</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">
<?php 
if($cut){
foreach ($cut as $cutValue) {
echo " ".$cutValue." ";
}
}else{
echo"N/A";
}
?>
          </div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Product Category</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">
<?php if($productCategory){
echo $productCategory;
}else{
echo"N/A";
}
?>
           </div>    
           </div>

         

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Product Explore By Category</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">
<?php if($exploreBy){
echo $exploreBy;
}else{
echo"N/A";
}
?>
           </div>    
           </div>



              </div><!-- /.box -->
            </div><!--/.col (left) -->
            <!-- right column -->
          <!--   <div class="col-md-1"></div> -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection



      