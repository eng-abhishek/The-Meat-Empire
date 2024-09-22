@extends('admin.layout.layout')
@section('title','View Product Category')
@section('content')

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          Coupon Management
            <small>Meat Empire</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Coupon</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Coupon List</h3>
                  <a href="{{url('coupon-add')}}" style="float: right"><button class="btn btn-info"><i class="fa fa-plus"></i>Add Coupon</button></a> 
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Coupon Name</th>
                        <th>Coupon Code</th>
                        <th>User Name</th>
                        <th>Offer</th>
                        <th>Min Order Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    
    @foreach($generalCoupon as $key=>$generalCouponVal)
     @if($generalCouponVal->couponType=="generalCoupon")
    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$generalCouponVal->coupon_name_details}}</td>
                        <td>{{$generalCouponVal->name}}</td>
                        <td>For All</td>
                        <td>
@if($generalCouponVal->price_type=='rupee')
<i class="fa fa-rupee"></i>
                          {{$generalCouponVal->off_price}}
@else
                          {{$generalCouponVal->off_price}}%
@endif

                        
                        </td>
                       <td><i class="fa fa-inr"></i> {{$generalCouponVal->min_order_amount}}</td>
                        <td>
                        @if($generalCouponVal->status=='0')
                        <?php $statusval=''; ?>
                        @else
                         <?php $statusval='checked'; ?>
                        @endif
                         <input type="checkbox" id="doctor_status{{$generalCouponVal->id}}" onchange="updateCategoryStatus({{$generalCouponVal->id}})"  data-toggle="toggle" data-onstyle="success" value="{{$generalCouponVal->ststus}}" data-offstyle="danger" <?php echo $statusval;?> data-on="Active" data-off="InActive">
                        </td>                
<td>                  
                        <a href="{{url('coupon-edit/'.$generalCouponVal->id)}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                        <a href="{{url('coupon-destroy/'.$generalCouponVal->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>                
</td>

                      </tr>
                         @else
                      @endif 
                      @endforeach

                        @foreach($coupon as $key=>$categoryval)
                      @if($categoryval->couponType=="refundCoupon")
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$categoryval->coupon_name_details}}</td>
                        <td>{{$categoryval->name}}</td>
                        <td>{{$categoryval->ufname." ".$categoryval->ulname}}</td>
                        <td>
                        @if($categoryval->price_type=='rupee')
                        <i class="fa fa-rupee"></i>
                         {{$categoryval->off_price}}
                        @elseif($categoryval->price_type=='pre') 
                         {{$categoryval->off_price}} %
                        @else
                        @endif
                        </td>
                        <td><i class="fa fa-inr"></i> {{$categoryval->min_order_amount}}</td>
                        <td>
                        @if($categoryval->status=='0')
                        <?php $statusval=''; ?>
                        @else
                         <?php $statusval='checked'; ?>
                        @endif
                         <input type="checkbox" id="doctor_status{{$categoryval->id}}" onchange="updateCategoryStatus({{$categoryval->id}})"  data-toggle="toggle" data-onstyle="success" value="{{$categoryval->ststus}}" data-offstyle="danger" <?php echo $statusval;?> data-on="Active" data-off="InActive">
                        </td>                
<td>                  
                        <a href="{{url('coupon-edit/'.$categoryval->id)}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                        <a href="{{url('coupon-destroy/'.$categoryval->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>                
</td>

                      </tr>
                      @else
                      @endif
                      @endforeach
                  
                    </tbody>
                 
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection

@section('script')
<script>
function updateCategoryStatus(id){
 var CatStatus;  
 if($('#doctor_status'+id).is(":checked")){
 CatStatus='1';
 }else{
 CatStatus='0';  
 }
 $.ajax({
 url:"{{url('update-coupon-status')}}",
 method:'post',
 data:{CatStatus:CatStatus,id:id,"_token":'{{csrf_token()}}'},  
 success:function(data){
    swal("Done!", "Status Changed succesfully", "success");
 }
 });
}
</script>
@stop