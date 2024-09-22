@extends('website.layout.layout2')
@section('content')
<?php
$totalPay=ceil(session()->get('tatalPayAMT'));
$totalpayInRupee=$totalPay*100;
 ?>
<section class="summary">
<div class="container">
	   <div class="row">
           <div class="col-md-6 bg-white p0">
            <h5>Order Summary</h5>
                <div class="row" style="padding:20px 40px;margin-top:10px;">
         
                      <div class="col-md-7 timingcol">
                          <p>Items deliver today (10 september)</p>
                          <h6>Today 90 min</h6>

                           <div id="finalPageCartDeials"></div>
                           <div id="finalPageCartDeialsDeal"></div>

                        <div class="row text-center" style="margin-top:50px;">
                             <div class="col-md-12">
                              <form action="{{url('rate')}}" method="POST">
                                  @csrf
                                <script
                                    src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="rzp_test_oDw757e5auoleh" // Enter the Test API Key ID generated from Dashboard → Settings → API Keys
                                    data-amount="<?php echo $totalpayInRupee;?>" // Amount is in currency subunits. Hence, 29935 refers to 29935 paise or ₹.
                                    data-currency="INR"//You can accept international payments by changing the currency code. Contact our Support Team to enable International for your account
                                    data-buttontext="Checkout"
                                    data-name="The Meat Empire"
                                    data-description=""
                                    data-image="http://quantumits.online/meat-empire/public/assets/front-end/img/logo2.png"
                                    data-prefill.name="Test"
                                    data-prefill.email="<?php echo session()->get('loginEmail');?>"
                                    data-theme.color="#F37254"
                                ></script>
                                <input type="hidden" custom="Hidden Element" name="hidden">
                                </form>
                             </div> 
                        </div> 
                      </div>

                     <div class="col-md-5 requirementcol">
                     

                    <div class="row summary-amount" id="getFinalPageBill">
                     
                      </div>

                      </div>
                 </div>

             
          </div>
       
           <div class="col-md-1">
           </div>
           <div class="col-md-4">
             <div class="row">
                  <div class="col-md-12">
                    <div class="order-track">
    <div class="order-track-step active">
      <div class="order-track-status">
        <span class="order-track-status-dot active"><img src="{{asset('assets/front-end/img/green.png')}}" style="width:15px;margin-top:-20px;margin-left:-2px;"></span>
        <span class="order-track-status-line active"></span>
      </div>
      <div class="order-track-text">
        <p class="order-track-text-stat">Choose Address</p>
        <span class="order-track-text-sub">Noida,Uttar Pradesh</span>
        <!-- <a href="" class="order-track-text-link">Change</a> -->
      </div>
    </div>
    <div class="order-track-step reached">
      <div class="order-track-status">
        <span class="order-track-status-dot reached"><img src="{{asset('assets/front-end/img/red.png')}}" style="width:30px;margin-top:-20px;margin-left:-8px;"></span>
        <span class="order-track-status-line reached"></span>
      </div>
      <div class="order-track-text">
        <p class="order-track-text-stat">Order Summary</p>
        <span class="order-track-text-sub">Item to be delivery in 1 shipment</span>
      </div>
    </div>
    <div class="order-track-step">
      <div class="order-track-status">
        <span class="order-track-status-dot"><img src="{{asset('assets/front-end/img/silver.png')}}" style="width:30px;margin-top:-8px;margin-left:-8px;"></span>
        <span class="order-track-status-line"></span>
      </div>
      <div class="order-track-text">
        <p class="order-track-text-stat" style="color:#afafaf">Payment Method</p>
      <!--   <span class="order-track-text-sub">21st November, 2019</span> -->
      </div>
    </div>
  </div>
                   </div> 

                   <div class="col-md-12">
                      <p  style="font-size:18px;color:black;font-weight:bold">Offers</p>
              <div class="cart-offer">
                   <img src="{{asset('assets/front-end/img/discount.png')}}" width="10%">&nbsp;
                   <span>Select offer/ Apply coupon</span>
                  <a href="#" data-toggle="modal" data-target="#exampleModal2" style="text-decoration:none;font-style:italic;font-size:12px;">
                  Click Here>
                  </a> 
                   <p>Get Discount with your order
                   <a href="{{url('offer')}}" target="_blank" style="text-decoration:none;color:black;font-style:italic;font-size:12px;float:right;">Get Coupon</a> 
                   </p>
                  
                   
                    
                </div> 
                
                
                   </div> 
                   
                         <div class="col-md-12" style="margin-top:20px;">
                                       <p  style="font-size:18px;color:black;font-weight:bold">Remark & Suggestion</p>
              <div class="remark-offer">
                  
                   <p style="font-size:14px;font-weight:normal">Hii this is my first remark and suggetion</p>
                  
                  
   
                    
                </div> 
                
                
                   </div> 
                   
             </div> 

           </div> 
           <div class="col-md-1">
           </div>
     </div>
   </div>
 </section>
                 
	<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
  <div class="container">
     <div class="row">
      <div class="col-md-12 text-center" style="padding-bottom:10px;">
   <h6>Apply coupon code and get {{$Coupon->off_price}}% discount</h6>
   <div id="coupolCodeStatus"></div>
     </div>
      
      <div class="col-md-12 text-center">
      <div style="font-weight:400;border:2px;font-size:20px;">{{$Coupon->name}}</div>
<!-- <form class="form-inline" method="post" style="margin-left:80px;"> -->
<div class="input-group mb-3">
 <input type="text" class="form-control" id="applyCouponCodeInput" name="coupon" placeholder="Enter Coupon Code">

  <div class="input-group-prepend">
    <button type="button" onclick="applyCouponCode()" class="btn btn-outline-success" type="button">Apply</button>
  </div>
</div>        
        <!--   </form> -->
      </div>  

     </div> 
  </div>   
      </div>
    </div>
  </div>
</div>


@endsection
@section('script')
<script>
$(document).ready(function(){
getFinalPageCartDetails();
getFinalPageBillDetails();
});  

function getFinalPageCartDetails(){
$.ajax({
url:"{{url('getFinalPageCartDetails')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}'},
success:function(data){
console.log(data);
$('#finalPageCartDeials').html(data[0]);
$('#finalPageCartDeialsDeal').html(data[1]);

}
});
}

function getFinalPageBillDetails(){
$.ajax({
url:"{{url('getFinalPageBillDetails')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}'},
success:function(data){
console.log(data);
$('#getFinalPageBill').html(data);
}
});
}


function applyCouponCode(){

var code=$('#applyCouponCodeInput').val();
$.ajax({
url:"{{url('applyCouponCode')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}',code:code},
success:function(data){
console.log(data);

$('#coupolCodeStatus').html(data);
$("#coupolCodeStatus").fadeOut(2500);

getFinalPageCartDetails();
getFinalPageBillDetails();
// getCartCount();
}
});
}

</script>
@stop