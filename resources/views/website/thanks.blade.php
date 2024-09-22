<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Place</title>
    <style>
        body {
            background-color: rgb(231, 231, 231);
            margin-top: 80px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        
        .lego-container {
            animation: fade 2s;
            border-radius: 30px;
            padding: 50px;
            margin: auto;
            background-color: rgb(243, 243, 243);
            width: 45%;
        }
        
        @keyframes fade {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
        
        @media only screen and (max-width: 600px) {
            .lego-container {
                border: 4px solid rgb(126, 119, 119);
                padding: 50px;
                margin: auto;
                background-color: rgb(243, 243, 243);
                width: 60%;
            }
            body {
                background-color: rgb(231, 231, 231);
                margin-top: 30px;
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            }
        }
        
        .success-animation {
            margin: 150px auto;
            margin-bottom: 40px;
            margin-top: 20px;
        }
        
        .checkmark {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: block;
            stroke-width: 2;
            stroke: #2b2f7f;
            stroke-miterlimit: 10;
            box-shadow: inset 0px 0px 0px #4bb71b;
            animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
            position: relative;
            top: 5px;
            right: 5px;
            margin: 0 auto;
        }
        
        .checkmark__circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 2;
            stroke-miterlimit: 10;
            stroke: #2b2f7f;
            fill: rgb(243, 243, 243);
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }
        
        .checkmark__check {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        }
        
        @keyframes stroke {
            100% {
                stroke-dashoffset: 0;
            }
        }
        
        @keyframes scale {
            0%,
            100% {
                transform: none;
            }
            50% {
                transform: scale3d(1.1, 1.1, 1);
            }
        }
        
        @keyframes fill {
            100% {
                box-shadow: inset 0px 0px 0px 30px #4bb71b;
            }
        }
        
        .txt {
            text-align: center;
            font-size: 2em;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        
        .txt2 {
            font-size: 1.4em;
        }
    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <style>
        .star-rating {
            animation: fade 5s;
            direction: rtl;
            display: inline-block;
            padding: 20px
        }
        
        span {
            animation: fade 2s;
        }
        
        .star-rating input[type=radio] {
            display: none
        }
        
        .star-rating label {
            color: #bbb;
            font-size: 18px;
            padding: 0;
            cursor: pointer;
            -webkit-transition: all .3s ease-in-out;
            transition: all .3s ease-in-out
        }
        
        .star-rating label:hover,
        .star-rating label:hover~label,
        .star-rating input[type=radio]:checked~label{
            color: #f2b600
        }
        
        span {
            font-size: 1.3em;
            font-weight: 500;
            color: #2b2f7f;
        }
        
        textarea {
            width: 100%;
            height: 100%;
        }
        
        .grid {
            grid-template-rows: 1fr 1fr;
        }
    </style>
</head>
<body>
    <div class="lego-container">

        <div class="success-animation">
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" /><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" /></svg>
        </div>
        <p class="txt" style="color:rgb(247, 65, 65)"> Thank you for choosing us! </p>
        <p class="txt txt2"> Your order has been placed. </p>
        <p class="txt txt2"> Order ID -: <span>  {{session()->get('orderId')}} </span> </p>
        <form method="post" action="{{url('submit-rating')}}">
        <div class="grid">

            <div style="font-size: 1.4em; font-weight: 500; width: max-content; margin: auto; padding-left: 0px; padding-right: 0px; ">

                Rate Us
<div class="star-rating">
  <input type="radio" name='rating' id="5-stars" value="5"/>
  <label for="5-stars" class="star">&#9733;</label>
  <input type="radio" name='rating' id="4-stars" value="4"/>
  <label for="4-stars" class="star">&#9733;</label>
  <input type="radio" name='rating' id="3-stars" value="3"/>
  <label for="3-stars" class="star">&#9733;</label>
  <input type="radio" name='rating' id="2-stars" value="2"/>
  <label for="2-stars" class="star">&#9733;</label>
  <input type="radio" name='rating' id="1-star" value="1" required=""/>
  <label for="1-star" class="star">&#9733;</label>
</div>
@csrf
            </div>

        </div>

        <div>
            <h2 style="font-weight: 500; margin-bottom: 5px; font-size: 1em;">Your Feedback</h2>
                <textarea rows="4" cols="30" name="comment" placeholder="Enter Your Suggestion..." style="padding:10px; margin-bottom: 0px; border-radius: 10px;" required=""></textarea>
                <br><br>
                <input type="submit" name="btnsubmit" style="border: none; background-color: rgb(231, 231, 231); padding: 15px; margin-top: 0px; border-radius: 10px;">

        </div>
    </form>
    </div>

</body>

</html>