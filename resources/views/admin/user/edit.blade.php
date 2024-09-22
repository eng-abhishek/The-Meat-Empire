@extends('admin.layout.layout')
@section('title','Edit User')
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
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
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
                  <h3 class="box-title"></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{url('user-update')}}" id="editUserForm" enctype="multipart/form-data">
                  <div class="box-body">

                    <div class="form-group">
                      <label for="f_name">User First Name</label>
                      <input type="text" class="form-control" name="f_name" id="f_name" value="{{$editData->f_name}}" required="">
                      @error('f_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>
                    
                    <div class="form-group">
                      <label for="l_name">User Last Name</label>
                      <input type="text" class="form-control" name="l_name" id="l_name" value="{{$editData->l_name}}" required="">
                      @error('l_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>

                    @csrf
                          
                     <div class="form-group">
                      <label for="email">Email Id</label>
                      <input type="text" class="form-control" name="email" id="email" value="{{$editData->mobile_no}}" required="">
                      @error('email')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="mobile_no">Mobile No</label>
                      <input type="text" class="form-control" name="mobile_no" id="mobile_no" value="{{$editData->email}}" readonly="">
                      @error('clint_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>


                    <div class="form-group">
                      <label for="address">Address</label>
                      <input type="text" class="form-control" name="address" id="address" value="{{$editData->address}}" required="">
                      @error('address')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="city">Select City</label>
                 <!--      <input type="text" class="form-control" name="city" id="city" value="{{$editData->city}}" required=""> -->

                      <select name="city" class="form-control" onchange="getUserLocation(this.value)">
                       <option value="">-- Select City --</option>
                       @foreach($allCity as $allCityData)
                       <option value="{{$allCityData->id}}"
        <?php if($allCityData->id==$editData->city){ echo"selected";}else{ } ?>
                        >{{$allCityData->name}}</option> 
                       @endforeach 
                      </select>
                      @error('city')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div> 

                    <div class="form-group">
                      <label for="landmarkAddress">Landmark Address</label>
                   <!--    <input type="text" class="form-control" name="landmarkAddress" id="landmarkAddress" value="{{$editData->landmarkAddress}}" required=""> -->
                     
<select name="landmarkAddress" id="location" class="form-control">
  <option value="">-- Select Location --</option>
             @foreach($setLocation as $setLocationData)
            <option value="{{$setLocationData->id}}" 
<?php if($setLocationData->id==$editData->landmarkAddress){ echo"selected";}else{ } ?>
              >{{$setLocationData->location_name}}
             </option>
             @endforeach 
</select>
                      @error('landmarkAddress')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="flat_no">Flat No</label>
                      <input type="text" class="form-control" name="flat_no" id="flat_no" value="{{$editData->flat_no}}" required="">
                      @error('flat_no')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>
@csrf
                    <div class="form-group">
                      <label for="img">User Image</label>
                      <input type="file" id="img" name="img" class="form-control">
                        @error('img')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                   @if($editData->img)
                 <img src="{{asset('uploads/user/'.$editData->img)}}" width="100px">
                 <input type="text" hidden name="oldImg" value="{{$editData->img}}">   
                   @endif
              
                    </div>
        
                  </div><!-- /.box-body -->
                  <input type="text" hidden name="editId" value="{{$editData->id}}"> 
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
$('#editUserForm').validate({
  rules:{
   f_name:{
  required:true,
  minlength:5,
  maxlength:25,
     },
  l_name:{
  required:true,
  minlength:2, 
  maxlength:15, 
    },
  mobile_no:{
  required:true,
  number:true,
  minlength:10,
  maxlength:10, 
    },
  flat_no:{
  required:true,
  },
   city:{
  required:true,
   },
landmarkAddress:{
  required:true,
},
address:{
   required:true, 
},

    },
  messages:{
  f_name:{
  required:'*Please Enter User First Name',
     }, 
  l_name:{
  required:'*Please Enter User Last Name', 
    },
  mobile_no:{
   required:'*Please Enter User Email Id',
   email:'*Please Enter Valide Email Id', 
  },  
  flat_no:{
  required:"*Please Enter User Flat No",
  },
   city:{
  required:"*Please Select User City",
   },
  landmarkAddress:{
  required:"*Please Select User Location",
},
address:{
   required:"*Please Enter User Address",
},

  }
});
});


function getUserLocation(id){
$.ajax({
url:"{{url('getUserLocation')}}",
method:'POST',
data:{'_token':'{{csrf_token()}}',id:id},
success:function(data){
$('#location').html(data);
}
});
}
</script>
@stop

      