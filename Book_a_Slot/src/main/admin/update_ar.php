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
    <title>Document</title>
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
<!-- to update data -->
<?php
if(isset($_POST['no'])){
    header('location:./admin_home.php?update_ar');
}

if(isset($_POST['update_ar'])){
    $ar_name=$_POST['ar_name_original'];
    $floor=$_POST['floor_original'];
    $capacity=$_POST['capacity_original'];
    $sql="UPDATE `AUDI_ROOM` set floor='$floor',capacity='$capacity' where ar_name='$ar_name' ";
    $result=mysqli_query($con,$sql);
              if($result){
                header("location:./admin_home.php?update_ar");
              }
              else{
                echo "<p class='text-aign'>Data Is Not updated Successfully ";
              } 
}

?>
<body class=' text-center w-50 m-auto'>
    <div class="con1 mt-3 ">
    <h1 class='text-center text-primary'>Update Auditorium or Room</h1>
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
        while($row=mysqli_fetch_assoc($result)){
            $ar_name=$row['ar_name'];
            $floor=$row['floor'];
            $capacity=$row['capacity'];
            echo"
            <tr class='text-center text-light'><td><a class='text-light' style='text-decoration:none' data_id='$ar_name'
             onclick='confirmupdate(this)' data_floor='$floor' data_capacity='$capacity'
            type='button' class='text-light' data-toggle='modal'  data-target='#update_ar'>
             $ar_name</td>
            <td><a class='text-light' style='text-decoration:none' data_floor='$floor' data_id='$ar_name' data_capacity='$capacity' onclick='confirmupdate(this)'
            type='button' class='text-light' data-toggle='modal'  data-target='#update_ar'> $floor</td>
            <td><a class='text-light' style='text-decoration:none' data_floor='$floor' data_capacity='$capacity' data_id='$ar_name' onclick='confirmupdate(this)'
            type='button' class='text-light' data-toggle='modal'  data-target='#update_ar'> $capacity</td>
            </tr>";

            }
            ?>
        </tbody>    
    </table>
    </div>
    <script>
         function confirmupdate(self){
    var ar_name_original=self.getAttribute("data_id");
    var floor_original=self.getAttribute("data_floor");
    var capacity_original=self.getAttribute("data_capacity");
    document.getElementById("form_data").ar_name_original.value=ar_name_original;
    document.getElementById("form_data").floor_original.value=floor_original;
    document.getElementById("form_data").capacity_original.value=capacity_original;
    $('#update_dept').modal('show');
  }
    </script>
    <!-- modal -->
    <div class="modal fade" id="update_ar" tabindex="-1" role="dialog" aria-labelledby="update_ar" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <h3 class="text-center my-3 text-primary">Update Auditorium or Room Details</h3>
    <form action="update_ar.php" method="POST" id="form_data">
      <div class="modal-body">
      <div class="form-outline w-100 m-auto">
                    <label for="ar_name" id="ar_name" class="form-label fw-bold">Do Update for Audi/Room Name</label>
                    <input type="text" id="ar_name_original" name="ar_name_original" readonly class="form-control">
                </div>
                <div class="form-outline w-100 m-auto">
                    <label for="floor" id="floor" class="form-label fw-bold">Floor</label>
                    <input type="text" id="floor_original" name="floor_original"  class="form-control">
                </div>  
                <div class="form-outline w-100 m-auto">
                    <label for="capacity_original" id="capacity_original" class="form-label fw-bold">Capacity</label>
                    <input type="text" id="capacity_original" name="capacity_original" class="form-control" >
                </div> 
                          
      </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-secondary" name='no'>close</button>
        <button type="submit" class="btn btn-primary" name='update_ar'>
        UPDATE</button>
    </div>
    </form> 
    
    </div>
  </div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js" integrity="sha512-5SUkiwmm+0AiJEaCiS5nu/ZKPodeuInbQ7CiSrSnUHe11dJpQ8o4J1DU/rw4gxk/O+WBpGYAZbb8e17CDEoESw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
<script>
</script>
</body>
</html>