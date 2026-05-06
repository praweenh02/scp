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
                           Profile <span class="text-success pull-right">Last updated - <?php 
                           
                           echo date("d-m-Y h:i", strtotime($profile->updated_at));?></span>
                        </header>
                        <div class="panel-body">
                            <div class=" form">
                                <form class="cmxform form-horizontal adminex-form" id="form-profile" name="form-profile" method="post" enctype="multiple/form-data">
                                	        <?php  $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash());
        ?>

         <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                                	 <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">Name (required)</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="name" name="name"  type="text" value="<?=$profile->name;?>"  required />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">Mobile No. (required)</label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" id="mobile_no" name="mobile_no" minlength="10" type="tel" value="<?=$profile->mobile_no;?>" required />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="cemail" class="control-label col-lg-2">Email (required)</label>
                                        <div class="col-lg-10">
                                            <input class="form-control " id="email" type="email" name="email" required value="<?=$profile->email;?>" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="cemail" class="control-label col-lg-2">Username (required)</label>
                                        <div class="col-lg-10">
                                            <input class="form-control " id="username" type="text" name="username" required value="<?=$profile->username;?>" />
                                        </div>
                                    </div>
                                    <!--<div class="form-group">
                                              <label for="cemail" class="control-label col-lg-2">Username (required)</label>
                                         <div class="col-lg-10">
                                           <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                            <div>
                                                   <span class="btn btn-default btn-file">
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                   <input type="file" class="default" />
                                                   </span>
                                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                            </div>
                                         </div>
                                      </div>
                                   </div>-->
                                   
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
    <script src="ajax/profile.js"></script>