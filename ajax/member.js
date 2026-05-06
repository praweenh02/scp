$(document).ready(function(){
    $("select.sdo").change(function(){
         var csrf_token = $('input[name=csrf_token]').val();
        var category_id = $(".sdo option:selected").val();
        
        $.ajax({
            type: "POST",
            url: SITEROOT+"super-admin/member/getAllGroups",
           data:{category_id:category_id, csrf_token:csrf_token}
        }).done(function(data){
            
            $("#group_id").html(data);

        });
    });
});
function save_data()
{

    if ($('#form-member').valid()) // check if form is valid
    {
        var member_id = $("#member_id").val();
       
        var form = $('#form-member')[0]; 
          formData = new FormData(form);
          formData.append('member_id',$("#member_id").val());
          //formData.append('group_desription', CKEDITOR.instances['group_desription'].getData());
           //formData.append('group_meeting',   CKEDITOR.instances['group_meeting'].getData());
           //formData.append('mangement_team', CKEDITOR.instances['mangement_team'].getData());
          
         $.ajax({
            url: SITEROOT +'super-admin/member/accecpt_new_recommend_user',
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
               $('#form-member').trigger("reset");
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
                       window.location.href='super-admin/member/member_list/';
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
function update_status()
{

    if ($('#form-member1').valid()) // check if form is valid
    {
        var member_id = $("#member_id").val();
       
        var form = $('#form-member1')[0]; 
          formData = new FormData(form);
          formData.append('member_id',$("#member_id").val());
          //formData.append('group_desription', CKEDITOR.instances['group_desription'].getData());
           //formData.append('group_meeting',   CKEDITOR.instances['group_meeting'].getData());
           //formData.append('mangement_team', CKEDITOR.instances['mangement_team'].getData());
          
         $.ajax({
            url: SITEROOT +'super-admin/member/update_status',
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
                       window.location.href='super-admin/member/member_list/';
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
function make_group_manager()
{

    if ($('#form-member2').valid()) // check if form is valid
    {
        var member_id = $("#member_id").val();
       
        var form = $('#form-member2')[0]; 
          formData = new FormData(form);
          formData.append('member_id',$("#member_id").val());
          //formData.append('group_desription', CKEDITOR.instances['group_desription'].getData());
           //formData.append('group_meeting',   CKEDITOR.instances['group_meeting'].getData());
           //formData.append('mangement_team', CKEDITOR.instances['mangement_team'].getData());
          
         $.ajax({
            url: SITEROOT +'super-admin/member/create_group_manager',
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
               $('#form-member2').trigger("reset");
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
                       window.location.href='super-admin/member/group_manager_list/';
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
            $.post(SITEROOT + 'super-admin/member/delete_data', {id: id, csrf_token:csrf_token}, function (data) {deleteData
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
                            window.location.href='super-admin/member';
                        }, 2000);
                    }
            });
        }
        }); 
}
function removeGroupManager(user_id,group_id)
{
    
    bootbox.confirm("Are you sure you want to Remove group manager?", function(result) {
        if(result==true)
        { 
           var csrf_token = $('input[name=csrf_token]').val();
           var $ele = $(this).parent().parent();
            $.post(SITEROOT + 'super-admin/member/removeGroupManager', {user_id: user_id, csrf_token:csrf_token}, function (data) {removeGroupManager
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
                            text: 'Group  Member deleted successfully.',
                            icon: 'error',
                            position : 'bottom-center' 
                        });
                        setTimeout(function() {
                            window.location.href='super-admin/member/group_manager_list';
                        }, 2000);
                    }
            });
        }
        }); 

}
function deleteMember(user_id)
{
    
    bootbox.confirm("Are you sure you want to Remove group manager?", function(result) {
        if(result==true)
        { 
           var csrf_token = $('input[name=csrf_token]').val();
           var $ele = $(this).parent().parent();
           alert(user_id);
            $.post(SITEROOT + 'super-admin/member/deleteMember', {user_id: user_id, csrf_token:csrf_token}, function (data) {deleteMember
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
                            text: 'Member deleted successfully.',
                            icon: 'error',
                            position : 'bottom-center' 
                        });
                        setTimeout(function() {
                    //window.location.href='super-admin/member/member_list/';
                        }, 2000);
                    }
            });
        }
        }); 

}
function change_password()
{

    if ($('#form-password').valid()) // check if form is valid
    {
        var member_id = $("#member_id").val();
       
        var form = $('#form-password')[0]; 
          formData = new FormData(form);
          formData.append('member_id',$("#member_id").val());
          //formData.append('group_desription', CKEDITOR.instances['group_desription'].getData());
           //formData.append('group_meeting',   CKEDITOR.instances['group_meeting'].getData());
           //formData.append('mangement_team', CKEDITOR.instances['mangement_team'].getData());
          
         $.ajax({
            url: SITEROOT +'super-admin/member/passwordChange',
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
                $('#form-password').trigger("reset");
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
                       window.location.href='super-admin/member/member_list/';
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
function  deleteMember(id)
{

    bootbox.confirm("Are you sure you want to delete this row?", function(result) {
        if(result==true)
        { 
           var csrf_token = $('input[name=csrf_token]').val();
           var $ele = $(this).parent().parent();
            $.post(SITEROOT + 'super-admin/member/deleteMember', {user_id: id, csrf_token:csrf_token}, function (data) {deleteMember
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
                            text: 'Member  deleted successfully.',
                            icon: 'error',
                            position : 'bottom-center' 
                        });
                        setTimeout(function() {
                            window.location.href='super-admin/member/member_list/';
                        }, 2000);
                    }
            });
        }
        }); 
}

