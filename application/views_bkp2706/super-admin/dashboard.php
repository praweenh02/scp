 <!-- page heading start-->
        <div class="page-heading" style="background:#fff">
            <h3>
                Dashboard
            </h3>
          <hr>
           
        </div>
        <!-- page heading end-->

     
   <!--body wrapper start-->
        <div class="wrapper" style="background:#fff">
            <div class="row">
                <div class="col-md-12">
                    <!--statistics start-->
                    <div class="row state-overview">
                         <div class="col-md-3 col-xs-12 col-sm-6">
                            <div class="panel  cusor red" onClick="window.location.href='super-admin/member/recommend_new_member_requests'">
                                <div class="symbol">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value"><?=$total_new_member_request;?></div>
                                    <div class="title">New Member Request</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-12 col-sm-6">
                            <div class="panel cusor" onClick="window.location.href='super-admin/group/'" style="background-color: orange;">
                                <div class="symbol">
                                    <i class="fa fa-eye"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value"><?=$total_group;?></div>
                                    <div class="title">Total Working Groups </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-12 col-sm-6">
                            <div class="panel cusor" onClick="window.location.href='super-admin/member/member_list/'" style="background-color: green;">
                                <div class="symbol">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value"><?=$taotal_users;?></div>
                                    <div class="title">Total Group Members</div>
                                </div>
                            </div>
                        </div>
                         <div class="col-md-3 col-xs-12 col-sm-6">
                            <div class="panel cusor" onClick="window.location.href='super-admin/member/group_manager_list/'"  style="background-color: red;" >
                                <div class="symbol">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value"><?=$taotal_gmanager;?></div>
                                    <div class="title"> Total Group Managers</div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row state-overview">
                      
                        <div class="col-md-3 col-xs-12 col-sm-6">
                            <div class="panel cusor" onClick="window.location.href='super-admin/question/'" style="background-color: blue;">
                                <div class="symbol">
                                    <i class="fa fa-file-text"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value"><?=$total_que;?></div>
                                    <div class="title">Total Group Question</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--statistics end-->
                </div>
                
            </div>
           </div>

       
        
      <style>
      .cusor{
          cursor:pointer;
      }
        </style>