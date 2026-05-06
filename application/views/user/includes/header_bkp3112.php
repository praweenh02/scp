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
                    <h4><a href="#"><?=$this->session->userdata('user_name');?> <?=$this->session->userdata('user_surname');?></a></h4>
                    <span><?=$this->session->userdata('user_type')=='group_manager'?'Group Manager':'Member';?></span>
                </div>
            </div>

            <h5 class="left-nav-title">Account Information</h5>
            <ul class="nav nav-pills nav-stacked custom-nav">
              <li><a href="dashboard/profile/"><i class="fa fa-user"></i> <span>Profile</span></a></li>
              <li><a href="dashboard/password_change/"><i class="fa fa-cog"></i> <span>Change Password</span></a></li>
              <li><a href="login/logout/"><i class="fa fa-sign-out"></i> <span>Log Out</span></a></li>
          </ul>
      </div>

      <!--sidebar nav start-->
      <?php if($this->session->userdata('user_type')=='member') 
      {
        ?>   
        <ul class="nav nav-pills nav-stacked custom-nav">
            <li class="<?php if($this->uri->segment(1)=='dashboard' && $this->uri->segment(2)!=='profile'){ echo  'active'; } ?>"><a href="dashboard/"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
            <li class="<?php if($this->uri->segment(2)=='select_sdo' && $this->uri->segment(2)!=='profile'){ echo  'active'; } ?>"><a href="dashboard/select_sdo/"><i class="fa fa-calendar-o"></i> <span>Select SDO</span></a></li>
            <?php if(!empty($this->uri->segment('3')) &&  !empty($this->uri->segment('3'))) 
            {?>
                <li class=" <?=$this->uri->segment(2)=='documents'? 'active':''; ?>"><a href="group/documents/<?=$this->uri->segment('3');?>/<?=$this->uri->segment('4');?>/"><i class="fa fa-laptop"></i> <span>Documents</span></a>

                </li>
                
                <li class="<?=($this->uri->segment(2) =='add_upload_new_contributions' OR $this->uri->segment(2)=='upload_doc_file'  OR $this->uri->segment(2)=='upload_revision_of_existing_contribution') ? 'nav-active':''; ?>  menu-list"><a><i class="fa fa-file-o"></i>New Contributions </a>
                    <ul class="sub-menu-list" style="">
                        <li class="<?=$this->uri->segment(2)=='add_upload_new_contributions'? 'active':''; ?>"><a href="group/add_upload_new_contributions/<?=$this->uri->segment('3');?>/<?=$this->uri->segment('4');?>/">Doc Registration</a></li>
                        <li class="<?=$this->uri->segment(2)=='upload_doc_file'? 'active':''; ?>"><a href="group/upload_doc_file/<?=$this->uri->segment('3');?>/<?=$this->uri->segment('4');?>/">Doc file Upload</a></li>
                           <li class="<?=$this->uri->segment(2)=='upload_revision_of_existing_contribution'? 'active':''; ?>"> <a href="group/upload_revision_of_existing_contribution/<?=$this->uri->segment('3');?>/<?=$this->uri->segment('4');?>/"><span>Uploaded Revision of Existing Contribution</span></a></li>


                    </ul>

                </li>
             
            <?php }?>   
                <li class="<?=$this->uri->segment(2)=='email'? 'active':''; ?>"><a href="email/"><i class="fa fa-users"></i> <span>Email Subscription</span></a>

            <li class="<?=$this->uri->segment(2)=='profile'? 'active':''; ?>"><a href="dashboard/profile/"><i class="fa fa-users"></i> <span>Profile</span></a>

            </li>



            <li><a href="login/logout/"><i class="fa fa-sign-in"></i> <span>Log Out</span></a></li>

        </ul>


    <?php }else if($this->session->userdata('user_type')=='group_manager'){ ?>
         <?php if(!empty($this->session->userdata('group_id'))){ ?>
       <ul class="nav nav-pills nav-stacked custom-nav">
        <li class="active <?=$this->uri->segment(1)=='dashboard'? 'active':''; ?>"><a href="dashboard/"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li class="active <?=$this->uri->segment(2)=='group_list'? 'active':''; ?>"><a href="groupmanager/group_list"><i class="fa fa-cogs"></i><span>Working Group</span></a></li>
        <li class="active <?=($this->uri->segment('2')=='manage_document_uploaded_by_member' OR $this->uri->segment(1)=='member') ? 'active':'';?> menu-list">
        <a href="#" ><i class="fa fa-users"></i> <span>Members Management</span></a>
            <ul class="sub-menu-list">
               
                 <li class="active <?=$this->uri->segment(1)=='member'? 'active':''; ?>"><a href="member/"><span> New Member Requests</span></a>
                 </li>
              

                
            </ul>
            
        </li>
         <li class="active <?=($this->uri->segment('2')=='manage_restricted_bulletin_board_of_the_working_group' OR $this->uri->segment(2)=='group_meeting' OR $this->uri->segment(2)=='minutes_of_meeting' OR $this->uri->segment(2)=='add_mintues_of_meeting' OR $this->uri->segment(2)=='document_from_itu' OR  $this->uri->segment(2)=='document_expiry' OR $this->uri->segment(2)=='circulars') ? 'active':'';?> menu-list">
             <a href="#" ><i class="fa fa-files-o"></i> <span>Meeting Management</span></a>
            <ul class="sub-menu-list">
              <li class="active <?=$this->uri->segment(2)=='group_meeting'? 'active':''; ?> <?=$this->uri->segment(2)=='add_meeting'? 'active':''; ?>"> <a href="groupmanager/group_meeting/"> <span>Add  Meeting</span></a></li>
         <li class="active <?=$this->uri->segment(2)=='minutes_of_meeting'? 'active':''; ?> <?=$this->uri->segment(2)=='add_mintues_of_meeting'? 'active':''; ?>"> <a href="groupmanager/minutes_of_meeting/"> <span>Minutes of Meetings</span></a></li>
         </ul>
        </li>
             <li class="active <?=($this->uri->segment('2')=='manage_restricted_bulletin_board_of_the_working_group' OR $this->uri->segment(2)=='group_meeting' OR $this->uri->segment(2)=='minutes_of_meeting' OR $this->uri->segment(2)=='add_mintues_of_meeting' OR $this->uri->segment(2)=='document_from_itu' OR  $this->uri->segment(2)=='document_expiry' OR $this->uri->segment(2)=='circulars') ? 'active':'';?> menu-list">
             <a href="#" ><i class="fa fa-files-o"></i> <span>Docs Management</span></a>
            <ul class="sub-menu-list">
       
     
      
        <li class="active <?=$this->uri->segment(2)=='outcome_document'? 'active':''; ?>"> <a href="groupmanager/outcome_document/"> <span>Outcome Documents </span></a></li>
        <li class="active <?=$this->uri->segment(2)=='document_from_itu'? 'active':''; ?>"> <a href="groupmanager/document_from_itu/"> <span>Documents from ITU site </span></a></li>
         <li class="active <?=$this->uri->segment(2)=='circulars'? 'active':''; ?>"> <a href="groupmanager/circulars/"> <span> Circulars</span></a></li>
         <li class="active <?=$this->uri->segment(2)=='manage_document_uploaded_by_member'? 'active':''; ?>"> <a href="groupmanager/manage_document_uploaded_by_member/"><span>Manage Documents uploaded by Members</span></a></li>

       
      
        </ul>
           <li class="active <?=$this->uri->segment(2)=='groupbulletin'? 'active':''; ?>"><a href="groupbulletin/"> <span>Manage restricted bulletin  board of the working group</span></a>

        </li>
        </li>
          <li class="active <?=$this->uri->segment(2)=='document_expiry'? 'active':''; ?>"><a href="groupmanager/document_expiry/"> <span>Set Upload expiry Date</span></a>

        </li>
        <li class="active <?=$this->uri->segment(2)=='outreach'? 'active':''; ?>"><a href="outreach"> <span>Outreach</span></a>

        </li>
      



        <li><a href="login/logout/"><i class="fa fa-sign-in"></i> <span>Log Out</span></a></li>

    </ul>
       <?php }?>

<?php }?>      

<!--sidebar nav end-->

</div>
</div>