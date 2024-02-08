<?php
require("../config/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Cancel Slot</title>
    <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />
</head>
<body>

<?php
         require "../connection/connect.php";
         require_once("../loader.html"); 
         if($user_type=="o" || $user_type=="k" || $user_type=="a" || $user_type=="i")
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

<div class="container mt-2" style="height:100vh;">
        <div class="row p-3">

        <?php
date_default_timezone_set("Asia/Calcutta");
$today_date = date("Y-m-d");
$get_events_pending_approved="SELECT * FROM `EVENT` WHERE user_name = '$user_email'  AND status_value in ('Approved','Canceled','Pending') AND event_date > '$today_date'  ORDER BY event_date";
$result_of_events_pending_approved = mysqli_query($con,$get_events_pending_approved);
if(mysqli_num_rows($result_of_events_pending_approved)>0)
{
    while($row_of_query = mysqli_fetch_assoc($result_of_events_pending_approved))
    {
        ?>


            <div class="col-lg-4 col-md-6 mb-5">
                <div class="card shadow p-1" style="width: auto;border-radius: 20px;">
                    <div class="card-body " style="
                    <?php
                    if($row_of_query['status_value']=="Canceled")
                    {
                        echo("opacity: 0.6;pointer-events: none;");
                    }

                ?>
                    ">
                        <h5 class="card-title"><?php echo($row_of_query['event_name']); ?></h5>
                        <div class="badge bg-success p-1 mb-2 
                        <?php
                    if($row_of_query['status_value']=="Approved")
                    {
                        echo("bg-success");
                    }
                    elseif($row_of_query['status_value']=="Pending")
                    {
                        echo("bg-warning");
                    }
                    else{
                        echo("bg-danger");
                    }
                    ?>
                    ">
                    <?php echo($row_of_query['status_value']); ?>
                    </div>
                        <!-- <h6 class="card-subtitle mb-2 text-body-secondary">29 MAY 2023</h6> -->
                        <p class="card-text"> <span class="fw-bold" style="text-align:justify;">Description : </span>  <?php echo($row_of_query['event_description']); ?>  </p>
                        <p class="card-text"> <span class="fw-bold">Date : </span> <?php echo date("d M Y", strtotime($row_of_query['event_date'])); ?></p>
                        <p class="card-text"> <span class="fw-bold">Time : </span> <?php echo date("g:i A", strtotime($row_of_query['event_start_time'])); ?> to <?php echo date("g:i A", strtotime($row_of_query['event_end_time'])); ?> </p>
                        <p class="card-text"> <span class="fw-bold">Venue : </span> <?php echo($row_of_query['ar_name']); ?> </p>
                        <?php
                        if($row_of_query['status_value']=="Canceled")
                        {
                            ?>
                            <p class="card-text bg-danger w-100 btn p-2 text-white"> <span class="fw-bold">Reason: </span> <?php echo($row_of_query['status_reason']); ?> </p>
                            <?php
                        }
                        else{
                            ?>
                            <button type="button" class="btn btn-primary btn-danger w-100 my-1" id="ei<?php echo($row_of_query['event_id']); ?>" >Cancel</button>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
                        if($row_of_query['status_value']=="Canceled")
                        {
                            
                        }
                        else{
                            ?>
                        
            <div class="modal fade" id="response<?php echo($row_of_query['event_id']); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" >
                <div class="modal-dialog modal-dialog modal-dialog-centered w-75 mx-auto">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Reason why you want to cancel the slot?</h1>
                    </div>
                    <div class="modal-body">
                    <textarea class="form-control" id="CancelReason<?php echo($row_of_query['event_id']); ?>" rows="5"></textarea>

                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger px-3" id="yes<?php echo($row_of_query['event_id']); ?>" >Yes</button>
                    </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="confirm<?php echo($row_of_query['event_id']); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" >
                <div class="modal-dialog modal-dialog modal-dialog-centered w-75 mx-auto">
                    <div class="modal-content">
                    <div class="modal-body">
                    <p class="fs-6 text-center">
                        Are you sure you want to cancel the slot?
                    </p>

                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger px-3" id="LastConfirm<?php echo($row_of_query['event_id']); ?>" >Yes</button>
                    </div>
                    </div>
                </div>
            </div>
                    <?php
                        }
                        ?>
<?php
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
?>
        </div>
    </div>
    
    </main>
    <script>
           <?php
date_default_timezone_set("Asia/Calcutta");
$today_date = date("Y-m-d");
$get_events_pending_approved="SELECT * FROM `EVENT` WHERE user_name = '$user_email' AND status_value in ('Approved','Canceled','Pending') AND event_date > '$today_date'  ORDER BY event_date";
$result_of_events_pending_approved = mysqli_query($con,$get_events_pending_approved);
if(mysqli_num_rows($result_of_events_pending_approved)>0)
{
    while($row_of_query = mysqli_fetch_assoc($result_of_events_pending_approved))
    {
        ?>
            $('#ei<?php echo($row_of_query['event_id']); ?>').on('click',function(){
                $('#response<?php echo($row_of_query['event_id']); ?>').modal("show");
            })
            $('#yes<?php echo($row_of_query['event_id']); ?>').on('click',function(){
                $reason = $('#CancelReason<?php echo($row_of_query['event_id']); ?>').val();
                if($reason!==""){
                    $('#response<?php echo($row_of_query['event_id']); ?>').modal("hide");
                    $('#confirm<?php echo($row_of_query['event_id']); ?>').modal("show");
                }
            })
            $('#LastConfirm<?php echo($row_of_query['event_id']); ?>').on('click',function(){
                $reason = $('#CancelReason<?php echo($row_of_query['event_id']); ?>').val();
                $id = <?php echo($row_of_query['event_id']); ?>;
                $.ajax({
                      type: 'POST',
                      url: 'ajax.php',
                      data: { eventid : $id, reason :$reason},
                      success: function(data){
                          if(data==1){
                            window.location.reload();
                          }else{
                            $('#response<?php echo($row_of_query['event_id']); ?>').modal("hide");
                            $('#confirm<?php echo($row_of_query['event_id']); ?>').modal("hide");
                            $('#failed').modal('show');
                          }
                          
                      },
                      error: function() {
                          console.log(response.status);
                      },
                  })
            })
        <?php
    }
}

        ?>
    </script>



</body>
</html>
<?php
            mysqli_close($con);
          ?>