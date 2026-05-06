<?php //error_reporting(0)?>

 <div class="page-heading">
              <div class="col-md-7">
                    <h4>
                        <strong>
                       SDO  - <span><?=$group_data->category_name;?></span>&nbsp;&nbsp;&nbsp;
                
                       Working Group - <span><?=$group_data->group_title;?></span>
                       </strong>
                   </h4>
               </div>
          <hr>
                   </div>
              
 <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
      
                         
                                   
                                 <header class="panel-heading">
         Upload New File
            <span class="mb-5 pull-right" style="margin-top: -6px;">
                <a onclick="window.history.back(-1);" class="btn btn-danger btn-sm ">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
             </span>
        </header>
                             
                             
           
        <div class="panel-body">
            <div class="tab-content">
                   <?php $current_date = date('Y-m-d');
                  if($current_date >=  $document_expiry_date['start_date']  AND    $current_date <= $document_expiry_date['end_date'])
                                {?> 
               <div class="tab-pane active " id="home-2">
                      <form class="cmxform form-horizontal adminex-form" id="form-reupload" name="form-reupload" method="post" enctype="multiple/form-data">
                                            <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                            'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                              <input type="hidden" name="sdo_id" id="sdo_id" value="<?=$this->uri->segment('3');?>">
                             <input type="hidden" name="group_id" id="group_id" value="<?=$this->uri->segment('4');?>">
                               <input type="hidden" name="contribution_id" id="contribution_id" value="<?=$last_reg_no->contribution_id ;?>">
                           
                             
                            
                                       

                                    

                                            <div class="col-md-12" id="reg-1">
                                                <div class="form-group row">
                                                     <label for="cname" class="control-label col-lg-3">Title   </label>
                                                  <div class="col-lg-9">
                                                     <input type="text" name="title" id="title" class="form-control" value="<?=$last_reg_no->title;?>" readonly required>
                                                   </div>
                                               </div>
                                                    <div class="form-group row">
                                                     <label for="cname" class="control-label col-lg-3">File *  </label>
                                                  <div class="col-lg-9">
                                                     <input type="file" accept="document/,.pdf,.docx,.doc" name="docfile" required id="docfile" class="form-control"   required>
                                                   </div>
                                               </div>
                                                  <div class="form-group row">
                                                     <label for="cname" class="control-label col-lg-3">Password *  </label>
                                                  <div class="col-lg-9">
                                                     <input type="password"  name="password"  id="password" class="form-control"   required>
                                                   </div>
                                               </div>
                                               <div class="pull-right">
                                                    <button class="btn btn-danger btn-sm" onclick="window.history.back(-1);"type="button">Back</button>
                                                    <button class="btn btn-success btn-sm btn-submit" type="button" onclick="re_upload_file_save();">Save changes</button>
                                                </div>
                                         </div>

                                           

                                       

                            
                    </form>     
             
    <div class="row">
        <div class="col-sm-12">
           <section class="panel">
              <header class="panel-heading">
                   Upload File History
                    <span class="mb-5 pull-right" >
                        <!--<a  href="group/add_upload_doc_file/<?=$group_data->category_id;?>/<?=$group_data->group_id;?>/0/" class="btn btn-primary btn-sm" >
                           <i class="fa fa-plus"></i> Add New
                       </a>-->
                   </span>
            </header>
        <div class="panel-body">
        <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="dynamic-table">
           <thead>
               <tr>
                 <th>Sr.No.</th>
                
                  <th class="numeric">Unique No.</th> 
                  <th>Contribution Title</th>
                  <th>File</th>
                 
                </tr>
           </thead>
        <tbody id="loadallData">
            <?php
            $i=1;
            foreach ($reupload_file as $docreg_data){

             
               
            ?>
                <tr class="gradeX">
                  <td><?=$i;?></td>  
                
                  
                   <td><?=$docreg_data->unique_no;?></td>  
                   <td><?=$docreg_data->title;?></td>  
                   <td><a href="<?=base_url();?>uploads/files/<?=$docreg_data->old_file;?>" target="_blank"><i class="fa fa-download">Download</i></td>
                
               </tr>

            <?php $i++; }?>
      
       
       
         </tbody>
        </table>
        </div>
        </div>
      </section>
        </div>
        </div>
     
      

        </div>
               <?php }else { ?>

                        <div class="alert alert-danger">
                         Doc file uploading date is exit.
                                  
                        </div>
                    <?php }?>
                  
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


                          



    
