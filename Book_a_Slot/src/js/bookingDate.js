$('#selectDate').on('focus',function(){
  $date = $('#selectDate').val();
  $Venue_name = $('#Venue_name').val();
  if($Venue_name!="Select Venue")
  {
    $.ajax({
      type: 'POST',
      url: 'ajax.php',
      data: {datee:$date,Venue_name:$Venue_name},
      success: function(data){
        $('#selectStartTime').html(" ");
        $('#selectStartTime').html('<option selected>Select the start time</option><option class="start-time" value="07:00">07:00 AM</option><option class="start-time" value="07:30">07:30 AM</option><option class="start-time" value="08:00">08:00 AM</option><option class="start-time" value="08:30">08:30 AM</option><option class="start-time" value="09:00">09:00 AM</option><option class="start-time" value="09:30">09:30 AM</option><option class="start-time" value="10:00">10:00 AM</option><option class="start-time" value="10:30">10:30 AM</option><option class="start-time" value="11:00">11:00 AM</option><option class="start-time" value="11:30">11:30 AM</option><option class="start-time" value="12:00">12:00 PM</option><option class="start-time" value="12:30">12:30 PM</option><option class="start-time" value="13:00">01:00 PM</option><option class="start-time" value="13:30">01:30 PM</option><option class="start-time" value="14:00">02:00 PM</option><option class="start-time" value="14:30">02:30 PM</option><option class="start-time" value="15:00">03:00 PM</option><option class="start-time" value="15:30">03:30 PM</option><option class="start-time" value="16:00">04:00 PM</option><option class="start-time" value="16:30">04:30 PM</option><option class="start-time" value="17:00">05:00 PM</option><option class="start-time" value="17:30">05:30 PM</option><option class="start-time" value="18:00">06:00 PM</option><option class="start-time" value="18:30">06:30 PM</option><option class="start-time" value="19:00">07:00 PM</option><option class="start-time" value="19:30">07:30 PM</option><option class="start-time" value="20:00">08:00 PM</option><option class="start-time" value="20:30">08:30 PM</option><option class="start-time" value="21:00">09:00 PM</option><option class="start-time" value="21:30">09:30 PM</option><option class="start-time" value="22:00">10:00 PM</option><option class="start-time" value="22:30">10:30 PM</option><option class="start-time" value="23:00">11:00 PM</option><option class="start-time" value="23:30">11:30 PM</option>');
        $('#selectEndTime').html(" ");
        $('#selectEndTime').html('<option selected>Select End time</option><option class="end-time" value="07:00">07:00 AM</option><option class="end-time" value="07:30">07:30 AM</option><option class="end-time" value="08:00">08:00 AM</option><option class="end-time" value="08:30">08:30 AM</option><option class="end-time" value="09:00">09:00 AM</option><option class="end-time" value="09:30">09:30 AM</option><option class="end-time" value="10:00">10:00 AM</option><option class="end-time" value="10:30">10:30 AM</option><option class="end-time" value="11:00">11:00 AM</option><option class="end-time" value="11:30">11:30 AM</option><option class="end-time" value="12:00">12:00 PM</option><option class="end-time" value="12:30">12:30 PM</option><option class="end-time" value="13:00">01:00 PM</option><option class="end-time" value="13:30">01:30 PM</option><option class="end-time" value="14:00">02:00 PM</option><option class="end-time" value="14:30">02:30 PM</option><option class="end-time" value="15:00">03:00 PM</option><option class="end-time" value="15:30">03:30 PM</option><option class="end-time" value="16:00">04:00 PM</option><option class="end-time" value="16:30">04:30 PM</option><option class="end-time" value="17:00">05:00 PM</option><option class="end-time" value="17:30">05:30 PM</option><option class="end-time" value="18:00">06:00 PM</option><option class="end-time" value="18:30">06:30 PM</option><option class="end-time" value="19:00">07:00 PM</option><option class="end-time" value="19:30">07:30 PM</option><option class="end-time" value="20:00">08:00 PM</option><option class="end-time" value="20:30">08:30 PM</option><option class="end-time" value="21:00">09:00 PM</option><option class="end-time" value="21:30">09:30 PM</option><option class="end-time" value="22:00">10:00 PM</option><option class="end-time" value="22:30">10:30 PM</option><option class="end-time" value="23:00">11:00 PM</option><option class="end-time" value="23:30">11:30 PM</option> ');
        $('#timeBlock').html(" ");
        $('#timeBlock').append(data);
      },
      error: function() {
          console.log(response.status);
      },
  })
  }
})
$('#Venue_name').on('change',function(){
  $date = $('#selectDate').val();
  $Venue_name = $('#Venue_name').val();
  if($date!="")
  {
    $.ajax({
      type: 'POST',
      url: 'ajax.php',
      data: {datee:$date,Venue_name:$Venue_name},
      success: function(data){
        $('#selectStartTime').html(" ");
        $('#selectStartTime').html('<option selected>Select the start time</option><option class="start-time" value="07:00">07:00 AM</option><option class="start-time" value="07:30">07:30 AM</option><option class="start-time" value="08:00">08:00 AM</option><option class="start-time" value="08:30">08:30 AM</option><option class="start-time" value="09:00">09:00 AM</option><option class="start-time" value="09:30">09:30 AM</option><option class="start-time" value="10:00">10:00 AM</option><option class="start-time" value="10:30">10:30 AM</option><option class="start-time" value="11:00">11:00 AM</option><option class="start-time" value="11:30">11:30 AM</option><option class="start-time" value="12:00">12:00 PM</option><option class="start-time" value="12:30">12:30 PM</option><option class="start-time" value="13:00">01:00 PM</option><option class="start-time" value="13:30">01:30 PM</option><option class="start-time" value="14:00">02:00 PM</option><option class="start-time" value="14:30">02:30 PM</option><option class="start-time" value="15:00">03:00 PM</option><option class="start-time" value="15:30">03:30 PM</option><option class="start-time" value="16:00">04:00 PM</option><option class="start-time" value="16:30">04:30 PM</option><option class="start-time" value="17:00">05:00 PM</option><option class="start-time" value="17:30">05:30 PM</option><option class="start-time" value="18:00">06:00 PM</option><option class="start-time" value="18:30">06:30 PM</option><option class="start-time" value="19:00">07:00 PM</option><option class="start-time" value="19:30">07:30 PM</option><option class="start-time" value="20:00">08:00 PM</option><option class="start-time" value="20:30">08:30 PM</option><option class="start-time" value="21:00">09:00 PM</option><option class="start-time" value="21:30">09:30 PM</option><option class="start-time" value="22:00">10:00 PM</option><option class="start-time" value="22:30">10:30 PM</option><option class="start-time" value="23:00">11:00 PM</option><option class="start-time" value="23:30">11:30 PM</option>');
        $('#selectEndTime').html(" ");
        $('#selectEndTime').html('<option selected>Select End time</option><option class="end-time" value="07:00">07:00 AM</option><option class="end-time" value="07:30">07:30 AM</option><option class="end-time" value="08:00">08:00 AM</option><option class="end-time" value="08:30">08:30 AM</option><option class="end-time" value="09:00">09:00 AM</option><option class="end-time" value="09:30">09:30 AM</option><option class="end-time" value="10:00">10:00 AM</option><option class="end-time" value="10:30">10:30 AM</option><option class="end-time" value="11:00">11:00 AM</option><option class="end-time" value="11:30">11:30 AM</option><option class="end-time" value="12:00">12:00 PM</option><option class="end-time" value="12:30">12:30 PM</option><option class="end-time" value="13:00">01:00 PM</option><option class="end-time" value="13:30">01:30 PM</option><option class="end-time" value="14:00">02:00 PM</option><option class="end-time" value="14:30">02:30 PM</option><option class="end-time" value="15:00">03:00 PM</option><option class="end-time" value="15:30">03:30 PM</option><option class="end-time" value="16:00">04:00 PM</option><option class="end-time" value="16:30">04:30 PM</option><option class="end-time" value="17:00">05:00 PM</option><option class="end-time" value="17:30">05:30 PM</option><option class="end-time" value="18:00">06:00 PM</option><option class="end-time" value="18:30">06:30 PM</option><option class="end-time" value="19:00">07:00 PM</option><option class="end-time" value="19:30">07:30 PM</option><option class="end-time" value="20:00">08:00 PM</option><option class="end-time" value="20:30">08:30 PM</option><option class="end-time" value="21:00">09:00 PM</option><option class="end-time" value="21:30">09:30 PM</option><option class="end-time" value="22:00">10:00 PM</option><option class="end-time" value="22:30">10:30 PM</option><option class="end-time" value="23:00">11:00 PM</option><option class="end-time" value="23:30">11:30 PM</option> ');
        $('#timeBlock').html(" ");
        $('#timeBlock').append(data); 
      },
      error: function() {
          console.log(response.status);
      },
  })
  }
  $('#capacity').html(" ");
  $('#requirement_div').html(" ");
  if($Venue_name!=="Select Venue")
  {
    $.ajax({
      type: 'POST',
      url: 'ajax.php',
      data: {Venue_name_details:$Venue_name},
      success: function(data){
        $('#capacity').append(data);
      },
      error: function() {
          console.log(response.status);
      },
  })
  $.ajax({
    type: 'POST',
    url: 'ajax.php',
    data: {Venue_name_detail_for_requirement:$Venue_name},
    success: function(data){
      $('#requirement_div').append(data);
    },
    error: function() {
        console.log(response.status);
    },
})

  }

})

$('#no_of_rp').on('change',function(){
  $no_of_rp = $('#no_of_rp').val();
  if($no_of_rp=="No"){
    $('#rps_names').html(" "); //inline-block
    $none_person = '<div style="display: none;width:100%;"> <div class="col-12 mb-3"> <label for="rp_name" class="form-label">Resourse Person Full Name</label> <input type="text" value="'+"NA"+'" class="form-control bg-secondary" id="rp_name" placeholder="e.g. ....... " readonly></div><div class="col-12 mb-3"><label for="companyName" class="form-label">Company/Institute/organization Name</label><input type="text" class="form-control" value="'+"NA"+'" readonly id="companyName" placeholder="e.g. ....... "></div><div class="col-12 mb-3"><label for="designation" class="form-label">Designation</label><input type="text" value="'+"NA"+'" readonly class="form-control" id="designation" name="designation" placeholder="e.g. ....... "></div><div class="col-12 mb-3"><label for="experience" class="form-label">Experience</label><input type="number" value="'+"0"+'" readonly class="form-control" id="experience" name="experience" placeholder="e.g. ....... "></div></div>';
    $('#rps_names').append($none_person);

  }else{
    $('#rps_names').html("");
    var mssg,i;
    var vars = [];
    for(i=0;i<$no_of_rp;i++)
    {
      vars['hello' + i] = '<div style="display: inline-block;width:100%;"> <div class="col-12 mb-3"> <label for="rp_name'+i+'" class="form-label">Resourse Person '+(i+1)+' Full Name </label> <input type="text" class="form-control" id="rp_name'+i+'" name="rp_name'+i+'" placeholder="e.g. ....... " ></div><div class="col-12 mb-3"><label for="companyName'+i+'" class="form-label">Company/Institute/organization Name</label><input type="text" class="form-control" id="companyName'+i+'" name="companyName'+i+'" placeholder="e.g. ....... "></div><div class="col-12 mb-3"><label for="designation'+i+'" class="form-label">Designation</label><input type="text" class="form-control" id="designation'+i+'" name="designation'+i+'" placeholder="e.g. ....... "></div><div class="col-12 mb-3"><label for="experience'+i+'" class="form-label">Experience</label><input type="number" class="form-control" id="experience'+i+'" name="experience'+i+'" placeholder="e.g. ....... "></div>';
      $('#rps_names').append(vars['hello' + i]);

    }
  }
  
})





