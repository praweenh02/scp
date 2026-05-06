<?php error_reporting(0)?>

 <div class="page-heading">
            <h3>
                <?=$result->group_id==''? 'Add':'Edit';?> Group Meeting
               
            </h3>
            <hr>
                   </div>
              
 <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
      
                         
                                   
                                 <header class="panel-heading">
            <?=$result->group_id==''? 'Add':'Edit';?>  Group Meeting
            <span class="mb-5 pull-right" style="margin-top: -6px;">
                <a onclick="window.history.back(-1);" class="btn btn-danger btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
             </span>
        </header>
                             
                             
           
        <div class="panel-body">
            <div class="tab-content">
               <div class="tab-pane active " id="home-2">
                      <form class="cmxform form-horizontal adminex-form" id="form-meeting" name="form-meeting" method="post" enctype="multiple/form-data">
                                            <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                            'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                              <input type="hidden" name="meeting_id" id="meeting_id" value="<?=$result->meeting_id;?>">
                            
                                       

                                    

                                            <div class="col-md-12">
                                               <div class="form-group row">
                                                     <label for="cname"  class="control-label col-lg-3">Select Meeting Type * </label>
                                                  <div class="col-lg-9">
                                                       <select class="form-control" name="meeting_type" id="meeting_type" required>
                                                        <option value="" selected disabled>---Select One---</option>
                                                        <option value="nwg" <?=$result->meeting_type=='nwg'? 'selected':''; ?>>NWG Meeting</option>
                                                        <option value="itu" <?=$result->meeting_type=='itu'? 'selected':''; ?>>SDO Meeting</option>
                                                        
                                                    
                                                        </select>    
                                                   </div>
                                               </div>
                                                 <div class="form-group row">
                                                     <label for="cname"  class="control-label col-lg-3">Select Working Group * </label>
                                                  <div class="col-lg-9">
                                                       <select class="form-control" name="group_id" id="group_id" required>
                                                        <option value="" selected disabled>---Select One---</option>
                                                        
                                                    
                                                            <?php
                                                              foreach($group_list as $cat_data)
                                                             {?>
                                                                <option value="<?=$cat_data->group_id;?>" <?=$cat_data->group_id==$result->group_id?'selected':'';?>><?=$cat_data->group_title;?></option>

                                                          <?php } ?>
                                                        </select>    
                                                   </div>
                                               </div>
                                               <div class="form-group row">
                                                     <label for="cname"  class="control-label col-lg-3">Meeting Title * </label>
                                                  <div class="col-lg-9">
                                                       <input  class="form-control" id="meeting_title" name="meeting_title"  type="text" value="<?=$result->meeting_title;?>"  required />
                                                   </div>
                                               </div>
                                                <div class="form-group row">
                                                     <label for="cname"  class="control-label col-lg-3">Meeting Start Date * </label>
                                                  <div class="col-lg-9">
                                                    <?php if($result->meeting_date){
                                                        ?>
                                                       <input  class="form-control default-date-picker" id="meeting_date" name="meeting_date"  type="text" value="<?=date('d-m-Y', strtotime($result->meeting_date));?>"  required />
                                                    <?php }else{ ?>
                                                           <input  class="form-control default-date-picker" id="meeting_date" name="meeting_date"  type="text" value=""  required />


                                                    <?php } ?>
                                                   </div>
                                               </div>
                                                 <div class="form-group row">
                                                     <label for="cname"  class="control-label col-lg-3">Meeting End Date * </label>
                                                  <div class="col-lg-9">
                                                    <?php if($result->meeting_end_date){
                                                        ?>
                                                       <input  class="form-control default-date-picker" id="meeting_end_date" name="meeting_end_date"  type="text" value="<?=date('d-m-Y', strtotime($result->meeting_end_date));?>"  required />
                                                    <?php }else{ ?>
                                                           <input  class="form-control default-date-picker" id="meeting_end_date" name="meeting_end_date"  type="text" value=""  required />


                                                    <?php } ?>
                                                   </div>
                                               </div>
                                               <div class="form-group row">
                                                     <label for="cname"  class="control-label col-lg-3">Meeting File  </label>
                                                  <div class="col-lg-9">
                                                       <input  class="form-control" id="meeting_file" name="meeting_file"  type="file" value="<?=$result->meeting_title;?>"   />
                                                       <?php
                                                       if($result->meeting_file)
                                                       {?>
                                                        <a target="_blank" href="uploads/meeting-file/<?=$result->meeting_file;?>">File</a>

                                                       <?php }

                                                       ?>
                                                   </div>
                                               </div>
                                               
                                                
                                                
                                                
                                                
                                              
                                                 <?php
                                                 if($result->meeting_id)
                                                   {
                                                   ?>
                                                       <div class="form-group row">
                                                          <label for="cname" class="control-label col-lg-3">Status * </label>
                                                          <div class="col-lg-9">
                                                            <select  name="status" id="status" class="form-control">
                                                                 <option value="0">---Select one---</option>
                                                                  <option value="Y" <?=$result->meeting_status=='Y'? 'selected':'' ;?>>Active</option>
                                                                     <option value="N" <?=$result->meeting_status=='N'? 'selected':'' ;?>>Inactive</option>
                          
                                                              </select>
                                                            </div>
                                                        </div>
                                                <?php }?>  
                                            
                                               
                                            

                                              <div class="form-group row">
                                                   <div class="pull-right">
                                                       <button class="btn btn-danger btn-sm"  onclick="window.history.back(-1);" type="button"> <i class="fa fa-arrow-left"></i>  Back</button>
                                                       <button class="btn btn-success btn-sm" onclick="save_meeting();" type="button">Save changes</button>
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

      <div id="popupdiv"></div>
<script type="text/javascript" src="assets/js/ckeditor/ckeditor.js"></script>
<script src="ajax/admin-meeting.js"></script>
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


                          



    
