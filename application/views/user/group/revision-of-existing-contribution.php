 <div class="page-heading">
    <div class="row">
                    <div class="col-md-7">
                    <h4>
                        <strong>
                       SDO  - <span><?=$group_data->category_name;?></span>&nbsp;&nbsp;&nbsp;
                
                       Working Group - <span><?=$group_data->shortform;?></span>
                       </strong>
                   </h4>
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
            Revision existing contribution file
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
            <th>Download</th>
            <th>Action</th>
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
                   <td><?=$docreg_data->unique_no;?><?php if($docreg_data->re_upload_no) { ?> - <?php }?><?=$docreg_data->re_upload_no;?></td>  
                  <td><?=$docreg_data->title;?></td>  
                  <td>
                      <?php
                      if($docreg_data->group_manager_status=='accept')
                      {?>
                        <button class="btn btn-xs btn-success">Accecpted</button>

                      <?php }else if($docreg_data->group_manager_status=='reject'){ ?>
                        <button class="btn btn-xs btn-danger">Rejected</button>
                     <?php }else {?>
                          <button class="btn btn-xs btn-primary">Pending</button>
                     <?php }?>

                  </td>
                  <td>
                    <a  href="<?=base_url();?>uploads/files/<?=$docreg_data->file;?>" target="_blank"><i class="fa fa-download"></i> Download</a>
                  </td>
                   
                  <td>
                     <a href="group/re_upload_doc_file/<?=$docreg_data->sdo_id;?>/<?=$docreg_data->group_id;?>/<?=$docreg_data->contribution_id ;?>/" class="btn btn-xs btn-info" title="File Upload"><i class="fa fa-file"></i> Re-upload </a> 
                      
                  </td>  
                    <td>
                      <a href="group/edit_upload_contribution/<?=$docreg_data->sdo_id;?>/<?=$docreg_data->group_id;?>/<?=$docreg_data->contribution_id ;?>/" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-edit"></i> Edit</a> 
                   </td>  
                  <td>
                     <a  onclick="deleteData('<?=$docreg_data->contribution_id ;?>','<?=$docreg_data->sdo_id;?>','<?=$docreg_data->group_id;?>');" class="btn btn-xs btn-danger" title="Edit"><i class="fa fa-trash-o"></i> Delete</a>
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


                          



    
