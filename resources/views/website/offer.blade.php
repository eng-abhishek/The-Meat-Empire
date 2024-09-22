@extends('website.layout.layout2')
@section('title','Offer')
@section('content')
<section id="labels" style="padding-bottom:20px">
  <div class="container">
  <div class="row">
     
@if($alloffer)
@foreach($alloffer as $key=>$allofferval)
<?php 
$key+1;
if($key/2==0){
$color="alizarin";
}else{
$color="emerald";
}
?>
        <div class="col-sm-6 col-md-3">
          <div class="dl">
            <div class="discount {{$color}}">
              @if($allofferval->price_type=='rupee')
              <i class="fa fa-rupee"></i>
              {{$allofferval->off_price}}
              @else
          
              {{$allofferval->off_price}} %
              @endif


                <div class="type">off</div>
            </div>
            <div class="descr">
             
            </div>
            <div class="ends">
            <small align="center" style="color:#2b2f7f;text-align:center;font-size:18px;font-weight:600">{{$allofferval->coupon_name_details}}</small>
            </div>
            <div class="coupon midnight-blue">
                <a data-toggle="collapse" href="#code-{{$key}}" class="open-code">Get a code</a>
                <div id="code-{{$key}}" class="collapse code">{{$allofferval->name}}</div>
            </div>
            <form method="post" action="{{url('apply-coupon')}}">
              @csrf
                <input type="hidden" name="couponId" value="{{$allofferval->id}}">
                <center><input type="submit" class="btn text-center" value="Apply Coupon" style="background:#ec2224;color:white;margin-top:10px"></center> 
            </form>
          </div>
        </div>
@endforeach
@else
@endif

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