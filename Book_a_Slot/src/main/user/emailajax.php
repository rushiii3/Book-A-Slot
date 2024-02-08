<?php

require "../connection/connect.php";
if(!empty($_POST['event_name'])
            &&
    !empty($_POST['event_Descr'])
            &&
    !empty($_POST['num_of_students'])
            &&
    !empty($_POST['Venue_name'])
            &&
    !empty($_POST['event_date'])
            &&
    !empty($_POST['event_start_time'])
            &&
    !empty($_POST['event_end_time'])
            &&
    !empty($_POST['Institute_OrgName'])
            &&
    !empty($_POST['Institute_OrgName_email'])
            &&
    !empty($_POST['Institute_OrgName_phone_no'])
            &&
    !empty($_POST['Institute_OrgName_transaction_id'])
            
)
{

    ?>
     <div id="emailContent" style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; background-color: #f9f9f9;">
  <div style="background: #f5f6f8;  margin-inline: auto;">
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
                                Dear <strong>Prof. (Dr.) Preeta Nilesh</strong>,
                            </p>
                                <br>
                            <p class="text-left" style="text-align: left; ">There is an event request, and the details are as follows:
                            </p>
                            <p style="margin: 0px; padding: 0px;"><strong>Name:&nbsp;</strong><span><?php echo($_POST['Institute_OrgName']); ?> </span></p>
                            <p style="margin: 0px; padding: 0px;"><strong>Email: </strong><span><?php echo($_POST['Institute_OrgName_email']); ?></span></p>
                            <p style="margin: 0px; padding: 0px;"><strong>Phone Number: </strong><span><?php echo($_POST['Institute_OrgName_phone_no']); ?></span></p>
                            <p style="margin: 0px; padding: 0px;"><strong>Transaction ID: </strong><span><?php echo($_POST['Institute_OrgName_transaction_id']); ?></span></p>
                            <p style="margin: 0px; padding: 0px;"><strong>Event Name</strong>: <span><?php echo($_POST['event_name']); ?></span></p>
                            <p style="margin: 0px; padding: 0px;"><strong>Venue Name</strong>: <span><?php echo($_POST['Venue_name']); ?></span></p>
                            <p style="margin: 0px; padding: 0px;"><strong>Date</strong>: <span><?php echo(date("d F Y",strtotime($_POST['event_date']))); ?></span></p>
                            <p style="margin: 0px; padding: 0px;"><strong>Time</strong>: <span> <?php echo(date("g:i A",strtotime($_POST['event_start_time']))); ?> to <?php echo(date("g:i A",strtotime($_POST['event_end_time']))); ?> </span></p>
                            <p style="margin: 0px; padding: 0px;"><strong>Number of Attendees</strong>: <span><?php echo($_POST['num_of_students']); ?></span></p>
                            <p style="margin: 0px; padding: 0px;"><strong>Event Description</strong>: <span><?php echo($_POST['event_Descr']); ?></span></p>
                                <br>
                                <br>
                            <p class="text-center" style="text-align: center;">click the below button to accept or reject the event </p>
                            <p style="text-align: center;"><a href="https://www.youtube.com/" style="background-color: #4b62a3;;font-size: 1.7rem; padding:0.1rem 2rem;color: #f5f6f8;text-decoration: none;border-radius: 5px;">Visit</a>  </p> 
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
        To: '<?php echo($_POST['Institute_OrgName_email']) ?>',
        From: 'audibooking55@gmail.com',
        Subject: 'Request for Venue',
        Body: document.getElementById('emailContent').innerHTML,
        }).then(message => console.log(message));
    } 
    send()
        </script>

    <?php


}

if(!empty($_POST['email']) && !empty($_POST['otp']))
{
        $email = $_POST['email'];
        $otp = $_POST['otp'];
        $get_user_name = "SELECT * FROM `USER` WHERE `user_name` = '$email' ";
        $execute_query = mysqli_query($con,$get_user_name);
        if(mysqli_num_rows($execute_query)>0)
        {
                while($row = mysqli_fetch_assoc($execute_query))
                {
                        $name = $row['user_full_name'];
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
                            
                            <p class="text-center" style="text-align: center; margin: 0px; padding: 0px;">
                                Hello <strong><?php echo($name); ?></strong>!
                            </p>
                                <br>
                            <p class="text-center" style="text-align: center; margin: 0px; padding: 0px;">You have requested to reset the password of your GACbooker account</p>
                                <br>
                                <br>
                            <p class="text-center" style="text-align: center; margin: 0px; padding: 0px;">
                                Please find the security code to change your password: <strong><?php echo($otp); ?></strong>
                            </p>
                            <p style="margin: 0px; font-size: 15px;margin-top:4rem ;">-GACbooker</p>
                        </td>
                    </tr>
                                    <tr>
                                        <td valign="top" class="edtext" style="padding: 20px; text-align: left; color: #5f5f5f; font-size: 15px;">
                                            <p class="text-center" style="line-height: 1.75em; text-align: center; margin: 0px; padding: 0px;">
                                                <span style="font-size: 11px;">
                                                    If you no longer wish to receive mail from us, you can <a href="{unsubscribe}" style="background-color: initial; color: #5457ff; text-decoration: none;">unsubscribe</a>
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
    function sendEmail() {
      Email.send({
        SecureToken: "81b5fc89-513e-421c-ab1a-f690f117c594",
        To: '<?php echo($email); ?>',
        From: "audibooking55@gmail.com",
        Subject: "Reset password for GACbooker account",
        Body: document.getElementById('emailContent').innerHTML,
      }).then(message => alert(message));
    }
    sendEmail()
  </script>
  <?php
}
if(!empty($_POST['useremail']) && !empty($_POST['userotp']) && !empty($_POST['username'])){
    
        $email = $_POST['useremail'];
        $otp = $_POST['userotp'];
        $name = $_POST['username'];
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
                            
                            <p class="text-center" style="text-align: center; margin: 0px; padding: 0px;">
                                Hello <strong><?php echo($name); ?></strong>!
                            </p>
                                <br>
                            <p class="text-center" style="text-align: center; margin: 0px; padding: 0px;font-weight:bold;">Here is the One Time Password</p>
                                <p class="text-center" style="text-align: center; margin: 0px; padding: 0px;">
                                to validate your account
                            </p>
                            <br>
                            <p class="text-center" style="text-align: center; margin: 0px; padding: 0px;font-size:2rem">
                                <strong><?php echo($otp); ?></strong>
                            </p>
                            <p style="margin: 0px; font-size: 15px;margin-top:4rem ;">-GACbooker</p>
                        </td>
                    </tr>
                                    <tr>
                                        <td valign="top" class="edtext" style="padding: 20px; text-align: left; color: #5f5f5f; font-size: 15px;">
                                            <p class="text-center" style="line-height: 1.75em; text-align: center; margin: 0px; padding: 0px;">
                                                <span style="font-size: 11px;">
                                                    If you no longer wish to receive mail from us, you can <a href="{unsubscribe}" style="background-color: initial; color: #5457ff; text-decoration: none;">unsubscribe</a>
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
    function sendEmail() {
      Email.send({
        SecureToken: "81b5fc89-513e-421c-ab1a-f690f117c594",
        To: '<?php echo($email); ?>',
        From: "audibooking55@gmail.com",
        Subject: "Reset password for GACbooker account",
        Body: document.getElementById('emailContent').innerHTML,
      }).then(message => console.log(message));
    }
    sendEmail()
  </script>
    <?php
}
?>