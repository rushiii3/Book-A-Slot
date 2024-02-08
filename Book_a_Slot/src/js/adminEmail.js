$('#approve_event_id').on('click',function(){
    console.log('Hello');
   
    $event_id = $('#event_id').val();
    $event_start_time=$('#event_start_time').val();
    $email=$('#email').val();
    $name=$('#name').val();
    $event_name=$('#event_name').val();
    $event_date=$('#event_date').val();
    $alumni=$('#alumni').val();
    $event_description=$('#event_description').val();
    console.log($event_id);
    console.log($email);
    console.log($name);
    console.log($event_date);
    console.log($alumni);
    console.log($event_name);
    console.log($event_description);
    console.log($event_start_time);
    $.ajax({
        type: 'POST',
        url: 'adminajax.php',
        data: {event_id:$event_id,
            email:$email,
            name:$name,
            event_name:$event_name,
            event_date:$event_date,
            alumni:$alumni,
            event_description:$event_description,
            event_start_time:$event_start_time},
        success: function(data) {
            $('#emailTemp').html(data);
            console.log(data);
            setTimeout(function(){location = 'admin_home.php'},3000)
            
        },
        error: function() {
            console.log(response.status);
        },
    })  
})
