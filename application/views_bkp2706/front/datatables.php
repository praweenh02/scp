<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript" src="<?=base_url();?>assets/front/js/jquery.bootstrap.newsbox.js"></script>
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<div class="page-banner" style="background-image:url('assets/front/images/page-banner.png');">
    <div class="container">
        <div class="row">
            <div class="latest_videos">

                <h2>Datatables</h2>
                <!-- <p class="sub-heading"><?=$group_result->group_title;?></p> -->
            </div>


        </div>

    </div>

</div>
<div class="container" id="skipmaincontent">
    <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                            'hash' => $this->security->get_csrf_hash());
                             ?>

    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
    <div class="row mt-20">
        <div class="card">
            <form id="form-filter" class="form-horizontal">
                <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                            'hash' => $this->security->get_csrf_hash());
                             ?>

                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 form-group">
                            <label for="country" class="col-sm-12 control-label">Key Area</label>
                            <div class="col-sm-12">
                                <?php  echo $form_country; ?>
                            </div>
                        </div>
                        <div class="col-md-2 form-group">
                            <label for="FirstName" class="col-sm-12 control-label">SG</label>
                            <div class="col-sm-12">
                            <?php  echo $form_sg; ?>
                            </div>
                        </div>
                        <div class="col-md-2 form-group">
                            <label for="FirstName" class="col-sm-12 control-label">Que. No.</label>
                            <div class="col-sm-12">
                               <?=$form_que;?>
                            </div>
                        </div>
                        <div class="col-md-2 form-group">
                            <label for="LastName" class="col-sm-12 control-label">Work item</label>
                            <div class="col-sm-12">
                                <input type="text" style="width:100%;" id="work_item">
                            </div>
                        </div>
                        <div class=" col-md-2 form-group">
                            <label for="LastName" class="col-sm-12 control-label">Subject / Title</label>
                            <div class="col-sm-12">
                                <input type="text"  style="width:100%;" id="subject_title">
                            </div>
                        </div>
                       
                        <div class="col-md-12">
                            <label for="LastName" class="col-sm-12 control-label">&nbsp;</label>
                            <div class="col-sm-12" align="center">
                                <button type="button" id="btn-filter" class="btn btn-primary btn-sm">Search</button>
                                <button type="button" id="btn-reset" class="btn btn-danger btn-sm">Reset</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
<div class="row mt-20">

    <!-- <h5 class="header-title-inner-small">Contributions</h5> -->
    <div class="table-responsive">
        <table class="table table-bordered" id="groups_tables">
            <thead class="table-heading">
                <tr>
                    <th>#</th>
                    <th>Key Area</th>
                    <th>SG</th>
                    <th>Work item</th>
                    <th>Subject / Title</th>
                    <th>Question</th>
                    <th>TSDSI/ TEC/ Both</th>
                    <th>TEC NWG Status</th>
                    <th>TEC Remarks (Title/ use case of WG)</th>
                    <th>TSDSI Status</th>
                    <th>TSDSI Remarks (Title/ use case of WG)</th>
                    <th>Orgn.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Global Contribution</th>
                    <th>Status</th>
                    <th>Timing</th>
                    <th>Approval process</th>
                    <th>Version</th>
                    <th>Liaison relationship</th>
                    <th>Priority</th>

                </tr>
            </thead>



            <tbody>

            </tbody>
        </table>
    </div>




</div>
</div>
<br>




<style type="text/css">
.vertical-heading {
    background: linear-gradient(90deg, rgba(6, 127, 159, 1) 24%, rgb(8 90 192) 61%, rgba(0, 212, 255, 1) 100%);
    color: #fff;
    font-size: 19px;
    padding: 10px 10px;
    margin-bottom: 0px;


}

.vertical-menu {
    width: 100%;
    border-bottom: 2px solid #0000;
    padding-bottom: 20px;

}

.vertical-menu a {
    background-color: rgb(252, 252, 252);
    padding: 5px 10px;
    line-height: 16px;
    display: block;
    color: white;
    border-top: 1px dotted rgb(222 226 230 / 80%);
    color: #353535;
    font-size: 16px;
    text-decoration: none;
    padding-top: 10px;
    font-family: 'Fira Sans', sans-serif;
}

.vertical-menu a:hover {
    background-color: #ccc;
}

.vertical-menu a.active {
    background-color: #04668c;
    color: white;
}

.card-header {
    background: linear-gradient(90deg, rgba(6, 127, 159, 1) 24%, rgb(8 90 192) 61%, rgba(0, 212, 255, 1) 100%);
    color: white;
    width: 100%;
}

.latest_gropus li {
    background-color: rgb(252, 252, 252);
    padding: 7px 10px;
    line-height: 16px;
    display: block;
    color: white;
    border-top: 1px dotted rgb(222 226 230 / 80%);
    color: #353535;
    font-size: 13px;
    text-decoration: none;
    font-family: 'Fira Sans', sans-serif;

}

.card-footer {
    display: none !important;
}

.header-title-about {
    color: #04668c;
    font-size: 29.5px;
    font-weight: 700;
    position: relative;
    display: inline-block;
    margin-bottom: 22px;
    font-family: 'Fira Sans', sans-serif;

}

.group_subheading {

    padding-bottom: 10px;
    font-weight: 500;
    font-family: 'Fira Sans', sans-serif;
    font-size: 20px;
    color: #343a40;

}

.header-title-inner-small {
    color: #04668c;
    font-size: 18px;
    font-weight: 500;
    position: relative;
    display: inline-block;
    margin-bottom: 13px;
    margin-top: 0px;
    position: relative;

    padding-top: 27px;
    font-family: 'Fira Sans', sans-serif;
}

.bullet-list-stye li {
    list-style: none;
    padding: 7px 0px;
    line-height: 16px;
    /*display: flex;*/
    color: #353535;
    font-size: 14px;
    text-decoration: none;
    display: flex;
    font-family: 'Fira Sans', sans-serif;


}

}

.bullet-list-stye a {
    color: red !important;
    font-size: 15px;
}

.bullet-list-stye li::before {
    content: "•";
    /* Insert content that looks like bullets */
    font-weight: 500;
    font-size: 18px;
    padding-right: 8px;
    color: #0080c0;
    /* Or a color you prefer */
}

hr {
    margin-bottom: 5px !important;
    margin-top: 5px !important;
    ;
}

.table-heading {
    background: linear-gradient(90deg, rgba(6, 127, 159, 1) 24%, rgb(8 90 192) 61%, rgba(0, 212, 255, 1) 100%);
    color: #fff;


}


.vertical-menu ul li a:hover,
.vertical-menu ul li a.active {
    background: #3388ad;
    color: #fff;
    padding-left: 7px;
    transition-property: padding-left;
    transition-duration: .5s;
    transition-timing-function: linear, ease-in;
    text-decoration: none;
}

p {
    color: #353535;
    font-size: 16px;
    font-family: 'Fira Sans', sans-serif;


}
</style>
<script type="text/javascript">
$(function() {
    $(".latest_gropus").bootstrapNews({
        newsPerPage: 6,
        autoplay: true,
        pauseOnHover: true,
        direction: 'up',
        newsTickerInterval: 3000,
        onToDo: function() {
            //console.log(this);
        }
    });
});
</script>
<link type="text/css" rel="stylesheet" href="assets/plugins/tricker/css/jquery.jConveyorTicker.min.css?v=1.1.0" />

<!-- Demo styles -->
<link type="text/css" rel="stylesheet" href="assets/plugins/tricker/demo-files/demo-styles.css?v=1.1.0" />
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />

<!--dynamic table initialization -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
var table;

$(document).ready(function() {

    var csrf_token = $('input[name=csrf_token]').val();
    //datatables
    table = $('#groups_tables').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('datatables/get_all_data')?>",
            "type": "POST",
               "data": function(data) {
                data.key_area = $('#key_area').val();
                data.sg = $('#sg').val();
                data.work_item = $('#work_item').val();
                data.subject_title = $('#subject_title').val();
                data.que_no = $('#que_no').val();
                data.csrf_token = $('input[name=csrf_token]').val();
            }
            // data: {
            //     csrf_token: csrf_token
            // }
        },

        //Set column definition initialisation properties.
        "columnDefs": [{
            "targets": [0], //first column / numbering column
            "orderable": false, //set not orderable
        }, ],

    });

    $('#btn-filter').click(function() { //button filter event click
        table.ajax.reload(); //just reload table
    });
    $('#btn-reset').click(function() { //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload(); //just reload table
    });

});
</script>