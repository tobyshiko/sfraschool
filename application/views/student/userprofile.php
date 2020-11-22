<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h5 class="title">My Profile</h5>
        <a href="#" id="editUserProfile" class="text-align-right">
          <i class="now-ui-icons gestures_tap-01"></i>Edit
        </a>
      </div>
      <div class="card-body">
        <form id="userprofileForm" method="POST" action="<?php echo base_url('user/update_profile')?>">
          <?php foreach($page_data as $row) { ?>
          <div class="row">
            <div class="col-md-5 pr-1">
              <div class="form-group">
                <label class="control-label">Username <small class="text-muted">(Not updatable)</small></label>
                <input type="text" class="form-control" id="username" value="<?php echo $row->username; ?>" disabled>
              </div>
            </div>
            <div class="col-md-7 pl-1">
              <div class="form-group required">
                <label class="control-label">Email Address</label>
                <input type="text" class="form-control" name="emailaddress" value="<?php echo $row->email; ?>" disabled>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 pr-1">
              <div class="form-group required">
                <label class="control-label">AFPSN</label>
                <input type="text" onkeyup="this.value = this.value.toUpperCase()"  style="text-transform:uppercase" class="form-control" name="afpsn" value="<?php echo $row->afpsn; ?>" disabled required>
              </div>
            </div>
            <div class="col-md-3 px-1">
              <div class="form-group required">
                <label class="control-label">AFPOS / AFPMOS</label>
                <input type="text" onkeyup="this.value = this.value.toUpperCase()" style="text-transform:uppercase" class="form-control" name="afpos" value="<?php echo $row->afpos; ?>" disabled required>
              </div>
            </div>
            <div class="col-md-6 pl-1">
              <div class="form-group required">
                <label class="control-label">Unit Assigned</label>
                <input type="text" onkeyup="this.value = this.value.toUpperCase()"  style="text-transform:uppercase" class="form-control" name="unitassigned" value="<?php echo $row->unitassigned;?>" disabled required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 pr-1">
              <div class="form-group required">
                <label class="control-label">First Name</label>
                <input type="text" onkeyup="this.value = this.value.toUpperCase()"  style="text-transform:uppercase" class="form-control" name="firstname" value="<?php echo $row->first_name; ?>" disabled required>
              </div>
            </div>
            <div class="col-md-4 px-1">
              <div class="form-group">
                <label class="control-label">Middle Name</label>
                <input type="text" onkeyup="this.value = this.value.toUpperCase()"  style="text-transform:uppercase" class="form-control" name="middlename" value="<?php echo $row->middle_name; ?>" disabled>
              </div>
            </div>
            <div class="col-md-4 pl-1">
              <div class="form-group required">
                <label class="control-label">Last Name</label>
                <input type="text" onkeyup="this.value = this.value.toUpperCase()"  style="text-transform:uppercase" class="form-control" name="lastname" value="<?php echo $row->last_name; ?>" disabled required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2 pr-1">
              <div class="form-group">
                <label>Suffix</label>
                <!--  <div class="form-group col-md-6">              -->          
                      <select id="suffix" name="suffix" class="form-control" disabled>
                        <option value="" disabled selected>Suffix</option>
                        <option <?php if($row->suffix == 'Sr') echo 'selected'; ?>>Sr</option>
                        <option <?php if($row->suffix == 'Jr') echo 'selected'; ?>>Jr</option>
                        <option <?php if($row->suffix == 'II') echo 'selected'; ?>>II</option>
                        <option <?php if($row->suffix == 'III') echo 'selected'; ?>>III</option>
                        <option <?php if($row->suffix == 'IV') echo 'selected'; ?>>IV</option>
                        <option <?php if($row->suffix == 'V') echo 'selected'; ?>>V</option>
                        <option <?php if($row->suffix == 'VI') echo 'selected'; ?>>VI</option>
                        <option <?php if($row->suffix == 'VII') echo 'selected'; ?>>VII</option>
                        <option <?php if($row->suffix == 'VIII') echo 'selected'; ?>>VIII</option>
                        <option <?php if($row->suffix == 'IX') echo 'selected'; ?>>IX</option>
                        <option <?php if($row->suffix == 'Sr') echo 'selected'; ?>>X</option>
                      </select>
                  <!--   </div>   -->
               <!--  <input type="text" maxlength="2"  class="form-control" name="suffix" value="<?php echo $row->suffix; ?>" disabled> -->
                 <!-- <select class="selectpicker" id="suffix" name="suffix" data-size="7" data-style="btn btn-primary btn-round btn-block" title="Suffix">
                      <option  value="" disabled selected>Suffix</option>
                      <option <?php if($row->suffix == 'Sr') echo 'selected'; ?> value="Sr">Sr</option>
                      <option <?php if($row->suffix == 'Jr') echo 'selected'; ?> value="Jr">Jr</option>
                      <option <?php if($row->suffix == 'II') echo 'selected'; ?> value="II">II</option>
                      <option <?php if($row->suffix == 'III') echo 'selected'; ?> value="III">III</option>
                      <option <?php if($row->suffix == 'IV') echo 'selected'; ?> value="IV">IV</option>
                      <option <?php if($row->suffix == 'V') echo 'selected'; ?> value="V">V</option>
                  </select> -->
              </div>
            </div>
            <div class="col-md-4 px-1">
              <div class="form-group required">
                <label class="control-label">Date of Birth</label>
                <input type="text" class="form-control datepicker" name="dateofbirth" value="<?php echo nice_date($row->birthday,$uidateFormat);?>" disabled required>
              </div>
            </div>
            <div class="col-md-4 px-1">
              <div class="form-group required">
                <label class="control-label">Contact Number</label>
                <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==12) return false;"  class="form-control" name="contactnumber" value="<?php echo $row->contactnumber; ?>" disabled required>
              </div>
            </div>
            <div class="col-md-2 pl-1">
              <div class="form-group required">
                <label class="control-label">Bloodtype</label>
                <select id="bloodtype" name="bloodtype" class="form-control" disabled required>
                        <option value="" disabled selected>Bloodtype</option>
                        <option <?php if($row->bloodtype == 'O') echo 'selected'; ?>>O</option>
                        <option <?php if($row->bloodtype == 'A') echo 'selected'; ?>>A</option>
                        <option <?php if($row->bloodtype == 'A-') echo 'selected'; ?>>A-</option>
                        <option <?php if($row->bloodtype == 'A+') echo 'selected'; ?>>A+</option>
                        <option <?php if($row->bloodtype == 'B') echo 'selected'; ?>>B</option>
                        <option <?php if($row->bloodtype == 'B-') echo 'selected'; ?>>B-</option>
                        <option <?php if($row->bloodtype == 'B+') echo 'selected'; ?>>B+</option>
                        <option <?php if($row->bloodtype == 'AB') echo 'selected'; ?>>AB</option>
                        <option <?php if($row->bloodtype == 'AB-') echo 'selected'; ?>>AB-</option>
                        <option <?php if($row->bloodtype == 'AB+') echo 'selected'; ?>>AB+</option>
                      </select>
                <!-- <input type="text" maxlength="2" class="form-control" name="bloodtype" value="<?php echo $row->bloodtype; ?>" disabled required> -->
                <!-- <select class="selectpicker" name="bloodtype" data-size="7" data-style="btn btn-default btn-round btn-block" title="Bloodtype" required>
                      <option value="" selected>Bloodtype</option>
                      <option <?php if($row->bloodtype == 'O') echo 'selected'; ?> value="O">O</option>
                      <option <?php if($row->bloodtype == 'A') echo 'selected'; ?> value="A">A</option>
                      <option <?php if($row->bloodtype == 'A-') echo 'selected'; ?> value="A-">A-</option>
                      <option <?php if($row->bloodtype == 'A+') echo 'selected'; ?> value="A+">A+</option>
                      <option <?php if($row->bloodtype == 'B') echo 'selected'; ?> value="B">B</option>
                      <option <?php if($row->bloodtype == 'B-') echo 'selected'; ?> value="B-">B-</option>
                      <option <?php if($row->bloodtype == 'B+') echo 'selected'; ?> value="B+">B+</option>
                      <option <?php if($row->bloodtype == 'AB') echo 'selected'; ?> value="AB">AB</option>
                      <option <?php if($row->bloodtype == 'AB-') echo 'selected'; ?> value="AB-">AB-</option>
                      <option <?php if($row->bloodtype == 'AB+') echo 'selected'; ?> value="AB+">AB+</option>
                  </select> -->
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group required">
                <label class="control-label">Address</label>
                <input type="text" onkeyup="this.value = this.value.toUpperCase()"  style="text-transform:uppercase" class="form-control" name="address" value="<?php echo $row->address; ?>" disabled required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 pr-1">
              <div class="form-group required">
                <label class="control-label">Emergency Contact Person</label>
                <input type="text" onkeyup="this.value = this.value.toUpperCase()"  style="text-transform:uppercase" class="form-control" name="ercontactperson" value="<?php echo $row->emergencycontactperson; ?>" disabled required>
              </div>
            </div>
            
            <div class="col-md-6 pl-1">
              <div class="form-group required">
                <label class="control-label">Emergency Contact Number</label>
                <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==12) return false;" name="ercontactnumber" value="<?php echo $row->emergencycontactnumber; ?>" class="form-control" disabled required>
              </div>
            </div>
          </div>
          <!-- <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>About Me</label>
                <textarea rows="4" cols="80" class="form-control">Soldier sweet lover...</textarea>
              </div>
            </div>
          </div> -->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">                
                <button type="submit" name="updateProfile" value="true" id="btnUpdateProfile" class="btn btn-primary btn-round btn-lg btn-block mb-3" style="display: none;">
                Update
                </button>
                <button type="reset" id="btnCancelUpdateProfile" class="btn btn-primary btn-round btn-lg btn-block mb-3" style="display: none;">
                Cancel
                </button>                
              </div>
            </div>
          </div>
          <?php } ?>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <?php foreach($page_data as $row) { 
      $myprofilepic = $row->picture;
      if($myprofilepic == "" || $myprofilepic == null){
        $myprofilepic = 'images/profile/default-avatar.png';
      }
    ?>
    <div class="card card-user">
      <form action="<?php echo base_url().'user/profileupload'?>" method="post" enctype='multipart/form-data'>
      <div class="image">
        <img src="<?php echo base_url('images/site/honorary.jpg');?>" alt="...">
      </div>
      <div class="card-body">
        <div class="author">
          <a href="#">
            <label for="profileUpload"><img id="profilePreview" class="avatar border-gray" src="<?php echo base_url($myprofilepic);?>" alt="..."></label>
            <h5 class="title"><?php echo $row->first_name.' '.$row->last_name; ?></h5>
            <input type="file" name="profileUpload" id="profileUpload" class="hide_column"/>
            <!-- <label class="btn btn-primary text-white" for="profileUpload">Change Profile</label> -->
           
          </a>
          <p class="description">
            <?php echo $row->username; ?>
          </p>
        </div>
        <p class="description text-center">
          Click image to change profile<br/>
         <?php //echo $row->address; ?>
         <?php //echo $row->unitassigned; ?>
        </p>
      </div>

      <hr>
      <div class="button-container">
         <button id="imagePreviewSave" class="btn btn-primary text-white hide_column">
            Upload Profile
          </button>
        <!-- <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
          <i class="fab fa-facebook-f"></i>
        </button>
        <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
          <i class="fab fa-twitter"></i>
        </button>
        <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
          <i class="fab fa-google-plus-g"></i>
        </button> -->
      </div>
      </form>
    </div>
    <?php } ?>
  </div>
</div>