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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@event-calendar/build@0.19.0/event-calendar.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@event-calendar/build@0.19.0/event-calendar.min.js"></script>
    <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />
    <title>List View</title>
</head>

<body>
    <?php
    require "../connection/connect.php";
    require_once("../loader.html");
    if($user_type=="o" || $user_type=="k" || $user_type=="a" || $user_type=="i" )
            {
            }else{
                echo("<script>window.location='../user/sign_in.php';</script>");
            }
    ?>
    <main id="main">
        <?php
        include("navbar.php");
        ?>
        <?php
        if ($_GET['id'] == "") {
            echo ("<script>window.location='list.php';</script>");
        } else {
            $venue_name = $_GET['id'];
        }
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="ec">


                </div>
            </div>
        </div>
        
    </main>
</body>

</html>
<script>
    let ec = new EventCalendar(document.getElementById('ec'), {
        initialDate: new Date(2018, 8, 1),
        headerToolbar: {
            start: 'prev,next today',
            center: 'title',
            end: 'timeGridWeek,timeGridDay,listWeek,'
        },
        slotDuration: '00:15',
        eventStartEditable: false,
        allDaySlot: false,
        slotMinTime: "06:30",
        //initialView: 'listWeek',
        events: [
            <?php
            if($venue_name=="Radhabai Vaze Auditorium"){
                $disableDates = " SELECT * FROM disableDates";
                $result_of_disable_date = mysqli_query($con, $disableDates);
                if(mysqli_num_rows($result_of_disable_date)){
                    while($row_of_disable_date = mysqli_fetch_assoc($result_of_disable_date))
                    {
                        ?>
                     { // this object will be "parsed" into an Event Object
                        title: " <?php echo ($row_of_disable_date['description']); ?> \n ",
                        start: "<?php echo ($row_of_disable_date['datee']); ?> <?php echo ($row_of_disable_date['start_time']); ?>", // a property!
                        end: "<?php echo ($row_of_disable_date['datee']); ?> <?php echo ($row_of_disable_date['end_time']); ?>", // a property! ** see important note below about 'end' **
                        <?php
                        $color_array = Array(
                            '#FF0000', // Red
                            '#0000FF', // Blue
                            '#b5831f',
                            '#5b630d',
                            '#FFA500', // Orange
                            '#800080', // Purple
                            '#1a7009',
                            '#FF00FF', // Magenta
                            '#008080', // Teal
                            '#096670',
                            '#094070',
                            '#A52A2A', // Brown
                            '#808080', // Gray
                            '#000000' // Black
                        );
                        ?>
                        color: " <?php echo ($color_array[array_rand($color_array)]) ?> ",
                        draggable: false,
                    },
                    <?php
                    }
                }
                $event_info_query = "SELECT event_name,event_date,event_start_time,event_end_time,dep_id,status_value FROM `EVENT` WHERE ar_name = '$venue_name' AND status_value in ('Approved','Pending')";
            $result_of_event_info_query = mysqli_query($con, $event_info_query);
            if (mysqli_num_rows($result_of_event_info_query)) {
                while ($row_of_event_info = mysqli_fetch_assoc($result_of_event_info_query)) {
            ?>
                    { // this object will be "parsed" into an Event Object
                        title: " <?php echo ($row_of_event_info['event_name']); ?> \n  <?php
                            $dept_id = $row_of_event_info['dep_id'];
                            $get_dept_name = "SELECT * FROM DEPARTMENT WHERE department_id = '$dept_id'";
                            $result_of_dep = mysqli_query($con,$get_dept_name);
                            if(mysqli_num_rows($result_of_dep)>0)
                            {
                                while($row = mysqli_fetch_assoc($result_of_dep))
                                {
                                    echo($row['department_acadamics']);
                                    echo(" ");
                                    echo($row['department_name']);
                                }
                            }
                             ?>\n <?php echo ($row_of_event_info['status_value']); ?>",
                        start: "<?php echo ($row_of_event_info['event_date']); ?> <?php echo ($row_of_event_info['event_start_time']); ?>", // a property!
                        end: "<?php echo ($row_of_event_info['event_date']); ?> <?php echo ($row_of_event_info['event_end_time']); ?>", // a property! ** see important note below about 'end' **
                        <?php
                        $color_array = Array(
                            '#FF0000', // Red
                            '#0000FF', // Blue
                            '#b5831f',
                            '#5b630d',
                            '#FFA500', // Orange
                            '#800080', // Purple
                            '#1a7009',
                            '#FF00FF', // Magenta
                            '#008080', // Teal
                            '#096670',
                            '#094070',
                            '#A52A2A', // Brown
                            '#808080', // Gray
                            '#000000' // Black
                        );
                        ?>
                        color: " <?php echo ($color_array[array_rand($color_array)]) ?> ",
                        draggable: false,
                    },
            <?php
                }
            }
            
            }else{
                $event_info_query = "SELECT * FROM `EVENT` WHERE ar_name = '$venue_name' AND status_value in ('Approved','Pending') ";
            $result_of_event_info_query = mysqli_query($con, $event_info_query);
            if (mysqli_num_rows($result_of_event_info_query)) {
                while ($row_of_event_info = mysqli_fetch_assoc($result_of_event_info_query)) {
            ?>
                    { // this object will be "parsed" into an Event Object
                        title: "<?php echo ($row_of_event_info['event_name']); ?> \n  <?php
                            $dept_id = $row_of_event_info['dep_id'];
                            $get_dept_name = "SELECT * FROM DEPARTMENT WHERE department_id = '$dept_id'";
                            $result_of_dep = mysqli_query($con,$get_dept_name);
                            if(mysqli_num_rows($result_of_dep)>0)
                            {
                                while($row = mysqli_fetch_assoc($result_of_dep))
                                {
                                    echo($row['department_acadamics']);
                                    echo(" ");
                                    echo($row['department_name']);
                                }
                            }
                             ?> \n <?php echo ($row_of_event_info['status_value']); ?>", // a property!
                        start: "<?php echo ($row_of_event_info['event_date']); ?> <?php echo ($row_of_event_info['event_start_time']); ?>", // a property!
                        end: "<?php echo ($row_of_event_info['event_date']); ?> <?php echo ($row_of_event_info['event_end_time']); ?>", // a property! ** see important note below about 'end' **
                        <?php
                        $color_array = Array(
                            '#FF0000', // Red
                            '#0000FF', // Blue
                            '#b5831f',
                            '#5b630d',
                            '#FFA500', // Orange
                            '#800080', // Purple
                            '#1a7009',
                            '#FF00FF', // Magenta
                            '#008080', // Teal
                            '#096670',
                            '#094070',
                            '#A52A2A', // Brown
                            '#808080', // Gray
                            '#000000' // Black
                        );
                        ?>
                        color: " <?php echo ($color_array[array_rand($color_array)]) ?> ",
                        draggable: false,
                    },
            <?php
                }
            }
            }
            ?>
        ],
    });

    $('.ec-timeGridWeek').click();
</script>

<?php
mysqli_close($con);
?>