<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Reports</h4>
            </div>
            <div class="card-body">
                <div class="row">
                  <div class="col-md-3">

                      <form id="reportsfilterform" method="POST" action="<?php echo base_url('reports')?>">
                        <div class="card border-warning mb-3" style="max-width: 18rem;">
                          <div class="card-header">Filter Options</div>
                          <div class="card-body text-warning">
                            <div class="form-group">
                              <label class="control-label">Courses</label>
                              <select id="course" name="course" class="form-control">
                                <option value="" disabled selected>Select Course</option>
                                <?php 
                                  foreach($courseinfo as $row){
                                    $selected = '';
                                    $cstatus = '';
                                    if($this->input->post('course') == $row->courseid){
                                      $selected = 'selected';
                                    }

                                    if($row->active){
                                      $cstatus = 'Active';
                                    }else{
                                      $cstatus = 'Inactive';
                                    }
                                    echo '<option value="'.$row->courseid.'" '.$selected.'>'.$row->coursecode.'-['.$row->courseclass.'](<small class="text-muted">'.$cstatus.'</small>)</option>';
                                  }

                                ?>                              
                              </select>
                            </div>
                            <!-- <div class="form-group">
                              <label class="control-label">Requirements</label>
                              <input type="text" class="form-control" name="course">
                            </div>    -->                      
                          </div>
                          <div class="card-footer">
                            <button type="submit" name="btnApplyFilter" value="true" class="btn btn-default pull-left mb-4">Apply</button>
                            <button type="reset" class="btn btn-default pull-right mb-4">Reset</button>
                          </div>
                        </div>
                      </form>
                     
                  </div>
                  <div class="col-md-9">
                    <h6>Lists of Registered Student</h6>
                    <hr>
                    <div class="table-responsive">
                      <table id="datatable" class="table">
                        <thead>
                            <tr>
                                <th class="hide_column"></th>
                                <th>Name</th>
                                <th>AFPSN</th>
                                <th>Date of Registration</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if($page_data){
                                  foreach($page_data as $row){

                                    echo'
                                        <tr>
                                        <td class="hide_column">'.$row->courseid.'</td>
                                        <td>'.$row->first_name.' '.$row->last_name.'</td>
                                        <td>'.$row->afpsn.'</td>
                                        <td>'.$row->dateregistration.'</td>
                                        <td id="status'.$row->studentcoursereqid.'">'.$row->status.'</td>
                                        <td>
                                            <button type="button" onclick="sfra.clickShowReqDetails(\''.$row->username.'\','.$row->courseid.')" class="btn btn-primary">Show Details</button>
                                        </td>
                                        
                                      </tr>
                                      ';
                                  /* 
                                  echo'
                                        <tr><form method="POST" action="'.base_url('reports').'">
                                        <input type="hidden" value="'.$row->username.'" name="user">
                                        <input type="hidden" value="'.$row->courseid.'" name="course">
                                        <td class="hide_column">'.$row->courseid.'</td>
                                        <td>'.$row->first_name.' '.$row->last_name.'</td>
                                        <td>'.$row->afpsn.'</td>
                                        <td>'.$row->dateregistration.'</td>
                                        <td>'.$row->status.'</td>
                                        <td class="text-right">
                                            <button type="submit" name="btnShowDetails" value="true" class="btn btn-primary">Show Details</button>
                                        </td>
                                        </form>
                                      </tr>
                                      ';
                                    */
                                  }
                                }
                            ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <form id="approveRegistrationForm" action="<?php echo base_url('reports/approve_reg');?>" method="POST">
                    <div class="card border-warning mb-3">
                      <div class="card-header">
                        <h6>Details</h6>
                        <input type="hidden" name="hiddencourse" id="hiddencourse">
                        <input type="hidden" name="hiddenuser" id="hiddenuser">
                        <input type="hidden" name="hiddenscr" id="hiddenscr">
                        
                        <button type="submit" name="btnApproveReg" value="true" class="btn btn-primary">Approve Registration</button>
                      </div>
                      <div class="card-body text-warning">
                        <div id="userFullname"></div>
                        <hr>
                        <table id="tableDetailsReq" class="table">
                          <thead>
                              <tr>
                                  <th class="hide_column"></th>
                                  <th>Requirements</th>
                                  <th>Status</th>                              
                                  <th class="disabled-sorting text-right">Actions</th>
                              </tr>
                          </thead>
                          <tbody id="tabldata"></tbody>
                        </table>                   
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div> <!-- end col-md-12 -->
</div> <!-- end row -->

<!-- Modal View Attachment -->
<div class="modal fade" id="viewAttachmentReqModal" tabindex="-1" role="dialog" aria-labelledby="viewAttachmentReqModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="attachmentActionForm" action="<?php echo base_url('reports/attachment_action');?>" method="POST">
        <div class="modal-header justify-content-center">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="now-ui-icons ui-1_simple-remove"></i>
          </button>
          <h4 class="title title-up">View Attachment</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" id="studentcoursereq" name="studentcoursereq">
          <div class="img_preview_wrap">
            <img alt="Preview Image" width="400px" id="attachment" src=""/>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="btnApproveAttachment" value="true" class="btn btn-primary">Verified Attachment</button>
          <button type="submit" name="btnResubmitAttachment" value="true" class="btn btn-danger">Resubmit Attachment</button>
        </div>
      </form>
    </div>
  </div>
</div>