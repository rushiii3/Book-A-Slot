$('#FinalSubmit').on('click',function(e)
{
    $user_email = $('#user_email').val();
    $event_name = $('#eventName').val();
    $event_Descr = $('#eventDescription').val();
    $num_of_students = $('#no_of_stu_attending').val();
    $department_namee = $('#department_namee').val();
    $dep_name = $('#department_namee :selected').text();
    $Institute_OrgName = $('#Institute_OrgName').val();
    $Institute_OrgName_email = $('#Institute_OrgName_email').val();
    $Institute_OrgName_phone_no = $('#Institute_OrgName_phone_no').val();
    $Venue_name = $('#Venue_name').val();
    $event_date = $('#selectDate').val();
    $event_start_time = $('#selectStartTime').val();
    $event_end_time = $('#selectEndTime').val();
    $no_of_rp = $('#no_of_rp').val();
    $select_no_of_chairs = $('#select_no_of_chairs').val();
    $alumni = $('#alumini').val();
    if($("input[name='checkArr']").is(':checked') )
    {
        $requriment = $("input[name='checkArr']:checked").map(function() {
            return this.value;
        }).get().join(', ');
        if($select_no_of_chairs=="Select No. of chairs required on dias")
        {
            $requriment =  $requriment+', No of chairs and dias = None';

        }else{
            $requriment =  $requriment+', No of chairs and dias = '+$select_no_of_chairs;
        }
    }else{
        $requriment = "None";
        if($select_no_of_chairs=="Select No. of chairs required on dias")
        {
            $requriment =  $requriment+', No of chairs and dias = None';

        }else{
            $requriment =  $requriment+', No of chairs and dias = '+$select_no_of_chairs;
        }
    }
    var rp_names = [];
    var company_names = [];
    var designations = [];
    var experience = [];
    if($no_of_rp==="No")
    {
        rp_names.push($('#rp_name').val());
        company_names.push($('#companyName').val());
        designations.push($('#designation').val());
        experience.push($('#experience').val());
    }else{
        for(i=0;i<$no_of_rp;i++)
      {
        rp_names.push($('#rp_name'+i+'').val());
        company_names.push($('#companyName'+i+'').val());
        designations.push($('#designation'+i+'').val());
        experience.push($('#experience'+i+'').val());
      }
    }
    if($dep_name==="Others")
    {

        var others = "others";
        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            data: {user_email:$user_email, event_name:$event_name, event_Descr:$event_Descr, num_of_students:$num_of_students , department_namee:$department_namee, Venue_name:$Venue_name, event_date:$event_date, event_start_time:$event_start_time, event_end_time:$event_end_time, requriment:$requriment, rp_names:rp_names, company_names:company_names, designations:designations, experience:experience, Institute_OrgName:$Institute_OrgName, Institute_OrgName_email:$Institute_OrgName_email, Institute_OrgName_phone_no:$Institute_OrgName_phone_no, alumni:$alumni ,others:others  },
            success: function(data){
                if(data==1)
                {
                    $.ajax({
                        type: 'POST',
                        url: 'emailajax.php',
                        data: {event_name:$event_name, event_Descr:$event_Descr, num_of_students:$num_of_students ,  Venue_name:$Venue_name, event_date:$event_date, event_start_time:$event_start_time, event_end_time:$event_end_time, Institute_OrgName:$Institute_OrgName, Institute_OrgName_email:$Institute_OrgName_email, Institute_OrgName_phone_no:$Institute_OrgName_phone_no, Institute_OrgName_transaction_id:$Institute_OrgName_transaction_id},
                        success: function(data){
                            $('#emailtemp').append(data);
                            $('#success').modal('show');
                        },
                        error: function() {
                            console.log(response.status);
                        },
                    })
                }
                else
                {
                  $('#failed').modal('show');
                }
            },
            error: function() {
                console.log(response.status);
            },
        })
        
    }else{
        var insider = "insider";
        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            data: {user_email:$user_email, event_name:$event_name, event_Descr:$event_Descr, num_of_students:$num_of_students , department_namee:$department_namee, Venue_name:$Venue_name, event_date:$event_date, event_start_time:$event_start_time, event_end_time:$event_end_time, requriment:$requriment, rp_names:rp_names, company_names:company_names, designations:designations, experience:experience, insider:insider,alumni:$alumni},
            success: function(data){
                if(data==1)
                {
                  $('#success').modal('show');
                }
                else
                {
                  $('#failed').modal('show');
                }
            },
            error: function() {
                console.log(response.status);
            },
        })
    }

    e.preventDefault();
})