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
<?php
if(isset($_POST['update_dept'])){
  $department_name=$_POST['department_name_original'];
    $dept=$_POST['department_name_new'];
    if($dept==''){
      $sql="UPDATE `DEPARTMENT` set department_name='$department_name' where department_name='$department_name' ";
      $result=mysqli_query($con,$sql);
      if($result){
        //echo "<p class='text-aign'>Data updated Successfully ";
        header("location:./admin_home.php?update_dept");
      }
      else{
        echo "<p class='text-aign'>Data Is Not updated Successfully ";
        header("location:./admin_home.php?update_dept");
      }

    }
    else{
    $sql="UPDATE `DEPARTMENT` set department_name='$dept' where department_name='$department_name' ";
      $result=mysqli_query($con,$sql);
      if($result){
        //echo "<p class='text-aign'>Data updated Successfully ";
        header("location:./admin_home.php?update_dept");
      }
      else{
        echo "<p class='text-aign'>Data Is Not updated Successfully ";
        header("location:./admin_home.php?update_dept");
      }}
}
if(isset($_POST['no'])){
    header('location:./admin_home.php?update_dept');
}
?>
<body class=' text-center w-50 m-auto'>
    <div class="con1 mt-3 ">
    <h1 class='text-center text-primary'>Update Department</h1>
    <div class="table-responsive-sm col-lg-10 col-sm-12">
    <table  class='table table-bordered my-4' style="align-items:center">
    <thread class="bg-light">
        <tr >
        <th class="text-center"> Sr. No</th>
           <th class="text-center"> DEPARTMENT NAMES</th>
           <th class="text-center"> STREAM</th>
           <th class="text-center"> ACADEMIC</th>
        </tr>
        </thread> 
    <tbody class="bg-primary">
    <?php
        $get_dept="select * from `DEPARTMENT` ";
        $result=mysqli_query($con,$get_dept);
        $number=0;
        while($row=mysqli_fetch_assoc($result)){
            $department_name=$row['department_name'];
            $department_stream=$row['department_stream'];
            $department_acadamics=$row['department_acadamics'];
            $number++;

            echo"
            <tr class='text-center text-light'><td> $number</td>
            <td><a class='text-light' style='text-decoration:none' 
            data_id='$department_name' onclick='confirmupdate(this)' 
            type='button' class='text-light' data-toggle='modal' 
            data-target='#update_dept'> $department_name</td>
            
            <td> $department_stream</td>
            <td> $department_acadamics</td></tr>";
            }
            ?>
        
        </tbody>    
    </table>
    </div>
    </div>
    <?php
    // to update data
    
?>
<script>
  function confirmupdate(self){
    var department_name_original=self.getAttribute("data_id");
    document.getElementById("form_data").department_name_original.value=department_name_original;
    $('#update_dept').modal('show');
  }
</script>
     <!-- Modal -->
<div class="modal fade" id="update_dept" tabindex="-1" role="dialog" aria-labelledby="update_dept" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <h2 class="text-center">Update Department Name</h2>
    <form action="update_dept.php" method="POST" id="form_data">
      <div class="modal-body">
      <div class="form-outline w-100 m-auto">
                    <label for="department_name" id="department_name" class="form-label fw-bold">Old Department Name</label>
                    <input type="text" id="department_name_original" name="department_name_original" readonly class="form-control" placeholder="Enter a depertment name">
                </div> 
                <div class="form-outline w-100 m-auto">
                    <label for="department_name" id="department_name" class="form-label fw-bold">Department Name</label>
                    <input type="text" id="department_name_new" name="department_name_new" class="form-control" placeholder="Enter a depertment name">
                </div>             
      </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-secondary" name='no'>close</button>
        <button type="submit" class="btn btn-primary" name='update_dept'>
        UPDATE</button>
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