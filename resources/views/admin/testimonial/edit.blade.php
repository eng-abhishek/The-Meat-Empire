@extends('admin.layout.layout')
@section('title','Edit Testimonial')
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
                  <h3 class="box-title">Add New Testimonial</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{url('testimonial-update')}}" id="editTestimonialForm" enctype="multipart/form-data">
                  <div class="box-body">

                    <div class="form-group">
                      <label for="clint_name">Client Name</label>
                      <input type="text" class="form-control" name="clint_name" id="clint_name" value="{{$editData->clint_name}}" required="">
                      @error('clint_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>
                    
                    @csrf
                    <div class="form-group">
                      <label for="clint_message">Client Message</label>
                     <textarea cols="12" rows="6" class="form-control ckeditor" name="clint_message" required=""> {!! $editData->clint_msg !!}
                     </textarea>
                      @error('clint_message')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                    </div>                    
                    <div class="form-group">
                      <label for="clint_img">Client Image</label>
                      <input type="file" id="clint_img" name="clint_img" class="form-control">
                        @error('clint_img')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                   @if($editData->clint_img)
                  <img src="{{asset("uploads/testimonial/$editData->clint_img")}}" width="100px">
                 <input type="text" hidden name="oldImg" value="{{$editData->clint_img}}">   
                   @endif
                  *Recommended Image Size 300*300
                    </div>
                   
                   <div class="form-group">
                       <label for="clint_img">Client Designation</label>
                      <input class="form-control" type="text" value="{{$editData->clint_designation}}" id="clint_designation" name="clint_designation" required="">
                    </div>

                    <div class="form-group">
                       <label for="clint_img">Client Facebook URL</label>
                      <input class="form-control" value="{{$editData->clint_fb_url}}" type="url" id="clint_fb_url" name="clint_fb_url" required="">
                    </div>

                    <div class="form-group">
                       <label for="clint_img">Client Instagram URL</label>
                      <input class="form-control" type="url" value="{{$editData->clint_insta_url}}" id="clint_insta_url" name="clint_insta_url" required="">
                    </div>

                    <div class="form-group">
                      <label for="client_rate">Rate</label>
                      <input class="form-control" type="number" min="1" max="5" id="client_rate" name="client_rate" value="{{$editData->client_rate}}" required="">
                        @error('client_rate')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror                
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
$('#editTestimonialForm').validate({
  rules:{
      client_rate:{
  required:true,
  number:true,
  minlength:1,
  maxlength:3,
     },
  clint_name:{
  required:true,
  minlength:5, 
  maxlength:30, 
    },
  clint_message:{
  required:true,
  minlength:30,  
    },
  clint_designation:{
  maxlength:35,
  minlength:5,
    }
    },
  messages:{
      client_rate:{
  required:'*Please Enter Clint Rate',
  number:'*Clint Rate Should Be Integer',
  minlength:'*Min Length Should Be 1',
  maxlength:'*Max Length Should Be 3',
     }, 
  clint_name:{
  required:'*Please Enter Clint Name',
  minlength:'*Clint Name Should Be Atlist 5 Charactor',  
    },
  clint_message:{
  required:'*Please Enter Clint Message',
  minlength:'*Clint Name Should Be Atlist 30 Charactor',  
    }, 
  clint_insta_url:{
   url:'*Please Enter Valide URL' 
  },
  clint_fb_url:{
   url:'*Please Enter Valide URL' 
  },   
  }
});
});
</script>
@stop

      