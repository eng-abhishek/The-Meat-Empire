@extends('admin.layout.layout')
@section('title','Testimonial')
@section('content')
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Testimonials Management
            <small>Meat Empire</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Testimonial</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">View Meat Empire</h3>
                  <a href="{{url('testimonial-add')}}" style="float: right"><button class="btn btn-info"><i class="fa fa-plus"></i>Add Testimonial</button></a> 
                </div><!-- /.box-header -->
                <div class="box-body">

@if(Session::get('err_msg'))
<div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong></strong> {{ Session::get('err_msg') }}
</div>
@endif
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Client Name</th>                  
                        <th>Image</th> 
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($testimonial as $key=>$testimonialval)
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$testimonialval->clint_name}}</td>
                        <td>
                      <img src="{{asset("uploads/testimonial/$testimonialval->clint_img")}}" width="50px">                 
                      </td>
                       <td>
                        @if($testimonialval->status=='0')
                        <?php $staus=''; ?>
                        @else
                         <?php $staus='checked'; ?>
                        @endif
 <input type="checkbox" id="clint_status{{$testimonialval->id}}" onchange="updateClintStatus( {{$testimonialval->id}} )"  data-toggle="toggle" data-onstyle="success" value="{{$testimonialval->ststus}}" data-offstyle="danger" <?php echo $staus;?> data-on="Active" data-off="InActive">
                        </td>
                        <td>

 <a href="{{url("testimonial-show/$testimonialval->id")}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
 <a href="{{url("testimonial-edit/$testimonialval->id")}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
 <a href="{{url("testimonial-destroy/$testimonialval->id")}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>

<!-- 
                       <a href="{{url("testimonial-edit/$testimonialval->id")}}"><i class="fa fa-pencil"></i></a> 
                       &nbsp;&nbsp;
                       <a href="{{url("testimonial-destroy/$testimonialval->id")}}"><i class="fa fa-trash"></i></a> 
                       &nbsp;&nbsp;
                       <a href="{{url("testimonial-show/$testimonialval->id")}}"><i class="fa fa-eye"></i></a>  -->
                      </td>
                      </tr>
                      @endforeach
                    </tbody>
                    <!-- <tfoot>
                      <tr>
                        <th>S.No</th>
                        <th>Clint Name</th>                 
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </tfoot> -->
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
function updateClintStatus(id){
 var testStatus;  
 if($('#clint_status'+id).is(":checked")){
 testStatus='1';
 }else{
 testStatus='0';  
 }
 $.ajax({
 url:"{{url('update-testimonial-status')}}",
 method:'post',
 data:{testStatus:testStatus,id:id,"_token":'{{csrf_token()}}'},  
 success:function(data){
   swal("Done!", "Status Changed succesfully", "success"); 
 }
 });
}
</script>
@stop