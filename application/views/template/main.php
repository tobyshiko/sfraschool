<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?php echo base_url('favicon.ico');?>">
   <!--<link rel="shortcut icon" href="<?php echo base_url();?>favicon.ico" type="image/x-icon">
  <link rel="icon" href="<?php echo base_url();?>favicon.ico" type="image/x-icon"> -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Special Forces Regiment (Airbone) - School Registration System
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="<?php echo base_url('assets/css/bootstrap.min_.css');?>" rel="stylesheet" />
  <link href="<?php echo base_url('assets/css/now-ui-dashboard.min_.css?v=1.5.0');?>" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?php echo base_url('assets/demo/demo.css');?>" rel="stylesheet" />
  <link href="<?php echo base_url('assets/css/customstyle.css');?>" rel="stylesheet" />  
</head>

<body class="">
  <div class="wrapper ">
    <input type="hidden" id="datepickerformat" value="<?php echo $uidateFormat; ?>"/>
    <?php include 'sidebar.php';?>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <?php include 'headernavbar.php';?>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <!-- <?php //include $page_dir.'/'.$page_name.'.php';?> -->
        <?php echo $page;?>
      </div>
      <?php include 'footer.php';?>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="<?php echo base_url('assets/js/core/jquery.min.js');?>"></script>
  <script src="<?php echo base_url('assets/js/core/popper.min.js');?>"></script>
  <script src="<?php echo base_url('assets/js/core/bootstrap.min.js');?>"></script>

  <!-- Plugins -->
  <script src="<?php echo base_url('assets/js/plugins/jquery.dataTables.min.js');?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/perfect-scrollbar.jquery.min.js');?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/moment.min.js');?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/bootstrap-selectpicker.js');?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/bootstrap-switch.js');?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/bootstrap-datetimepicker.js');?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/nouislider.min.js');?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/jquery.validate.min.js');?>"></script>  
  <script src="<?php echo base_url('assets/js/plugins/sweetalert2.min.js');?>"></script>
  <script src="<?php echo base_url('assets/js/plugins/jasny-bootstrap.min.js');?>"></script>  
  <script src="<?php echo base_url('assets/js/plugins/tinymce/tinymce.min.js');?>"></script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>

  <script async defer src="https://cdn.datatables.net/plug-ins/1.10.21/sorting/datetime-moment.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ==" crossorigin="anonymous" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw==" crossorigin="anonymous"></script>

  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="<?php echo base_url('assets/js/plugins/chartjs.min.js');?>"></script>
  <!--  Notifications Plugin    -->
  <script src="<?php echo base_url('assets/js/plugins/bootstrap-notify.js');?>"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?php echo base_url('assets/js/now-ui-dashboard.minV2.js?v=1.5.0');?>" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="<?php echo base_url('assets/demo/demo_.js');?>"></script>
  <script src="<?php echo base_url('assets/js/custom/sfra.js');?>"></script>
  <script src="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></script>
   <script>
    $(document).ready(function() {

        $('#cardStudentCourseReqTab a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('studcoursereq_tab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('studcoursereq_tab');
        if(activeTab){
            $('#cardStudentCourseReqTab a[href="' + activeTab + '"]').tab('show');
        }
      // Javascript method's body can be found in assets/js/demos.js
      demo.initGoogleMaps();      
    });
  </script>
  <script>
  function setFormValidation(id,modal){
    $(id).validate({
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
            $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
            $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
        },
        errorPlacement : function(error, element) {
            $(element).append(error);
        },
        submitHandler: function(form) {
            $.ajax({
                url : form.action,//'login/loginUser',
                type: form.method,//"POST",
                data:  $(form).serialize(),                
                dataType: "JSON",
                success: function(data)
                {

                    if(data.status) //if success close modal and reload ajax table
                    {                       
                      $('#'+modal).modal('hide');

                      $('#'+modal).on('hidden.bs.modal', function () {                         
                          location.reload(true);                          
                      });            
                    }
                    else
                    {
                       
                        $.toast({
                            heading: 'Kindly check your errors!!!',
                            text: data.errors,
                            icon: 'error',                            
                            stack: false,
                            showHideTransition: 'fade',
                            position: 'top-right'
                        });
                    }   

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                }
            });
        }
    });
  }

  $(document).ready(function() {
    setFormValidation('#loginForm','loginModal');    
    setFormValidation('#registrationForm','signUpModal');
    sfra.formSubmitValidation('#addCourseForm','courseModalAdd');
    sfra.formSubmitValidation('#addRequirementForm','requirementModalAdd');
    sfra.formSubmitValidation('#addCourseRequirementForm','courseRequirementModalAdd');
    sfra.formSubmitValidation('#settingsForm','settingsModal');
    sfra.formSubmitValidation('#addForm','addFormModal');    
    sfra.formSubmitValidationNoRedirect('#changePasswordForm','changePasswordModal');
    sfra.formSubmitValidationNoRedirectWithDOMUpdate('#approveRegistrationForm',null);
    sfra.formSubmitValidationNoRedirectWithDOMUpdate('#attachmentActionForm','viewAttachmentReqModal');
    sfra.formSubmitValidationNonModal('#userprofileForm');
    sfra.clickEditUserProfile();
    sfra.clickCancelUpdateProfile();
  });
</script>
<script type="text/javascript">
    $(document).ready(function() {
      var x = $('#datepickerformat').val();

      if(x.indexOf("m") > -1){
        x = x.replace('m','MM');
      }else{
        x = x.replace('M','MMM')
      }

      x = x.replace('d','DD');
      x = x.replace('Y','YYYY');
      
      demo.initDateTimePicker(x);
      $.fn.dataTable.moment(x);
      if($('.slider').length != 0){
        demo.initSliders();
      }

      /**
        $('#cardStudentCourseReqTab a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        var tabid = $(e.target).attr('href');
        var arr = tabid.split('-');
        localStorage.setItem('studcoursereq_tab', tabid);
    });
    var activeTab = localStorage.getItem('studcoursereq_tab');
    if(activeTab){
        $('#cardStudentCourseReqTab a[href="' + activeTab + '"]').tab('show');
        var arr = activeTab.split('-');
    }
***/


             

    });
</script>
<script>
  tinymce.init({ 
    selector:'.editor',
    theme: 'modern',
    height: 200
  });
</script>
<script type="text/javascript">
  
 $('[id*=imageUpload]').change(function() {
  var idval = this.id.split("imageUpload");
  readImgUrlAndPreview(this,idval[1]);

  function readImgUrlAndPreview(input,idval) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#imagePreview'+idval).removeClass('hide').attr('src', e.target.result);
        $('#imagePreviewSave'+idval).removeClass('hide').attr('src', e.target.result);
      }
    };
    reader.readAsDataURL(input.files[0]);
  }
});


$('#profileUpload').change(function() {
  readImgUrlAndPreview(this);

  function readImgUrlAndPreview(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#profilePreview').removeClass('hide').attr('src', e.target.result);
        $('#imagePreviewSave').removeClass('hide_column').attr('src', e.target.result);
      }
    };
    reader.readAsDataURL(input.files[0]);
  }

});


$("#toastBasicTrigger").on("click", function(e) {
    e.preventDefault();
    $("#toastBasic").toast("show");
});


</script>

<?php if ($page_active == 'notification'): ?>
<script type="text/javascript">
  $(document).ready(function() {

      sfra.clickReplyLink();
      sfra.clickCancelReplyMessage();

      var table = $('#datatableNoti').DataTable();

        $('#datatableNoti tbody').on('click', 'tr', function () {
            var data = table.row( this ).data();

            sfra.readNotification(data[0]);
            
        } );
  });
  </script>
<?php endif; ?>

<script>
  $(document).ready(function() {   

   

    var table = $('#datatable').DataTable();
    
  
   
    //var table = $('#datatable').DataTable();

    // Edit record
    /*
    table.on( 'click', '.edit', function () {
      $tr = $(this).closest('tr');
      if($($tr).hasClass('child')){
        $tr = $tr.prev('.parent');
      }

      var data = table.row($tr).data();
      alert( 'You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.' );
    } );
    */

    // Delete a record
    
    table.on( 'click', '.remove', function (e) {
      if(confirm('Are you sure delete this data?'))
      {
        $tr = $(this).closest('tr');
        if($($tr).hasClass('child')){
          $tr = $tr.prev('.parent');
        }
        data = table.row($tr).data();
        sfra.clickDeleteRecord(data[0]);
        table.row($tr).remove().draw();
        e.preventDefault();
      }
    } );
    


    //Like record
    /*
    table.on( 'click', '.like', function () {
      alert('You clicked on Like button');
    });
    */
    
  });
</script>

<?php if (($this->session->flashdata('error_message')) != ""): ?>
<script type="text/javascript">
  $(document).ready(function() {
      $.toast({
         
          text: '<?php echo $this->session->flashdata('error_message'); ?>',
          position: 'top-right',
          loaderBg: '#f56954',
          icon: 'warning',
          hideAfter: 5000,
          stack: 6
      })
  });
  </script>
<?php endif; ?>

<?php if (($this->session->flashdata('flash_message')) != ""): ?>
<script type="text/javascript">
  $(document).ready(function() {
      $.toast({
          heading: 'Congratulations!!!',
          text: '<?php echo $this->session->flashdata('flash_message'); ?>',
          position: 'top-right',
          loaderBg: '#ff6849',
          icon: 'success',
          hideAfter: 5000,
          stack: 6
      })
  });
  </script>
<?php endif; ?>


 <!--  <script src="<?php //echo base_url('assets/js/custom/login.js');?>"></script> -->

</body>

</html>

<!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Log in</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">        
        <form id="loginForm" method="POST" action="<?php echo base_url('login/loginUser');?>">
          <!-- <?php //echo validation_errors('<div class="alert alert-danger">', '</div>'); ?> -->
          <div class="card card-plain">    
           <!--  <div class="card-header ">
              <div class="logo-container">
                <img src="" alt="">
              </div>
            </div>    --> 
            <div class="card-body">
              <div class="form-group col-md-12">  
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                        <i class="now-ui-icons users_single-02"></i>
                        </div>      
                    </div>                      
                    <input type="text" class="form-control" id="logusername" name="logusername" placeholder="Username" required="true">
                </div>
              </div>
              <div class="form-group col-md-12">
                <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="now-ui-icons objects_key-25"></i>
                      </div>      
                    </div>
                    <input type="password" id="logpassword" name="logpassword" class="form-control" placeholder="Password" required="true">
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary btn-round btn-lg btn-block mb-3">
                Log in
              </button>
              <button type="reset" class="btn btn-primary btn-round btn-lg btn-block mb-3">Reset</button>            
              <div class="pull-left">
                  <h6><a href="#" data-toggle="modal" data-target="#forgotUsernameModal"  data-dismiss="modal" class="link footer-link">Forgot Password?</a></h6>
              </div>
              <!-- <div class="pull-right">
                 <h6><a href="#pablo" class="link footer-link">Forgot Username?</a></h6>
              </div> -->
            </div>          
          </div>
        </form>
      </div>      
    </div>
  </div>
</div>
<!-- Modal SignUP -->
<div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="signUpModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signUpModalLabel">Sign Up</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-plain">
          <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
          <form id="registrationForm" action="<?php echo base_url('login/signUp');?>" method="POST">
            <div class="card-body">              
              <fieldset>
                <h6>Account Information</h6>
                <div class="form-row">
                    <div class="form-group col-md-12">                        
                      <input type="text" class="form-control" id="username" name="username" placeholder="Username" required="true">
                    </div>
                    <div class="form-group col-md-6">   
                                        
                      <input type="password" id="registerPassword" name="password" minlength="8" class="form-control" placeholder="Password" required="true">

                    </div>
                    <div class="form-group col-md-6">
                      <small class="text-muted"></small>  
                      <input type="password" class="form-control" name="password_confirmation" id="registerPasswordConfirmation" placeholder="Confirm Password" required="true" equalTo="#registerPassword">
                    </div>    
                    <div class="form-group col-md-12"> 
                      <small class="text-muted">Username is 5 char minimum and 15 char maximum length.</small>
                      <br/>
                      <small class="text-muted">Password is 8 char minimum length.</small>   
                    </div>                   
                </div>
              </fieldset>
              <fieldset class="mt-2">
                <h6>Personal Information</h6>
                <div class="form-row">                        
                    <div class="form-group col-md-6">                       
                      <input type="text" onkeyup="this.value = this.value.toUpperCase()"  style="text-transform:uppercase" id="firstname" name="firstname" class="form-control" placeholder="First Name" required="true">
                    </div>
                    <div class="form-group col-md-6">                       
                      <input type="text" onkeyup="this.value = this.value.toUpperCase()"  style="text-transform:uppercase" id="middlename" name="middlename" class="form-control" placeholder="Middle Name">
                    </div>  
                    <div class="form-group col-md-6">                       
                      <input type="text" onkeyup="this.value = this.value.toUpperCase()"  style="text-transform:uppercase" id="lastname" name="lastname" class="form-control" placeholder="Last Name" required="true">
                    </div>
                    <div class="form-group col-md-6">                       
                      <select id="suffix" name="suffix" class="form-control">
                        <option value="" selected>SUFFIX</option>
                        <option>Sr</option>
                        <option>Jr</option>
                        <option>II</option>
                        <option>III</option>
                        <option>IV</option>
                        <option>V</option>
                        <option>VI</option>
                        <option>VII</option>
                        <option>VIII</option>
                        <option>IX</option>
                        <option>X</option>
                      </select>
                    </div>                       
                    <div class="form-group col-md-12">                        
                      <input type="email" id="useremail" name="useremail" class="form-control" placeholder="EMAIL" required="true">
                    </div>
                    <div class="form-group col-md-12">                        
                      <textarea class="form-control" onkeyup="this.value = this.value.toUpperCase()"  style="text-transform:uppercase" id="address" name="address" placeholder="Complete Address" rows="3" required="true"></textarea>
                    </div>
                </div>
              </fieldset>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary btn-round btn-lg btn-block mb-3">Sign up Now!</button>
              <button type="reset" class="btn btn-primary btn-round btn-lg btn-block mb-3">Reset</button>
            </div>
          </form>        
        </div>
      </div>      
    </div>
  </div>
</div>


<div class="modal fade" id="forgotUsernameModal" tabindex="-1" role="dialog" aria-labelledby="forgotUsernameModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="forgotUsernameModalLabel">Forgot Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">        
        <form id="forgotUsernameForm" method="POST" action="<?php echo base_url('user/forgot_password');?>">
          <div class="card card-plain">
            <div class="card-body">
              <div class="form-group col-md-12">  
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                        <i class="now-ui-icons ui-1_email-85"></i>
                        </div>      
                    </div>                      
                    <input type="email" class="form-control" id="emailadd" name="emailadd" placeholder="Email Address" required="true">
                </div>
              </div>             
            </div>
            <div class="card-footer">
              <button type="submit" name="btnForgotPassword" value="true" class="btn btn-primary btn-round btn-lg btn-block mb-3">
                Send Email
              </button>             
            </div>          
          </div>
        </form>
      </div>      
    </div>
  </div>
</div>