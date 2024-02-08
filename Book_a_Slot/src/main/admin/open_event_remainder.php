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
<?php

// if(isset($_POST['remainder'])){
//     $event_id=$_POST['event_id'];
//         $info_to_send_mail="select * from `EVENT` where event_id=$event_id ";
//         $result=mysqli_query($con,$info_to_send_mail);
//         $row=mysqli_fetch_assoc($result);
//         $email=$row['user_name'];
//         $status_value=$row['status_value'];
//         $status_reason=$row['status_reason'];
//         $event_name=$row['event_name'];
//         $event_date=$row['event_date'];
//         $query_for_name="select * from `USER` where user_name='$email' ";
//         $result1=mysqli_query($con,$query_for_name);
//         $row=mysqli_fetch_assoc($result1);
//         $name=$row['user_full_name'];
//         if($result){
//             echo "<script>window.location.href = 'remainder_email.php?event_id=$event_id'</script>";
//             //header("location:./remainder_email.php?event_id=$event_id");
//        }
//       //  echo $event_id;
//     //     if(isset($result) and isset($result1)){
//     //         echo "<script>";
//     // echo "sendEmail();"; // Call your desired JavaScript function with the division ID
//     // echo "</script>";
//     //     header("location:./admin_home.php?open_event");
//     //     }
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>open events</title>
    <script src="https://smtpjs.com/v3/smtp.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js" integrity="sha512-5SUkiwmm+0AiJEaCiS5nu/ZKPodeuInbQ7CiSrSnUHe11dJpQ8o4J1DU/rw4gxk/O+WBpGYAZbb8e17CDEoESw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>


<div class="container-fluid">
        <div class="row">
        <div class="col-md-10 col-lg-10 m-auto">
<?php

    $list_of_open_events="SELECT * from `EVENT` where event_date<CURDATE() and status_value='Approved' and event_status='Open' ";
    $result=mysqli_query($con,$list_of_open_events);
    $count=0;  
    while($row=mysqli_fetch_assoc($result)){
        $count++;} 
    if($count<1){
        echo "<h1 class='text-center p-4 mt-4 mb-4'>All Departments filled the event information </h1>";
    }
    else{
        echo "<h3 class='text-center mt-3 mb-3'>List of events whose informationn is not filled even the events occured successfully</h3>";
        echo "<table  class='table table-bordered my-4 ' style='align-items:center'>
        <thead >
        <tr >
        <th class='text-center'>Sr No.</th>
            <th class='text-center'>Event Id</th>
            <th class='text-center'>Event Name</th>
            <th class='text-center'>Event Date</th>
            <th class='text-center'>Organization Institute</th>
        </tr>
        </thead>
        <tbody class='bg-primary'>";
            //event_date plus 8 days for remainder
           // $list_of_open_events="SELECT * from `EVENT` where DATE_ADD(event_date, INTERVAL 8 DAY)<=CURDATE() and status_value='Approved' and event_status='Open' and organization_institute<>'Others'";
            $list_of_open_events="SELECT * from `EVENT` where DATE_ADD(event_date, INTERVAL 0 DAY)<=CURDATE() and status_value='Approved' and event_status='Open' and dep_id<>(SELECT dep_id FROM `DEP` WHERE dep_name='Others')";

            $result=mysqli_query($con,$list_of_open_events);
            $count=0;   
            while($row=mysqli_fetch_assoc($result)){
                $count++;
                $event_id=$row['event_id'];
                $event_name=$row['event_name'];
                $event_date=$row['event_date'];
                $dep_id=$row['dep_id'];
                $get_event_organizer="SELECT department_name,department_acadamics from `DEPARTMENT` where department_id='$dep_id' ";
                $result_for_organizer=mysqli_query($con,$get_event_organizer);
                $event_organizer_row=mysqli_fetch_assoc($result_for_organizer);
                $event_organizer=$event_organizer_row['department_name'];
                $acadamics=$event_organizer_row['department_acadamics'];
                $email=$row['user_name'];
                $get_user_name="SELECT * from `USER` where user_name='$email'";
                $result1=mysqli_query($con,$get_user_name);
                $row=mysqli_fetch_assoc($result1);
                $name=$row['user_full_name'];
                echo"<tr class='text-center text-light'>
                <td> $count</td>
                <td> $event_id</td>
                <td> $event_name</td>
                <td> $event_date</td>
                <td> $event_organizer of $acadamics</td>
                <form method='post'>
                <input type='hidden' id='event_id$event_id' name='event_id' readonly class='form-control bg-primary text-light ' value='$event_id'>
                <input type='hidden' id='event_name$event_id' name='event_name' readonly class='form-control bg-primary text-light ' value='$event_name'>
                <input type='hidden' id='event_date$event_id' name='event_date' readonly class='form-control bg-primary text-light ' value='$event_date'>
                <input type='hidden' id='email$event_id' name='email' readonly class='form-control bg-primary text-light ' value='$email'>
                <input type='hidden' id='name$event_id' name='name' readonly class='form-control bg-primary text-light ' value='$name'>
                <td class='bg-light'><input type='button' class='bg-primary text-light' id='$event_id' name='reminder_to_close_event' value='Send Reminder' ></td></form>
                </tr>";
                ?>
                <script >
    $('#<?php echo $event_id;?>').on('click',function(){
    
    $event_id = $('#event_id<?php echo $event_id;?>').val();
    $email=$('#email<?php echo $event_id;?>').val();
    $name=$('#name<?php echo $event_id;?>').val();
    $event_name=$('#event_name<?php echo $event_id;?>').val();
    $event_date=$('#event_date<?php echo $event_id;?>').val();
    console.log($event_id);
    console.log($email);
    console.log($name);
    console.log($event_date);
    console.log($event_name);
   
    $.ajax({
        type: 'POST',
        url: 'reminderAjax.php',
        data: {event_id:$event_id,
            email:$email,
            name:$name,
            event_name:$event_name,
            event_date:$event_date,
           },
        success: function(data) {
            $('#emailTemp').html(data);
            console.log(data);
            
        },
        error: function() {
            console.log(response.status);
        },
    })  
})

</script>
<?php
            }
        }

?> 
         </div>
    </div>
    <div id="emailTemp" style="display: none;">
</div>


</body>
</html>