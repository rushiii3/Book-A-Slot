$('#sendTransaction').hide();
$('#e_id').hide();
$('#t_id').hide();
$('#t_date').hide();
$('#sendTransaction').on('click',function()
    {
        $event_id =  $('#e_id').val();
        $evennt_transaction_id =  $('#t_id').val();
        $event_transaction_date = $('#t_date').val();
        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            data: {transaction_event_id:$event_id, transaction_id_for_event:$evennt_transaction_id, transaction_date_for_event:$event_transaction_date},
            success: function(data) {
                if(data==1)
                {
                    window.location.reload();
                }
                else{
                    $('#failed').modal('show');
                }
            },
            error: function() {
                console.log(response.status);
            },
        })
});