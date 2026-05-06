 <!-- page heading start-->
   <link type="text/css" rel="stylesheet" href="assets/plugins/tricker/css/jquery.jConveyorTicker.min.css?v=1.1.0" />

  <!-- Demo styles -->
  <link type="text/css" rel="stylesheet" href="assets/plugins/tricker/demo-files/demo-styles.css?v=1.1.0" />
        <div class="page-heading">
            <h3>
                Select SDO and Working Group
            </h3>
          <hr>
           
        </div>
        <!-- page heading end-->

     
   <!--body wrapper start-->
        <div class="wrapper">
              <?php
            if($this->session->userdata('user_type')=='member')
            {


             ?>
                                                         <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                            'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
               <div class="row">
                 <div class="col-sm-12 col-md-12">
                    <div class="panel">
                          <header class="panel-heading">
                             Select SDO and Working Group
                             <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                              </span>
                          </header>
                           <div class="panel-body">
                                           <div class="col-md-12">
                                               <div class="form-group col-md-6 col-sm-12">
                                                     <label for="cname"  class="control-label col-lg-3">Select SDO * </label>
                                                  <div class="col-lg-9">
                                                    <select  id="group_category" name="sdo_id" required="" class="form-control category"  placeholder="Select Working Group">
                                                       <option value="" selected>----Select SDO----</option>
                                                      <?php 
                                                          foreach($sdo_list as $cat_data):
                                                         ?>
                                                          <option value="<?=$cat_data->category_id;?>" ><?=$cat_data->category_name;?></option>

                         
                                                      <?php endforeach;?>
                                                   </select>
                                                   </div>
                                               </div>
                                                  <div class="form-group col-md-6 col-sm-12">
                                                     <label for="cname"  class="control-label col-lg-3">Select Working Groups * </label>
                                                  <div class="col-lg-9">
                                                     <select  onchange="getgroupId(this.value);"   required="" id="group_id" name="group_id" class="form-control align-right" style="float:right;" placeholder="Select Working Group">
                                                          
                                                              <option value="" selected disabled>---- First Select Categeory----</option> 
                                                            
                                      
                                                    </select>
                                                   </div>
                                               </div>
                          </div>                  
                     </div>
                                            
   
                 </div>
       

           
              <div class="row">
                    <div class="col-md-12">
                    <div class="panel">
                        <header class="panel-heading">
                          Group Meetings
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                             </span>
                        </header>
                        <div class="panel-body">
                           <div class="d-demo-wrap">
                            <div class="js-conveyor-3">
                               <ul>
                                <?php
                                foreach($group_meetings as $meeting_data )
                                {
                                ?>
                                    <li>
                                       <span><u><a href="home/groups/<?=$meeting_data->category_id;?>?groupId=<?=base64_encode($meeting_data->group_id);?>" target="_blank"><?=$meeting_data->group_title;?> - </a></u> Meeting date is - <?=date('d-m-Y',strtotime($meeting_data->meeting_date));?></span>
                                    </li>
                              <?php }?>
                                
                              </ul>
                          </div>
                        </div>
                          
                        </div>
                    </div>
            </div>
        </div>
            <?php }else if($this->session->userdata('user_type')=='group_manager'){
              $user_id = $this->session->userdata('user_id');
            $totalmemberRequest = $this->db->select('users.*,category.category_name,groups.group_title')->join('category','users.group_category_id=category.category_id','left')->join('groups','users.group_id=groups.group_id','INNER')->where('users.user_type','member')->where('users.suerp_admin_status','')->order_by('users.user_id','DESC')->get('users')->num_rows();
            
             $totalgroups = $this->db->select('category.category_name,groups.group_title, group_managers.group_id, group_managers.*')->join('groups','group_managers.group_id=groups.group_id','left')->join('category','category.category_id=groups.category_id','INNER')->where('group_managers.member_id',$user_id)->get('group_managers')->num_rows();
            ?>
                 <div class="row">
                <div class="col-md-12">
                    <!--statistics start-->
                    <div class="row state-overview">
                         <div class="col-md-3 col-xs-12 col-sm-6">
                            <div class="panel green">
                                <div class="symbol">
                                    <i class="fa fa-group"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value"><?=$totalgroups;?></div>
                                    <div class="title">Total Group</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-xs-12 col-sm-6">
                            <div class="panel blue">
                                <div class="symbol">
                                    <i class="fa fa-files-o"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value">0</div>
                                    <div class="title">Total Files</div>
                                </div>
                            </div>
                        </div>
                         <div class="col-md-3 col-xs-12 col-sm-6">
                            <div class="panel red">
                                <div class="symbol">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value"><?=$totalmemberRequest;?></div>
                                    <div class="title">New Member Request</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-12 col-sm-6">
                            <div class="panel green">
                                <div class="symbol">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value">0</div>
                                    <div class="title">Total Meeting</div>
                                </div>
                            </div>
                        </div>
                         
                    </div>
                    
                    <!--statistics end-->
                </div>
                  
                 </div>

           <?php  } ?>    
           </div>

        </div>
    </div>
      <!-- Plugin styles -->

  
<script type="text/javascript" src="ajax/dashboard.js"></script>
 

