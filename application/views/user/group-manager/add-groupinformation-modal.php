<?php error_reporting(0);?>
<form method="post" enctype="multipart/form-data" id="form-groupinformation" name="form-groupinformation">
	       <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                             'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" id="csrf_token_name" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                              <input type="hidden" id="group_id" name="group_id" value="<?=$group_id;?>" />
                               <input type="hidden" id="group_information_id" name="group_information_id" value="<?=$result->group_information_id;?>" /> 
 	 <div class="modal fade" id="AddNewModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Add Group Information </h4>
                                        </div>

                                        <div class="modal-body row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label> Title</label>
                                                 <textarea class="form-control" id="title" name="title" required>
                                                       <?=$result->title;?>   
                                                    </textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>URL</label>
                                                    <input type="url" class="form-control" id="inf_url" name="inf_url" value="<?=$result->url;?>" >
                                                   
                                                    
                                                </div>
                                                 <div class="form-group">
                                                    <label>File</label>
                                                    <input type="file" class="form-control" id="docfile1" name="docfile1" accept="doc/*"  >
                                                    <a target="_blank" href="<?=base_url();?>uploads/information/<?=$result->file;?>">File</a>
                                                   
                                                    
                                                </div>
                                                <?php
                                                 if($result->group_information_id)
                                                   {
                                                   ?>
                                                       <div class="form-group">
                                                          <label for="cname" >Status * </label>
                                                      
                                                            <select  name="status" id="status" class="form-control">
                                                                 <option value="0">---Select one---</option>
                                                                  <option value="Y" <?=$result->group_information_status=='Y'? 'selected':'' ;?>>Active</option>
                                                                     <option value="N" <?=$result->group_information_status=='N'? 'selected':'' ;?>>Inactive</option>
                          
                                                              </select>
                                                          
                                                        </div>
                                                <?php }?>  
                                               
                                                
                                                <div class="pull-right">
                                                    <button class="btn btn-danger btn-sm" data-dismiss="modal"  type="button">Close</button>
                                                    <button class="btn btn-success btn-sm" type="button" onclick="save_group_information();">Save changes</button>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
 	

 </form>
<script src="ajax/user-group-manager.js"></script>
<style type="text/css">
.error
{

	color: red;
}
</style>
<script type="text/javascript">
    $('#AddNewModal3').modal({
    backdrop: 'static',
    keyboard: false
})
</script>