 
    <script src="https://www.google.com/recaptcha/api.js" async defer></script> 
  <div class="page-banner" style="background-image:url('assets/front/images/page-banner.png');">
    <div class="container">
        <div class="row">
            <div class="latest_videos">
                
                    <h2>Success</h2>
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
            
                  <form class="form-style-9" autocomplete="off"   method="post" id="form-otp" name="form-otp" enctype="multipart/form-data" novalidate >
                     
                   <ul>
                       <li>
                           <div class="row">
                               <?php
                               error_reporting(0);
                                 if($success_type=='otp')
                                 {
                                     
                                
                                 ?>
                                  <div class="col-md-12">
                             <p>Email list subscribed successfully.</p>
                            </div>
                                     
                                <?php  }else{?>
                                      <div class="col-md-12">
                             <p><p>Your request for account on the Standards Coordination Portal has been submitted to your NWG Group Admin. You will receive an e-mail / message when the request is approved/rejected.<p>
<p>If you require any further assistance, please contact your focal point at <strong>dircb2.tec-dot@gov.in</strong> .</p>
                            </div>
                                    
                                    
                                <?php }
                               ?>
                            
                        </div>
                     </li>
                       
                   </ul>
                </form>
            </div>   


    
        
    </div>
  </div>
  <script type="text/javascript" src="<?=base_url();?>ajax/signup.js"></script>
<link rel="stylesheet" type="text/css" href="assets/front/css/form.css">

