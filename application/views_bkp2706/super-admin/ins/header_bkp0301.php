 <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo">
            <a href="super-admin/dashboard"><img src="assets/images/logo.png" width="200"  style="margin-top:5px;" alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="super-admin/dashboard"><img src="assets/images/icon.png" width="50" alt=""></a>
        </div>
        <!--logo and iconic logo end-->

        <div class="left-side-inner">

            <!-- visible to small devices only -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media logged-user">
                    <img alt="" src="assets/images/photos/user-avatar.png" class="media-object">
                    <div class="media-body">
                        <h4><a href="#"><?=$this->session->userdata('superadmin_name');;?></a></h4>
                        <span>"Hello There..."</span>
                    </div>
                </div>

                <h5 class="left-nav-title">Account Information</h5>
                <ul class="nav nav-pills nav-stacked custom-nav">
                  <li><a href="super-admin/dashboard/profile/"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                  <li><a href="super-admin/dashboard/password_change/"><i class="fa fa-cog"></i> <span>Change Password</span></a></li>
                  <li><a href="super-admin/auth/logout/"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
                </ul>
            </div>

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li class="<?=$this->uri->segment(2)=='dashboard' ? 'active':'';?>"><a href="super-admin/dashboard/"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                <li class="menu-list <?=$this->uri->segment(2)=='group'? 'nav-active':''; ?>"><a href=""><i class="fa fa-laptop"></i> <span>Groups Management</span></a>
                    <ul class="sub-menu-list">
                        <li  class="<?php echo ($this->uri->segment(3)=='group_category'? 'active':''); ?>"><a href="super-admin/group/group_category/">SDO</a></li>
                        <li class="<?php echo ($this->uri->segment(2)=='group'? 'active':''); ?>"><a href="super-admin/group/"> Working Group</a></li>
                        <li class="<?php echo ($this->uri->segment(2)=='working_party'? 'active':''); ?>"><a href="super-admin/group/working_party"> Working Party</a></li>
                         <li class="<?php echo ($this->uri->segment(2)=='working_party'? 'active':''); ?>"><a href="super-admin/group/restore_groups">Restore Groups</a></li>
                          <li class="<?php echo ($this->uri->segment(2)=='working_party'? 'active':''); ?>"><a href="super-admin/group/restore_sdo">Restore SDO</a></li>
                        
                    </ul>
                </li>
                <li class="menu-list <?=$this->uri->segment(2)=='member'? 'nav-active':''; ?>"><a href=""><i class="fa fa-users"></i> <span>Member Manager</span></a>
                    <ul  class="sub-menu-list">
                        <li class="<?php echo ($this->uri->segment(3)=='recommend_new_member_requests'? 'active':''); ?>"><a href="super-admin/member/recommend_new_member_requests">New Member Request</a></li>
                        <li class="<?php echo ($this->uri->segment(3)=='group_manager_list'? 'active':''); ?>"><a href="super-admin/member/group_manager_list/">Group Manager List</a></li>
                        <li class="<?php echo ($this->uri->segment(3)=='member_list'? 'active':''); ?>"><a href="super-admin/member/member_list/">Active Member List</a></li>
                        <li class="<?php echo ($this->uri->segment(3)=='pending_member_list'? 'active':''); ?>"><a href="super-admin/member/pending_member_list/">All Member List</a></li>
                        
                    </ul>
                </li>
                  <li class="menu-list <?=$this->uri->segment(2)=='question'? 'nav-active':''; ?>"><a href=""><i class="fa fa-file-text"></i> <span>Question</span></a>
                    <ul class="sub-menu-list">
                         <li class="<?php echo ($this->uri->segment(3)=='create'? 'active':''); ?>"><a href="super-admin/question/add/0/">Add New Question</a></li>
                        <li class="<?php echo ($this->uri->segment(2)=='question'? 'active':''); ?>"><a href="super-admin/question/"> Question List</a></li>
                      
                    </ul>
                </li>
                 <li class="<?=$this->uri->segment(2)=='sdobulletin' ? 'active':'';?>"><a href="super-admin/sdobulletin/"><i class="fa  fa-bullhorn"></i> <span>SDO Bulletin</span></a></li>
                   <li class="<?=$this->uri->segment(2)=='faq' ? 'active':'';?>"><a href="super-admin/faq/"><i class="fa fa-hand-o-right"></i> <span>FAQ Management</span></a></li>
                    <li class="<?=$this->uri->segment(2)=='whatsnew' ? 'active':'';?>"><a href="super-admin/whatsnew/"><i class="fa fa-bell"></i> <span>What's New</span></a></li>
                     <li class="<?=$this->uri->segment(2)=='email_management' ? 'active':'';?>"><a href="super-admin/footer/"><i class="fa fa-envelope"></i> <span>Footer Management</span></a></li>
                      <li class="<?=$this->uri->segment(2)=='email_management' ? 'active':'';?>"><a href="super-admin/meeting/"><i class="fa fa-calendar"></i> <span>Meeting Management</span></a></li>
                        <li class="menu-list <?=$this->uri->segment(2)=='group'? 'nav-active':''; ?>"><a href=""><i class="fa fa-envelope"></i> <span>Outreach</span></a>
                    <ul class="sub-menu-list">
                     
                        <li class="<?php echo ($this->uri->segment(2)=='working_party'? 'active':''); ?>"><a href="super-admin/outreach/email">Email Management</a>
                        </li>
                                <li class="<?php echo ($this->uri->segment(2)=='subscriber'? 'active':''); ?>"><a href="super-admin/outreach/subscriber">Subscribers Management</a>
                        </li>
                        
                    </ul>
                </li>
               
            

                

                <li><a href="super-admin/auth/logout/"><i class="fa fa-sign-in"></i> <span>Log Out</span></a></li>

            </ul>
            <!--sidebar nav end-->

        </div>
    </div>