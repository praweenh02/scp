<script type="text/javascript" src="<?=base_url();?>assets/front/js/jquery.bootstrap.newsbox.js"></script>
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="assets/front/tricker/css/style.css">
<link href="assets/js/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="assets/front/css/form.css">
<style type="text/css">
    .news-item {
        padding: 4px 4px;
        margin: 0px;
        border-bottom: 1px dotted #555;
        width: auto;
    }

    .card-footer {
        display: none;
    }

    .fc-grid th {
        height: 45px;
        line-height: 45px;
        text-align: center;
        background: #006C9B !important;
        color: #fff;
        text-transform: uppercase;
    }

    .fc-state-active, .fc-state-active .fc-button-inner, .fc-state-active, .fc-button-today .fc-button-inner, .fc-state-hover, .fc-state-hover .fc-button-inner, .fc-button-content {
        background: #006C9B !important;
        color: #fff !important;
        text-transform: capitalize;
    }

    .fc-state-default, .fc-state-default .fc-button-inner {
        background: #fff !important;
        color: #646464;
    }

    .fc-event-skin {
        background: linear-gradient( 90deg, rgba(6, 127, 159, 1) 24%, rgb(8 90 192) 61%, rgba(0, 212, 255, 1) 100% ) !important;
        border-color: #5d708c !important;
        color: #FFFFFF !important;
    }

    .calendar1 {
        padding-top: 62px;
        /*overflow: auto;*/ 
        max-height: 500px;
        padding: 5px;
    }
    .twiter {
        padding-top: 42px;
        overflow: auto; 
        max-height: 687px;
        padding: 5px;
    }


    .faq-section {
        background: #fdfdfd;
        height: auto;/*padding: 10vh 0 0;*/
    }

    .evc-title h2 {
        position: relative;
        margin-bottom: 45px;
        display: inline-block;
        font-weight: 600;
        line-height: 1;
    }

    .evc-title h2::before {
        content: "";
        position: absolute;
        left: 50%;
        width: 100%;
        height: 2px;
        background: #E91E63;
        bottom: -18px;
        margin-left: -107px;
    }
    .evc-title2 h2 {
        position: relative;
        margin-bottom: 45px;
        display: inline-block;
        font-weight: 600;
        line-height: 1;
    }

    .evc-title2 h2::before {
        content: "";
        position: absolute;
        left: 62%;
        width: 100%;
        height: 2px;
        background: #E91E63;
        bottom: -18px;
        margin-left: -107px;
    }

    .faq-title h2 {
        position: relative;
        margin-bottom: 45px;
        display: inline-block;
        font-weight: 600;
        line-height: 1;
    }

    .faq-title h2::before {
        content: "";
        position: absolute;
        left: 50%;
        width: 60px;
        height: 2px;
        background: #E91E63;
        bottom: -25px;
        margin-left: -30px;
    }
    .evc-tiwiter h2::before {
    content: "";
    position: absolute;
    left: 62%;
    width: 100%;
    height: 2px;
    background: #E91E63;
    bottom: -18px;
    margin-left: -107px;
  }
  .email_subcription h2 {
        position: relative;
        margin-bottom: 45px;
        display: inline-block;
        font-weight: 600;
        line-height: 1;
    }
.email_subcription h2::before {
    content: "";
    position: absolute;
    left: 13%;
    width: 428px;
    height: 2px;
    background: #E91E63;
    bottom: -25px;
    margin-left: -55px;
}

    .faq-title p {
        padding: 0 190px;
        margin-bottom: 10px;
    }

    .faq {
        background: #FFFFFF;
        box-shadow: 0 2px 48px 0 rgba(0, 0, 0, 0.06);
        border-radius: 4px;
    }

    .faq .card {
        border: none;
        background: none;
        border-bottom: 1px dashed #CEE1F8;
    }

    .faq .card .card-header {
        padding: 0px;
        border: none;
        background: none;
        -webkit-transition: all 0.3s ease 0s;
        -moz-transition: all 0.3s ease 0s;
        -o-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
    }

    .faq .card .card-header:hover {
        background: rgba(233, 30, 99, 0.1);
        padding-left: 10px;
    }

    .faq .card .card-header .faq-title {
        width: 100%;
        text-align: left;

        padding: 0px;
        padding-left: 30px;
        padding-right: 30px;
        font-weight: 400;
        font-size: 15px;
        letter-spacing: 1px;
        color: #3B566E;
        text-decoration: none !important;
        -webkit-transition: all 0.3s ease 0s;
        -moz-transition: all 0.3s ease 0s;
        -o-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
        cursor: pointer;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .faq .card .card-header .faq-title .badge {
        display: inline-block;
        width: 20px;
        height: 20px;
        line-height: 14px;
        float: left;
        -webkit-border-radius: 100px;
        -moz-border-radius: 100px;
        border-radius: 100px;
        text-align: center;
        background: #006C9B;
        color: #fff;
        font-size: 12px;
        margin-right: 20px;
    }

    .faq .card .card-body {
        padding: 30px;
        padding-left: 35px;
        padding-bottom: 16px;
        font-weight: 400;
        font-size: 16px;
        color: #6F8BA4;
        line-height: 28px;
        letter-spacing: 1px;
        border-top: 1px solid #F3F8FF;
    }

    .faq .card .card-body p {
        margin-bottom: 14px;
    }

    @media (max-width: 991px) {

        .faq {
            margin-bottom: 30px;
        }

        .faq .card .card-header .faq-title {
            line-height: 26px;
            margin-top: 10px;
        }
    }
/* width */
::-webkit-scrollbar {
  width: 5px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
.field-style {
    box-sizing: border-box;
    width:100%;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    padding: 8px;
    outline: none;
    border: 1px solid #B0CFE0;
    -webkit-transition: all 0.30s ease-in-out;
    -moz-transition: all 0.30s ease-in-out;
    -ms-transition: all 0.30s ease-in-out;
    -o-transition: all 0.30s ease-in-out;
}
.form-style-button {
    -moz-box-shadow: inset 0px 1px 0px 0px #3985B1;
    -webkit-box-shadow: inset 0px 1px 0px 0px #3985b1;
    box-shadow: inset 0px 1px 0px 0px #3985b1;
    background-color: #216288;
    border: 1px solid #17445E;
    display: inline-block;
    cursor: pointer;
    color: #FFFFFF;
    padding: 8px 18px;
    text-decoration: none;
    font: 12px Arial, Helvetica, sans-serif;
    float:right;
    text-align:center;
}
a{
    color:red;
}
.my-news-ticker a
{
    color:white;
}
</style>

<div class="service-slider">
    <div id="myCarousel" class="carousel slide" data-ride="carousel"> 

        <!-- The slideshow -->
        <div class="carousel-inner">
           
            <div class="item carousel-item"> <img src="assets/front/images/banner/banner5.jpeg" class="img-responsive" alt="" width="100%" height="60%"> </div>
             <div class="item carousel-item"> <img src="assets/front/images/banner/web3.jpg" class="img-responsive" alt="" width="100%" height="60%"> </div>
            <div class="assets/front/item carousel-item"> <img src="assets/front/images/banner/web1.jpg" class="img-responsive" width="100%" height="60%" alt=""> </div>
            <div class="item carousel-item  active"> <img src="assets/front/images/banner/web2.jpg" class="img-responsive" alt="" width="100%" height="60%"> </div>
           

        </div>

        <!-- Left and right controls --> 
        <a class="carousel-control-prev" href="#myCarousel" data-slide="prev"> <span class="carousel-control-prev-icon"></span> </a> <a class="carousel-control-next" href="#myCarousel" data-slide="next"> <span class="carousel-control-next-icon"></span> </a> </div>
    </div>
</div>

<!--Top Content-->

<div class="top_content" id="skipmaincontent">
    <div class="col-md-12">
        <div class="acme-news-ticker">
            <div class="acme-news-ticker-label">Bulletin Board</div>
            <div class="acme-news-ticker-box">
                <ul class="my-news-ticker">
                    <?php 
                    foreach($sdobulletin_list as $bulletin_result):
                        ?>
                        <li>
                            <li><a href="#">
                                <?=$bulletin_result->bulletin_title;?>
                            </a></li>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
<div class="clearfix"></div>

<!--Event & Important Links-->

<div class="mt-20 mb-5" >
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="event_container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card panel-default">
                                <div class="card-header" style="background:linear-gradient( 90deg, rgba(6, 127, 159, 1) 24%, rgb(8 90 192) 61%, rgba(0, 212, 255, 1) 100% ); color:#fff;">
                                    <h2>What's New</h2>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10  col-sm-12">
                                            <ul class="demo12">
                                                <?php
                                                foreach($whatsnew_lsit as $whtn_result)
                                                    {?>

                                                        <li class="news-item ">
                                                            <?php
                                                            if($whtn_result->whatsnew_file)
                                                                {?>
                                                                    <a target="_blank" href="uploads/whats-new/<?=$whtn_result->whatsnew_file;?>" style="color: black !important; font-weight: 400;" ><?=$whtn_result->whatsnew_title;?></a>
                                                                <?php }else{
                                                                    echo $whtn_result->whatsnew_title;
                                                                }?>
                                                                <img src="assets/images/new_blink_gif.gif" width="45">
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- <div class="col-md-6">
                    <div class="event_container">
                        <h2><i class="fa fa-angle-right ic" aria-hidden="true"></i> Latest Meeting<br /></h2>
                        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item carousel-item active">
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-md-2 col-2"><img src="assets/front/images/1.png" class="img-fluid" width="100%" /></div>
                                            <div class="col-md-10 col-10">
                                                <p><a href="#">Release of Offer Letter for CHO January 2020 Session (April 20-Sep20)</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-md-2 col-2"><img src="assets/front/images/1.png" width="100%" /></div>
                                            <div class="col-md-10 col-10">
                                                <p><a href="#">Release of Offer Letter for CHO January 2020 Session (April 20-Sep20)</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-md-2 col-2"><img src="assets/front/images/1.png" width="100%" /></div>
                                            <div class="col-md-10 col-10">
                                                <p><a href="#">Release of Offer Letter for CHO January 2020 Session (April 20-Sep20)</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item carousel-item">
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-md-2 col-2"><img src="assets/front/images/1.png" width="100%" /></div>
                                            <div class="col-md-10 col-10">
                                                <p><a href="#">Release of Offer Letter for CHO January 2020 Session (April 20-Sep20)</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-md-2 col-2"><img src="assets/front/images/1.png" width="100%" /></div>
                                            <div class="col-md-10 col-10">
                                                <p><a href="#">Release of Offer Letter for CHO January 2020 Session (April 20-Sep20)</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-md-2 col-2"><img src="assets/front/images/1.png" width="100%" /></div>
                                            <div class="col-md-10 col-10">
                                                <p><a href="#">Release of Offer Letter for CHO January 2020 Session (April 20-Sep20)</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item carousel-item">
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-md-2 col-2"><img src="assets/front/images/1.png" width="100%" /></div>
                                            <div class="col-md-10 col-10">
                                                <p><a href="#">Release of Offer Letter for CHO January 2020 Session (April 20-Sep20)</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-md-2 col-2"><img src="assets/front/images/1.png" width="100%" /></div>
                                            <div class="col-md-10 col-10">
                                                <p><a href="#">Release of Offer Letter for CHO January 2020 Session (April 20-Sep20)</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-md-2 col-2"><img src="assets/front/images/1.png" width="100%" /></div>
                                            <div class="col-md-10 col-10">
                                                <p><a href="#">Release of Offer Letter for CHO January 2020 Session (April 20-Sep20)</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                           
                            <a class="carousel-control left carousel-control-prev" href="#myCarousel3" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="carousel-control right carousel-control-next" href="#myCarousel3" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>--> 

            </div>
        </div>
    </div>

    <!--About us-->


    <!--Other Links-->

    <div class="other_links mt-40 mb-5">
        <div class="container">
            <div class="row">

                <div class="col-md-8 col-sm-12 col-lg-8">
                    <div class="evc-title">
                        <h2>Event Calendar</h2>
                    </div>
                    <br>
                    
                    <div class="row  calendar1">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
                   <div class="col-md-4">
                       <div class="evc-title2">
               <h2 >Twitter Feed</h2>
               </div>
               <div class="twitter-box twiter">
                   <a class="twitter-timeline" href="https://twitter.com/DoT_India?ref_src=twsrc%5Etfw">Tweets by DoT_India</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
               </div>
               
           </div>
            </div>
        </div>
    </div>
    <div class="other_links mt-40 mb-5">
        <div class="container">
        <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
                    <section class="faq-section">
                        <div class="container">
                            <div class="row"> 
                                <!-- ***** FAQ Start ***** -->
                                <div class="col-md-6">
                                    <div class="faq-title">
                                        <h2>FAQ</h2>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="faq" id="accordion">
                                        <?php
                                        $i=1;
                                        foreach($faqs as $rfaq)
                                        {
                                            ?>
                                            <div class="card">
                                                <div class="card-header" id="faqHeading-1">
                                                    <div class="mb-0">
                                                        <h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-<?=$i;?>" data-aria-expanded="true" data-aria-controls="faqCollapse-<?=$i;?>"> <span class="badge">
                                                            <?=$i;?>
                                                        </span>
                                                        <?=$rfaq->faq_question;?>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div id="faqCollapse-<?=$i;?>" class="collapse" aria-labelledby="faqHeading-<?=$i;?>" data-parent="#accordion">
                                                <div class="card-body">
                                                    <p>
                                                        <?=$rfaq->faq_answer;?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $i++;}?>
                                    </div>
                                    <!--<button class="btn btn-primary algin-right right" style="float:right !important; margin: 10px;">View All</button>-->
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <div class="other_links mt-40 mb-5">
        <div class="container">
        <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
                    <section class="faq-section">
                        <div class="container">
                            <div class="row"> 
                                <!-- ***** FAQ Start ***** -->
                                <div class="col-md-6">
                                    <div class="email_subcription">
                                        <h2>Subscribe to our mailing lists</h2>
                                    </div>
                                </div>
                                       <div class="col-md-12" id="form1">
                                                 <?php if($this->session->flashdata('success')){?>
          <div class="alert alert-success alert-dismissible col-md-12 col-md-offset-2">  
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>    
            <?php echo $this->session->flashdata('success')?>
          </div>
          <script type="text/javascript">
             Swal.fire({
  position: 'top',
  icon: 'success',
  title: data_obj. <?php echo $this->session->flashdata('success')?>,
  showConfirmButton: false,
  timer: 2800
});
          </script>
        <?php } ?>
     <?php if($this->session->flashdata('error')){?>
      <div class="alert alert-danger  alert-dismissible col-md-12 col-md-offset-2">   
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>   
        <?php echo $this->session->flashdata('error')?>
      </div>
  <script type="text/javascript">
                           Swal.fire({
  position: 'top',
  icon: 'error',
  title: data_obj. <?php echo $this->session->flashdata('error')?>,
  showConfirmButton: false,
  timer: 2800
});
         </script>
    <?php }
     
     ?>
           
           <form class="form-style-9" method="post" id="email_subscription" name="email_subscription" enctype="multipart/form-data" action="home/sumitEmailSubscription" >
               <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                            'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                 
                      <div class="row">
                           <div class="col-md-6 form-group">
                                <!--<lable clas="control-lalabe">Select SDO</lable>--> 
                               <select  id="group_category" name="group_category_id" required="" class="field-style   field-split align-left category" required  placeholder="Select Working Group">
                                     <option value="" selected>----Select SDO----</option>
                                    <?php 
                                    foreach($sdo_list as $cat_data):
                                      ?>
                                       <option value="<?=$cat_data->category_id;?>"><?=$cat_data->category_name;?></option>

                         
                                   <?php endforeach;?>
                               </select>
                            </div> 
                                <div class="col-md-6 form-group">   
                                <!--<lable clas="control-lalabe">Select Working Group</lable>-->
                                    <select    required="" id="group_id" name="group_id" class="field-style   field-split align-right" style="float:right;" placeholder="Select Working Group">
                                        <option value="" selected disabled>---- First Select SDO----</option>
                                      
                                 </select>
                             </div>
                         </div> 
                         
                         <div class="row">
                           <div class="col-md-6 form-group">
                                <!--<lable clas="control-lalabe">Select SDO</lable>--> 
                               <input  id="first_name" name="first_name" required="" class="field-style   field-split align-left"  placeholder="Enter first name *">
                                    
                            </div> 
                                <div class="col-md-6 form-group">   
                                <!--<lable clas="control-lalabe">Select Working Group</lable>-->
                                 <input  id="last_name" name="last_name" required="" class="field-style field-split align-left"  placeholder="Enter last name *">
                             </div>
                         </div> 
                          <div class="row">
                           <div class="col-md-6 form-group">
                                <!--<lable clas="control-lalabe">Select SDO</lable>--> 
                               <input  id="organization" name="organization" required="" class="field-style   field-split align-left"  placeholder="Enter Organization *">
                                    
                            </div> 
                                <div class="col-md-6 form-group">   
                                <!--<lable clas="control-lalabe">Select Working Group</lable>-->
                                 <input  id="designation" name="designation" required="" class="field-style field-split align-left"  placeholder="Enter Designation *">
                             </div>
                         </div> 
                         <div class="row">
                           <div class="col-md-6 form-group">
                                <!--<lable clas="control-lalabe">Select SDO</lable>--> 
                               <input  id="email" required name="email" required="" class="field-style field-split align-left"  placeholder="Enter email *">
                                    
                            </div> 
                                <div class="col-md-6 form-group">   
                                <!--<lable clas="control-lalabe">Select Working Group</lable>-->
                                 <input  id="phone_no" type="number" required name="phone_no" maxlength="12" minlength="10" required="" class="field-style field-split align-left"  placeholder="Enter Phone No. *">
                             </div>
                         </div> 
                          <div class="row">
                          <div class="col-md-6 offset-md-4">
                                <p id="captImg"><?php echo $captchaImg; ?></p>
<p>Can't read the image? click <a href="javascript:void(0);" class="refreshCaptcha">here</a> to refresh.</p>
<input type="text" class="field-style field-split align-left col-sm-5" required placeholder="Enter the code" name="captcha" value=""/>
                            
                           
                           </div>
                           </div>
                          
                
                 
               
                            <div class="row">
                                <div class="col-md-12">
                              <input type="submit"  class="form-style-button"   name="submitbutton" value="Submit">
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

    <script src="assets/js/fullcalendar/fullcalendar.min.js"></script> 
    <script src="assets/js/external-dragging-calendar.js"></script> 
    <!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/new-calendar/js/jquery.min.js"></script>--> 
      <script type="text/javascript" src="<?=base_url();?>ajax/signup.js"></script>
    <script>
        var Script = function () {


    /* initialize the external events
    -----------------------------------------------------------------*/

    $('#external-events div.external-event').each(function() {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
            title: $.trim($(this).text()),// use the element's text as the event title
            group_name: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 999,
            revert: true,      // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
        });

    });


    /* initialize the calendar
    -----------------------------------------------------------------*/

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            
            right: 'month,basicWeek,basicDay'
        },
        //editable: true,
        //droppable: true, // this allows things to be dropped onto the calendar !!!
        drop: function(date, allDay) { // this function is called when something is dropped

            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject');

            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);

            // assign it the date that was reported
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;

            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                $(this).remove();
            }

        },
        events: '<?=base_url();?>home/load_event', //this should echo out JSON'

    });


}();
</script> 
<script type="text/javascript" src="assets/front/tricker/js/jquery.js"></script>
  <script type="text/javascript" src="<?=base_url();?>ajax/signup.js"></script>
<script type="text/javascript" src="assets/front/tricker/js/acmeticker.js"></script> 

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('.my-news-ticker').AcmeTicker({
            type:'typewriter',/*horizontal/horizontal/Marquee/type*/
            direction: 'right',/*up/down/left/right*/
            speed:50,/*true/false/number*/ /*For vertical/horizontal 600*//*For marquee 0.05*//*For typewriter 50*/
            controls: {
                prev: $('.acme-news-ticker-prev'),/*Can be used for horizontal/horizontal/typewriter*//*not work for marquee*/
                toggle: $('.acme-news-ticker-pause'),/*Can be used for horizontal/horizontal/typewriter*//*not work for marquee*/
                next: $('.acme-news-ticker-next')/*Can be used for horizontal/horizontal/marquee/typewriter*/
            }
        });
    })

</script> 
<script>
$(document).ready(function(){
    $('.refreshCaptcha').on('click', function(){
        $.get('<?php echo base_url().'home/refresh'; ?>', function(data){
            $('#captImg').html(data);
        });
    });
});
</script>
<script type="text/javascript">

    $(function () {
        $(".demo12").bootstrapNews({
            newsPerPage: 6,
            autoplay: true,
            pauseOnHover:true,
            direction: 'up',
            newsTickerInterval: 3000,
            onToDo: function () {
                //console.log(this);
            }
        });
    });

</script> 
