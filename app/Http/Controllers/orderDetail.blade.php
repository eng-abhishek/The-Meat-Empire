@extends('admin.layout.layout')
@section('title','Order Details')
@section('content')
<?php error_reporting(1); ?>
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
                  <h3 class="box-title">Order Detail
                  </h3>
                  <a href="{{url('invoice/'.$order[0]->bokId)}}" target="_blank"><button type="button" name="invoice" style="float:right;" class="btn btn-info">Get Invoice <i class="fa fa-external-link"></i></button></a>
                </div><!-- /.box-header -->
                <!-- form start -->

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Order ID</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->order_id}}</div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">User Name</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->f_name." ".$order[0]->l_name}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">User Contact No</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->email}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">User Email</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->mobile_no}}</div>    
           </div>
  
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">User City</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$city}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">User Address</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->address}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">User Flat No</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->flat_no}}</div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">User Landmark Address</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$LansMarkAddress}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Delivery Date</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->delDate}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Delivery Time</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->delTime}}</div>    
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Booking Date</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->bokDate}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Booking Instruction</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">
@if($order[0]->bookingSummary)
   {{$order[0]->bookingSummary}}
@else
N/A
@endif

         

          </div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">User Comment</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->clint_msg}}</div>
           </div>


           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">User Rating</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->client_rate}}</div>
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Express Delivery</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5"><i class="fa fa-inr"></i>
            {{$order[0]->expressDelivery}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Payment Mode</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->payment_mode}}</div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Transaction Id</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5">{{$order[0]->transation_id}}</div>    
           </div>

           <div class="row" style="padding-top:15px;font-weight:600;font-size:14px">
           <div class="col-sm-1"></div>
           <div class="col-sm-4">Total Amount</div>
           <div class="col-sm-2">:</div>  
           <div class="col-sm-5"><i class="fa fa-inr"></i>{{$order[0]->total_amount}}</div>
           </div>

           <div class="row" style="padding-top:15px;font-weight:600;font-size:14px">
           <div class="col-sm-1"></div>
           <div class="col-sm-4"><b>Discount</b></div>
           <div class="col-sm-2">:</div>  
           @if($order[0]->total_off>0)
             <?php  $off=$order[0]->total_off;?>
           @else
              <?php  $off=0;?>
           @endif
           <div class="col-sm-5"><i class="fa fa-inr"></i>{{$off}}</div>    
           </div>

         
           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-4 detailsBlod">Order Item</div>
           <div class="col-sm-3"></div>  
           <div class="col-sm-2"></div>  
           <div class="col-sm-2"></div>    
           </div>

           <div class="row">
           <div class="col-sm-1"></div>
           <div class="col-sm-2"><b>Product Type</b></div>
           <div class="col-sm-2"><b>Name</b></div>  
           <div class="col-sm-2"><b>Price</b></div>  
           <div class="col-sm-2"><b>Qty</b></div>    
           <div class="col-sm-1"><b>Tax</b></div>  
           <div class="col-sm-1">Cut Inst</div>  
           <div class="col-sm-1"><b>Count</b></div>    
           </div>
<?php 
//echo"<pre>";
foreach ($productPrice as $keyprice=>$productPriceVal){
// print_r($productPriceVal);
 if($productPriceVal['fresh'][0]->id){
?>
           <div class="row" style="padding-top:15px">  
            <div class="col-sm-1"></div> 
           <div class="col-sm-2">Regular Item</div>
           <div class="col-sm-2">{{$productPriceVal['fresh'][0]->service_name}}</div>  
           <div class="col-sm-2">{{$productPriceVal['fresh'][0]->price}}</div> 
           <div class="col-sm-2">{{$productPriceVal['fresh'][0]->quantity}} {{$productPriceVal['fresh'][0]->quantity_type}}</div>  
            <div class="col-sm-1">{{$productPriceVal['tax']}} %</div>
            <div class="col-sm-1">{{$productPriceVal['cuttingInst']}}</div>
            
            <div class="col-sm-1">{{$productPriceVal['count']}}</div>
         <!--    <div class="col-sm-1"><i class="fa fa-inr"></i>1500</div> -->
            </div>
<?php
 }else{
  ?>
           <div class="row" style="padding-top:15px">
            <div class="col-sm-1"></div> 
           <div class="col-sm-2">Deal Of Day Item</div>
           <div class="col-sm-2">{{$productPriceVal['deal'][0]->foodName}}</div>  
           <div class="col-sm-2">{{$productPriceVal['deal'][0]->price}}</div> 
           <div class="col-sm-2">{{$productPriceVal['deal'][0]->quantity}} {{$productPriceVal['deal'][0]->quantity_type}}</div>  
           <div class="col-sm-1">{{$productPriceVal['tax']}} %</div>
           <div class="col-sm-1">N/A</div>
            <div class="col-sm-1">{{$productPriceVal['count']}}</div>
          <!--   <div class="col-sm-1"><i class="fa fa-inr"></i>12140</div>  --> 
           </div>
<?php
 }
}
?>
       

      

           </div><!-- /.box -->
            </div><!--/.col (left) -->
            <!-- right column -->
          <!--   <div class="col-md-1"></div> -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

@endsection