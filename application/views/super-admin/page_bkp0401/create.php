<?php error_reporting(0)?>
<div class="page-heading">
    <h3>
    Create New Page
    </h3>
    <hr>
</div>
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Create New Page
                    <span class="mb-5 pull-right" style="margin-top: -6px;">
                        <a onclick="window.history.back(-1);" class="btn btn-danger btn-sm">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane active " id="home-2">
                            <form class="cmxform form-horizontal adminex-form" id="form-page" name="form-page"
                                method="post" enctype="multiple/form-data">
                                <?php  $csrf = array(
                                'name' => $this->security->get_csrf_token_name(),
                                'hash' => $this->security->get_csrf_hash());
                                ?>
                                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                                <input type="hidden" name="page_id" id="page_id" value="<?=$result->page_id;?>">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="cname" class="control-label col-lg-3">Title * </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="title" id="title"
                                            class="form-control" value="<?=$result->title;?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cname" class="control-label col-lg-3">Show at Navigation * </label>
                                        <div class="col-lg-9">
                                            <input  type="checkbox" name="show_at_nav" id="show_at_nav"
                                            value="Yes" <?=($result->show_at_nav=='Yes')?'checked':'';?>  style="width: 20px; height:20px" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cname" class="control-label col-lg-3">Select parent menu * </label>
                                        <div class="col-lg-9">
                                            <select name="parent_id"  class="form-control">
                                             <option value="0">---Select One---</option>
                                             <?php
                                              foreach ($menu_list as $menu_v) { ?>
                                                <option value="<?=$menu_v->page_id;?>"  <?=($menu_v->parent_id==$result->parent_id)?'checked':'';?>><?=$menu_v->title;?></option>
                                              <?php }
                                             ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cname" class="control-label col-lg-3">Description * </label>
                                        <div class="col-lg-9">
                                            <textarea class="ckeditor form-control" required="" id="description"
                                            name="description"><?=$result->description;?></textarea>
                                        </div>
                                    </div>
                                    
                                    <?php
                                    if($result->page_id)
                                    {
                                    ?>
                                    <div class="form-group row">
                                        <label for="cname" class="control-label col-lg-3">Status * </label>
                                        <div class="col-lg-9">
                                            <select name="status" id="status" class="form-control">
                                                <option value="0">---Select one---</option>
                                                <option value="Y" <?=$result->status=='Y'? 'selected':'' ;?>>Active
                                                </option>
                                                <option value="N" <?=$result->status=='N'? 'selected':'' ;?>>
                                                Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php }?>
                                    <div class="form-group row">
                                        <div class="pull-right">
                                            <button class="btn btn-danger btn-sm" onclick="window.history.back(-1);"
                                            type="button"> <i class="fa fa-arrow-left"></i> Back</button>
                                            <button class="btn btn-success btn-sm" onclick="save_data();"
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
<script src="ajax/page.js"></script>
<script type="text/javascript">
$('input[name="contact_no"]').keyup(function(e) {
if (/\D/g.test(this.value)) {
// Filter non-digits from input value.
this.value = this.value.replace(/\D/g, '');
}
});
</script>