 <!-- page heading start-->
  <link href="assets/js/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />

   <link type="text/css" rel="stylesheet" href="assets/plugins/tricker/css/jquery.jConveyorTicker.min.css?v=1.1.0" />

  <!-- Demo styles -->
  <link type="text/css" rel="stylesheet" href="assets/plugins/tricker/demo-files/demo-styles.css?v=1.1.0" />
        <div class="page-heading">
            <h3>
                Dashboard
            </h3>
          <hr>
           
        </div>
        <!-- page heading end-->

     
   <!--body wrapper start-->
        <div class="wrapper">
              <?php
            if($this->session->userdata('user_type')=='member')
            {


             ?>
               <div class="row">
                 <div class="col-sm-12 col-md-12">
                    <div class="panel">
                          <header class="panel-heading">
                           Meeting Calendar
                             <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                              </span>
                          </header>
                           <div class="panel-body">
                          <div class="page-header">
                                <div class="row">

                                   <div class="col-sm-12">
                                        <div class="page-header">

        

    <div class="col-md-12">
         
            <div id="calendar"></div>
        
         
    </div>

    <div class="clearfix"></div>
    <br><br>

    <div class="modal hide fade" id="events-modal">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3>Event</h3>
        </div>
        <div class="modal-body" style="height: 400px">
        </div>
        <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn">Close</a>
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

            <?php }else if($this->session->userdata('user_type')=='group_manager'){
              $user_id = $this->session->userdata('user_id');
            $totalmemberRequest = $this->db->select('users.*,category.category_name,groups.group_title')->join('category','users.group_category_id=category.category_id','left')->join('groups','users.group_id=groups.group_id','INNER')->where('users.user_type','member')->where('users.suerp_admin_status','')->order_by('users.user_id','DESC')->get('users')->num_rows();
            
             $totalgroups = $this->db->select('category.category_name,groups.group_title, group_managers.group_id, group_managers.*')->join('groups','group_managers.group_id=groups.group_id','left')->join('category','category.category_id=groups.category_id','INNER')->where('group_managers.member_id',$user_id)->get('group_managers')->num_rows();
            ?>
                 <div class="row">
                <div class="col-md-12">
                    <!--statistics start-->
                    <div class="row state-overview">
                         <div class="col-md-3 col-xs-12 col-sm-6">
                            <div class="panel green">
                                <div class="symbol">
                                    <i class="fa fa-group"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value"><?=$totalgroups;?></div>
                                    <div class="title">Total Group</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-xs-12 col-sm-6">
                            <div class="panel blue">
                                <div class="symbol">
                                    <i class="fa fa-files-o"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value">0</div>
                                    <div class="title">Total Files</div>
                                </div>
                            </div>
                        </div>
                         <div class="col-md-3 col-xs-12 col-sm-6">
                            <div class="panel red">
                                <div class="symbol">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value"><?=$totalmemberRequest;?></div>
                                    <div class="title">New Member Request</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-12 col-sm-6">
                            <div class="panel green">
                                <div class="symbol">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value">0</div>
                                    <div class="title">Total Meeting</div>
                                </div>
                            </div>
                        </div>
                         
                    </div>
                    
                    <!--statistics end-->
                </div>
                  
                 </div>

           <?php  } ?>    
           </div>

        </div>
    </div>
      <!-- Plugin styles -->

  <div class="modal hide fade" id="events-modal">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3>Event</h3>
        </div>
        <div class="modal-body" style="height: 400px">
        </div>
        <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn">Close</a>
        </div>
    </div>
<script type="text/javascript" src="ajax/dashboard.js"></script>
<script src="assets/js/fullcalendar/fullcalendar.min.js"></script>
<script src="assets/js/external-dragging-calendar.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/new-calendar/js/jquery.min.js"></script>-->

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
        events: '<?=base_url();?>dashboard/load_event', //this should echo out JSON'
       
        /*events: [
            {
                title: 'All Day Event',
                start: new Date(y, 07, 2)
            },
            {
                title: 'Long Event',
                start: new Date(y, m, d-5),
                end: new Date(y, m, d-2)
            },
            {
                id: 100,
                title: 'Repeating Event1',
                start: new Date(y, m, 23),
                //allDay: false
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: new Date(y, m, d+4, 16, 0),
                allDay: false
            },
            {
                title: 'Meeting',
                start: new Date(y, m, d, 10, 30),
                allDay: false
            },
            {
                title: 'Lunch',
                start: new Date(y, m, d, 12, 0),
                end: new Date(y, m, d, 14, 0),
                allDay: false
            },
            {
                title: 'Birthday Party',
                start: new Date(y, m, d+1, 19, 0),
                end: new Date(y, m, d+1, 22, 30),
                allDay: false
            },
            {
                title: 'Click for Google',
                start: new Date(y, m, 28),
                end: new Date(y, m, 29),
                url: 'http://google.com/'
            }
        ]*/
    });


}();
</script>
 

