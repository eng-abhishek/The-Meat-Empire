<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Meat Empire</title>
  <link rel="stylesheet" href="{{asset('assets/front-end/css/login.css')}}">
</head>
<body>
<!-- partial:index.partial.html -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">

<div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="{{url('send-otp')}}" method="post">
                <h1>Create Account</h1>
                <div class="social-container">  
                <div style="color:red">@if(Session::get('signup_err'))
                 {{Session::get('signup_err')}}
                 
                 @else

                 @endif
                </div>              
                    <!-- <a href="" target="_blank" class="social"><i class="fab fa-facebook"></i></a>
                    <a href="" target="_blank" class="social"><i class="fab fa-google-plus-g"></i></a> -->
                </div>
                <!--<span>or use your email for registration</span>-->
                <input type="text" name="chkExistEmail" value="1" hidden=""/>
                <input type="number" maxlength="10" name="email" placeholder="Enter Mobile No"/>      @csrf          
                <button type="submit" class="su" >Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="{{url('send-otp')}}" method="post">
                <h1>Sign In</h1>
                <div class="social-container">
                <div style="color:red">@if(Session::get('signin_err'))
                 {{Session::get('signin_err')}}
                 
                 @else

                 @endif
                </div> 
                   
                  <!--   <a href="" target="_blank" class="social"><i class="fab fa-facebook"></i></a>
                    <a href="" target="_blank" class="social"><i class="fab fa-google-plus-g"></i></a> -->
                </div>
             <!--<span>or use your account</span>-->
             <input type="number" maxlength="10" name="email" placeholder="Enter Mobile No"/>
                <!--<a href="http://Youtube.com/c/ZaidIrfanKhan" target="_blank">I Forgot my Password</a>-->
                @csrf
                <button type="submit" class="si">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To Keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Wanderer!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
<!-- partial -->
  <script  src="{{asset('assets/front-end/js/loginscript.js')}}"></script>

</body>
</html>
