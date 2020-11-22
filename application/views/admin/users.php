<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Registered User Lists</h4>
            </div>
            <div class="card-body">
                <!-- <div class="toolbar mb-4">
                    <button class="btn btn-primary btn-round" onclick="sfra.clickAddRequirement()">Add Requirements</button>
                </div> -->
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="hide_column"></th>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>AFPSN</th>
                            <th>Role</th>
                            <th class="disabled-sorting text-right">Active</th>
                            <!-- <th class="disabled-sorting text-right">Actions</th> -->
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="hide_column"></th>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>AFPSN</th>                            
                            <th>Role</th>
                            <th class="disabled-sorting text-right">Active</th>
                            <!-- <th class="disabled-sorting text-right">Actions</th> -->
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                            
                            foreach($page_data as $row){       

                            if($row->isactivated){
                                $status = '<input type="checkbox" onchange="sfra.clickActiveDeactiveUser('.$row->id.',this)" checked name="checkbox" class="bootstrap-switch"
                                    data-on-label="<i class=\'now-ui-icons ui-1_check\'></i>"
                                    data-off-label="<i class=\'now-ui-icons ui-1_simple-remove\'></i>"
                                />';
                            }else{
                                $status = '<input type="checkbox" onchange="sfra.clickActiveDeactiveUser('.$row->id.',this)" name="checkbox" class="bootstrap-switch"
                                    data-on-label="<i class=\'now-ui-icons ui-1_check\'></i>"
                                    data-off-label="<i class=\'now-ui-icons ui-1_simple-remove\'></i>"
                                />';
                            }

                            echo'<tr>
                                <td class="hide_column">'.$row->id.'</td>
                                <td><a href="'.base_url('user/view_user/').$row->userguid.'">'.$row->username.'</a></td>
                                <td>'.$row->first_name.' '.$row->last_name.'</td>
                                <td>'.$row->afpsn.'</td>                                
                                <td>'.$row->role.'</td>
                                <td class="disabled-sorting text-right">'.$status.'</td>
                            </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div> <!-- end col-md-12 -->
</div> <!-- end row -->

<div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notice">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
      <i class="now-ui-icons ui-1_simple-remove"></i>
    </button>
        <h5 class="modal-title" id="myModalLabel">How Do You Become an Affiliate?</h5>
      </div>
      <div class="modal-body">
        <div class="instruction">
            <div class="row">
                <div class="col-md-8">
                     <strong>1. Register</strong>
                     <p class="description">The first step is to create an account at <a href="http://www.creative-tim.com/">Creative Tim</a>. You can choose a social network or go for the classic version, whatever works best for you.</p>
                </div>
                <div class="col-md-4">
                    <div class="picture">
                        <img src="../../assets/img/bg1.jpg" alt="Thumbnail Image"  class="rounded img-raised">
                    </div>
                </div>
            </div>
        </div>
        <div class="instruction">
            <div class="row">
                <div class="col-md-8">
                        <strong>2. Apply</strong>
                        <p class="description">The first step is to create an account at <a href="http://www.creative-tim.com/">Creative Tim</a>. You can choose a social network or go for the classic version, whatever works best for you.</p>
                </div>
                <div class="col-md-4">
                    <div class="picture">
                        <img src="../../assets/img/bg3.jpg" alt="Thumbnail Image"  class="rounded img-raised">
                    </div>
                </div>
            </div>
        </div>
        <p>If you have more questions, don't hesitate to contact us or send us a tweet @creativetim. We're here to help!</p>
      </div>
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-info btn-round" data-dismiss="modal">Sounds good!</button>
      </div>
    </div>
  </div>
</div>