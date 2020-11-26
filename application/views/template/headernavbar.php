<nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
    <div class="container-fluid">
      <div class="navbar-wrapper">
        <div class="navbar-toggle">
          <button type="button" class="navbar-toggler">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
          </button>
        </div>
        <a class="navbar-brand" href="#"><?php echo $page_title;?></a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
      </button>      
      <div class="collapse navbar-collapse justify-content-end" id="navigation">
        <?php if($loggedin) { ?>
        <!-- <form>
          <div class="input-group no-border">
            <input type="text" value="" class="form-control" placeholder="Search...">
            <div class="input-group-append">
              <div class="input-group-text">
                <i class="now-ui-icons ui-1_zoom-bold"></i>
              </div>
            </div>
          </div>
        </form>      -->   
        <ul class="navbar-nav">
          <!-- <li class="nav-item">
            <a class="nav-link" href="#pablo">
              <i class="now-ui-icons loader_gear"></i>
              <p>
                <span class="d-lg-none d-md-block">Settings</span>
              </p>
            </a>
          </li> -->
          <li class="nav-item dropdown">
             <?php 
                  $this->crud->set_table('notifications');
                  $query = $this->crud->getResultsCriteria(array('touser'=>$myusername,'isread'=>0),null);
                  $notidata = $query->result();                 
              ?>
            <?php if(count($notidata) > 0){?>
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="now-ui-icons ui-1_bell-53"></i><span  class="badge badge-primary"><?php echo count($notidata)?></span>
              <p>
                <span class="d-lg-none d-md-block">Notifications</span>
              </p>
            </a>
            <?php } ?>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
             
                 <?php 
                    
                    foreach($notidata as $row){
                      echo '<a class="dropdown-item" href="'.base_url('notification/read/').$row->notificationid.'">'.$row->message.'</a>';
                    }
                 
                ?>
              
             <!--  <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a> -->
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('login/endSession');?>">
              <i class="now-ui-icons media-1_button-power"></i>
              <p>
                <span class="d-lg-none d-md-block">Logout</span>
              </p>
            </a>
          </li>
        </ul>
        <?php } ?>
      </div>
      <?php if(!$loggedin) { ?>
      <div class="collapse navbar-collapse justify-content-end" id="navigation">
        <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#loginModal">Log in</button>
        <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#signUpModal">Sign up</button>
      </div>
      <?php } ?>
    </div>
</nav>