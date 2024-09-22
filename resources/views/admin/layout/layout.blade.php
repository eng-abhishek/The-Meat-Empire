<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- Bootstrap 3.3.2 -->
    <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />    
<!--- Custom Style---->
    <link href="{{asset('assets/admin_custom/css/style.css')}}" rel="stylesheet" type="text/css" />
<!--- End Custom Style---->
<!---- Select 2 ----->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<!---- end Select 2 ----->
<!--- js validation --->
<link href="{{asset('assets/jquery-validation/css/screen.css')}}" rel="stylesheet" type="text/css" />
<!--- End js validation --->
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="{{asset('assets/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="{{asset('assets/dist/css/skins/_all-skins.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="{{asset('assets/plugins/iCheck/flat/blue.css')}}" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="{{asset('assets/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="{{asset('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="{{asset('assets/plugins/datepicker/datepicker3.css')}}" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="{{asset('assets/plugins/daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="{{asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<!--- sweet alert box -->
     <link rel="stylesheet" href="{{asset('assets/css/sweetalert.css')}}">
<!--- end sweet alert box -->
<!--- toastar msg -->
<link rel="stylesheet" type="text/css" href="{{asset('assets/toaster/css/toastr.css')}}">
<!--- end toastar msg -->

    <style type="text/css">
        .no-print {
            display: none;
        }
        .validate_err {
            color: red;
            margin-top: 7px;
        }
    </style>
  </head>
  <body class="skin-blue">

@include('admin.partials.header')



@yield('content')


    <!-- Start Footer Area -->
@include('admin.partials.footer')



@yield('script')

</body>
</html>
