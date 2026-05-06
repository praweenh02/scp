<div class="page-heading">
    <div class="row">
        <div class="col-md-8">
            <h3>
            SDO  - <span><?=$group_data->category_name;?></span>
            &nbsp;&nbsp;
            Working Group - <span><?=$group_data->shortform;?></span>
            </h3>
        </div>
    </div>
</div>
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    SDO  Bulletin
                    <!--<span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                    </span>-->
                </header>
                <div class="panel-body">
                    <section id="unseen">
                        <table  id="dynamic-table" class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th class="numeric">Sr.No</th>
                                    <th>Title</th>
                                    
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;
                                foreach($sdo_list as $sdo_result){
                                ?>
                                <tr>
                                    <td class="numeric"><?=$i;?></td>
                                    <td>
                                         <a target="_blank" href="home/groups/<?=$sdo_result->sdo_id;?>?groupId=<?=base64_encode($sdo_result->group_id);?>">
                                        <?php
                                        echo $sdo_result->bulletin_title;
                                        ?>
                                    </a>
                                    </td>
                                    
                                    <td>
                                        <?php
                                        echo date('d-m-Y', strtotime($sdo_result->created_at));
                                        ?>
                                    </td>
                                </tr>
                                <?php $i++; }?>
                            </tbody>
                        </table>
                    </section>
                    <hr>
                </div>
            </section>
            <section class="panel">
                <div class="row">
                    <div class="col-sm-12">
                        <header class="panel-heading">
                            MEMBER UPLOADED CONTRIBUTION
                        </header>
                        <table id="dynamic-table1" class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th class="numeric">Sr.No</th>
                                    <th class="numeric">Document No.</th>
                                    <th class="numeric">Meeting Name</th>
                                    <th>Title</th>
                                    <th>Contributors</th>
                                    <th>Source</th>
                                    <th>Question</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;
                                foreach ($doc_reg_list as $docreg_data){
                                ?>
                                <tr>
                                    <td><?=$i;?></td>
                                    <td>
                                        <?php
                                        if($docreg_data->file)
                                        {?>
                                        <a target="_blank" href="<?=base_url();?>uploads/files/<?=$docreg_data->file;?>" ><?=$docreg_data->unique_no;?> </a>
                                        <?php }else{?>
                                        <?=$docreg_data->unique_no;?>
                                        <?php }
                                        ?>
                                    </td>
                                    <td><?=$docreg_data->meeting_title;?></td>
                                    <td><?=$docreg_data->title;?>
                                        <br>
                                        <?php
                                        if($docreg_data->group_manager_status=='accept')
                                        {?>
                                        <span style="font-size:10px; color: red;">Verified by Group admin  </span>
                                        <?php }else if($docreg_data->group_manager_status=='reject'){ ?>
                                        <span style="font-size:10px; color: red;">Rejected by Group admin  </span>
                                        <?php }?>
                                    </td>
                                    <td>
                                        <?php
                                        $cdid = $docreg_data->contribution_id;
                                        $query2 = $this->db->select('*')->where('contribution_id',$cdid)->get('group_contributors')->result();
                                        foreach($query2 as $result2)
                                        {
                                        ?>
                                        <span><?=$result2->contributor_name;?> - <?=$result2->organization;?> </span>
                                        <hr>
                                        <?php }?>
                                    </td>
                                    <td><?=$docreg_data->name;?> <?=$docreg_data->surname;?></td>
                                    <td>
                                        <?=$docreg_data->question_no;?>
                                    </td>
                                    <td>
                                        <?php
                                        echo date('d-m-Y', strtotime($docreg_data->created_at));
                                        ?>
                                    </td>
                                </tr>
                                <?php $i++; }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <section class="panel">
                <div class="row">
                    <div class="col-sm-12">
                    <header class="panel-heading">
                        Minutes of Meetings
                    </header>
                    <table id="dynamic-table2" class="table table-hover table-bordered table-striped table-condensed">
                        <thead>
                            <tr>
                                <th class="numeric">Sr.No</th>
                                <th class="numeric">Meeting Title</th>
                                <th class="numeric">Meeting Durations</th>
                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=1;
                            error_reporting(0);
                            foreach ($meeting_list as $meeting_result){
                                $group_meeting = $this->db->select('*')->where('meeting_id',$meeting_result->meeting_id)->get('group_meeting')->row();
                            ?>
                            <tr>
                                <td><?=$i;?></td>
                                <td>
                                    <?php
                                    if($meeting_result->minutes_of_meeting_file)
                                    {?>
                                    <a target="_blank" href="<?=base_url();?>uploads/meeting-file/<?=$meeting_result->minutes_of_meeting_file;?>" ><?=$group_meeting->meeting_title;?> </a>
                                    <?php }else{ ?>
                                    <?=$group_meeting->meeting_title;?>
                                    <?php }
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                     $start_date = strtotime($group_meeting->meeting_date);
                                    $end_date =  strtotime($group_meeting->meeting_end_date);
                                    if($start_date !== $end_date)
                                    {
                                        echo  date('d-m-Y', strtotime($group_meeting->meeting_date)).'&nbsp;To&nbsp;'   .date('d-m-Y', strtotime($group_meeting->meeting_end_date));
                                        
                                    }else
                                    {
                                        echo "One day meeting";
                                     
                                        
                                    }
                                    ?>
                                </td>
                               
                            
                                </td>
                            </tr>
                            <?php $i++; }?>
                        </tbody>
                    </table>
                </div>
                </div>
            </section>
            <section class="panel">
                 <div class="row">
                    <div class="col-sm-12">
                <header class="panel-heading">
                    Outcome Documents
                </header>
                <table  id="dynamic-table3" class="table table-hover table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <th class="numeric">Sr.No</th>
                            <th class="numeric">Title</th>
                            <th class="numeric">Meeting Details</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                        foreach ($outcome_list as $outcome_result){
                        ?>
                        <tr>
                            <td><?=$i;?></td>
                            <td>
                                <?php
                                if($outcome_result->outcome_file)
                                {?>
                                <a target="_blank" href="<?=base_url();?>uploads/outcome-documents/<?=$outcome_result->outcome_file;?>" ><?=$outcome_result->outcome_document_title;?> </a>
                                <?php }else{ ?>
                                <?=$outcome_result->outcome_document_title;?>
                                <?php }
                                ?>
                            </td>
                            <td>
                                <?=$outcome_result->meeting_title;?> - <?=date('d-m-Y', strtotime($outcome_result->meeting_date));?>
                            </td>
                            <td>
                                <?php
                                echo date('d-m-Y', strtotime($outcome_result->created_at));
                                ?>
                            </td>
                        </tr>
                        <?php $i++; }?>
                    </tbody>
                </table>
            </div>
        </div>
            </section>
            <section class="panel">
                 <div class="row">
                    <div class="col-sm-12">
                <header class="panel-heading">
                    Documents from ITU site
                </header>
                <table id="dynamic-table4" class="table table-hover table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <th class="numeric">Sr.No</th>
                            <th class="numeric">Title</th>
                             <th class="numeric">Meeting </th>
                            
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                        foreach ($documentfromitu_list as $itu_result){
                        ?>
                        <tr>
                            <td><?=$i;?></td>
                            <td>
                                <?php
                                if($itu_result->document_file)
                                {?>
                                <a target="_blank" href="<?=base_url();?>uploads/document-from-itu-site/<?=$itu_result->document_file;?>" ><?=$itu_result->document_title;?> </a>
                                <?php }else{ ?>
                                <?=$itu_result->document_title;?>
                                <?php }
                                ?>
                            </td>
                            <td>
                                <?=$itu_result->meeting_title;?> - <?=date('d-m-Y', strtotime($itu_result->meeting_date));?>
                            </td>
                            <td>
                                <?php
                                echo date('d-m-Y', strtotime($itu_result->created_at));
                                ?>
                            </td>
                        </tr>
                        <?php $i++; }?>
                    </tbody>
                </table>
            </div>
        </div>
            </section>
             <section class="panel">
                 <div class="row">
                    <div class="col-sm-12">
                <header class="panel-heading">
                    Circulars
                </header>
                <table id="dynamic-table5" class="table table-hover table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <th class="numeric">Sr.No</th>
                            <th class="numeric">Title</th>
                            
                            <th>Created Date</th>
                        </tr>
                       
                    </thead>
                    <tbody>
                         <?php
                         $i=1;
                        foreach($circulars_list as $cr_data)
                        {
                        $meeting_id = $cr_data->meeting_id;
                        //$meeting_d = $this->db->select('*')->where('meeting_id',$meeting_id)->get('group_meeting')->row()
                        ?>
                        <tr>
                            <td><?=$i;?></td>
                            <td>
                                <?php 
                                
                                if($cr_data->circulars_file)
                                {
                                ?>
                                <a target="_blank" href="<?=base_url();?>uploads/circulars/<?=$cr_data->circulars_file;?>" ><?=$cr_data->circulars_title;?> </a>
                              <?php }else{ ?>
                                <?=$cr_data->circulars_title;?>
                                <?php }
                                ?>
                               
                                
                            </td>
                          
                            <td>
                                   <?=date('d-m-Y', strtotime($cr_data->created_at));?>
                            </td>
                        </tr>
                        <?php }?>
                        
                    </tbody>
                </table>
            </div>
        </div>
            </section>
        </div>
    </div>
</div>