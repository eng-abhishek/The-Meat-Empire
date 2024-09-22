@extends('website.layout.layout2')
@section('content')
<?php 
error_reporting(1);
?>
<section style="margin-top:200px">
       <div class="container" >
            <div class="row">
                  <div class="col-md-6" style="background:white;padding:15px;">
                      <p>Order Details</p>
                        <div class="table-responsive">
                              <table class="table table-bordered">
                                     <tr>
                                         <td>Order ID</td>
                                         <td>{{$order[0]->order_id}}</td>
                                     </tr>
                                       <tr>
                                         <td>User Name</td>
                                         <td>{{$order[0]->f_name." ".$order[0]->l_name}}</td>
                                     </tr>
                                     
                                       <tr>
                                         <td>User Contact No</td>
                                         <td>{{$order[0]->mobile_no}}</td>
                                     </tr>
                                       <tr>
                                         <td>User Email</td>
                                         <td>{{$order[0]->email}}</td>
                                     </tr>
                                      <tr>
                                         <td>User City</td>
                                         <td>{{$city}}</td>
                                     </tr>
                                      <tr>
                                         <td>User Address</td>
                                         <td>{{$order[0]->address}}</td>
                                     </tr>
                                          <tr>
                                         <td>User Flat No</td>
                                         <td>{{$order[0]->flat_no}}</td>
                                     </tr>
                                       <tr>
                                         <td>User Landmark Address</td>
                                         <td>{{$LansMarkAddress}}</td>
                                     </tr>
                                       <tr>
                                         <td>Delivery Date</td>
                                         <td>{{$order[0]->delDate}}</td>
                                     </tr>
                                       <tr>
                                         <td>Delivery Time</td>
                                         <td>{{$order[0]->delTime}}</td>
                                     </tr>
                                     
                                          <tr>
                                         <td>Booking Date</td>
                                         <td>{{$order[0]->bokDate}}</td>
                                     </tr>
                                      <tr>
                                         <td>Booking Instruction</td>
                                         <td>@if($order[0]->bookingSummary)
   {{$order[0]->bookingSummary}}
@else
N/A
@endif</td>
                                     </tr>
                                     
                                      <tr>
                                         <td>User Comment</td>
                                         <td>{{$order[0]->clint_msg}}</td>
                                     </tr>
                                     
                                      <tr>
                                         <td>User Rating</td>
                                         <td>{{$order[0]->client_rate}}</td>
                                     </tr>
                                      <tr>
                                         <td>Express Delivery Charge</td>
                                         <td><i class="fa fa-inr"></i>{{$order[0]->expressDelivery}}</td>
                                     </tr>
                                      <tr>
                                         <td>Payment Mode</td>
                                         <td>{{$order[0]->payment_mode}}</td>
                                      </tr>
                                      <tr>
                                         <td>Transaction Id</td>
                                         <td>{{$order[0]->transation_id}}</td>
                                     </tr>
                                      <tr>
                                         <td>Total Amount</td>
                                         <td><i class="fa fa-inr"></i>{{$order[0]->total_amount}}</td>
                                     </tr>
                                      <tr>
                                         <td>Discount</td>
                                         @if($order[0]->total_off>0)
             <?php  $off=$order[0]->total_off;?>
           @else
              <?php  $off=0;?>
           @endif
                                         <td><i class="fa fa-inr"></i>{{$off}}</td>
                                     </tr>
                              </table>
                        </div>
                  </div>
                  <div class="col-md-6" style="background:white;padding:15px">
                      <p>Order Items</p>
                       <div class="table-responsive">
                           <table class="table table-bordered table-hovered">
                                 <thead>
                                      <tr>
                                          <th>
                                              Product Type
                                          </th>
                                          <th>Product Name</th>
                                          <th>Price</th>
                                          <th>Qty</th>
                                          <th>Tax</th>
                                          <th>Cut Inst</th>
                                          <th>Count</th>
                                      </tr>
                                 </thead>
                                 <tbody>
                                      <?php 
//echo"<pre>";
foreach ($productPrice as $keyprice=>$productPriceVal){
// print_r($productPriceVal);
 if($productPriceVal['fresh'][0]->id){
?>  
          <tr>
              <td>Regular Item</td>
              <td>{{$productPriceVal['fresh'][0]->service_name}}</td>
              <td><i class="fa fa-inr"></i>{{$productPriceVal['fresh'][0]->price}}</td>
              <td>{{$productPriceVal['fresh'][0]->quantity}} {{$productPriceVal['fresh'][0]->quantity_type}}</td>
              <td>

@if($productPriceVal['tax'])
              {{$productPriceVal['tax']}} %
@else
N/A
@endif
            </td>
             <td>{{$productPriceVal['cuttingInst']}}</td>

              <td>{{$productPriceVal['count']}}</td>
          </tr>
       
<?php
 }else{  
  ?>
  
         <tr>
              <td>Deal Of Day Item</td>
              <td>{{$productPriceVal['deal'][0]->foodName}}</td>
              <td><i class="fa fa-inr"></i>{{$productPriceVal['deal'][0]->price}}</td>
              <td>{{$productPriceVal['deal'][0]->quantity}} {{$productPriceVal['deal'][0]->quantity_type}}</td>
              <td>
@if($productPriceVal['tax'])
              {{$productPriceVal['tax']}} %
@else
N/A
@endif

            </td>
              <td>N/A</td>
              <td>{{$productPriceVal['count']}}</td>
          </tr>
        
<?php
 }
}
?>
                                 </tbody>
                           </table>
                       </div>
                  </div>
            </div>
       </div>
</section>
 
@section('script')
<!--<script>
$(function(){
 if($('#location_pop').val()){ 
     
     }else{
    $(".bt2").trigger("click");
    $(".bt3").trigger("click");
     }   
});    
</script>-->
@endsection
@endsection

