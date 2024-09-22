<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>The Meat Empire</title>
    <link rel="stylesheet" href="{{asset('assets/front-end/css/login.css')}}">
<style type="text/css">
     input
     {
        border:1px solid silver !important;
     }
</style>
</head>
<body>
<!-- partial:index.partial.html -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">

<div class="container" id="container">
    
        <div class="form-container sign-in-container">
            <form action="{{url('match-otp')}}" method="post">
                <h1>Enter OTP</h1>
                <div class="social-container">
                </div>
              @if(Session::get('otp_err'))
              <span style="color:red">{{Session::get('otp_err')}}</span>  
              @else 
              @endif  
                <span>Enter your four digit OTP</span>
           <div style="display: flex;justify-content: center" id="otp-container">
        <input oninput="inputInsideOtpInput(this)"
              maxlength="1" id="first" min="0" name="otp[]" type="text" onkeyup="movetoNext(this, 'second')" required style="width:30%">
        @csrf
        <input oninput="inputInsideOtpInput(this)"
              maxlength="1" id="second" min="0" name="otp[]" type="text" onkeyup="movetoNext(this, 'third')" style="width:30%" required>

        <input oninput="inputInsideOtpInput(this)"
               maxlength="1" id="third"  min="0" name="otp[]" type="text" onkeyup="movetoNext(this, 'fourth')" style="width:30%" required>

        <input oninput="inputInsideOtpInput(this)"
              maxlength="1" id="fourth" min="0" name="otp[]" type="text" style="width:30%" required>
    </div>
               <button type="submit" class="si">SUBMIT</button><br>
               <a href="{{url('send-otp')}}">
               <button type="button" class="si">RESEND</button>  
               </a>
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
                    <p>Enter your four digit OTP</p>
              
                </div>
            </div>
        </div>
    </div>
<!-- partial -->
<script src='{{asset("assets/front-end/js/loginscript.js")}}'></script>
<script>
function movetoNext(current, nextFieldID) {
if (current.value.length >= current.maxLength) {
document.getElementById(nextFieldID).focus();
}
}
</script>
</body>
</html>
