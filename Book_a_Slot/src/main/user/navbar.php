<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .nav-link:hover {
            background-color: rgba(0, 77, 255, 0.5);
            border-radius: 20px;
            color: white;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid p-1">
            <a class="navbar-brand text-primary ms-3 fw-bolder" href="home.php">GACbooker</a>
            <button class="navbar-toggler" type="button"  aria-label="Show Nav"  name="showNav" id="showNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse p-3" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link mx-1 px-3 fw-bold" aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link mx-1 px-3 dropdown-toggle fw-bold" href="#" id="DropDown">
                            View
                        </a>
                        <ul class="dropdown-menu bg-light" id="DropDownMenu">
                            <li><a class="dropdown-item nav-link mx-1 px-3 fw-bold" href="list.php">List</a></li>
                            <li><a class="dropdown-item nav-link mx-1 px-3 fw-bold" href="view_bydate.php">Date</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-1 px-3 fw-bold" href="booking.php">Book Slot</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-1 px-3 fw-bold" href="<?php if($user_type=="o" || $user_type=="a")
  {
    echo"status.php";
  }else{
    echo"status_outsider.php";
  } ?>">Check Status</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-1 px-3 fw-bold" href="cancel.php">Cancel Slot</a>
                    </li>
                    <?php
                        if( $user_type=="a")
                        {
                          echo'<li class="nav-item">
                          <a class="nav-link mx-1 px-3 fw-bold" href="../admin/admin_home.php">Back To Admin</a>
                      </li>';
                        }
                        if( $user_type=="i")
                        {
                          echo'<li class="nav-item">
                          <a class="nav-link mx-1 px-3 fw-bold" href="../iqacc/home.php">Back To IQAC</a>
                      </li>';
                        }
                    ?>
                    
                    <li class="nav-item">
                        <a class="nav-link mx-1 px-3 fw-bold" id="logout" href="../config/logout.php" style="background-color: rgba(0,77,255,0.5);border-radius: 20px;color: white;">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script>
        $('#showNav').on('click', function () {
            $('#navbarSupportedContent').toggle(300);
        });
        $('#DropDown').on('click', function () {
            $('#DropDownMenu').toggle(300);
        });
    </script>
</body>
</html>