@extends('admin.layout.layout')
@section('title','Product Management')
@section('content')

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Product Management
            <small>Meat Empire</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Product</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Product List</h3>
                  <a href="{{url('product-add')}}" style="float: right"><button class="btn btn-info"><i class="fa fa-plus"></i> Add Product</button></a> 
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Product Name</th>                  
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($service as $key => $servicesval)
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$servicesval->service_name}}</td>
                        <td>
                      <img src="{{ asset("uploads/foodService/$servicesval->service_img")}}" width="50px">
                        </td>
                       <td>
                        @if($servicesval->status=='0')
                        <?php $staus=''; ?>
                        @else
                         <?php $staus='checked'; ?>
                        @endif
 <input type="checkbox" id="doctor_status{{$servicesval->id}}" onchange="updateServiceStatus( {{$servicesval->id}} )"  data-toggle="toggle" data-onstyle="success" value="{{$servicesval->ststus}}" data-offstyle="danger" <?php echo $staus;?> data-on="Active" data-off="InActive">
                        </td>
                        <td class="action-icon">

 <a href="{{url("product-show/$servicesval->id")}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
 <a href="{{url("product-edit/$servicesval->id")}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
 <a href="{{url("product-destroy/$servicesval->id")}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
function updateServiceStatus(id){
 var servStatus;  
 if($('#doctor_status'+id).is(":checked")){
 servStatus='1';
 }else{
 servStatus='0';  
 }
 $.ajax({
 url:"{{url('update-service-status')}}",
 method:'post',
 data:{servStatus:servStatus,id:id,"_token":'{{csrf_token()}}'},  
 success:function(data){
   swal("Done!", "Status Changed succesfully", "success"); 
 }
 });
}

</script>
@stop