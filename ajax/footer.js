
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

    if ($('#form-footer').valid()) // check if form is valid
    {
        var footer_id = $("#footer_id").val();
       
        var form = $('#form-footer')[0]; 
          formData = new FormData(form);
          formData.append('footer_id',$("#footer_id").val());
          formData.append('section_1', CKEDITOR.instances['section_1'].getData());
          formData.append('section_2', CKEDITOR.instances['section_2'].getData());
          formData.append('section_3', CKEDITOR.instances['section_3'].getData());
          formData.append('section_4', CKEDITOR.instances['section_4'].getData());
          
         $.ajax({
            url: SITEROOT +'super-admin/footer/save_data',
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
                $("#AddNewModal").modal('hide');
                $('#form-faq').trigger("reset");
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
                       window.location.href='super-admin/footer/';
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
            $.post(SITEROOT + 'super-admin/footer/delete_data', {id: id, csrf_token:csrf_token}, function (data) {deleteData
               if ($.trim(data) != 'success') {
                        //hideloader();
                        $.toast({
                            heading: 'Error',
                            text: 'Something went wrong.',
                            icon: 'warning',
                            position : 'bottom-center' 
                        });
                    } else {
                        //hideloader();
                        $.toast({
                            heading: 'Deleted',
                            text: 'FAQ deleted successfully.',
                            icon: 'error',
                            position : 'bottom-center' 
                        });
                        setTimeout(function() {
                            window.location.href='super-admin/footer/';
                        }, 2000);
                    }
            });
        }
        }); 
   }
