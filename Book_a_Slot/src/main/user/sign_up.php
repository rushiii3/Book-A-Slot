<!DOCTYPE html>
<html lang="en">
<head>

<meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/signup.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>

    <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />
</head>
<body class="bg-light">
    <?php
        require "../connection/connect.php";
        require_once("../loader.html"); 
    ?>
    <main id="main">
       <!-- SUCCESS -->
       <div class="modal fade" id="success" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-dialog-centered w-75 mx-auto">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="https://img.freepik.com/free-vector/confirmed-concept-illustration_114360-545.jpg?w=1060&t=st=1683867581~exp=1683868181~hmac=1e7364b0ade26d1472f5c388369363e9158af74c9e3784a415576453158c7a65" class="img-fluid" alt="">
                        <p class="fs-6 text-center"><strong>Congratulations.</strong> <br/> Your account has been successfully created.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="location.href='sign_in.php';" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- FAILED -->
        <div class="modal fade" id="failed" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-dialog-centered w-75 mx-auto">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="https://img.freepik.com/free-vector/removing-goods-from-basket-refusing-purchase-changing-decision-item-deletion-emptying-trash-online-shopping-app-laptop-user-cartoon-character-vector-isolated-concept-metaphor-illustration_335657-2843.jpg?w=1060&t=st=1683869448~exp=1683870048~hmac=351919e98226dbde35a446a66fcd783e63766b69193d06232b36da08b0ca3b2c" class="img-fluid" alt="">
                        <p class="fs-6 text-center"><strong>Failed to register.</strong> <br/> Try again. </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Try Again</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- already user -->
        <div class="modal fade" id="alreadyuser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-dialog-centered w-75 mx-auto">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="https://img.freepik.com/free-vector/no-data-concept-illustration_114360-695.jpg?w=1060&t=st=1688926611~exp=1688927211~hmac=36108177513afe06c75488de8c19053de76e5fb761e3818c2cd4772ed588cc5b" class="img-fluid" alt="">
                        <p class="fs-6 text-center"><strong>Already user</strong> <br/> Login with your credentials </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="location.href='sign_in.php';" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container w-75 mt-5 mb-5 shadow p-3 mb-5 bg-body" style="border-radius: 20px">
            <div class="row p-3">
                           
                                <div class="p-1 col-lg-6" id="section1">
                                <p class="h1">Sign up</p>
                                    <form action="<?php $_PHP_SELF ?>" method="POST">
                                        <div class="mb-3">
                                            <label for="full_name" class="form-label">Full Name</label>
                                            <input type="text" name="full_name" class="form-control" id="full_name" placeholder="e.g. abc def" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email address</label>
                                            <input type="text" name="email" class="form-control" id="email" aria-describedby="emailVerify" placeholder="e.g. abc@vazecollege.net" required>
                                            <div id="emailVerify" class="form-text"></div>
                                        </div>
                                        <div class="mb-3">
                                        <label for="dep_id" class="form-label">Select your department/Committiee</label>
                                                                <select class="form-select" id="dep_id">
                                                                <option selected>Select a Department / Committee</option>
                                                                    <?php
                                                                    $get_dep = "SELECT department_acadamics FROM DEPARTMENT GROUP BY department_acadamics";
                                                                    $result = mysqli_query($con,$get_dep);
                                                                    if(mysqli_num_rows($result)>0)
                                                                    {
                                                                    while($row = mysqli_fetch_assoc($result))
                                                                    {
                                                                        ?>
                                                                        <option value="<?php echo($row['department_acadamics']); ?>"><?php echo($row['department_acadamics']); ?></option>
                                                                        <?php
                                                                        ?>
                                                                    </optgroup>
                                                                        <?php
                                                                    }
                                                                    }
                                                                    ?>
                                                                </select>
                                        </div>
                                        <div class="mb-3">
                                        <label for="department_namee" class="form-label">Select Department</label>
                                                        <select
                                                            name="department_namee"
                                                            class="form-select"
                                                            id="department_namee"
                                                            name="department_namee"
                                                        >
                                                            <option selected>Select your department/committee first</option>
                                                            
                                                        </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group">
                                                <input type="password" name="password" class="form-control" id="password" aria-describedby="pass_verify" placeholder="Password" required>
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
                                                <input type="password" class="form-control" id="confirm_password" aria-describedby="confirm_password_verify" placeholder="Confirm Password" required>
                                                <span class="input-group-text confirm_pass_icon" id="basic-addon1">
                                                    <i class="bi bi-eye-fill cpass_open_eye"></i>
                                                    <i class="bi bi-eye-slash-fill cpass_close_eye"></i>
                                                </span>
                                            </div>
                                            <div id="confirm_password_verify" class="form-text"></div>
                                        </div>
                                        <button type="button" name="submit" id="submit" class="btn btn-primary px-5 py-2 ms-5 mt-3">Submit</button>
                                        <button type="button" id="sendEmail" class="d-none"></button>
                                    </form>
                                </div>
                                <div class="col-lg-6 my-auto" id="section2">
                            <p class="h1">Verify your account</p>
                            <p  class="text-wrap" style="word-wrap: break-word;">We have sent a code to <span class="fw-bold" id="emailInfo"></span></p>
                            <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2"> 
                                <input pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="first" class="m-2 text-center form-control rounded" type="text" id="first"> 
                                <input pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="second" class="m-2 text-center form-control rounded" type="text" id="second"> 
                                <input pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="third" class="m-2 text-center form-control rounded" type="text" id="third"> 
                                <input pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="fourth" class="m-2 text-center form-control rounded" type="text" id="fourth"> 
                            </div> 
                            <div id="invalidOtp" class="form-text"></div>
                        <button type="button" name="submit" id="verifyOtp" class="btn btn-primary px-5 py-2 mt-5 w-100">
                            Verify
                        </button>
                            <p class="text-center mt-3"> 
                            <button type="button" class="btn px-5 bg-dark-subtle mx-auto" id="resend_otp" >
                            Resend Otp
                        </button>
                                <span class="counter">
                                    Resend OTP in <span id="countdowntimer">59 </span> Seconds
                                </span>
                        </p>
                        
                    </div>
                    

                <div class="p-4 col-lg-6">
                    <img src="https://img.freepik.com/premium-vector/online-registration-sign-up-with-man-sitting-near-smartphone_268404-95.jpg?w=1480" alt="" class="img-fluid h-auto" />
                    <p class="text-center mt-5">
                        <a href="sign_in.php"  class="link-dark">Already have an account? Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </main>
    <div id="emailTemp" style="display:none;">

</div>
    
    <?php
        mysqli_close($con);
    ?>
    <script src="../../js/verify_account.js"></script>
</body>
</html>