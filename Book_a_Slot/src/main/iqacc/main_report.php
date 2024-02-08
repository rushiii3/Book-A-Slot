<?php
require("../config/session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Event Details</title>
    <link type="image/png" sizes="16x16" rel="icon" href="../../img/logo11.jpeg" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script
			src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
			integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"
		></script>

</head>

<body>
<?php
        include("navigation.html");
        ?>
<?php
include "../connection/connect.php";
if(isset($_GET['id'])){

    $id=$_GET['id'];

    // $event_date = date('Y-m-d', strtotime($_GET["date"]));    
    // event.event_id = resource_person.event_id AND ///, `resource_person`
    $close_event_info = "SELECT * FROM `DEPARTMENT`,`CLOSE_EVENT`,`EVENT` WHERE  EVENT.event_id = CLOSE_EVENT.event_id AND EVENT.dep_id = DEPARTMENT.department_id AND EVENT.event_id = '$id'    ";
    $result=mysqli_query($con,$close_event_info);

    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            ?>
             <div class="col-lg-8 col-md-8 mb-5 m-auto" >
                            <div class="card shadow p-1" style="width: auto;border-radius: 20px;">
                                <div class="card-body" >
                                    <h4 class="card-title">Event Name : <?php echo ($row['event_name']);  ?></h4>
                                    <div class="badge p-1 mb-2">
                                      
                                    </div>
                                    <p class="card-text " style="text-align:justify;"> <span class="fw-bold">Department: </span> <?php echo ($row['department_name']); ?> </p>
                                    <p class="card-text " style="text-align:justify;"> <span class="fw-bold">Description : </span> <?php echo ($row['event_description']); ?> </p>
                                    <p class="card-text " style="text-align:justify;"> <span class="fw-bold">HOD Name : </span> <?php echo ($row['hod_name']); ?> </p>

                                    <p class="card-text "> <span class="fw-bold">Date : </span> <?php echo date("d M Y", strtotime($row['event_date'])); ?> </p>
                                    <p class="card-text "> <span class="fw-bold">Time : </span> <?php echo date("g:i A", strtotime($row['event_start_time'])); ?> to <?php echo date("g:i A", strtotime($row['event_end_time'])); ?> </p>
                                    <p class="card-text "> <span class="fw-bold">Venue : </span> <?php echo ($row['ar_name']); ?> </p>
                                    <p class="card-text "> <span class="fw-bold">Activities: </span> <?php echo ($row['close_event_activities']); ?> </p>
                                    <p class="card-text "> <span class="fw-bold">Purpose: </span> <?php echo ($row['close_event_purpose']); ?> </p>

                                    <p class="card-text "> <span class="fw-bold">Resource Person: </span>
                                    


                                    <?php
                                                        $event_id = $row['event_id'];
                                                        $get_resource_person_info = "SELECT * FROM `RESOURCE_PERSON` WHERE event_id = '$event_id' ";
                                                        $result_of_resource_person = mysqli_query($con,$get_resource_person_info);
                                                        if(mysqli_num_rows($result_of_resource_person)>0)
                                                        {
                                                            while($row_of_details = mysqli_fetch_assoc($result_of_resource_person))
                                                            {
                                                                echo($row_of_details["full_name"].', '); 
                                                            }
                                                        }
                                                ?> 
                                    
                                   
                                
                                
                                
                                
                                </p>


                                    <p class="card-text " style="text-align:justify;"> <span class="fw-bold">Event Mode: </span> <?php echo ($row['close_event_mode']); ?> </p>
                                   
                                    <?php
                                    if($row['close_event_mode']=='Online' || $row['close_event_mode']=='Hybrid'){
                                    $online_link=$row['close_event_link'];
                                    echo "<p class='card-text ' style='text-align:justify;'> <span class='fw-bold'>Event Mode: </span> ($online_link) </p>";

                                    }
                                    ?>

                                    <p class="card-text "> <span class="fw-bold">Boys Attendance: </span> <strong><?php echo ($row['male_students_count']); ?> </strong></p>
                                    <p class="card-text "> <span class="fw-bold">Girls Attendance: </span><strong> <?php echo ($row['female_students_count']); ?> </strong></p>
                                    <p class="card-text "> <span class="fw-bold">Others Attendance: </span><strong> <?php echo ($row['other_students_count']); ?> </strong></p>
                                    <p class="card-text "> <span class="fw-bold">Male Faculty Attendance: </span> <strong><?php echo ($row['faculty_members_male_count']); ?></strong> </p>
                                    <p class="card-text "> <span class="fw-bold">Female Faculty Attendance: </span> <strong><?php echo ($row['faculty_members_female_count']); ?></strong> </p>

                                    <p class="card-text "> <span class="fw-bold">Impact: </span> <?php echo ($row['close_event_impact']); ?> </p>
                                    <div class="row mt-4"><p class="card-text "> <span class="fw-bold">Event Images: </span> </p>
                                    <div class="col-lg-12 my-4"><img  src="<?php echo($row['event_pic1'])?>" alt="" class="img-fluid"></div>
                                    <div class="col-lg-12 mt-4"><img src="<?php echo($row['event_pic2'])?>" alt="" class="img-fluid"></div>
                                    </div>
                
                                    <!-- <button id="download-button">Download as PDF</button> -->
                                </div>
                                <div id="tableToDownload" class="d-none">
                                <table class="table table-bordered border-black" >
                                   
                                    <thead>
                                        <tr>
                                            <th scope="col" colspan="2" class="text-center "> Report</th>
                                       
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Event Name</th>
                                            <td><?php echo ($row['event_name']); ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Department</th>
                                            <td><?php echo ($row['department_name']); ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Description</th>
                                            <td><?php echo ($row['event_description']); ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">HOD Name</th>
                                            <td> <?php echo ($row['hod_name']); ?> </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Date</th>
                                            <td><?php echo date("d M Y", strtotime($row['event_date'])); ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Time</th>
                                            <td><?php echo date("g:i A", strtotime($row['event_start_time'])); ?> to <?php echo date("g:i A", strtotime($row['event_end_time'])); ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Venue</th>
                                            <td> <?php echo ($row['ar_name']); ?> </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Activities</th>
                                            <td>  <?php echo ($row['close_event_activities']); ?> </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Purpose</th>
                                            <td> <?php echo ($row['close_event_purpose']); ?> </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Resource Person </th>
                                            <td>
                                                <?php
                                                        $event_id = $row['event_id'];
                                                        $get_resource_person_info = "SELECT * FROM `RESOURCE_PERSON` WHERE event_id = '$event_id' ";
                                                        $result_of_resource_person = mysqli_query($con,$get_resource_person_info);
                                                        if(mysqli_num_rows($result_of_resource_person)>0)
                                                        {
                                                            while($row_of_details = mysqli_fetch_assoc($result_of_resource_person))
                                                            {
                                                                echo($row_of_details["full_name"].', '); 
                                                            }
                                                        }
                                                ?>  
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Event Mode</th>
                                            <td>  <?php echo ($row['close_event_mode']); ?> </td>
                                        </tr>
                                        <?php
                                            if($row['close_event_mode']=='Online' || $row['close_event_mode']=='Hybrid'){
                                            ?>
                                                <tr>
                                                    <th scope="row">Event Link</th>
                                                    <td> <?php echo ($row['close_event_link']); ?> </td>
                                                </tr>
                                            <?php
                                            }
                                        ?>

                                        <tr>
                                            <th scope="row">Boys Attendance</th>
                                            <td> <?php echo ($row['male_students_count']); ?> </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Girls Attendance </th>
                                            <td>  <?php echo ($row['female_students_count']); ?>  </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Others Attendance</th>
                                            <td>  <?php echo ($row['other_students_count']); ?> </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Male Faculty Attendance</th>
                                            <td><?php echo ($row['faculty_members_male_count']); ?> </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Female Faculty Attendance</th>
                                            <td><?php echo ($row['faculty_members_female_count']); ?> </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Impact</th>
                                            <td>  <?php echo ($row['close_event_impact']); ?> 
                                           
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <th scope="row">Event Image 1 </th>
                                           
                                           
                                            <td> <img  src="https://vazecollege.net/Book_a_Slot/src/main<?php echo substr($row['event_pic1'],2);?>" alt="EVENT IMAGE 1" class="img-fluid"> </td>
                                        </tr>
                                        <tr>
                                            
                                            <th scope="row">Event Image 2 </th>
                                            
                                            <td> <img  src="https://vazecollege.net/Book_a_Slot/src/main<?php echo substr($row['event_pic2'],2);?>" alt="EVENT IMAGE 2" class="img-fluid" >
                                             </td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                                <!-- <button onclick="Convert_HTML_To_PDF();">Convert HTML to PDF</button> -->
                                <button id="btn-export" class="btn border bg-primary w-50 text-white mx-auto" style="margin-block:4rem" onclick="exportHTML();">Export to
                                     word doc</button>
                                     <?php


                                            ?>
                            </div>
                        </div>
        

            <?php
        }
    }else{
        ?>
         <div class="col-lg-12 col-md-12 mb-5">
                        <p class="fs-2 text-center" style="margin-top:11rem;">
                            No Record is there on  <?php echo date("d M Y", strtotime($_GET['date'])); ?><br>
                        </p>
                    </div>
        <?php
    }

}
?>
</body>

</html>
<?php
mysqli_close($con);
?>


<script>


function exportHTML(){
       var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
            "xmlns:w='urn:schemas-microsoft-com:office:word' "+
            "xmlns='http://www.w3.org/TR/REC-html40'>"+
            "<head><meta charset='utf-8'><title>Export HTML to Word Document with JavaScript</title></head><body>";
       var footer = "</body></html>";
       var sourceHTML = header+document.getElementById("tableToDownload").innerHTML+footer;
       
       var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
       var fileDownload = document.createElement("a");
       document.body.appendChild(fileDownload);
       fileDownload.href = source;
       fileDownload.download = 'Event_report.doc';
       fileDownload.click();
       document.body.removeChild(fileDownload);
    }



// 			const button = document.getElementById('download-button');

// 			function generatePDF() {
// 				// Choose the element that your content will be rendered to.
// 				const element = document.getElementById('tableToDownload');
// 				// Choose the element and save the PDF for your user.
// 				html2pdf().from(element).save();
// 			}

// 			button.addEventListener('click', generatePDF);

//             window.jsPDF = window.jspdf.jsPDF;

// // Convert HTML content to PDF
// function Convert_HTML_To_PDF() {
//     var doc = new jsPDF();
//     // Source HTMLElement or a string containing HTML.
//     var elementHTML = document.querySelector("#tableToDownload");

//     doc.html(elementHTML, {
//         callback: function(doc) {
//             // Save the PDF
//             doc.save('document-html.pdf');
//         },
//         margin: [10, 10, 10, 10],
//         autoPaging: 'text',
//         x: 0,
//         y: 0,
//         width: 190, //target width in the PDF document
//         windowWidth: 675 //window width in CSS pixels
//     });
// }




</script>