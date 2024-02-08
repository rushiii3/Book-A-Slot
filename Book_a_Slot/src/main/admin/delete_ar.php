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
<?php
//to delete record
if(isset($_POST['no'])){
  header('location:./admin_home.php?delete_ar');
}

  if(isset($_POST['delete_id'])){
    $ar_name=$_POST['ar_name'];
    $delete_ar="delete from `AUDI_ROOM` where ar_name='$ar_name'";
    $result=mysqli_query($con,$delete_ar);
    if($result){
        header('location:./admin_home.php?delete_ar');
    }
    else{
        die(mysqli_error($con));
    }
  }
  ?> 
<body class=' text-center w-50 m-auto'>
    <div class="con1 mt-3 ">
    <h1 class='text-center text-primary'>Delete Auditorium Or Room</h1>
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
            <tr class='text-center text-light'>
            <td><a  style='text-decoration:none' data_id='$ar_name' type='button' onclick='confirmdelete(this)'
            class='btn btn-primary text-light' data-toggle='modal' data-target='#exampleModalCenter'>$ar_name</td>
            <td><a  style='text-decoration:none'  type='button' data_id='$ar_name' onclick='confirmdelete(this)'
            class='btn btn-primary text-light' data-toggle='modal' data-target='#exampleModalCenter'>$floor</td>
            <td><a  style='text-decoration:none' data_id='$ar_name' type='button' onclick='confirmdelete(this)'
            class='btn btn-primary text-light' data-toggle='modal' data-target='#exampleModalCenter'>$capacity</td>
            </tr>";}
            ?>
        </tbody>    
        
    </table>
    </div>
   
<script>
function confirmdelete(self){
  var ar_name=self.getAttribute('data_id');
  document.getElementById('form_data').ar_name.value=ar_name;
  $('#exampleModalCenter').modal('show');
}
</script>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
     <form action="delete_ar.php" method='post' id='form_data'>
      <div class="modal-body">
       <h4>Are you sure you want to delete this?</h4>
       <input type="hidden" name="ar_name">
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