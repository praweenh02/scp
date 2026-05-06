<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?=base_url();?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link href="assets/front/images/icon.png" rel="shortcut icon" type="image/png">
<title>Login|Standard Co-ordination Portal</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script> 
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-body">

<div class="container">

    <form class="form-signin" id="login-form" name="login-form" action="<?=base_url();?>login/logindone" method="post" enctype="multiple/form-data" >

             <?php  $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash());
        ?>

         <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
        <div class="form-signin-heading text-center">
            <h1 class="sign-title">Sign In</h1>
            <img src="assets/images/icon.png" width="150" alt=""/>
            <!--Notification-->
                    <?php if($this->session->flashdata('error')){?>
                     <div class="alert  alert-danger"  >
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <?php echo $this->session->flashdata('error')?>
                              
                     </div>
                     <?php }?>

                    <div class="alert  alert-success fade in" id="success" style="display:none;" >
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                              
                   </div>
                
        </div>
        <div class="login-wrap">
            <input type="text" class="form-control" required name="email" id="email" placeholder="Email" autofocus>
            <input type="password" id="password" required  name="password" class="form-control" placeholder="Password">
<p id="captImg"><?php echo $captchaImg; ?></p>
<p>Can't read the image? click <a href="javascript:void(0);" class="refreshCaptcha">here</a> to refresh.</p>
<input type="text" class="form-control" required placeholder="Enter the code" name="captcha" value=""/>

            <button class="btn btn-lg btn-login btn-block" type="submit">
              Sign In 
            </button>

            <div class="registration">
                <a data-toggle="modal" href="#myModal"> Forgot Password?</a>
            </div>
           

        </div>
        </form>
           
        <!-- Modal -->
       <!-- Modal -->
           <form  id="form_reset_pwd" name="form_reset_pwd" method="post" enctype="multiple/form-data" action="" >
                  <?php  $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash());
        ?>

         <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
         <input type="hidden" name="post_date" id="post_date" value="<?=date('Y-m-d');?>">
        <div  aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <!--<h4 class="modal-title">Forgot Password ?</h4>-->
                    </div>
                    <div class="modal-body">
                    <div class="row">
                          <div class="col-sm-12">
                            <p>Enter your e-mail address below to reset your password.</p>
                           <input type="email" name="f_email" id="f_email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
                           </div>
                        </div>
                        <br>
                        <div class="row">
                           <div class="col-sm-12">
                               <p id="captImg1"><?php echo $captchaImg; ?></p>
                               <p>Can't read the image? click <a href="javascript:void(0);" class="refreshCaptcha1">here</a> to refresh.</p>
                               <input type="text" class="form-control" required placeholder="Enter the code" name="captcha" value="" />
                               
                           </div>  
        

                        </div>
                        
                        

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="error_result"  class="error"></div>
                         </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                        <button class="btn btn-primary btn-submit forgot_password" type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->

    </form>
        <!-- modal -->

    </form>

</div>



<!-- Placed js at the end of the document so the pages load faster -->

<!-- Placed js at the end of the document so the pages load faster -->
<script src="assets/js/jquery-1.10.2.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/modernizr.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url('ajax/remote.js'); ?>"></script>
<script src="assets/plugins/toast/jquery.toast.js"></script>
<script src="ajax/userlogin.js"></script>

</body>
</html>
<style>
    .error
    {
        color:red;
    }
    .green
    {
        color:green;
    }
</style>
<script>
$(document).ready(function(){
    $('.refreshCaptcha').on('click', function(){
        $.get('<?php echo base_url().'login/refresh'; ?>', function(data){
            $('#captImg').html(data);
        });
    });
});
$(document).ready(function(){
    $('.refreshCaptcha1').on('click', function(){
        $.get('<?php echo base_url().'login/refresh'; ?>', function(data){
            $('#captImg1').html(data);
        });
    });
});
</script>

