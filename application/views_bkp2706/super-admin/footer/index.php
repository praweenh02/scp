 <div class="page-heading">
            <h3>
                Website  Footer Management
            </h3>
            <hr>
           
                
       
                   </div>
                    <form name="form-footer" method="post" id="form-footer" enctype="multipart/form-data">
                   <?php  $csrf = array(
                             'name' => $this->security->get_csrf_token_name(),
                             'hash' => $this->security->get_csrf_hash());
                             ?>

                             <input type="hidden" id="csrf_token_name" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
                             <input type="hidden" name="footer_id" id="footer_id" value="<?=$footer->footer_id;?>">
<div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
        <header class="panel-heading">
           Website  Footer Management
                   </header>
        <div class="panel-body">
        <div class="adv-table">
        <table  class="display table table-bordered table-striped" >
        <tbody>
            <tr>
                <th>Section 1</th>
                  <td><textarea class="form-controll ckeditor" name="section_1" id="section_1"><?=$footer->section_1;?></textarea></td>
            </tr>
                <tr>
                <th>Section 2</th>
                  <td><textarea class="ckeditor" name="section_2" id="section_2"><?=$footer->section_2;?></textarea></td>
            </tr>
             <tr>
                <th>Section 3</th>
                  <td><textarea class="ckeditor" name="section_3" id="section_3"><?=$footer->section_3;?></textarea></td>
            </tr>
            <tr>
                <th>Section 4</th>
                  <td><textarea class="ckeditor" name="section_4" id="section_4"><?=$footer->section_4;?></textarea></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
             
            <td colspan="2" rowspan="1" align="right">
               <button class="btn btn-danger btn-sm" onclick="window.history.back(-1);" type="button"> <i class="fa fa-arrow-left"></i>  Back</button> &nbsp;&nbsp;&nbsp;
                <button type="button" class="btn  btn-success" onclick="save_data();" name="submit">Save changes</button>
            </td>
        </tr>
        </tfoot>
        </tbody>
     
        </table>
        </div>
        </div>
      </section>
        </div>
        </div>
      </div>
  </form>

      <div id="popupdiv"></div>

<script src="ajax/footer.js"></script>


                          



    
