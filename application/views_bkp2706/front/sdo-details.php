<?php 
    $ci =& get_instance();
    $ci->load->model('Home_model');
    $group_id =base64_decode ($_GET['groupId']);
    $group_result = $ci->Home_model->getGroupsDetails($group_id);
    $corresponding_data = $ci->Home_model->getAllCorresponding($group_id);
    $management_team_data = $ci->Home_model->getAllManagementTeam($group_id);
    $meeting_list = $ci->Home_model->getAllMeeting($group_id);
    $groupinformatin_list = $ci->Home_model->getAllGroupInformation($group_id);
    $group_bulletin = $ci->Home_model->getGroupBulletion($group_id);
       
    ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script> 
    <script type="text/javascript" src="<?=base_url();?>assets/front/js/jquery.bootstrap.newsbox.js"></script>
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  <div class="page-banner" style="background-image:url('assets/front/images/page-banner.png');">
    <div class="container">
        <div class="row">
            <div class="latest_videos">
                
                    <h2><?=$sdo_data->category_name;?></h2>
                    <p class="sub-heading"><?=$group_result->group_title;?></p>
            </div>
        
            
        </div>
        
    </div>
  
  </div>
  <div class="container mt-40" id="skipmaincontent">

    <div class="row ">
       <div class="col-sm-12 col-lg-2 col-md-4">
        <h5 class="vertical-heading">Working Group</h5>
         
            <div class="vertical-menu">
            
                  <?php 
                   foreach($working_group_list as $wrk_data):
                   ?>
                     <a class="<?=$group_id==$wrk_data->group_id? 'active':'' ;?> " href="home/groups/<?=$wrk_data->category_id;?>/?groupId=<?=base64_encode($wrk_data->group_id);?>" ><?=$wrk_data->shortform;?></a>
                  <?php endforeach;?>
             </div>
           
       </div>
       <div class="col-sm-12 col-lg-10 col-md-12">
       
            
            <h3 class="header-title-about"><?=$group_result->group_title;?></h3>
            <h6 class="group_subheading"><?=$group_result->group_name;?></h6>
         
          
            <p><b>Study period : <?=$group_result->study_periord;?></b></p>
       
        
           <?php
           if($group_result->group_description)
           {
           ?>
           <p><?=$group_result->group_description;?></p>
           <?php }?>
         
                
                   <h5 class="header-title-inner-small">Corresponding <?=$sdo_data->category_name;?> Study Group: <?=$group_result->itu_website_study_group;?></h5>
                 
              
                  <ul class="bullet-list-stye">
                    <?php 
                    foreach($corresponding_data->result() as $crs_result): ?>
                        <li><a href="<?=$crs_result->corresponding_url;?>" target="_blank"><?=$crs_result->corresponding_title;?></a></li>



                      <?php endforeach;?>
                   
                  </ul>
              
               
                   <h5 class="header-title-inner-small">Management Group</h5>
                  
                  <table class="table table-striped table-bordered">
                    <?php 
                    foreach ($management_team_data->result() as $team_result):
                    ?>
                      <tr>
                        <td><?=$team_result->title;?></td>
                         <td><?=$team_result->description;?></td>
                      </tr>
                    <?php endforeach;?> 
                  </table>
                
               
         
       </div>
       
    </div>
    <div class="row">
      <div class="col-sm-12 col-lg-19 col-md-12 offset-lg-2">
            <h5 class="header-title-inner-small"><?=$group_result->shortform;?> Meetings</h5>
             <ul class="bullet-list-stye">
                    <?php 
                    foreach($meeting_list->result() as $meeting_result): 
                          $start_date = strtotime($meeting_result->meeting_date);
                                    $end_date =  strtotime($meeting_result->meeting_end_date);
                                    if($start_date !== $end_date)
                                    {
                                        ?>
                        <li class="mute-text"><?=$meeting_result->meeting_title;?>: <?=date('d-m-Y', strtotime($meeting_result->meeting_date));?> to <?=date('d-m-Y', strtotime($meeting_result->meeting_end_date));?></li>

                              <?php }else{ ?>
                                <li class="mute-text"><?=$meeting_result->meeting_title;?> - <?=date('d-m-Y', strtotime($meeting_result->meeting_date));?> </li>
                              
                              <?php }?>

                      <?php endforeach;?>
                   
                  </ul>
       </div>
    </div>

    <div class="row">
         <div class="col-sm-12 col-lg-10 col-md-9 offset-lg-2">

                   <h5 class="header-title-inner-small">Contributions</h5>
            <div class="table-responsive">      
              <table class="table   table-bordered" id="myTable">
                   <thead class="table-heading">
                      <tr>
                          <th>Contributions No.</th>
                          <th>Contributions date</th>
                          <th>ITU-T Meeting</th>
                          <th>Title</th>
                          <th>Question</th>
                          <th>Name of contributors</th>
                          
                      </tr>
                      </thead>
                      <?php
                      $query = $this->db->select('group_contributions.*, group_meeting.meeting_title,group_meeting.meeting_date,group_meeting.meeting_end_date,questions.question_no')->join('group_meeting','group_contributions.meeting_id=group_meeting.meeting_id','left')->join('questions','group_contributions.question_id=questions.question_id','left')->where('group_contributions.group_id',$group_id)->where('group_contributions.file_status','uploaded')->where('delete','Y')->order_by('group_contributions.contribution_id','DESC')->get('group_contributions')->result();
                      foreach($query as $c_rows)
                      {
                      
                      ?>
                      <tr>
                          <td><?php
                           if($this->session->userdata('user_id'))
                           {
                            
                           if($c_rows->file)
                           {
                          ?>
                          <a href="uploads/files/<?=$c_rows->file;?>"><?=$c_rows->unique_no;?></a>
                         <?php  }else{ ?>
                            <?=$c_rows->unique_no;?>

                         <?php } 
                           }else{?>
                            <a title="Please login and download." href="<?=base_url();?>login"><?=$c_rows->unique_no;?></a>
                               
                           <?php }
                         
                         ?>

                          </td>
                          <td><?=date('d-m-Y', strtotime($c_rows->file_uploaded_date));?></td>
                          <td><?=$c_rows->meeting_title;?><br>
                            <?php
                              $stdate =  date('d-m-Y', strtotime($c_rows->meeting_date));
                            if($stdate=='01-01-1970')
                            {
                                
                            }else{
                             
                                echo  date('d-m-Y', strtotime($c_rows->meeting_date));
                               }?>
                               <?php
                              if(!empty($c_rows->meeting_date))
                              {
                               echo 'To';  
                                }?>
                               <?php
                               $enddate = date('d-m-Y', strtotime($c_rows->meeting_end_date));
                               if($enddate =='01-01-1970')
                            {
                                
                            }else
                            {
                                echo date('d-m-Y', strtotime($c_rows->meeting_end_date));
                                
                            }
                               
                               ?>
                          </td>
                          <td><?=ucfirst($c_rows->title);?></td>
                          <td><?=$c_rows->question_no;?></td>
                          <td>
                              <?php
                              $query1 = $this->db->select('*')->where('contribution_id',$c_rows->contribution_id)->get('group_contributors')->result();
                              foreach($query1 as $cd_rows)
                              {?>
                                <span><?=$cd_rows->contributor_name;?> <br>
                                    <?=$cd_rows->organization;?> 

                                </span>
                                <?php 
                                if(count($query)>1)
                                {
                                    ?>
                                 <hr>
                                <?php }?>

                                

                              <?php } ?>

                              
                          </td>
                          
                      </tr>
                      <?php }?>
                     
                    </thead> 
                    <tbody>
                        
                    </tbody>  
                  </table>
                </div>  
                <div class="row">
                   <div class="col-12">
                   <h5 class="header-title-inner-small">Members Area</h5>
                   <hr>
                   <p><a href="<?=base_url()?>login">login</a></p>
              
                  
                </div>  
                </div>
                 <div class="row">
                   <div class="col-12">
                   <h5 class="header-title-inner-small">Information</h5>
                   
                   <ul class="bullet-list-stye">
                    <?php 
                    foreach($groupinformatin_list->result() as $gifo_result): ?>
                    
                        <li>
                            <?php
                            if($gifo_result->url)
                            {
                            ?>
                            <a href="<?=$gifo_result->url;?>" target="_blank"><?=$gifo_result->title;?></a>
                            
                            <?php }else if($gifo_result->file){?>
                             <a href="<?=base_url();?>uploads/information/<?=$gifo_result->file;?>" target="_blank"><?=$gifo_result->title;?></a>
                            <?php }?>
                            
                            </li>



                      <?php endforeach;?>
                   
                  </ul>
              
                  
                </div>  
                </div>


         </div>  
    </div>
  </div>
  <br>
  <script type="text/javascript" src="<?=base_url();?>ajax/signup.js"></script>
  <style type="text/css">
   .vertical-heading  {
    background: linear-gradient( 90deg, rgba(6, 127, 159, 1) 24%, rgb(8 90 192) 61%, rgba(0, 212, 255, 1) 100% );
     color: #fff;
     font-size: 19px;
     padding: 10px 10px;
     margin-bottom: 0px;
    

   }
.vertical-menu {
  width: 100%;
  border-bottom: 2px solid #0000;
  padding-bottom: 20px;

}

.vertical-menu a {
  background-color: rgb(252, 252, 252);
     padding: 5px 10px;
    line-height: 16px;
    display: block;
    color: white;
    border-top: 1px dotted rgb(222 226 230 / 80%);
    color: #353535;
    font-size: 16px;
    text-decoration: none;
    padding-top: 10px;
     font-family: 'Fira Sans', sans-serif;
}

.vertical-menu a:hover {
  background-color: #ccc;
}

.vertical-menu a.active {
  background-color: #04668c;
  color: white;
}
.card-header
{
background: linear-gradient( 90deg, rgba(6, 127, 159, 1) 24%, rgb(8 90 192) 61%, rgba(0, 212, 255, 1) 100% );
color: white;
width: 100%;
}
.latest_gropus li
{
     background-color: rgb(252, 252, 252);
     padding: 7px 10px;
    line-height: 16px;
    display: block;
    color: white;
    border-top: 1px dotted rgb(222 226 230 / 80%);
    color: #353535;
    font-size: 13px;
    text-decoration: none;
     font-family: 'Fira Sans', sans-serif;

}
.card-footer
{
    display: none !important;
}
.header-title-about {
    color: #04668c;
    font-size: 29.5px;
    font-weight: 700;
    position: relative;
    display: inline-block;
    margin-bottom: 22px;
     font-family: 'Fira Sans', sans-serif;
    
}
.group_subheading{

    padding-bottom: 10px;
    font-weight: 500;
   font-family: 'Fira Sans', sans-serif;
   font-size:20px;
    color: #343a40;
    
}

.header-title-inner-small
{
    color: #04668c;
    font-size: 18px;
    font-weight: 500;
    position: relative;
    display: inline-block;
    margin-bottom: 13px;
    margin-top: 0px;
    position: relative;
   
    padding-top: 27px;
     font-family: 'Fira Sans', sans-serif;
}
.bullet-list-stye li
{
    list-style: none;
    padding: 7px 0px;
    line-height: 16px;
    /*display: flex;*/
    color: #353535;
    font-size: 14px;
    text-decoration: none;
    display:flex;
     font-family: 'Fira Sans', sans-serif;
   

}

}
.bullet-list-stye a {
    color: red !important;
    font-size: 15px;
}
.bullet-list-stye li::before {
  content: "•"; /* Insert content that looks like bullets */
  font-weight: 500;
  font-size: 18px;
  padding-right: 8px;
 color:#0080c0; /* Or a color you prefer */
}
hr{
    margin-bottom: 5px !important;
    margin-top: 5px !important;;
}
.table-heading
{
    background: linear-gradient( 90deg, rgba(6, 127, 159, 1) 24%, rgb(8 90 192) 61%, rgba(0, 212, 255, 1) 100% );
     color: #fff;

}


.vertical-menu ul li a:hover, .vertical-menu ul li a.active {
    background: #3388ad;
    color: #fff;
    padding-left: 7px;
    transition-property: padding-left;
    transition-duration: .5s;
    transition-timing-function: linear, ease-in;
    text-decoration: none;
}
p {
    color: #353535;
font-size: 16px;
font-family: 'Fira Sans', sans-serif;


}



</style>
<script type="text/javascript">

    $(function () {
        $(".latest_gropus").bootstrapNews({
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
   <link type="text/css" rel="stylesheet" href="assets/plugins/tricker/css/jquery.jConveyorTicker.min.css?v=1.1.0" />

  <!-- Demo styles -->
  <link type="text/css" rel="stylesheet" href="assets/plugins/tricker/demo-files/demo-styles.css?v=1.1.0" />
  <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />

<!--dynamic table initialization -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>


