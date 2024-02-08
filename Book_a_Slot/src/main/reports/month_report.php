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

if(isset($_POST['month_report'])){
    $month=$_POST['month'];
    $year=$_POST['year'];
    if($year==''){
        echo "<script>alert('Please Enter a year')</script>";
        echo("<script>window.location='../reports/report_home.php';</script>");
    }
    // else{
        
    //     $get_event="Select * from `EVENT` where MONTH(event_date)=$month and YEAR(event_date)=$year and status_value='approved'";
    //     $result=mysqli_query($con,$get_event);
    //     if($result){
    //         while($row=mysqli_fetch_assoc($result)){
    //             $event_name=$row['event_name'];
    //             echo $event_name;
    //         }
    //     }
    //     else{
    //         die(mysqli_error($con));
    //     }
    // }
}
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
<body>
<div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-10 col-lg-10 m-auto">
            <?php
                include '../admin/admin_navbar.html';
                ?>
           <?php
           $get_event="Select * from `EVENT` where MONTH(event_date)='$month' and YEAR(event_date)='$year' and status_value='Approved'";
           $result=mysqli_query($con,$get_event);
           $count=0;
           while($row=mysqli_fetch_assoc($result)){
            $count++;
           }
           ?>
           <?php
           if($count>0){
            echo"
            <table  class='table table-bordered my-4 ' style='align-items:center'>
            <thead >
            <tr >
                <th class='text-center'>Event Name</th>
                <th class='text-center'>Event Date</th>
                <th class='text-center'> Event Description</th>
                <th class='text-center'>Event Start Time</th>
                <th class='text-center'>Event End Time</th>
                <th class='text-center'>Organization Institute</th>
                <th class='text-center'>Number of participants</th>
                <th class='text-center'>Event Place</th>
            </tr>
            </thead>
            <tbody class='bg-primary'>";
            
            $get_event="Select * from `EVENT` where MONTH(event_date)=$month and YEAR(event_date)=$year and status_value='Approved'";
            $result=mysqli_query($con,$get_event);
            
            while($row=mysqli_fetch_assoc($result)){
                $event_name=$row['event_name'];
                $event_date=$row['event_date'];
                $event_description=$row['event_description'];
                $event_start_time=$row['event_start_time'];
                $event_end_time=$row['event_end_time'];
                $dep_id=$row['dep_id'];
                $get_event="SELECT department_name,department_acadamics from `DEPARTMENT` where department_id='$dep_id' ";
                $result_for_event=mysqli_query($con,$get_event);
                if($result_for_event===false){
                    die(mysqli_error($con));
                }
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
        }
            else{
                 echo "
            <div class='col-lg-5 col-md-5 mt-5 m-auto'>
            <div class='container d-flex align-items-center justify-content-center '  id='card' style='border-radius:20px;height:50vh'>
            <div class='card mx-auto shadow' style='border-radius:20px'>
            <h2 class='text-center'>No Event occur in this month of $year</h2>
            </div>
            </div>
            </div>";
               
            }
            ?>
            </tbody>
            
            </table>
            <!-- to download excel file -->
            <?php
            if($count>=1){
            echo"
            <form action='download.php' method='get'>
            <input type='hidden' name='month' value='$month'>
            <input type='hidden' name='year' value='$year'>
            <a href='download.php'><button type='submit' class='btn btn-success' name='month_report'>click here to download excel</button>
            </form>";}
            ?>
            </div>
        </div>    
</div>    
</body>
</html>
