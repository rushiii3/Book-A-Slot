<?php
require "../connection/connect.php";

if ( 
!empty($_POST['department_id']) 
) {
    
    $department_id=$_POST['department_id'];
    //echo($department_id);
    $get_dates="SELECT EVENT.event_date,DEPARTMENT.department_name,EVENT.event_id,EVENT.event_name FROM `EVENT` JOIN `DEPARTMENT` on EVENT.dep_id=DEPARTMENT.department_id  where status_value='Approved' and DEPARTMENT.department_name<>'Others' and EVENT.event_status='Closed' and DEPARTMENT.department_id='$department_id'";
   // $result=mysqli_query($con,$get_dates);
    $result = mysqli_query($con,$get_dates);
    if(mysqli_num_rows($result)>0){
        while($row= mysqli_fetch_assoc($result)){
            $date=$row['event_date'];
            $name = $row['event_name'];
            $id =  $row['event_id'];
            echo "<option  value='$id'>$name  $date</option>  ";
            
        }
    }
}

mysqli_close($con);
?>