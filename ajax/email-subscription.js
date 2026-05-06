function save_data()
{


    if ($('#email-subs').valid()) // check if form is valid
    {
         var form = $('#email-subs')[0]; 
          formData = new FormData(form);
      
          // var languages = [];  
          //  $('.get_value').each(function(){  
          //       if($(this).is(":checked"))  
          //       {  
          //            languages.push($(this).val());  
          //       }  
          //  });  
          //  languages = languages.toString();
           //alert(languages);
          
           $.ajax({
            url: SITEROOT +'email/submitemailSubscription',
            type: "post",
             data: formData,
            //data:{languages:languages}, 
               processData: false,
               contentType: false,
             beforeSend: function () {
                showloader();
                $(".btn-submit").attr('disabled', 'disabled');
            },
            
            complete: function () {
                hideloader();
                $(".btn-submit").removeAttr('disabled');
                $("#AddNewModal").modal('hide');
                $('#form-faq').trigger("reset");
            },
            success: function (response)
            {
                console
                var data_obj = JSON.parse(response);
                if ($.trim(data_obj.status) === 'success') {
                    $.toast({
                        heading: 'Success',
                        text: data_obj.message,
                        icon: 'success',
                        position: 'top-center'
                    });
                    setTimeout(function () {
                      
                       //$("#dynamic-table").load(location.href + " #dynamic-table");
                       window.location.href='email/';
                   }, 2000);

                } else if ($.trim(data_obj.status) === 'error') {
                    $.toast({
                        heading: 'Error',
                        text: data_obj.message,
                        icon: 'error',
                        position: 'top-center'
                    });
                } else {
                    $.toast({
                        heading: 'Error',
                        text: 'Something went wrong.',
                        icon: 'error',
                        position: 'bottom-center'
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
                    position: 'bottom-center',

                });
            }
        });
       }
   }
   function deleteData(id)
   {
    bootbox.confirm("Are you sure you want to delete this row?", function(result) {
        if(result==true)
        { 
         var csrf_token = $('input[name=csrf_token]').val();
         var $ele = $(this).parent().parent();
         $.post(SITEROOT + 'super-admin/faq/delete_data', {id: id, csrf_token:csrf_token}, function (data) {deleteData
             if ($.trim(data) != 'success') {
                        //hideloader();
                        $.toast({
                            heading: 'Error',
                            text: 'Something went wrong.',
                            icon: 'warning',
                            position : 'top-center' 
                        });
                    } else {
                        //hideloader();
                        $.toast({
                            heading: 'Deleted',
                            text: 'FAQ deleted successfully.',
                            icon: 'error',
                            position : 'top-center' 
                        });
                        setTimeout(function() {
                            window.location.href='super-admin/faq/';
                        }, 2000);
                    }
                });
     }
 }); 
}
//Email send 
function send_email()
{


    if ($('#send-email').valid()) // check if form is valid
    {
         var form = $('#send-email')[0]; 
          formData = new FormData(form);
          formData.append('email_message', CKEDITOR.instances['email_message'].getData());
          
           $.ajax({
            url: SITEROOT +'outreach/send_email_to_all',
            type: "post",
             data: formData,
            //data:{languages:languages}, 
               processData: false,
             contentType: false,
             beforeSend: function () {
                //showloader();
                $(".btn-submit").attr('disabled', 'disabled');
            },
            
            complete: function () {
                hideloader();
                $(".btn-submit").removeAttr('disabled');
                $("#AddNewModal").modal('hide');
                $('#send-email').trigger("reset");
                CKEDITOR.instances.email_message.setData('');
            },
            success: function (response)
            {
               
                var data_obj = JSON.parse(response);
                if ($.trim(data_obj.status) === 'success') {
                    $.toast({
                        heading: 'Success',
                        text: data_obj.message,
                        icon: 'success',
                        position: 'top-center'
                    });
                    setTimeout(function () {
                      
                       //$("#dynamic-table").load(location.href + " #dynamic-table");
                       //window.location.href='outreach';
                   }, 2000);

                } else if ($.trim(data_obj.status) === 'error') {
                    $.toast({
                        heading: 'Error',
                        text: data_obj.message,
                        icon: 'error',
                        position: 'top-center'
                    });
                } else {
                    $.toast({
                        heading: 'Error',
                        text: 'Something went wrong.',
                        icon: 'error',
                        position: 'bottom-center'
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
                    position: 'bottom-center',

                });
            }
        });
       }
}
function send_email_by_sadmin()
{


    if ($('#send-email').valid()) // check if form is valid
    {
         var form = $('#send-email')[0]; 
          formData = new FormData(form);
          formData.append('email_message', CKEDITOR.instances['email_message'].getData());
          
           $.ajax({
            url: SITEROOT +'super-admin/outreach/send_email_to_all',
            type: "post",
             data: formData,
            //data:{languages:languages}, 
               processData: false,
             contentType: false,
             beforeSend: function () {
                //showloader();
                $(".btn-submit").attr('disabled', 'disabled');
            },
            
            complete: function () {
                hideloader();
                $(".btn-submit").removeAttr('disabled');
                $("#AddNewModal").modal('hide');
                $('#send-email').trigger("reset");
                CKEDITOR.instances.email_message.setData('');
            },
            success: function (response)
            {
               
               console.log(response);
                var data_obj = JSON.parse(response);
                if ($.trim(data_obj.status) === 'success') {
                    $.toast({
                        heading: 'Success',
                        text: data_obj.message,
                        icon: 'success',
                        position: 'top-center'
                    });
                    setTimeout(function () {
                      
                       //$("#dynamic-table").load(location.href + " #dynamic-table");
                       window.location.href='super-admin/outreach/email';
                   }, 2000);

                } else if ($.trim(data_obj.status) === 'error') {
                    $.toast({
                        heading: 'Error',
                        text: data_obj.message,
                        icon: 'error',
                        position: 'top-center'
                    });
                } else {
                    $.toast({
                        heading: 'Error',
                        text: 'Something went wrong.',
                        icon: 'error',
                        position: 'bottom-center'
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
                    position: 'bottom-center',

                });
            }
        });
       }
}
$(document).ready(function(){

  // Check/Uncheck ALl
  $('#checkAll').change(function(){
    if($(this).is(':checked')){
      $('input[name="email_subscription[]"]').prop('checked',true);
    }else{
      $('input[name="email_subscription[]"]').each(function(){
         $(this).prop('checked',false);
      });
    }
  });

  // Checkbox click
  $('input[name="email_subscription[]"]').click(function(){
    var total_checkboxes = $('input[name="email_subscription[]"]').length;
    var total_checkboxes_checked = $('input[name="email_subscription[]"]:checked').length;

    if(total_checkboxes_checked == total_checkboxes){
       $('#checkAll').prop('checked',true);
    }else{
       $('#checkAll').prop('checked',false);
    }
  });
});

$(document).ready(function(){
    $("category").change(function(){
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

