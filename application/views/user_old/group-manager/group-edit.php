<?php error_reporting(0)?>

 <div class="page-heading">
            <h3>
                <?=$result->group_title;?> 
            </h3>
            <hr>
                   </div>
              
 <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
      
                         
                                   
                                 <header class="panel-heading">
            <?=$result->group_id==''? 'Add':'Edit';?> Group
            <a href="groupmanager/manage_corresponding/<?=$result->group_id;?>/" class="btn btn-sm btn-danger pull-center">Manage Corresponding </a>
            <a href="groupmanager/manage_management_team/<?=$result->group_id;?>/" class="btn btn-sm btn-danger pull-center"> Management Team </a>
            <a href="groupmanager/manage_working_item/<?=$result->group_id;?>/" class="btn btn-sm btn-danger pull-center"> Working Item </a>
            <a href="groupmanager/manage_group_information/<?=$result->group_id;?>/" class="btn btn-sm btn-danger pull-center"> Group Information </a>
           
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
                                                     <label for="cname"  class="control-label col-lg-3">SDO  * </label>
                                                  <div class="col-lg-9">
                                                       <input  class="form-control" id="group_title" name="group_title"  type="text" disabled value="<?=$result->category_name;?>"  required />
                                                   </div>
                                               </div>
                                               
                                               <div class="form-group row">
                                                     <label for="cname"  class="control-label col-lg-3">Group Title * </label>
                                                  <div class="col-lg-9">
                                                       <input  class="form-control" id="group_title" name="group_title"  type="text" disabled value="<?=$result->group_title;?>"  required />
                                                   </div>
                                               </div>
                                                
                                                 <div class="form-group row">
                                                     <label for="cname"  class="control-label col-lg-3">Group Name * </label>
                                                  <div class="col-lg-9">
                                                       <input  class="form-control" id="group_name" name="group_name" disabled  type="text" value="<?=$result->group_name;?>"  required />
                                                   </div>
                                               </div>
                                               
                                                 <div class="form-group row">
                                                     <label for="cname" class="control-label col-lg-3">Group Description  </label>
                                                  <div class="col-lg-9">
                                                       <textarea  class="ckeditor" id="group_description" name="group_description" rows="4"1><?=$result->group_description;?></textarea> 
                                                   </div>
                                               </div>
                                               
                                            

                                              <div class="form-group row">
                                                   <div class="pull-right">
                                                       <button class="btn btn-danger btn-sm"  onclick="window.history.back(-1);" type="button"> <i class="fa fa-arrow-left"></i>  Back</button>
                                                       <button class="btn btn-success btn-sm" onclick="update_data();" type="button">Save changes</button>
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


                          



    
