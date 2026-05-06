 <div class="page-heading">
    <div class="row">
             <div class="col-md-7">
                    <h4>
                        <strong>
                       SDO  - <span><?=$group_data->category_name;?></span>&nbsp;&nbsp;&nbsp;
                
                       Working Group - <span><?=$group_data->group_title;?></span>
                       </strong>
                   </h4>
               </div>
               <?php
                $current_date = date('Y-m-d');
                  if($current_date >=  $document_expiry_date['start_date']  AND    $current_date <= $document_expiry_date['end_date'])
                   {?> 
                      <div class="col-md-5 alert alert-success pull-left col-md-offset-4" style="margin-top:-40px;" >
                       
                            For New Document Registration date is - <?=date('d-m-Y', strtotime($document_expiry_date['start_date']));?> To  <?=date('d-m-Y', strtotime($document_expiry_date['end_date']));?>  
                        <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                  
                        </div>
                   <?php }?>  
        </div>    
        <hr>
</div>
                   <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                             'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" id="csrf_token_name" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
<div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
        <header class="panel-heading">
              File Upload
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
            <th>Group Title</th>
            <th class="numeric">Unique No.</th> 
            <th>Contribution Title</th>
            <th>File Status</th>
            <th>Action</th>
           
    
          
        </tr>
        </thead>
        <tbody id="loadallData">
            <?php
            $i=1;
            foreach ($doc_reg_list as $docreg_data){

             
               
            ?>
                <tr class="gradeX">
                  <td><?=$i;?></td>  
                
                  <td><?=$docreg_data->group_title;?></td>
                   <td><?=$docreg_data->unique_no;?></td>  
                  <td><?=$docreg_data->title;?></td>  
                  <td>
                      <?php
                      if($docreg_data->file_status=='uploaded')
                      {?>
                        <button class="btn btn-xs btn-success">uploaded</button>

                      <?php }else{ ?>
                        <button class="btn btn-xs btn-danger">Not Upload</button>


                      <?php }?>

                  </td>
                  
                  <td>
                       <?php
                      if($docreg_data->file_status=='blank' && empty($docreg_data->file))
                      {?>

                           <a href="group/add_upload_doc_file/<?=$docreg_data->sdo_id;?>/<?=$docreg_data->group_id;?>/<?=$docreg_data->contribution_id ;?>/" class="btn btn-xs btn-info" title="File Upload"><i class="fa fa-file"></i> File Upload </a> 
                        <?php }else {?>

                           <a href="uploads/files/<?=$docreg_data->file;?>" class="btn btn-xs btn-info" title="<?=$docreg_data->file;?>"><i class="fa fa-download"></i> Download </a> 
                        
                        <?php } ?>   
                  </td> 
                
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
      

      <div id="popupdiv"></div>

<script src="ajax/upload-document.js"></script>


                          



    
