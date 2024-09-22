@extends('website.layout.layout2')
@section('content')
  <section class="address" >
         <div class="container">
          <div class="row">
             <div class="col-md-2">
             </div> 
             <div class="col-md-8" style="background:white; padding:10px;box-shadow:0px 0px 10px gray;">
                <div class="row">
                      <div class="col-md-3 profilecol text-enter">
                         <center> <div class="user-img">
                          @if($userdata->img)
                          <img style="width:94px;" src="{{url('uploads/user/'.$userdata->img)}}">
                          @else
                          <img style="width: 94px" src="{{url('assets/front-end/img/photo-icon.png')}}">
                          @endif
                        

                          </div></center>
                          <h6>Profile Picture</h6>
                         <div class="rightdiv">
                             <a href="#" data-toggle="modal" data-target="#addprofilepic" class="editbtn">Upload</a>
                           </div> 
                      </div>  
                       <div class="col-md-5 datacol">
                          <div class="rightdiv">
                             <a href="#" data-toggle="modal" data-target="#editUserProfile" class="editbtn">Edit</a>
                           </div> 
                          <div class="leftdiv">
                                <p>Name: {{$userdata->f_name." ".$userdata->l_name}}</p>
                                <p>Email: {{$userdata->mobile_no}}</p>
                                <p>Mobile: {{$userdata->email}}</p>
                                 <p>City: {{$cityName}}</p>
                                <p>Address: {{$userdata->address}}</p>
                                <p>Flat No: {{$userdata->flat_no}}</p>
                                <p>Landmark Address: {{$locationName}}</p>
                          </div>
                      </div>  
                     <div class="col-md-4 ordercol">
                          <span>{{$totalOrder}}</span>
                          <i class="fa fa-shopping-bag" aria-hidden="true"> Order</i>
                     </div> 
                 </div> 

             </div>
             <div class="col-md-2">
             </div>
             
             <div class="col-md-2">
             </div>

             <div class="col-md-8" style="margin-top:10px;padding:0px">
                <a class="orderhistory" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
              Order History <i class="fa fa-angle-down" aria-hidden="true"></i>
  </a>
  <div class="collapse" id="collapseExample">
  <div class="card card-body orderhisdiv">
<div class="table-responsive">      
  <table class="table">
  <tr>
  <th>Order Id</th>
  <th>Order Date</th>
  <th>Delivery Date/Time</th>
  <th>Current Status</th>
  <th>Action</th>
  </tr>
  @foreach($bookingDetails as $bookingDetailsval)
  <?php 
if($bookingDetailsval->bookingDeliveryType=='now'){
$dateTime='Now';
}else{
$dateTime=$bookingDetailsval->bookingDate.' '.$bookingDetailsval->bookingTime;
}
  ?>
  <tr>
  <td>{{$bookingDetailsval->order_id}}</td>
  <td>{{$bookingDetailsval->created_at}}</td>
  <td>{{$dateTime}}</td>
  <td>{{$bookingDetailsval->order_status}}</td>
  <td>
 <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> More</button>
   <div class="dropdown-menu">
<a class="dropdown-item" target="_blank" href="{{url('uploads/invoices/'.$bookingDetailsval->invoice)}}">Get Invoice</a> 

<a class="dropdown-item" href="javascript:void(0)" onclick="feedback(<?php echo $bookingDetailsval->id;?>)">Feedback</a>
<a class="dropdown-item" href="{{'repeat-order/'.$bookingDetailsval->id}}">Repeat This Order</a>
<?php if($bookingDetailsval->order_status=="dispatch" || $bookingDetailsval->order_status=="delivered" || $bookingDetailsval->order_status=="processing" || $bookingDetailsval->order_status=="cancel"){
}else{
?>
  <a class="dropdown-item" href="javascript:void(0)" onclick="cancelOrder('{{$bookingDetailsval->id}}')">Cancel Order</a>

<?php } ?>

<a class="dropdown-item" href="{{url('order-history/'.$bookingDetailsval->id)}}">Order History</a>
</td>
</tr> 
 @endforeach 
  </table> 
</div>
  </div>
</div>
             </div> 
             <div class="col-md-2">
             </div>
            
          </div>  
             
         </div>   
  </section>  
@section('script')
<script>
function getProductByCity(id){
window.location.href="{{url('product-by-city/')}}"+'/'+id;
}

function cancelOrder(id){
$.ajax({
url:"{{url('cancel-order')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}',id:id},
success:function(data){
console.log(data);
if(data=='0'){
alert('Oop`s Your Time Is Expired');
  }else{
window.location.href="{{url('user-profile')}}";
}
}
});
}

function orderhistoryDetails(id){
alert(id);
$.ajax({
url:"{{url('get-booking-details')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}',id:id},
success:function(data){
console.log(data);
$('#orderHistory').modal('show');
}
});
}
$(function(){
 if($('#location_pop').val()){ 
     
     }else{
    $(".bt2").trigger("click");
    $(".bt3").trigger("click");
     }   
});
  
function feedback(id){
$('#feedbackForm #editId').val(id);
$('#feedback').modal('show');
}

</script>
@endsection
@endsection

