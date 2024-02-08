<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAMEEEE</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://unpkg.com/jspdf@2.5.1/dist/jspdf.es.min.js"></script>
<script src="https://unpkg.com/jspdf-autotable@3.7.0/dist/jspdf.plugin.autotable.js"></script>
</head>
<body>
<div id="mainContainer">
    <h1>
        <center>Artificial Intelligence</center>
    </h1>
    <h2>Overview</h2>
    <p>
        Artificial Intelligence(AI) is an emerging technology
        demonstrating machine intelligence. The sub studies like <u><i>Neural
                Networks</i>, <i>Robatics</i> or <i>Machine Learning</i></u> are
        the parts of AI. This technology is expected to be a prime part
        of the real world in all levels.

    </p>
</div>

<button id="button-pdf" onclick="downloadPDF()">Download</button>

<div class="content-footer">
    <button id="btn-export" onclick="exportHTML();">Export to
        word doc</button>
</div>
<table id="my-table">
      <thead>
        <tr>
          <th>ID</th>
          <th colspan="2">Name</th>
          <th>Email</th>
          <th>Country</th>
          <th>IP-address</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Donna</td>
          <td>Moore</td>
          <td>dmoore0@furl.net</td>
          <td>China</td>
          <td>211.56.242.221</td>
        </tr>
        <tr>
          <td>2</td>
          <td>Janice</td>
          <td>Henry</td>
          <td>jhenry1@theatlantic.com</td>
          <td>Ukraine</td>
          <td>38.36.7.199</td>
        </tr>
        <tr>
          <td>3</td>
          <td>Ruth</td>
          <td>Wells</td>
          <td>rwells2@constantcontact.com</td>
          <td>Mexico</td>
          <td>19.162.133.184</td>
        </tr>
        <tr>
          <td>4</td>
          <td>Jason</td>
          <td>Ray</td>
          <td>jray3@psu.edu</td>
          <td>Brazil</td>
          <td>10.68.11.42</td>
        </tr>
        <tr>
          <td>5</td>
          <td>Jane</td>
          <td>Stephens</td>
          <td>jstephens4@go.com</td>
          <td>United States</td>
          <td>47.32.129.71</td>
        </tr>
        <tr>
          <td>6</td>
          <td>Adam</td>
          <td>Nichols</td>
          <td>anichols5@com.com</td>
          <td>Canada</td>
          <td>18.186.38.37<br />18.123.22.82</td>
        </tr>
      </tbody>
    </table>
<script>
//     function downloadPDF() {
//     var doc = new jsPDF('p', 'pt', 'a4');
//     // Source HTMLElement or a string containing HTML.
//     var elementHTML = document.querySelector("#mainContainer");

//     doc.addHTML(elementHTML, {
//         callback: function(doc) {
//             // Save the PDF
//             doc.save('EVENT_REPORT.pdf');
//         },
//         margin: [8, 8, 8, 8],
//         autoPaging: 'slice',
//         x: 0,
//         y: 0,
//         width: 190, //target width in the PDF document
//         windowWidth: 600 //window width in CSS pixels 675
//     });
// }
//     function exportHTML(){
//        var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
//             "xmlns:w='urn:schemas-microsoft-com:office:word' "+
//             "xmlns='http://www.w3.org/TR/REC-html40'>"+
//             "<head><meta charset='utf-8'><title>Export HTML to Word Document with JavaScript</title></head><body>";
//        var footer = "</body></html>";
//        var sourceHTML = header+document.getElementById("source-html").innerHTML+footer;
       
//        var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
//        var fileDownload = document.createElement("a");
//        document.body.appendChild(fileDownload);
//        fileDownload.href = source;
//        fileDownload.download = 'document.doc';
//        fileDownload.click();
//        document.body.removeChild(fileDownload);
//     }\



var doc = new jsPDF()
  doc.autoTable({ html: '#my-table' })
  doc.save('table.pdf')

// const doc = new jsPDF('p', 'mm')
//       doc.autoTable({
//         html: '#my-table',
//         theme: 'grid',
//         // tableWidth: 180,
//         // head: [['ID', 'Name', 'Email', 'Country', 'IP-address']],
//         // body: [
//         //   ['1', 'Donna', 'dmoore0@furl.net', 'China', '211.56.242.221'],
//         //   ['2', 'Janice', 'jhenry1@theatlantic.com', 'Ukraine', '38.36.7.199'],
//         //   [
//         //     '3',
//         //     'Ruth',
//         //     'rwells2@constantcontact.com',
//         //     'Trinidad and Tobago',
//         //     '19.162.133.184',
//         //   ],
//         //   ['4', 'Jason', 'jray3@psu.edu', 'Brazil', '10.68.11.42'],
//         //   ['5', 'Jane', 'jstephens4@go.com', 'United States', '47.32.129.71'],
//         //   ['6', 'Adam', 'anichols5@com.com', 'Canada', '18.186.38.37'],
//         // ],
//       })

    //   document.getElementById('output').data = doc.output('datauristring')
     
</script>





</body>
</html>