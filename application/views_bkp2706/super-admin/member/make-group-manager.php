<?php error_reporting(0)?>

 <div class="page-heading">
            <h3>
            View details
            </h3>
            <hr>
                   </div>
                  
 <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
        <header class="panel-heading">
           
           <header class="panel-heading">
              <?=$result->name;?>  <?=$result->surname;?>'s Details
            
        
            <span class="mb-5 pull-right" style="margin-top: -4px;">
                <a onClick="window.history.back(-1);" class="btn btn-danger btn-sm" >
                    <i class="fa fa-arrow-left"></i> Back
                </a>
             </span>
        </header>
        <div class="panel-body">
           <div class="tab-content">
               <div class="tab-pane active " id="home-2">
                <form method="post" class="cmxform form-horizontal adminex-form" enctype="multipart/form-data" id="form-member2" name="form-member2" novalidate> 
                     <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                             'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" id="csrf_token_name" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                             <input type="hidden" name="member_id" id="member_id" value="<?=$result->user_id;?>">
                   <div class="col-md-12">
                       
                       <div class="form-group row">
                          <label for="cname" class="control-label col-lg-3">Select SDO -</label>
                            <div class="col-lg-9">
                             <select  id="sdo_id" name="sdo_id" required="" class="form-control sdo"  placeholder="Select Working Group">
                                     <option value="" selected>----Select SDO----</option>
                                    <?php 
                                    foreach($group_category as $cat_data):
                                      ?>
                                       <option value="<?=$cat_data->category_id;?>"><?=$cat_data->category_name;?></option>

                         
                                   <?php endforeach;?>
                               </select>
                            </div>
                       </div> 
                       <div class="form-group row">
                         <label for="cname" class="control-label col-lg-3">Select Working Groups -</label>
                            <div class="col-lg-9">
                                     <select    required="" id="group_id" name="group_id" class="form-control" style="float:right;" placeholder="Select Working SDO">
                                        <option value="" selected disabled>---- First Select SDO----</option>
                                      
                                   </select>
                            </div>
                       </div>
                       




                        <div class="form-group row mt-5">

                       <div class="pull-right">
                            <button class="btn btn-danger btn-sm"  onclick="window.history.back(-1);" type="button"> <i class="fa fa-arrow-left"></i> Back</button>
                            <button class="btn btn-success btn-sm" onclick="make_group_manager();" type="button">Save changes</button>
                       </div>
                   </div>   
                    </div>
                </form>    
                </div>


               </div> 
            </div>     
    
       
      </section>
        </div>
        </div>
      </div>
  </section>

 

      <div id="popupdiv"></div>

<script src="ajax/member.js"></script>
<script type="text/javascript">
    $('input[name="contact_no"]').keyup(function(e)
                                {
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});
</script>


                          



    
