 <!--footer section start-->
        <footer>
            <?=date('Y');?>  <strong>&copy; TEC</strong>
        </footer>
        <!--footer section end-->


    </div>
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->

<script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/modernizr.min.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/plugins/bootbox/bootbox.min.js"></script>

<!--easy pie chart-->
<script src="assets/js/easypiechart/jquery.easypiechart.js"></script>
<script src="assets/js/easypiechart/easypiechart-init.js"></script>

<!--Sparkline Chart-->
<script src="assets/js/sparkline/jquery.sparkline.js"></script>
<script src="assets/js/sparkline/sparkline-init.js"></script>

<!--icheck -->
<script src="assets/js/iCheck/jquery.icheck.js"></script>
<script src="assets/js/icheck-init.js"></script>

<!-- jQuery Flot Chart-->
<script src="assets/js/flot-chart/jquery.flot.js"></script>
<script src="assets/js/flot-chart/jquery.flot.tooltip.js"></script>
<script src="assets/js/flot-chart/jquery.flot.resize.js"></script>


<!--Morris Chart-->
<script src="assets/js/morris-chart/morris.js"></script>
<script src="assets/js/morris-chart/raphael-min.js"></script>

<!--Calendar-->
<script src="assets/js/calendar/clndr.js"></script>
<script src="assets/js/calendar/evnt.calendar.init.js"></script>
<script src="assets/js/calendar/moment-2.2.1.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>

<script src="assets/js/jquery.nicescroll.js"></script>
<!--dynamic table-->
<script type="text/javascript" language="javascript" src="assets/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization -->
<script src="assets/js/dynamic_table_init.js"></script>
<!--Editor-->
<script type="text/javascript" src="assets/js/ckeditor/ckeditor.js"></script>
<!--Table-->



<script src="<?php echo base_url('ajax/remote.js'); ?>"></script>
<!--common scripts for all pages-->
<script src="assets/js/scripts.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-fileupload.min.js"></script>
<!--Dashboard Charts-->
<script src="assets/js/dashboard-chart-init.js"></script>
<!-- Select2 -->
<script src="assets/plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="assets/js/pickers-init.js"></script>
<script type="text/javascript" src="<?=base_url();?>ajax/dashboard.js"></script>


  <!-- Syntax Highlighter -->
  <script src="assets/plugins/tricker/demo-files/run_prettify.js"></script>

  <!-- jConveyorTicker plugin -->
  <script src="assets/plugins/tricker/js/jquery.jConveyorTicker.min.js?v=1.1.0"></script>

  <script type="text/javascript" charset="utf-8">
  $(function() {

    /*! Default options:
     *  
     *  anim_duration:  200
     *  reverse_elm:    false
     *  force_loop:     false
     *  start_paused:   false
     * 
     */

    $('.js-conveyor-1').jConveyorTicker();

    $('.js-conveyor-2').jConveyorTicker({
      anim_duration: 100
    });

    $('.js-conveyor-3').jConveyorTicker({
      reverse_elm: true
    });

    $('.js-conveyor-4').jConveyorTicker({
      force_loop: true
    });
    
    window.jsConveyor5 = $('.js-conveyor-5').jConveyorTicker({
      start_paused: true
    });

  });
  </script>

<script type="text/javascript">
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});


$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
});
</script>
<script type="text/javascript">
    
</script>
</body>
</html>
