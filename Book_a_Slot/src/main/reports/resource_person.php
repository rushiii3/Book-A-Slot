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
<?php

if(isset($_POST['close'])){
    header('location:../reports/report_home.php');
}
if(isset($_POST['resource_person'])){
    $academic_year=$_POST['year'];
    $organizer=$_POST['organizer'];
    //echo $organizer;
    if($academic_year!=''){
    $years = explode("-", $academic_year);
    $start_year=intval($years[0]);
    $end_year=intval($years[1]);
     if($end_year<$start_year){
        echo "<script>alert('Please Enter a academic year appropriately')</script>";
        echo("<script>window.location='../reports/report_home.php';</script>");
        }
    }
   
    if($academic_year==''){
        echo "<script>alert('Please Enter a academic year')</script>";
        echo("<script>window.location='../reports/report_home.php';</script>");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resource Person Reports</title>
    <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js" integrity="sha512-5SUkiwmm+0AiJEaCiS5nu/ZKPodeuInbQ7CiSrSnUHe11dJpQ8o4J1DU/rw4gxk/O+WBpGYAZbb8e17CDEoESw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-10 col-lg-10 m-auto">
            <?php
                include '../admin/admin_navbar.html';
                ?>
            <?php
            $count=0;
                $rp_info="SELECT RESOURCE_PERSON.full_name,RESOURCE_PERSON.company_name,RESOURCE_PERSON.designation,RESOURCE_PERSON.experience,DEPARTMENT.department_name,EVENT.event_name FROM `RESOURCE_PERSON`
                join `EVENT` on RESOURCE_PERSON.event_id=EVENT.event_id JOIN `DEPARTMENT` on EVENT.dep_id=DEPARTMENT.department_id WHERE RESOURCE_PERSON.full_name<>'NA' AND RESOURCE_PERSON.event_id in (SELECT event_id from `EVENT` WHERE DEPARTMENT.department_name='$organizer' and status_value='Approved' and event_date between '$start_year-06-15' and '$end_year-06-15')";
                $result1=mysqli_query($con,$rp_info);
                if($result1===false){
                    die(mysqli_error($con));
                }
                while($row=mysqli_fetch_assoc($result1)){
                    $count++;
                   }
            ?>
            <?php
            if($count>0){
            echo "<h3 class='text-center'>List of resource person(s) for $organizer (Academic-Year $academic_year)</h3>";
            echo "<table class='table table-bordered my-4 '>
            <thead >
            <tr >
            <th class='text-center'>Sr No</th>
                
                <th class='text-center'> Name</th>
                <th class='text-center'> Company/Organization/Institute</th>
                <th class='text-center'> Designation</th>
                <th class='text-center'> Experience</th>
                <th class='text-center'>Event Name</th>
                
            </tr>
            </thead>
            <tbody class='bg-primary'>";
               
                // $get_organizations="SELECT distinct event.organization_institute FROM `EVENT` JOIN (SELECT event_id,full_name from `RESOURCE_PERSON` GROUP BY event_id)`resource_person` on event.event_id=resource_person.event_id";
                // $result=mysqli_query($con,$get_organizations);
                // $organizations=array();
                // while($row=mysqli_fetch_assoc($result)){
                //     $organizations[]=$row['organization_institute'];
                // }
                //print_r($organizations);
                
                // foreach($organizations as $organizer){
                    $rp_info="SELECT RESOURCE_PERSON.full_name,RESOURCE_PERSON.company_name,RESOURCE_PERSON.designation,RESOURCE_PERSON.experience,DEPARTMENT.department_name,EVENT.event_name FROM `RESOURCE_PERSON`
                    join `EVENT` on RESOURCE_PERSON.event_id=EVENT.event_id JOIN `DEPARTMENT` on EVENT.dep_id=DEPARTMENT.department_id WHERE RESOURCE_PERSON.full_name<>'NA' AND RESOURCE_PERSON.event_id in (SELECT event_id from `EVENT` WHERE DEPARTMENT.department_name='$organizer' and status_value='Approved' and event_date between '$start_year-06-15' and '$end_year-06-15')";
                    $result1=mysqli_query($con,$rp_info);
                    if($result1===false){
                        die(mysqli_error($con));
                    }
                  $sr=0;
                    while($row=mysqli_fetch_assoc($result1)){
                        $sr++;
                        $event_name=$row['event_name'];
                        $organization_institute=$row['department_name'];
                        $full_name=$row['full_name'];
                        $company_name=$row['company_name'];
                        $designation=$row['designation'];
                        $experience=$row['experience'];
                        echo "<tr class='text-center text-light'>
                        <td>$sr</td>
                        <td>$full_name</td>
                        <td>$company_name</td>
                        <td>$designation</td>
                        <td>$experience</td>
                        <td>$event_name</td>
                        
                        </tr>";
                    }
                }
                else{
                     echo "
            <div class='col-lg-5 col-md-5 mt-5 m-auto'>
            <div class='container d-flex align-items-center justify-content-center '  id='card' style='border-radius:20px;height:50vh'>
            <div class='card mx-auto shadow' style='border-radius:20px'>
            <h2 class='text-center'>$organizer did not invite any resource person for academic-year $academic_year</h2>
            </div>
            </div>
            </div>";
                }
                ?>
            </tbody>
            </table>
            </div>
        </div>
</div>

</body>
</html>