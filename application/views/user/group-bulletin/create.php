<?php error_reporting(0)?>
<div class="page-heading">
    <h3>
    <?=$this->uri->segment('3')=='0'? 'Add':'Edit'; ?> Group Bulletin
    </h3>
    <hr>
</div>
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    <?=$this->uri->segment('3')=='0'? 'Add':'Edit'; ?> Group Bulletin
                    <span class="mb-5 pull-right" style="margin-top: -6px;">
                        <a onclick="window.history.back(-1);" class="btn btn-danger btn-sm">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane active " id="home-2">
                            <form class="cmxform form-horizontal adminex-form" id="form-groupbulletin" name="form-groupbulletin" method="post" enctype="multiple/form-data">
                                <?php  $csrf = array(
                                'name' => $this->security->get_csrf_token_name(),
                                'hash' => $this->security->get_csrf_hash());
                                ?>
                                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                                <input type="hidden" name="groupbulletin_id" id="groupbulletin_id" value="<?=$result->groupbulletin_id;?>">
                                <!--<input type="hidden" name="group_id" id="group_id" value="<?=$result->group_id;?>">-->
                                <div class="col-md-12">
                                   
                                    <div class="form-group row">
                                        <label for="cname"  class="control-label col-lg-3">Select Working Groups * </label>
                                        <div class="col-lg-9">
                                            <select    required="" id="group_id" name="group_id" class="form-control align-right groups" style="float:right;" placeholder="Select Working Group">
                                                <option value="" selected>----Select Working Group----</option>
                                                <?php
                                                foreach($group_list as $group_data):
                                                ?>
                                                <option value="<?=$group_data->group_id;?>" <?=$group_data->group_id==$result->group_id ? 'selected':'';?>><?=$group_data->group_title;?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group row">
                                        <label for="cname" class="control-label col-lg-3">Title *  </label>
                                        <div class="col-lg-9">
                                            <textarea  name="bulletin_title" id="bulletin_title" class="form-control" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" required><?=$result->bulletin_title;?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cname" class="control-label col-lg-3">Group Bulletin File  </label>
                                        <div class="col-lg-9">
                                            <input type="file" name="bulletin_file" id="bulletin_file" class="form-control" value=""  >
                                            <?php
                                            if($result->bulletin_file)
                                            {
                                            echo '<a target="_blank" href="uploads/group-bulletin/'.$result->bulletin_file.'" >File</a>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!--<div class="form-group row">
                                        <label for="cname" class="control-label col-lg-3">Work item url  </label>
                                        <div class="col-lg-9">
                                            <input type="url" value="<?=$result->work_itm_url;?>" name="work_itm_url" id="work_itm_url" class="form-control" >
                                        </div>
                                    </div>-->
                                    <?php
                                    if($result->groupbulletin_id)
                                    {
                                    ?>
                                    <div class="form-group row">
                                        <label for="cname" class="control-label col-lg-3">Status * </label>
                                        <div class="col-lg-9">
                                            <select  name="status" id="status" class="form-control">
                                                <option value="0">---Select one---</option>
                                                <option value="Y" <?=$result->bulletin_status=='Y'? 'selected':'' ;?>>Active</option>
                                                <option value="N" <?=$result->bulletin_status=='N'? 'selected':'' ;?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php }?>
                                    <div class="form-group row">
                                        <div class="pull-right">
                                            <button class="btn btn-danger btn-sm"  onclick="window.history.back(-1);" type="button"> <i class="fa fa-arrow-left"></i>  Back</button>
                                            <button class="btn btn-success btn-sm btn-submit" onclick="save_data();" type="button">Save changes</button>
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
<script src="ajax/user-group-bulletin.js"></script>
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