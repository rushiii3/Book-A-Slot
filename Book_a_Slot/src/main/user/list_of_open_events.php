<?php
include '../connection/connect.php';
require("../config/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opened Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/signup.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />
</head>
<body>
<div class="container-fluid">
<div class="row">
    <?php 
    include '../user/navbar.php';
    ?>
<?php
         require "../connection/connect.php";
         require_once("../loader.html"); 
     ?>
     <div class="col-lg-7 m-auto justify-content-center">
        <h3 class="text-center">
            Open Events
        </h3>
     <table  class='table table-bordered my-4 ' style='align-items:center'>
        <thead >
        <tr >
        <th class='text-center'>Sr No.</th>
            <th class='text-center'>Event Id</th>
            <th class='text-center'>Event Name</th>
            <th class='text-center'>Event Date</th>
            <th class='text-center'>Organization Institute</th>
        </tr>
        </thead>
        <tbody class='bg-primary'>
    <?php
     $list_of_open_events="SELECT * from `EVENT` where event_date<CURDATE() and status_value='approved' and event_status='Open' and user_name='$user_email' ";
     $result=mysqli_query($con,$list_of_open_events);
     $count=0;  
     while($row=mysqli_fetch_assoc($result)){
         $count++;
         $event_id=$row['event_id'];
        $event_name=$row['event_name'];
        $event_date=$row['event_date'];
        $event_organizer=$row['organization_institute'];
        echo"<tr class='text-center text-light'>
        <td> $count</td>
        <td> $event_id</td>
        <td> $event_name</td>
        <td> $event_date</td>
        <td> $event_organizer</td>
        <td class='bg-light'><a href='../user/close_event_form.php?event_id=$event_id' ><input type='button'class='bg-primary text-light' style='border-radius:20px' value='Fill Form'><a></td></tr>
        </tr>";
     } 
    ?>
        </tbody>
    </div>
    </div>
</div>
</body>
</html>