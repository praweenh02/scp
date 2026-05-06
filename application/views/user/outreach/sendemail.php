 <div class="page-heading">
            <h3>
            Send Email
            </h3>
            <hr>
                   </div>
            
<div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel card">
        <header class="panel-heading">
              Send Details
         
        </header>
        <div class="panel-body">
        <div class="adv-table">
        <form id="send-email" name="send-email" enctype="multipart/form-data">
                   <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                             'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" id="csrf_token_name" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                             <input type="hidden" name="group_id" id="group_id"  value="<?=$group_id;?>">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                                <label for="exampleInputEmail1" class="control-label col-lg-3"><strong>Email Subject *</strong></label>
                                <div class="col-lg-9">
                                      <input type="text" name="email_subject" id="email_subject" class="form-control" required>
                                    
                                </div>
                             
                            </div>
                              <div class="form-group row">
                                <label for="exampleInputEmail1" class="control-label col-lg-3"><strong>Select Type *</strong></label>
                                <div class="col-lg-9">
                                         <div class="col-sm-9 icheck minimal">
                                            <div class="checkbox single-row">
                                                  <input type="checkbox" name="member_type" value="group_member"  >
                                                  <label>Group Member</label>
                                               </div>
                                            </div>
                                             <div class="col-sm-9 icheck minimal">
                                            <div class="checkbox single-row">
                                                  <input type="checkbox" name="member_type" value="website_subscriber"  >
                                                  <label>Subscriber</label>
                                               </div>
                                            </div>
                                    
                                      
                                    
                                </div>
                             
                            </div>
                            <div class="form-group row">
                                  <label for="exampleInputEmail1" class="control-label col-lg-3"><strong>Email Message *</strong></label>
                               <div class="col-lg-9">
                                 <textarea class="form-control ckeditor" name="email_message" name="email_message"></textarea>
                             </div>
                          </div>
                          <hr>
                          <div class="form-group">
                                                   <div class="pull-right">
                                                       <button class="btn btn-danger btn-sm" onclick="window.history.back(-1);" type="button"> <i class="fa fa-arrow-left"></i>  Back</button>
                                                       <button class="btn btn-success btn-sm btn-submit" onclick="send_email();" type="button">Send Email</button>
                                                   </div>
                   
                                               </div>
            </div>
        </form>
        
        </div>
        </div>
      </section>
        </div>
        </div>
      </div>
      

      <div id="popupdiv"></div>

<script src="ajax/email-subscription.js"></script>
<style type="text/css">
  .error
  {
    color: red;
    font-weight: 500;
    
  }  
</style>


                          



    
