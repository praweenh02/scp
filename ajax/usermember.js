function update_status()
{

    if ($('#form-member1').valid()) // check if form is valid
    {
        var member_id = $("#member_id").val();
         var group_id = $("#group_id").val();
       
        var form = $('#form-member1')[0]; 
          formData = new FormData(form);
          formData.append('member_id',$("#member_id").val());
          //formData.append('group_desription', CKEDITOR.instances['group_desription'].getData());
           //formData.append('group_meeting',   CKEDITOR.instances['group_meeting'].getData());
           //formData.append('mangement_team', CKEDITOR.instances['mangement_team'].getData());
          
         $.ajax({
            url: SITEROOT +'member/recommend_superAdmin',
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
               $('#form-member1').trigger("reset");
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
                       window.location.href='member/view_member_list/'+member_id+'/';
                    }, 2000);

                } else if ($.trim(data_obj.status) === 'error') {
                    $.toast({
                        heading: 'Error',
                        text: data_obj.message,
                        icon: 'error',
                        position: 'bottom-center'
                    });
                     setTimeout(function () {
                      
                       window.location.href='member/group_users/'+group_id+'/';
                    }, 2000);
                } else {
                    $.toast({
                        heading: 'Error',
                        text: 'Something went wrong.',
                        icon: 'error',
                        position: 'bottom-center'
                    });
                     setTimeout(function () {
                      
                       window.location.href='member/group_users/'+group_id+'/';
                    }, 2000);
                    
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
            $.post(SITEROOT + 'super-admin/outreach/delete_data', {id: id, csrf_token:csrf_token}, function (data) {deleteData
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
                            text: 'Subscriber deleted successfully.',
                            icon: 'error',
                            position : 'bottom-center' 
                        });
                        setTimeout(function() {
                            window.location.href='super-admin/outreach/subscriber';
                        }, 2000);
                    }
            });
        }
        }); 
   }
