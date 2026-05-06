 <div class="page-heading">
    <div class="row">
              <div class="col-md-7">
                   <h3>
                Member Uploaded Documents
                 </h3>
              </div>
              
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
          Documents List
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
            <th class="numeric">Document No.</th> 
            <th>Contribution Title</th>
            <th>Status</th>
            <th>Download</th>
            <th>Uploaded by Member</th>
            <th>View</th>
            <th>Delete</th>
    
          
        </tr>
        </thead>
        <tbody id="loadallData">
            <?php
            $i=1;
            foreach ($documnet_list as $docreg_data){

             
               
            ?>
                <tr class="gradeX">
                  <td><?=$i;?></td>  
                
                  <td><?=$docreg_data->group_title;?></td>
                   <td>
                        <?php
                      if($docreg_data->file_status=='uploaded' OR $docreg_data->file_status=='re-uploaded')
                      {?>


                           <a target="_blank"  href="uploads/files/<?=$docreg_data->file;?>"  title="<?=$docreg_data->file;?>">
                       <?=$docreg_data->unique_no;?>-<?=$docreg_data->re_upload_no;?>
                       </a>
                       <?php }else {?>
                           
                            <?=$docreg_data->unique_no;?>-<?=$docreg_data->re_upload_no;?>
                       <?php } ?>
                       
                       </td>  
                  <td><?=$docreg_data->title;?></td>  
                  <td>
                      <?php
                      if($docreg_data->group_manager_status=='accept')
                      {?>
                        <button class="btn btn-xs btn-success">Accepted</button>

                      <?php }else if($docreg_data->group_manager_status=='reject')
                      { ?>
                        <button class="btn btn-xs btn-danger">Rejected</button>
                      <?php }else{ ?>
                         <button class="btn btn-xs btn-primary">Pending</button>
                      <?php }?>

                  </td>
                  
                  <td>
                       <?php
                      if($docreg_data->file_status=='uploaded' OR $docreg_data->file_status=='re-uploaded')
                      {?>


                           <a target="_blank" href="uploads/files/<?=$docreg_data->file;?>" class="btn btn-xs btn-info" title="<?=$docreg_data->file;?>"><i class="fa fa-download"></i> Download </a> 
                        
                        <?php } ?>   
                  </td>
                  <td><?=$docreg_data->name;?> <?=$docreg_data->surname;?> </td>
                  <td>
                                     <a href="groupmanager/view_doc_file/<?=$docreg_data->sdo_id;?>/<?=$docreg_data->group_id;?>/<?=$docreg_data->contribution_id ;?>/" class="btn btn-xs btn-primary" title="<?=$docreg_data->file;?>"><i class="fa fa-eye"></i> View </a> 
                  </td>  
                    <td><button onclick="deleteMemberUploadDoc('<?=$docreg_data->contribution_id;?>');" class="btn btn-xs btn-danger" title="Delete"><i class="fa 
                                    fa-trash-o"></i> Delete</button></td>  
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


                          



    
