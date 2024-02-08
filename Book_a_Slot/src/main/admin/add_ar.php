<?php
session_start();
if(!isset($_SESSION["user_email"]) )
{
  echo("<script>window.location='../user/sign_in.php';</script>");
}
else{
  $user_email = $_SESSION["user_email"];
  $user_name = $_SESSION["user_full_name"];
  $user_type = $_SESSION["user_type"];
}
if($user_type=="a"){
    
}else{
      echo("<script>window.location='../user/sign_in.php';</script>");

}
include '../connection/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Audi Room</title>
    <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <style>
       
    .con1{
        display: grid;
        place-items: center;
    }
        </style>
</head>
<?php
   
if(isset($_POST['add_ar'])){
    $ar_name=$_POST['ar_name'];
    $floor=$_POST['floor'];
    $capacity=$_POST['capacity'];
    if($ar_name=='' or $capacity=='' or $floor==''){
        echo "<script>alert('Please fill the field first')</script>";
        echo("<script>window.location='admin_home.php?add_ar';</script>");
    }
    else{
    $add_ar="Insert into `AUDI_ROOM`(ar_name,floor,capacity) value('$ar_name','$floor',$capacity)";
    $result=mysqli_query($con,$add_ar);
    if($result){
        header('location:./admin_home.php?add_ar');
    }
    else{
        die(mysqli_error($con));
    }
}
}
?>
<body class='text-center w-50 m-auto'>
    <!-- <div class="container-fluid text-center m-auto">
        <div class="row">
            <div class="col-md-8 col-lg-6 mb-4 "> -->
    <div class="con1 mt-3 ">
    <h1 class='text-center text-primary'>Add New Auditorium And Room Information</h1>
    <table  class='table table-bordered my-4' style="align-items:center">
    <thread class="bg-info">
        <tr >
        <th class="text-center">AR Name</th>
           <th class="text-center"> Floor No.</th>
           <th class='text-center '>Capacity</th>
        </tr>
        </thread> 
    <tbody class="bg-primary">
        <?php
        $get_ar="select * from `AUDI_ROOM` ";
        $result=mysqli_query($con,$get_ar);
        $number=0;
        while($row=mysqli_fetch_assoc($result)){
            $ar_name=$row['ar_name'];
            $floor=$row['floor'];
            $capacity=$row['capacity'];
            echo"
            <tr class='text-center text-light'><td>$ar_name</td>
            <td class='text-center text-light'>$floor</td>
            <td class='text-center text-light'>$capacity</td></tr>";
            }
            ?>
        </tbody>    
    </table>
    <div class="mt-2">
    <a  style='text-decoration:none'  type='button' class='text-light' data-toggle='modal' data-target='#adddar' >
    <input type="submit" name="add_ar" value="ADD" class="btn btn-primary px-3 mb-3"></a>

     </div>          
    </div>
  <!-- Modal -->
<div class="modal fade" id="adddar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <h2 class="text-center">Add New Auditorium Or Room</h2>
    <form action="add_ar.php" method="POST">
      <div class="modal-body">
                <div class="form-outline w-100 m-auto">
                    <label for="ar_name " class="form-label fw-bold">Auditorium Or Room  Name</label>
                    <input type="text" id="ar_name" name="ar_name" class="form-control" placeholder="eg. Mini Audi">
                </div>
                <div class="form-outline w-100 m-auto">
                    <label for="floor" class="form-label fw-bold">Floor </label>
                    <input type="text" id="floor" name="floor" class="form-control" placeholder="eg. 1st">
                </div>
                <div class="form-outline w-100 m-auto">
                    <label for="capacity" class="form-label fw-bold">Capacity</label>
                    <input type="text" id="capacity" name="capacity" class="form-control" placeholder="eg. 150">
                </div>             
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" >close</button>
        <button type="submit" class="btn btn-primary" name='add_ar'>
        ADD DATA</button>
      </div>
      </form> 
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js" integrity="sha512-5SUkiwmm+0AiJEaCiS5nu/ZKPodeuInbQ7CiSrSnUHe11dJpQ8o4J1DU/rw4gxk/O+WBpGYAZbb8e17CDEoESw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
</body>
</html>