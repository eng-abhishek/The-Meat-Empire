<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="base_url" content="{{url('/')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- css -->
	<link rel="stylesheet" href="{{asset('assets/front-end/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front-end/css/home.css')}}">

	<link rel="stylesheet" href="{{asset('assets/front-end/css/style.css')}}">
<link rel="stylesheet" href="{{asset('assets/front-end/css/responsive.css')}}">
<link rel="stylesheet" href="{{asset('assets/front-end/css/new-responsive.css')}}">
<link rel="stylesheet" href="{{asset('assets/front-end/css/header.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front-end/css/animate.min.css')}}" media="(prefers-reduced-motion: no-preference)">
 <link rel="stylesheet" href="{{asset('assets/front-end/css/owl.theme.default.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/front-end/css/normalize.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/front-end/css/webslidemenu.css')}}">
<link rel='stylesheet' href="{{asset('assets/front-end/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f8f10617eca070012f815fd&product=inline-share-buttons' async='async'></script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-T9VGBD6');</script>
<!-- End Google Tag Manager -->

	<!-- css -->
</head>
<style type="text/css">
  .plright::placeholder
  {
    color:#fff;
    font-size:12px;
    padding-left:20px;
  
  }
  .plright 
  {
    text-align: center;
  }
</style>
<body class="catbody">
  <!--  <a class="animate__animated animate__bounce animate__infinite	infinite" href="#" style="position:fixed;bottom:10px;z-index:999999;width:300px"><img src="{{asset('assets/front-end/img/whatsappicon.png')}}" width="20%"></a>
-->    <div>
@include('website.partials.header')
</div>
<div>
@yield('content')
</div>
<div>
    <!-- Start Footer Area -->
    @include('website.partials.footer')
</div>
@yield('script')
</body>
</html>