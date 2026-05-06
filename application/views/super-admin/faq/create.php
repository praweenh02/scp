<?php error_reporting(0)?>

 <div class="page-heading">
            <h3>
               Add New FAQ
            </h3>
            <hr>
                   </div>
              
 <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
      
                         
                                   
                                 <header class="panel-heading">
            Add New FAQ 
            <span class="mb-5 pull-right" style="margin-top: -6px;">
                <a onclick="window.history.back(-1);" class="btn btn-danger btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
             </span>
        </header>
                             
                             
           
        <div class="panel-body">
            <div class="tab-content">
               <div class="tab-pane active " id="home-2">
                      <form class="cmxform form-horizontal adminex-form" id="form-faq" name="form-faq" method="post" enctype="multiple/form-data">
                                            <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                            'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                              <input type="hidden" name="faq_id" id="faq_id" value="<?=$result->faq_id;?>">
                            
                                       

                                    

                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                     <label for="cname" class="control-label col-lg-3">FAQ Question  *  </label>
                                                  <div class="col-lg-9">
                                                     <input type="text" name="faq_question" id="faq_question" class="form-control" value="<?=$result->faq_question;?>" required>
                                                   </div>
                                               </div>
                                                <div class="form-group row">
                                                     <label for="cname" class="control-label col-lg-3">FAQ Answer *  </label>
                                                  <div class="col-lg-9">
                                                    <textarea class="ckeditor form-control" required=""  id="faq_answer" name="faq_answer"><?=$result->faq_answer;?></textarea>
                                                   </div>
                                               </div>
                                             
                                                <div class="form-group row">
                                                     <label for="cname" class="control-label col-lg-3">FAQ Question in Hindi </label>
                                                  <div class="col-lg-9">
                                                     <input type="text" value="<?=$result->faq_question_hindi;?>" name="faq_question_hindi" id="faq_question_hindi" class="form-control" >
                                                   </div>
                                               </div>
                                                 <div class="form-group row">
                                                     <label for="faq_answer_hindi" class="control-label col-lg-3">FAQ Answer in Hindi *  </label>
                                                  <div class="col-lg-9">
                                                    <textarea class="ckeditor form-control" required=""  id="faq_answer_hindi" name="faq_answer_hindi"><?=$result->faq_answer_hindi;?></textarea>
                                                   </div>
                                               </div>

                                                 <?php
                                                 if($result->faq_id)
                                                   {
                                                   ?>
                                                       <div class="form-group row">
                                                         <label for="cname" class="control-label col-lg-3">Status * </label>
                                                         <div class="col-lg-9">
                                                            <select  name="status" id="status" class="form-control">
                                                                 <option value="0">---Select one---</option>
                                                                  <option value="Y" <?=$result->faq_status=='Y'? 'selected':'' ;?>>Active</option>
                                                                     <option value="N" <?=$result->faq_status=='N'? 'selected':'' ;?>>Inactive</option>
                          
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

<script src="ajax/faq.js"></script>
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


                          



    
