@extends('admin.layout.layout')
@section('title','Signup Discount')
@section('content')

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Signup Discount Management
            <small>Meat Empire</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Discount</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Discount List</h3>
<!--                   <a href="{{url('deal-of-day-add')}}" style="float: right"><button class="btn btn-info"><i class="fa fa-plus"></i>Add Deal of Day</button></a>  -->
                </div><!-- /.box-header -->
                <div class="box-body">

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>offer</th>                  
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                   @foreach($offer as $key => $discountval)
                   <tr>
                   <td>{{$key + 1}}</td>
                   <td>{{$discountval->offer}} %</td>
                   <td>{{$discountval->from_date}}</td> 
                   <td>{{$discountval->to_date}}</td> 
                  
                        <td>
                        @if($discountval->status=='0')
                        <?php $staus=''; ?>
                        @else
                         <?php $staus='checked'; ?>
                        @endif
  <input type="checkbox" id="doctor_status{{$discountval->id}}" onchange="updateDealOfDayStatus({{$discountval->id}} )"  data-toggle="toggle" data-onstyle="success" value="{{$discountval->status}}" data-offstyle="danger" <?php echo $staus;?> data-on="Active" data-off="InActive">
                        </td>
                        <td class="action-icon">
 <a href="{{url("signup-discount-edit/$discountval->id")}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
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
 url:"{{url('signup-discount-status')}}",
 method:'post',
 data:{servStatus:servStatus,id:id,"_token":'{{csrf_token()}}'},  
 success:function(data){
   swal("Done!", "Status Changed succesfully", "success"); 
 }
 });
}
</script>
@stop