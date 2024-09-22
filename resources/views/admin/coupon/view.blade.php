@extends('admin.layout.layout')
@section('title','Add Product Category')
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
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Add</li>
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
                  <h3 class="box-title">Add New Coupon</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" id="category-store" action="{{url('coupon-store')}}" enctype="multipart/form-data">                 
                  <div class="box-body">

                     <div class="form-group">
                     <label for="couponType">Select Coupon Type</label>
                     <select name="couponType" class="form-control" onchange="checkCouponType(this.value)" required="">
                     <option value="">--Select Coupon Type--</option>  
                     <option value="generalCoupon">General Coupon</option>
                     <option value="refundCoupon">Refund Coupon</option>
                     </select> 
                     </div>

                     <div class="form-group" id="refundUser">
                     <label for="user_id">Select User</label>
                     <select name="user_id" class="form-control user_id" required="">
                     <option value="">--Select User--</option>  
                     @foreach($userDetails as $userDetailsData)
                     <option value="{{$userDetailsData->id}}">{{$userDetailsData->f_name." ".$userDetailsData->l_name}}</option>
                     @endforeach
                     </select> 
                      @error('user_id')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>

                      <div class="form-group">
                      <label for="coupon_name_details">Coupon Name</label>
                      <input type="text" class="form-control" name="coupon_name_details" id="coupon_name_details" required="">
                      @error('coupon_name_details')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>

                     <div class="form-group">
                      <label for="couponCode">Coupon Code</label>
                      <input type="text" class="form-control" name="couponCode" id="couponCode" required="">
                      @error('couponCode')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>
                    @csrf
                  
                    <div class="form-group">
                      <label for="minOrderAmount">Min Order Amount</label>
                      <input type="number" class="form-control" name="minOrderAmount" id="minOrderAmount" min="1" required="">
                      @error('minOrderAmount')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-group">
                     <label for="price_type">Select Amount Type</label>
                     <select name="price_type" class="form-control" required="">
                     <option value="">--Select Amount Type--</option>  
                     <option value="pre">Precentage</option>
                     <option value="rupee">Rupee</option>
                     </select> 
                    </div>

                    <div class="form-group">
                      <label for="couponOffer">Offer</label>
                      <input type="number" min="0" maxlength="4" class="form-control" name="couponOffer" id="couponOffer" required="">
                    
                      @error('couponOffer')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                   </div> 
                  
                    </div>                  
                   <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-foodCat">Submit</button>
                  </div>
                </form>
               </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!--/.col (left) -->
            <!-- right column -->
          <!--   <div class="col-md-1"></div> -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection
@section('script')
<script>
      $(function(){
$('#refundUser').hide();
$('.user_id').prop('required',false);

$('#category-store').validate({
 rules:{
  price_type:{
   required:true,
  },
  coupon_name_details:{
  required:true,
  maxlength:35,
  minlength:5,
  },
  user_id:{
   required:true,
  },
  couponOffer:{
    required:true,
    number:true,
  },
  couponCode:{
   required:true,
   minlength:3, 
   maxlength:6,   
  },
  minOrderAmount:{
  required:true,
  minlength:2,
  maxlength:20,   
  }
  },
 messages:{
   couponType:{
   required:'*Please Select Coupon Type',
   },
   price_type:{
   required:'*Please Select Amount Type',
   },
  coupon_name_details:{
   required:'*Please Enter Coupon Name', 
   },
   couponCode:{
   required:'*Please Enter Coupon Code', 
   },
  user_id:{
   required:'*Please Select User',
  },   
  couponOffer:{
  required:'*Please Enter Coupon Offer',  
  },
  minOrderAmount:{
  required:'*Please Enter Min Order Amount',   
  } 
 } 
});

});

function checkCouponType(type){
// alert(type);
if(type=="refundCoupon"){
$('#refundUser').show();
$('.user_id').prop('required',true);
}else{
$('#refundUser').hide();
$('.user_id').prop('required',false);
}
}    
</script>
@stop


      