<?= include_once('header.inc.php'); ?>



<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Vendor list</h1>
            <!-- <p>Supplier list</p>-->
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg" onClick="window.location.href='dashboard'"></i></li>
            <li class="breadcrumb-item"><a href="#"> Vendor list</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">


            <div class="tile">


                <button name="add" onClick="window.location.href='customer-import-export?export=export'"
                    class="btn btn-outline-danger btn-sm" style="float:left !important;"><i class="fa fa-cloud-download"
                        aria-hidden="true"></i>Export</button>

                <a name="add" href="create-customer?role=5" class="btn btn-primary" style="float:right !important;"><i
                        class="fa fa-plus"></i>Add New</a>
                <div class="tile-body">

                    <div class="table-responsive-lg">
                        <table class="table table-hover table-bordered table-striped" id="sampleTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Company Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th>GSTIN Number</th>
                                    <th>Address</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dynamic Data Here -->
                            </tbody>
                        </table>
                    </div>


                </div>

            </div>
        </div>

        <div class="clearfix"></div>

    </div>
</main>


<!--Import-->
<div class="modal fade" id="myModal1">
    <form name="myform" method="post" enctype="multipart/form-data" action="customer-import-export.php">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Import Customer List
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="col-md-10 offset-1">

                        <input type="hidden" name="mode" value="import">

                        <div class="form-group">
                            <label class="control-label">File</label>
                            <input type="file" name="uploadFile">

                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="sub">Upload</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </form>
</div>

<!-- Edit -->
<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal header-->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-pencil-square"></i> Edit Customer </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body-->
            <div class="modal-body">

                <div id="modal-loader" style="display: none; text-align: center;">
                    <img src="ajax-loader.gif">
                </div>

                <!-- content will be load here -->
                <div id="dynamic-content"></div>

            </div>
            <!-- Modal footer-->
            <!-- <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div> -->

        </div>
    </div>
</div><!-- /.modal -->

<script>
var dataTable = $('#sampleTable').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [],
    "ajax": {
        url: "customer-process.php",
        data: {
            role: 5
        },
        type: "POST"
    },
    "columnDefs": [{
        "targets": [0, 3, 4],
        "orderable": false,
    }, ],

});
</script>
<script>
$(document).ready(function() {

    $(document).on('click', '#getUser', function(e) {

        e.preventDefault();

        var uid = $(this).data('id'); // it will get id of clicked row

        $('#dynamic-content').html(''); // leave it blank before ajax call
        $('#modal-loader').show(); // load ajax loader

        $.ajax({
                url: 'edit-customer.php',
                type: 'POST',
                data: 'id=' + uid,
                dataType: 'html'
            })
            .done(function(data) {
                console.log(data);
                $('#dynamic-content').html('');
                $('#dynamic-content').html(data); // load response
                $('#modal-loader').hide(); // hide ajax loader
            })
            .fail(function() {
                $('#dynamic-content').html(
                    '<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...'
                );
                $('#modal-loader').hide();
            });

    });

});
</script>

<script type="text/javascript">
$(function() {

    $(".delbutton").click(function() {
        var del_id = $(this).attr("id");
        var info = 'id=' + del_id;
        if (confirm("Sure you want to delete this post? This cannot be undone later.")) {
            $.ajax({
                type: "POST",
                url: "customer-process.php", //URL to the delete php script
                data: info,
                success: function() {}
            });
            $(this).parents(".record").animate("fast").animate({
                opacity: "hide"
            }, "slow");
        }
        return false;
    });
});
</script>
<script>
// document.addEventListener("DOMContentLoaded", function() {

//   document.querySelectorAll(".delete-btn").forEach(button => {

//     button.addEventListener("click", function() {

//       let id = this.getAttribute("data-id");

//       Swal.fire({
//         title: "Are you sure?",
//         text: "This record will be permanently deleted!",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#d33",
//         cancelButtonColor: "#3085d6",
//         confirmButtonText: "Yes, delete it!",
//         cancelButtonText: "Cancel"
//       }).then((result) => {

//         if (result.isConfirmed) {
//           window.location.href = "customer-process?id=" + id;
//         }

//       });

//     });

//   });

// });
$(document).on('click', '.delete-btn', function() {

    let id = $(this).data('id');
    let role_id = $(this).data('role_id');

    Swal.fire({
        title: 'Are you sure?',
        text: "This customer will be permanently deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {

        if (result.isConfirmed) {

            window.location.href = "customer-process?delete_id=" + id + "&&role_id=" + role_id;

        }

    });

});
</script>
<style>
.table-responsive {
    overflow-x: auto;
}

#sampleTable {
    min-width: 1200px;
    /* adjust if needed */
}
</style>



<?php include_once('footer.inc.php'); ?>