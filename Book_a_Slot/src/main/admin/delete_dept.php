
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
    <title>DELETE</title>
    <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- javascript for message box -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
       
    .con1{
        display: grid;
        place-items: center;
    }
        </style>
</head>
<!-- to delete record -->
<?php
if(isset($_POST['no'])){
    header('location:./admin_home.php?delete_dept');
}
?>
<?php

  if(isset($_POST['delete_id'])){
    $department_name=$_POST['department_name'];
    $delete_dept="delete from `DEPARTMENT` where department_name='$department_name'";
    $result=mysqli_query($con,$delete_dept);
    if($result){
        header('location:./admin_home.php?delete_dept');
    }
    else{
        die(mysqli_error($con));
    }
  }
  ?>
<body class=' text-center w-50 m-auto'>
    <div class="con1 mt-3 ">
    <h1 class='text-center text-primary'>Delete Department</h1>
    <div class="table-responsive-sm col-lg-10 col-sm-12">
    <table  class='table table-bordered my-4' style="align-items:center">
    <thread class="bg-info">
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
            <td><a   style='text-decoration:none' data_id='$department_name' 
            type='button' class='btn btn-primary text-light' data-toggle='modal' data-target='#exampleModalCenter' 
            onclick='confirmdelete(this)'>
             $department_name</td>
            <td class='text-light'> $department_stream</td>
            <td class='text-light'> $department_acadamics</td></tr>";
            }
            ?>
            
       
        </tbody>    
        
    </table>
    </div>
    </div>
<script>
    function confirmdelete(self){
        var department_name=self.getAttribute("data_id");
        document.getElementById("form_data").department_name.value=department_name;
        $('#exampleModalCenter').modal('show');
    }
        </script>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
     <form action="delete_dept.php" method="post" id="form_data">
      <div class="modal-body">
       <h4>Are you sure you want to delete this?</h4>
       <input type="hidden" name="department_name">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-secondary" name='no' >No</button>
        <button type="submit" class="btn btn-primary" name='delete_id'>
        <a  style='text-decoration:none'  class='text-light text-decoration-none' >
        Yes<a></button>
      </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>