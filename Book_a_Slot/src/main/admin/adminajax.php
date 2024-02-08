<?php
include '../connection/connect.php';
if(!empty($_POST['event_id'])
&& !empty($_POST['email'])
&& !empty($_POST['name'])
&& !empty($_POST['event_name'])
&& !empty($_POST['event_date'])
&& !empty($_POST['alumni'])
&& !empty($_POST['event_description'])
&& !empty($_POST['event_start_time'])){
$event_id=$_POST['event_id'];
$email=$_POST['email'];
$name=$_POST['name'];
$event_name=$_POST['event_name'];
$event_date=$_POST['event_date'];
$alumni=$_POST['alumni'];
$event_description=$_POST['event_description'];
$event_start_time=$_POST['event_start_time'];
if($alumni=='Yes'){
    echo "yes";
    $apiUrl = 'https://www.vazecollege.net/ALUMNI/EventInsertApi3.php?apikey=12345';

// Data to be sent in the request body
$data = array(
    'event_name' => $event_name,
    'event_description' => $event_description,
    'event_date' => $event_date,
    'event_time' => $event_start_time,
    'event_image' => 'event_image',
    'event_registration_link' => '#'
);

// Convert data to JSON
$jsonData = json_encode($data);

// Initialize curl
$curl = curl_init();

// Set curl options
curl_setopt_array($curl, array(
    CURLOPT_URL => $apiUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
    ),
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $jsonData,
));

// Execute curl request
$response = curl_exec($curl);

// Check for errors
if ($response === false) {
    echo 'Error: ' . curl_error($curl);
} else {
    // Display the response
    echo $response;
}

// Close curl
curl_close($curl);
}
$update_event_status="update `EVENT` set status_value='Approved',event_status='Open' where event_id=$event_id";
$result=mysqli_query($con,$update_event_status);


// echo $event_id," ",$event_date," ",$event_name," ",$event_name;
?>
<div id="emailContent" style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; background-color: #f9f9f9;">
<div style="background: #f5f6f8">
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
                                Hello <strong><strong><?php echo $name;?></strong>
                                ,
                            </p>
                                <br>
                            <p class="text-center" style="text-align: center; margin: 0px; padding: 0px;">Your Request of audi booking for 
                                            an event <strong><?php echo $event_name;?></strong> is Approved</p>
                                <br>
                                <br>
                            <p class="text-center" style="text-align: center; margin: 0px; padding: 0px;">
                                Event Date: <strong><?php echo $event_date?></strong>
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
    To: '<?php echo $email;?>',
    From: "audibooking55@gmail.com",
    Subject: "Update regarding to audibooking",
    Body: document.getElementById('emailContent').innerHTML,
  }).then(message => alert(message));
}
sendEmail();
</script>
<?php
}
?>
