
<?php
// require("../config/session.php");
include ('../connection/connect.php');

session_start();
if(!isset($_SESSION['user_email']) )
{
//   echo("<script>window.location='../user/sign_in.php';</script>");
echo("not logged in");
}
else{
  $user_email = $_SESSION["user_email"];
  $user_name = $_SESSION["user_full_name"];
  $user_type = $_SESSION["user_type"];
}
if(isset($_GET['event_id'])){
    $event_id=$_GET['event_id'];
    $getting_event_info="SELECT * from `EVENT` where event_id='$event_id'";
    $result=mysqli_query($con,$getting_event_info);
    $row=mysqli_fetch_assoc($result);
    $event_end_time=$row['event_end_time'];
}else{
  echo("no");
  echo ("<script>location.href='./status.php'</script>");
}
if(isset($_POST['close_event'])){
    $event_id=$_POST['close_event_id'];
    $event_purpose=$_POST['event_purpose'];
    $event_mode=$_POST['event_mode'];
    $event_link=$_POST['link_of_event'];
    $event_activities=$_POST['event_activities'];
    $event_impact=$_POST['event_impact'];
    $male_students=$_POST['no_of_male_stu_attending'];
    $female_students = $_POST['no_of_female_stu_attending'];
    $other_students = $_POST['no_of_other_stu_attending'];
    $male_faculty=$_POST['no_of_male_faculty_attending'];
    $female_faculty=$_POST['no_of_female_faculty_attending'];
    $hod_name=$_POST['hod_name'];

    // echo($event_id);
    // echo($event_purpose);
    // echo($event_mode);
    // echo($event_link);
    // echo($event_activities);
    // echo($event_purpose);
    // echo($event_impact);
    // echo($male_students);
    // echo($female_students);
    // echo($other_students);
    // echo($male_faculty);
    // echo($female_faculty);
    // echo($hod_name);
    function random_str(
      int $length = 64,
      string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
  ): string {
      if ($length < 1) {
          throw new \RangeException("Length must be a positive integer");
      }
      $pieces = [];
      $max = mb_strlen($keyspace, '8bit') - 1;
      for ($i = 0; $i < $length; ++$i) {
          $pieces []= $keyspace[random_int(0, $max)];
      }
      return implode('', $pieces);
  }
  
  function tf_convert_base64_to_image( $base64_code, $path, $image_name = null ) {
     
    if ( !empty($base64_code) && !empty($path) ) :
 
        // split the string to get extension and remove not required part
        // $string_pieces[0] = to get image extension
        // $string_pieces[1] = actual string to convert into image
        $string_pieces = explode( ";base64,", $base64_code);
 
        /*@ Get type of image ex. png, jpg, etc. */
        // $image_type[1] will return type
        $image_type_pieces = explode( "image/", $string_pieces[0] );
 
        $image_type = $image_type_pieces[1];
 
        /*@ Create full path with image name and extension */
        $store_at = $path.md5(uniqid()).'.'.$image_type;
 
        /*@ If image name available then use that  */
        if ( !empty($image_name) ) :
            $store_at = $path.$image_name.'.'.$image_type;
        endif;
 
        $decoded_string = base64_decode( $string_pieces[1] );
 
        file_put_contents( $store_at, $decoded_string );
        return $store_at;
    endif;
 
}
  if(isset($_POST["base64Image1"])){
    $data = $_POST["base64Image1"];
    $destination_first =  tf_convert_base64_to_image( $data, '../event_images/');
  }
  if(isset($_POST["base64Image2"])){
    $data = $_POST["base64Image2"];
    $destination_second =  tf_convert_base64_to_image( $data, '../event_images/');
  }

    // if (isset($_FILES['event_pic_first'])) {
    //     $eventPicFirst = $_FILES['event_pic_first'];
    //     $pic1_name = random_str(32);
    //     $extension =  pathinfo($eventPicFirst['name']);
    //     $pic1_path=$eventPicFirst['tmp_name'];
    //     $destination_first='../event_images/'.$pic1_name.'.'.$extension['extension']; 
    //     move_uploaded_file($pic1_path,$destination_first);
    //   } 
    //   if (isset($_FILES['event_pic_second'])) {
    //     $eventPicSecond = $_FILES['event_pic_second'];
    //     $pic2_name=random_str(32);
    //     $extension =  pathinfo($eventPicSecond['name']);
    //     $pic2_path=$eventPicSecond['tmp_name'];
    //     $destination_second='../event_images/'.$pic2_name.'.'.$extension['extension'];
    //     move_uploaded_file($pic2_path,$destination_second);
    //   }

      $close_event_query="INSERT into `CLOSE_EVENT`(close_event_mode,close_event_link,close_event_purpose,
      close_event_activities,close_event_impact,hod_name,male_students_count,female_students_count,other_students_count,faculty_members_male_count,faculty_members_female_count,event_pic1,	event_pic2,event_id)
      values ('$event_mode','$event_link','$event_purpose','$event_activities','$event_impact','$hod_name','$male_students','$female_students','$other_students','$male_faculty','$female_faculty',
      '$destination_first','$destination_second','$event_id')";
      $result_of_closed_event=mysqli_query($con,$close_event_query);
      $update_event_status="update `EVENT` set event_status='Closed' where event_id='$event_id'";
      $result_of_update=mysqli_query($con,$update_event_status);
      if($result_of_closed_event && $result_of_update){
        header('location:../user/home.php');
      }
      else{
        die(mysqli_error($con));
      }
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Page for Close Event">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="../../css/booking.css">
    <title>Close Event </title>
    <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />

</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <?php
        
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




  <div class="container mt-5 mb-5 shadow p-3 mb-5 bg-body" id="main_body" style="border-radius: 20px">
            <!-- Container starting -->
            <p class="fs-3 text-center fw-bold">
                        Close your event by filling form
            </p>
            <form action="close_event_form.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-6 col-md-6 m-auto fw-bold mt-3">
                    <!-- <p>Hello</p> -->
                    
                            
                            <!-- <div class="form-outline w-100 m-auto mt-2 mb-3">
                            <label for="close_event_id" class="form-label">Event id</label> -->
                            <input type="hidden" class="form-control" id="close_event_id" name="close_event_id" value=<?php echo $event_id;?> required>
                            <!-- </div> -->
                            <!-- Description of event purpose -->
                            <div class="form-outline w-100 m-auto mt-2 mb-3">
                                            <label for="event_purpose" class="form-label">Event purpose</label>
                                            <textarea class="form-control" id="event_purpose" name="event_purpose" rows="2" required placeholder="education or entertain"></textarea>
                            </div>
                            <!-- description of Event activites  -->
                            <div class="form-outline w-100 m-auto mt-2 mb-3">
                                            <label for="event_activities" class="form-label">Event activities</label>
                                            <textarea class="form-control" id="event_activities" name="event_activities" required rows="2" placeholder="speech or performane or discussion"></textarea>
                            </div>
                            <!-- number of male students attend event -->
                            <div class="form-outline w-100 m-auto mt-2 mb-3">
                                            <label for="no_of_male_stu_attending" class="form-label">No. of Male students attended event</label>
                                            <input type="number" class="form-control" id="no_of_male_stu_attending" name="no_of_male_stu_attending" required>
                            </div>
                            <!-- number of female students attend event -->
                            <div class="form-outline w-100 m-auto mt-2 mb-3">
                                            <label for="no_of_female_stu_attending" class="form-label">No. of Female students attended event</label>
                                            <input type="number" class="form-control" id="no_of_female_stu_attending" name="no_of_female_stu_attending" required>
                            </div>
                            <!-- number of other student attended event -->
                            <div class="form-outline w-100 m-auto mt-2 mb-3">
                                            <label for="no_of_other_stu_attending" class="form-label">No. of Other students attended event</label>
                                            <input type="number" class="form-control" id="no_of_other_stu_attending" name="no_of_other_stu_attending" required>
                            </div>
                            <div class="form-outline w-100 m-auto mt-2 mb-3">
                                            <label for="event_mode" class="form-label">Event mode</label>
                                            <select name="event_mode"  class="form-select" aria-label="Selct for modes" id="event_mode" onchange="changeMode()" required>
                                                <option value="Online">Online</option>
                                                <option value="Offline">Offline</option>
                                                <option value="Hybrid">Hybrid</option>
                                            </select>
                                </div>
                                <div class="form-outline w-100 m-auto mt-2 mb-3 " id="event_link">
                                    <label for="link_of_event" class="form-label">Event Link</label>
                                    <input class="form-control" type="text" name="link_of_event" id="link_of_event">
                                </div>
                            
                                
                              
                    <!-- </form> -->
                </div>
                <div class="col-lg-6 col-md-6 m-auto fw-bold mt-3">
                    <!-- <p>Hello</p> -->
                    <!-- <form action=""> -->
                        <!-- number of male staff attended event  -->
                    <div class="form-outline w-100 m-auto mt-2 mb-3">
                                            <label for="no_of_male_faculty_attending" class="form-label">No. of faculty Male Staff attended event</label>
                                            <input type="number" class="form-control" id="no_of_male_faculty_attending" name="no_of_male_faculty_attending" required>
                            </div>
                            <!-- number of female staff attended event -->
                            <div class="form-outline w-100 m-auto mt-2 mb-3">
                                            <label for="no_of_female_faculty_attending" class="form-label">No. of faculty Female Staff attended event</label>
                                            <input type="number" class="form-control" id="no_of_female_faculty_attending" name="no_of_female_faculty_attending" required>
                            </div>
                             
                    <!-- description of event impact / outcome -->
                            <div class="form-outline w-100 m-auto mt-2 mb-3">
                                            <label for="event_impact" class="form-label">Event impact/outcome</label>
                                            <textarea class="form-control" id="event_impact" name="event_impact" rows="2" required></textarea>
                            </div>
                            <div class="form-outline w-100 m-auto mt-2 mb-3">
                                            <label for="hof_name" class="form-label">Head of the Department Name</label>
                                            <input class="form-control" id="hod_name" name="hod_name"  required />
                            </div>
                          
                        
                        
                
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Preview Image 1</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <img src=""  class="img-fluid" alt="UPLOAD IMAGE 1" id="preview1Image1">
      </div>
     
    </div>
  </div>
</div>


                
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel2">Preview Image 1</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <img src="" class="img-fluid" alt="UPLOAD IMAGE 1"  id="preview1Image2">
      </div>
     
    </div>
  </div>
</div>

                            

                            <small class="form-text text-muted">Please upload event photo with event name.</small>
                            <p class=" text-danger " style="text-decoration:underline">
                                GeoTagged images are only allowed.
                            </p>
                             <!-- upload event pic 1 -->
                            <div class="form-outline w-100 m-auto mt-2 mb-3">
                                <label for="event_pic_first" class="form-label" >Upload event photo : </label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="event_pic_first" id="event_pic_first" required>
                                    <input type="text" name="base64Image1" id="base64Image1" class="d-none">
                                    <button type="button" class=" mx-1 px-3 dropdown-toggle btn fw-bold" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        View
                                    </button>
                                </div>
                            </div>

                            <!-- upload event pic 2 -->

                            <div class="form-outline w-100 m-auto mt-2 mb-3">
                                <label for="event_pic_second" class="form-label" >Upload event photo : </label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="event_pic_second" id="event_pic_second" required>
                                    <input type="text" name="base64Image2" id="base64Image2" class="d-none">
                                    <button type="button" class=" mx-1 px-3 dropdown-toggle btn fw-bold" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                        View
                                    </button>
                                </div>
                            </div>


                           
                            <div class=' mt-3'>
                                <input type='submit' id='close_event' name='close_event' value='Submit' 
                                    class='btn btn-primary px-3 mb-3' >
                            </div>
                    
                </div>
                
            </div>
            </form>
           
                    <!-- <div class="container-fluid"> -->
                            <!-- <input type="text" id="user_email" value="<?php //echo($user_email);?>" style="display:none;" readonly> -->
                    <!-- <img src="https://img.freepik.com/free-vector/appointment-booking-with-woman-calendar_23-2148559014.jpg?w=1060&t=st=1684132939~exp=1684133539~hmac=d2101dc2baf34866ceb2d3eabe252bb481424284e4e6adc90f6765677ba3ae4e" alt="" class="img-fluid"> -->
               
                                         
    <script src="../../js/closeevent.js"></script>
</body>
</html>

<?php
            mysqli_close($con);
          ?>
         