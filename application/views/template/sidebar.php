<div class="sidebar" data-color="<?php if($colorSidebar) echo $colorSidebar; else echo 'red';?>">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
  <div class="logo">
    <a href="<?php echo base_url();?>" class="simple-text logo-normal">
      SFR(A) - Registration System
    </a>
  </div>
  <div class="sidebar-wrapper" id="sidebar-wrapper">

    <?php if($loggedin) { 
      
        if($profilepic == '' || $profilepic == null){
          $profilepic = 'images/profile/default-avatar.png';
        }
    ?>
    <div class="user">
        <div class="photo">
            <img src="<?php echo base_url($profilepic);?>" />
        </div>
        <div class="info">
            <a data-toggle="collapse" href="#collapseUser" class="collapsed">
                <span>
                    <?php echo $loggeduser?>
                    <b class="caret"></b>
                </span>
            </a>
            <div class="clearfix"></div>
            <div class="collapse <?php if($page_active == 'userprofile' || $page_active == 'mycourses' || $page_active == 'notification') echo 'show'; ?>" id="collapseUser">
                <ul class="nav">
                    <li class="<?php if($page_active == 'userprofile') echo 'active'; ?>">
                        <a href="<?php echo base_url('user/profile')?>">
                            <i class="far fa-user"></i>
                            <span class="sidebar-normal">My Profile</span>
                        </a>
                    </li>
                    <li class="<?php if($page_active == 'notification') echo 'active'; ?>">
                        <a href="<?php echo base_url('notification')?>">
                            <i class="far fa-bell"></i>
                            <span class="sidebar-normal">My Notifications</span>
                        </a>
                    </li>
                    <?php if($myuserRole != 'admin') { ?>
                    <li class="<?php if($page_active == 'mycourses') echo 'active'; ?>">
                        <a href="<?php echo base_url('courses/mycourses')?>">
                            <i class="fas fa-book"></i>
                            <span class="sidebar-normal">My Courses</span>
                        </a>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="#" onclick="sfra.clickChangePassword()">
                            <i class="fas fa-unlock-alt"></i>
                            <span class="sidebar-normal">Change Password</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#settingsModal">
                            <i class="fas fa-cog"></i>
                            <span class="sidebar-normal">Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?php } ?>

    <ul class="nav">
        <?php //if($loggedin) { ?>
        <!-- <li class="<?php //if($page_active == 'dashboard') echo 'active';?>">
            <a href="<?php //echo base_url('dashboard');?>">
              <i class="now-ui-icons design_app"></i>
              <p> <?php //echo $page_menu;?> Dashboard </p>
            </a>
        </li> -->
        <?php //} ?>
        
        <li class="<?php if($page_active == 'courses') echo 'active';?>">
            <a href="<?php echo base_url('courses');?>">
              <i class="fas fa-book"></i>
              <p> Courses </p>
            </a>
        </li>
     
       <!--  <li class="<?php //if($page_active == 'user') echo'active';?>">
            <a href="<?php //echo base_url('user');?>">
              <i class="now-ui-icons users_single-02"></i>
              <p>User Profile</p>
            </a>
        </li> -->

        <li class="<?php if($page_active == 'about') echo 'active';?>">
            <a href="<?php echo base_url('about');?>">
              <i class="fas fa-info-circle"></i>
              <p> About </p>
            </a>
        </li>



        <?php if($loggedin && $myuserRole == 'admin') { ?>

        <li class="<?php if($page_active == 'reports') echo 'active';?>">
            <a href="<?php echo base_url('reports');?>">
              <i class="fas fa-file"></i>
              <p> Reports </p>
            </a>
        </li>

        <li>                  
            <a data-toggle="collapse" href="#adminForms" >              
                <i class="fas fa-briefcase"></i>         
                <p>
                  Administration <b class="caret"></b>
                </p>
            </a>

            <div class="collapse <?php if($page_active == 'admincourse' || $page_active == 'requirements' || $page_active == 'coursesrequirements' || $page_active == 'emailtemplate' || $page_active == 'users') echo 'show'; ?>" id="adminForms">
                <ul class="nav">                
                  <li class="<?php if($page_active == 'admincourse') echo 'active'; ?>">
                      <a href="<?php echo base_url('courses/view_list');?>">
                          <i class="fas fa-book"></i>
                          <span class="sidebar-normal"> Courses </span>
                      </a>
                  </li>                
                  <li class="<?php if($page_active == 'requirements') echo 'active'; ?>">
                      <a href="<?php echo base_url('requirements/view_list');?>">
                          <i class="fas fa-archive"></i>
                          <span class="sidebar-normal"> Requirements </span>
                      </a>
                  </li> 
                  <li class="<?php if($page_active == 'coursesrequirements') echo 'active'; ?>">
                      <a href="<?php echo base_url('requirementscourses');?>">
                          <i class="fas fa-list"></i>
                          <span class="sidebar-normal"> Requirements per Courses </span>
                      </a>
                  </li>                    
                  <li class="<?php if($page_active == 'users') echo 'active'; ?>">
                      <a href="<?php echo base_url('user');?>">
                          <i class="fas fa-users"></i>
                          <span class="sidebar-normal"> Users </span>
                      </a>
                  </li>
                
                  <li class="<?php if($page_active == 'emailtemplate') echo 'active'; ?>">
                      <a href="<?php echo base_url('emailtemplate'); ?>">
                          <i class="fas fa-envelope"></i>
                          <span class="sidebar-normal"> Email Template </span>
                      </a>
                  </li>
                
                </ul>
            </div>          
        </li>
        <?php } ?>
      
    </ul>
  </div>
</div>


<!-- Modal Change Password -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="changePasswordForm" action="<?php echo base_url('user/change_password');?>" method="POST">
        <div class="modal-header justify-content-center">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="now-ui-icons ui-1_simple-remove"></i>
          </button>
          <h5 class="title title-up">Password Change</h5>
        </div>
        <div class="modal-body">
          <hr>
          <div class="form-group required">
            <label class="control-label">Current Password</label>
            <input type="password" class="form-control" name="currentpassword" required>
          </div>
          <div class="form-group required">
            <label class="control-label">New Password <small class="text-muted">(8 char minimum length).</small></label>
            <input type="password" class="form-control" minlength="8" name="newpassword" id="newpassword" required>
          </div>

          <div class="form-group required">
            <label class="control-label">Confirm New Password</label>
            <input type="password" class="form-control" minlength="8" name="cnewpassword" equalTo="#newpassword" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="btnChangePassword" value="true" class="btn btn-default">Change</button>
        </div>
      </form> 
    </div>
  </div>
</div>

<!-- Modal Settings -->
<div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="settingsModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="settingsForm" action="<?php echo base_url('user/update_settings');?>" method="POST">
        <div class="modal-header justify-content-center">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="now-ui-icons ui-1_simple-remove"></i>
          </button>
          <h5 class="title title-up">Settings</h5>
        </div>
        <div class="modal-body">
            <hr>
            <div class="col-sm-12">
              <div class="row">
                  <label class="col-sm-4 col-form-label">Side Bar Color</label>
                  <div class="col-md-8">                          
                      <div class="form-group">
                          <select class="selectpicker" name="sidebarcolor" data-size="7" data-style="btn btn-primary btn-round btn-block" title="Single Select">
                              <option value="" disabled selected>Choose Color</option>
                              <option value="blue">Blue</option>
                              <option value="green">Green</option>
                              <option value="orange">Orange</option>
                              <option value="red">Red</option>
                              <option value="yellow">Yellow</option>
                          </select>
                      </div>
                  </div>
                  <label class="col-sm-4 col-form-label">Date Format</label>
                  <div class="col-md-8">                          
                      <div class="form-group">
                          <select class="selectpicker" name="dateformat" data-size="7" data-style="btn btn-primary btn-round btn-block" title="Single Select">
                              <option value="" disabled selected>Choose Format</option>
                              <option value="d M Y">day Month Year (01 Dec 2020)</option>
                              <option value="d-M-Y">day-Month-Year (01-Dec-2020)</option>
                              <option value="d/M/Y">day/Month/Year (01/Dec/2020)</option>
                              <option value="M d Y">Month day Year (Dec 01 2020)</option>
                              <option value="M-d-Y">Month-day-Year (Dec-01-2020)</option>
                              <option value="M/d/Y">Month/day/Year (Dec/01/2020)</option>
                              <option value="Y M d">Year Month day (2020 Dec 01)</option>
                              <option value="Y-M-d">Year-Month-day (2020-Dec-01)</option>
                              <option value="Y/M/d">Year/Month/day (2020/Dec/01)</option>
                              <option value="d m Y">day month Year (01 12 2020)</option>
                              <option value="d-m-Y">day-month-Year (01-12-2020)</option>
                              <option value="d/m/Y">day/month/Year (01/12/2020)</option>
                              <option value="m d Y">month day Year (12 01 2020)</option>
                              <option value="m-d-Y">month-day-Year (12-01-2020)</option>
                              <option value="m/d/Y">month/day/Year (12/01/2020)</option>
                              <option value="Y m d">Year month day (2020 12 01)</option>
                              <option value="Y-m-d">Year-month-day (2020-12-01)</option>
                              <option value="Y/m/d">Year/month/day (2020/12/01)</option>
                              <option value="Y M d">Year Month day (2020 Dec 01)</option>
                              <option value="Y-M-d">Year-Month-day (2020-Dec-01)</option>
                              <option value="Y/M/d">Year/Month/day (2020/Dec/01)</option>
                          </select>
                      </div>
                  </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="btnUpdateSettings" value="true" class="btn btn-default">Update</button>
        </div>
      </form> 
    </div>
  </div>
</div>


