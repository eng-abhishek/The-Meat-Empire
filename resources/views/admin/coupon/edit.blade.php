@extends('admin.layout.layout')
@section('title','Edit Product Category')
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
            <li class="active">Edit</li>
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
                  <h3 class="box-title">Edit Coupon</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" id="editDoctorCatForm" action="{{url('coupon-update')}}" enctype="multipart/form-data">
                  <div class="box-body">

                <div class="form-group">
                     <label for="couponType">Select Coupon Type</label>
                     <select disabled name="discouponType" class="form-control" required="">
                     <option value="">--Select Coupon Type--</option>
               
               <option <?php if($editData->couponType=="generalCoupon"){ echo"selected"; } ?> value="generalCoupon">General Coupon</option>

               <option <?php if($editData->couponType=="refundCoupon"){ echo"selected"; } ?> value="refundCoupon">Refund Coupon</option>
              
                     </select> 
                <input type="text" name="couponType" hidden value="{{$editData->couponType}}">
                     </div>

@if($editData->couponType=="refundCoupon")

                     <div class="form-group">
                     <label for="user_id">Select User</label>
                     <select name="user_id" class="form-control" required="">
                     <option value="">--Select User--</option>  
                     @foreach($userDetails as $userDetailsData)
                     <option <?php if($editData->user_id==$userDetailsData->id){ echo"selected"; } ?> value="{{$userDetailsData->id}}">{{$userDetailsData->f_name." ".$userDetailsData->l_name}}</option>
                     @endforeach
                     </select> 
                      @error('couponCode')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>
@else
@endif

                     <div class="form-group">
                      <label for="couponCode">Coupon Code</label>
                      <input type="text" class="form-control" value="{{$editData->name}}" name="couponCode" id="couponCode" required="">
                      @error('couponCode')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>
                     @csrf

                      <div class="form-group">
                      <label for="coupon_name_details">Coupon Name</label>
                      <input type="text" class="form-control" name="coupon_name_details" id="coupon_name_details" value="{{$editData->coupon_name_details}}" required="">
                      @error('coupon_name_details')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>

                    <div class="form-group">
                      <label for="minOrderAmount">Min Order Amount</label>
                      <input type="number" class="form-control" value="{{$editData->min_order_amount}}" min="1" name="minOrderAmount" id="minOrderAmount" required="">
                      @error('minOrderAmount')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>

                     <div class="form-group">
                     <label for="price_type">Select Amount Type</label>
                     <select name="price_type" class="form-control" required="">
                     <option value="">--Select Amount Type--</option>  
                     <option <?php if($editData->price_type=="pre"){echo"selected";}?> value="pre">Precentage</option>
                     <option <?php if($editData->price_type=="rupee"){echo"selected";}?> value="rupee">Rupee</option>
                     </select> 
                     </div>

                     <div class="form-group">
                      <label for="couponOffer">Offer</label>
                      <input type="number" min="0" maxlength="4" class="form-control" value="{{$editData->off_price}}" name="couponOffer" id="couponOffer" required="">
                      @error('couponOffer')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div> 
                    
                       
                  </div><!-- /.box-body -->
                  <input type="text" hidden name="editId" value="{{$editData->id}}"> 
          
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary edit-btn-foodCat">Submit</button>
                  </div>
                </form>
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
 
$('.topbar-errmsg').hide();  
$('.catSec-errmsg').hide();   
$('#editDoctorCatForm').validate({

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
</script>
@stop



      