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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>List</title>
    <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />
    <style>
        #card:hover {
            transform: translateY(-30px);
        }
    </style>
</head>

<body>
    <?php
    require "../connection/connect.php";
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
        <div class="container">
            <div class="row p-4">
                <div class="col-lg-12 mb-5">
                    <p class="h3 text-center">Click to see the booked slot</p>
                </div>
                <?php
                $audi_room_info_query = "SELECT * FROM AUDI_ROOM";
                $result_of_audi_room_query = mysqli_query($con, $audi_room_info_query);
                if (mysqli_num_rows($result_of_audi_room_query) > 0) {
                    while ($row_audi_room_info = mysqli_fetch_assoc($result_of_audi_room_query)) {
                        ?>
                        <div class="col-lg-4 mb-5">
                            <div class="card mx-auto shadow w-75" id="card" style="border-radius:20px;">
                                <a href="list_view.php?id=<?php echo ($row_audi_room_info['ar_name']); ?>"
                                    style="text-decoration:none;">
                                    <div class="card-body text-center text-black">
                                        <?php
                                        $img_array = Array(
                                            "../../img/14.png",
                                            "../../img/15.png",
                                            "../../img/16.png",
                                            "../../img/17.png",
                                            "../../img/18.png",
                                            "../../img/19.png",
                                            "../../img/20.png"
                                        );
                                        ?>
                                        <img src="<?php echo ($img_array[array_rand($img_array)]) ?>"
                                            class="my-3" alt="Location_image"
                                            style="height:5rem;width:5rem;">
                                        <h5 class="card-title my-4"><?php echo ($row_audi_room_info['ar_name']); ?></h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div> 
    </main>
</body>

</html>
<?php
mysqli_close($con);
?>