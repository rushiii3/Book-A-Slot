$('#Acceptconfirm').on('click',function()
                            {
                                $event_id = $('#confirm_event_id').text();
                                
                                $.ajax({
                                    type: 'POST',
                                    url: 'pajax.php',
                                    data: { accepteventid : $event_id},
                                    success: function(data){
                                        
                                        if(data==1){
                                            sendAcceptEmail($event_id)
                                            //window.location.reload();
                                        }else{
                                            
                                        }
                                        
                                    },
                                    error: function() {
                                        console.log(response.status);
                                    },
                                })
                            })
                            $('#LastConfirm').on('click',function()
                            {
                                $event_id = $('#event_id').text();
                                $reason = $('#CancelReason').val();
                                $.ajax({
                                    type: 'POST',
                                    url: 'pajax.php',
                                    data: { rejecteventid : $event_id, reason: $reason},
                                    success: function(data){
                                        
                                        if(data==1){
                                            sendRejectEmail($event_id,$reason)
                                        }else{
                                            
                                        }
                                        
                                    },
                                    error: function() {
                                        console.log(response.status);
                                    },
                                })
                            })

                            function sendAcceptEmail(event_id)
                            {
                                var email_approved_event_id = event_id;
                                $.ajax({
                                    type: 'POST',
                                    url: 'pajax.php',
                                    data: { accept_event_id_email:email_approved_event_id},
                                    success: function(data){
                                        
                                        $('#emailTemp').html(data);
                                        setInterval(moveClass, 2000); 
                                        window.location.reload();
                                    },
                                    error: function() {
                                        console.log(response.status);
                                    },
                                })
                            }

                            function sendRejectEmail(event_id,reason)
                            {
                                var email_reject_event_id = event_id;
                                var reason_to_reject_event = reason;
                                $.ajax({
                                    type: 'POST',
                                    url: 'pajax.php',
                                    data: { email_reject_event_id:email_reject_event_id,reason_to_reject_event:reason_to_reject_event},
                                    success: function(data){
                                        
                                        $('#emailTemp').html(data);
                                        setInterval(moveClass, 2000);
                                        window.location.reload(); 
                                    },
                                    error: function() {
                                        console.log(response.status);
                                    },
                                })
                            }

                            function moveClass()
                            {
                                
                                $('#emailTemp').html(" ");
                            }

