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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Month wise Report</title>
    <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js" integrity="sha512-5SUkiwmm+0AiJEaCiS5nu/ZKPodeuInbQ7CiSrSnUHe11dJpQ8o4J1DU/rw4gxk/O+WBpGYAZbb8e17CDEoESw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<?php
            header('Content-Type:appication/xls');
            header('Content-Disposition:attachment;filename=month_report.xls');
            ?>
<body>
<div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-10 col-lg-10 m-auto">
            <table  class='table table-bordered my-4 ' style="align-items:center">
            <thead >
            <tr >
                <th class="text-center">Event Name</th>
                <th class="text-center">Event Date</th>
                <th class="text-center"> Event Description</th>
                <th class="text-center">Event Start Time</th>
                <th class="text-center">Event End Time</th>
                <th class="text-center">Organization Institute</th>
                <th class="text-center">Number of participants</th>
                <th class="text-center">Event Place</th>
            </tr>
            </thead>
            <tbody class="bg-primary">
            <?php
            if(isset($_GET['month_report'])){
                $month=$_GET['month'];
                $year=$_GET['year'];
            }
            $get_event="select * from `EVENT` where MONTH(event_date)='$month' and YEAR(event_date)='$year' and status_value='Approved' ";
            $result=mysqli_query($con,$get_event);
            if($result===false){
                die(mysqli_error($con));
            }
            while($row=mysqli_fetch_assoc($result)){
                $event_name=$row['event_name'];
                $event_date=$row['event_date'];
                $event_description=$row['event_description'];
                $event_start_time=$row['event_start_time'];
                $event_end_time=$row['event_end_time'];
                $dep_id=$row['dep_id'];
                $get_event="SELECT department_name,department_acadamics from `DEPARTMENT` where department_id='$dep_id' ";
                $result_for_event=mysqli_query($con,$get_event);
                $event_month_row=mysqli_fetch_assoc($result_for_event);
                $event_organizer=$event_month_row['department_name'];
                $acadamics=$event_month_row['department_acadamics'];
                //$organization_institute=$row['organization_institute'];
                $students_total_number=$row['students_total_number'];
                $ar_name=$row['ar_name'];
                echo"<tr class='text-center text-light'><td> $event_name</td>
                <td> $event_date</td>
                <td> $event_description</td>
                <td> $event_start_time</td>
                <td> $event_end_time</td>
                <td>$event_organizer of $acadamics</td>
                <td>$students_total_number</td>
                <td>$ar_name</td>
                </tr>
                ";
            }
       
            
            ?>
            </tbody>
            
            </table>
            </div>
        </div>    
</div>    
</body>
</html>
