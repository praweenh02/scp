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
         $verifyemail = $_GET['verifyemail'];
        if(isset($verifyemail))
        {?>
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
                   Your OTP has been sent to your registered email.
                 </div>
            
                  <form class="form-style-9" autocomplete="off"   method="post" id="form-otp" name="form-otp" enctype="multipart/form-data" action="<?=base_url();?>home/verify_email" >
                      <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                            'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                  <input type="hidden" id="verified_email" name="verified_email" value="<?=base64_decode($verifyemail);?>">
                   <ul>
                       <li>
                           <div class="row">
                             <div class="col-md-12">
                                <input type="tel" required id="otp" name="otp"  class="field-style field-split align-left" placeholder="Enter OTP *" />
                                <br>
                                <a href="<?=base_url();?>home/resendotp/<?=$verifyemail;?>/"><span class="text-success">Resend</span></a>
                            </div>
                        </div>
                     </li>
                        <li>
                          <button type="submit"   value="SIGN UP">SUBMIT</button> 
                     </li>
                   </ul>
                </form>
            </div>   

 <?php  }else{
        ?>
                <div class="col-md-12" id="form1">
           
           <form class="form-style-9 " method="post" id="form-signup" name="form-signup" enctype="multipart/form-data" novalidate >
               <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                            'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
             <ul>
                 <li>
                      <div class="row">
                           <div class="col-md-6"> 
                               <select  id="group_category" name="group_category_id" required="" class="field-style  field-split align-left category"  placeholder="Select Working Group">
                                     <option value="" selected>----Select SDO----</option>
                                    <?php 
                                    foreach($group_category as $cat_data):
                                      ?>
                                       <option value="<?=$cat_data->category_id;?>"><?=$cat_data->category_name;?></option>

                         
                                   <?php endforeach;?>
                               </select>
                            </div> 
                                <div class="col-md-6">   
                                    <select    required="" id="group_id" name="group_id" class="field-style  field-split align-right" style="float:right;" placeholder="Select Working Group">
                                        <option value="" selected disabled>---- First Select SDO----</option>
                                      
                                 </select>
                             </div>
                         </div> 
                  </li>
                  <li>
                    <div class="row">
                        <div class="col-md-6">

                         <input type="text" required name="name" class="field-style field-split align-left" placeholder="Name *" />
                            
                        </div>
                        <div class="col-md-6">

                            <input type="text" required  name="surname" class="field-style field-split align-right" placeholder="Surname *" />
                        </div>
                    </div>
                  </li>
                 <li>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="organization" class="field-style field-split align-left" placeholder="Organization" />
                        </div>
                        <div class="col-md-6">
                          <input type="text" name="designation" class="field-style field-split align-right" placeholder="Designation" />
                      </div>
                  </div>
                   </li>
                   
                  <li><h6>Contact Details</h6></li>
                   <li>
                    <div class="row">
                    <div class="col-md-6">
                        <input type="tel" required name="contact_no" maxlength="10" class="field-style field-split align-left numbers" placeholder="Contact No. *" />
                  </div>
                    <div class="col-md-6">
                      <input type="email" required name="email" class="field-style field-split align-right" placeholder="Email *" />
                  </div>
              </div>
                  </li>
                     <li>
                        <div class="row">
                           <div class="col-md-6">
                              <input type="tel" maxlenth="12"  name="landline" id="landline" maxlength="12" class="field-style field-split align-left numbers" placeholder="Landline" />
                          </div>
                           <div class="col-md-6">
                             <input name="address" required class="field-style field-split align-right" placeholder="Address*">
                          </div>
                       </div>
                   </li>
                   <li>

                         <div class="row">
                           <div class="col-md-6">
                                 <input type="text" required name="city" class="field-style field-split align-right" placeholder="City *" />
                            </div>  
                             <div class="col-md-6">   
                              
                               <?php
                               $query = $this->db->select('*')->order_by('id','DESC')->get('states');
                               ?>
                               <select  id="state" name="state" required="" class="field-style  field-split align-left"  placeholder="Select Working Group">
                                     <option value="" selected>----Select State----</option>
                                    <?php 
                                    foreach($query->result() as $state_value):
                                      ?>
                                       <option value="<?=$state_value->name;?>"><?=$state_value->name;?></option>

                         
                                   <?php endforeach;?>
                               </select>
                        </div>
                    </div>
                  </li>
                      <li>
                           <div class="row">
                             <div class="col-md-6">
                                <input type="number" maxlength="6"  required name="pincode" class="field-style field-split align-left numbers" placeholder="Pin Code *" />
                            </div>
                            
                        </div>
                  </li>
                  <li>
                    <div class="row">
                          <div class="col-md-6 offset-md-4">
                                <p id="captImg"><?php echo $captchaImg; ?></p>
<p>Can't read the image? click <a href="javascript:void(0);" class="refreshCaptcha">here</a> to refresh.</p>
<input type="text" class="field-style field-split align-left col-sm-5" required placeholder="Enter the code" name="captcha" value=""/>
                            
                           
                           </div>
                           </div>
                    </li>   
                    <li>    
                         
                             <button type="button"  onclick="save_data();" class="btn-submit" value="SIGN UP">SIGN UP</button> 
                
                  </li>


                
                    <li>
                         
                     </li>
              </ul>
          </form>
          
        </div>  
       <?php } ?>
    
        
    </div>
  </div>
  <script type="text/javascript" src="<?=base_url();?>ajax/signup.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/front/css/form.css">
<script>
$(document).ready(function(){
    $('.refreshCaptcha').on('click', function(){
        $.get('<?php echo base_url().'home/refresh'; ?>', function(data){
            $('#captImg').html(data);
        });
    });
});

$("input.numbers").keypress(function(event) {
  return /\d/.test(String.fromCharCode(event.keyCode));
});
</script>

