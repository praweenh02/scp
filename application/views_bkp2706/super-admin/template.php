<?php  $this->load->view('super-admin/ins/head'); ?>

<body class="sticky-header">

<section>
    <!-- left side start-->
   <?php $this->load->view('super-admin/ins/header'); ?>
    <!-- left side end-->
    
    <!-- main content start-->
    <div class="main-content" >

        <!-- header section start-->
        <div class="header-section">

            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--toggle button end-->

            <!--search start-->
            <!--<form class="searchform" action="index.html" method="post">
                <input type="text" class="form-control" name="keyword" placeholder="Search here..." />
            </form>-->
            <!--search end-->

            <!--notification menu start -->
            <div class="menu-right">
                <ul class="notification-menu">
                   
                    <li>
                        <a href="super-admin/dashboard/profile/" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <img src="assets/images/photos/user-avatar.png" alt="" />
                          <?=$this->session->userdata('superadmin_name');?>
                          <span>(<?=$this->session->userdata('superadmin_email');?>)</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a href="super-admin/dashboard/profile/"><i class="fa fa-user"></i>  Profile</a></li>
                            <li><a href="super-admin/dashboard/password_change/"><i class="fa fa-cog"></i>  Change Password</a></li>
                            <li><a href="super-admin/auth/logout"><i class="fa fa-sign-out"></i> Log Out</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!--notification menu end -->

        </div>
        <!-- header section end-->
       <?php  $this->load->view($page);?>
       

     
        <!--body wrapper end-->

       <?php $this->load->view('super-admin/ins/footer'); ?>