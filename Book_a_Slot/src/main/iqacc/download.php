<?php
include '../connection/connect.php';
?>
<?php
require("../config/session.php");
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
            header('Content-Disposition:attachment;filename=close_event_report.xls');
            ?>
<body>
<div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-11 col-lg-11 m-auto">
               
            <table  class='table table-bordered my-4 ' style="align-items:center">
            <thead >
            <tr >
                <th class='text-center'>Event Name</th>
                <th class='text-center'>Event Date</th>
                <th class='text-center'>Event Time</th>
                <th class='text-center'>Event Venue</th>
                <th class='text-center'>Organization Institute</th>
                <th class='text-center'> Event Description</th>
                <th class='text-center'>Event Mode</th>
                <th class='text-center'>Event Link</th>
                <th class='text-center'>Event Purpose</th>
                <th class='text-center'>Event Activities</th>
                <th class='text-center'>Number of boys</th>
                <th class='text-center'>Number of girls</th>
                <th class='text-center'>Number of Faculty members</th>
                <th class='text-center'>Event Impact</th>
                <th class='text-center'>Event image 1</th>
                <th class='text-center'>Event image 2</th>
            </tr>
            </thead>
            <tbody class="bg-primary">
            <?php
            if(isset($_GET['all_events'])){
                $month=$_GET['month'];
                $year=$_GET['year'];
           
            $get_event="SELECT EVENT.event_name,EVENT.event_date,EVENT.event_start_time,EVENT.event_end_time,
           EVENT.ar_name,EVENT.event_description,EVENT.organization_institute,
           CLOSE_EVENT.close_event_activities,CLOSE_EVENT.male_students_count,CLOSE_EVENT.female_students_count,CLOSE_EVENT.faculty_members_count,
           CLOSE_EVENT.close_event_mode,CLOSE_EVENT.close_event_link,CLOSE_EVENT.close_event_purpose,CLOSE_EVENT.close_event_impact,CLOSE_EVENT.event_pic1,
           CLOSE_EVENT.event_pic2 from `EVENT` join `CLOSE_EVENT` on EVENT.event_id=CLOSE_EVENT.event_id  where MONTH(event_date)='$month' and YEAR(event_date)='$year' and EVENT.status_value='Approved' and EVENT.event_status='Closed' and EVENT.organization_institute<>'Others'
           ";
            
           $result=mysqli_query($con,$get_event);
            if($result===false){
                die(mysqli_error($con));
            }
            while($row=mysqli_fetch_assoc($result)){
                ?>
             
            <tr class='text-center text-light'><td><?php echo $row['event_name'] ?></td>
                <td> <?php echo $row['event_date'] ?></td>
                <td> <?php echo date("g:i A", strtotime($row['event_start_time'])); ?> to <?php echo date("g:i A", strtotime($row['event_end_time'])); ?> </td>
                <td> <?php echo $row['ar_name'] ?></td>
                <td> <?php echo $row['organization_institute'] ?></td>
                <td> <?php echo $row['event_description'] ?></td>
                <td><?php echo $row['close_event_mode'] ?></td>
                <?php
                if($row['close_event_mode']=='offline'){
                    ?>
                <td>NA</td>
                    <?php
                }
                else{
                    ?>
                <td><?php echo $row['close_event_link'] ?></td>

                    <?php
                }
                ?>
                <td><?php echo $row['close_event_purpose'] ?></td>
                <td><?php echo $row['close_event_activities'] ?></td>
                <td><?php echo $row['male_students_count'] ?></td>
                <td><?php echo $row['female_students_count'] ?></td>
                <td><?php echo $row['faculty_members_count'] ?></td>
                <td><?php echo $row['close_event_impact'] ?></td>
                <td><img src= '<?php echo $row['event_pic1'] ?>' height='200' width='200'></td>
                <td> <img src='<?php echo $row['event_pic2'] ?>' height='200' width='200'></td>
                </tr>
            <?php
            }
        }
        ?>
         </tbody>
            </table>
       
            </div>
        </div>    
</div>    
</body>
</html>
