 <div class="page-heading">
    <div class="row">
              <div class="col-md-7">
                   <h3>
                 <?=$group_data->group_title;?>'s  Document Registration
                 </h3>
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
             Document Registration
               <span class="mb-5 pull-right" >
                        <a  href="group/add_upload_new_contributions/<?=$group_data->category_id;?>/<?=$group_data->group_id;?>/0/" class="btn btn-primary btn-sm" >
                           <i class="fa fa-plus"></i> Add New
                       </a>
                   </span>
         
        </header>
        <div class="panel-body">
        <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="dynamic-table">
        <thead>
        <tr>
            <th>Sr.No.</th>
            <th>Group Title</th>
            <th>Contribution Title</th>
            <th>Unique No.</th>
            <th>Edit</th>
            <th>Delete</th>
    
          
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
                  <td><?=$docreg_data->title;?></td>  
                  <td><?=$docreg_data->unique_no;?></td>  
                  
                  <td>
                    <a href="group/edit_upload_contribution/<?=$docreg_data->sdo_id;?>/<?=$docreg_data->group_id;?>/<?=$docreg_data->contribution_id ;?>/" class="btn btn-xs btn-primary" title="Edit"><i class="fa 
fa-edit"></i> Edit</a> </td>  
               
                     <td>
                    <a  onclick="deleteData('<?=$docreg_data->contribution_id ;?>','<?=$docreg_data->sdo_id;?>','<?=$docreg_data->group_id;?>');" class="btn btn-xs btn-danger" title="Edit"><i class="fa 
fa-trash-o"></i> Delete</a> </td>  
                
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


                          



    
