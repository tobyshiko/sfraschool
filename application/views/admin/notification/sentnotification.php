<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Sent Message Box</h4>
            </div>
            <div class="card-body">
                <div class="toolbar mb-4">
                    <a href="<?php echo base_url('notification');?>" class="btn btn-primary btn-round">Inbox</a>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                          <tr>
                              <th class="hide_column"></th>
                              <th>To</th>
                              <th>Message</th>
                              <th class="disabled-sorting text-right">Date</th>
                              <!-- <th class="disabled-sorting text-right">Actions</th> -->
                          </tr>
                      </thead>
                      <tfoot>
                          <tr>
                              <th class="hide_column"></th>
                              <th>To</th>
                              <th>Message</th>
                              <th class="disabled-sorting text-right">Date</th>
                              <!-- <th class="disabled-sorting text-right">Actions</th> -->
                          </tr>
                      </tfoot>
                      <tbody>
                          <?php
                              
                              foreach($page_data as $row){
                                $sentdate = ($row->sentdatetime == '0000-00-00') ? '' : nice_date($row->sentdatetime, $uidateFormat);

                              echo'<tr>
                                  <td class="hide_column">'.$row->notificationid.'</td>
                                  <td>'.$row->toname.'</td>
                                  <td>'.$row->message.'</td>
                                  <td class="disabled-sorting text-right">'.$sentdate.'</td>
                                  
                              </tr>';
                              }
                          ?>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div> <!-- end col-md-12 -->
</div> <!-- end row -->

<div class="modal fade" id="addFormModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
        <form id="addForm" action="<?php echo base_url('notification/send_message');?>" method="POST">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>
            <h5 class="title title-up">New Message</h5>
          </div>
          <div class="modal-body">              
                
                <hr>
                
                <div class="row">

                  <div class="col-md-12">                          
                      <div class="form-group required">
                          <label class="control-label">To</label>
                          <select id="useradmin" name="useradmin" class="form-control" required>
                            <option value="" disabled selected>Choose Course</option>
                            <?php foreach ($useradminlist as  $row) {
                              $fullname = $row->first_name.' '.$row->last_name;
                              echo '<option value="'.$row->username.'-'.$fullname.'">'.$fullname.'</option>';
                            }                                    
                            ?>               
                          </select>
                      </div>
                  </div>

                  <div class="col-md-12">     
                    <div class="form-group required">
                      <label class="control-label">Message</label>
                      <textarea name="message" rows="120" class="form-control" required></textarea>
                    </div>
                  </div>
                </div>
          </div>

          <div class="modal-footer">
            <input type="hidden" value="" name="id"/> 
            <button type="submit" name="btnSendMessage" id="btnSendMessage" value="true" class="btn btn-success">Send</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>   
        </form>  
    </div>
  </div>
</div>