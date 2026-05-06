<?php error_reporting(0)?>
<div class="page-heading">
    <h3>
    Create Datatable
    </h3>
    <hr>
</div>
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Create New Datatable
                    <span class="mb-5 pull-right" style="margin-top: -6px;">
                        <a onclick="window.history.back(-1);" class="btn btn-danger btn-sm">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane active " id="home-2">
                            <form class="cmxform form-horizontal adminex-form" id="form-datatable" name="form-datatable"
                                method="post" enctype="multiple/form-data">
                                <?php  $csrf = array(
                                'name' => $this->security->get_csrf_token_name(),
                                'hash' => $this->security->get_csrf_hash());
                                ?>
                                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                                <input type="hidden" name="datatable_id" id="datatable_id" value="<?=$result->page_id;?>">
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <div class="form-group  col-lg-6">
                                        <label for="cname" class="control-label col-lg-4">SDO * </label>
                                        <div class="col-lg-8">
                                            <select  id="group_category" name="sdo_id" required="" class="form-control category"  placeholder="Select Working Group">
                                                <option value="" selected>----Select SDO----</option>
                                                <?php
                                                foreach($sdo_list as $cat_data):
                                                ?>
                                                <option value="<?=$cat_data->category_id;?>" <?=$cat_data->category_id==$result->sdo_id ? 'selected':'';?>><?=$cat_data->category_name;?></option>
                                                
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-lg-6">
                                        <label for="cname" class="control-label col-lg-4">Working Group * </label>
                                        <div class="col-lg-8">
                                            <select    required="" id="group_id" name="group_id" class="form-control align-right" style="float:right;" placeholder="Select Working Group">
                                                <?php
                                                if($result->question_id)
                                                {
                                                ?>
                                                <option value="<?=$result->group_id;?>" selected ><?=$result->group_title;?></option>
                                                <?php }else{?>
                                                <option value="" selected disabled>---- First Select Categeory----</option>
                                                <?php }?>
                                                
                                            </select>
                                        </div>
                                    </div>
                                   </div>
                                    <div class="row">
                                         <div class="form-group col-lg-6">
                                        <label for="cname" class="control-label col-lg-4">Select File * </label>
                                        <div class="col-lg-8">
                                         <input type="file" name="file" class="form-control" required accept=".xls, .xlsx">
                                        </div>
                                    </div>
                                   
                                </div>
                                    
                                    
                                    
                                    
                                    <div class="form-group row">
                                        <div class="pull-right">
                                            <button class="btn btn-danger btn-sm" onclick="window.history.back(-1);"
                                            type="button"> <i class="fa fa-arrow-left"></i> Back</button>
                                            <button class="btn btn-success btn-sm btn-submit" onclick="save_data();"
                                            type="button">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
</form>
</div>
<div id="popupdiv"></div>
<script src="ajax/datatable.js"></script>
<script type="text/javascript">
$('input[name="contact_no"]').keyup(function(e) {
if (/\D/g.test(this.value)) {
// Filter non-digits from input value.
this.value = this.value.replace(/\D/g, '');
}
});
</script>