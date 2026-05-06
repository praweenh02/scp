<?php error_reporting(0)?>
<div class="page-heading">
    <h3>
    <?php if($this->uri->segment(4)==0) { ?>Add <?php }else{?> Edit <?php } ?>  What's New
    </h3>
    <hr>
</div>

<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                
                
                
                <header class="panel-heading">
                   <?php if($this->uri->segment(4)==0) { ?>Add <?php }else{?> Edit <?php } ?>  What's New
                    <span class="mb-5 pull-right" style="margin-top: -6px;">
                        <a onclick="window.history.back(-1);" class="btn btn-danger btn-sm">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </span>
                </header>
                
                
                
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane active " id="home-2">
                            <form class="cmxform form-horizontal adminex-form" id="form-whatsnew" name="form-whatsnew" method="post" enctype="multiple/form-data">
                                <?php  $csrf = array(
                                'name' => $this->security->get_csrf_token_name(),
                                'hash' => $this->security->get_csrf_hash());
                                ?>
                                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                                <input type="hidden" name="whatsnew_id" id="whatsnew_id" value="<?=$result->whatsnew_id; ?>">
                                
                                
                                
                                <div class="col-md-12">
                                    
                                    <div class="form-group row">
                                        <label for="cname" class="control-label col-lg-3">Title *  </label>
                                        <div class="col-lg-9">
                                          <textarea class="form-control" required=""  id="whatsnew_title"  name="whatsnew_title"><?=$result->whatsnew_title;?></textarea>
                                          <label class="error">  (Maximum characters: 150)<br/>
                                            <span id="charLeft" > </span>  Characters left
                                          </label>
                                        </div>
                                    </div>
                                       <div class="form-group row">
                                        <label for="cname" class="control-label col-lg-3">File </label>
                                        <div class="col-lg-9">
                                            <input type="file" id="whatsnew_file" accept="document/*,.pdf,.docx,.doc" name="whatsnew_file" class="form-control" >

                                            <?php
                                               if($result->whatsnew_file)
                                               {
                                                echo '<a target="_blank" href="uploads/whats-new/'.$result->whatsnew_file.'">File</a>';

                                               }
                                            ?>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <?php
                                    if($result->whatsnew_id)
                                    {
                                    ?>
                                    <div class="form-group row">
                                        <label for="cname" class="control-label col-lg-3">Status * </label>
                                        <div class="col-lg-9">
                                            <select  name="status" id="status" class="form-control">
                                                <option value="0">---Select one---</option>
                                                <option value="Y" <?=$result->whatsnew_status=='Y'? 'selected':'' ;?>>Active</option>
                                                <option value="N" <?=$result->whatsnew_status=='N'? 'selected':'' ;?>>Inactive</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <?php }?>
                                  
                                    <div class="form-group row">
                                        <div class="pull-right">
                                            <button class="btn btn-danger btn-sm"  onclick="window.history.back(-1);" type="button"> <i class="fa fa-arrow-left"></i>  Back</button>
                                            <button class="btn btn-success btn-submit btn-sm" onclick="save_data();" type="button">Save changes</button>
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
<script src="ajax/whatsnew.js"></script>
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