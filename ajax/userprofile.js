function Change_profile()
{

    if ($('#form-profile').valid()) // check if form is valid
    {
       
        var form = $('#form-profile')[0]; 
          formData = new FormData(form);
         //formData.append('instructions', CKEDITOR.instances['instructions'].getData());
         $.ajax({
            url: SITEROOT +'login/updateProfile',
            type: "post",
            //data: $("#form-changepassword").serialize(),
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
                //$("#menusModal").modal('hide');
               $('#form-profile').trigger("reset");
            },
            success: function (response)
             {
                var data_obj = JSON.parse(response);
                if ($.trim(data_obj.status) === 'success') {
                    $.toast({
                        heading: 'Success',
                        text: data_obj.message,
                        icon: 'success',
                        position: 'mid-center'
                    });
                    setTimeout(function () {
                       $("#updprofile").load(location.href + " #updprofile");
                    }, 2000);

                } else if ($.trim(data_obj.status) === 'error') {
                    $.toast({
                        heading: 'Error',
                        text: data_obj.message,
                        icon: 'error',
                        position: 'mid-center'
                    });
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