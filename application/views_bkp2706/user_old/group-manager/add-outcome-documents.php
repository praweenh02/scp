<?php error_reporting(0)?>

<div class="page-heading">
    <h3>
     Add Outcome Document 
 </h3>
 <hr>
</div>

<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
             <header class="panel-heading">
               Add Outcome Document 
               <span class="mb-5 pull-right" style="margin-top: -6px;">
                <a onclick="window.history.back(-1);" class="btn btn-danger btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </span>
        </header>



        <div class="panel-body">
            <div class="tab-content">
             <div class="tab-pane active " id="home-2">
              <form class="cmxform form-horizontal adminex-form" id="form-outcomedocument" name="form-outcomedocument" method="post" enctype="multiple/form-data">
                <?php  $csrf = array(
                   'name' => $this->security->get_csrf_token_name(),
                   'hash' => $this->security->get_csrf_hash());
                   ?>

                   <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                   <input type="hidden" name="outcome_document_id" id="outcome_document_id" value="<?=$result->outcome_document_id;?>">





                   <div class="col-md-12">
                                               <!--<div class="form-group row">
                                                     <label for="cname"  class="control-label col-lg-3">Select SDO * </label>
                                                  <div class="col-lg-9">
                                                    <select  id="group_category" name="sdo_id" required="" class="form-control category"  placeholder="Select Working Group">
                                                       <option value="" selected>----Select SDO----</option>
                                                      <?php 
                                                          foreach($sdo_list as $cat_data):
                                                         ?>
                                                          <option value="<?=$cat_data->category_id;?>" <?=$cat_data->category_id==$result->sdo_id ? 'selected':'';?>><?=$cat_data->category_name;?></option>

                         
                                                      <?php endforeach;?>
                                                   </select>
                                                   </div>
                                               </div>-->
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
                                                 <label for="meeting_id" class="control-label col-lg-3">Select Meeting *</label>
                                                 <div class="col-lg-9">
                                                   <select    required="" id="meeting_id" name="meeting_id"class="form-control align-right" style="float:right;" placeholder="Select First Working Group">
                                                     <?php
                                                     if($result->meeting_id)
                                                     {
                                                        $rows = $this->db->select('*')->where('meeting_id',$result->meeting_id)->get('group_meeting')->row();
                                                        ?>
                                                        <option value="$rows->meeting_id"><?=$rows->meeting_title;?> - <?=date('d-m-Y', strtotime($result->meeting_date));?></option>

                                                     <?php }else{
                                                        ?>
                                                        <option value="0">Select first working group</option>

                                                     <?php }
                                                        ?>
                                                       
                                                   </select>

                                               </div>
                                           </div>   

                                           <div class="form-group row">
                                               <label for="cname" class="control-label col-lg-3">Outcome Document Title  </label>
                                               <div class="col-lg-9">
                                                   <input type="text" name="outcome_document_title" id="outcome_document_title" class="form-control " value="<?=$result->outcome_document_title;?>" required>
                                               </div>
                                           </div>



                                           <div class="form-group row">
                                               <label for="cname" class="control-label col-lg-3">Outcome File  </label>
                                               <div class="col-lg-9">
                                                   <input type="file" name="outcome_file" id="outcome_file" class="form-control" value="" required>
                                               </div>
                                           </div>



                                                 <!--<div class="form-group row">
                                                     <label for="cname" class="control-label col-lg-3">Work item url  </label>
                                                  <div class="col-lg-9">
                                                     <input type="url" value="<?=$result->work_itm_url;?>" name="work_itm_url" id="work_itm_url" class="form-control" >
                                                   </div>
                                               </div>-->

                                               <?php
                                               if($result->outcome_document_id)
                                               {
                                                 ?>
                                                 <div class="form-group row">
                                                   <label for="cname" class="control-label col-lg-3">Status * </label>
                                                   <div class="col-lg-9">
                                                    <select  name="status" id="status" class="form-control">
                                                       <option value="0">---Select one---</option>
                                                       <option value="Y" <?=$result->outcomedocument_staus=='Y'? 'selected':'' ;?>>Active</option>
                                                       <option value="N" <?=$result->outcomedocument_staus=='N'? 'selected':'' ;?>>Inactive</option>

                                                   </select>
                                               </div>
                                           </div>
                                       <?php }?>  
                                       <div class="form-group row">
                                         <div class="pull-right">
                                             <button class="btn btn-danger btn-sm"  onclick="window.history.back(-1);" type="button"> <i class="fa fa-arrow-left"></i>  Back</button>
                                             <button class="btn btn-success btn-sm" onclick="save_outcomedocument();" type="button">Save changes</button>
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

<script src="ajax/user-group-manager.js"></script>
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







