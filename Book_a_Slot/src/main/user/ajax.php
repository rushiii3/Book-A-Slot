<?php
require "../connection/connect.php";

if (!empty($_POST['fullname']) &&
    !empty($_POST['email']) &&
    !empty($_POST['department_namee']) &&
    !empty($_POST['password'])
) {
    $user_name = mysqli_real_escape_string($con, $_POST['fullname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $department_namee = mysqli_real_escape_string($con, $_POST['department_namee']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $query_to_get_if_already_user = "SELECT * FROM `USER` WHERE `user_name` = '$email'";
    $result_of_already_user = mysqli_query($con,$query_to_get_if_already_user);
    if(mysqli_num_rows($result_of_already_user)>0){
        while($row_of_already_user = mysqli_fetch_assoc($result_of_already_user)){
            if($row_of_already_user['account_status']=="Inactive"){
                $insert_user_info = "UPDATE `USER` SET `department_name` = '$department_namee', `user_full_name` = '$user_name',`pwd` = '$password' WHERE `USER`.`user_name` = '$email' ";
                if (mysqli_query($con, $insert_user_info)) {
                    echo ("1");
                } else {
                    echo ("2");
                    echo ("Error description: " . mysqli_error($con));
                }
            }else{
                echo("3");
            }
        }
    }
}

if (!empty($_POST['email_login']) &&
    !empty($_POST['password_login'])
) {

    $email = mysqli_real_escape_string($con, $_POST["email_login"]);
    $password = mysqli_real_escape_string($con, $_POST["password_login"]);
    $user_info_query = "SELECT * FROM `USER` WHERE `user_name` = '$email' AND  `pwd` = '$password'";
    $result_of_user_info = mysqli_query($con, $user_info_query);
    
    if (mysqli_num_rows($result_of_user_info) == 1) 
    {
        while ($row = mysqli_fetch_assoc($result_of_user_info)) 
        {
            if($row["account_status"]=="Inactive")
            {
                echo("7");
            }
            else
            {
                
                $user_email = $row["user_name"];
                $user_full_name = $row["user_full_name"];
                $user_type = $row["user_type"];
                 session_start();
                $_SESSION["user_email"] = $email;
                $_SESSION["user_full_name"] = $user_full_name;
                $_SESSION["user_type"] = $user_type;
                // setcookie("user_email", $user_email, time() + (86400 * 30), "/"); // 86400 = 1 day
                // setcookie("user_full_name", $user_full_name, time() + (86400 * 30), "/"); // 86400 = 1 day
                // setcookie("user_type", $user_type, time() + (86400 * 30), "/"); // 86400 = 1 day
                if ($user_type == "o" || $user_type == "k") {
                    echo ("1");
                } elseif($user_type == "a") {
                    echo ("2");
                }elseif($user_type == "p") {
                    echo ("3");
                }elseif($user_type == "i") {
                    echo ("4");
                }elseif($user_type == "r") {
                    echo ("5");
                }else{
                    echo("6");
                }
                
                
                
            }
        }


    } else {
        echo ("no");
    }
}
if (!empty($_POST['datee']) && !empty($_POST['Venue_name']) ) {
    $datee = date('Y-m-d', strtotime($_POST["datee"]));
    $Venue_name = mysqli_real_escape_string($con, $_POST["Venue_name"]);
    $get_time_info = "SELECT * FROM `EVENT` WHERE `event_date` = '$datee' AND ar_name = '$Venue_name' AND status_value in ('Approved','Pending')";
    $result_of_time = mysqli_query($con, $get_time_info);
    if (mysqli_num_rows($result_of_time) > 0) {
        ?>
        <script>
            $start_time = $('.start-time');
            $end_time = $('.end-time');
            var i, x = $('.start-time');
            for (i = 0; i < x.length; i++) {
                $start_time.eq(i).prop('disabled', false);
                $end_time.eq(i).prop('disabled', false);
            }
            for (i = 0; i < x.length; i++) {
                <?php
                while ($row_of_result = mysqli_fetch_assoc($result_of_time)) {
                    ?>
                    if ("<?php echo(date('H:i', strtotime($row_of_result['event_start_time']))); ?>" == $start_time[i].attributes[1].value) {
                        do {
                            $start_time.eq(i).prop('disabled', true);
                            $end_time.eq(i).prop('disabled', true);

                            i = i + 1;
                        } while ("<?php echo( date('H:i', strtotime($row_of_result['event_end_time'])) ); ?>">=$start_time[i].attributes[1].value);
                    }
                    <?php

                }
                ?>
            }
        </script>
        <?php
    }else{
        ?>
        <script>
            $start_time = $('.start-time');
            $end_time = $('.end-time');
            var i, x = $('.start-time');
            for (i = 0; i < x.length; i++) {
                $start_time.eq(i).prop('disabled', false);
                $end_time.eq(i).prop('disabled', false);
            }
            </script>
        <?php
    }
}
if (!empty($_POST['eventid']) && !empty($_POST['reason'])) {
    $reason =  mysqli_real_escape_string($con, $_POST['reason']);
    $id = mysqli_real_escape_string($con, $_POST['eventid']);
    $query_to_cancel_slot = "UPDATE `EVENT` SET status_reason = '$reason', status_value = 'Canceled' WHERE event_id ='$id' ";
    if (mysqli_query($con, $query_to_cancel_slot)) {
        echo ("1");
    } else {
        echo ("2");
        echo ("Error description: " . mysqli_error($con));
    }
}

if (!empty($_POST['selectdatee']) && !empty($_POST['venue_name'])) {
    $dateee = date('Y-m-d', strtotime($_POST["selectdatee"]));
    $venue_name = mysqli_real_escape_string($con, $_POST["venue_name"]);
    $get_event_info_by_date = "SELECT * FROM `EVENT` WHERE event_date = '$dateee' AND ar_name = '$venue_name' AND status_value in ('Approved','Pending') ORDER BY event_start_time";
    $result_of_get_event_info_by_date = mysqli_query($con, $get_event_info_by_date);
    if (mysqli_num_rows($result_of_get_event_info_by_date) > 0) {
        while ($row_of_get_event_info_by_date = mysqli_fetch_assoc($result_of_get_event_info_by_date)) {
            $color_array = Array(
                '#FF0000', // Red
                '#0000FF', // Blue
                '#00FF00', // Green
                '#FFFF00', // Yellow
                '#FFA500', // Orange
                '#800080', // Purple
                '#00FFFF', // Cyan
                '#FF00FF', // Magenta
                '#008080', // Teal
                '#FFC0CB', // Pink
                '#00FF00', // Lime
                '#A52A2A', // Brown
                '#808080', // Gray
                '#000000'  // Black   
            );
            ?>
            <div class="col-12 mt-4"> 
                <p style="border-left:3px solid  <?php echo ($color_array[array_rand($color_array)]); ?> ; padding-left:2rem;">
                    <?php echo ($row_of_get_event_info_by_date['event_name']); ?>
                    <span class="badge p-1 ms-2
                                        <?php
                                        if ($row_of_get_event_info_by_date['status_value'] == "Approved") {
                                            echo ("bg-success");
                                        } elseif ($row_of_get_event_info_by_date['status_value'] == "Pending") {
                                            echo ("bg-warning");
                                        } else {
                                            echo ("bg-secondary");
                                        }
                                        ?>
                                    ">
                                        <?php echo ($row_of_get_event_info_by_date['status_value']); ?>
                                    </span>
                    <br>
                    <?php echo (date('H:i A', strtotime($row_of_get_event_info_by_date['event_start_time']))); ?> to <?php echo (date('H:i A', strtotime($row_of_get_event_info_by_date['event_end_time']))); ?>
                    <br>
                    <small> <?php
                    $dept_id = $row_of_get_event_info_by_date['dep_id'];
                    $get_dept_name = "SELECT * FROM DEPARTMENT WHERE department_id = '$dept_id'";
                    $result_of_dep = mysqli_query($con,$get_dept_name);
                    if(mysqli_num_rows($result_of_dep)>0)
                    {
                        while($row = mysqli_fetch_assoc($result_of_dep))
                        {
                            echo($row['department_acadamics'].' - ' .$row['department_name']);
                        }
                    }
                    ?> 
                    </small>
                </p>
            </div>
            <hr>
            <?php
        }
    } else {
        echo '<div class="col-12 mt-4 text-center"> No Events  </div>';
    }
}

if(!empty($_POST['user_email']) 
            &&
    !empty($_POST['event_name'])
            &&
    !empty($_POST['event_Descr'])
            &&
    !empty($_POST['num_of_students'])
            &&
    !empty($_POST['department_namee'])
            &&
    !empty($_POST['Venue_name'])
            &&
    !empty($_POST['event_date'])
            &&
    !empty($_POST['event_start_time'])
            &&
    !empty($_POST['event_end_time'])
            &&
    !empty($_POST['requriment'])
            &&
    !empty($_POST['rp_names'])
            &&
    !empty($_POST['company_names'])
            &&
    !empty($_POST['designations'])
            &&
    !empty($_POST['experience'])
            &&
    !empty($_POST['insider'])
            &&
    !empty($_POST['alumni'])
        

)
{
    date_default_timezone_set("Asia/Calcutta");
    $FourDigitRandomNumber = mt_rand(11111, 99999);
    $timestamp = date("Y-m-d H:i:s");
    $user_email = mysqli_real_escape_string($con, $_POST['user_email']);
    $event_name = mysqli_real_escape_string($con, $_POST['event_name']);
    $event_Descr = mysqli_real_escape_string($con, $_POST['event_Descr']);
    $num_of_students = mysqli_real_escape_string($con, $_POST['num_of_students']);
    $department_namee = mysqli_real_escape_string($con, $_POST['department_namee']);
    $Venue_name = mysqli_real_escape_string($con, $_POST['Venue_name']);
    $event_date = date('Y-m-d', strtotime($_POST["event_date"]));
    $event_start_time = $_POST["event_start_time"];
    $event_end_time = $_POST["event_end_time"];
    $requriment = mysqli_real_escape_string($con, $_POST['requriment']);
    $rp_names = $_POST['rp_names'];
    $company_names = $_POST['company_names'];
    $designations = $_POST['designations'];
    $experience = $_POST['experience'];
    $alumni = mysqli_real_escape_string($con, $_POST['alumni']);
    $query_insert_event_for_insider = "INSERT INTO `EVENT` (`event_id`, `event_name`, `event_date`, `event_start_time`, `event_end_time`, `event_description`, `students_total_number`, `status_value`, `dep_id`, `request_date_time`, `user_name`, `ar_name`, `event_requriement`,alumni) VALUES ('$FourDigitRandomNumber','$event_name','$event_date','$event_start_time','$event_end_time','$event_Descr','$num_of_students','Pending','$department_namee','$timestamp','$user_email','$Venue_name','$requriment','$alumni')";
    if(mysqli_query($con,$query_insert_event_for_insider))
    {
        $count = 0;
        for($i=0;$i<=sizeof($rp_names) && $i<sizeof($company_names) && $i<sizeof($designations) && $i<sizeof($experience);$i++ )
        {
            $resource_person_info = "INSERT INTO `RESOURCE_PERSON` (`full_name`,`company_name`,`designation`,`experience`,`event_id`) VALUES ('$rp_names[$i]','$company_names[$i]','$designations[$i]','$experience[$i]','$FourDigitRandomNumber')";
            if (mysqli_query($con, $resource_person_info)) {
                $count = $count + 1;   
            }
        }
        if(sizeof($rp_names)==$count)
        {
            echo("1");
        }else{
            echo("2");
        }
    }else{
        echo("2");
        echo ("Error description: " . mysqli_error($con));
    } 
}


if(!empty($_POST['user_email']) 
            &&
    !empty($_POST['event_name'])
            &&
    !empty($_POST['event_Descr'])
            &&
    !empty($_POST['num_of_students'])
            &&
    !empty($_POST['department_namee'])
            &&
    !empty($_POST['Venue_name'])
            &&
    !empty($_POST['event_date'])
            &&
    !empty($_POST['event_start_time'])
            &&
    !empty($_POST['event_end_time'])
            &&
    !empty($_POST['requriment'])
            &&
    !empty($_POST['rp_names'])
            &&
    !empty($_POST['company_names'])
            &&
    !empty($_POST['designations'])
            &&
    !empty($_POST['experience'])
            &&
    !empty($_POST['Institute_OrgName'])
            &&
    !empty($_POST['Institute_OrgName_email'])
            &&
    !empty($_POST['Institute_OrgName_phone_no'])
            &&
    !empty($_POST['alumni'])
            &&
    !empty($_POST['others'])
)
{
    date_default_timezone_set("Asia/Calcutta");
    $FourDigitRandomNumber = mt_rand(11111, 99999);
    $timestamp = date("Y-m-d H:i:s");
    $user_email = mysqli_real_escape_string($con, $_POST['user_email']);
    $event_name = mysqli_real_escape_string($con, $_POST['event_name']);
    $event_Descr = mysqli_real_escape_string($con, $_POST['event_Descr']);
    $num_of_students = mysqli_real_escape_string($con, $_POST['num_of_students']);
    $department_namee = mysqli_real_escape_string($con, $_POST['department_namee']);
    $Venue_name = mysqli_real_escape_string($con, $_POST['Venue_name']);
    $event_date = date('Y-m-d', strtotime($_POST["event_date"]));
    $event_start_time = $_POST["event_start_time"];
    $event_end_time = $_POST["event_end_time"];
    $requriment = mysqli_real_escape_string($con, $_POST['requriment']);
    $rp_names = $_POST['rp_names'];
    $company_names = $_POST['company_names'];
    $designations = $_POST['designations'];
    $experience = $_POST['experience'];
    $Institute_OrgName = mysqli_real_escape_string($con, $_POST['Institute_OrgName']);
    $Institute_OrgName_email = mysqli_real_escape_string($con, $_POST['Institute_OrgName_email']);
    $Institute_OrgName_phone_no = mysqli_real_escape_string($con, $_POST['Institute_OrgName_phone_no']);
    $alumni = mysqli_real_escape_string($con, $_POST['alumni']);
    $query_insert_event_for_outsider = "INSERT INTO `EVENT` (`event_id`, `event_name`, `event_date`, `event_start_time`, `event_end_time`, `event_description`, `students_total_number`, `status_value`, `dep_id`, `request_date_time`, `user_name`, `ar_name`, `event_requriement`,alumni) VALUES ('$FourDigitRandomNumber','$event_name','$event_date','$event_start_time','$event_end_time','$event_Descr','$num_of_students','Pending','$department_namee','$timestamp','$user_email','$Venue_name','$requriment','$alumni')";
    $query_to_insert_outsider_info = "INSERT INTO `OUTSIDER_INFO` (`outsider_name`, `outsider_email`, `outsider_phone`, `event_id`) VALUES ('$Institute_OrgName', '$Institute_OrgName_email', '$Institute_OrgName_phone_no', '$FourDigitRandomNumber')";
    if(mysqli_query($con,$query_insert_event_for_outsider))
    {
        if(mysqli_query($con,$query_to_insert_outsider_info))
        {
            $count = 0;
            for($i=0;$i<=sizeof($rp_names) && $i<sizeof($company_names) && $i<sizeof($designations) && $i<sizeof($experience);$i++ )
            {
                $resource_person_info = "INSERT INTO `RESOURCE_PERSON` (`full_name`,`company_name`,`designation`,`experience`,`event_id`) VALUES ('$rp_names[$i]','$company_names[$i]','$designations[$i]','$experience[$i]','$FourDigitRandomNumber')";
                if (mysqli_query($con, $resource_person_info)) {
                    $count = $count + 1;   
                }
            }
    
            if(sizeof($rp_names)==$count)
            {
                echo("1");
                
            }else{
                echo("2");
                echo ("Error description: " . mysqli_error($con));
            }
        }else{
            echo("2");
            echo ("Error description: " . mysqli_error($con));
        }
        
    }else{
        echo("2");
        echo ("Error description: " . mysqli_error($con));
    } 
}

if(!empty($_POST['user_email_forgot']) && !empty($_POST['password']))
{
    $user_email = mysqli_real_escape_string($con, $_POST['user_email_forgot']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $change_user_password = "UPDATE `USER` SET `pwd` = '$password' WHERE `USER`.`user_name` = '$user_email' ";
    if(mysqli_query($con,$change_user_password))
    {
        echo("1");
    }else{
        echo("2");
    }
}


if(!empty($_POST['event_id_change']) && !empty($_POST['imglink']))
{
    echo($_POST['imglink']);
}


if(!empty($_POST['sign_up_email']))
{
    $email = $_POST['sign_up_email'];
    $query_to_search_email = "SELECT * FROM USER WHERE user_name = '$email'";
    if(mysqli_num_rows(mysqli_query($con,$query_to_search_email))>0)
    {
        echo("1");
    }else{
        echo("2");
    }
}

if(!empty($_POST['transaction_event_id']) && !empty($_POST['transaction_id_for_event']) && !empty($_POST['transaction_date_for_event']))
{
    $id= mysqli_real_escape_string($con, $_POST['transaction_event_id']);
    $transaction = mysqli_real_escape_string($con, $_POST['transaction_id_for_event']);
    $transaction_date = date('Y-m-d', strtotime($_POST["transaction_date_for_event"]));
    $query_to_update = "UPDATE `OUTSIDER_INFO` SET outsider_transaction_id = '$transaction', outsider_payment_date='$transaction_date' WHERE event_id = '$id'";
    if(mysqli_query($con,$query_to_update))
    {
        echo("1");
    }else{
        echo("2");
    }
}
if(!empty($_POST['requirement_date']))
{
    
    $date = date('Y-m-d', strtotime($_POST['requirement_date']));
    $get_venue_names = "SELECT * FROM AUDI_ROOM" ;
    $result_of_query = mysqli_query($con,$get_venue_names);
    
    $for = 1;
    if(mysqli_num_rows($result_of_query)>0)
    {
        while($row_of_venue = mysqli_fetch_assoc($result_of_query))
        {
            $venue = $row_of_venue['ar_name'];

            ?>
            <table class="table table-responsive table-striped table-bordered mt-4" id="vd_<?php echo($for);?>">
    <thead>
        <tr>
        <th colspan="4"><?php echo($venue); ?></th>
        </tr>
        <tr>
        <th scope="col">Sr.No</th>
        <th scope="col">Event Name</th>
        <th scope="col">Event Time</th>
        <th scope="col">Event Requirement</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $for = $for+1;
    $count = 1;
            $get_events = "SELECT * FROM `EVENT` WHERE ar_name = '$venue' AND status_value = 'Approved' AND event_date = '$date' ORDER BY event_start_time";
            $result_of_events = mysqli_query($con,$get_events);
            if(mysqli_num_rows($result_of_events))
            {
                while($row_of_event = mysqli_fetch_assoc($result_of_events))
                {
                    ?>
    
        <tr>
        <th scope="row"><?php echo($count); ?></th>
        <td><?php echo($row_of_event['event_name']); ?></td>
        <td><?php echo date("g:i A", strtotime($row_of_event['event_start_time'])); ?> to <?php echo date("g:i A", strtotime($row_of_event['event_end_time'])); ?></td>
        <td><?php echo($row_of_event['event_requriement']); ?></td>
        
        </tr>
        
                    <?php
                    $count = $count + 1;
                }
            }else{
                ?>
                <script>
                    $('#vd_<?php echo($for-1);?>').hide();
                    </script>
                <?php

            }
        }
    }
    ?>
</tbody>
</table>
<?php
}

if(!empty($_POST['number_of_students']) && !empty($_POST['venue_named']))
{
    $no_of_student = mysqli_real_escape_string($con, $_POST['number_of_students']);
    $venue = mysqli_real_escape_string($con, $_POST['venue_named']);
    $query_to_get_info = "SELECT * FROM AUDI_ROOM WHERE ar_name = '$venue'";
    $result_to_query = mysqli_query($con,$query_to_get_info);
    if(mysqli_num_rows($result_to_query))
    {
        while($row = mysqli_fetch_assoc($result_to_query))
        {
            if($no_of_student<=$row['capacity'])
            {
               ?>
                               <span  class="text-success"> Valid. </span>
                               <input id="verified_no" style="display:none" type="number" value="1" readonly>

                               <?php
            }else{
                ?>
                <span  class="text-danger"> Number of students should be less than <?php echo($row['capacity']); ?>. </span>
                <input id="verified_no" style="display:none" type="number" value="2" readonly>
                <?php
            }
        }
    }
}

if(!empty($_POST['dep_name']))
{
    $dep_name = $_POST['dep_name'];
    $get_dep_names ="SELECT department_stream FROM DEPARTMENT WHERE department_acadamics = '$dep_name' GROUP BY department_stream";
    $result = mysqli_query($con,$get_dep_names);
    if(mysqli_num_rows($result))
    {
        echo("<option selected>Select a Department / Committee</option>");
        while($row = mysqli_fetch_assoc($result))
        {
            $stream = $row['department_stream'];
            ?>
            <optgroup label="<?php echo($stream); ?>">
            <?php
            $get_details = "SELECT * FROM DEPARTMENT WHERE department_stream = '$stream' AND department_acadamics = '$dep_name'";
            $result_of_details = mysqli_query($con,$get_details);
            if(mysqli_num_rows($result_of_details))
            {
              while($row_of_details = mysqli_fetch_assoc($result_of_details))
              {
                ?>
                <option value="<?php echo($row_of_details['department_id']); ?>"><?php echo($row_of_details['department_name']); ?></option>
                <?php
                
              }
            }
        }
    }else{
        echo("<option selected>Select a Department / Committee first</option>");
    }
}
if(!empty($_POST['useremailtoverify']))
{
    $email = $_POST['useremailtoverify'];
    $set_email_activation = "UPDATE `USER` SET account_status = 'Active' WHERE `USER`.`user_name` = '$email'";
    if(mysqli_query($con,$set_email_activation))
    {
        echo("1");
    }else{
        echo("2");
    }
}
if(!empty($_POST['Venue_name_details']))
{
    $venue_name = $_POST['Venue_name_details'];
    $venue_capacity = "SELECT * FROM `audi_room` WHERE ar_name = '$venue_name' ";
    $result_of_capacity = mysqli_query($con,$venue_capacity);
    if(mysqli_num_rows($result_of_capacity)>0)
    {
        while($row = mysqli_fetch_assoc($result_of_capacity))
        {
            echo("The capacity should be between 0 to ".$row["capacity"]);
        }
    }
}

if(!empty($_POST['Venue_name_detail_for_requirement']))
{
    $venue_name = $_POST['Venue_name_detail_for_requirement'];
    $venue_requirement = "SELECT * FROM `accessories_for_venues` WHERE venue_name = '$venue_name' ";
    $result_of_requirement = mysqli_query($con,$venue_requirement);
    if(mysqli_num_rows($result_of_requirement)>0)
    {
        while($row = mysqli_fetch_assoc($result_of_requirement))
        {
            $access_id = $row["access_id"];
            $query_for_venue_requriement = "SELECT * FROM accessories WHERE accessories_id = '$access_id' ";
            $result_of_venue_requriement = mysqli_query($con,$query_for_venue_requriement);
            if(mysqli_num_rows($result_of_venue_requriement)>0)
            {
                while($row_requirement = mysqli_fetch_assoc($result_of_venue_requriement))
                {
                    echo(' 
                    <div class="col-12 mb-4 form-check"> 
                    <input class="form-check-input" name="checkArr" id='.$row_requirement['accessories_name'].' type="checkbox" value='.$row_requirement['accessories_name'].'>
                        <label class="form-check-label" for='.$row_requirement['accessories_name'].'>
                        '.$row_requirement['accessories_name'].'
                        </label>
                    </div>');
                   
                }
            }
        
        }
    }
}
if (
    !empty($_POST['rp_names_update']) && 
    !empty($_POST['company_names_update']) && 
    !empty($_POST['designations_update']) && 
    !empty($_POST['experience_update']) && 
    !empty($_POST['event_id'])

) {
    echo(1);
}
mysqli_close($con);

?>