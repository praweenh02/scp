function save_data()
{

    if ($('#form-upload1').valid()) // check if form is valid
    {
        var group_id = $("input[name='group_id']").val();

        var sdo_id = $("#sdo_id").val();
       
        var form = $('#form-upload1')[0]; 
          formData = new FormData(form);
         // formData.append('group_id',$("#group_id").val());
          $.ajax({
            url: SITEROOT +'group/doc_registration',
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
                       window.location.href='group/upload_doc_file/'+sdo_id+'/'+group_id;
                       $('#reg-1').hide();
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
function deleteData(id,sdo_id,group_id)
{
    bootbox.confirm("Are you sure you want to delete this row?", function(result) {
        if(result==true)
        { 
           var csrf_token = $('input[name=csrf_token]').val();
           var $ele = $(this).parent().parent();
            $.post(SITEROOT + 'group/docRegistrationDelete', {id: id, csrf_token:csrf_token}, function (data) {deleteData
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
                            text: 'Contribution data deleted successfully.',
                            icon: 'error',
                            position : 'bottom-center' 
                        });
                        setTimeout(function() {
                            window.location.href='group/upload_revision_of_existing_contribution/'+sdo_id+'/'+group_id+'/';
                        }, 2000);
                    }
            });
        }
        }); 
   }
   function deleteData1(id,sdo_id,group_id)
{
    bootbox.confirm("Are you sure you want to delete this row?", function(result) {
        if(result==true)
        { 
           var csrf_token = $('input[name=csrf_token]').val();
           var $ele = $(this).parent().parent();
            $.post(SITEROOT + 'group/docRegistrationDelete', {id: id, csrf_token:csrf_token}, function (data) {deleteData
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
                            text: 'Contribution data deleted successfully.',
                            icon: 'error',
                            position : 'bottom-center' 
                        });
                        setTimeout(function() {
                            window.location.href='group/upload_doc_file/'+sdo_id+'/'+group_id+'/';
                        }, 2000);
                    }
            });
        }
        }); 
   }
   function deleteMemberUploadDoc(contribution_id)
{
    
    bootbox.confirm("Are you sure you want to delete this row?", function(result) {
        if(result==true)
        { 
           var csrf_token = $('input[name=csrf_token]').val();
           var $ele = $(this).parent().parent();
            $.post(SITEROOT + 'groupmanager/deleteMemberUploadDoc', {id: contribution_id, csrf_token:csrf_token}, function (deleteMemberUploadDoc) {deleteData
               if ($.trim(data) != 'success') {
                        //hideloader();
                        $.toast({
                            heading: 'Error',
                            text: 'Something went wrong.',
                            icon: 'warning',
                            position : 'top' 
                        });
                    } else {
                        //hideloader();
                        $.toast({
                            heading: 'success',
                            text: 'Contribution data deleted successfully.',
                            icon: 'success',
                            position : 'top' 
                        });
                        setTimeout(function() {
                            window.location.href='groupmanager/manage_document_uploaded_by_member/';
                        }, 2000);
                    }
            });
        }
        }); 
   }
   
$(document).ready(function(){

 // Delete 
 $('.delete_contributoer').click(function(){
   var el = this;
  
   // Delete id
   var deleteid = $(this).data('id');
   var csrf_token = $('input[name=csrf_token]').val();
   var confirmalert = confirm("Are you sure?");
   if (confirmalert == true) {
      // AJAX Request
      $.ajax({
         url: SITEROOT +'group/delete_contributoer',
        type: 'POST',
        data: { id:deleteid, csrf_token:csrf_token },
        success: function(response){
           
          if(response ='success'){
    // Remove row from HTML Table
    $(el).closest('tr').css('background','tomato');
    $(el).closest('tr').fadeOut(800,function(){
       $(this).remove();
    });
          $.toast({
                            heading: 'Deleted',
                            text: 'Contribution data deleted successfully.',
                            icon: 'error',
                            position : 'bottom-center' 
                        });
          }else{
          //alert('Invalid ID.');
          }

        }
      });
   }

 });

});  

function save_file()
{
    if ($('#form-upload2').valid()) // check if form is valid
    {
        var group_id = $("input[name='group_id']").val();

        var sdo_id = $("#sdo_id").val();
       
        var form = $('#form-upload2')[0]; 
          formData = new FormData(form);
         // formData.append('group_id',$("#group_id").val());
          $.ajax({
            url: SITEROOT +'group/doc_upload',
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
                 $('#form-upload2').trigger("reset");
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
                       window.location.href='group/upload_revision_of_existing_contribution/'+sdo_id+'/'+group_id;
                       $('#reg-1').hide();
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
function re_upload_file_save()
{
    if ($('#form-reupload').valid()) // check if form is valid
    {
        var group_id = $("input[name='group_id']").val();

        var sdo_id = $("#sdo_id").val();
       
        var form = $('#form-reupload')[0]; 
          formData = new FormData(form);
         // formData.append('group_id',$("#group_id").val());
          $.ajax({
            url: SITEROOT +'group/Submit_upload_doc_file',
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
                 $('#form-reupload').trigger("reset");
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
                       window.location.href='group/upload_revision_of_existing_contribution/'+sdo_id+'/'+group_id;
                       $('#reg-1').hide();
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
    $("select.category").change(function(){
         var csrf_token = $('input[name=csrf_token]').val();
        var category_id = $(".category option:selected").val();
        
        $.ajax({
            type: "POST",
            url: SITEROOT+"home/getAllWorkItem",
           data:{category_id:category_id, csrf_token:csrf_token}
        }).done(function(data){
            
            $("#workitem_id").html(data);
        });
    });
});
