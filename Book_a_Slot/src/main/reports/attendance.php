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
    header('location:../admin/report_home.php');
}
if(isset($_POST['outsider_report'])){
    $academic_year=$_POST['year'];
    $years = explode("-", $academic_year);
    $start_year=intval($years[0]);
    $end_year=intval($years[1]);
    if($end_year<$start_year){
        echo "<script>alert('Please Enter a academic year appropriately')</script>";
        echo("<script>window.location='../reports/report_home.php';</script>");
    }
    if($academic_year==''){
        echo "<script>alert('Please Enter a academic year')</script>";
        echo("<script>window.location='../admin/report_home.php';</script>");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<, initial-scale=1.0">
    <title>Department Attendance</title>
    <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />

    <link rel='stylesheet' type='text/css' href='../css/images.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js" integrity="sha512-5SUkiwmm+0AiJEaCiS5nu/ZKPodeuInbQ7CiSrSnUHe11dJpQ8o4J1DU/rw4gxk/O+WBpGYAZbb8e17CDEoESw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<style>
    img{
        height: 250px;
        width: 250px;
        margin:10px;
    }
</style>
</head>
<body>
<div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-10 col-lg-10 m-auto">
            <?php
                include '../admin/admin_navbar.html';
                ?>
            <?php
            $percentage_according_to_gender="SELECT DEPARTMENT.department_name,DEPARTMENT.department_acadamics, (SUM(male_students_count) * 100.0 / (SUM(male_students_count) + SUM(female_students_count) + SUM(other_students_count))) AS male_attendance_percentage, (SUM(female_students_count) * 100.0 / (SUM(male_students_count) + SUM(female_students_count) + SUM(other_students_count))) AS female_attendance_percentage FROM `CLOSE_EVENT` join `EVENT` on CLOSE_EVENT.event_id=EVENT.event_id join `DEPARTMENT` on EVENT.dep_id=DEPARTMENT.department_id where EVENT.event_date between '$start_year-06-15' and '$end_year-06-14' and DEPARTMENT.department_name<>'Others' GROUP BY DEPARTMENT.department_name";
            $result=mysqli_query($con,$percentage_according_to_gender);
            if($result===false){
                die(mysqli_error($con));
            }
            $count=0;
            while($row=mysqli_fetch_assoc($result)){
                $count++;}
            if($count>0){
           echo " <h2 class='text-center'>Department Wise Attendance for Academic Year:$academic_year</h2>
            <div class='col-lg-6 col-md-6 m-auto'>
            <table  class='table table-bordered my-4 ' style='align-items:center'>
        <thead >
        <tr >
        <th class='text-center'>Sr No.</th>
            <th class='text-center'>Department/Commitee</th>
            <th class='text-center'>Male Percentage</th>
            <th class='text-center'>Female Percentage</th>
            <th class='text-center'>Other Percentage</th>
        </tr>
        </thead>
        <tbody class='bg-primary'>";
    $percentage_according_to_gender="SELECT DEPARTMENT.department_name,DEPARTMENT.department_acadamics, (SUM(male_students_count) * 100.0 / (SUM(male_students_count) + SUM(female_students_count)+  SUM(other_students_count))) AS male_attendance_percentage, (SUM(female_students_count) * 100.0 / (SUM(male_students_count) + SUM(female_students_count)+  SUM(other_students_count))) AS female_attendance_percentage,(SUM(other_students_count) * 100.0 / (SUM(male_students_count) + SUM(female_students_count)+  SUM(other_students_count))) AS other_attendance_percentage FROM `CLOSE_EVENT` join `EVENT` on CLOSE_EVENT.event_id=EVENT.event_id join `DEPARTMENT` on EVENT.dep_id=DEPARTMENT.department_id where EVENT.event_date between '$start_year-06-15' and '$end_year-06-14' and DEPARTMENT.department_name<>'Others' GROUP BY DEPARTMENT.department_name";
    $result=mysqli_query($con,$percentage_according_to_gender);
    $sr=0;
    while($row=mysqli_fetch_assoc($result)){
        $sr++;
        $organizer=$row['department_name'];
        $acadamic=$row['department_acadamics'];
        $male_percentage=$row['male_attendance_percentage'];
        $female_percentage=$row['female_attendance_percentage'];
        $other_percentage=$row['other_attendance_percentage'];
        echo"<tr class='text-center text-light'>
        <td> $sr</td>
        <td> $organizer</td>
        <td> $male_percentage%</td>
        <td> $female_percentage%</td>
        <td>$other_percentage%</td>
        </tr>";
    }
    echo "</tbody>
    </table>";
    
}
else{

}
    ?>
        
    
   
    </div>
            
        </div>
        </div>
    </div>
</div>
</body>
</html>