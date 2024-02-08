<?php
require("../config/session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
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
    <title>Event Details</title>
    <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />
</head>

<body>
<?php
        include("navigation.html");
        ?>
<?php
include "../connection/connect.php";
if(isset($_POST['all_events'])){
    $month=$_POST['month'];
    $year=$_POST['year'];
    if($year==''){
        echo "<script>alert('Please Enter a year')</script>";
        echo("<script>window.location='../reports/report_home.php';</script>");
    }
    //echo $organization_institute," ",$event_date;
    $close_event_info="SELECT EVENT.event_name,EVENT.event_date,EVENT.event_start_time,EVENT.event_end_time,
    EVENT.ar_name,EVENT.event_description,EVENT.organization_institute,
    CLOSE_EVENT.close_event_activities,CLOSE_EVENT.male_students_count,CLOSE_EVENT.female_students_count,CLOSE_EVENT.faculty_members_count,
    CLOSE_EVENT.close_event_mode,CLOSE_EVENT.close_event_link,CLOSE_EVENT.close_event_purpose,CLOSE_EVENT.close_event_impact,CLOSE_EVENT.event_pic1,
    CLOSE_EVENT.event_pic2 from `EVENT` join `CLOSE_EVENT` on EVENT.event_id=CLOSE_EVENT.event_id  where MONTH(event_date)='$month' and YEAR(event_date)='$year' and EVENT.status_value='Approved' and EVENT.event_status='Closed' and EVENT.organization_institute<>'Others";
    $result=mysqli_query($con,$close_event_info);
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            ?>
             <div class="col-lg-8 col-md-8 mb-5 m-auto">
                            <div class="card shadow p-1" style="width: auto;border-radius: 20px;">
                                <div class="card-body" >
                                    <h4 class="card-title">Event Name:<?php echo ($row['event_name']); ?></h4>
                                    <div class="badge p-1 mb-2">
                                      
                                    </div>
                                    <p class="card-text " style="text-align:justify;"> <span class="fw-bold">Department: </span> <?php echo ($row['organization_institute']); ?> </p>
                                    <p class="card-text " style="text-align:justify;"> <span class="fw-bold">Description : </span> <?php echo ($row['event_description']); ?> </p>
                                    <p class="card-text "> <span class="fw-bold">Date : </span> <?php echo date("d M Y", strtotime($row['event_date'])); ?></p>
                                    <p class="card-text "> <span class="fw-bold">Time : </span> <?php echo date("g:i A", strtotime($row['event_start_time'])); ?> to <?php echo date("g:i A", strtotime($row['event_end_time'])); ?> </p>
                                    <p class="card-text "> <span class="fw-bold">Venue : </span> <?php echo ($row['ar_name']); ?> </p>
                                    <p class="card-text "> <span class="fw-bold">Activities: </span> <?php echo ($row['close_event_activities']); ?> </p>
                                    <p class="card-text "> <span class="fw-bold">Purpose: </span> <?php echo ($row['close_event_purpose']); ?> </p>
                                    <p class="card-text " style="text-align:justify;"> <span class="fw-bold">Event Mode: </span> <?php echo ($row['close_event_mode']); ?> </p>
                                   
                                    <?php
                                    if($row['close_event_mode']=='online'){
                                    $online_link=$row['close_event_link'];
                                    echo "<p class='card-text ' style='text-align:justify;'> <span class='fw-bold'>Event Mode: </span> ($online_link) </p>";

                                    }
                                    ?>

                                    <p class="card-text "> <span class="fw-bold">Boys Attendance: </span> <strong><?php echo ($row['male_students_count']); ?> </strong></p>
                                    <p class="card-text "> <span class="fw-bold">Girls Attendance: </span><strong> <?php echo ($row['female_students_count']); ?> </strong></p>
                                    <p class="card-text "> <span class="fw-bold">Faculty Attendance: </span> <strong><?php echo ($row['faculty_members_count']); ?></strong> </p>
                                    <p class="card-text "> <span class="fw-bold">Impact: </span> <?php echo ($row['close_event_impact']); ?> </p>
                                    <div class="row mt-4"><p class="card-text "> <span class="fw-bold">Event Images: </span> </p>
                                    <div class="col-lg-6 m-auto"><img  src="<?php echo($row['event_pic1'])?>" alt="" height="430" width="430"></div>
                                    <div class="col-lg-5 m-auto"><img src="<?php echo($row['event_pic2'])?>" alt="" height="430" width="430"></div>
                                    </div>
                
                                    
                                </div>
                            </div>
                        </div>
        

            <?php
        }
    }else{
        ?>
         <div class="col-lg-12 col-md-12 mb-5">
                        <p class="fs-2 text-center" style="margin-top:11rem;">
                            No Record is there <br>
                        </p>
                    </div>
        <?php
    }

}
?>
</body>

</html>

            
            <!-- to download excel file -->
            <?php
           $get_event="SELECT EVENT.event_name,EVENT.event_date,EVENT.event_start_time,EVENT.event_end_time,
           EVENT.ar_name,EVENT.event_description,EVENT.organization_institute,
           CLOSE_EVENT.close_event_activities,CLOSE_EVENT.male_students_count,CLOSE_EVENT.female_students_count,CLOSE_EVENT.faculty_members_count,
           CLOSE_EVENT.close_event_mode,CLOSE_EVENT.close_event_link,CLOSE_EVENT.close_event_purpose,CLOSE_EVENT.close_event_impact,CLOSE_EVENT.event_pic1,
           CLOSE_EVENT.event_pic2 from `EVENT` join `CLOSE_EVENT` on EVENT.event_id=CLOSE_EVENT.event_id  where MONTH(event_date)='$month' and YEAR(event_date)='$year' and EVENT.status_value='Approved' and EVENT.event_status='Closed' and EVENT.organization_institute<>'Others'
           ";
           $result=mysqli_query($con,$get_event);
            if(mysqli_num_rows($result)>0){
            ?>
            <form action='download.php' method='get'>
            <input type='hidden' name='month' value='$month'>
            <input type='hidden' name='year' value='$year'>
            <a href='download.php'><button type='submit' class='btn btn-success' name='all_events'>click here to download excel</button>
            </form>
        <?php
        }
            ?>
            </div>
        </div>    
</div>    
</body>
</html>
