<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <!-- <h4 class="card-title">Courses</h4> -->
            </div>
            <div class="card-body mr-4">
                <!-- <div class="toolbar mb-4">
                    <button class="btn btn-primary btn-round" onclick="sfra.clickAddCourseRequirement()">ADD</button>
                </div> -->
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
                                  echo $rownum.'. '.$row->requirementname.'<br/>';
                                  $rownum++;
                                }
                            ?>


                       </p>
                      </div>
                      <div class="card-footer">
                        <div class="pull-left mb-2">
                          <?php if($loggedin)
                            echo '<h7><a href="#" class="link footer-link" data-toggle="modal" data-target="#courseModal'.$row->courseid.'">Show Details</a></h7>';
                          ?>
                        </div>
                        <div class="pull-right mb-2">
                          <?php if($loggedin && $myuserRole != 'admin')
                            echo '<h7><a href="#" onclick="sfra.clickEnrollCourse('.$row->courseid.')" class="link footer-link">Register</a></h7>';
                          ?>
                        </div>  
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


<?php foreach ($courseslist as $row) {?>
<div class="modal fade" id="courseModal<?php echo $row->courseid;?>" tabindex="-1" role="dialog" aria-labelledby="courseModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="now-ui-icons ui-1_simple-remove"></i>
        </button>
        <h5 class="title title-up"><?php echo $row->coursename;?></h5>
      </div>
      <div class="modal-body">       
          
         
                <hr>
                <h7><b>Course Information</b></h7>
                <div class="col-sm-12">
                  <div class="row">
                      <label class="col-sm-4 col-form-label">Class</label>
                      <div class="col-md-8">                          
                          <div class="form-group">
                              <input type="text" value="<?php echo $row->courseclass;?>" class="form-control" disabled/>
                          </div>
                      </div>
                      <label class="col-sm-4 col-form-label">Course Started</label>
                      <div class="col-md-8">                          
                          <div class="form-group">
                              <input type="text" value="<?php echo ($row->coursestarted == '0000-00-00') ? '' : nice_date($row->coursestarted, $uidateFormat);?>" class="form-control" disabled/>
                          </div>
                      </div>
                  </div>
                </div>
                <hr>
                <h7><b>Registration Information</b></h7>
                <div class="col-sm-12">
                  <div class="row">
                      <label class="col-sm-4 col-form-label">Reg Start</label>
                      <div class="col-md-8">                          
                          <div class="form-group">
                              <input type="text" value="<?php echo ($row->regstart == '0000-00-00') ? '' : nice_date($row->regstart, $uidateFormat);?>" class="form-control" disabled/>
                          </div>
                      </div>
                      <label class="col-sm-4 col-form-label">Reg End</label>
                      <div class="col-md-8">                          
                          <div class="form-group">
                              <input type="text" value="<?php echo ($row->regend == '0000-00-00') ? '' : nice_date($row->regend, $uidateFormat);?>" class="form-control" disabled/>
                          </div>
                      </div>
                  </div>
                </div>
              <hr/>
              <h7><b>Quota Information</b></h7>
              <div class="col-sm-12">                  
                  <div class="row">
                      <label class="col-sm-2 col-form-label">PA</label>
                      <label class="col-sm-2 col-form-label">PN</label>
                      <label class="col-sm-2 col-form-label">PAF</label>
                      <label class="col-sm-2 col-form-label">PNP</label>
                      <label class="col-sm-2 col-form-label">SFR(A)</label>
                      <label class="col-sm-2 col-form-label"><b>TOTAL</b></label>                     
                  </div>
              </div>
              <div class="col-sm-12">                  
                  <div class="row">
                      <label class="col-sm-2 col-form-label"><?php echo $row->armyquota?></label>
                      <label class="col-sm-2 col-form-label"><?php echo $row->navyquota;?></label>
                      <label class="col-sm-2 col-form-label"><?php echo $row->airforcequota;?></label>
                      <label class="col-sm-2 col-form-label"><?php echo $row->policequota;?></label>
                      <label class="col-sm-2 col-form-label"><?php echo $row->sfraunitquota;?></label>
                      <label class="col-sm-2 col-form-label"><b><?php echo $row->totalquota;?></b></label>
                  </div>
              </div>
                 
          
      </div>

      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default">Nice Button</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
      </div>     
    </div>
  </div>
</div>
<?php } ?>