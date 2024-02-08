$('#backward_date').on('click',function()
{
    $date = $('#set_date').text();
    var currentDate = new Date($date);
    currentDate.setDate(currentDate.getDate() - 1);
    var new_date = currentDate.toDateString();
    previousDay()
    $.ajax({
        type: 'POST',
        url: '../user/ajax.php',
        data: {requirement_date:new_date},
        success: function(data) {
            $('#innerReq').html("");
            $('#innerReq').html(data);
            
        },
        error: function() {
            console.log(response.status);
        },
    })
})
$('#forward_date').on('click',function()
{
    $date = $('#set_date').text();
    var currentDate = new Date($date);
    currentDate.setDate(currentDate.getDate() + 1);
    var new_date = currentDate.toDateString();
    nextDay()
    $.ajax({
        type: 'POST',
        url: '../user/ajax.php',
        data: {requirement_date:new_date},
        success: function(data) {
            $('#innerReq').html("");
            $('#innerReq').html(data);
            
            
        },
        error: function() {
            console.log(response.status);
        },
    })
})


var currentDate = new Date();
function nextDay() {
    currentDate.setDate(currentDate.getDate() + 1);
    updateDate();
  }

  function previousDay() {
    currentDate.setDate(currentDate.getDate() - 1);
    updateDate();
  }

  function updateDate() {
    var dateString = currentDate.toDateString();
    document.getElementById("set_date").textContent = dateString;
  }

  function show()
  {
    var dateString = currentDate.toDateString();
    document.getElementById("set_date").textContent = dateString;
    
    updateDate();
    $.ajax({
        type: 'POST',
        url: '../user/ajax.php',
        data: {requirement_date:dateString},
        success: function(data) {
            $('#innerReq').html("");
            $('#innerReq').html(data);
            
            
        },
        error: function() {
            console.log(response.status);
        },
    })
  }
 
  show();
