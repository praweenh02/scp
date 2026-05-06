 <?php //error_reporting(0); ?>
 <div class="page-heading">
            <h3>
                Profile
            </h3>
           
        </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
            
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel" id="updprofile">
                        <header class="panel-heading">
                           Profile 
                        </header>
                        <div class="panel-body">
                            <div class=" form">
                                <form class="cmxform form-horizontal adminex-form" id="form-profile" name="form-profile" method="post" autocomplete="off" enctype="multiple/form-data">
                                            <?php  $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash());
        ?>

         <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                             <?php if($this->session->userdata('user_type')=='member'){
                                 ?>
                             
                                   <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">SDO</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="name" name="name"  type="text" value="<?=$profile->category_name;?>" disabled  required />
                                        </div>
                                    </div>
                                        <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">Working Group</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="name" name="name"  type="text" value="<?=$profile->group_title;?>" disabled  required />
                                        </div>
                                    </div>
                            <?php }?>     
                                         <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">User Type (required)</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="user_type" name="user_type"  type="text" value="<?=$profile->user_type=='group_manager'? 'Group Manager':'Member';?>" disabled  required />
                                        </div>
                                    </div>
                                     <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">Name (required)</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="name" name="name"  type="text" value="<?=$profile->name;?>"  required />
                                        </div>
                                    </div>
                                      <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">Surname (required)</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="surname" name="surname"  type="text" value="<?=$profile->surname;?>"  required />
                                        </div>
                                    </div>
                                   
                                   
                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">Contact No. (required)</label>
                                        <div class="col-lg-10">
                                            <input class=" form-control"  id="contact_no" name="contact_no" minlength="10" type="tel" value="<?=$profile->contact_no;?>" required />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="cemail" class="control-label col-lg-2">Email (required)</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" disabled id="email" type="email" name="email" required value="<?=$profile->email;?>" />
                                            <label><input type="checkbox" value="Yes" name="email_subscription" <?=$profile->email_subscription=='Yes'? 'checked':''?>>Email Subscription</label>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="cemail" class="control-label col-lg-2">Landline</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="landline" type="tel" name="landline" required value="<?=$profile->landline;?>" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                              <label for="cemail" class="control-label col-lg-2">Address (required)</label>
                                         <div class="col-lg-10">
                                              <input class="form-control " id="address" type="text" name="address" required value="<?=$profile->address;?>" />
                                           
                                      </div>
                                   </div>
                                    <div class="form-group">
                                              <label for="cemail" class="control-label col-lg-2">City (required)</label>
                                         <div class="col-lg-10">
                                              <input class="form-control " id="city" type="text" name="city" required value="<?=$profile->city;?>" />
                                           
                                      </div>
                                   </div>
                                   <div class="form-group">
                                              <label for="cemail" class="control-label col-lg-2">State (required)</label>
                                         <div class="col-lg-10">
                                              <input class="form-control " id="state" type="text" name="state" required value="<?=$profile->state;?>" />
                                           
                                      </div>
                                   </div>
                                    <div class="form-group">
                                              <label for="cemail" class="control-label col-lg-2">Pin Code (required)</label>
                                         <div class="col-lg-10">
                                              <input class="form-control" maxlength="6" id="pincode" type="tel" name="pincode" required value="<?=$profile->pincode;?>" />
                                           
                                      </div>
                                   </div>
                                   
                                   
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button onclick="Change_profile();" class="btn btn-success pull-right ml-3" type="button">Submit</button>
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
    <script src="ajax/userprofile.js"></script>