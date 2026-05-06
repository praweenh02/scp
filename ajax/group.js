function get_add_modal(group_id) {
    $('#popupdiv').html('');
    var csrf_token = $('input[name=csrf_token]').val();

    $.post(SITEROOT + '/super-admin/group/create', { group_id: group_id, csrf_token: csrf_token }, function (data) {
        if ($.trim(data)) {
            $('#popupdiv').html(data);
            $('#AddNewModal').modal('show');

        }
    });
}

$(document).ready(function () {
    $("select.category").change(function () {
        var csrf_token = $('input[name=csrf_token]').val();
        var category_id = $(".category option:selected").val();

        $.ajax({
            type: "POST",
            url: SITEROOT + "home/getAllGroups",
            data: { category_id: category_id, csrf_token: csrf_token }
        }).done(function (data) {

            $("#group_id").html(data);
        });
    });
});
function save_data() {

    if ($('#form-group').valid()) // check if form is valid
    {
        var group_id = $("#group_id").val();

        var form = $('#form-group')[0];
        formData = new FormData(form);
        formData.append('group_id', $("#group_id").val());
        formData.append('group_desription', CKEDITOR.instances['group_desription'].getData());
        // formData.append('group_meeting',   CKEDITOR.instances['group_meeting'].getData());
        // formData.append('mangement_team', CKEDITOR.instances['mangement_team'].getData());

        $.ajax({
            url: SITEROOT + 'super-admin/group/save_data',
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
            success: function (response) {
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
                        window.location.href = 'super-admin/group';
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

            error: function (xhr, ajaxOptions, thrownError) {
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
function deleteData(id) {
    bootbox.confirm("Are you sure you want to delete this row?", function (result) {
        if (result === true) {
            if (confirm("Are you sure you want to delete?")) {
                var csrf_token = $('input[name=csrf_token]').val();
                var $ele = $(this).parent().parent();
                $.post(SITEROOT + 'super-admin/group/delete_data', { id: id, csrf_token: csrf_token }, function (data) {
                    deleteData
                    if ($.trim(data) != 'success') {
                        //hideloader();
                        $.toast({
                            heading: 'Error',
                            text: 'Something went wrong.',
                            icon: 'warning',
                            position: 'bottom-center'
                        });
                    } else {
                        //hideloader();
                        $.toast({
                            heading: 'Deleted',
                            text: 'Group deleted successfully.',
                            icon: 'error',
                            position: 'bottom-center'
                        });
                        setTimeout(function () {
                            window.location.href = 'super-admin/group';
                        }, 2000);
                    }
                });
            }
        }
    });
}
function restoreGroup(id) {
    bootbox.confirm("Are you sure you want to restored this group?", function (result) {
        if (result === true) {
            var csrf_token = $('input[name=csrf_token]').val();
            var $ele = $(this).parent().parent();
            $.post(SITEROOT + 'super-admin/group/restore_data', { id: id, csrf_token: csrf_token }, function (data) {
                deleteData
                if ($.trim(data) == 'false') {
                    //hideloader();
                    $.toast({
                        heading: 'Error',
                        text: 'Something went wrong.',
                        icon: 'warning',
                        position: 'bottom-center'
                    });
                } else {
                    //hideloader();
                    $.toast({
                        heading: 'Deleted',
                        text: 'Group restored successfully.',
                        icon: 'success',
                        position: 'bottom-center'
                    });
                    setTimeout(function () {
                        window.location.href = 'super-admin/group';
                    }, 2000);
                }
            });
        }
    });

}

function restoreSdo(id) {
    bootbox.confirm("Are you sure you want to restored this group?", function (result) {
        if (result === true) {
            var csrf_token = $('input[name=csrf_token]').val();
            var $ele = $(this).parent().parent();
            $.post(SITEROOT + 'super-admin/group/updaterestore_sdo', { id: id, csrf_token: csrf_token }, function (data) {
                deleteData
                if ($.trim(data) == 'false') {
                    //hideloader();
                    $.toast({
                        heading: 'Error',
                        text: 'Something went wrong.',
                        icon: 'warning',
                        position: 'bottom-center'
                    });
                } else {
                    //hideloader();
                    $.toast({
                        heading: 'Deleted',
                        text: 'SDO restored successfully.',
                        icon: 'success',
                        position: 'bottom-center'
                    });
                    setTimeout(function () {
                        window.location.href = 'super-admin/group/group_category/';
                    }, 2000);
                }
            });
        }
    });

}

function save_workingparty() {
    if ($('#form-party').valid()) // check if form is valid
    {
        var workingparty_id = $("#workingparty_id").val();

        var form = $('#form-party')[0];
        formData = new FormData(form);


        $.ajax({
            url: SITEROOT + 'super-admin/group/save_workingparty',
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
                $('#form-party').trigger("reset");
            },
            success: function (response) {
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
                        window.location.href = 'super-admin/group/working_party/';
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

            error: function (xhr, ajaxOptions, thrownError) {
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
function deleteData1(id) {
    bootbox.confirm("Are you sure you want to delete this row?", function (result) {
        if (result == true) {
            var csrf_token = $('input[name=csrf_token]').val();
            var $ele = $(this).parent().parent();
            $.post(SITEROOT + 'super-admin/group/delete_workingparty', { id: id, csrf_token: csrf_token }, function (data) {
                deleteData1
                if ($.trim(data) != 'success') {
                    //hideloader();
                    $.toast({
                        heading: 'Error',
                        text: 'Something went wrong.',
                        icon: 'warning',
                        position: 'bottom-center'
                    });
                } else {
                    //hideloader();
                    $.toast({
                        heading: 'Deleted',
                        text: 'Working Party deleted successfully.',
                        icon: 'error',
                        position: 'bottom-center'
                    });
                    setTimeout(function () {
                        window.location.href = 'super-admin/group/working_party/';
                    }, 2000);
                }
            });
        }
    });
}
//Chnage display order
$(".row_position").sortable({
    delay: 150,
    stop: function () {
        var selectedData = new Array();
        $('.row_position>tr').each(function () {
            selectedData.push($(this).attr("id"));
        });
        updateOrder(selectedData);
    }
});

function updateOrder(data) {
    //var csrf_token = <?php echo $this->security->get_csrf_hash(); ?>;
    var csrf_token = $('input[name="csrf_token"]').val();

    $.ajax({
        url: SITEROOT + "super-admin/group/update_group_order/",
        type: 'post',
        data: { position: data, csrf_token: csrf_token },
        success: function ($data) {

        }
    })
}
function getSdoId(val) {
    //Forward browser to new url
    window.location = SITEROOT + 'super-admin/group/sdo_filter/' + val + '/';
}
