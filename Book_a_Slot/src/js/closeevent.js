
    function changeMode(){
        var status=document.getElementById('event_mode');
        if(status.value=='Online' || status.value=='Hybrid'){
            document.getElementById('event_link').style.display='block';
        }
        else{
            document.getElementById('event_link').style.display='none';
        }
    }
    $(document).ready(function(){
        $('#DropDown1').on('click', function () {
            $('#DropDownMenu1').toggle(300);
        });
        $('#event_pic_first').change(function(){
            const file = this.files[0];
            
            if (file){
              const reader = new FileReader();
              reader.onload = function(event) {
                const img = new Image();
                img.onload = function() {
                  const canvas = document.createElement('canvas');
                  const maxWidth = 800; // Maximum width for the compressed image
                  const maxHeight = 600; // Maximum height for the compressed image
    
                  let width = img.width;
                  let height = img.height;
    
                  if (width > height) {
                    if (width > maxWidth) {
                      height *= maxWidth / width;
                      width = maxWidth;
                    }
                  } else {
                    if (height > maxHeight) {
                      width *= maxHeight / height;
                      height = maxHeight;
                    }
                  }
    
                  canvas.width = width;
                  canvas.height = height;
                  const ctx = canvas.getContext('2d');
                  ctx.drawImage(img, 0, 0, width, height);
                  console.log(ctx);
                  canvas.toBlob(function(blob) {
                    const reader = new FileReader();
                    reader.onloadend = function() {
                      const base64String = reader.result;
                      $('#preview1Image1').attr('src', base64String);
                      $("#base64Image1").val(base64String);
                    };
                    console.log(blob);
                    reader.readAsDataURL(blob);
                  }, 'image/jpeg', 0.8);
                };
                img.src = event.target.result;
              };
    
              reader.readAsDataURL(file);
            }
          });
          $('#event_pic_second').change(function(){
            const file = this.files[0];
            
            if (file){
              const reader = new FileReader();
              reader.onload = function(event) {
                const img = new Image();
                img.onload = function() {
                  const canvas = document.createElement('canvas');
                  const maxWidth = 800; // Maximum width for the compressed image
                  const maxHeight = 600; // Maximum height for the compressed image
    
                  let width = img.width;
                  let height = img.height;
    
                  if (width > height) {
                    if (width > maxWidth) {
                      height *= maxWidth / width;
                      width = maxWidth;
                    }
                  } else {
                    if (height > maxHeight) {
                      width *= maxHeight / height;
                      height = maxHeight;
                    }
                  }
    
                  canvas.width = width;
                  canvas.height = height;
                  const ctx = canvas.getContext('2d');
                  ctx.drawImage(img, 0, 0, width, height);
                  console.log(ctx);
                  canvas.toBlob(function(blob) {
                    const reader = new FileReader();
                    reader.onloadend = function() {
                      const base64String = reader.result;
                      $('#preview1Image2').attr('src', base64String);
                      $("#base64Image2").val(base64String);
                    };
                    console.log(blob);
                    reader.readAsDataURL(blob);
                  }, 'image/jpeg', 0.8);
                };
                img.src = event.target.result;
              };
    
              reader.readAsDataURL(file);
            }
          });
    })
    
    

