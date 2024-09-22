@extends('admin.layout.layout')
@section('title','Order')
@section('content')

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Order Management
            <small>Meat Empire</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Order Management</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Order Management</h3>
                 <!--  <a href="{{url('deal-of-day-add')}}" style="float: right"><button class="btn btn-info"><i class="fa fa-plus"></i>Add Deal of Day</button></a>  -->
                </div><!-- /.box-header -->
                <div class="box-body">

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Order Id</th>                  
                        <th>User Name</th>
                        <th>User Email Id</th>
                        <th>Booking Date</th>
                        <th>Order Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                   @foreach($order as $key => $orderDetails)
                   <tr>
                   <td>{{$key + 1}}</td>
                   <td>{{$orderDetails->order_id}}</td>
                   <td>{{$orderDetails->f_name." ".$orderDetails->l_name}}</td> 
                   <td>
                   {{$orderDetails->email}}
                    </td>
                    <td>{{date('d-m-yy h:i a',strtotime($orderDetails->bokDate))}}</td>
                    <td>

<select name="bokStatus" onchange="changeOrdStatus('<?php echo $orderDetails->id;?>',this.value)" class="form-control changebokStatus">
<option value="">--Select Status--</option>  
<option <?php if($orderDetails->order_status=='requested'){echo"selected";}?> value="requested">Requested</option> 
<option <?php if($orderDetails->order_status=='accepted'){echo"selected";}?> value="accepted">Accepted</option> 
<option <?php if($orderDetails->order_status=='processing'){echo"selected";}?> value="processing">Processing</option> 
<option <?php if($orderDetails->order_status=='dispatch'){echo"selected";}?> value="dispatch">Dispatch</option> 
<option <?php if($orderDetails->order_status=='delivered'){echo"selected";}?> value="delivered">Delivered</option>
<option <?php if($orderDetails->order_status=='cancel'){echo"selected";}?> value="cancel">Cancel</option>   
</select>

                    </td>
                    <td>
                      <a href="{{url('order-detail/'.$orderDetails->bokID)}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                    </td>
                     </tr>
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
function updateDealOfDayStatus(id){
 var servStatus;  
 if($('#doctor_status'+id).is(":checked")){
 servStatus='1';
 }else{
 servStatus='0';  
 }
 $.ajax({
 url:"{{url('update-deal-of-day-status')}}",
 method:'post',
 data:{servStatus:servStatus,id:id,"_token":'{{csrf_token()}}'},  
 success:function(data){
   swal("Done!", "Status Changed succesfully", "success"); 
 }
 });
}


function changeOrdStatus(id,type){
// alert(id);  
// alert(type);

$.ajax({
 url:"{{url('change-booking-status')}}",
 method:'post',
 data:{curStatus:type,id:id,"_token":'{{csrf_token()}}'},  
 success:function(data){
  swal("Done!", "Order Status Changed succesfully", "success"); 
 }
 });
}

</script>
@stop