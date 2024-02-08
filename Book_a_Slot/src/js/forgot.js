$('.pass_open_eye').hide();
$('.cpass_open_eye').hide();
$('#sendOtp').hide();
$('#email').on('input',function(){
    var email = $('#email').val();
    $.ajax({
        type: 'POST',
        url: 'ajax.php',
        data: {sign_up_email : email},
        success: function(data) {
            if(data==1)
            {
                $('#sendOtp').show();
            }
            else
            {
                $('#sendOtp').hide();
            }
        },
        error: function() {
            console.log(response.status);
        },
    })
})
$('.pass_icon').on('click',function(){
    if('password' == $('#password').attr('type')){
        $('#password').prop('type', 'text');
        $('.pass_open_eye').show();
        $('.pass_close_eye').hide();

   }else{
        $('#password').prop('type', 'password');
        $('.pass_open_eye').hide();
        $('.pass_close_eye').show();
   }
})
$('.cpass_icon').on('click',function(){
    if('password' == $('#confirm_password').attr('type')){
        $('#confirm_password').prop('type', 'text');
        $('.cpass_open_eye').show();
        $('.cpass_close_eye').hide();

   }else{
        $('#confirm_password').prop('type', 'password');
        $('.cpass_open_eye').hide();
        $('.cpass_close_eye').show();
   }
})
$('#section4').hide();
$('#password').on("input",function(){
    $password = $('#password').val();
    if($password.length >= 8){
        if(Boolean($password.match(/[A-Z]/))==true)
        {
            $('#pass_verify').text("Valid Password !").css("color", "green");
            $('#password').css("border-color","green");
        }
        else{
            $('#pass_verify').text("Password must contain a uppercase letter.").css("color", "red");
            $('#password').css("border-color","red");
        }
        
    }
    else{
        $('#pass_verify').text("Password must be more than 8 characters.").css("color", "red");
        $('#password').css("border-color","red");
    }
    
})
$('#confirm_password').on("input",function(){
    $password = $('#password').val();
    $confirm_password = $('#confirm_password').val();
    if($password==$confirm_password){
            $('#confirm_password_verify').text("Password matched with Password !").css("color", "green");
            $('#confirm_password').css("border-color","green");
    }
    else{
        $('#confirm_password_verify').text("Password not matched with Password !").css("color", "red");
            $('#confirm_password').css("border-color","red");
    }
})

$('#resetPassword').on('click',function()
{
    $password = $('#password').val();
    $confirm_pass_verify = $('#confirm_password_verify').text();
    $pass_verify = $('#pass_verify').text();
    if($pass_verify=="Valid Password !")
    {
        if($confirm_pass_verify=="Password matched with Password !")
        {
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: {user_email_forgot:$email,password:$password},
                success: function(data){
                    if(data==1)
                    {
                        $('#section3').fadeOut();
                        $('#section3').hide();
                        $('#section4').fadeIn();
                        $('#section4').show();
                    }
                   
                    
                },
                error: function() {
                    console.log(response.status);
                },
            })
        }else{
            alert("Password not matched with Password !");
        }
    }else{
        alert("Invalid Password");
    }

})
var val = 0;
function generateOtp()
{

    val = Math.floor(1000 + Math.random() * 9000);

}
        $('#section2').hide();
        $('#section3').hide();
        $('#goBack').on('click',function()
        {
            $('#section2').fadeOut();
            $('#section2').hide();
            $('#section1').fadeIn();
            $('#section1').show();
            

        })
        $('#sendOtp').on('click',function()
        {
            
            generateOtp()
            
            $email = $('#email').val();
            $('#section2').fadeIn();
            $('#section2').show();
            $('#section1').fadeOut();
            $('#section1').hide();
            $('#emailInfo').html($email);
            sendEmail($email,val);

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
                        $('#section1').hide();
                        $('#section2').fadeOut();
                        $('#section2').hide();
                        $('#section3').fadeIn();
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
        function moveClass()
        {
            $('#emailTemp').html(" ");
        }
          function sendEmail(email,otp)
          {
            $.ajax({
                type: 'POST',
                url: 'emailajax.php',
                data: {email:email,otp:otp},
                success: function(data){
                    
                    $('#emailTemp').html(data);
                    setInterval(moveClass, 2000); 
                },
                error: function() {
                    console.log(response.status);
                },
            })
          }
          