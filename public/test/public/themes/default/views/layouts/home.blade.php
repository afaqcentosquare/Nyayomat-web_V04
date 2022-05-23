<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no">
    <title> {{ get_platform_title() }} </title>
    <link rel="icon" href="{{ Storage::url('icon.png') }}" type="image/x-icon" />
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="apple-touch-icon" href="{{ Storage::url('icon.png') }}">

        <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <script src="https://use.fontawesome.com/dfc4b5f232.js"></script>
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">



    <link href="http://fonts.googleapis.com/css?family=Kotta+One|Cantarell:400,700" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->


    <!-- responsive-full-background-image.css stylesheet contains the code you want -->
        <style>
            body {
                /* Location of the image */
                background-image: url({{ Storage::url('bg2.jpg') }});
                /* Image is centered vertically and horizontally at all times */
                background-position: center center;
                /* Image doesn't repeat */
                background-repeat: no-repeat;
                /* Makes the image fixed in the viewport so that it doesn't move when 
                the content height is greater than the image height */
                background-attachment: fixed;
                /* This is what makes the background image rescale based on its container's size */
                background-size: cover;
                /* Pick a solid background color that will be displayed while the background image is loading */
                background-color: #464646;
                /* SHORTHAND CSS NOTATION
              * background: url(background-photo.jpg) center center cover no-repeat fixed;
              */
            }


            /* For mobile devices */

            @media only screen and (max-width: 200px) {
                body {
                    background-image: url({{ Storage::url('bgw_200.jpg') }});
                }
            }

            @media only screen and (max-width: 565px) {
                body {
                    background-image: url({{ Storage::url('bgw_565.jpg') }});
                }
            }

            @media only screen and (max-width: 812px) {
                body {
                  background-image: url({{ Storage::url('bgw_812.jpg') }});
                }
            }

            @media only screen and (max-width: 980px) {
                body {
                  background-image: url({{ Storage::url('bgw_980.jpg') }});
                }
            }

            @media only screen and (max-width: 1125px) {
                body {
                  background-image: url({{ Storage::url('bgw_1125.jpg') }});
                }
            }

            @media only screen and (max-width: 1257px) {
                body {
                  background-image: url({{ Storage::url('bgw_1257.jpg') }});
                }
            }
            

            html, body, .container {
            height: 100%;
            }

     


            h1 {
            color: #efecec;
            text-transform: uppercase;
            font-size: 50px;
            line-height: 50px;
            font-weight: 900;
            margin-top: 20px;
            }

            h2 {
            color: #efecec;
            text-transform: capitalize;
            font-size: 40px;
            line-height: 50px;
            font-weight: 400;
            margin-top: 20px;
            }


            a {
            color: #ffffff;
            }

            p {
            margin: 0 0 15px 0;
            }

            strong {
            font-weight: 700;
            }

            blockquote {
            display: block;
            max-width: 480px;
            margin: 15px auto;
            padding: 15px;
            background-color: rgba(0, 0, 0, 0.3);  
            color: #e1e1e1;
            font-family: "Kotta One", serif;
            font-size: 22px;
            line-height: 28px;
            }

            blockquote cite {
            display: block;
            font: 18px/23px "Cantarell", sans-serif;
            font-size: 16px;
            margin-top: 16px;
            color: #cccccc;
            text-transform: uppercase;
            }


            .container {
            display: table;
            padding-top: 80px;
            width: 100%;
            }

            .content {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
            }

            /* Special */
            .sub-title {
            margin: 50px auto;
            font-size: 18px;
            line-height: 23px;
            text-transform: uppercase;
            }

            .button {
            display: inline-block;
            padding: 6px 10px;
            color: #cafaea;
            border: 1px solid #cafaea;
            border-radius: 3px;
            font-weight: 700;
            line-height: normal;
            text-decoration: none;
            text-align: center;
            text-transform: uppercase;
            }

            #more-content {
            display: none;
            }

            /* Media Queries */
            @media only screen and (max-width: 340px) {
            
            .container {
                position: relative;
                display: block;
                float: left;
                vertical-align: baseline;
                margin: 0 auto;
                padding: 80px 0 0 0;
            }
            
            #more-content {
                float: left;
                margin-right: 10px;
                
            }
            
            body h1 {
                font-size: 18px;
                line-height: 23px;
            } 
            
            .content, blockquote {  
                display: inline;
                margin: 0 auto;
                padding-top: 80px;
                vertical-align: baseline;
            }

            blockquote {
                width: 150px;
                margin: 15px auto;
                font-size: 16px;
                line-height: 21px;
                background-color: transparent;
            }

            blockquote cite {
                font-size: 14px;
                line-height: 19px;
            }

            .sub-title {
                font-size: 14px;
                line-height: 21px;
            }

            .button, p {
                max-width: 150px;
                margin: 0 auto;
                font-size: 15px;
                line-height: 20px;
            }
            html, body, .container {
                height: auto;
            }
            }

            .form-elegant .font-small {
    font-size: 0.8rem;
}



.btn-rounded {
    border-radius: 10em;
}

.btn-white {
    color: #000;
    background-color: #fff !important;
}

@media screen and (min-width: 768px) {
    .modal-dialog {
        width: 350px;
        height: 450px;
        /* New width for default modal */
    }
    .modal-sm {
        width: 100px;
        /* New width for small modal */
    }
}

@media screen and (min-width: 992px) {
    .modal-lg {
        width: 450px;
        height: 450px;
        /* New width for large modal */
    }
}

.otpLoader {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('https://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
   body.loading .otpLoader {
    overflow: hidden;   
}

/* Anytime the body has the loading class, our
   modal element will be visible */
body.loading .otpLoader {
    display: block;
}




.select2-results { 
  color: black;
}


/* New ones */



  h1 {
    text-align: center;
    margin-bottom: 0;
    margin-top: 60px;
  }
  
  #lean_overlay {
    position: fixed;
    z-index: 100;
    top: 0px;
    left: 0px;
    height: 100%;
    width: 100%;
    background: #000;
    display: none;
  }
  
  .popupContainer {
    position: absolute;
    width: 330px;
    height: auto;
    left: 45%;
    top: 60px;
    background: #FFF;
  }

  .inner {
    position: relative;
    margin-top: .3rem;
  }
  .checkboxes label
    {
        display: block;
        float: left;
        padding-right: 10px;
        white-space: nowrap;
    }

    .checkboxes input
    {
        vertical-align: middle;
    }

    .checkboxes label span
    {
        vertical-align: middle;
    }

  
  .btn {
    padding: 10px 20px;
    background: #F4F4F2;
    border-radius: 20px;
  }
  
  .btn_red {
    background: #ED6347;
    color: #FFF;
  }
  
  .btn_blue {
    background: rgb(71, 101, 237);
    color: #FFF;
  }

  

  .btn:hover {
    background: #E4E4E2;
  }
  
  .btn_red:hover {
    background: #C12B05;
  }

  .btn_blue:hover {
    background: rgb(5, 165, 193);
  }
  
  a.btn {
    color: #666;
    text-align: center;
    text-decoration: none;
  }
  
  a.btn_red {
    color: #FFF;
  }
  
  .one_half {
    width: 45%;
    display: block;
    float: left;
  }
  
  .one_half.last {
    width: 45%;
    margin-left: 5%;
    float: right;
  }
  /* Popup Styles*/
  
  .popupHeader {
    font-size: 16px;
    text-transform: uppercase;
  }
  
  .popupHeader {
    background: #F4F4F2;
    position: relative;
    padding: 10px 20px;
    border-bottom: 1px solid #DDD;
    font-weight: bold;
  }
  
  .popupHeader .modal_close {
    position: absolute;
    right: 0;
    top: 0;
    padding: 10px 15px;
    /* background: #E4E4E2; */
    cursor: pointer;
    color: #aaa;
    font-size: 16px;
  }
  
  .popupBody {
    padding: 15px;
  }
  /* Social Login Form */

  
  .social_login .social_box {
    display: block;
    clear: both;
    padding: 10px;
    margin-bottom: 10px;
    background: #F4F4F2;
    overflow: hidden;
  }
  
  .social_login .icon {
    display: block;
    width: 10px;
    padding: 5px 10px;
    margin-right: 10px;
    float: left;
    color: #FFF;
    font-size: 16px;
    text-align: center;
  }
  
  .social_login .fb .icon {
    background: #3B5998;
  }
  
  .social_login .google .icon {
    background: #DD4B39;
  }
  
  .social_login .icon_title {
    display: block;
    padding: 5px 0;
    float: left;
    font-weight: bold;
    font-size: 16px;
    color: #777;
  }
  
  .social_login .social_box:hover {
    background: #E4E4E2;
  }
  
  .centeredText {
    text-align: center;
    margin: 20px 0;
    clear: both;
    overflow: hidden;
    text-transform: uppercase;
  }
  
  .action_btns {
    clear: both;
    overflow: hidden;
    margin: 10px 0;
  }
  
  .action_btns a {
    display: block;
  }

  .action_btns button {
    float: right;
  }
  /* User Login Form */
  
  .user_login {
    display: none;
  }
  .password_recovery {
    display: none;
  }
  
  .user_login label {
    display: block;
    margin-bottom: 5px;
  }
  
  .user_login input[type="text"],
  .user_login input[type="email"],
  .user_login input[type="password"] {
    display: block;
    padding: 10px;
    /* border: 1px solid #DDD; */
    color: #666;
  }
  
  .user_login input[type="checkbox"] {
    float: left;
    margin-right: 5px;
  }
  
  .user_login input[type="checkbox"]+label {
    float: left;
  }
  
  .user_login .checkbox {
    margin-bottom: 10px;
    clear: both;
    overflow: hidden;
  }
  
  .forgot_password {
    display: block;
    margin: 20px 0 10px;
    clear: both;
    overflow: hidden;
    text-decoration: none;
    color: #ED6347;
  }
  /* User Register Form */
  
  .user_register {
    display: none;
  }
  
  .user_register label {
    display: block;
    margin-bottom: 5px;
  }
  
  .user_register input[type="text"],
  .user_register input[type="email"],
  .user_register input[type="password"] {
    display: block;
    padding: 10px;
    /* border: 1px solid #DDD; */
    color: #666;
  }
  
  .user_register input[type="checkbox"] {
    float: left;
    margin-right: 5px;
    margin-top: 5px;
  }
  
  .user_register input[type="checkbox"]+label {
    float: left;
  }
  
  .user_register .checkbox {
    margin-bottom: 10px;
    clear: both;
    overflow: hidden;
  }
  
  .flex-c-m {
      display: -webkit-box;
      display: -webkit-flex;
      display: -moz-box;
      display: -ms-flexbox;
      display: flex;
      justify-content: center;
      -ms-align-items: center;
      align-items: center;
  }
  
  
  /*//////////////////////////////////////////////////////////////////
  [ Social item ]*/
  .login100-social-item {
    color: #fff;
  
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin: 5px;
  }
  
  .login100-social-item:hover {
    color: #fff;
    background-color: #333333;
  }
  
  
  /*//////////////////////////////////////////////////////////////////
  [ FONT ]*/
  
  @font-face {
    font-family: Poppins-Regular;
    src: url('../fonts/poppins/Poppins-Regular.ttf'); 
  }
  
  @font-face {
    font-family: Poppins-Medium;
    src: url('../fonts/poppins/Poppins-Medium.ttf'); 
  }
  
  @font-face {
    font-family: Poppins-Bold;
    src: url('../fonts/poppins/Poppins-Bold.ttf'); 
  }
  
  @font-face {
    font-family: Poppins-SemiBold;
    src: url('../fonts/poppins/Poppins-SemiBold.ttf'); 
  }
  
  
  
  
  /*//////////////////////////////////////////////////////////////////
  [ RESTYLE TAG ]*/
  
  * {
      margin: 0px; 
      padding: 0px; 
      box-sizing: border-box;
  }
  
  body, html {
      height: 100%;
      font-family: Poppins-Regular, sans-serif;
  }
  
  /*---------------------------------------------*/
  a {
      font-family: Poppins-Regular;
      font-size: 14px;
      line-height: 1.7;
      color: #666666;
      margin: 0px;
      transition: all 0.4s;
      -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
  }
  
  a:focus {
      outline: none !important;
  }
  
  a:hover {
      text-decoration: none;
    color: #a64bf4;
  }
  
  /*---------------------------------------------*/
  h1,h2,h3,h4,h5,h6 {
      margin: 0px;
  }
  
  p {
      font-family: Poppins-Regular;
      font-size: 14px;
      line-height: 1.7;
      color: #666666;
      margin: 0px;
  }
  
  ul, li {
      margin: 0px;
      list-style-type: none;
  }
  
  
  /*---------------------------------------------*/
  input {
      outline: none;
      border: none;
  }
  
  textarea {
    outline: none;
    border: none;
  }
  
  textarea:focus, input:focus {
    border-color: transparent !important;
  }
  
  input:focus::-webkit-input-placeholder { color:transparent; }
  input:focus:-moz-placeholder { color:transparent; }
  input:focus::-moz-placeholder { color:transparent; }
  input:focus:-ms-input-placeholder { color:transparent; }
  
  textarea:focus::-webkit-input-placeholder { color:transparent; }
  textarea:focus:-moz-placeholder { color:transparent; }
  textarea:focus::-moz-placeholder { color:transparent; }
  textarea:focus:-ms-input-placeholder { color:transparent; }
  
  input::-webkit-input-placeholder { color: #adadad;}
  input:-moz-placeholder { color: #adadad;}
  input::-moz-placeholder { color: #adadad;}
  input:-ms-input-placeholder { color: #adadad;}
  
  textarea::-webkit-input-placeholder { color: #adadad;}
  textarea:-moz-placeholder { color: #adadad;}
  textarea::-moz-placeholder { color: #adadad;}
  textarea:-ms-input-placeholder { color: #adadad;}
  
  /*---------------------------------------------*/
  button {
      outline: none !important;
      border: none;
      background: transparent;
  }
  
  button:hover {
      cursor: pointer;
  }
  
  iframe {
      border: none !important;
  }
  
  /*//////////////////////////////////////////////////////////////////
  [ Utility ]*/
  .txt1 {
    font-family: Poppins-Regular;
    font-size: 14px;
    line-height: 1.5;
    color: #666666;
  }
  
  .txt2 {
    font-family: Poppins-Regular;
    font-size: 14px;
    line-height: 1.5;
    color: #333333;
    text-transform: uppercase;
  }
  
  .bg1 {background-color: #3b5998}
  .bg2 {background-color: #1da1f2}
  .bg3 {background-color: #ea4335}
  
  
  
  /*//////////////////////////////////////////////////////////////////
  [ login ]*/
  .limiter {
    width: 100%;
    margin: 0 auto;
  }
  
  .container-login100 {
    width: 100%;  
    min-height: 100vh;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    padding: 15px;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
  }
  
  .wrap-login100 {
    /* width: 500px; */
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
  }
  
  
  /*------------------------------------------------------------------
  [ Form ]*/
  
  .login100-form {
    width: 100%;
  }
  
  .login100-form-title {
    display: block;
    font-family: Poppins-Bold;
    font-size: 39px;
    color: #333333;
    line-height: 1.2;
    text-align: center;
  }
  
  
  
  /*------------------------------------------------------------------
  [ Input ]*/
  
  .wrap-input100 {
    width: 100%;
    position: relative;
    border-bottom: 2px solid #d9d9d9;
  }
  
  .label-input100 {
    font-family: Poppins-Regular;
    font-size: 14px;
    color: #333333;
    line-height: 1.5;
    padding-left: 7px;
  }
  
  .input100 {
    font-family: Poppins-Medium;
    font-size: 16px;
    color: #333333;
    line-height: 1.2;
    display: block;
    width: 100%;
    background: transparent;
    padding: 0 7px 0 43px;
  }
  
  
  /*---------------------------------------------*/
  .focus-input100 {
    position: absolute;
    display: block;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    pointer-events: none;
  }
  
  .focus-input100::after {
    content: attr(data-symbol);
    font-family: Material-Design-Iconic-Font;
    color: #adadad;
    font-size: 22px;
  
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    height: calc(100% - 20px);
    bottom: 0;
    left: 0;
    padding-left: 13px;
    padding-top: 3px;
  }
  
  .focus-input100::before {
    content: "";
    display: block;
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    background: #7f7f7f;
    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
    transition: all 0.4s;
  }
  
  
  .input100:focus + .focus-input100::before {
    width: 100%;
  }
  
  .has-val.input100 + .focus-input100::before {
    width: 100%;
  }
  
  .input100:focus + .focus-input100::after {
    color: #a64bf4;
  }
  
  .has-val.input100 + .focus-input100::after {
    color: #a64bf4;
  }
  
  
  /*------------------------------------------------------------------
  [ Button ]*/
  .container-login100-form-btn {
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }
  
  .wrap-login100-form-btn {
    width: 100%;
    display: block;
    position: relative;
    z-index: 1;
    border-radius: 25px;
    overflow: hidden;
    margin: 0 auto;
  
    box-shadow: 0 5px 30px 0px rgba(3, 216, 222, 0.2);
    -moz-box-shadow: 0 5px 30px 0px rgba(3, 216, 222, 0.2);
    -webkit-box-shadow: 0 5px 30px 0px rgba(3, 216, 222, 0.2);
    -o-box-shadow: 0 5px 30px 0px rgba(3, 216, 222, 0.2);
    -ms-box-shadow: 0 5px 30px 0px rgba(3, 216, 222, 0.2);
  }
  
  .login100-form-bgbtn {
    position: absolute;
    z-index: -1;
    width: 300%;
    height: 100%;
    background: #a64bf4;
    background: -webkit-linear-gradient(right, #00dbde, #fc00ff, #00dbde, #fc00ff);
    background: -o-linear-gradient(right, #00dbde, #fc00ff, #00dbde, #fc00ff);
    background: -moz-linear-gradient(right, #00dbde, #fc00ff, #00dbde, #fc00ff);
    background: linear-gradient(right, #00dbde, #fc00ff, #00dbde, #fc00ff);
    top: 0;
    left: -100%;
  
    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
    transition: all 0.4s;
  }
  
  .login100-form-btn {
    font-family: Poppins-Medium;
    font-size: 16px;
    color: #fff;
    line-height: 1.2;
    text-transform: uppercase;
  
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 20px;
    width: 100%;
    height: 50px;
  }
  
  .wrap-login100-form-btn:hover .login100-form-bgbtn {
    left: 0;
  }
  
  
  /*------------------------------------------------------------------
  [ Alert validate ]*/
  
  .validate-input {
    position: relative;
  }
  
  .alert-validate::before {
    content: attr(data-validate);
    position: absolute;
    max-width: 70%;
    background-color: #fff;
    border: 1px solid #c80000;
    border-radius: 2px;
    padding: 4px 25px 4px 10px;
    bottom: calc((100% - 20px) / 2);
    -webkit-transform: translateY(50%);
    -moz-transform: translateY(50%);
    -ms-transform: translateY(50%);
    -o-transform: translateY(50%);
    transform: translateY(50%);
    right: 2px;
    pointer-events: none;
  
    font-family: Poppins-Regular;
    color: #c80000;
    font-size: 13px;
    line-height: 1.4;
    text-align: left;
  
    visibility: hidden;
    opacity: 0;
  
    -webkit-transition: opacity 0.4s;
    -o-transition: opacity 0.4s;
    -moz-transition: opacity 0.4s;
    transition: opacity 0.4s;
  }
  
  .alert-validate::after {
    content: "\f06a";
    font-family: FontAwesome;
    display: block;
    position: absolute;
    color: #c80000;
    font-size: 16px;
    bottom: calc((100% - 20px) / 2);
    -webkit-transform: translateY(50%);
    -moz-transform: translateY(50%);
    -ms-transform: translateY(50%);
    -o-transform: translateY(50%);
    transform: translateY(50%);
    right: 8px;
  }
  
  .alert-validate:hover:before {
    visibility: visible;
    opacity: 1;
  }
  
  @media (max-width: 992px) {
    .alert-validate::before {
      visibility: visible;
      opacity: 1;
    }
  }
  
  /* ------------------------------------ */
  .text-center {text-align: center;}
  .text-left {text-align: left;}
  .text-right {text-align: right;}
  .text-middle {vertical-align: middle;}



        </style>

        <script>
          function myFunction() {
            // alert('sfasdf');
            $("body").addClass("loading");
              document.getElementById("countries").submit();
            }
    </script>
        
  
</head>
<body>

    <!--Navbar -->
      <nav class="mb-1 navbar navbar-expand-lg fixed-top navbar-light white">
        <a href="https://nyayomat.com" class="pull-left"><img src="images/logo.png" class="brand-logo" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
          aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
          
          <ul class="navbar-nav ml-auto nav-flex-icons">
            
            <!-- <li class="nav-item">
              <a class="nav-link waves-effect waves-light">
                <i class="fab fa-opencart"></i>
              </a>
            </li> -->
            @auth('customer')
        <li class="nav-item dropdown">
            <a href="{{ route('account', 'dashboard') }}" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="blue-text">{{ trans('theme.hello') . ', ' . Auth::guard('customer')->user()->getName() }}</span>
                <i class="fas fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                <a class="dropdown-item" href="{{ route('account', 'dashboard') }}"><i class="fa fa-tachometer-alt fa-fw"></i>Overview</a>
                <a class="dropdown-item" href="{{ route('account', 'orders') }}"><i class="fa fa-shopping-cart fa-fw"></i>
      @lang('theme.nav.my_orders')</a>
                <a class="dropdown-item" href="{{ route('account', 'pendingreviews') }}"><i class="fa fa-exclamation-triangle fa-fw"></i>Pending Review</a>
                <a class="dropdown-item" href="{{ route('account', 'wishlist') }}"><i class="fas fa-gratipay fa-fw"></i>
                @lang('theme.nav.my_wishlist')</a>
                <!--<li><a href="{{ route('account', 'disputes') }}"><i class="fa fa-rocket fa-fw"></i> @lang('theme.nav.refunds_disputes')</a></li>-->
                    <!--<li><a href="{{ route('account', 'coupons') }}"><i class="fa fa-tags fa-fw"></i> @lang('theme.nav.my_coupons')</a></li>-->
                    
                {{--     <li><a href="{{ route('account', 'gift_cards') }}"><i class="fa fa-gift fa-fw"></i>
                      @lang('theme.nav.gift_cards')</a>
                                </li> --}}
                <a class="dropdown-item" href="{{ route('account', 'account') }}"><i class="fa fa-user fa-fw"></i>
            @lang('theme.nav.my_account')</a>
                <a class="dropdown-item" href="{{ route('customer.logout') }}"><i class="fa fa-power-off fa-fw"></i>
  {{ trans('theme.logout') }}</a>
            </div>
        </li>
        @else
        
            <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" id="modal_trigger" href="#modal" data-placement="bottom" title="Hello, Sign In"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i>
                  </a>              
            </li>
        @endauth
            <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-target="#loginModal" href="#nav-login-dialog"
              data-toggle="modal" data-placement="bottom" title="Hello, Sign In"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
              </a>
              
            </li> -->
          </ul>
        </div>
      </nav>
      <!--/.Navbar -->            
  <header class="container">
    <section class="content">
      <h1>Time to Order! <h1> <h2> Now find offers in your area</h2>
      <div class="row">
      <div class="col-sm-3 col-md-3"></div>
      <div class="col-sm-6 col-xs-12 col-md-6">
      <form method="post" action="{{route('countrywise')}}" id="countries">
                        @csrf
        <select class="browser-default custom-select select2" style="width:100%" name="country" onchange="myFunction()">
          <option selected value="">-- Select your location --</option>
          @foreach($countries as $con)    
              <option value="{{$con->id}}">{{$con->name}}</option>
          @endforeach
        </select>
        </form>
      </div>
      </div>
      <div class="col-sm-3 col-md-3"></div>
      <p class="sub-title">
       <!-- <img src="images/stripe.png" class="img-fluid" alt="Cinque Terre" /> -->
      </p>  
      <!-- <p class="sub-title"><strong>Shop now at the comfort of your home</strong> <br /> Get amazing discounts and timely delivery to your doorstep</p>     -->
    </section>
  </header>

    <!-- Footer -->
<footer class="page-footer font-small mdb-color pt-4" style="background-color:#4472c4 !important;">

  <!-- Footer Links -->
  <div class="container text-center text-md-left">

    <!-- Footer links -->
    <div class="row text-center text-md-left mt-3 pb-3">

      <!-- Grid column -->
      <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold">@lang('theme.subscription')</h6>
        <p>
        <!-- <form class="input-group"> -->
        {!! Form::open(['route' => 'newsletter.subscribe', 'class' => 'form-inline input-group']) !!}
          <div class="help-block with-errors"></div>
          <input type="email" class="form-control form-control-sm" placeholder="Your email" name="email" required
            aria-label="Your email" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-sm btn-outline-white my-0" type="submit">@lang('theme.button.subscribe')</button>
          </div>
        {!! Form::close() !!}
        </p>
        <p class="tips" style="color: white;">Subscribe now to get updates on promotions</p>
      </div>
      <!-- Grid column -->

      <hr class="w-100 clearfix d-md-none">

      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3" style = "text-align: left;">
        <h6 class="text-uppercase mb-4 font-weight-bold">Make Money With Us</h6>
        <p>
          <a href="https://nyayomat.com/selling">Sell On nyayomat</a>
        </p>
        <p>
          <a href="{{ url('/selling#howItWorks') }}" rel="nofollow">How It Works</a>
        </p>
        <p>
          <a href="{{ url('/selling#faqs') }}" rel="nofollow" >@lang('theme.nav.faq')</a>
        </p>
        <p>
          <a href="{{ url('/login') }}" rel="nofollow">Merchant Login</a>
        </p>
        <p>
        <a href="{{ route('page.open', \App\Page::PAGE_ABOUT_US) }}"
                        target="_blank">{{ trans('theme.nav.about_us') }}</a></li>
        </p>
        <p>
          <a href="{{ url('/contact_us') }}" rel="nofollow">Contact Us</a>
        </p>
      </div>
      <!-- Grid column -->
      <hr class="w-100 clearfix d-md-none">

      <!-- Grid column -->
      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3" style = "text-align: left;">
        <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
        <p style = "color: #fff !important;">
          <i class="fas fa-home mr-3"></i> P.O.Box 79162 - 00400 Nairobi
        </p>
        <p style = "color: #fff !important;">
          <i class="fas fa-envelope mr-3"></i> info@nyayomat.com
        </p>
        <p style = "color: #fff !important;">
          <i class="fas fa-phone mr-3"></i> + 254 111 6166 19
        </p>
        <p style = "color: #fff !important;">
          <i class="fab fa-whatsapp mr-3"></i> + 254 111 6166 19
        </p>
      </div>
      <!-- Grid column -->

    </div>
    <!-- Footer links -->

    <hr>

    <!-- Grid row -->
    <div class="row d-flex align-items-center">

      <!-- Grid column -->
      <div class="col-md-7 col-lg-8">

        <!--Copyright-->
        <p class="text-center text-md-left" style = "color: #fff !important;">Copyright © 2020
          <a href="https://nyayomat.com/">
            <strong>Nyayomat</strong>
          </a> - Trading under Samserve Limited | All rights reserved.
        </p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-5 col-lg-4 ml-lg-0">

        <!-- Social buttons -->
        <div class="text-center text-md-right">
          <ul class="list-unstyled list-inline">
            <li class="list-inline-item">
              <a class="btn-floating btn-sm rgba-white-slight mx-1 hoverable" href="https://www.facebook.com/nyayomat/" target="_blank">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn-floating btn-sm rgba-white-slight mx-1 hoverable" href="https://twitter.com/nyayomat" target="_blank">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn-floating btn-sm rgba-white-slight mx-1 hoverable btn-red" href="https://www.instagram.com/nyayomat/" target="_blank">
                <i class="fab fa-instagram pr-1"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn-floating btn-sm rgba-white-slight mx-1 hoverable" href="https://www.linkedin.com/" target="_blank">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn-floating btn-sm rgba-white-slight mx-1 hoverable btn-green" href="https://api.whatsapp.com/send?phone=254111616619" target="_blank">
                <i class="fab fa-whatsapp pr-1"></i>
              </a>
            </li>
          </ul>
        </div>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

</footer>
<!-- Footer -->

<!-- MODALS -->
    @unless(Auth::guard('customer')->check())
    @include('auth.modals')
    @endunless


<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="{{ theme_asset_url('js/jquery.leanModal.min.js') }}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/js/mdb.min.js"></script>

<!-- Select 2 -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js">
  </script>

      <!-- Notification -->
      @include('popup')

<script>
  $('.select2').select2({});
  

    $('[data-toggle="tooltip"]').tooltip()

</script>
<script>
        $('#passwordResetModal').on('show.bs.modal', function(e) {
            $('#loginModal').modal('hide');
        });

        $('#createAccountModal').on('show.bs.modal', function(e) {
            $('#loginModal').modal('hide');
        });

        $('#loginModal').on('show.bs.modal', function(e) {
            $('#createAccountModal').modal('hide');
        });
    </script>
    <script>

    $("#modal_trigger").leanModal({
          top: 100,
          overlay: 0.6,
          closeButton: ".modal_close"
      });
  $(document).ready(function () {

    $("#login_form").click(function() {
            $(".social_login").hide();
            $(".user_login").show();
            return false;
    });


        // Calling Login Form
        $("#passwordRecovery").click(function() {
            $(".user_login").hide();
            $(".header_title").text('Recover Password');
            $(".password_recovery").show();
            return false;
        });
        

        // Submitting the login form
        $("#emailLogin").click(function() {
            $("#loginForm").submit();
        });

        // Calling Register Form
        $("#register_form").click(function() {
                $(".social_login").hide();
                $(".user_register").show();
                $(".header_title").text('Register');
                
                return false;
        });

        // Going back to Social Forms
        $(".back_btn").click(function() {
                $(".user_login").hide();
                $(".password_recovery").hide();
                $(".user_register").hide();
                $(".social_login").show();
                $(".header_title").text('Login');
                return false;
        });

      

    $("#mobile_number").on("keypress keyup blur", function (event) {
      $(this).val($(this).val().replace(/[^\d].+/, ""));
      if ((event.which < 48 || event.which > 57)) {
        event.preventDefault();
      }
    });

    $("#send_otp").on('click', function (e) {
      var name = $("#name").val();
      var mobile = $("#mobile_number_r").val();
      var email = $("#email_r").val();
      var pass = $("#pass_r").val();
      var cpass = $("#conf_pass").val();
    
      // console.log(name + "/n" + mobile + "/n" + email + "/n" + pass + "/n" + cpass);

      if (name == "" || name == undefined) {
        $(".error").css("display", "block");
        $(".error").text("please enter name");
      } else {
        $(".error").css("display", "none");
      }

      if (mobile == "" || mobile == undefined) {
        console.log('hi');
        $(".error").css("display", "block");
        $(".error").text("please enter mobile number");
      } else {
        $(".error").css("display", "none");
      }

      if (email == "" || email == undefined) {
        $(".error").css("display", "block");
        $(".error").text("please enter email");
      } else {
        $(".error").css("display", "none");
      }

      if (pass == "" || pass == undefined) {
        $(".error").css("display", "block");
        $(".error").text("please enter password");
      } else {
        $(".error").css("display", "none");
      }

      if (cpass == "" || cpass == undefined) {
        $(".error").css("display", "block");
        $(".error").text("please enter confirm password");
      } else {
        $(".error").css("display", "none");
      }

      if (pass != cpass) {
        $(".error").css("display", "block");
        $(".error").text("password doesn't matched");
      } else {
        $(".error").css("display", "none");
      }
      if (mobile != "") {
        $body = $("body");
        $.ajax({
          url: '{{ route("customer.otp.send") }}',
          type: 'POST',
          data: {
            mobile: mobile
          },
          complete: function (data) {
            if (data.responseText == "success") {
              $(".otp_form").css("display", "block");
              $("#send_otp").css("display", "none");
            }

          },
        });
      } else {

      }
    //   $(e.target.form).submit();
    });

      



    $("#check_otp").on('click', function () {
      var otp = $("#otp").val();
      var mobile = $("#mobile_number_r").val();

      if (otp != "" || otp != undefined) {
        $.ajax({
          url: '{{ route('customer.otp.check') }}',
          type: 'POST',
          data: {
            otp: otp,
            mobile: mobile
          },

          complete: function (data) {
            console.log(data.responseText);
            if (data.responseText == "success") {
              $(".otp_form").css("display", "none");
              $(".reg").css("display", "block");
            } else {
              $(".error").css("display", "block");
              $(".error").text("otp is wrong");
              return false;
            }

          },
        });
      } else {

      }
    });
    
  });
</script>
<div class="otpLoader"><!-- Place at bottom of page --></div>
</body>
</html>