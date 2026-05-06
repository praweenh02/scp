 <div class="page-heading">
    <h3>
         Group Bulletin
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
                    Group Bulletin
                  <span class="mb-5 pull-right" style="margin-top: -6px;">
                    <a  href="groupbulletin/create/0/" class="btn btn-primary btn-sm" >
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
                                <th>Title</th>
                                <td>Status</td>
                                <th>Edit</th>
                                <th>Delete</th>
                                
                                
                            </tr>
                        </thead>
                        <tbody id="loadallData">
                            <?php
                            $i=1;
                            foreach ($result as $group_data){

                               
                                ?>
                                <tr class="gradeX">
                                  <td><?=$i;?></td>  
                                  
                                  <td>
                                    <?php
                                    if($group_data->bulletin_file)
                                        {?>
                                         <a href="uploads/group-bulletin/<?=$group_data->bulletin_file;?>" target="_blank"> <?=$group_data->bulletin_title;?></a>

                                     <?php }else {?>
                                      <?=$group_data->bulletin_title;?>
                                  <?php } ?>

                              </td>
                              
                              <td><?=($group_data->bulletin_status=='Y')?  '<button class="btn-success btn-xs">Active</button>': '<button class="btn-danger btn-xs">Inactive</button>' ?></td>
                              
                              <td>
                                <a href="groupbulletin/create/<?=$group_data->groupbulletin_id;?>/" class="btn btn-xs btn-primary" title="Edit"><i class="fa 
                                    fa-edit"></i> Edit</a> </td>  
                                    <td><button onclick="deleteGroupBulletin('<?=$group_data->groupbulletin_id;?>');" class="btn btn-xs btn-danger" title="Delete"><i class="fa 
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

    <script src="ajax/user-group-bulletin.js"></script>


    



    
