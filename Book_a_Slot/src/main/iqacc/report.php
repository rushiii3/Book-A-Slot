<?php
require("../config/session.php");
?>
<?php
include '../connection/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <title>Report</title>
    <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />
</head>
<body>
<?php
            include "navigation.html"
            ?>
        <div class="row">
        <div class="col-lg-5 m-auto">
<div class="container mt-5 mb-5 shadow p-3 mb-5 bg-body" id="main_body" style="border-radius: 20px">
           
            <p class="fs-3 text-center fw-bold">
                    Get information of close events.
            </p>
            <form action="main_report.php" method="POST" enctype="multipart/form-data">
            <div class="form-outline w-75 m-auto  mt-5">
                    <label for="organizer" class="form-label fw-bold">select department </label>
                    <form method="post">
                    <select name="select_organizer" class='w-100 m-auto form-control' id="select_organizer">
                        <option value="Select Department">Select Department</option>
                        <?php
                        //$all_organizer=array();
                        $get_organizations="SELECT distinct  DEPARTMENT.department_id, DEPARTMENT.department_acadamics, DEPARTMENT.department_name FROM `EVENT` JOIN `DEPARTMENT` on EVENT.dep_id=DEPARTMENT.department_id  where status_value='Approved' and DEPARTMENT.department_name<>'Others' and EVENT.event_status='Closed'";
                        echo("yes");
                        //$get_organizations = "SELECT * FROM DEPARTMENT";
                        $result=mysqli_query($con,$get_organizations);
                        echo(mysqli_num_rows($result));
                        if(mysqli_num_rows($result)){
                        while($row=mysqli_fetch_assoc($result)){
                           // $all_organizer[]=$row['department_name'];
                           $department_id=$row['department_id'];
                            $academics=$row['department_acadamics'];
                            $organizer=$row['department_name'];
                            echo "<option  value='$department_id' >$organizer of $academics</option>";  
                      
                        ?>
                        <?php
                        }
                    }
                        ?>    
                    </select>
                </form>
            </div>
            <div class="form-outline w-75 m-auto  mt-5">
                        <label for="date" class="form-label w-100 fw-bold">Date</label><br>
                        <select name="organizer" class='w-100 m-auto form-control' id="organizer">
                            <option value="Select department first">Select Department First</option>
                        <?php
                        // $all_organizer=array();
                        // $get_dates="SELECT EVENT.event_date,DEPARTMENT.department_name FROM `EVENT` JOIN `DEPARTMENT` on EVENT.dep_id=DEPARTMENT.department_id  where status_value='Approved' and DEPARTMENT.department_name<>'Others' and EVENT.event_status='Closed'";
                        // $result=mysqli_query($con,$get_dates);
                        // while($row=mysqli_fetch_assoc($result)){
            
                        //     $date=$row['event_date'];
                        //     echo "<option  value='$date'>$date</option>  ";
                           
                        ?>
                        <?php
                        //}
                        ?>    
                    </select>
            </div>
           
                        <?php
                        ?>    
                    
            <div class="mb-5 mt-5 form-outline d-flex align-item-center m-auto">
                        <button type="submit" name="submit" id="submit" class="btn btn-primary px-5 py-2 ms-5 mt-3">
                            Submit
                        </button>
                    </div>
            </form>
        </div>
        </div>
                    </div>
                    <script>
$( document ).ready(function() {
   $('#select_organizer').on('change',function(){
    $department_id=$('#select_organizer').val();
    $('#organizer').html(" ");
    $.ajax({
                        type: 'POST',
                        url: 'reportAjax.php',
                        data: {department_id:$department_id},
                        success: function(data){
                           console.log(data);
                           $('#organizer').append(data);
                        },
                        error: function() {
                            console.log(response.status);
                        },
                    })
   });
   $('#submit').on('click',function(){
    $id = $('#organizer').val();
    window.location.href = "./main_report.php?&id="+$id +" " ;
})

});                      

                    </script>

</body>

</html>