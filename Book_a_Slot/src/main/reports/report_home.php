<?php
session_start();
if(!isset($_SESSION["user_email"]) )
{
  echo("<script>window.location='../user/sign_in.php';</script>");
}
else{
  $user_email = $_SESSION["user_email"];
  $user_name = $_SESSION["user_full_name"];
  $user_type = $_SESSION["user_type"];
}
if($user_type=="a" || $user_type=="i"){
    
}else{
      echo("<script>window.location='../user/sign_in.php';</script>");

}
include '../connection/connect.php';
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js" integrity="sha512-5SUkiwmm+0AiJEaCiS5nu/ZKPodeuInbQ7CiSrSnUHe11dJpQ8o4J1DU/rw4gxk/O+WBpGYAZbb8e17CDEoESw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Reports</title>
    <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />
    <style>
        #card:hover {
            transform: translateY(-30px);
        }
        .custom-gradient {
      background: linear-gradient(to right,#0066ff, #3385ff,#4d94ff,#6699ff, #80b3ff, #99c2ff, #b3d1ff,#cce0ff,#e6f0ff);
    }
    .fixed-size {
        width: 500px; 
      height: 200px; 
    }
    </style>
</head>

<body>
    <?php
    require_once("../loader.html");
    ?>
    <main id="main">
    <?php
            include("../admin/admin_navbar.html");
            ?>
<div class="col-lg-12 mb-5">
                <h1 class=" w-50 m-auto d-flex justify-content-center fw-bolder" style="align-items: center;">REPORTS PANEL</h1>
                <a href="../reports/overall_report.php"><strong class="text-center d-flex justify-content-center" >click here to get short summary</strong></a>
                </div>
        <div class="container-fluid mt-3">
        
        <div class="row">
                      <div class="col-lg-4 mb-5">
                            <div class="card mx-auto shadow w-75  " id="card" style="border-radius:20px;height:15rem">
                            <button class="btn  mt-3 m-auto d-flex justify-content-center  " style="border-radius:20px;" data-toggle="modal" data-target="#exampleModalLabel" >
                                    
                                    <div class="card-body text-center text-black flex-fill ">
                                      <h4 class="text-center fw-bold">GET MONTH WISE REPORT</h4>  
                                      <p>This report will provide a month wise report.Just select month and enter a year </p>
                                      
                                    </div>
                                </button>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-5">
                            <div class="card mx-auto shadow w-75"  id="card" style="border-radius:20px;height:auto">
                            <button class="btn  mt-3 m-auto d-flex justify-content-center " style="border-radius:20px;" data-toggle="modal" data-target="#resource" >
                                    <div class="card-body text-center text-black flex-fill">
                                    <h4 class="text-center fw-bold"> RESOURSE PERSON REPORT</h4>

                                    <p>This report will provide list of resourse person according to academic year.
                                Please enter  complete academic year eg. 2023-2024
                               </p>
                                      
                                    </div>
                                </button>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-5">
                            <div class="card mx-auto shadow w-75"  id="card" style="border-radius:20px;height:15rem">
                            <button class="btn  mt-3 m-auto d-flex justify-content-center  " style="border-radius:20px;" data-toggle="modal" data-target="#dept_present" >

                                    
                                    <div class="card-body text-center text-black flex-fill">
                                    <h4 class="text-center fw-bold">DEPARTMENT WISE ATTENDANCE</h4>

                                    <p>This report will provide attendance percentage of boys and girls according to department.
                               Please enter  complete academic year eg. 2023-2024
                               </p>
                                      
                                    </div>
                                </button>
                            </div>
                        </div>
                        
      </div>           
      <div class="row">
                    <div class="col-lg-4 mb-5">
                            <div class="card mx-auto shadow w-75"  id="card" style="border-radius:20px;height:auto">
                            <button class="btn  mt-3 m-auto d-flex justify-content-center  " style="border-radius:20px;" data-toggle="modal" data-target="#out" >

                                    
                                    <div class="card-body text-center text-black flex-fill">
                                    <h4 class="text-center fw-bold">OUTSIDER'S REPORT</h4>
                                    <p>This report will provide attendance percentage of boys and girls according to department.
                               Please enter  complete academic year eg. 2023-2024
                               </p>
                                      
                                    </div>
                                </button>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-5">
                            <div class="card mx-auto shadow w-75 "  id="card" style="border-radius:20px;height:13rem">
                            <a href="../reports/room_occupacy.php" style="text-decoration:none;">
                                    <div class="card-body text-center text-black flex-fill">
                                    <h4 class="text-center fw-bold">ROOM OCCUPACY REPORT</h4>
                                    <p>This report will provide graph showing in which audi/room how many event's occured </p>
                                      
                                    </div>
                            </a>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-5">
                            <div class="card mx-auto shadow w-75 "  id="card" style="border-radius:20px;height:13rem">
                            <a href="../reports/cancel_report.php" style="text-decoration:none;">

                                    
                                    <div class="card-body text-center text-black flex-fill">
                                    <h4 class="text-center fw-bold">CANCEL EVENTS REPORT</h4>
                                    <p>This report will provide graph showing which department cancel how many events. </p>
                                    </div>
                            </a>
                            </div>
                        </div>
                        
      </div>           
           
            <!-- <div class="row p-4"> -->


                <!-- </div> -->
<!--   end of outer main row -->
           
            </div>
        </div>
        
    </main>
   
</body>

<!-- modal for month report -->
<div class="modal fade" id="exampleModalLabel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="../reports/month_report.php" method='post'>
      <div class="modal-body">
      <h1 class="modal-title fs-5" id="exampleModalLabel"> Month Wise Report</h1>
            <div class="form-outline w-100 m-auto mt-3">
                <label for="month" class="form-label fw-bold">Select Month:</label>
                <select name="month" id="month">
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
                </select>
            </div>
                <div class="form-outline w-100 m-auto  mt-3">
                    <label for="year" class="form-label fw-bold">Enter a year </label>
                    <input type="number" id="year" name="year" class="form-control" placeholder="eg.2023">
                </div>
      
      <div class="modal-footer">
        <button type="submit" class="btn btn-secondary"  name="close">Close</button>
        <button type="submit" class="btn btn-primary" name="month_report">OK</button>
      </div>
      </div>
    </form>
    </div>
  </div>
</div>
<!-- modal for outsider report -->
<div class="modal fade" id="out" tabindex="-1" aria-labelledby="out" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <form action="../reports/outsider_report.php" method="post">
      <div class="modal-body">
      <h1 class="modal-title fs-5 text-center" id="out">Outsider Information</h1>
        <div class="form-outline w-100 m-auto  mt-3">
                    <label for="year" class="form-label fw-bold">Enter a Academic year </label>
                    <input type="text" id="year" name="year" class="form-control" placeholder="eg.2023-2024">
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name='outsider_report'>OK</button>
      </div>
    </div>
    </form>
  </div>
</div>
</div>
<!-- modal for attendance report -->
<div class="modal fade" id="dept_present" tabindex="-1" aria-labelledby="present" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <form action="../reports/attendance.php" method="post">
      <div class="modal-body">
      <h1 class="modal-title fs-5 text-center" id="out">Department Wise attendance</h1>
        <div class="form-outline w-100 m-auto  mt-3">
                    <label for="year" class="form-label fw-bold">Enter a Academic year </label>
                    <input type="text" id="year" name="year" class="form-control" placeholder="eg.2023-2024">
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name='outsider_report'>OK</button>
      </div>
    </div>
    </form>
  </div>
</div>
</div>
<!-- Modal for resource person report-->
<div class="modal fade" id="resource" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="../reports/resource_person.php" method="post">
      <div class="modal-body">
      <h1 class="modal-title fs-5" id="exampleModalLabel">Resource Person Information</h1>
      <div class="form-outline w-100 m-auto  mt-3">
                    <label for="year" class="form-label fw-bold">select organization/institute who invited resource persons:</label>
                    <select name="organizer" class='w-50 m-auto' id="organizer">
                        <?php
                        $get_organizations="SELECT distinct DEPARTMENT.department_name FROM `EVENT` JOIN `DEPARTMENT` on EVENT.dep_id=DEPARTMENT.department_id JOIN (SELECT event_id,full_name from `RESOURCE_PERSON` GROUP BY event_id)`RESOURCE_PERSON` on EVENT.event_id=RESOURCE_PERSON.event_id where status_value='Approved' and RESOURCE_PERSON.full_name<>'NA'";
                        $result=mysqli_query($con,$get_organizations);
                        while($row=mysqli_fetch_assoc($result)){
                            $organizer=$row['department_name'];
                            echo "<option  value='$organizer'>$organizer</option>   ";
                        }
                        ?>
                        
                    </select>
        </div>
        <div class="form-outline w-100 m-auto  mt-3">
                    <label for="year" class="form-label fw-bold">Enter a Academic year </label>
                    <input type="text" id="year" name="year" class="form-control" placeholder="eg.2023-2024">
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name='resource_person'>OK</button>
      </div>
    </div>
    </form>
  </div>
</div>

</html>
<?php
mysqli_close($con);
?>
