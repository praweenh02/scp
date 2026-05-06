function save_data()
{

    if ($('#form-expiry_date').valid()) // check if form is valid
    {
        var documentexpirydate_id = $("#documentexpirydate_id").val();

        var form = $('#form-expiry_date')[0]; 
        formData = new FormData(form);
        formData.append('documentexpirydate_id',$("#documentexpirydate_id").val());
          //formData.append('group_desription', CKEDITOR.instances['group_desription'].getData());
           //formData.append('group_meeting',   CKEDITOR.instances['group_meeting'].getData());
           //formData.append('mangement_team', CKEDITOR.instances['mangement_team'].getData());

           $.ajax({
            url: SITEROOT +'groupmanager/save_document_expiry_date',
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
                $('#form-expiry_date').trigger("reset");
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
                       window.location.href='groupmanager/document_expiry/';
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
         $.post(SITEROOT + 'groupmanager/delete_document_expiry_date', {id: id, csrf_token:csrf_token}, function (data) {deleteData
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
                            text: 'Document expiry date deleted successfully.',
                            icon: 'error',
                            position : 'bottom-center' 
                        });
                        setTimeout(function() {
                         window.location.href='groupmanager/document_expiry/';
                     }, 2000);
                    }
                });
     }
 }); 
}

function update_data()
{
      if ($('#form-group').valid()) // check if form is valid
      {
        var group_id = $("#group_id").val();
        var form = $('#form-group')[0]; 
        formData = new FormData(form);
        formData.append('group_id',$("#group_id").val());
        formData.append('group_description', CKEDITOR.instances['group_description'].getData());


        $.ajax({
            url: SITEROOT +'groupmanager/updateGroup',
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
                       window.location.href='groupmanager/groupedit/'+group_id;
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
function get_add_modal(corresponding_id,group_id)
{
   $('#popupdiv').html('');
   var csrf_token = $('input[name=csrf_token]').val();

   $.post(SITEROOT + 'groupmanager/add_corresponding_modal', {corresponding_id: corresponding_id, group_id:group_id, csrf_token:csrf_token}, function (data) {
    if ($.trim(data)) {
        $('#popupdiv').html(data);
        $('#AddNewModal').modal('show');

    }
});
}
function save_corresponding()
{
     if ($('#form-corresponding').valid()) // check if form is valid
     {

       var group_id = $("#group_id").val();
       var corresponding_id = $("#corresponding_id").val();
       var form = $('#form-corresponding')[0]; 
       formData = new FormData(form);
       formData.append('corresponding_id',$("#corresponding_id").val());
          //formData.append('group_description', CKEDITOR.instances['group_description'].getData());
          
          
          $.ajax({
            url: SITEROOT +'groupmanager/save_corresponding',
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
                $('#form-corresponding').trigger("reset");
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
                       window.location.href='groupmanager/manage_corresponding/'+group_id;
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

  function deleteCorresponding(id,group_id)
  {
    bootbox.confirm("Are you sure you want to delete this row?", function(result) {
        if(result==true)
        { 
         var csrf_token = $('input[name=csrf_token]').val();
         var $ele = $(this).parent().parent();
         $.post(SITEROOT + 'groupmanager/delete_corresponding', {id: id, csrf_token:csrf_token}, function (data) {deleteCorresponding
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
                            text: 'Corresponding data deleted successfully.',
                            icon: 'error',
                            position : 'bottom-center' 
                        });
                        setTimeout(function() {
                           window.location.href='groupmanager/manage_corresponding/'+group_id;
                       }, 2000);
                    }
                });
     }
 }); 


}
//Management Team
function get_managenet_modal(managementteam_id,group_id)
{

   $('#popupdiv').html('');
   var csrf_token = $('input[name=csrf_token]').val();

   $.post(SITEROOT + 'groupmanager/add_management_team_modal', {managementteam_id: managementteam_id, group_id:group_id, csrf_token:csrf_token}, function (data) {
    if ($.trim(data)) {
        $('#popupdiv').html(data);
        $('#AddNewModal1').modal('show');

    }
});
}

function save_management_team()
{
    if ($('#form-management_team').valid()) // check if form is valid
    {

       var group_id = $("#group_id").val();
       var corresponding_id = $("#managementteam_id").val();
       var form = $('#form-management_team')[0]; 
       formData = new FormData(form);
       formData.append('managementteam_id',$("#managementteam_id").val());
          //formData.append('group_description', CKEDITOR.instances['group_description'].getData());
          
          
          $.ajax({
            url: SITEROOT +'groupmanager/save_managementTeam',
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
                $("#AddNewModal1").modal('hide');
                $('#form-management_team').trigger("reset");
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
                       window.location.href='groupmanager/manage_management_team/'+group_id;
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

  function deleteManagentTeam(id,group_id)
  {
    bootbox.confirm("Are you sure you want to delete this row?", function(result) {
        if(result==true)
        { 
         var csrf_token = $('input[name=csrf_token]').val();
         var $ele = $(this).parent().parent();
         $.post(SITEROOT + 'groupmanager/deleteManagementTeam', {id: id, csrf_token:csrf_token}, function (data) {deleteManagentTeam
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
                            text: 'Data  deleted successfully.',
                            icon: 'error',
                            position : 'bottom-center' 
                        });
                        setTimeout(function() {
                           window.location.href='groupmanager/manage_management_team/'+group_id;
                       }, 2000);
                    }
                });
     }
 }); 


}
//Group Meeting
function save_meeting()
{
    if ($('#form-meeting').valid()) // check if form is valid
    {

       var meeting_id = $("#meeting_id").val();
         //var corresponding_id = $("#managementteam_id").val();
         var form = $('#form-meeting')[0]; 
         formData = new FormData(form);
         formData.append('member_id',$("#meeting_id").val());
          //formData.append('group_description', CKEDITOR.instances['group_description'].getData());
          
          
          $.ajax({
            url: SITEROOT +'groupmanager/save_meeting',
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
                $("#AddNewModal1").modal('hide');
                $('#form-meeting').trigger("reset");
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
                       window.location.href='groupmanager/group_meeting/';
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
  function deleteMeeting(id)
  {
    bootbox.confirm("Are you sure you want to delete this row?", function(result) {
        if(result==true)
        { 
         var csrf_token = $('input[name=csrf_token]').val();
         var $ele = $(this).parent().parent();
         $.post(SITEROOT + 'groupmanager/deleteMeeting', {id: id, csrf_token:csrf_token}, function (data) {deleteMeeting
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
                            text: 'Data  deleted successfully.',
                            icon: 'error',
                            position : 'bottom-center' 
                        });
                        setTimeout(function() {
                           window.location.href='groupmanager/group_meeting/';
                       }, 2000);
                    }
                });
     }
 }); 


}
//Working Item

function get_workingitem_modal(workitem_id,group_id)
{
   $('#popupdiv').html('');
   var csrf_token = $('input[name=csrf_token]').val();
   $.post(SITEROOT + 'groupmanager/add_workitem_modal', {workitem_id: workitem_id, group_id:group_id, csrf_token:csrf_token}, function (data) {
    if ($.trim(data)) {
        $('#popupdiv').html(data);
        $('#AddNewModal2').modal('show');

    }
});

}
function save_workitem()
{
    if ($('#form-workitem').valid()) // check if form is valid
    {

       var group_id = $("#group_id").val();
       var workitem_id = $("#workitem_id").val();
         //var corresponding_id = $("#managementteam_id").val();
         var form = $('#form-workitem')[0]; 
         formData = new FormData(form);
         formData.append('workitem_id',$("#workitem_id").val());
          //formData.append('group_description', CKEDITOR.instances['group_description'].getData());
          
          
          $.ajax({
            url: SITEROOT +'groupmanager/save_workitem',
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
                $("#AddNewModal1").modal('hide');
                $('#form-meeting').trigger("reset");
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
                       window.location.href='groupmanager/manage_working_item/'+group_id+'/';
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
  function deleteWorkItem(id,group_id)
  {
    bootbox.confirm("Are you sure you want to delete this row?", function(result) {
        if(result==true)
        { 
         var csrf_token = $('input[name=csrf_token]').val();
         var $ele = $(this).parent().parent();
         $.post(SITEROOT + 'groupmanager/deleteWorkItem', {id: id, csrf_token:csrf_token}, function (data) {deleteWorkItem
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
                            text: 'Work Item  deleted successfully.',
                            icon: 'error',
                            position : 'bottom-center' 
                        });
                        setTimeout(function() {
                           window.location.href='groupmanager/manage_working_item/'+group_id+'/';
                       }, 2000);
                    }
                });
     }
 }); 


}
function update_status()
{

    if ($('#form-doc').valid()) // check if form is valid
    {
        var contribution_id = $("#contribution_id").val();
        var sdo_id = $("#sdo_id").val();
        var group_id = $("#group_id").val();

        var form = $('#form-doc')[0]; 
        formData = new FormData(form);
        formData.append('contribution_id',$("#contribution_id").val());
        $.ajax({
            url: SITEROOT +'groupmanager/UpdateGroupManagerStatus',
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
                $('#form-group-manager').trigger("reset");
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
                       window.location.href='groupmanager/manage_document_uploaded_by_member/';
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
$(document).ready(function(){
    $("select.groups").change(function(){
       var csrf_token = $('input[name=csrf_token]').val();
       var category_id = $(".groups option:selected").val();

       $.ajax({
        type: "POST",
        url: SITEROOT+"groupmanager/getAllWorkingGroups",
        data:{category_id:category_id, csrf_token:csrf_token}
    }).done(function(data){

        $("#meeting_id").html(data);
    });
});
}); 
$(document).ready(function(){
    $("select.category1").change(function(){
       var csrf_token = $('input[name=csrf_token]').val();
       var category_id = $(".category1 option:selected").val();

       $.ajax({
        type: "POST",
        url: SITEROOT+"groupmanager/getAllNWGWorkingGroups",
        data:{category_id:category_id, csrf_token:csrf_token}
    }).done(function(data){

        $("#meeting_id").html(data);
    });
});
}); 

//Group Information 
function get_groupinformation_modal(group_information_id,group_id)
{
   $('#popupdiv').html('');
   var csrf_token = $('input[name=csrf_token]').val();
   $.post(SITEROOT + 'groupmanager/add_groupinformation_modal', {group_information_id: group_information_id, group_id:group_id, csrf_token:csrf_token}, function (data) {
    if ($.trim(data)) {
        $('#popupdiv').html(data);
        $('#AddNewModal3').modal('show');

    }
});

}
function save_group_information()
{
    if ($('#form-groupinformation').valid()) // check if form is valid
    {

       var group_id = $("#group_id").val();
       var group_information_id = $("#group_information_id").val();
         //var corresponding_id = $("#managementteam_id").val();
         var form = $('#form-groupinformation')[0]; 
         formData = new FormData(form);
         formData.append('group_information_id',$("#group_information_id").val());
          //formData.append('group_description', CKEDITOR.instances['group_description'].getData());
          
          
          $.ajax({
            url: SITEROOT +'groupmanager/save_groupinformation',
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
                $("#AddNewModal3").modal('hide');
                $('#form-groupinformation').trigger("reset");
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
                       window.location.href='groupmanager/manage_group_information/'+group_id+'/';
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
  function deleteGroupInformation(id,group_id)
  {
    bootbox.confirm("Are you sure you want to delete this row?", function(result) {
        if(result==true)
        { 
         var csrf_token = $('input[name=csrf_token]').val();
         var $ele = $(this).parent().parent();
         $.post(SITEROOT + 'groupmanager/deleteGroupInformation', {id: id, csrf_token:csrf_token}, function (data) {deleteGroupInformation
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
                            text: 'Group Information deleted successfully.',
                            icon: 'error',
                            position : 'bottom-center' 
                        });
                        setTimeout(function() {
                           window.location.href='groupmanager/manage_group_information/'+group_id+'/';
                       }, 2000);
                    }
                });
     }
 }); 


}
function save_outcomedocument() 
{
    if ($('#form-outcomedocument').valid()) // check if form is valid
    {

       var group_id = $("#group_id").val();
       var outcome_document_id  = $("#outcome_document_id").val();
         //var corresponding_id = $("#managementteam_id").val();
         var form = $('#form-outcomedocument')[0]; 
         formData = new FormData(form);
         formData.append('outcome_document_id',$("#outcome_document_id").val());
          //formData.append('group_description', CKEDITOR.instances['group_description'].getData());
          
          
          $.ajax({
            url: SITEROOT +'groupmanager/save_outcomedocument',
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
                $("#AddNewModal3").modal('hide');
                $('#form-outcomedocument').trigger("reset");
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
                       window.location.href='groupmanager/outcome_document/';
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
function deleteOutcomeDocument(id)
 {
      bootbox.confirm("Are you sure you want to delete this row?", function(result) {
        if(result==true)
        { 
         var csrf_token = $('input[name=csrf_token]').val();
         var $ele = $(this).parent().parent();
         $.post(SITEROOT + 'groupmanager/deleteOutcomeDocument', {id: id, csrf_token:csrf_token}, function (data) {deleteOutcomeDocument
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
                            text: 'Outcome Document deleted successfully.',
                            icon: 'error',
                            position : 'bottom-center' 
                        });
                        setTimeout(function() {
                           window.location.href='groupmanager/outcome_document/';
                       }, 2000);
                    }
                });
     }
  }); 
}
function save_doc_from_itusite()
{
    if ($('#form-docfromitu').valid()) // check if form is valid
    {

       var group_id = $("#group_id").val();
       var outcome_document_id  = $("#document_from_itu_id").val();
         //var corresponding_id = $("#managementteam_id").val();
         var form = $('#form-docfromitu')[0]; 
         formData = new FormData(form);
         formData.append('document_from_itu_id',$("#document_from_itu_id").val());
          //formData.append('group_description', CKEDITOR.instances['group_description'].getData());
          
          
          $.ajax({
            url: SITEROOT +'groupmanager/save_docfromitusite',
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
                $("#AddNewModal3").modal('hide');
                $('#form-docfromitu').trigger("reset");
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
                       window.location.href='groupmanager/document_from_itu/';
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
function deleteDocumentfromITU(id)
 {
    bootbox.confirm("Are you sure you want to delete this row?", function(result) {
        if(result==true)
        { 
         var csrf_token = $('input[name=csrf_token]').val();
         var $ele = $(this).parent().parent();
         $.post(SITEROOT + 'groupmanager/deleteDocumentfromITU', {id: id, csrf_token:csrf_token}, function (data) {deleteDocumentfromITU
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
                            text: 'Document deleted successfully.',
                            icon: 'error',
                            position : 'bottom-center' 
                        });
                        setTimeout(function() {
                           window.location.href='groupmanager/document_from_itu/';
                       }, 2000);
                    }
                });
     }
  }); 
}
//form-mintutes-meeting
function save_minutes_of_meeting()
{
    if ($('#form-minutes-meeting').valid()) // check if form is valid
    {

       var minutesofmeeting_id = $("#minutesofmeeting_id").val();
         //var corresponding_id = $("#managementteam_id").val();
         var form = $('#form-minutes-meeting')[0]; 
         formData = new FormData(form);
         formData.append('minutesofmeeting_id',$("#minutesofmeeting_id").val());
          //formData.append('group_description', CKEDITOR.instances['group_description'].getData());
          
          
          $.ajax({
            url: SITEROOT +'groupmanager/save_meeting_of_minutes',
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
                $("#AddNewModal1").modal('hide');
                $('#form-meeting').trigger("reset");
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
                       window.location.href='groupmanager/minutes_of_meeting/';
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
  function deleteMinuteofMeeting(id)
 {
    bootbox.confirm("Are you sure you want to delete this row?", function(result) {
        if(result==true)
        { 
         var csrf_token = $('input[name=csrf_token]').val();
         var $ele = $(this).parent().parent();
         $.post(SITEROOT + 'groupmanager/deleteMinuteofMeeting', {id: id, csrf_token:csrf_token}, function (data) {deleteMinuteofMeeting
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
                            text: 'Minutes of meeting deleted successfully.',
                            icon: 'error',
                            position : 'bottom-center' 
                        });
                        setTimeout(function() {
                           window.location.href='groupmanager/minutes_of_meeting/';
                       }, 2000);
                    }
                });
     }
  }); 
}
function save_circular()
{

    if ($('#form-circular').valid()) // check if form is valid
    {
        var group_id = $("#group_id").val();
       
        var form = $('#form-circular')[0]; 
          formData = new FormData(form);
          formData.append('group_id',$("#group_id").val());
          $.ajax({
            url: SITEROOT +'groupmanager/save_circular',
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
               $('#form-circular').trigger("reset");
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
                       window.location.href='groupmanager/circulars/';
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
function deleteCirculars(id,group_id)
{
    var el = this;
    bootbox.confirm("Are you sure you want to delete this row?", function(result) {
        if(result==true)
        { 
            
           var csrf_token = $('input[name=csrf_token]').val();
           var $ele = $(this).parent().parent();
            $.post(SITEROOT + 'groupmanager/deleteCirculars', {id: id, csrf_token:csrf_token}, function (data) {deleteCirculars
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
                            text: 'Circular deleted successfully.',
                            icon: 'error',
                            position : 'bottom-center' 
                        });
                        setTimeout(function() {
                             window.location.href='groupmanager/circulars/';
                               //$(el).closest('tr').css('background','tomato');
                               //$(el).closest('tr').fadeOut(800,function(){
                               //$(this).remove();
                                //});
              
                        }, 2000);
                    }
            });
        }
        }); 
   }
   
   



