<?php error_reporting(0)?>

 <div class="page-heading">
            <h3>
              Add Document Expiry Date 
            </h3>
            <hr>
                   </div>
              
 <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
           <header class="panel-heading">
             Add Document Expiry Date 
             <span class="mb-5 pull-right" style="margin-top: -6px;">
                <a onclick="window.history.back(-1);" class="btn btn-danger btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
             </span>
        </header>
                             
                             
           
        <div class="panel-body">
            <div class="tab-content">
               <div class="tab-pane active " id="home-2">
                      <form class="cmxform form-horizontal adminex-form" id="form-expiry_date" name="form-expiry_date" method="post" enctype="multiple/form-data">
                                            <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                            'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                              <input type="hidden" name="documentexpirydate_id" id="documentexpirydate_id" value="<?=$result->documentexpirydate_id;?>">
                            
                                       

                                    

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
                                                             <option value="0">Select first working group</option>
                                                        </select>

                                                   </div>
                                                </div>   
                                                
                                               <div class="form-group row">
                                                     <label for="cname" class="control-label col-lg-3">Start Date  </label>
                                                  <div class="col-lg-9">
                                                     <input type="text" name="start_date" id="start_date" class="form-control  default-date-picker dpd1" value="<?php if($result->start_date) { echo date('d-m-Y', strtotime($result->start_date)); }?>" required>
                                                   </div>
                                               </div>
                                              
                                                 
                                               
                                               <div class="form-group row">
                                                     <label for="cname" class="control-label col-lg-3">Last Date  </label>
                                                  <div class="col-lg-9">
                                                     <input type="text" name="end_date" id="end_date" class="form-control  default-date-picker dpd2" value="<?php if($result->end_date){ echo date("d-m-Y", strtotime($result->end_date)); }?>" required>
                                                   </div>
                                               </div>
                                               
                                              
                                             
                                                 <!--<div class="form-group row">
                                                     <label for="cname" class="control-label col-lg-3">Work item url  </label>
                                                  <div class="col-lg-9">
                                                     <input type="url" value="<?=$result->work_itm_url;?>" name="work_itm_url" id="work_itm_url" class="form-control" >
                                                   </div>
                                               </div>-->

                                                 <?php
                                                 if($result->documentexpirydate_id)
                                                   {
                                                   ?>
                                                       <div class="form-group row">
                                                         <label for="cname" class="control-label col-lg-3">Status * </label>
                                                         <div class="col-lg-9">
                                                            <select  name="status" id="status" class="form-control">
                                                                 <option value="0">---Select one---</option>
                                                                  <option value="Y" <?=$result->status=='Y'? 'selected':'' ;?>>Active</option>
                                                                     <option value="N" <?=$result->staus=='N'? 'selected':'' ;?>>Inactive</option>
                          
                                                              </select>
                                                            </div>
                                                        </div>
                                                <?php }?>  
                                              <div class="form-group row">
                                                   <div class="pull-right">
                                                       <button class="btn btn-danger btn-sm"  onclick="window.history.back(-1);" type="button"> <i class="fa fa-arrow-left"></i>  Back</button>
                                                       <button class="btn btn-success btn-sm" onclick="save_data();" type="button">Save changes</button>
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


                          



    
