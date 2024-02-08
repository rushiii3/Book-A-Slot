<?php
require("../config/session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Check Status</title>
    <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />
    <style>
    </style>
</head>

<body>
    <?php
    require "../connection/connect.php";
    require_once("../loader.html");
    if($user_type=="o" || $user_type=="k" || $user_type=="a"  || $user_type=="i" )
  {
  }else{
    echo("<script>window.location='../user/sign_in.php';</script>");
  }
    ?>
    <main id="main">
        <?php
        include("navbar.php");
        ?>

<div class="modal fade" id="failed" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-dialog-centered w-75 mx-auto">
    <div class="modal-content">
      <div class="modal-body">
      <img src="https://img.freepik.com/free-vector/removing-goods-from-basket-refusing-purchase-changing-decision-item-deletion-emptying-trash-online-shopping-app-laptop-user-cartoon-character-vector-isolated-concept-metaphor-illustration_335657-2843.jpg?w=1060&t=st=1683869448~exp=1683870048~hmac=351919e98226dbde35a446a66fcd783e63766b69193d06232b36da08b0ca3b2c" class="img-fluid" alt="">
        <p class="fs-6 text-center">Something went wrong! <br> Please try again</p>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Try Again</button>
      </div>
    </div>
  </div>
</div>
        <input type="text" id="e_id">
        <input type="text" id="t_id">
        <input type="date" id="t_date">
        <input type="button" id="sendTransaction">
        <div class="container mt-2">
            <div class="row p-3">
                <?php
                    date_default_timezone_set("Asia/Calcutta");
                    $today_date = date("Y-m-d");
                    $get_events_pending_approved = "SELECT * FROM `EVENT` WHERE user_name = '$user_email' AND status_value in ('Approved','Not Approved','Pending') ORDER BY event_date";
                    
                    $result_of_events_pending_approved = mysqli_query($con, $get_events_pending_approved);
                    
                    if (mysqli_num_rows($result_of_events_pending_approved) > 0) {
                        while ($row_of_query = mysqli_fetch_assoc($result_of_events_pending_approved)) {
                            $event_id = $row_of_query['event_id'];
                            $get_transaction_details = "SELECT * FROM `OUTSIDER_INFO` WHERE event_id = '$event_id'";
                            $result_of_get_transaction_details = mysqli_query($con, $get_transaction_details);

                            if(mysqli_num_rows($result_of_get_transaction_details)>0)
                            {
                                while($row_of_transaction = mysqli_fetch_assoc($result_of_get_transaction_details))
                                {
                                    
                                    if($row_of_transaction['outsider_transaction_id']=="")
                                    {
                                        ?>
                                            <div class="col-lg-4 col-md-6 mb-5">
                                                <div class="card shadow p-1" style="width: auto;border-radius: 20px;">
                                                    <div class="card-body" style="<?php if ($row_of_query['status_value'] == "Not Approved") { echo ("opacity: 0.6;");}?>">
                                                        <h5 class="card-title"><?php echo ($row_of_query['event_name']); ?></h5>
                                                            <div class="badge p-1 mb-2 <?php if ($row_of_query['status_value'] == "Approved") { echo ("bg-success"); } elseif ($row_of_query['status_value'] == "Pending") { echo ("bg-warning"); } else { echo ("bg-secondary"); } ?>">
                                                                <?php echo ($row_of_query['status_value']); ?>
                                                            </div>
                                                                <p class="card-text" style="text-align:justify;"> <span class="fw-bold">Description : </span> <?php echo ($row_of_query['event_description']); ?> </p>
                                                                <p class="card-text"> <span class="fw-bold">Date : </span> <?php echo date("d M Y", strtotime($row_of_query['event_date'])); ?></p>
                                                                <p class="card-text"> <span class="fw-bold">Time : </span> <?php echo date("g:i A", strtotime($row_of_query['event_start_time'])); ?> to <?php echo date("g:i A", strtotime($row_of_query['event_end_time'])); ?> </p>
                                                                <p class="card-text"> <span class="fw-bold">Venue : </span> <?php echo ($row_of_query['ar_name']); ?> </p>
                                                                <?php
                                                                    if ($row_of_query['status_value'] == "Not Approved") 
                                                                    {
                                                                        ?>
                                                                            <p class="card-text bg-secondary text-white w-100 rounded p-2"> <span class="fw-bold">Reason: </span> <?php echo ($row_of_query['status_reason']); ?> </p>
                                                                        <?php
                                                                    }elseif($row_of_query['status_value'] == "Approved") 
                                                                    {
                                                                        ?>
                                                                            <div class="col-12 mb-3">
                                                                                <label for="transaction_id<?php echo($row_of_query['event_id']); ?>" class="form-label">Transaction ID</label>
                                                                                <input type="text" name="transaction_id" class="form-control" id="transaction_id<?php echo($row_of_query['event_id']); ?>" placeholder="e.g. ....... ">
                                                                            </div>
                                                                            <div class="col-12 mb-3">
                                                                                <label for="transaction_date<?php echo($row_of_query['event_id']); ?>" class="form-label">Transaction Date</label>
                                                                                <input type="date" name="transaction_date<?php echo($row_of_query['event_id']); ?>" class="form-control" id="transaction_date<?php echo($row_of_query['event_id']); ?>" placeholder="e.g. ....... ">
                                                                            </div>
                                                                            <button type="button" class="btn btn-primary  w-100 my-1" id="ei<?php echo($row_of_query['event_id']); ?>" >ADD</button>
                                                                            <script>
                                                                                $('#ei<?php echo($row_of_query['event_id']); ?>').on('click',function()
                                                                                {
                                                                                    $transaction_id = $('#transaction_id<?php echo($row_of_query['event_id']); ?>').val();
                                                                                    $transaction_date = $('#transaction_date<?php echo($row_of_query['event_id']); ?>').val();
                                                                                    $('#t_id').val($transaction_id);
                                                                                    $('#t_date').val($transaction_date);
                                                                                    $('#e_id').val(<?php echo($row_of_query['event_id']); ?>);
                                                                                    $('#sendTransaction').click();
                                                                                })
                                                                                
                                                                            </script>
                                                                        <?php
                                                                    }else
                                                                    {   
                                                                        ?>
                                                                            <a href="cancel.php">Want to cancel the event?</a>
                                                                        <?php
                                                                    }
                                                                ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                }
                            }else{
                                ?>
                                    <div class="col-lg-12 col-md-12 mb-5">
                                        <p class="fs-2 text-center" style="margin-top:11rem;">
                                            You have not booked any events<br>
                                            <a type="button" class="btn btn-primary px-5 mt-3" href="booking.php">Book Now</a>
                                        </p>
                                    </div>
                                <?php
                            }
                        }
                    }
                ?>
            </div>
        </div>
        
    </main>
    <script src="../../js/outsider.js"></script>
</body>

</html>
<?php
mysqli_close($con);
?>