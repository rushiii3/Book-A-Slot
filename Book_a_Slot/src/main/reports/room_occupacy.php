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
if($user_type=="a" || $user_type=="i"){
    
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
    <title>Room Occupacy</title>
    <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />

    <style>
        .chartBox{
          width:700px 
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js" integrity="sha512-5SUkiwmm+0AiJEaCiS5nu/ZKPodeuInbQ7CiSrSnUHe11dJpQ8o4J1DU/rw4gxk/O+WBpGYAZbb8e17CDEoESw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</head>
<body>
<div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-10 col-lg-10 m-auto">
            <?php
                include '../admin/admin_navbar.html';
                ?>
            </div>
        </div>
</div>
<?php
// code to count in which audi how many events occur
$get_ar="select ar_name,count(ar_name) as occurance  from `EVENT` where status_value='Approved' group by ar_name order by occurance desc";
$result=mysqli_query($con,$get_ar);
$ar_name=array();
$count_occurance=array();
if($result===false){
    die(mysqli_error($con));
}
while($row=mysqli_fetch_assoc($result)){
   $ar_name[]=$row['ar_name'];//x-axis data
   $count_occurance[]=$row['occurance'];//y-axis data
}
$yLabel='No. of event';//y-axis label
?>

<!-- code to plot graph -->
<div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-10 col-lg-10 m-auto d-flex justify-content-center">
                <div class="chartBox">
                    <h3 class="text-center">Count of events occured in each audi/room</h3>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
</div>
<!-- code for bar graph -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // setup block
    // console.log(<?php echo json_encode($ar_name);?>)
     //console.log(<?php echo json_encode($count_occurance);?>)
    //console.log(<?php echo json_encode($yLabel);?>);
    const ar_name=<?php echo json_encode($ar_name);?>;
    const count_occurance=<?php echo json_encode($count_occurance);?>;
    const yLabel=<?php echo json_encode($yLabel);?>;
    const data={
        labels:ar_name,
        datasets:[{
            label:'count of events occur in each audi/room',
            data:count_occurance,
            backgroundColor:[
                'rgba(54,162,255,0.2)',
            ],
            borderColor:[
                'rgba(54,162,255,1)',
            ],
            borderWidth:1
        }]
    };
    //config part
    const config={
        type:'bar',
        data,
        options:{
            scales:{
                y:{
                    beginAtZero:true,
                    title:{
                        display:true,
                        text:yLabel,
                    },
                    ticks:{
                    font:{
                        size:16, // Set the font size for the y-axis ticks
                    }
                    }
                },
                x:{
                    ticks: {
                    font: {
                    size: 12, // Set the font size for the x-axis labels
                    }
                }
                }
            }
        }
    };
    //Render Block
    const myChart=new Chart(
        document.getElementById('myChart'),
        config
    );
</script>
<?php
//code showing most dense audi's organizer
$max_events_occured="select ar_name as first_ar,count(ar_name) as occurance from `EVENT` where status_value='Approved' group by ar_name order by occurance desc LIMIT 1";
$result=mysqli_query($con,$max_events_occured);
$row=mysqli_fetch_assoc($result);
$first_ar=$row['first_ar'];
$get_organizers="SELECT department_name,COUNT(department_name) as total from `EVENT` JOIN `DEPARTMENT` on DEPARTMENT.department_id=EVENT.dep_id WHERE ar_name='$first_ar' and status_value='Approved' GROUP by DEPARTMENT.department_name";
$result1=mysqli_query($con,$get_organizers);
// while($row=mysqli_fetch_assoc($result1)){
//     echo $row['department_name']," ",$row['total'];
// };
;
while($row=mysqli_fetch_assoc($result1)){
    //echo $row['organization_institute'],$row['total'];
//     $organizer=$row['organization_institute'];
//     $total=$row['total'];
//     echo "<tr class='test-center'>
// <td>$organizer</td>
// <td>$total</td>
// </tr>";
}

?>

<div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-10 col-lg-10 m-auto">
                <div class="row mt-5">
                    
                    <div class="col-md-5 col-lg-5 m-auto">

                     
</body>
<!-- piechart  for maximum audi occurance-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['organizations_institute', 'count'],
          <?php
          $get_organizers="SELECT department_name,COUNT(department_name) as total from `EVENT` JOIN `DEPARTMENT` on DEPARTMENT.department_id=EVENT.dep_id WHERE ar_name='$first_ar' and status_value='Approved' GROUP by DEPARTMENT.department_name";
          $result1=mysqli_query($con,$get_organizers);
            while($row=mysqli_fetch_assoc($result1)){
                echo "['".$row['dep_name']."',".$row['total']."],";
            }
          ?>
        ]);

        var options = {
          title: 'Events organized in <?php echo $first_ar;?>',
          width:700,
          height:600,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

    <!-- piechart for second maximum occurance -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['organizations_institute', 'count'],
          <?php
          $get_organizers="SELECT department_name,COUNT(department_name) as total from `EVENT` JOIN `DEPARTMENT` on DEPARTMENT.department_id=EVENT.dep_id WHERE ar_name='$second_ar' and status_value='Approved' GROUP by DEPARTMENT.department_name";
          $result1=mysqli_query($con,$get_organizers);
            while($row=mysqli_fetch_assoc($result1)){
                echo "['".$row['dep_name']."',".$row['total']."],";
            }
          ?>
         
        ]);

        var options = {
          title: 'Events organized in <?php echo $second_ar;?>',
          width:700,
          height:600,
        };

        var chart = new google.visualization.PieChart(document.getElementById('pie'));

        chart.draw(data, options);
      }
    </script>
</html>