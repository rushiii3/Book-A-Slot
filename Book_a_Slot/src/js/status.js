function UpdateInputEvent(eventid) {
    console.log(eventid);
    $("#event_id_booking").val("");
    $("#event_id_booking").val(eventid);
    
}
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

  $("#SubmitUpdateRespource").on("click",function () {
    $event_id = $("#event_id_booking").val();
    $no_of_rp = $('#no_of_rp').val();
    
    if($no_of_rp!=="Please Select the Number of Resourse Person")
  {
    if($no_of_rp=="No")
    {
        SendDataToUpdate($event_id, rp_name, company_name, rp_designation, rp_experience);
    }else{
      var rp_name = [];
      var company_name = [];
      var rp_designation = [];
      var rp_experience = [];
      var count = 0;
      for(i=0;i<$no_of_rp;i++)
      {
        rp_name[i] = $('#rp_name'+i+'').val();  
        company_name[i] = $('#companyName'+i+'').val();  
        rp_designation[i] = $('#designation'+i+'').val();
        rp_experience[i] = $('#experience'+i+'').val();
        if(rp_name[i]!=="")
        {
          if(company_name[i]!=="")
          {
            if(rp_designation[i]!=="")
            {
              if(rp_experience[i]!=="")
              {
                count=count+1;
              
              }else{
                alert("Please input the "+i+" Resource person experience");
              }
            }else{
              alert("Please input the "+i+" Resource person Designation");
            }
          }else{
            alert("Please input the "+i+" Resource person company name");
          }
        }else{
          alert("Please input the "+i+" Resource person name");
        }  
  
      }
      if(count==$no_of_rp)
      {
        SendDataToUpdate($event_id, rp_name, company_name, rp_designation, rp_experience);
      }
    }
  }else{
    alert("Please select the Number of Resourse Person");
  }



    
  })

  function SendDataToUpdate(event_id,rp_names,company_names,designations,experience) {

    console.log("heheh");
    
    console.log(rp_names);
    console.log(company_names);
    console.log(designations);
    console.log(experience);
    console.log(event_id);
    $.ajax({
        type: 'POST',
        url: 'ajax.php',
        data: {
            rp_names_update:rp_names, 
            company_names_update:company_names, 
            designations_update:designations, 
            experience_update:experience, 
            event_id:event_id},
        success: function(data){
            if(data==1)
            {
              console.log("success");
            }
            else
            {
                console.log("error");
            }
        },
        error: function() {
            console.log(response.status);
        },
    })
    console.log(experience);
  }