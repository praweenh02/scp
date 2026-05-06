<?php error_reporting(0);?>
<form method="post" enctype="multipart/form-data" id="form-corresponding" name="form-corresponding">
	       <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                             'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" id="csrf_token_name" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                              <input type="hidden" id="group_id" name="group_id" value="<?=$group_id;?>" />
                               <input type="hidden" id="corresponding_id" name="corresponding_id" value="<?=$result->corresponding_id;?>" /> 
 	 <div class="modal fade" id="AddNewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Add Corresponding </h4>
                                        </div>

                                        <div class="modal-body row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label> Title</label>
                                                    <input id="name" name="title"  required class="form-control" value="<?=$result->corresponding_title;?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Url</label>
                                                    <input id="url" type="url" name="url"  required class="form-control" value="<?=$result->corresponding_url;?>">
                                                </div>
                                                <?php
                                                 if($result->corresponding_id)
                                                   {
                                                   ?>
                                                       <div class="form-group">
                                                          <label for="cname" >Status * </label>
                                                      
                                                            <select  name="status" id="status" class="form-control">
                                                                 <option value="0">---Select one---</option>
                                                                  <option value="Y" <?=$result->corrseponding_status=='Y'? 'selected':'' ;?>>Active</option>
                                                                     <option value="N" <?=$result->corrseponding_status=='N'? 'selected':'' ;?>>Inactive</option>
                          
                                                              </select>
                                                          
                                                        </div>
                                                <?php }?>  
                                               
                                                
                                                <div class="pull-right">
                                                    <button class="btn btn-danger btn-sm" data-dismiss="modal"  type="button">Close</button>
                                                    <button class="btn btn-success btn-sm" type="button" onclick="save_corresponding();">Save changes</button>
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
    $('#AddNewModal').modal({
    backdrop: 'static',
    keyboard: false
})
</script>