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
    <title>Event Details</title>
    <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js" integrity="sha512-5SUkiwmm+0AiJEaCiS5nu/ZKPodeuInbQ7CiSrSnUHe11dJpQ8o4J1DU/rw4gxk/O+WBpGYAZbb8e17CDEoESw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<style>
  .con1{
        display: grid;
        place-items: center;
    }
</style>
<body>

  <!-- to fetch data -->
    <?php
    if(isset($_GET['event_id'])){
        $event_id=$_GET['event_id'];
        $get_event="select * from `EVENT` where event_id=$event_id ";
        $result=mysqli_query($con,$get_event);
        $row=mysqli_fetch_assoc($result);
        $email=$row['user_name'];
         $alumni=$row['alumni'];
        $event_date=$row['event_date'];
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
        $request_date_time=$row['request_date_time'];
        $event_description=$row['event_description'];
        $get_user_name="select * from `USER` where user_name='$email'";
        $result1=mysqli_query($con,$get_user_name);
        $row=mysqli_fetch_assoc($result1);
        $name=$row['user_full_name'];

    }
    ?>
    <!-- to approve event  -->
    <?php
if(isset($_POST['approve_event_id'])){
    $event_id=$_POST['event_id'];
    $update_event_status="update `EVENT` set status_value='Approved',event_status='Open' where event_id=$event_id";
    $result=mysqli_query($con,$update_event_status);
    $info_to_send_mail="select * from `EVENT` where event_id=$event_id ";
        $result=mysqli_query($con,$info_to_send_mail);
        $row=mysqli_fetch_assoc($result);
        $email=$row['user_name'];
        $alumni=$row['alumni'];
        $status_value=$row['status_value'];
        $event_name = $row['event_name'];
        $event_date=$row['event_date'];
        $event_description = $row['event_description'];
        $event_start_time = $row['event_start_time'];
        $query_for_name="select * from `USER` where user_name='$email' ";
        $result1=mysqli_query($con,$query_for_name);
        $row=mysqli_fetch_assoc($result1);
        $name=$row['user_full_name'];
    

// API endpoint URL
$apiUrl = 'https://alumniandroidapp.000webhostapp.com/EventInsertApi3.php?apikey=12345';

// Data to be sent in the request body
$data = array(
    'event_name' => $event_name,
    'event_description' => $event_description,
    'event_date' => $event_date,
    'event_time' => $event_start_time,
    'event_image' => 'event_image',
    'event_registration_link' => '#'
);

// Convert data to JSON
$jsonData = json_encode($data);

// Initialize curl
$curl = curl_init();

// Set curl options
curl_setopt_array($curl, array(
    CURLOPT_URL => $apiUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
    ),
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $jsonData,
));

// Execute curl request
$response = curl_exec($curl);

// Check for errors
if ($response === false) {
    echo 'Error: ' . curl_error($curl);
} else {
    // Display the response
    echo $response;
}

// Close curl
curl_close($curl);

//     if($result){
//        //echo "<script>sendEmail()</script>";
//        //header("location:./admin_home.php");
// header("location:./email_of_approved_event.php?event_id=$event_id");
//     }
//     else{
//         die(mysqli_error($con));
//     }
}
?>


  
<!-- event not approved -->
<?php
include '../connection/connect.php';
if(isset($_POST["not_approved_event_id"])){
  $status_reason=$_POST['status_reason'];
  // if( isset($_GET['event_not_approved_id'])){
  $event_id=$_POST['event_id'];
  $update_event_reason="update `EVENT` set status_reason='$status_reason',status_value='Not Approved',event_status='Null' where event_id=$event_id ";

  $result=mysqli_query($con,$update_event_reason);
      if($result){
        //echo "<a href='./email_of_event.php?event_id=$event_id'></a>";
         header("location:./email_of_not_approved_events.php?event_id=$event_id");
      }
      else{
          die(mysqli_error($con));
      }
}

?>

<div class='container-fluid mt-5'>
  <div class="row">
    <div class="col-md-10 col-lg-10 m-auto">
    <?php
                include '../admin/admin_navbar.html';
                ?>
    <div class="row">
        <div class="col-md-6 col-lg-7">
          <div class="con1 my-5">
            <table class='table table-bordered ' >
              <thread class="bg-info">
                <tr>
                  <th class="text-center">Title</th>
                  <th class="text-center">Description</th>
                </tr>
              </thread>
              <tbody class="bg-primary text-light text-center">
                <tr>
                  <td>Event id </td>
                  <td><?php echo $event_id?></td>
                </tr>
                <tr>
                  <td>Event Name</td>
                  <td><?php echo $event_name?></td>
                </tr>
                <tr>
                  <td>Event Description</td>
                  <td><?php echo $event_description?></td>
                </tr>
                <tr>
                  <td>Event Date</td>
                  <td><?php echo $event_date?></td>
                </tr>
                <tr>
                  <td>Event Start Time</td>
                  <td><?php echo $event_start_time?></td>
                </tr>
                <tr>
                  <td>Event End Time</td>
                  <td><?php echo $event_end_time?></td>
                </tr>
                <tr>
                  <td>Number Of Students Paricipating Event</td>
                  <td class="mt-2"><?php echo $students_total_number?></td>
                </tr>
                <tr>
                  <td>Event Place</td>
                  <td class="mt-2"><?php echo $ar_name?></td>
                </tr>
                <tr>
                  <td>Event Organizer</td>
                  <td class="mt-2"><?php echo $event_organizer?></td>
                </tr>
              </tbody>
            </table>
            </div>
            <form name="approvalForm" action='event_more_details.php' method='POST' >
                <div class='form-outline w-50 m-auto my-2'>
                    <input type='hidden' id='event_id' name='event_id' readonly class='form-control bg-primary text-light ' value='<?php echo $event_id?>'>
                </div>
                <div class='form-outline w-50 m-auto my-2'>
                    <input type='hidden' id='email' name='email' readonly class='form-control bg-primary text-light ' value='<?php echo $email?>'>
                </div>
                <div class='form-outline w-50 m-auto my-2'>
                    <input type='hidden' id='name' name='name' readonly class='form-control bg-primary text-light ' value='<?php echo $name?>'>
                </div>
                <div class='form-outline w-50 m-auto my-2'>
                    <input type='hidden' id='event_name'event_ name='event_name' readonly class='form-control bg-primary text-light ' value='<?php echo $event_name?>'>
                </div>
                <div class='form-outline w-50 m-auto my-2'>
                    <input type='hidden' id='event_date' name='event_date' readonly class='form-control bg-primary text-light ' value='<?php echo $event_date?>'>
                </div>
                <div class='form-outline w-50 m-auto my-2'>
                    <input type='hidden' id='alumni' name='alumni' readonly class='form-control bg-primary text-light ' value='<?php echo  $alumni?>'>
                </div>
                <div class='form-outline w-50 m-auto my-2'>
                    <input type='hidden' id='event_description' name='event_description' readonly class='form-control bg-primary text-light ' value='<?php echo $event_description?>'>
                </div>
                <div class='form-outline w-50 m-auto my-2'>
                    <input type='hidden' id='event_start_time' name='event_start_time' readonly class='form-control bg-primary text-light ' value='<?php echo $event_start_time?>'>
                </div>
                <div class='text-center mt-3'>
                    <input type='button' id='approve_event_id' name='approve_event_id' value='Approve' 
                    class='btn btn-success px-3 mb-3' >
                    <!-- onclick="sendEmail()" -->
                    <a  style='text-decoration:none'  type='button' class='text-light' data-toggle='modal' data-target='#exampleModalCenter'> 
                    <input type='button'  value='Not Approve' class='btn btn-danger px-3 mb-3'></a>
                </div>
            </form>
        </div>
        <div class="col-md-4 col-lg-5">
            <img src="https://tse2.mm.bing.net/th?id=OIP.Gde1iAYuuGbikzWG-R6OzgHaE7&pid=Api&P=0"
             alt="image" style="height:100%;width:90%">
        </div>
    </div> 
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <form method='POST' action='event_more_details.php'>
      <div class="modal-body">
      <input type='hidden' name='event_id' readonly class='form-control bg-primary text-light ' value='<?php echo $event_id?>'>
      <label for="ar_name " class="form-label fw-bold">Reason For Not Approving Event Request</label>
      <textarea name='status_reason' id='status_reason'  rows="4" cols="60" required></textarea>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" >CLOSE</button>
        <button type="button" class="btn btn-primary" name="not_approve_event_id" id="not_approve_event_id">
        OK</button>
       
      </div>
      
      </div>
    </div>
    </form>
  </div>
</div> 
<div id="emailTemp" style="display: none;">


</div>
</body>
<script src="../../js/adminEmail.js"></script>
<script src="../../js/adminNotApprove.js"></script>
</html>