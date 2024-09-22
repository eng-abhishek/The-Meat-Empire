@extends('website.layout.layout2')
@section('content')
@section('title','The Meat Empire | Cart Summary')
<?php
use App\Available_city;
// echo session()->get('tatalPayAMT');
// $totalPay=ceil(session()->get('tatalPayAMT'));
// $totalpayInRupee=$totalPay*100;

if(session()->get('city')){
              $selectCity=session()->get('city');         
              }else{
              $selectCity =Available_city::find('1')->id;
              }

              $cityCategory=Available_city::find($selectCity);
              $cityCategory->category;
 ?>
<section class="summary">
<div class="container">
     <div class="row">
           <div class="col-md-6 bg-white p0">
            <h5>Order Summary</h5>
                <div class="row" style="padding:20px 40px;margin-top:10px;">

                      <div class="col-md-7 timingcol">
                          <p>
                            <b>Delivery Date</b>&nbsp;&nbsp;:
                          {{session()->get('deliveryDate')}}
                          <br>
                          <b>Delivery Time</b>&nbsp;:
                          {{session()->get('deliveryTime')}}
                         <!--  {{session()->get('deliveryTime')}} -->
                          </p>
                        <!--  <h6>Min Delivery Time 1:20 Min</h6>-->

                           <div id="finalPageCartDeials"></div>
                           <div id="finalPageCartDeialsDeal"></div>

                        <div class="row text-center" style="margin-top:50px;">
                             <div class="col-md-12">
                               <button class="btn processpayment" onclick="selectPayMode()" id="payment-butn">Pay Now</button>
                       
                                  <script>
                                  // Function to lazy load a script
                                  // -----------------------------------------------
                                  var loadExternalScript = function(path) {
                                    var result = $.Deferred(),
                                        script = document.createElement("script");
                                
                                    script.async = "async";
                                    script.type = "text/javascript";
                                    script.src = path;
                                    script.onload = script.onreadystatechange = function(_, isAbort) {
                                      if (!script.readyState || /loaded|complete/.test(script.readyState)) {
                                        if (isAbort)
                                          result.reject();
                                        else
                                          result.resolve();
                                      }
                                    };
                                
                                    script.onerror = function() {
                                      result.reject();
                                    };
                                
                                    $("head")[0].appendChild(script);
                                
                                    return result.promise();
                                  };
                                </script>
                               
                             </div> 
                        </div>                      
                      </div>

                     <div class="col-md-5 requirementcol">
                     

                    <div class="row summary-amount" id="getFinalPageBill">
                     
                      </div>


                      </div>

@if(session()->get('bokInfo'))

<div style="margin-top:50px">
<b>Order Instruction:</b>
  <p style="font-size:14px;font-weight:normal">
 <?php echo session()->get('bokInfo');
  ?>
  </p>
</div>

@else

@endif

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


              <div class="col-md-12" style="margin-top:20px;">
            
              </div>
    @if($cityCategory->category=="C")
     <p style="color: red;
    font-weight: 600;
    margin-top: 20px;">Note: For Location Greater Noida Parpatganj Delivery Time Start From At 12 AM & 4 PM</p>     
    @else

    @endif 
     
             </div> 
           </div> 
           <div class="col-md-1">
           </div>
     </div>
   </div>
 </section>
        

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="box-shadow: 0 0 10px 10px rgb(109, 109, 109);">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="font-size: 1.1em;">Select Payment Mode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
                </div>
                <div class="modal-body" style="margin: auto; font-weight: 500; font-size: 1.2em;">

                    Total Amount : Rs.<font id="userPayAmount"></font>
                </div>
                <div class="modal-footer" style="margin: auto;">
                    <button type="button" class="btn btn-sm btn-danger" style="background-color: #ec2224; border: none;"><a href="javascript:void(0)"
                      onclick="selectCaseMode()" style="color: white;">Cash on Delivery</a></button>
                    <button type="button" class="js-pay-bundle btn btn-sm btn-primary" style="background-color: #2b2f7f; border: none;" data-itemid="gold200" data-amount="" data-processorid="razor" data-qty="1"><a href="#" style="color: white;">Pay Online</a></button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
  var callRazorPayScript = function(itemId, amount, qty, processorId) {
  var merchangeName = "The Meat Empire",
      img = "https://themeatempire.in/assets/front-end/img/logo2.png",
      name = "Test",
      description = "",
      amount = amount;
      
  loadExternalScript('https://checkout.razorpay.com/v1/checkout.js').then(function() { 
    var options = {
      key: 'rzp_live_Vrtf9oUtJuUBXl',
      //key:'rzp_test_IogBhIRMWNGbSg',
      protocol: 'https',
      hostname: 'api.razorpay.com',
      amount: amount,
      name: merchangeName,
      description: description,
      image: img,
      prefill: {
        name: name,
      },
      theme: {
        color: '#F37254'
      },
      handler: function (transaction, response){
        console.log('Tshirt\\ntransaction id: ' + transaction.razorpay_payment_id);
        $('#trasationId').val(transaction.razorpay_payment_id);
        // $('#').submit();
$.ajax({
url:"{{url('setpaymentIdSession')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}',trId:transaction.razorpay_payment_id},
success:function(data){
window.location.href='rate';
}
});
      }      
    };
  
  window.rzpay = new Razorpay(options);

    console.log('Item Id: ', amount);
    console.log('Amount: ', amount);
    console.log('Quantity: ', qty);
    console.log('Processor Id: ', processorId);

    rzpay.open();
  });
}





// Trigger call to action buttons depending on the bundle packs
// -----------------------------------------------
var $payBundle = $('.js-pay-bundle');

    $payBundle.on('click', function() {
    var amt = $('#totalPayAmt').val();
    //var amt=10;
    var finalamt = amt * 100;
    var itemId = $(this).data('itemid'),
      amount = finalamt,
      processorid = $(this).data('processorid'),
      qty = $(this).data('qty');

  callRazorPayScript(itemId, amount, processorid, qty);
});
</script>
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

/*$(function(){
 if($('#location_pop').val()){ 
     
     }else{
    $(".bt2").trigger("click");
    $(".bt3").trigger("click");
     }   
});
*/
function selectPayMode(){
var payamount=$('#totalPayAmt').val();
$('#userPayAmount').html(payamount);
$('#exampleModalCenter').modal('show');
}

function selectCaseMode(){
$.ajax({
url:"{{url('paymentMode')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}'},
success:function(data){

window.location.href="rate";
}
});

}
</script>
@stop