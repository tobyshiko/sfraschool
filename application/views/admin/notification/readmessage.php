<div class="row">
 
    <div class="card">
      <div class="card-header">
        <!-- <h5 class="title">My Profile</h5> -->
        <a href="#" id="replyLink" class="text-align-right">
          <i class="now-ui-icons gestures_tap-01"></i>Reply
        </a>
      </div>
      <div class="card-body">
        <form id="replyForm" method="POST" action="<?php echo base_url('notification/reply_message')?>">
          <?php foreach($page_data as $row) { ?>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label class="control-label">From</label>
                <input type="hidden" name="fromuser" value="<?php echo $row->fromuser;?>"> 
                <input type="hidden" name="fromname" value="<?php echo $row->fromname;?>"> 
                 <p class="form-control">
                	<?php echo $row->fromname?>
                </p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group required">
                <label>Message</label>
                <p>                	
                	<?php echo $row->message?>
                </p>
              </div>
            </div>
          </div>         
        
          <div class="row">
            <div class="col-md-12">
              <div class="form-group"> 
              	<input type="hidden" name="id" value="<?php echo $row->notificationid;?>"> 
              	<div id="replyMsg" style="display: none;">
	              	<label>Reply Message</label>
	                <div class="form-group">
	                    <textarea name="replymsg" class="form-control" maxlength="150"></textarea>
	                </div>
            	</div>
                <button type="submit" name="btnSendReplyMessage" value="true" id="btnSendReplyMessage" class="btn btn-primary btn-round btn-lg btn-block mb-3" style="display: none;">
                Send
                </button>
                <button type="reset" id="btnCancelReplyMessage" class="btn btn-primary btn-round btn-lg btn-block mb-3" style="display: none;">
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