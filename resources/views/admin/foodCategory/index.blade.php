@extends('admin.layout.layout')
@section('title','View Product Category')
@section('content')

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Product Category Management
            <small>Meat Empire</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Product Category</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Product Category List</h3>
                  <a href="{{url('category-add')}}" style="float: right"><button class="btn btn-info"><i class="fa fa-plus"></i>Add Category</button></a> 
                </div><!-- /.box-header -->
                <div class="box-body">

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Category Name</th>
                        <th>Category Image</th>
                        <th>Category Logo</th>
                        <th>Category Page Logo</th>
                        <th>Category Type</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($category as $key=>$categoryval)
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$categoryval->category_name}}</td>
                        <td>

<?php if($categoryval->category_img=='NULL'){
?>
<img src="{{asset('assets/front-end/img/default-img.png')}}" width="50px">
<?php
}else{
?>
<img src="{{asset('uploads/foodCategory/'.$categoryval->category_img)}}" width="50px">
<?php
}?>

                        </td>
                        <td>
<?php if($categoryval->category_logo=='NULL'){
?>
<img src="{{asset('assets/front-end/img/default-img.png')}}" width="50px">
<?php
}else{
?>
<img src="{{asset('uploads/foodCategoryLogo/'.$categoryval->category_logo)}}" width="50px">
<?php
}?>
                        </td>

                       <td>
<?php if($categoryval->pageLogo=='NULL'){
?>
<img src="{{asset('assets/front-end/img/default-img.png')}}" width="50px">
<?php
}else{
?>
<img src="{{asset('uploads/categoryPageLogo/'.$categoryval->pageLogo)}}" width="50px">
<?php
}?>
                        </td>
@if($categoryval->category_type=="cate" || $categoryval->category_type=="")
 <td>General</td>
@elseif($categoryval->category_type=="ebc")
 <td>Explore By</td>
@else

@endif 


                     
                        <td>
                        @if($categoryval->status=='0')
                        <?php $statusval=''; ?>
                        @else
                         <?php $statusval='checked'; ?>
                        @endif
                         <input type="checkbox" id="doctor_status{{$categoryval->id}}" onchange="updateCategoryStatus({{$categoryval->id}})"  data-toggle="toggle" data-onstyle="success" value="{{$categoryval->ststus}}" data-offstyle="danger" <?php echo $statusval;?> data-on="Active" data-off="InActive">
                        </td>                
<td>                  
                        <a href="{{url("category-edit/$categoryval->id")}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                        <a href="{{url("category-destroy/$categoryval->id")}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>                
</td>

                      </tr>
                      @endforeach
                    </tbody>
                    <!-- <tfoot>
                      <tr>
                        <th>S.No</th>
                        <th>category Name</th> 
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
function updateCategoryStatus(id){
 var CatStatus;  
 if($('#doctor_status'+id).is(":checked")){
 CatStatus='1';
 }else{
 CatStatus='0';  
 }
 $.ajax({
 url:"{{url('update-category-status')}}",
 method:'post',
 data:{CatStatus:CatStatus,id:id,"_token":'{{csrf_token()}}'},  
 success:function(data){
      swal("Done!", "Status Changed succesfully", "success");
 }
 });
}

</script>
@stop