<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

  <script src="https://smtpjs.com/v3/smtp.js"></script>
    <title>Document</title>
    <style>
        #first, #second, #third, #fourth{
            width:25%;
    height:60px;
    text-align: center;
        }
    </style>
</head>
<body>
<?php
    require "../connection/connect.php";
    require_once("../loader.html");
    ?>

    <main id="main">
        <!-- FAILED -->
        <div class="modal fade" id="failed" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-dialog-centered w-75 mx-auto">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="https://img.freepik.com/free-vector/401-error-unauthorized-concept-illustration_114360-5531.jpg?w=1060&t=st=1683877856~exp=1683878456~hmac=dc95863d337270b3f7d86dfae1957dcbffa77e5ca417f4dbc27522cd8a3f7a04" class="img-fluid" alt="">
                        <p class="fs-6 text-center"><strong>Login Failed</strong> <br/> Incorrect Email or Password </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Try Again</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container mt-5 mb-5 shadow p-3 mb-5 bg-body" style="border-radius: 20px;width:90%;">
            <div class="row p-3">
                <div class="p-1 col-lg-6">
                    <form  method="POST">
                    <div id="section1">
                        <div class="col-lg-12 mt-5">
                            <p class="h1">Forgot password?</p>
                        </div>
                        <div class="col-lg-12">
                            <p class="h5">No worries we will send a otp to your account</p>
                        </div>
                        <div class="mb-3 pt-5 col-lg-12">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" autocomplete="username" aria-describedby="emailVerify" placeholder="e.g. abc@vazecollege.net" required />
                            <div id="emailVerify" class="form-text"></div>
                        </div>
                        
                        <button type="button"  name="submit" id="sendOtp" class="btn btn-primary px-5 py-2 mt-3 w-100">
                            Submit
                        </button>                        
                        <p class="mt-3 text-center">
                            <a href="sign_in.php" class="link-dark text-decoration-none"><i class="bi bi-arrow-left"></i>  &nbsp Back to Sign in</a>
                        </p>
                    </div>
                    <div id="section2">
                        <div class="col-lg-12 mt-5">
                            <p class="h1">Password Reset</p>
                        </div>
                        <div class="col-lg-12 mb-5">
                            <p  class="text-wrap" style="word-wrap: break-word;">We have sent a code to <span class="fw-bold" id="emailInfo"></span></p>
                        </div>
                            <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2"> 
                                <input pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="first" class="m-2 text-center form-control rounded" type="text" id="first"> 
                                <input pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="second" class="m-2 text-center form-control rounded" type="text" id="second"> 
                                <input pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="third" class="m-2 text-center form-control rounded" type="text" id="third"> 
                                <input pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="fourth" class="m-2 text-center form-control rounded" type="text" id="fourth"> 
                            </div> 
                            <div id="invalidOtp" class="form-text"></div>
                        <button type="button" name="submit" id="verifyOtp" class="btn btn-primary px-5 py-2 mt-5 w-100">
                            Continue
                        </button>
                        <p style="font-size:0.8rem;" class="text-center mt-3 fw-bold" id="goBack">
                            Wrong email? Go back
                        </p>
                    </div>
                    <div id="section3">
                        <div class="col-lg-12 mt-5">
                            <p class="h1">Set new password</p>
                        </div>
                        <div class="col-lg-12 mb-5">
                            <p class="fw-3">Must be at 8 character and one upper case character </p>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="password" autocomplete="new-password" aria-describedby="pass_verify" placeholder="Password">
                                <span class="input-group-text pass_icon" id="basic-addon1">
                                    <i class="bi bi-eye-fill pass_open_eye"></i>
                                    <i class="bi bi-eye-slash-fill pass_close_eye"></i>
                                </span>
                            </div>
                            <div id="pass_verify" class="form-text"></div>
                        </div> 
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" name="confirm_password" class="form-control" id="confirm_password" autocomplete="current-password" aria-describedby="cpass_verify" placeholder="Password" >
                                <span class="input-group-text cpass_icon" id="basic-addon1">
                                    <i class="bi bi-eye-fill cpass_open_eye"></i>
                                    <i class="bi bi-eye-slash-fill cpass_close_eye"></i>
                                </span>
                            </div>
                            <div id="confirm_password_verify" class="form-text"></div>
                        </div> 
                        <button type="button" name="resetPassword" id="resetPassword" class="btn btn-primary px-5 py-2 mt-5 w-100">
                            Reset password
                        </button>
                        </div>
                        <div id="section4">
                            <div class="text-center mt-5">
                            <img src="https://www.pngmart.com/files/20/Success-Transparent-Background.png" class="img-fluid w-50 ">
                                <p class="p-1 mt-5">
                                    Your password has been changed successfully
                                </p>
                                <p class="p-1 mt-5">
                                    You can login now with your new password
                                    <a href="sign_in.php">click to login</a>
                                </p>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="p-4 col-lg-6 mt-1">
                    <img src="../../img/forgotpass.png" alt="" class="img-fluid h-100 w-100" />
                </div>
            </div>
        </div>
        <div id="emailTemp" style="display:none;">

        </div>
    </main>
    <script src="../../js/forgot.js"></script>
</body>
</html>