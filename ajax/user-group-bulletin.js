function save_data()
{

    if ($('#form-groupbulletin').valid()) // check if form is valid
    {
        var group_id = $("input[name='group_id']").val();

        var sdo_id = $("#sdo_id").val();
       
        var form = $('#form-groupbulletin')[0]; 
          formData = new FormData(form);
         // formData.append('group_id',$("#group_id").val());
          $.ajax({
            url: SITEROOT +'groupbulletin/save_data',
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
                 $('#form-upload1').trigger("reset");
            },
            success: function (response)
             {
                var data_obj = JSON.parse(response);
                if ($.trim(data_obj.status) === 'success') {
                    $.toast({
                        heading: 'Success',
                        text: data_obj.message,
                        icon: 'success',
                        position: 'bottom-center'
                    });
                    setTimeout(function () {
                      
                       //$("#dynamic-table").load(location.href + " #dynamic-table");
                       window.location.href='groupbulletin/';
                    }, 2000);

                } else if ($.trim(data_obj.status) === 'error') {
                    $.toast({
                        heading: 'Error',
                        text: data_obj.message,
                        icon: 'error',
                        position: 'bottom-center'
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
function deleteGroupBulletin(id)
{
    bootbox.confirm("Are you sure you want to delete this row?", function(result) {
        if(result==true)
        { 
           var csrf_token = $('input[name=csrf_token]').val();
           var $ele = $(this).parent().parent();
            $.post(SITEROOT + 'groupbulletin/deleteGroupBulletin', {id: id, csrf_token:csrf_token}, function (data) {deleteGroupBulletin
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
                            text: 'Group Bulletin data deleted successfully.',
                            icon: 'error',
                            position : 'bottom-center' 
                        });
                        setTimeout(function() {
                            window.location.href='groupbulletin/';
                        }, 2000);
                    }
            });
        }
        }); 
   }