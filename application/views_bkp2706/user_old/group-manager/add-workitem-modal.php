<?php error_reporting(0);?>
<form method="post" enctype="multipart/form-data" id="form-workitem" name="form-workitem">
	       <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                             'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" id="csrf_token_name" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                              <input type="hidden" id="group_id" name="group_id" value="<?=$group_id;?>" />
                               <input type="hidden" id="workitem_id" name="workitem_id" value="<?=$result->workitem_id;?>" /> 
 	 <div class="modal fade" id="AddNewModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Add Work Item  </h4>
                                        </div>

                                        <div class="modal-body row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label> Title</label>
                                                    <input id="work_item" name="work_item"  required class="form-control" value="<?=$result->work_item;?>">
                                                </div>
                                              
                                                <?php
                                                 if($result->workitem_id)
                                                   {
                                                   ?>
                                                       <div class="form-group">
                                                          <label for="cname" >Status * </label>
                                                      
                                                            <select  name="status" id="status" class="form-control">
                                                                 <option value="0">---Select one---</option>
                                                                  <option value="Y" <?=$result->work_item_status=='Y'? 'selected':'' ;?>>Active</option>
                                                                     <option value="N" <?=$result->work_item_status=='N'? 'selected':'' ;?>>Inactive</option>
                          
                                                              </select>
                                                          
                                                        </div>
                                                <?php }?>  
                                               
                                                
                                                <div class="pull-right">
                                                    <button class="btn btn-danger btn-sm" data-dismiss="modal"  type="button">Close</button>
                                                    <button class="btn btn-success btn-sm" type="button" onclick="save_workitem();">Save changes</button>
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
    $('#AddNewModal2').modal({
    backdrop: 'static',
    keyboard: false
})
</script>