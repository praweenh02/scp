    <script src="https://www.google.com/recaptcha/api.js" async defer></script> 
  <div class="page-banner" style="background-image:url('assets/front/images/page-banner.png');">
    <div class="container">
        <div class="row">
            <div class="latest_videos">
                
                    <h2>Sign up</h2>
            </div>
        
            
        </div>
        
    </div>
  
  </div>
  <div class="container">

    <div class="row">
    
       <?php
       error_reporting(0);
       ?>
            <div class="col-md-6 col-lg-6 offset-lg-3 col-sm-12">
                <br>
                                          <?php if($this->session->flashdata('success')){?>
		  <div class="alert alert-success alert-dismissible ">  
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>    
		    <?php echo $this->session->flashdata('success')?>
		  </div>
		<?php } unset($_SESSION['success']);?>
     <?php if($this->session->flashdata('error')){?>
      <div class="alert alert-danger   alert-dismissible ">   
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>   
        <?php echo $this->session->flashdata('error')?>
      </div>
    <?php }
   unset($_SESSION['error'])
	 
	 ?>
                <div class="alert alert-success" role="alert">
                  Please reset your password.
                 </div>
            
                  <form class="form-style-9" autocomplete="off"   method="post" id="rest_password" name="rest_password" enctype="multipart/form-data" novalidate >
                      <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                            'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                  <input type="hidden" id="member_id" name="member_id" value="<?=$this->uri->segment('3');?>">
                  <input type="hidden" id="token" name="token" value="<?=$this->uri->segment('4');?>">
                  <input type="hidden" name="member_id" value="<?=$_GET['member_id'];?>">
                  
                   <ul>
                       <li>
                           <div class="row">
                             <div class="col-md-12">
                                <input type="password" required id="password" name="password" class="field-style field-split align-left" placeholder="Enter Password *" />
                                <br>
                                       <input type="password" required id="confirm_password" name="confirm_password" class="field-style field-split align-left" placeholder="Enter Confirm Password *" />
                                       <br>
                                         <span id='message'></span>
                     
                            </div>
                        </div>
                     </li>
                        <li>
                          <button type="button"  id="btn-pwd" value="SIGN UP">SUBMIT</button> 
                     </li>
                   </ul>
                </form>
            </div>   

       
    
        
    </div>
  </div>

  <script type="text/javascript" src="<?=base_url();?>ajax/userlogin.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/front/css/form.css">

