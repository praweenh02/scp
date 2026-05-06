$(document).ready(function(){  
    $("#loginbtn").click(function(){  
        
        var user_name = $("#username").val();  
        var password = $("#password").val();  
        //var type = $('#type option:selected').val();
        // Returns error message when submitted without req fields. 

        if(user_name==''||password=='')  
        {  
        jQuery("#msg").show();  
        jQuery("#msg").html("All fields are required");  
        jQuery("#msg").delay(500).fadeOut(1000);
        }  
        else  
        {  
         //var csrf_token = $('input[name=csrf_token]').val(); 
        $.ajax({  
        type: "POST",  
        url:  SITEROOT +"super-admin/auth/logindone",  
        data: $("#login-form").serialize(),  
        cache: false,  
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
                  jQuery("#msg").html("Invalid username & password.");  
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


 