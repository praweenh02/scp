$(document).ready(function(){  
    $("#loginbtn").click(function(){  
        
        var email = $("#email").val();  
        var password = $("#password").val();  
        //var type = $('#type option:selected').val();
        // Returns error message when submitted without req fields. 

        if(email==''||password=='')  
        {  
        jQuery("#msg").show();  
        jQuery("#msg").html("All fields are required");  
        jQuery("#msg").delay(500).fadeOut(1000);
        }  
        else  
        {  
         //var csrf_token = $('input[name=csrf_token]').val(); 
          var form = $('#login-form')[0]; 
          formData = new FormData(form);
        $.ajax({  
        type: "POST",  
        url:  SITEROOT +"login/logindone",  
        type: "post",
            //data: $("#form-changepassword").serialize(),
        data: formData,
        processData: false,
        contentType: false,

        success: function(response){  
            var data_obj = JSON.parse(response);
           
             if ($.trim(data_obj.status) === 'success')
              {
                   jQuery("#success").show();  
                   jQuery("#success").html("Login successful,redirecting...");
                    setTimeout(function () {
                    window.location = data_obj.url;
                    },3000);
            } else if($.trim(data_obj.status) === 'error') 
            {
                
                  jQuery("#msg").show();  
                  jQuery("#msg").html("Your account is Inactive. please wait for activation");  
                  jQuery("#msg").delay(500).fadeOut(4000);
                   setTimeout(function () {
                   location.reload();
                    },3000);
            }
            else if($.trim(data_obj.status) === 'error1') 
            {
                
                  jQuery("#msg").show();  
                  jQuery("#msg").html("Invalid email & password.");  
                  jQuery("#msg").delay(500).fadeOut(1000);
                    setTimeout(function () {
                   location.reload();
                    },3000);
            }
            else if($.trim(data_obj.status) === 'error2') 
            {
                
                  jQuery("#msg").show();  
                  jQuery("#msg").html("Please validate captcha.");  
                  jQuery("#msg").delay(500).fadeOut(1000);
                    setTimeout(function () {
                   location.reload();
                    },3000);
            }
             else if($.trim(data_obj.status) === 'error3') 
            {
                
                  jQuery("#msg").show();  
                  jQuery("#msg").html("Please check captcha.");  
                  jQuery("#msg").delay(500).fadeOut(1000);
                    setTimeout(function () {
                   location.reload();
                    },3000);
            }
            else{


               
                  jQuery("#msg").show();  
                  jQuery("div#msg").html("Something went wronge.");
                  jQuery("#msg").delay(500).fadeOut(1000);  
                    setTimeout(function () {
                   location.reload();
                    },3000);
            }
         }

         });  
        }  
       

   
     return false;  
    });  
}); 
$(document).on('click','.forgot_password',function(){
      var url =  SITEROOT +"login/reset_password";       
      if($('#form_reset_pwd').valid()){
        $('#error_result').html('Please wait...');  
        $.ajax({
        type: "POST",
        url: url,
        data: $("#form_reset_pwd").serialize(), // serializes the form's elements.
         beforeSend: function () {
                //showloader();
                $(".btn-submit").attr('disabled', 'disabled');
            },
            
            complete: function () {
                //hideloader();
                $(".btn-submit").removeAttr('disabled');
                //$('#myModal').modal('hide');
                 //$("#myModal").hide();
                 $('#form_reset_pwd').trigger("reset");
                 
            },
          success: function(data) {                    
            if(data==1)
            {
              $('#error_result').html('Please Check your Registered email, for reset password.');
              $('#error_result').addClass("green");
                               Swal.fire({
  position: 'top',
  icon: 'success',
  title: 'Please Check your Registered email, for reset password',
  showConfirmButton: false,
  timer: 2800
});
 setTimeout(function () {
                    location.reload();
                    }, 3000);

         
                 
            } 
             else if(data==2)
            {
              $('#error_result').html('Please validate captcha.');
              $('#error_result').addClass("red");
                $('#form_reset_pwd').trigger("reset");
            } 
             else if(data==3)
            {
              $('#error_result').html('Today password reset limit is exit,please try after some time.');
              $('#error_result').addClass("red");
            } 
            else
            {
              $('#error_result').html('Invalid email id. Please check your email id.');
              $('#error_result').addClass("red");
            }
          }
        });
      }
      return false;
});
  $(document).ready(function(){
    $(document).on('click','#btn-pwd',function(){
      var url =  SITEROOT +"login/submit_password";   
       var form = $('#rest_password')[0]; 
          formData = new FormData(form);
      if($('#rest_password').valid()){
        $('#error_result').html('Please wait...');  
        $.ajax({
        type: "POST",
        url: url,
        data: $("#rest_password").serialize(),
        //data:formData,
          success: function(data) {    
              alert(data);
            if(data==1)
            {
            

                   jQuery("#msg").show();  
                   jQuery("#msg").html("Password reset successfully.");
                    setTimeout(function () {
                         window.location.href = SITEROOT +'login/';
                     }, 1000);
            } 
            else
            {
              $('#msg').html('Password reset failed. Enter again.');              
            }
          }
        });
      }
      return false;
    });
});

 