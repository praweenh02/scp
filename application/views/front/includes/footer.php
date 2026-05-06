    <?php
    $visitor_ip = $_SERVER['REMOTE_ADDR'];
    $visitor_browser = 'crome';
    $visitor_hour = date("h");
    $visitor_minute = date("i");
    $visitor_day = date("d");
    $visitor_month = date("m");
    $visitor_year = date("Y");
    $visitor_refferer = 'NULL';
    $visited_page = 'NULL';
    $visitor_date = date("Y/m/d");
    //write the required data to database
    //mysql_select_db($database_visitors, $visitors);
    $sql = $this->db->query("INSERT INTO visitors_table (visitor_ip, visitor_browser, visitor_hour,
 visitor_minute, visitor_date, visitor_day, visitor_month, visitor_year,
 visitor_refferer, visitor_page) VALUES ('$visitor_ip', '$visitor_browser',
 '$visitor_hour', '$visitor_minute', '$visitor_date', '$visitor_day', '$visitor_month',
 '$visitor_year', '$visitor_refferer', '0' )");
    //$result = mysql_query($sql) or trigger_error(mysql_error(),E_USER_ERROR);
    $month = date('m');
    $year = date('Y');
    $select = $this->db->query("SELECT * FROM `visitors_table` WHERE 1=1  GROUP BY visitor_ip, visitor_date ");
    $vistorCount = $select->num_rows();


    $rows = $this->db->select('*')->order_by('footer_id', 'DESC')->limit('1')->get('footer_management')->row();

    $result = $this->db->select('*')->where('whatsnew_status', 'Y')->order_by('whatsnew_id', 'DESC')->get('whats_new')->row();

    ?>
    <footer>
        <div class="container">
            <div class="row">


                <div class="col-md-3">
                    <div class="widget">
                        <!--   <h5 class="widgetheading">Stay on Social Media</h5> -->
                        <?= $rows->section_1; ?>

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="widget">
                        <?= $rows->section_2; ?>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="widget">

                        <?= $rows->section_3; ?>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="widget">
                        <?= $rows->section_4; ?>
                        <div class="clear">
                        </div>
                    </div>
                </div>

            </div>
        </div>



        <div id="sub-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright text-center">
                            <p>
                                <span>Website Content Managed by Telecommunication Engineering Centre</span>
                            </p>

                        </div>
                    </div>
                </div>
                </div>
                </div>
                <div class="blacks border-top">
            <div class="container">
                <div class="row">

                    <div class="col-md-12 border-top-padding copyright black-bg text-white">
                        <div class="copyright text-center">
                            <p>© <?= date('Y'); ?> Telecommunication Engineering Centre. All rights reserved</p>
                        </div>
                    </div>
                </div>
                </div>
                </div>
                                <div class="blacks border-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 border-top-padding text-center">

                        <span class="text-center">Visitor Count : <span><?= $vistorCount; ?></span></span>
                    </div>
                </div>
                </div>
                </div>
                                <div class="blacks border-top">
            <div class="container ">
                <div class="row">
                    <div class="col-md-12  text-center ">
                        <span class="text-center">Last reviewed and updated on <span><?= $formatted_date = date('M d, Y', strtotime(date('d-m-Y'))); ?></span></span>
                    </div>
                </div>
            </div>
        </div>
        
        
    </footer>
    <style>
        .blacks {
          background: #006C9B;
  text-shadow: none;
  color: #FFFFFF;
  padding: 0;
  height: 50px;
  line-height: 50px;
 

        }
    </style>
