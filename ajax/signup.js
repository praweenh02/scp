

$(document).ready(function(){
    $("select.category").change(function(){
         var csrf_token = $('input[name=csrf_token]').val();
        var category_id = $(".category option:selected").val();
        
        $.ajax({
            type: "POST",
            url: SITEROOT+"home/getAllGroups",
           data:{category_id:category_id, csrf_token:csrf_token}
        }).done(function(data){
            
            $("#group_id").html(data);
        });
    });
});
function save_data()
{

    if ($('#form-signup').valid()) // check if form is valid
    {
   var email = $("#email").val();
       
        var form = $('#form-signup')[0]; 
          formData = new FormData(form);
          //formData.append('coordinator_id',$("#coordinator_id").val());
          //formData.append('group_desription', CKEDITOR.instances['group_desription'].getData());
         $.ajax({
            url: SITEROOT +'home/save_signup',
            type: "post",
             //data: $("#form-group").serialize() + '&group_id=' + group_id,
              data: formData,
              processData: false,
              contentType: false,
                 beforeSend: function () {
                showloader();
                $(".btn-submit").attr('disabled', 'disabled');
            },
            
            complete: function () {
                hideloader();
                $(".btn-submit").removeAttr('disabled');
                //$("#AddNewModal").modal('hide');
                $('#form-signup').trigger("reset");
                 
            },
            success: function (response)
             {
                var data_obj = JSON.parse(response);
                  var vremail = data_obj.email;
                if ($.trim(data_obj.status) === 'success') {
                    /*$.toast({
                        heading: 'Success',
                        text: data_obj.message,
                        icon: 'success',
                        position: 'mid-center'
                    });*/
                    Swal.fire({
  position: 'top',
  icon: 'success',
  title: data_obj.message,
  showConfirmButton: false,
  timer: 2800
});
                  
                       $('#form-signup').fadeOut();
                       $('#form-otp').fadeIn();
                       //$('#verified_email').val(vremail);
                       setTimeout(function () {
                      
                       //$("#dynamic-table").load(location.href + " #dynamic-table");
                       window.location.href='home/signup/?verifyemail='+vremail;
                    }, 3000);

                    

                } else if ($.trim(data_obj.status) === 'error') {
                    /*$.toast({
                        heading: 'Error',
                        text: data_obj.message,
                        icon: 'error',
                        position: 'mid-center'
                    });*/
                                      Swal.fire({
  position: 'top',
  icon: 'error',
  title: data_obj.message,
  showConfirmButton: true,
  timer: 2800
});
                      //$('#form-coordinator').trigger("reset");
                } else {
                    $.toast({
                        heading: 'Error',
                        text: 'Something went wrong.',
                        icon: 'error',
                        position: 'mid-center',
                    });
                    
                }
            },
            
            error: function (xhr, ajaxOptions, thrownError) 
            {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                $.toast({
                    heading: 'Error',
                    text: thrownError,
                    icon: 'error',
                    position: 'mid-center',

                });
            }
        });
    }
}

function verify_email()
 {
    if ($('#form-otp').valid()) // check if form is valid
    {
       // var coordinator_id = $("#coordinator_id").val();
       
        var form = $('#form-otp')[0]; 
          formData = new FormData(form);
          //formData.append('coordinator_id',$("#coordinator_id").val());
          //formData.append('group_desription', CKEDITOR.instances['group_desription'].getData());
         $.ajax({
            url: SITEROOT +'home/verify_email',
            type: "post",
             //data: $("#form-group").serialize() + '&group_id=' + group_id,
              data: formData,
              processData: false,
              contentType: false,
                 beforeSend: function () {
                showloader();
                $(".button").attr('disabled', 'disabled');
            },
            
            complete: function () {
                hideloader();
                $(".button").removeAttr('disabled');
                //$("#AddNewModal").modal('hide');
                 $('#form-otp').trigger("reset");
                 
            },
            success: function (response)
             {
               
                var data_obj = JSON.parse(response);
                  var vremail = data_obj.email;
                if ($.trim(data_obj.st1) === TRUE) {

                                      Swal.fire({
  position: 'top',
  icon: 'success',
  title: data_obj.message,
  showConfirmButton: true,
  timer: 2300
});
                   setTimeout(function () {
                      
                       //$("#dynamic-table").load(location.href + " #dynamic-table");
                       window.location.href='home/signup/?verifyemail='+vremail;
                    }, 3000);

                    

                } else if ($.trim(data_obj.status) === 'error') {
                    $.toast({
                        heading: 'Error',
                        text: data_obj.message,
                        icon: 'error',
                        position: 'mid-center'
                    });
                      $('#form-coordinator').trigger("reset");
                } else {
                    $.toast({
                        heading: 'Error',
                        text: 'Something went wrong.',
                        icon: 'error',
                        position: 'mid-center'
                    });
                    
                }
            },
            
            error: function (xhr, ajaxOptions, thrownError) 
            {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                $.toast({
                    heading: 'Error',
                    text: thrownError,
                    icon: 'error',
                    position: 'mid-center'

                });
            }
        });
    }
}
function set_password()
 {
    if ($('#form-setpassword').valid()) // check if form is valid
    {
       // var coordinator_id = $("#coordinator_id").val();
       
        var form = $('#form-setpassword')[0]; 
          formData = new FormData(form);
          //formData.append('coordinator_id',$("#coordinator_id").val());
          //formData.append('group_desription', CKEDITOR.instances['group_desription'].getData());
         $.ajax({
            url: SITEROOT +'home/set_password',
            type: "post",
             //data: $("#form-group").serialize() + '&group_id=' + group_id,
              data: formData,
              processData: false,
              contentType: false,
                 beforeSend: function () {
                showloader();
                $(".btn-submit").attr('disabled', 'disabled');
            },
            
            complete: function () {
                hideloader();
                 $(".btn-submit").removeAttr('disabled');
                 //$("#AddNewModal").modal('hide');
                 $('#form-setpassword').trigger("reset");
                 
            },
            success: function (response)
             {
                var data_obj = JSON.parse(response);
                  var vremail = data_obj.email;
                if ($.trim(data_obj.status) === 'success') {
                    $.toast({
                        heading: 'Success',
                        text: data_obj.message,
                        icon: 'success',
                       position: 'mid-center'
                    });
                    setTimeout(function () {
                      
                       //$("#dynamic-table").load(location.href + " #dynamic-table");
                       window.location.href='login/';
                    }, 1000);
                       

                    

                } else if ($.trim(data_obj.status) === 'error') {
                    $.toast({
                        heading: 'Error',
                        text: data_obj.message,
                        icon: 'error',
                        position: 'bottom-top'
                    });
                      $('#form-coordinator').trigger("reset");
                } else {
                    $.toast({
                        heading: 'Error',
                        text: 'Something went wrong.',
                        icon: 'error',
                        position: 'mid-center'
                    });
                    
                }
            },
            
            error: function (xhr, ajaxOptions, thrownError) 
            {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                $.toast({
                    heading: 'Error',
                    text: thrownError,
                    icon: 'error',
                   position: 'mid-center'

                });
            }
        });
    }
}
$('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() == $('#confirm_password').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else 
    $('#message').html('Not Matching').css('color', 'red');
});


