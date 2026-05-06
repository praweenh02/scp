<?php error_reporting(0)?>

 <div class="page-heading">
            <h3>
               Add New SDO
            </h3>
            <hr>
                   </div>
              
 <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
      
                         
                                   
                                 <header class="panel-heading">
            Add New SDO 
            <span class="mb-5 pull-right" style="margin-top: -6px;">
                <a onclick="window.history.back(-1);" class="btn btn-danger btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
             </span>
        </header>
                             
                             
           
        <div class="panel-body">
            <div class="tab-content">
               <div class="tab-pane active " id="home-2">
                      <form class="cmxform form-horizontal adminex-form" id="form-catgory" name="form-catgory" method="post" enctype="multiple/form-data">
                                            <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                            'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                              <input type="hidden" name="category_id" id="category_id" value="<?=$result->category_id;?>">
                            
                                       

                                    

                                            <div class="col-md-12">
                                               <div class="form-group row">
                                                     <label for="cname"  class="control-label col-lg-3"> Title * </label>
                                                  <div class="col-lg-9">
                                                       <input  class="form-control" id="category_name" name="category_name"  type="text" value="<?=$result->category_name;?>"  required />
                                                   </div>
                                               </div>
                                                
                                              
                                              
                                                 
                                               
                                               <div class="form-group row">
                                                     <label for="cname" class="control-label col-lg-3"> Description  </label>
                                                  <div class="col-lg-9">
                                                       <textarea  class="form-control" id="category_description" name="category_description" rows="4"1><?=$result->category_description;?></textarea> 
                                                   </div>
                                               </div>

                                                 <?php
                                                 if($result->category_id)
                                                   {
                                                   ?>
                                                       <div class="form-group row">
                                                         <label for="cname" class="control-label col-lg-3">Status * </label>
                                                         <div class="col-lg-9">
                                                            <select  name="status" id="status" class="form-control">
                                                                 <option value="0">---Select one---</option>
                                                                  <option value="Y" <?=$result->category_status=='Y'? 'selected':'' ;?>>Active</option>
                                                                     <option value="N" <?=$result->category_status=='N'? 'selected':'' ;?>>Inactive</option>
                          
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

<script src="ajax/category.js"></script>
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


                          



    
