function subverify_email()
 {
     
    
         var otp = $("#otp").val();
         var email = $("#email").val();
         
       
        var form = $('#form-subotps')[0]; 
          formData = new FormData(form);
          //formData.append('coordinator_id',$("#coordinator_id").val());
          //formData.append('group_desription', CKEDITOR.instances['group_desription'].getData());
         $.ajax({
            url: SITEROOT +'home/subscriptionverify_email',
            type: "post",
             data: $("#form-subotps").serialize(),
              //data: formData,
              //processData: false,
              //contentType: false,
                 beforeSend: function () {
                showloader();
                $(".button").attr('disabled', 'disabled');
            },
            
            complete: function () {
                hideloader();
                $(".button").removeAttr('disabled');
                //$("#AddNewModal").modal('hide');
                 $('#form-subotps').trigger("reset");
                 
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
  showConfirmButton: true,
  timer: 2300
});
                    setTimeout(function () {
                      
                       //$("#dynamic-table").load(location.href + " #dynamic-table");
                       window.location.href='home/successotp/';
                    }, 2500);
                       

                    

                } else if ($.trim(data_obj.status) === 'error') {
                    $.toast({
                        heading: 'Error',
                        position: 'top',
                        text: data_obj.message,
                        icon: 'error',
                        position: 'mid-center'
                    });
                      $('#form-coordinator').trigger("reset");
                } else {
                    $.toast({
                        heading: 'Error',
                        position: 'top',
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