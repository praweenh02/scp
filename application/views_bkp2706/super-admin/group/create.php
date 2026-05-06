<?php error_reporting(0)?>

 <div class="page-heading">
            <h3>
                <?=$result->group_id==''? 'Add':'Edit';?> Group
            </h3>
            <hr>
                   </div>
              
 <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
      
                         
                                   
                                 <header class="panel-heading">
            <?=$result->group_id==''? 'Add':'Edit';?> Group
            <span class="mb-5 pull-right" style="margin-top: -6px;">
                <a onclick="window.history.back(-1);" class="btn btn-danger btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
             </span>
        </header>
                             
                             
           
        <div class="panel-body">
            <div class="tab-content">
               <div class="tab-pane active " id="home-2">
                      <form class="cmxform form-horizontal adminex-form" id="form-group" name="form-group" method="post" enctype="multiple/form-data">
                                            <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                            'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                              <input type="hidden" name="group_id" id="group_id" value="<?=$result->group_id;?>">
                            
                                       

                                    

                                            <div class="col-md-12">
                                                 <div class="form-group row">
                                                     <label for="cname"  class="control-label col-lg-3">Select SDO * </label>
                                                  <div class="col-lg-9">
                                                       <select class="form-control" name="category_id" id="category_id" required>
                                                        <option value="" selected disabled>---Select One---</option>
                                                        
                                                    
                                                            <?php
                                                              foreach($category_list as $cat_data)
                                                             {?>
                                                                <option value="<?=$cat_data->category_id;?>" <?=$cat_data->category_id==$result->category_id?'selected':'';?>><?=$cat_data->category_name;?></option>

                                                          <?php } ?>
                                                        </select>    
                                                   </div>
                                               </div>
                                               <div class="form-group row">
                                                     <label for="cname"  class="control-label col-lg-3">Group Title * </label>
                                                  <div class="col-lg-9">
                                                       <input  class="form-control" id="group_title" name="group_title"  type="text" value="<?=$result->group_title;?>"  required />
                                                   </div>
                                               </div>
                                                <div class="form-group row">
                                                     <label for="cname"  class="control-label col-lg-3">Group Short Title <br>
                                                    <span style="color:red;">For navigation and menu</span>
                                                     </label>
                                                  <div class="col-lg-9">
                                                       <input  class="form-control" id="group_short_name" name="group_short_name"  type="text" value="<?=$result->shortform;?>"  required />
                                                   </div>
                                               </div>
                                                 <div class="form-group row">
                                                     <label for="cname"  class="control-label col-lg-3">Group Name * </label>
                                                  <div class="col-lg-9">
                                                       <input  class="form-control" id="group_name" name="group_name"  type="text" value="<?=$result->group_name;?>"  required />
                                                   </div>
                                               </div>
                                               <div class="form-group row">
                                                     <label for="cname"  class="control-label col-lg-3">Study period </label>
                                                  <div class="col-lg-9">
                                                       <input  class="form-control" id="study_periord" name="study_periord"  type="text" value="<?=$result->study_periord;?>"   />
                                                   </div>
                                               </div>
                                                <div class="form-group row">
                                                     <label for="cname"  class="control-label col-lg-3">ITU Study Group  </label>
                                                  <div class="col-lg-9">
                                                       <input  class="form-control" id="itu_website_study_group" name="itu_website_study_group"  type="text" value="<?=$result->itu_website_study_group;?>"   />
                                                   </div>
                                               </div>
                                                
                                                
                                                
                                                
                                                
                                              
                                                 <?php
                                                 if($result->group_id)
                                                   {
                                                   ?>
                                                       <div class="form-group row">
                                                          <label for="cname" class="control-label col-lg-3">Status * </label>
                                                          <div class="col-lg-9">
                                                            <select  name="status" id="status" class="form-control">
                                                                 <option value="0">---Select one---</option>
                                                                  <option value="Y" <?=$result->status=='Y'? 'selected':'' ;?>>Active</option>
                                                                     <option value="N" <?=$result->status=='N'? 'selected':'' ;?>>Inactive</option>
                          
                                                              </select>
                                                            </div>
                                                        </div>
                                                <?php }?>  
                                               
                                               <div class="form-group row">
                                                     <label for="cname" class="control-label col-lg-3">Group Description  </label>
                                                  <div class="col-lg-9">
                                                       <textarea  class="ckeditor" id="group_desription" name="group_desription" rows="4"1><?=$result->group_description;?></textarea> 
                                                   </div>
                                               </div>
                                               
                                            

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

      <div id="popupdiv"></div>
<script type="text/javascript" src="assets/js/ckeditor/ckeditor.js"></script>
<script src="ajax/group.js"></script>
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


                          



    
