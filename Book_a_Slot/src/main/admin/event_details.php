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
if($user_type=="a"){
    
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Event Detailsa</title>
    <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />

    <style>
        .con1{
        display: grid;
        place-items: center;
    }
    </style>
</head>
<body >
<h1 class="text-center mt-3">List of pending requests</h1>
<div class='text-center  con1'>
    <div class="table-responsive-sm col-lg-10 col-sm-12">
    <table class='table table-bordered  m-auto '>
    <thread>
        <th class='text-center'>Event Id</th>
        <th class='text-center'>Event Name</th>
        <th class='text-center'>Event Organizer</th>
        <!-- <th class='text-center'>Event Venue</th> -->
        <th class='text-center'>Event Request Time</th>
    </thread>
   <tbody class="bg-primary">
    <?php
    $currentDate = date("Y-m-d");
    $previousDate = date("Y-m-d", strtotime("-1 day"));
    $get_event="select * from `EVENT` where status_value='Pending' and request_date_time>='$previousDate' order by request_date_time ";
    $result=mysqli_query($con,$get_event);
    while($row=mysqli_fetch_assoc($result)){
        $event_id=$row['event_id'];
        $event_name=$row['event_name'];
        $event_start_time=$row['event_start_time'];
        $event_end_time=$row['event_end_time'];
        $students_total_number=$row['students_total_number'];
        $ar_name=$row['ar_name'];
        
        $dep_id=$row['dep_id'];
        $get_event_organizer="SELECT department_name,department_acadamics from `DEPARTMENT` where department_id='$dep_id' ";
        $result_for_organizer=mysqli_query($con,$get_event_organizer);
        $event_organizer_row=mysqli_fetch_assoc($result_for_organizer);
        $event_organizer=$event_organizer_row['department_name'];
        $acadamics=$event_organizer_row['department_acadamics'];
        $organization_institute	=$event_organizer;
        $request_date_time=$row['request_date_time'];
        // $event_duration=$event_end_time-$event_start_time; find out how to find time difference
        // echo $event_duration;
        echo "<tr class='text-center text-light'>
        <td>$event_id</td>
        <td>$event_name</td>
        <td>$organization_institute</td>
        <td>$request_date_time</td>
        <td class='bg-light'><a href='event_more_details.php?event_id=$event_id' ><input type='button'class='bg-primary text-light' style='border-radius:20px' value='Details'><a></td></tr>

        ";
    }
    ?>
    </tbody>
    </table>
    </div>
    </div>
</body>
</html>