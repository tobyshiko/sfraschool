<div class="row">
	<div class="col-md-12">
	    <div class="card">
	      <div class="card-header">
	        <!-- <h4 class="card-title">Enroll</h4> -->
	      </div>
	      <div class="card-body">
	      	<div class="row">
		      	<div class="col-md-6">
				    <div class="card">
				      <div class="card-header">
				        <h4 class="card-title">Course Information</h4>
				      </div>
				      <div class="card-body">

				      	<table class="table">
						    <tbody>
						    	<?php foreach($courseinfo as $row) {?>
						    	<tr class="table-danger">
						    		<td><b>Course Name</b></td>
						    		<td><?php echo $row->coursename;?></td>						        
						        </tr>
						        <tr>
						    		<td><b>Course Code</b></td>
						    		<td><?php echo $row->coursecode;?></td>						        
						        </tr>
						        <tr class="table-danger">
						    		<td><b>Course Class</b></td>
						    		<td><?php echo $row->courseclass;?></td>						        
						        </tr>

						        <tr>
						    		<td><b>Course Start</b></td>
						    		<td><?php echo ($row->coursestarted == '0000-00-00') ? '' : nice_date($row->coursestarted, $uidateFormat);?></td>						        
						        </tr>

						        <tr class="table-danger">
						    		<td><b>Registration Start</b></td>
						    		<td><?php echo ($row->regstart == '0000-00-00') ? '' : nice_date($row->regstart, $uidateFormat);?></td>						        
						        </tr>

						        <tr>
						    		<td><b>Registration End</b></td>
						    		<td><?php echo ($row->regend == '0000-00-00') ? '' : nice_date($row->regend, $uidateFormat);?></td>						        
						        </tr>
						       	<?php } ?>   
						    </tbody>
						</table>

				      </div>
				    </div>
				</div>
				<div class="col-md-6">
				    <div class="card">
				      <div class="card-header">
				        <h4 class="card-title">Course Registration Information</h4>
				      </div>
				      <div class="card-body">
				      	<table class="table table-striped">
						    <tbody>
						    	<?php foreach($enrollmentinfo as $row) {?>
						    	<tr class="table-warning">
						    		<td>Status</td>
						    		<td><?php echo $row->status;?></td>						        
						        </tr>
						        <tr>
						    		<td>Remarks</td>
						    		<td><?php echo $row->remarks;?></td>						        
						        </tr>
						    	<?php } ?>
						             
						    </tbody>
						</table>
				      </div>
				    </div>
				</div>
			</div>
			<div class="row">
		      	<div class="col-md-12">
				    <div class="card">
				    	<div class="card-header">
				        	<h4 class="card-title">Requirements</h4>
				      	</div>
				      	<div class="card-body">

				      	 	<div class="row">
				      	 		<div class="col-md-2">
				      	 			<table class="table">
									    <tbody>
									    	<tr class="table-primary">
									    		<td colspan="2">Legend</td> 
									        </tr>
									        <tr>
									    		<td><i class="fas fa-thumbs-up"></i></td>
									    		<td>Verified</td>						        
									        </tr>
									        <tr>
									    		<td><i class="fas fa-upload"></i></td>
									    		<td>Uploaded</td>						        
									        </tr>									     
									        <tr>
									    		<td><i class="fas fa-undo"></i></td>
									    		<td>Resubmit</td>						        
									        </tr>
									             
									    </tbody>
									</table>
				      	 		</div>
                                <div class="col-md-4">
                                    <ul class="nav nav-pills nav-pills-primary flex-column" id="cardStudentCourseReqTab" role="tablist">
                                    	<?php 
                                    	$readyforverification = array();
                                    	foreach($requirementsinfo as $row) {
                                    		
                                    	?>
                                        <li class="nav-item">                           
                                            <a class="nav-link" data-toggle="tab" href="#requirement<?php echo $row->coursereqid;?>" role="tablist">
                                            	
                                                <?php

                                                	if($row->attachment && $row->reqstatus == 'Uploaded'){
                                                		echo '<i class="fas fa-upload"></i>';
                                                		//$readyforverification = 'true';
                                                	}else if($row->attachment && $row->reqstatus == 'Verified'){
                                                		echo '<i class="fas fa-thumbs-up"></i>';
                                                		//$readyforverification = 'true';
                                                	}else if($row->attachment && $row->reqstatus == 'Resubmit'){
                                                		echo '<i class="fas fa-undo"></i>';
                                                		//$readyforverification = 'true';
                                                	}else{
                                                		//echo '';
                                                		$readyforverification = array('false');
                                                	}

                                                 	echo $row->requirementname; 

                                                 ?>            
                                            </a>
                                        </li>
                                    	<?php 

                                    		} 
                               
                                    	?>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <div class="tab-content text-center">
                                    	<?php foreach($requirementsinfo as $row) {
                                    		$img = $row->attachment ? $row->attachment : 'assets/img/img_holder.png';                                    		
                                    	?>
                                        <div class="tab-pane fade show" id="requirement<?php echo $row->coursereqid;?>">
                                        	<form action="<?php echo base_url().'courses/upload_req/'.sha1($row->courseid).'/'.$row->courseid;?>" method="post" enctype='multipart/form-data'>
                                        		
                                        		

									            <?php 

									            	if($row->attachment && $row->reqstatus == 'Uploaded'){
									            		echo '<input type="hidden" name="studentcoursereq" value="'.$row->studentcoursereqid.'"/>
	                                          	
			                                        		<div class="img_preview_wrap">
											                <img id="imagePreview'.$row->coursereqid.'" alt="Preview Image" width="400px" src="'.base_url($row->attachment).'"/>
											              </div>';
									            		 if($row->status == 'DRAFT'){ 
									            		echo '<label class="btn btn-primary text-white" for="imageUpload'.$row->coursereqid.'">Change Attachment</label>';
									            		echo '<input type="file" name="imageUpload" value="'.$row->coursereqid.'" id="imageUpload'.$row->coursereqid.'" class="hide_column"/>	';
                                                		echo '<button type="button" class="btn btn-primary">Remove Attachment</button>';

                                                		
											            
									                     	echo '<div class="form-group">
											                    <button class="btn btn-success" type="submit">Upload</button>
											                </div>';
											               }
                                                	}else if($row->attachment && $row->reqstatus == 'Verified'){
                                                		echo '<div class="img_preview_wrap">
											                <img id="imagePreview'.$row->coursereqid.'" alt="Preview Image" width="400px" src="'.base_url($row->attachment).'"/>
											              </div>';
                                                	}else if($row->attachment && $row->reqstatus == 'Resubmit'){

                                                		echo '<input type="hidden" name="studentcoursereq" value="'.$row->studentcoursereqid.'"/>
	                                          	
			                                        		<div class="img_preview_wrap">
											                <img id="imagePreview'.$row->coursereqid.'" alt="Preview Image" width="400px" src="'.base_url($row->attachment).'"/>
											              </div>';

                                                		 //if($row->status == 'DRAFT'){
                                                		echo '<label class="btn btn-primary text-white" for="imageUpload'.$row->coursereqid.'">Change Attachment</label>';
                                                		echo '<input type="file" name="imageUpload" value="'.$row->coursereqid.'" id="imageUpload'.$row->coursereqid.'" class="hide_column"/>	';
                                                		echo '<button type="button" class="btn btn-primary">Remove Attachment</button>';

                                                		
									                       
									                     	echo '<div class="form-group">
											                    <button class="btn btn-success" type="submit">Upload</button>
											                </div>';
											               //}
                                                	}else{
                                                		echo '<input type="hidden" name="studentcoursereq" value="'.$row->studentcoursereqid.'"/>
	                                          	
			                                        		<div class="img_preview_wrap">
											                <img id="imagePreview'.$row->coursereqid.'" alt="Preview Image" width="400px" src="'.base_url($row->attachment).'"/>
											              </div>';

                                                		//if($row->status == 'DRAFT'){
                                                		echo '<label class="btn btn-primary text-white" for="imageUpload'.$row->coursereqid.'">Choose Attachment</label>';
                                                		echo '<input type="file" name="imageUpload" value="'.$row->coursereqid.'" id="imageUpload'.$row->coursereqid.'" class="hide_column"/>	';

                                                		
									                         
									                     	echo '<div class="form-group">
											                    <button class="btn btn-success" type="submit">Upload</button>
											                </div>';
											            //}
                                                	}

									            ?>
                                        		
					                    	</form>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
        

        
    					</div>
				      </div>
				    </div>

				    <div class="card-footer">
				      <?php
				      if(count($readyforverification) == 0){
				      		foreach($enrollmentinfo as $row) {
				      			if($row->status == 'DRAFT'){
		              				echo '<a href="'.base_url('courses/submit_req/'.$row->courseid).'" class="btn btn-warning btn-round btn-lg btn-block mb-3">Submit for Verification</a>';
		              			}
		              		}
		          		}
		              ?>
		            </div>

				</div>
			</div>
	      </div>
	    </div>
	</div>
	
</div>