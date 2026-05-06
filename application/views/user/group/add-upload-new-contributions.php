<?php error_reporting(0)?>
<div class="page-heading">
    <div class="row">
        <div class="col-md-7">
            <h4>
            <strong>
            SDO  - <span><?=$group_data->category_name;?></span>&nbsp;&nbsp;&nbsp;
            
            Working Group - <span><?=$group_data->shortform;?></span>
            </strong>
            </h4>
        </div>
        <?php
        $current_date = date('Y-m-d');
        if($current_date >=  $document_expiry_date['start_date']  AND    $current_date <= $document_expiry_date['end_date'])
        {?>
        <div class="col-md-5 alert alert-success pull-left col-md-offset-4" style="margin-top:-40px;" >
            
            For New Document Registration date is - <?=date('d-m-Y', strtotime($document_expiry_date['start_date']));?> To  <?=date('d-m-Y', strtotime($document_expiry_date['end_date']));?>
            <button type="button" class="close close-sm" data-dismiss="alert">
            <i class="fa fa-times"></i>
            </button>
            
        </div>
        <?php }?>
    </div>
    <hr>
</div>

<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                
                
                
                <header class="panel-heading">
                    Document Registration
                    <span class="mb-5 pull-right" style="margin-top: -12px;">
                        <a onclick="window.history.back(-1);" class="btn btn-danger btn-sm">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </span>
                </header>
                
                
                
                <div class="panel-body">
                    <div class="tab-content">
                        <?php
                        $current_date = date('Y-m-d');
                        if($current_date >=  $document_expiry_date['start_date']  AND    $current_date <= $document_expiry_date['end_date'])
                        {?>
                        <div class="tab-pane active " id="home-2">
                            <form class="cmxform form-horizontal adminex-form" id="form-upload1" name="form-upload1" method="post" enctype="multiple/form-data">
                                <?php  $csrf = array(
                                'name' => $this->security->get_csrf_token_name(),
                                'hash' => $this->security->get_csrf_hash());
                                ?>
                                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                                <input type="hidden" name="sdo_id" id="sdo_id" value="<?=$this->uri->segment('3');?>">
                                <input type="hidden" name="group_id" id="group_id" value="<?=$this->uri->segment('4');?>">
                                <input type="hidden" name="shortform" id="shortform" value="<?=$group_data->shortform;?>">
                                <input type="hidden" name="contribution_id" id="contribution_id" value="<?=$result->contribution_id;?>">
                                
                                
                                <div class="col-md-12" id="reg-1">
                                    <div class="form-group row">
                                        <label for="cname"  class="control-label col-lg-3">Select Question * </label>
                                        <div class="col-lg-9">
                                            <select  id="question_id" name="question_id" required="" class="category form-control"  placeholder="Select Question">
                                                <option value="" selected   disabled>----Select Question ----</option>
                                                <?php
                                                foreach($get_que_list as $que_data):
                                                ?>
                                                <option value="<?=$que_data->question_id ;?>" <?=$que_data->question_id == $result->question_id? 'selected':'';?> ><?=$que_data->question_no;?></option>
                                                
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                         <label for="cname"  class="control-label col-lg-3">Already Exist Work Item  * </label>
                                          <div class="col-lg-9">
                                            <select name="work_item_type" required id="work_item_type" class="form-control">
                                                <option value="0">---Select One ---</option>
                                                <option value="Y">Yes</option>
                                                <option value="N">No</option>
                                            </select>
                                                
                                            </select>
                                          </div>
                                    </div>
                                    <div class="form-group row work_item"  style="display:none;">
                                        <label for="cname"  class="control-label col-lg-3">Work Item  </label>
                                        <div class="col-lg-9">
                                            <select   id="workitem_id" name="workitem_id" class="form-control align-right" placeholder="Select Working Group">
                                                <option value="" selected disabled>---Select Question First---</option>
                                                
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cname"  class="control-label col-lg-3">SG Meeting date * </label>
                                        <div class="col-lg-9">
                                            <select    required="" id="meeting_id" name="meeting_id" class="form-control" placeholder="Select Working Group">
                                                
                                                <?php
                                                foreach($get_meeting_list as $meeting_data):
                                                ?>
                                                <option value="<?=$meeting_data->meeting_id;?>" <?=$meeting_data->meeting_id == $result->meeting_id ? 'selected':'';?>><?=$meeting_data->meeting_title;?>-<?=date('d-m-Y', strtotime($meeting_data->meeting_date));?> to <?=date('d-m-Y', strtotime($meeting_data->meeting_end_date));?></option>
                                                
                                                <?php endforeach;?>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="workingparty_id" class="control-label col-lg-3">Working Party</label>
                                        <div class="col-lg-9">
                                            <select  id="workingparty_id" name="workingparty_id" class="form-control" placeholder="Select Working Group">
                                                <option value="0" selected >---Any---</option>
                                                <?php
                                                foreach($workingparty_list as $wparty_data):
                                                ?>
                                                <option value="<?=$wparty_data->workingparty_id;?>" <?=$wparty_data->workingparty_id == $result->workingparty_id? 'selected':'';?> ><?=$wparty_data->party_name;?></option>
                                                
                                                <?php endforeach;?>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                    <div class="form-group row">
                                        <label for="cname" class="control-label col-lg-3">Title *  </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="title" id="title" class="form-control" value="<?=$result->title;?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cname" class="control-label col-lg-3">Name of contributors * </label>
                                        <div class="col-lg-9">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" id="contributor_name" name="contributor_name" placeholder="contributor Name">
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" id="organization" name="organization" placeholder="Organization" class="form-control">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="button" class="add-row btn btn-sm btn-success " value="Add More">
                                                </div>
                                                
                                                <br>
                                                <br>
                                                <div class="col-lg-12">
                                                    <table id="table1" class="table table-bordered mt-5">
                                                        <thead>
                                                            <tr>
                                                                <th>Delete</th>
                                                                <th>Contributor Name</th>
                                                                <th>Organization</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach($contributor_list as $contbr_data)
                                                            {?>
                                                            <input type="hidden" name="contributor_id[]" id="contributor_id" value="<?=$contbr_data->contributor_id;?>">
                                                            <tr>
                                                                <td><button type='button' class='delete-row delete_contributoer btn btn-danger btn-sm' data-id='<?=$contbr_data->contributor_id;?>'><i class='fa fa-trash-o'></button></td>
                                                                <td><input type="text" name="all_contributor_name1[]" id="all_contributor_name1" value="<?=$contbr_data->contributor_name;?>"></td>
                                                                <td><input type='text' id="all_organization1" name="all_organization1[]" value="<?=$contbr_data->organization;?>"></td>
                                                            </tr>
                                                            <?php } ?>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pull-right">
                                        <button class="btn btn-danger btn-sm" onclick="window.history.back(-1);" type="button">Back</button>
                                        <button class="btn btn-success btn-sm btn-submit" type="button" onclick="save_data();">Save changes</button>
                                    </div>
                                </div>
                                
                                
                                
                            </form>
                        </div>
                        <?php }else { ?>
                        <div class="alert alert-danger">
                            File uploading window is not active.
                            
                        </div>
                        
                        <?php }?>
                        
                    </div>
                </div>
                
            </section>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
$(".add-row").click(function(){
var contributor_name = $("#contributor_name").val();
var organization = $("#organization").val();
//$('#form-contributor').trigger("reset");
var markup = "<tr><td><button type='button' class='delete-row btn btn-danger btn-sm'><i class='fa fa-trash-o'></button></td><td><input type='text' id='all_contributor_name' name='all_contributor_name[]' readonly value='"+ contributor_name +"'</td><td><input type='text' id='all_organization' name='all_organization[]' readonly value='"+ organization +"'></td></tr>";
$("table tbody").append(markup);

});

// Find and remove selected table rows

$("#table1").on('click', '.delete-row', function() {
//if($(this).is(":checked")){
$(this).closest('tr').remove();
//}
});

});
</script>
</form>
</div>
<div id="popupdiv"></div>
<script src="ajax/upload-document.js"></script>
<script type="text/javascript" src="ajax/dashboard.js"></script>
<script type="text/javascript">
$('input[name="contact_no"]').keyup(function(e)
{
if (/\D/g.test(this.value))
{
// Filter non-digits from input value.
this.value = this.value.replace(/\D/g, '');
}
});
</script>
<script type="text/javascript">
    var Privileges = jQuery('#work_item_type');
var select = this.value;
Privileges.change(function () {
    if ($(this).val() == 'Y') {
        $('.work_item').show();
    }
    else $('.work_item').hide(); // hide div if value is not "custom"
});
</script>