<?php
require("../config/session.php");
?>
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
  
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
  
  <title>Home</title>
  <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />
  
  <style>
    .fs-1 {
      font-family: 'Abril Fatface', cursive;
    }
    
    @media (min-width: 768px) {
      .user_welcome {
        height: 80vh;
      }
      
      .fs-1 {
        margin-top: 30%;
        overflow-wrap: break-word;
      }
    }
    
    @media (min-width: 0px) {
      .user_welcome {
        height: 50vh;
      }
      
      .fs-1 {
        margin-top: 30%;
        overflow-wrap: break-word;
      }
    }
  </style>
</head>
<body>
  <?php
   
    require_once("../loader.html");
   
  ?>
  
  <main id="main">
    <?php
      include("navigation.html");
    ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-1 user_welcome">
          <p class="fs-1 fw-bold p-2">Welcome <br/> <?php echo($user_name); ?></p>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
          <img src="../../img/s (2).png" alt="Welcome_Img" style="height: 100%; width: 100%;">
        </div>
      </div>
    </div>
    
  </main>
</body>
</html>
