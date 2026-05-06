 <div class="page-heading">
    <h3>
       Outcome Documents
   </h3>
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
                  Outcome Documents List
                  <span class="mb-5 pull-right" style="margin-top: -6px;">
                    <a  href="groupmanager/add_outcome_documents/0/" class="btn btn-primary btn-sm" >
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
                                <th>Outcome Document Title</th>
                                <th>Date</th>
                                <td>Status</td>
                                <th>Edit</th>
                                <th>Delete</th>
                                
                                
                            </tr>
                        </thead>
                        <tbody id="loadallData">
                            <?php
                            $i=1;
                            foreach ($outcome_list as $group_data){

                               
                                ?>
                                <tr class="gradeX">
                                  <td><?=$i;?></td>  
                                  
                                  <td>
                                    <?php
                                    if($group_data->outcome_file)
                                        {?>
                                         <a href="uploads/outcome-documents/<?=$group_data->outcome_file;?>" target="_blank"> <?=$group_data->outcome_document_title;?></a>

                                     <?php }else {?>
                                      <?=$group_data->outcome_document_title;?>
                                  <?php } ?>

                              </td>
                              <td><?=date('Y-m-d', strtotime($group_data->created_at));?></td>  
                              <td><?=($group_data->outcomedocument_staus=='Y')?  '<button class="btn-success btn-xs">Active</button>': '<button class="btn-danger btn-xs">Inactive</button>' ?></td>
                              
                              <td>
                                <a href="groupmanager/add_outcome_documents/<?=$group_data->outcome_document_id ;?>/" class="btn btn-xs btn-primary" title="Edit"><i class="fa 
                                    fa-edit"></i> Edit</a> </td>  
                                    <td><button onclick="deleteOutcomeDocument('<?=$group_data->outcome_document_id;?>');" class="btn btn-xs btn-danger" title="Delete"><i class="fa 
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

    <script src="ajax/user-group-manager.js"></script>


    



    
