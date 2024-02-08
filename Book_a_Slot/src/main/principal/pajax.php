<?php
require "../connection/connect.php";
if(!empty($_POST['accepteventid']))
{
    $event_id = $_POST['accepteventid'];
    $query_to_accept = "UPDATE `EVENT` SET `status_value` = 'Approved' WHERE `EVENT`.`event_id` = '$event_id'";
    if(mysqli_query($con,$query_to_accept))
    {
        echo("1");
    }else{
        echo("2");
    }
}
if(!empty($_POST['rejecteventid']) && !empty($_POST['reason']) )
{
    $reason =  mysqli_real_escape_string($con, $_POST['reason']);
    $id = mysqli_real_escape_string($con, $_POST['rejecteventid']);
    $query_to_reject = "UPDATE `EVENT` SET status_reason = '$reason', status_value = 'Not Approved' WHERE event_id ='$id' ";
    if(mysqli_query($con,$query_to_reject))
    {
        echo("1");
    }else{
        echo("2");
    }
}

if(!empty($_POST['accept_event_id_email']))
{
    $id = $_POST['accept_event_id_email'];
    $get_event_info = "SELECT * FROM `EVENT` WHERE event_id = '$id'";
    $result_event = mysqli_query($con,$get_event_info);
    if(mysqli_num_rows($result_event)>0)
    {
        while($row=mysqli_fetch_assoc($result_event))
        {
            $event_name = $row['event_name'];
            $event_date = $row['event_date'];
            $event_start_time = $row['event_start_time'];
            $event_end_time = $row['event_end_time'];
            $venue_name = $row['ar_name'];
        }
    }
    $get_user_info = "SELECT * FROM `OUTSIDER_INFO` WHERE event_id = '$id'";
    $result_user_info = mysqli_query($con,$get_user_info);
    if(mysqli_num_rows($result_user_info)>0)
    {
        while($row=mysqli_fetch_assoc($result_user_info))
        {
            $event_user_name = $row['outsider_name'];
            $event_user_email = $row['outsider_email'];
        }
    }
    ?>
    <div id="emailContent" style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; background-color: #f9f9f9;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; background-color: #f9f9f9;">
            <table style="height: 100%; width: 100%; background-color: #f5f6f8;">
                <tbody>
                    <tr>
                        <td valign="top" class="edimg" style="padding: 5px; box-sizing: border-box; text-align: center;">
                            <img src="https://github.com/rushiii3/Book_A_Slot/blob/main/src/img/logo11.jpeg?raw=true" alt="Image" width="108" style="border-width: 0px; border-style: none; max-width: 108px; width: 100%;">
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="edtext" style="padding: 5px; text-align: left; color: #5f5f5f; font-size: 15px; ">
                            <h2 class="text-center" style="text-align: center;">
                                <strong>V.G. Vaze College of Arts, Science and Commerce (Autonomous)</strong>
                            </h2> 
                            
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="edtext" style="background-color: #ffffff;padding: 32px; text-align: left; color: #5f5f5f; font-size: 15px; ">
                            
                            <p class="text-left" style="text-align: left;">
                                Hi <strong><?php echo( $event_user_name ); ?></strong>,
                            </p>
                                
                            <p class="text-left" style="text-align: justify; ">
                                We are delighted to inform you that your event venue request has been approved! On behalf of <strong>V.G. Vaze College of Arts, Science and Commerce (Autonomous)</strong>, we congratulate you on your upcoming event and look forward to working with you to make it a resounding success.
                            </p>
                            <p class="text-left" style="text-align: justify; ">
                                Event Details:
                            </p>
                            <p style="margin: 0px; padding: 0px;"><strong>Event Name</strong>: <span><?php echo($event_name); ?></span></p>
                            <p style="margin: 0px; padding: 0px;"><strong>Date</strong>: <span><?php echo(date("d F Y",strtotime($event_date))); ?></span></p>
                            <p style="margin: 0px; padding: 0px;"><strong>Time</strong>: <span> <?php echo(date("g:i A",strtotime($event_start_time))); ?> to <?php echo(date("g:i A",strtotime($event_end_time))); ?> </span></p>
                            <p style="margin: 0px; padding: 0px;"><strong>Venue</strong>: <span><?php echo($venue_name); ?></span></p>
                                <br>
                            <p class="text-center" style="text-align:justify;">We believe that <?php echo($venue_name); ?> the is an excellent choice for your event and offers the ideal setting to accommodate your needs. </p>
                            <p class="text-center" style="text-align:justify;">Thank you for choosing our venue, and we look forward to working together.</p>

                            <p style="margin: 0px; font-size: 15px;margin-top:4rem ;">-GACbooker</p>
                        </td>
                    </tr>
                                    <tr>
                                        <td valign="top" class="edtext" style="padding: 20px; text-align: left; color: #5f5f5f; font-size: 15px;">
                                            <p class="text-center" style="line-height: 1.75em; text-align: center; margin: 0px; padding: 0px;">
                                                <span style="font-size: 11px;">
                                                    If you no longer wish to receive mail from us, you can <a href="{unsubscribe}" style="background-color: initial; color:#4b62a3; text-decoration: none;">unsubscribe</a>
                                                </span>
                                                <br>
                                                <span style="font-size: 11px;">{accountaddress}</span>
                                            </p>
                                        </td>
                                    </tr>    
                </tbody>
            </table>
        
        </div>
</div>
<script> 
  function send()
  { 
    Email.send({ 
        SecureToken: '81b5fc89-513e-421c-ab1a-f690f117c594',
        To: 'hrushiop@gmail.com',
        From: 'audibooking55@gmail.com',
        Subject: 'Approval of Your Event Venue Request',
        Body: document.getElementById('emailContent').innerHTML,
        }).then(message => console.log(message));
    } 
    send()
        </script>
    <?php
}


if(!empty($_POST['email_reject_event_id']) && !empty($_POST['reason_to_reject_event']))
{
    $id = $_POST['email_reject_event_id'];
    $reason = $_POST['reason_to_reject_event'];
    $get_event_info = "SELECT * FROM `EVENT` WHERE event_id = '$id'";
    $result_event = mysqli_query($con,$get_event_info);
    if(mysqli_num_rows($result_event)>0)
    {
        while($row=mysqli_fetch_assoc($result_event))
        {
            $event_name = $row['event_name'];
            $event_date = $row['event_date'];
            $venue_name = $row['ar_name'];
        }
    }
    $get_user_info = "SELECT * FROM `OUTSIDER_INFO` WHERE event_id = '$id'";
    $result_user_info = mysqli_query($con,$get_user_info);
    if(mysqli_num_rows($result_user_info)>0)
    {
        while($row=mysqli_fetch_assoc($result_user_info))
        {
            $event_user_name = $row['outsider_name'];
            $event_user_email = $row['outsider_email'];
        }
    }
    ?>
        <div id="emailContent" style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; background-color: #f9f9f9;">
        <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; background-color: #f9f9f9;">
            <table style="height: 100%; width: 100%; background-color: #f5f6f8;">
                <tbody>
                    <tr>
                        <td valign="top" class="edimg" style="padding: 5px; box-sizing: border-box; text-align: center;">
                            <img src="https://github.com/rushiii3/Book_A_Slot/blob/main/src/img/logo11.jpeg?raw=true" alt="Image" width="108" style="border-width: 0px; border-style: none; max-width: 108px; width: 100%;">
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="edtext" style="padding: 5px; text-align: left; color: #5f5f5f; font-size: 15px; ">
                            <h2 class="text-center" style="text-align: center;">
                                <strong>V.G. Vaze College of Arts, Science and Commerce (Autonomous)</strong>
                            </h2> 
                            
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="edtext" style="background-color: #ffffff;padding: 32px; text-align: left; color: #5f5f5f; font-size: 15px; ">
                            
                            <p class="text-left" style="text-align: left;">
                                Hi <strong><?php echo( $event_user_name ); ?></strong>,
                            </p>
                                
                            <p class="text-justify" style="text-align: justify;">
                                We regret to inform you that we are unable to approve your event venue request for <?php echo($event_name) ?> of <?php echo($venue_name) ?> on <?php echo date("d F Y", strtotime($event_date)); ?>. Due to <strong> <?php echo($reason); ?> </strong><span style="text-align: justify;">, we cannot accommodate your request at this time.&nbsp;</span>
                            </p>
                            <p style="text-align: justify;">
                                We apologize for any inconvenience caused and encourage you to explore alternative options.
                            </p>
                            <p class="text-center" style="text-align:justify;">
                                Thank you for choosing our venue, and we look forward to working together.
                            </p>

                            <p style="margin: 0px; font-size: 15px;margin-top:4rem ;">-GACbooker</p>
                        </td>
                    </tr>
                                    <tr>
                                        <td valign="top" class="edtext" style="padding: 20px; text-align: left; color: #5f5f5f; font-size: 15px;">
                                            <p class="text-center" style="line-height: 1.75em; text-align: center; margin: 0px; padding: 0px;">
                                                <span style="font-size: 11px;">
                                                    If you no longer wish to receive mail from us, you can <a href="{unsubscribe}" style="background-color: initial; color:#4b62a3; text-decoration: none;">unsubscribe</a>
                                                </span>
                                                <br>
                                                <span style="font-size: 11px;">{accountaddress}</span>
                                            </p>
                                        </td>
                                    </tr>    
                </tbody>
            </table>
        
        </div>
</div>
<script> 
  function send()
  { 
    Email.send({ 
        SecureToken: '81b5fc89-513e-421c-ab1a-f690f117c594',
        To: 'hrushiop@gmail.com',
        From: 'audibooking55@gmail.com',
        Subject: 'Rejection of Your Event Venue Request',
        Body: document.getElementById('emailContent').innerHTML,
        }).then(message => console.log(message));
    } 
    send()
        </script>
   <?php
}

?>