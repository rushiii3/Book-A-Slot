<!DOCTYPE html>
<html lang="en">

<head>

<meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />
    <title>Select View</title>
</head>

<body>
    <?php
     include("../config/session.php");
     require "../connection/connect.php";
     require_once("../loader.html");
     if($user_type=="p")
  {
  }else{
    echo("<script>window.location='../user/sign_in.php';</script>");
  }
    ?>
    <main id="main">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <?php
        include("navigation.html");
        ?>
        <div class="container mt-5 mb-5 shadow p-3 mb-5 bg-body" style="border-radius: 20px;width:90%;">
            <div class="row p-3">
                <div class="col-lg-12">
                    <p class="h1 text-center">View By Date</p>
                </div>
                <div class="p-1 col-lg-6">
                    <div class="mb-5 mt-5 input-group">
                        <label for="selectDate" class="form-label w-100">Date</label><br>
                        <input type="text" class="form-control rounded-start border-end-0" id="selectDate"
                            placeholder="e.g. ....... ">
                        <span class="input-group-text bg-white" id="basic-addon1"><i
                                class="bi bi-calendar-event"></i></span>
                    </div>
                    <div class="mb-5 mt-5">
                        <label for="full_name" class="form-label">Select Venue</label>
                        <select name="Venue_name" class="form-select" id="Venue_name" required>
                            <option selected>Select Venue</option>
                            <?php
                                $get_audi_room_query = "SELECT * FROM AUDI_ROOM";
                                $result_of_audi_room_query = mysqli_query($con, $get_audi_room_query);
                                if (mysqli_num_rows($result_of_audi_room_query) > 0) {
                                    while ($row_of_audi_room_query = mysqli_fetch_assoc($result_of_audi_room_query)) {
                            ?>
                            <option value="<?php echo ($row_of_audi_room_query['ar_name']); ?>">
                                <?php echo ($row_of_audi_room_query['ar_name']); ?>
                            </option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-5 mt-5">
                        <button type="submit" name="submit" id="submit" class="btn btn-primary px-5 py-2 ms-5 mt-3">
                            Submit
                        </button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="container-fluid mb-2">
                        <div class="row border border-dark-subtle">
                            <div class="col-12 p-2 border-bottom border-dark-subtle">
                                <span class="fw-bold" id="showDay">Day</span>
                                <span class="fw-bold" style="float:right;" id="showDate">Date</span>
                            </div>
                            <div style="overflow:auto;height:25rem;" id="dayList">
                                <div class="col-12 mt-5 text-center">
                                    Select Date and Venue first
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </main>
    <script src="../../js/view_date2.js"></script>
</body>

</html>

<?php
mysqli_close($con);
?>