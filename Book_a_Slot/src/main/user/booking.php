<?php
require("../config/session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="../../css/booking.css">
    <script src="../../js/smtp.js"></script>
    <title>Book</title>
    <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />
    

</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <?php
         require "../connection/connect.php";
         require_once("../loader.html"); 
         if($user_type=="o" || $user_type=="k" || $user_type=="a" || $user_type=="i")
  {
  }else{
    echo("<script>window.location='../user/sign_in.php';</script>");
  }
     ?>
    <main id="main">

        <?php
     include("navbar.php");
    ?>


<!-- SUCCESS -->
<div class="modal fade" id="success" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-dialog-centered w-75 mx-auto">
    <div class="modal-content">
      <div class="modal-body">
      <img src="https://img.freepik.com/free-vector/goal-achievement-planning-checklist-flat-composition-with-man-holding-pencil-tick-image_1284-63673.jpg?w=1060&t=st=1684568117~exp=1684568717~hmac=d2a5e07e610acc520b8359beead1c1938d3160eb998bd132bdd545f5b00883ee" class="img-fluid" alt="">
        <p class="fs-6 text-center"><strong>Congratulations.</strong> <br/> Your venue will be confirmed in 24hr! <br> You can check you status in Check status</p>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="bookAgain">Book another</button>
      <button type="button" onclick= "<?php if($user_type=="k"){ echo("location.href='status_outsider.php'"); }else{echo("location.href='status.php'");}?>" class="btn btn-primary">Check Status</button>      </div>
    </div>
  </div>
</div>
<!-- FAILED -->
<div class="modal fade" id="failed" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-dialog-centered w-75 mx-auto">
    <div class="modal-content">
      <div class="modal-body">
      <img src="https://img.freepik.com/free-vector/oops-404-error-with-broken-robot-concept-illustration_114360-1932.jpg?w=1060&t=st=1684568442~exp=1684569042~hmac=939ab6fee619a44b81af999bef8df55df06ea101b4289328e026f74156465ec2" class="img-fluid" alt="">
        <p class="fs-6 text-center"><strong>Failed to Booked.</strong> <br/> Try again. </p>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Try Again</button>
      </div>
    </div>
  </div>
</div>


<!-- terms and condition modal -->
<div class="modal fade" id="terms_and_condition" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-dialog-centered w-75 mx-auto">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Terms And Condition</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      <div class="modal-body">
      <ol style="text-align:justify;">
<li class="mt-1">Departments and Activity groups should strictly follow the timings once booking is done.</li>
<li class="mt-1">Departments and Activity groups are required to submit details of programme conducted, Report of the programme, Geo-tagged photos, etc. within 2 days after programme is conducted.</li>
<li class="mt-1">If the programme details are not submitted, the booked event will not be closed. In such situations, the next booking will not be allowed for that Department or Activity group.</li>
<li class="mt-1">Booking is available for seminars, meetings, and such other academic programmes only.</li>
<li class="mt-1">Venues are not available for any private functions.</li>
<li class="mt-1">Eatables are not allowed in the Auditoriums.</li>
<li class="mt-1">Auditoriums are not allowed  for any practice sessions.</li>
</ol>
      </div>
      <div class="modal-footer" id="tnc_footer">
      <button type="button" class="btn btn-primary" id="iagree" data-bs-dismiss="modal">I Agree</button>
      </div>
    </div>
  </div>
</div>

        <div class="container mt-5 mb-5 shadow p-3 mb-5 bg-body" id="main_body" style="border-radius: 20px">
            <!-- Container starting -->
            <div class="row">
                <!-- row staring -->
                <!-- Image for div -->
                <div class="p-4 col-lg-6">
                    <!-- new col for image -->
                    <img src="https://img.freepik.com/free-vector/appointment-booking-with-woman-calendar_23-2148559014.jpg?w=1060&t=st=1684132939~exp=1684133539~hmac=d2101dc2baf34866ceb2d3eabe252bb481424284e4e6adc90f6765677ba3ae4e" alt="" class="img-fluid">
                </div>
                <div class="p-4 col-lg-6">
                    <?php
                    $open_closed = array();
                    $get_close_event_info = "SELECT * FROM `EVENT` WHERE user_name = '$user_email' ";
                    $result_of_closed_event = mysqli_query($con,$get_close_event_info);
                    if(mysqli_num_rows($result_of_closed_event))
                    {
                        while($row = mysqli_fetch_assoc($result_of_closed_event))
                        {
                            date_default_timezone_set('Asia/Kolkata');
                            if($row['event_status']=="Open" && date('Y-m-d')>=$row['event_date'])
                            {
                                
                                array_push($open_closed,"open");
                            }
                        }
                    }
                               if(sizeof($open_closed)>0)
                               {
                                ?>
                                <p class="fw-bold text-center fs-3" style="margin-top:15rem;margin-bottom:10rem;">Please Close the previous event.</p>
                                <?php
                               }else{
                    ?>
                    <!-- new col for booking -->
                    <p class="fs-3 text-center fw-bold">
                        Book your slot
                    </p>
                    <div class="pro">
                    <div class="stepper-wrapper">
                        <div class="stepper-item ">
                            <div class="step-counter">1</div>
                            <div class="step-name text-center">Event <br> Details</div>
                        </div>
                        <div class="stepper-item ">
                            <div class="step-counter">2</div>
                            <div class="step-name text-center">Venue <br> Selection</div>
                        </div>
                        <div class="stepper-item ">
                            <div class="step-counter">3</div>
                            <div class="step-name text-center">Requirement<br> </div>
                        </div>
                        <div class="stepper-item ">
                            <div class="step-counter">4</div>
                            <div class="step-name text-center">Resourse <br> Person info</div>
                        </div>
                        </div>
                    </div>
<form action="<?php $_PHP_SELF ?>" method="post">
                    <div class="container-fluid">
                        <!-- new container -->
                        <div class="row section1">
                            <!-- new row -->
                            
                            
                            <input type="text" name="user_email" class="form-control" id="user_email" value="<?php echo($user_email); ?>" readonly style="display:none;">

                                        <div class="col-12 mb-3">
                                            <label for="eventName" class="form-label">Event Name</label>
                                            <input type="text" name="eventName" class="form-control" id="eventName" placeholder="e.g. ....... ">
                                        </div>
                                        <div class="col-12 mb-3">
                                                <label for="eventDescription" class="form-label">Event Description</label>
                                                <textarea class="form-control" name="eventDescription" id="eventDescription" rows="2"></textarea>
                                        </div>
                                        <div class="col-12 mb-3">
                                                <label for="dep_id" class="form-label">Select your department/Committiee</label>
                                                <select class="form-select" id="dep_id">
                                                    <option selected>Select a Department / Committee</option>
                                                    <?php
                                                    $get_dep = "SELECT department_acadamics FROM DEPARTMENT GROUP BY department_acadamics";
                                                    echo("$get_dep");
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
                                        <div class="col-12 mb-3">
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

                                    <div class="col-12 mb-3" id="org_institue_name">
                                            <label for="Institute_Org_Name" class="form-label">Institute/Organisation Name</label>
                                            <input type="text" name="Institute_Org_Name" class="form-control" id="Institute_OrgName" placeholder="e.g. ....... ">
                                    </div>

                                    <div class="col-12 mb-3" id="org_institue_email">
                                            <label for="Institute/Org_Name_email" class="form-label"> Email</label>
                                            <input type="email" name="Institute_OrgName_email" class="form-control" id="Institute_OrgName_email"  placeholder="e.g. abc@gmail.com" >

                                    </div>
                                    <div class="col-12 mb-3" id="org_institue_phone">
                                            <label for="Institute_Org_Name_phone_no" class="form-label">Phone Number</label>
                                            <input type="number" name="Institute_OrgName_phone_no"  class="form-control" id="Institute_OrgName_phone_no" placeholder="e.g. ....... " pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" >
                                    </div>    
                                        <div class="col-12 mb-1 mt-5">
                                            <button type="button" class="btn btn-primary px-4 ms-3" id="nextFirst">Next</button> 
                                        </div>
                                        
                        </div>
                        <!-- new row ending -->


                        <div class="row section2">
                            <!-- new row -->
                            
                                    
                                    <div class="col-12 mb-3">
                                        <label for="Venue_name" class="form-label">Select Venue</label>
                                        <select
                                            name="Venue_name"
                                            class="form-select"
                                            id="Venue_name"
                                            name="Venue_name"
                                            required
                                        >
                                            <option selected>Select Venue</option>
                                            <?php
                                                $get_audi_room_query = "SELECT * FROM AUDI_ROOM";
                                                $result_of_audi_room_query = mysqli_query($con,$get_audi_room_query);
                                                if(mysqli_num_rows($result_of_audi_room_query)>0) 
                                                {
                                                    while($row_of_audi_room_query =
                                                    mysqli_fetch_assoc($result_of_audi_room_query))
                                                    { ?>
                                                    <option
                                                        value="<?php echo($row_of_audi_room_query['ar_name']); ?>"
                                                    >
                                                        <?php echo($row_of_audi_room_query['ar_name']); ?>
                                                    </option>
                                                    <?php
                                                }
                                                }
                                                    ?>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-3">
                                            <label for="no_of_stu_attending" class="form-label">No of students attending event</label>
                                            <input type="number" class="form-control" name="no_of_stu_attending" id="no_of_stu_attending" placeholder="e.g. ....... ">
                                            <div id="no_verify" class="form-text text-danger"></div>
                                            <div id="capacity" class="form-text text-warning"></div>
                                        </div>
                                    <div class="col-12 mb-3 input-group">
                                            <label for="selectDate" class="form-label w-100">Date</label><br>
                                            <input type="text" name="selectDate" class="form-control rounded-start border-end-0" id="selectDate" placeholder="e.g. ....... ">
                                            <span class="input-group-text bg-white" id="basic-addon1"><i class="bi bi-calendar-event"></i></span>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="startTime" class="form-label">Start Time</label>
                                            <select class="form-select" name="selectStartTime" id="selectStartTime" aria-label="select_start_time">
                                            <option selected>Select the Date and Venue First</option>    
                                            
                                            </select>
                                            
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="endTime" class="form-label">End Time</label>
                                            <select class="form-select" name="selectEndTime" id="selectEndTime" aria-label="select_start_time">
                                            <option selected>Select the Date and Venue First</option>  
                                                
                                            </select>
                                        </div>
                                    <div class="col-12 mb-1 mt-5">
                                            <button type="button" class="btn btn-secondary px-4 ms-3" id="prevBtnSecond">Previous</button>
                                            <button type="button" class="btn btn-primary px-4 ms-3" id="nextSecond">Next</button> 
                                        </div>
                                
                        </div>
                        <div class="row section3">
                            <!-- The requirement field-->
                                        <div class="col-12 mb-3">
                                            <label for="rp_name" class="form-label">Select your requriements</label>
                                        </div>
                                        <!-- require,ment div coming from ajax for mic and projector -->
                                        <div id="requirement_div">

                                        </div>
                                        <!-- require,ment div coming from ajax for chairs and dias-->
                                        <div class="col-12 mb-3">
                                            <label for="select_no_of_chairs" class="form-label">No. of chairs required on dias</label>
                                            <select class="form-select" name="select_no_of_chairs" id="select_no_of_chairs" aria-label="select_no_of_chairs">
                                                    <option selected>Select No. of chairs required on dias </option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-12 mb-1 mt-5">
                                            <button type="button" class="btn btn-secondary px-4 ms-3" id="prevBtnThird">Previous</button>
                                            <button type="button" class="btn btn-primary px-4 ms-3" id="nextThird">Next</button> 
                                        </div>
                                        
                        </div>

                        <!-- new row ending -->
                        
                        <div class="row section4">
                            <!-- resource person section-->
                            <div class="col-12 mb-3">
                                            <label for="alumini" class="form-label">Is it for alumni</label>
                                            <select class="form-select" name="alumini" id="alumini">
                                                <option selected>Select whether is it for alumni</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                                
                                            </select>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="rp_name" class="form-label">Select the number of Resourse Person attending</label>
                                            <select class="form-select" name="no_of_rp" id="no_of_rp">
                                                <option selected>Please Select the Number of Resourse Person</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                                <option value="4">Four</option>
                                                <option value="5">Five</option>
                                                <option value="No">None</option>
                                            </select>
                                        </div>
                                        <div class="container-fluid">
                                    <div class="row flex-nowrap" id="rps_names" name="rps_names" style=" overflow-x: auto;width:;height:22rem;">

                                    
                                         
                                    </div>
                                </div>    
                                    <div class="col-12 mb-4 form-check">
                                                <input class="form-check-input" id="check_box_terms_and_condition"  type="checkbox" value="">
                                                <label class="form-check-label" for="terms_condition">
                                                    I agree to these 
                                                    <span><a href="#" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" id="tandcondlink">Terms and Conditions.</a></span>
                                                </label>
                                        </div>
                                        <div class="col-12 mb-1 mt-5">
                                            <button type="button" class="btn btn-secondary px-4 ms-3" id="prevBtnFourth">Previous</button>
                                            <button type="button" class="btn btn-primary px-4 ms-3" id="nextForth">Submit</button> 
                                            <input type="submit" style="display:none;" name="FinalSubmit" id="FinalSubmit" value="none">
                                        </div>
                        </div>
                        <div id="timeBlock">
                        </div>
                        <div id="emailtemp" style="display:none;">

                        </div>
<!-- new row ending -->
                                    
                                    
                    </div>
                    <!-- new container ending -->

<?php
} 

?>


                </div>
            <!-- row ending -->
            </div>
        <!-- container ending -->
        </div>  
</form>

    </main>
    <script src="../../js/booking.js"></script>
    <script src="../../js/booking2.js"></script>
    <script src="../../js/bookingDate.js"></script>
    <script>
        flatpickr("#selectDate", {
      dateFormat: 'Y-m-d',
      minDate: new Date().fp_incr(3),
      disable: [       
        <?php
            $get_blocked_date_query = "SELECT * FROM disableDates";
            $result_of_blocked_date_query = mysqli_query($con,$get_blocked_date_query);
            if(mysqli_num_rows($result_of_blocked_date_query)>0){
                while($row_of_blocked_date = mysqli_fetch_assoc($result_of_blocked_date_query))
                {
                     $date = date("Y-m-d", strtotime("-1 years", strtotime($row_of_blocked_date['datee'])));
                     for($i=0;$i<=5;$i++)
                     {?>
                        '<?php echo(date("Y-m-d", strtotime("+$i years", strtotime($row_of_blocked_date['datee']))));?>',
                    <?php
                     } 
                
                }
            }
        ?>
      ]
    });
    </script>
</body>
</html>
<?php
            mysqli_close($con);
          ?>
         