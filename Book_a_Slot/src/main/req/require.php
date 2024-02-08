<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">

  <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <title>Requirements</title>
  <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />
</head>
<body>
  <?php
    require("../config/session.php");
    require_once("../loader.html");
    require "../connection/connect.php";
    if($user_type=="r")
  {
  }else{
    echo("<script>window.location='../user/sign_in.php';</script>");
  }
  ?>
  
  <main id="main">
    <?php
      include("navigation.html");
    ?>
    <div class="w-100 d-flex justify-content-between align-items-center mt-3">
    <button class="btn" id="backward_date"><i class="bi bi-caret-left-fill fa-10x" style="font-size: 1rem;font-size: clamp(2rem, 3.5vw, 6rem);"></i></button>
    <span style="font-size: 1rem;font-size: clamp(1.5rem, 3vw, 5rem);" id="set_date"></span>
    <button class="btn" id="forward_date"><i class="bi bi-caret-right-fill fa-10x" style="font-size: 1rem;font-size: clamp(2rem, 3.5vw, 6rem);"></i></button>
    </div>

    <div class="container">
        <div class="row mt-5" id="innerReq">

        </div>
    </div>
    
  </main>
  <script src="../../js/require.js"></script>
</body>
</html>
