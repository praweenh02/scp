
  <div class="page-banner" style="background-image:url('assets/front/images/page-banner.png');">
    <div class="container">
        <div class="row">
            <div class="latest_videos">
                
                    <h2>Verify OTP </h2>
            </div>
        
            
        </div>
        
    </div>
  
  </div>
  <div class="container">

    <div class="row">
    
       
            <div class="col-md-9 col-lg-9 offset-lg-1 col-sm-12">
                <br>
                <!--<div class="alert alert-success" role="alert">
                   Your OTP is send your register email.
                 </div>-->
            
                  <form class="form-style-9" autocomplete="off"   method="post" id="form-subotps" name="form-subotps" enctype="multipart/form-data" novalidate >
                     
                   <ul>
                       <li>
                           <div class="row">
                             <div class="col-md-12">
                                         <div class="col-md-9 col-lg-9 offset-lg-2 col-sm-12">
                <br>
                                          <?php if($this->session->flashdata('success')){?>
          <div class="alert alert-success alert-dismissible ">  
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>    
            <?php echo $this->session->flashdata('success')?>
          </div>
        <?php } unset($_SESSION['success']);?>
     <?php if($this->session->flashdata('error')){?>
      <!--<div class="alert alert-danger   alert-dismissible ">   
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>   
        <?php echo $this->session->flashdata('error')?>
      </div>-->
    <?php }
   unset($_SESSION['error']);
     $verifyemail = $result->user_email;
     $group_id = $result->group_id;
     ?>
                <div class="alert alert-success" role="alert">
                   Your OTP has been sent to your registered email.
                 </div>
            
             
                      <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                            'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                  <input type="hidden" id="verified_email" requ name="verified_email" value="<?=$verifyemail;?>">
                  <input type="hidden" id="group_id" name="group_id" value="<?=$group_id;?>">
                   <ul>
                       <li>
                           <div class="row">
                             <div class="col-md-12">
                                <input type="tel" required id="otp" name="otp" class="field-style field-split align-left" placeholder="Enter OTP *" />
                                <br>
                                <a href="<?=base_url();?>home/subresendotp/<?=$verifyemail;?>/"><span class="text-success">Resend</span></a>
                            </div>
                        </div>
                     </li>
                        <li>
                          <button type="button"  onclick="subverify_email();" value="SIGN UP">SUBMIT</button> 
                     </li>
                   </ul>
                
            </div>   
                            </div>
                        </div>
                     </li>
                       
                   </ul>
                </form>
            </div>   


    
        
    </div>
  </div>
  <script type="text/javascript" src="<?=base_url();?>ajax/otp.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/front/css/form.css">

