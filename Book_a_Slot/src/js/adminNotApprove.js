$('#not_approve_event_id').on('click',function(){
    console.log('Hello');
   
    $event_id = $('#event_id').val();
    $email=$('#email').val();
    $name=$('#name').val();
    $event_name=$('#event_name').val();
    $event_date=$('#event_date').val();
    $status_reason=$('#status_reason').val();
    console.log($event_id);
    console.log($email);
    console.log($name);
    console.log($event_date);
    console.log($event_name);
    console.log($status_reason);
   
    $.ajax({
        type: 'POST',
        url: 'adminNotApprovedAjax.php',
        data: {event_id:$event_id,
            email:$email,
            name:$name,
            event_name:$event_name,
            event_date:$event_date,
            status_reason:$status_reason,
           },
        success: function(data) {
            $('#emailTemp').html(data);
            console.log(data);
            
        },
        error: function() {
            console.log(response.status);
        },
    })  
})
