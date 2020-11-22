<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Email Template Lists</h4>
            </div>
            <div class="card-body">
                <div class="toolbar mb-4">
                    <button class="btn btn-primary btn-round" onclick="sfra.clickAddRequirement()">Add Template</button>
                </div>
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="hide_column"></th>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="hide_column"></th>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                            
                            foreach($page_data as $row){
                             
                            echo'<tr>
                                <td class="hide_column">'.$row->emailtemplateid.'</td>
                                <td>'.$row->templatename.'</td>
                                <td>'.$row->subject.'</td>
                                <td>'.$row->message.'</td>
                                <td class="text-right">
                                    <a href="#" class="btn btn-round btn-warning btn-icon btn-sm edit"><i class="far fa-calendar-alt"></i></a>
                                    <a href="#" class="btn btn-round btn-danger btn-icon btn-sm remove"><i class="fas fa-times"></i></a>
                                </td>
                            </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div> <!-- end col-md-12 -->
</div> <!-- end row -->

<div class="modal fade" id="requirementModalAdd" tabindex="-1" role="dialog" aria-labelledby="requirementModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
        <form id="addRequirementForm" action="<?php echo base_url('requirements/add');?>" method="POST">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>
            <h5 class="title title-up">Add Template</h5>
          </div>
          <div class="modal-body">
               
                <h7><b>Fillup Information</b></h7>
                <hr>
                
                <div class="row">
                  <label class="col-sm-4 col-form-label">Name</label>
                  <div class="col-md-8">                          
                      <div class="form-group required">
                          <input type="text" name="templatename" class="form-control" required/>
                      </div>
                  </div>

                  <label class="col-sm-4 col-form-label">Subject</label>
                  <div class="col-md-8">                          
                      <div class="form-group required">
                          <input type="text" name="subject" class="form-control" required/>
                      </div>
                  </div>
                 
                  <label class="col-sm-4 col-form-label">Message</label>
                  <div class="col-md-8">                          
                      <div class="form-group">
                          <textarea name="message" class='editor' required></textarea>
                      </div>
                  </div> 
                </div>
          </div>

          <div class="modal-footer">
            <button type="submit" name="btnAddRequirement" value="true" class="btn btn-success">Add</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>   
        </form>  
    </div>
  </div>
</div>