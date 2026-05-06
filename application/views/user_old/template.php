<?php  $this->load->view('user/includes/head'); ?>

<body class="sticky-header">

<section>
    <!-- left side start-->
   <?php $this->load->view('user/includes/header'); ?>
    <!-- left side end-->
    
    <!-- main content start-->
    <div class="main-content" >

        <!-- header section start-->
        <div class="header-section">

            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--toggle button end-->

            <!--search start-->
            <?php
            if($this->session->userdata('assign_group_manager')=='Y')
            {


            ?>
            <form class="searchform" action="<?=base_url();?>dashboard/change_usertype" method="post">
                                <?php  $csrf = array(
                  'name' => $this->security->get_csrf_token_name(),
                  'hash' => $this->security->get_csrf_hash());
                  ?>

         <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                <input type="hidden" name="user_email" value="<?=$this->session->userdata('user_email');?>">
                <select name="user_type" id="user_type" class="form-control col-md-2" onchange="this.form.submit()">
                    <option value="member" <?=$this->session->userdata('user_type')=='member'? 'selected':'' ?>>Member</option>
                      <option value="group_manager" <?=$this->session->userdata('user_type')=='group_manager'? 'selected':'' ?>>Group Manager</option>
                    
                </select>
            </form>
        <?php }?>
            <!--search end-->

            <!--notification menu start -->
            <div class="menu-right">
                <ul class="notification-menu">
                   
                    <li>
                        <a href="super-admin/dashboard/profile/" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <img src="assets/images/photos/user-avatar.png" alt="" />
                          <?=$this->session->userdata('user_name');?>
                          <span>(<?=$this->session->userdata('user_type')=='group_manager'?'Group Manager':'Member';?>)</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a href="dashboard/profile/"><i class="fa fa-user"></i>  Profile</a></li>
                            <li><a href="dashboard/password_change/"><i class="fa fa-cog"></i>  Change Password</a></li>
                            <li><a href="login/logout"><i class="fa fa-sign-out"></i> Log Out</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!--notification menu end -->

        </div>
        <!-- header section end-->
       <?php  $this->load->view($page);?>
       

     
        <!--body wrapper end-->

       <?php $this->load->view('user/includes/footer'); ?>