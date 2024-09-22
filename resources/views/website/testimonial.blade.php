<!DOCTYPE html>
<html lang="en">
<head>
	<title>Meat Empire</title>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- css -->
	<link rel="stylesheet" href="{{asset('assets/front-end/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front-end/css/style.css')}}">
  
<link rel="stylesheet" href="{{asset('assets/front-end/css/responsive.css')}}">
<link rel="stylesheet" href="{{asset('assets/front-end/css/header.css')}}">
 <link rel="stylesheet" href="{{asset('assets/front-end/css/owl.theme.default.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/front-end/css/normalize.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/front-end/css/webslidemenu.css')}}">
<link rel='stylesheet' href="{{asset('assets/front-end/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css')}}" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">


</head>
<body class="catbody">
     @extends('website.layout.layout2')
    @section('content')
  
   <section class="fulltestimonial" style="margin-top:200px;padding-bottom:200px;">
	           <div class="container">
	                  <div class="row">
	                  	 <div class="col-md-1"></div>
	                       <div class="col-md-3 text-right">
	                       	  <img style="width:260px;height:auto;" src="{{asset("uploads/testimonial/$testimonial->clint_img")}}">
	                       </div>
	                       <div class="col-md-7">
	                       	    <p>{!! $testimonial->clint_msg !!}</p>

	                       	    <h4 style="color:#e11e28;">{{$testimonial->clint_name}}</h4>
	                       	     <h6 style="color:#000;">{{$testimonial->clint_designation}}</h6>
	                       	        <a href="{{$testimonial->clint_fb_url}}"><i class="fa fa-facebook-square" aria-hidden="true" style="font-size:25px;color:#3a5794"></i></a> 
	                       	        <a href="{{$testimonial->clint_insta_url}}"><i class="fa fa-instagram" aria-hidden="true" style="font-size:25px;color:#d62977;padding-left:10px"></i></a>
	                       <br>
	                        <p>
                           <?php
                           for($k=1;$k<=5;$k++){
                           if(ceil($testimonial->client_rate)>=$k){
                            ?>
                            <span class="fa fa-star mr-1"></span>
                            <?php
                             }else{
                              ?>
                            <span class="fa fa-star-o mr-1"></span> 
                              <?php
                             } 
                            }
                            ?> 
                          </p>
                  <!--<span class="number">{{$testimonial->client_rate}}/5</span>-->
	                       </div>
	                       <div class="col-md-1"></div>
	                  </div>
	           </div>
	   </section>
		   	    		
	
<script src="{{asset('assets/front-end/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/front-end/js/owl.carousel.min.js')}}"></script>
<script type="{{asset('assets/front-end/text/javascript" src="js/custom.js')}}"></script>
<script type="{{asset('assets/front-end/text/javascript" src="js/webslidemenu.js')}}"></script>
<script src="{{asset('assets/front-end/js/popper.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('assets/front-end/js/bootstrap.min.js')}}"></script>

<!-- javascript -->

</body>
</html>