 <div class="page-heading">
    <h3>
        <!--Minutes of Meetings--> 
        Group Meeting
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
                  Group Meetings List
                  <span class="mb-5 pull-right" style="margin-top: -6px;">
                    <a  href="groupmanager/add_meeting/0/" class="btn btn-primary btn-sm" >
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
                                <th>Meeting Type</th>
                                <th>Group Title</th>
                                <th>Meeting Title</th>
                                <th>Meeting Date</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="loadallData">
                            <?php
                            $i=1;
                            foreach ($meeting_list as $group_data){?>


                                <tr class="gradeX">
                                  <td><?=$i;?></td> 
                                  <td><?php if($group_data->meeting_type=='nwg'){
                                      echo "NWG Meeting";
                                  }else if($group_data->meeting_type=='itu'){
                                      echo "ITU Meeting";
                                  }
                                  
                                  ?></td>
                                  <td><?=$group_data->group_title;?></td> 

                                  <td><?php if($group_data->meeting_file)
                                  {
                                     echo '<a target="_blank" href="'.base_url().'uploads/meeting-file/'.$group_data->meeting_file.'">'.$group_data->meeting_title.'</a>';
                                 }else{
                                  echo $group_data->meeting_title;
                              }
                          ?></td>

                          <td><?=date('d-m-Y',strtotime($group_data->meeting_date));?></td>  
                          <td>
                             <?=($group_data->meeting_status=='Y')?  '<button class="btn-success btn-xs">Active</button>': '<button class="btn-danger btn-xs">Inactive</button>' ?>
                              
                          </td>

                          <td>
                            <a href="groupmanager/add_meeting/<?=$group_data->meeting_id;?>/" class="btn btn-xs btn-primary" title="Edit"><i class="fa 
                                fa-edit"></i> Edit</a> </td>  
                                <td><button onclick="deleteMeeting('<?=$group_data->meeting_id;?>');" class="btn btn-xs btn-danger" title="Delete"><i class="fa 
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







