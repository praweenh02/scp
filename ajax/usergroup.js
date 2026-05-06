function get_add_modal(group_id)
 {
     $('#popupdiv').html('');
     var csrf_token = $('input[name=csrf_token]').val();
    
    $.post(SITEROOT + 'group/create', {group_id: group_id, csrf_token:csrf_token}, function (data) {
        if ($.trim(data)) {
            $('#popupdiv').html(data);
            $('#AddNewModal').modal('show');

        }
    });
}
function save_data()
{

    if ($('#form-group').valid()) // check if form is valid
    {
        var group_id = $("#group_id").val();
       
        var form = $('#form-group')[0]; 
          formData = new FormData(form);
          formData.append('group_id',$("#group_id").val());
          //formData.append('group_desription', CKEDITOR.instances['group_desription'].getData());
         $.ajax({
            url: SITEROOT +'group/save_data',
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
                $('#form-group').trigger("reset");
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
                       window.location.href='group/';
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
function deleteData(id)
{
    bootbox.confirm("Are you sure you want to delete this row?", function(result) {
        if(result==true)
        { 
           var csrf_token = $('input[name=csrf_token]').val();
           var $ele = $(this).parent().parent();
            $.post(SITEROOT + 'group/delete_data', {id: id, csrf_token:csrf_token}, function (data) {deleteData
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
                            text: 'Group deleted successfully.',
                            icon: 'error',
                            position : 'bottom-center' 
                        });
                        setTimeout(function() {
                            window.location.href='super-admin/group';
                        }, 2000);
                    }
            });
        }
        }); 
   }
