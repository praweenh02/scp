 <div class="page-heading">
    <h3>
    Minutes of Meetings
        
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
                   Minutes of Meetings List
                  <span class="mb-5 pull-right" style="margin-top: -6px;">
                    <a  href="groupmanager/add_mintues_of_meeting/0/" class="btn btn-primary btn-sm" >
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
                                <th>Meeting Title</th>
                                <th>Minutes of Meeting file</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="loadallData">
                            <?php
                            $i=1;
                            foreach ($mintuse_of_meeting_list as $group_data){
                            $meeting_data = $this->db->select('*')->where('meeting_id',$group_data->meeting_id)->get('group_meeting')->row();
                            ?>


                                <tr class="gradeX">
                                  <td><?=$i;?></td> 
                                  <td><?=$meeting_data->meeting_title;?></td> 

                                  <td><?php if($group_data->minutes_of_meeting_file)
                                  {
                                     echo '<a target="_blank" href="'.base_url().'uploads/meeting-file/'.$group_data->minutes_of_meeting_file.'">Download</a>';
                                 }else{
                                  
                              }
                          ?></td>

                           
                          <td>
                             <?=($group_data->minutes_of_meeting_status=='Y')?  '<button class="btn-success btn-xs">Active</button>': '<button class="btn-danger btn-xs">Inactive</button>' ?>
                              
                          </td>

                          <td>
                            <a href="groupmanager/add_mintues_of_meeting/<?=$group_data->minutesofmeeting_id;?>/" class="btn btn-xs btn-primary" title="Edit"><i class="fa 
                                fa-edit"></i> Edit</a> </td>  
                                <td><button onclick="deleteMinuteofMeeting('<?=$group_data->minutesofmeeting_id;?>');" class="btn btn-xs btn-danger" title="Delete"><i class="fa 
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







