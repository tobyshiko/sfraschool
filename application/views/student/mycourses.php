<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
               <!--  <h4 class="card-title">My Courses Lists</h4> -->
            </div>
            <div class="card-body">
                <!-- <div class="toolbar mb-4">
                    <button class="btn btn-primary btn-round" onclick="sfra.clickAddCourse()">Add Course</button>
                </div> -->
                <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="hide_column"></th>
                            <th>Course</th>
                            <th>Name</th>
                            <th>Started</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="hide_column"></th>
                            <th>Course</th>
                            <th>Name</th>
                            <th>Started</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                            foreach($page_data as $row){
                            $coursestart = ($row->coursestarted == '0000-00-00') ? '' : nice_date($row->coursestarted, $uidateFormat);
                            $pactive = 'mycourses';
                            $ptitle = 'My Courses';
                        
                            // <a href="#" class="btn btn-round btn-info btn-icon btn-sm like"><i class="fa fa-edit"></i></a>
                            echo'<tr>
                                <td class="hide_column">'.$row->courseid.'</td>
                                <td>'.$row->coursecode.' - <small class="text-muted">'.$row->courseclass.'</small></td>
                                <td>'.$row->coursename.'</td>
                                <td>'.$coursestart.'</td>
                                <td>'.$row->status.'</td>
                                <td>'.$row->remarks.'</td>
                                <td class="text-right">
                                    
                                    <a href="'.base_url('courses/enrollment/').sha1($row->courseid).'/'.$row->courseid.'/'.$pactive.'/'.$ptitle.'" class="">View Details</a>
                                </td>
                            </tr>';
                            }
                        ?>
                    </tbody>
                </table>
                </div>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div> <!-- end col-md-12 -->
</div> <!-- end row -->

<div class="modal fade" id="courseModalAdd" tabindex="-1" role="dialog" aria-labelledby="courseModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
        <form id="addCourseForm" action="<?php echo base_url('courses/add_update');?>" method="POST">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>
            <h5 class="title title-up"></h5>
          </div>
          <div class="modal-body">
               
                <h7><b>Course Information</b></h7>
                <hr>
                
                <div class="row">
                    
                    <div class="col-md-12" id="coursestatus">
                    <p class="category">Course Status</p>
                    <input type="checkbox" checked name="active" class="bootstrap-switch"
                        data-on-label="ON"
                        data-off-label="OFF"
                    />
                    </div>
                    
                  <label class="col-sm-4 col-form-label">Course Code</label>
                  <div class="col-md-8">                          
                      <div class="form-group">
                          <input type="text" name="coursecode" class="form-control" required="true" />
                      </div>
                  </div>
                  <label class="col-sm-4 col-form-label">Course Name</label>
                  <div class="col-md-8">                          
                      <div class="form-group">
                          <input type="text" name="coursename" class="form-control" required/>
                      </div>
                  </div>
                  <label class="col-sm-4 col-form-label">Course Class</label>
                  <div class="col-md-8">                          
                      <div class="form-group">
                          <input type="text" name="courseclass" class="form-control" required/>
                      </div>
                  </div>
                  <label class="col-sm-4 col-form-label">Description</label>
                  <div class="col-md-8">                          
                      <div class="form-group">
                          <textarea name="coursedesc" class="form-control" required></textarea>
                      </div>
                  </div>
                  <label class="col-sm-4 col-form-label">Course Start</label>
                  <div class="col-md-8">                          
                      <div class="form-group">
                          <input type="text" name="coursestarted" class="form-control datepicker" required/>
                      </div>
                  </div>
                  <label class="col-sm-4 col-form-label">Picture</label>
                  <div class="col-md-8">                          
                    <div class="form-group form-file-upload form-file-simple">
                        <input type="text" class="form-control inputFileVisible" placeholder="Select file...">
                        <input type="file"name="picture" class="inputFileHidden">
                    </div>
                  </div>
                </div>
                
                <h7><b>Registration Information</b></h7>
                <hr>
                <div class="row">
                  <label class="col-sm-4 col-form-label">Registration Start</label>
                  <div class="col-md-8">                          
                      <div class="form-group">
                          <input type="text" name="regstart" class="form-control datepicker" required/>
                      </div>
                  </div>
                  <label class="col-sm-4 col-form-label">Registration End</label>
                  <div class="col-md-8">                          
                      <div class="form-group">
                          <input type="text" name="regend" class="form-control datepicker" required/>
                      </div>
                  </div>
                  
                </div>

                <h7><b>Quota Information</b></h7>
                <hr>
                <div class="row">
                  <label class="col-sm-4 col-form-label">PA</label>
                  <div class="col-md-8">                          
                      <div class="form-group">
                          <input type="number" name="army" class="form-control" required/>
                      </div>
                  </div>
                  <label class="col-sm-4 col-form-label">PN / PN(M)</label>
                  <div class="col-md-8">                          
                      <div class="form-group">
                          <input type="number" name="navy" class="form-control" required/>
                      </div>
                  </div>
                  <label class="col-sm-4 col-form-label">PAF</label>
                  <div class="col-md-8">                          
                      <div class="form-group">
                          <input type="number" name="airforce" class="form-control" required/>
                      </div>
                  </div>     
                  <label class="col-sm-4 col-form-label">PNP</label>
                  <div class="col-md-8">                          
                      <div class="form-group">
                          <input type="number" name="police" class="form-control" required/>
                      </div>
                  </div>     
                  <label class="col-sm-4 col-form-label">SFR(A)</label>
                  <div class="col-md-8">                          
                      <div class="form-group">
                          <input type="number" name="sfra" class="form-control" required/>
                      </div>
                  </div>
                  <label class="col-sm-4 col-form-label">Total</label>
                  <div class="col-md-8">                          
                      <div class="form-group">
                          <input type="number" name="totalquota" class="form-control" required/>
                      </div>
                  </div>
                </div>
              
          </div>

          <div class="modal-footer">
            <input type="hidden" value="" name="id"/> 
            <button type="submit" name="btnAddCourse" id="btnAddCourse" value="true" class="btn btn-success">Add</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>   
        </form>  
    </div>
  </div>
</div>