<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv='cache-control' content='no-cache'>
  <meta http-equiv='expires' content='0'>
  <meta http-equiv='pragma' content='no-cache'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="../../js/smtp.js"></script>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Document</title>
    <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />
</head>
<body>
<?php
require "../connection/connect.php";
    require("../config/session.php");
    require_once("../loader.html");
    if($user_type=="p")
  {
  }else{
    echo("<script>window.location='../user/sign_in.php';</script>");
  }
  ?>
  
  <main id="main">
    <?php
      include("navigation.html");
    ?>
    <div class="modal fade" id="response" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" >
                <div class="modal-dialog modal-dialog modal-dialog-centered w-75 mx-auto">
                    <div class="modal-content">
                    <div class="modal-header">
                        <span id="event_id" style="display:none;"></span>
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Reason why you want to reject the <span id="canceleventname" class="fw-bold"></span></h1>
                    </div>
                    <div class="modal-body">
                    <textarea class="form-control" id="CancelReason" rows="5"></textarea>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger px-3" id="yes" >Yes</button>
                    </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="rejectconfirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" >
                <div class="modal-dialog modal-dialog modal-dialog-centered w-75 mx-auto">
                    <div class="modal-content">
                    <div class="modal-body">
                    <p class="fs-6 text-center">
                        Are you sure you want to reject <span id="canceleventname" class="fw-bold"></span>
                    </p>

                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger px-3" id="LastConfirm" >Yes</button>
                    </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="acceptconfirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" >
                <div class="modal-dialog modal-dialog modal-dialog-centered w-75 mx-auto">
                    <div class="modal-content">
                    <div class="modal-body">
                    <p class="fs-6 text-center">
                        Are you sure you want to accept <span id="accepteventname" class="fw-bold"></span>
                    </p>
                    <span id="confirm_event_id" style="display:none;"></span>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary px-3" id="Acceptconfirm" >Yes</button>
                    </div>
                    </div>
                </div>
            </div>
     <div class="container mt-2">
            <div class="row p-3">
                <?php
                $get_events = "SELECT * FROM `EVENT` WHERE dep_id = '83' AND status_value = 'Pending' ORDER BY event_date";
                $result_of_events = mysqli_query($con, $get_events);
                if (mysqli_num_rows($result_of_events) > 0) {
                    while ($row_of_query = mysqli_fetch_assoc($result_of_events)) {
                        $event_id = $row_of_query['event_id'];
                        $query_to_get_outsider_info = "SELECT * FROM `OUTSIDER_INFO` WHERE `event_id` = '$event_id'";
                        $result_of_outsider_info = mysqli_query($con,$query_to_get_outsider_info);

                ?>
                        <div class="col-lg-4 col-md-6 mb-5">
                            <div class="card shadow p-1" style="width: auto;border-radius: 20px;" >
                                <div class="card-body">
                                <div id="card<?php echo ($row_of_query['event_id']); ?>">
                                    <h4 class="card-title" id="event_name<?php echo ($row_of_query['event_id']); ?>"><?php echo ($row_of_query['event_name']); ?></h4>
                                    <p class="card-text" style="text-align:justify;"> <span class="fw-bold">Description : </span> <?php echo ($row_of_query['event_description']); ?> </p>
                                    <p class="card-text"> <span class="fw-bold">Date : </span> <?php echo date("d F Y", strtotime($row_of_query['event_date'])); ?></p>
                                    <p class="card-text"> <span class="fw-bold">Time : </span> <?php echo date("g:i A", strtotime($row_of_query['event_start_time'])); ?> to <?php echo date("g:i A", strtotime($row_of_query['event_end_time'])); ?> </p>
                                    <p class="card-text"> <span class="fw-bold">Venue : </span> <?php echo ($row_of_query['ar_name']); ?> </p>
                                    <p class="card-text"> <span class="fw-bold">No of Attendees : </span> <?php echo ($row_of_query['students_total_number']); ?> </p>
                                </div>
                                <div id="show<?php echo ($row_of_query['event_id']); ?>" class="mt-3">
                                <?php
                                if(mysqli_num_rows($result_of_outsider_info)>0)
                                {
                                    while($row_of_outsider=mysqli_fetch_assoc($result_of_outsider_info))
                                    {
                                ?>
                                    <p class="card-text"> <span class="fw-bold">Phone Number : </span> <?php echo ($row_of_outsider['outsider_phone']); ?> </p>
                                    <p class="card-text"> <span class="fw-bold">Name : </span> <?php echo ($row_of_outsider['outsider_name']); ?> </p>
                                    <p class="card-text"> <span class="fw-bold">Email : </span>  <?php echo ($row_of_outsider['outsider_email']); ?> </p>
                                <?php
                    }
                }
                                ?>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-6 mt-2">
                                            <button type="button" class="btn  btn-danger w-100" id="reject<?php echo ($row_of_query['event_id']); ?>" >Reject</button>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                            <button type="button" class="btn btn-primary  w-100" id="accept<?php echo ($row_of_query['event_id']); ?>" >Accept</button>
                                                </div>
                                        </div>
                                    </div>
                                </div>   
                                </div>
                            </div>
                        </div>
                <?php
                }} else {
                ?>
                    <div class="col-lg-12 col-md-12 mb-5">
                        <p class="fs-2 text-center" style="margin-top:11rem;">
                            There are no booked events<br>
                        </p>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div id="emailTemp" style="display:none;">
                
        </div>
    </main>
</body>
<script src="../../js/request.js"></script>
</html>
<script>
    <?php
    $get_events = "SELECT * FROM `EVENT` WHERE dep_id = '83' AND status_value = 'Pending' ORDER BY event_date";
                $result_of_events = mysqli_query($con, $get_events);
                if (mysqli_num_rows($result_of_events) > 0) {
                    while ($row_of_query = mysqli_fetch_assoc($result_of_events)) {
                        ?>
                            $('#show<?php echo ($row_of_query['event_id']); ?>').hide();
                            $('#card<?php echo ($row_of_query['event_id']); ?>').on('click',function()
                            {
                                $('#show<?php echo ($row_of_query['event_id']); ?>').toggle(1000);

                            })
                            $('#reject<?php echo ($row_of_query['event_id']); ?>').on('click',function()
                            {
                                $event_name = $('#event_name<?php echo ($row_of_query['event_id']); ?>').text();
                                $('#event_id').text('<?php echo ($row_of_query['event_id']); ?>');
                                $('#canceleventname').text($event_name);
                                $('#response').modal("show");
                            })
                            $('#yes').on('click',function()
                            {
                                $reason = $('#CancelReason').val();
                                if($reason!=="")
                                {
                                    $('#response').modal("hide");
                                    $('#rejectconfirm').modal("show");
                                }else{
                                    alert("Please input the reason");
                                }
                                
                            })

                            $('#accept<?php echo ($row_of_query['event_id']); ?>').on('click',function()
                            {
                                $event_name = $('#event_name<?php echo ($row_of_query['event_id']); ?>').text();
                                console.log($event_name);
                                $('#confirm_event_id').text('<?php echo ($row_of_query['event_id']); ?>');
                                $('#accepteventname').text($event_name);
                                $('#acceptconfirm').modal("show");
                            })
                            <?php
                        }}?>    
                        </script>
                        
