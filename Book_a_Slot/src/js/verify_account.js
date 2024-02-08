var val = 0;
function generateOtp()
{
    val = Math.floor(1000 + Math.random() * 9000);
}

$('#resend_otp').hide();
function timer(){
    var timeleft = 59;
    var downloadTimer = setInterval(function(){
    timeleft--;
    document.getElementById("countdowntimer").textContent = timeleft;
    if(timeleft==0){
        $('.counter').hide();
        $('#resend_otp').show();
    }
    if(timeleft <= 0)
        clearInterval(downloadTimer);
    },1000);
}
$('#sendEmail').on('click',function(){
        generateOtp();
        timer();
        var email = $('#email').val();
        var name =  $('#full_name').val();
        $('#emailInfo').text(email);
        sendEmail(email,val,name);
        
})

$('#resend_otp').on('click',function(){
    $('#countdowntimer').text("5");
    $('.counter').show();
    $('#resend_otp').hide();
    timer();
    generateOtp();
        var email = $('#email').val();
        var name =  $('#full_name').val();
        $.ajax({
            type: 'POST',
            url: 'emailajax.php',
            data:{ useremail:email, userotp:val, username:name },
            success: function(data){
                $('#emailTemp').html(data);
                setInterval(moveClass, 2000); 
            },
            
        })

    
})
function OTPInput() {
    const inputs = document.querySelectorAll('#otp > *[id]');
    for (let i = 0; i < inputs.length; i++) 
    { 
        inputs[i].addEventListener('keydown', function(event) 
        { 
            if (event.key==="Backspace" ) 
            { 
                
                inputs[i].value='' ; 
                if (i !==0) inputs[i - 1].focus(); 
            } 
            else 
            { 
                if (i===inputs.length - 1 && inputs[i].value !=='' ) 
                { 
                    return true; 
                } 
                else if (event.keyCode> 47 && event.keyCode < 58) 
                { 
                    inputs[i].value=event.key; 
                    $value = inputs[i].value;
                    if (i !==inputs.length - 1) inputs[i + 1].focus(); 
                    event.preventDefault(); 
                } 
                
            } 
        });
     } 
    } 

    OTPInput();

    function moveClass()
        {
            $('#emailTemp').html(" ");
        }
          function sendEmail(email,otp,name)
          {
            
            $.ajax({
                type: 'POST',
                url: 'emailajax.php',
                data:{ useremail:email, userotp:otp, username:name },
                success: function(data){
                    $('#emailTemp').html(data);
                    setInterval(moveClass, 2000); 
                },
                
            })
        
          }
          
          
    $('#verifyOtp').on('click',function()
        {
            const inputs = document.querySelectorAll('#otp > *[id]');
            var count = 0;
            for (let i = 0; i < inputs.length; i++) 
            {
                if(inputs[i].value!=="")
                {
                    count = count + 1;
                    
                }else{
                    alert("Please fill all the otp fields");
                    break;
                }
            } 
            if(count===inputs.length)
            {
                    $otp_number = Number($('#first').val()+$('#second').val()+$('#third').val()+$('#fourth').val());
                    
                    if($otp_number===val)
                    {
                        $('#invalidOtp').text("Valid").css("color", "green");
                        
                        var email = $('#email').val();
                        $.ajax({
                            type: 'POST',
                            url: 'ajax.php',
                            data:{ useremailtoverify:email},
                            success: function(data){
                                if(data==1)
                                {                                
                                    $('#success').modal('show');
                                }else{
                                    $('#failed').modal('show');
                                }
                            },
                            
                        })
                        
                    }else{
                        $("#first, #second, #third, #fourth").effect( "shake", { 
                            direction: 'left', 
                            times: 4, 
                            distance: 10
                        }, 1000 ).css("border-color", "red");
                        $('#invalidOtp').text( "Invalid OTP").css("color", "red");
                        
                    }
                    
            }  
            
        })