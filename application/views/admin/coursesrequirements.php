<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Requirements Lists per Courses</h4>
            </div>
            <div class="card-body mr-4">
                <div class="toolbar mb-4">
                    <button class="btn btn-primary btn-round" onclick="sfra.clickAddCourseRequirement()">ADD</button>
                </div>
                <div class="card-deck">
                  
                <?php
                    foreach($courseslist as $row){
                ?>
                  <div class="col-md-4 mb-4">
                    <div class="card">
                      <img class="card-img-top" src="<?php echo base_url('images/site/dots-06.jpg')?>" alt="Card image cap">
                      <div class="card-body">
                        <h6 class="card-title"><?php echo $row->coursename;?></h6>
                        <small class="text-muted">CLASS: <?php echo $row->courseclass; ?></small>
                        <p class="card-text mt-4">
                             <small class="form-text mb-2">Requirements:</small>
                             <?php

                                $criteria = array(
                                    'courseid' => $row->courseid
                                );
                                $this->crud->set_table('courserequirements');    
                                $this->crud->set_keyid('requirementid');     
                                $query = $this->crud->getJoinResultsCriteria($criteria,array('table'=>'requirements','col'=>'requirementid'));
                                $rownum = 1;
                                foreach($query->result() as $row){
                                  echo $rownum.'. '.$row->requirementname.' <a href="'.base_url('requirementscourses/delete/').$row->coursereqid.'" class="btn btn-round btn-danger btn-icon btn-sm remove"><i class="fas fa-times"></i></a><br/>';
                                  $rownum++;
                                }
                            ?>


                       </p>
                      </div>
                      <div class="card-footer">
                        <!-- <div class="pull-left mb-2">
                          <?php if($loggedin)
                            //echo '<h7><a href="#" class="link footer-link" data-toggle="modal" data-target="#courseModal'.$row->courseid.'">Show Details</a></h7>';
                          ?>
                        </div>
                        <div class="pull-right mb-2">
                          <?php if($loggedin && $myuserRole != 'admin')
                            //echo '<h7><a href="#" onclick="sfra.clickEnrollCourse('.$row->courseid.')" class="link footer-link">Enroll</a></h7>';
                          ?>
                        </div>   -->
                      </div>
                    </div>
                    </div>
                <?php 
                    }
                ?> 
                </div> 
            </div><!-- end content-->
        </div><!--  end card  -->
    </div> <!-- end col-md-12 -->
</div> <!-- end row -->

<div class="modal fade" id="courseRequirementModalAdd" tabindex="-1" role="dialog" aria-labelledby="courseRequirementModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
        <form id="addCourseRequirementForm" action="<?php echo base_url('requirementscourses/add');?>" method="POST">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>
            <h5 class="title title-up">Add Requirements</h5>
          </div>
          <div class="modal-body">
               
                <h7><b>Fillup Information</b></h7>
                <hr>
                
                <div class="row">
                  <!-- <label class="col-sm-4 col-form-label">Courses</label> -->
                  <div class="col-md-12">                          
                      <div class="form-group required">
                          <label class="control-label">Course</label>
                          <select id="course" name="course" class="form-control" required>
                            <option value="" disabled selected>Choose Course</option>
                            <?php foreach ($courseslist as  $row) {
                              echo '<option value="'.$row->courseid.'">'.$row->coursecode.'-'.$row->courseclass.'</option>';
                            }                                    
                            ?>               
                          </select>
                      </div>
                  </div>
                 
                  
                  <div class="col-md-12">                          
                      <div class="form-group required">
                          <label class="control-label">Requirements</label>
                          <select id="requirements" name="requirements[]" multiple data-style="btn btn-info btn-round btn-block" class="selectpicker" data-size="7" required>
                            <option value="" disabled>Choose Requirements</option>
                            <?php foreach ($requirementslist as  $row) {
                              echo '<option value="'.$row->requirementid.'">'.$row->requirementname.'</option>';
                            }                                    
                            ?>               
                          </select>
                      </div>
                  </div> 
                </div>
          </div>

          <div class="modal-footer">
            <button type="submit" name="btnAddCourseRequirement" value="true" class="btn btn-success">Add</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>   
        </form>  
    </div>
  </div>
</div>