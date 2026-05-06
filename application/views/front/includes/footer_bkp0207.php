    <?php $rows = $this->db->select('*')->order_by('footer_id', 'DESC')->limit('1')->get('footer_management')->row();
    ?>
    <footer>
        <div class="container">
            <div class="row">


                <div class="col-md-3">
                    <div class="widget">
                      <!--   <h5 class="widgetheading">Stay on Social Media</h5> -->
                      <?=$rows->section_1;?>
                       
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="widget">
                        <?=$rows->section_2;?>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="widget">
                      
                        <?=$rows->section_3;?>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="widget">
                         <?=$rows->section_4;?>
                        <div class="clear">
                        </div>
                    </div>
                </div>

            </div>
        </div>



        <div id="sub-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="copyright text-left">
                            <p>
                                <span>Website Content Managed by Telecommunication Engineering Centre</span>
                            </p>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="credits text-right">
                         <span>© <?=date('Y');?> Telecommunication Engineering Centre. All rights reserved</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>