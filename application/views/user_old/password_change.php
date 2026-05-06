 <div class="page-heading">
            <h3>
                Change Password
            </h3>
                   </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
            
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Change Password
                            <span class="text-success pull-right">Last updated - <?php 
                           
                           echo date("d-m-Y h:i", strtotime($profile->updated_at));?></span>
                        </header>
                        <div class="panel-body">
                            <div class=" form">
                                <form class="cmxform form-horizontal adminex-form" id="form-changepassword" name="form-changepassword" method="post" enctype="multiple/form-data">
                                	        <?php  $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash());
        ?>

         <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                                	 <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">Old Password (required)</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="current_password" name="current_password"  type="password" minlength="6" required />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">New Password (required)</label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" id="new_password" name="new_password" minlength="6" type="Password" required />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="cemail" class="control-label col-lg-2">Confirm Password (required)</label>
                                        <div class="col-lg-10">
                                            <input class="form-control " id="confirm_password" type="Password" name="confirm_password" required />
                                        </div>
                                    </div>
                                   
                                   
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button onclick="Change_password();" class="btn btn-success pull-right ml-3" type="button">Submit</button>
                                            <button onclick="history.back(-1);" class="btn btn-default" type="button">Back</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
         
        </div>
    </div>
    <script src="ajax/userpassword-change.js"></script>
