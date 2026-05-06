<?php //error_reporting(0)?>

 <div class="page-heading">
            <h3>
              <?=$group_data->group_title;?>
            </h3>
            <hr>
                   </div>
              
 <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
      
                         
                                   
                                 <header class="panel-heading">
         Doc Registration
            <span class="mb-5 pull-right" style="margin-top: -6px;">
                <a onclick="window.history.back(-1);" class="btn btn-danger btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
             </span>
        </header>
                             
                             
           
        <div class="panel-body">
            <div class="tab-content">
               <div class="tab-pane active " id="home-2">
                      <form class="cmxform form-horizontal adminex-form" id="form-upload1" name="form-upload1" method="post" enctype="multiple/form-data">
                                            <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                            'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                              <input type="hidden" name="sdo_id" id="sdo_id" value="<?=$this->uri->segment('3');?>">
                             <input type="hidden" name="group_id" id="group_id" value="<?=$this->uri->segment('4');?>">
                           
                             
                            
                                       

                                    

                                            <div class="col-md-12" id="reg-1">
                                                <div class="form-group row">
                                                     <label for="cname" class="control-label col-lg-3">Unique NO *  </label>
                                                  <div class="col-lg-9">
                                                     <input type="text" name="title" id="title" class="form-control" value="<?=$last_reg_no->unique_no;?>" readonly required>
                                                   </div>
                                               </div>
                                                    <div class="form-group row">
                                                     <label for="cname" class="control-label col-lg-3">File *  </label>
                                                  <div class="col-lg-9">
                                                     <input type="file" name="title" id="title" class="form-control"   required>
                                                   </div>
                                               </div>
                                               <div class="pull-right">
                                                    <button class="btn btn-danger btn-sm" data-dismiss="modal"  type="button">Close</button>
                                                    <button class="btn btn-success btn-sm" type="button" onclick="save_data();">Save changes</button>
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

<script src="ajax/upload-document.js"></script>
  <script type="text/javascript" src="ajax/dashboard.js"></script>
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


                          



    
